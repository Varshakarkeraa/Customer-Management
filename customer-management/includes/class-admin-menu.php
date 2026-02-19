<?php

class Customer_Admin_Menu
{

    public function __construct()
    {
        add_action('admin_menu', [$this, 'register_menu']);
        add_action('admin_init', [$this, 'handle_delete']);
    }

    public function register_menu()
    {

        add_menu_page(
            'Customer Manager',
            'Customer Manager',
            'manage_options',
            'customer-manager',
            [$this, 'customer_list_page'],
            'dashicons-groups'
        );

        add_submenu_page(
            'customer-manager',
            'Add Customer',
            'Add New',
            'manage_options',
            'add-customer',
            [$this, 'add_customer_page']
        );

        add_submenu_page(
            null,                      // hidden from menu
            'Edit Customer',
            'Edit Customer',
            'manage_options',
            'edit-customer',
            [$this, 'edit_customer_page']
        );
    }



    public function customer_list_page()
    {
        include plugin_dir_path(dirname(__FILE__)) . 'admin/customer-list.php';
    }

    public function add_customer_page()
    {
        include plugin_dir_path(dirname(__FILE__)) . 'admin/add-customer.php';
    }

    public function edit_customer_page()
    {
        include plugin_dir_path(dirname(__FILE__)) . 'admin/edit-customer.php';
    }

    public function handle_delete()
    {
        if (!isset($_GET['action']) || $_GET['action'] !== 'delete') {
            return;
        }

        if (!isset($_GET['_wpnonce']) || !wp_verify_nonce($_GET['_wpnonce'], 'cmp_delete_customer')) {
            wp_die('Security check failed');
        }

        if (!current_user_can('manage_options')) {
            wp_die('Unauthorized');
        }

        global $wpdb;
        $table = $wpdb->prefix . 'cmp_customers';
        $id = intval($_GET['id']);

        $wpdb->delete($table, ['id' => $id]);

        wp_redirect(admin_url('admin.php?page=customer-manager&msg=deleted'));
        exit;
    }
}

new Customer_Admin_Menu();