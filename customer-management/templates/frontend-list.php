<?php
if (!defined('ABSPATH')) exit;

global $wpdb;
$table = $wpdb->prefix . 'cmp_customers';

// Pagination
$items_per_page = 5;
$page = isset($_GET['cpage']) ? max(1, intval($_GET['cpage'])) : 1;
$offset = ($page - 1) * $items_per_page;

// Count total active customers
$total = $wpdb->get_var("SELECT COUNT(*) FROM $table WHERE status='active'");

// Fetch data
$customers = $wpdb->get_results(
    $wpdb->prepare(
        "SELECT * FROM $table WHERE status='active' ORDER BY name ASC LIMIT %d OFFSET %d",
        $items_per_page,
        $offset
    )
);

?>
<div class="container mt-5 mb-5 customer-table ">


    <input type="text" id="cmp-search" placeholder="Search customers..." style="width: 300px;">

    <table border="1" width="100%" cellpadding="8" class="mt-3">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>DOB</th>
                <th>Age</th>
                <th>City</th>
                <th>Country</th>
            </tr>
        </thead>
        <tbody id="cmp-table-body">
            <tr>
                <td colspan="6">Loading...</td>
            </tr>
        </tbody>
    </table>

    <div id="cmp-pagination" style="margin-top:15px;"></div>
</div>