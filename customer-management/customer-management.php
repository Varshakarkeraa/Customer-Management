<?php

/**
 * Plugin Name: Customer Management
 * Description: Custom plugin to manage customers with admin CRUD and frontend listing.
 * Version: 1.0
 * Author: Your Name
 */

// Security: prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Include files
require_once plugin_dir_path(__FILE__) . 'includes/class-activator.php';
require_once plugin_dir_path(__FILE__) . 'includes/class-admin-menu.php';
require_once plugin_dir_path(__FILE__) . 'includes/class-crud-handler.php';
require_once plugin_dir_path(__FILE__) . 'includes/class-shortcode.php';
require_once plugin_dir_path(__FILE__) . 'includes/class-ajax.php';

// Create database table when plugin activates
register_activation_hook(__FILE__, ['Customer_Activator', 'activate']);

add_action('wp_enqueue_scripts', 'cmp_scripts');
function cmp_scripts()
{
    wp_enqueue_script(
        'cmp-ajax-js',
        plugin_dir_url(__FILE__) . 'assets/cmp-ajax.js',
        ['jquery'],
        false,
        true
    );

    wp_localize_script('cmp-ajax-js', 'cmp_ajax_obj', [
        'ajax_url' => admin_url('admin-ajax.php')
    ]);
}

function cmp_calculate_age($dob)
{
    if (!$dob || $dob == "0000-00-00") return '';

    try {
        $birthdate = new DateTime($dob);
        $today = new DateTime();
        return $today->diff($birthdate)->y;
    } catch (Exception $e) {
        return '';
    }
}

add_action('admin_enqueue_scripts', 'cmp_admin_assets');
function cmp_admin_assets($hook)
{

    // Load CSS only on our plugin pages
    if (
        $hook === 'toplevel_page_customer-manager' ||
        $hook === 'customer-manager_page_add-customer' ||
        $hook === 'customer-manager_page_edit-customer'
    ) {
        wp_enqueue_style(
            'cmp-admin-css',
            plugin_dir_url(__FILE__) . 'assets/css/admin.css'
        );
    }
}

add_action('wp_enqueue_scripts', 'cmp_frontend_assets');
function cmp_frontend_assets()
{
    wp_enqueue_style(
        'cmp-frontend-css',
        plugin_dir_url(__FILE__) . 'assets/css/admin.css'
    );
}