<?php
if (!defined('ABSPATH')) exit;

class CMP_Ajax
{

    public function __construct()
    {
        add_action('wp_ajax_cmp_fetch_customers', [$this, 'fetch_customers']);
        add_action('wp_ajax_nopriv_cmp_fetch_customers', [$this, 'fetch_customers']);
    }

    public function fetch_customers()
    {

        global $wpdb;
        $table = $wpdb->prefix . 'cmp_customers';

        $search = isset($_POST['search']) ? sanitize_text_field($_POST['search']) : '';
        $page   = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $limit  = 5;
        $offset = ($page - 1) * $limit;

        // search filter
        $where = "WHERE status = 'active'";

        if (!empty($search)) {
            $like = '%' . $wpdb->esc_like($search) . '%';
            $where .= $wpdb->prepare(
                " AND (name LIKE %s OR email LIKE %s OR phone LIKE %s OR city LIKE %s)",
                $like,
                $like,
                $like,
                $like
            );
        }

        // total
        $total = $wpdb->get_var("SELECT COUNT(*) FROM $table $where");

        // data
        $customers = $wpdb->get_results(
            $wpdb->prepare(
                "SELECT *, TIMESTAMPDIFF(YEAR, dob, CURDATE()) AS age
         FROM $table
         $where
         ORDER BY name ASC
         LIMIT %d OFFSET %d",
                $limit,
                $offset
            )
        );


        wp_send_json([
            'data'        => $customers,
            'total_pages' => ceil($total / $limit),
            'page'        => $page
        ]);

        wp_die();
    }
}

new CMP_Ajax();