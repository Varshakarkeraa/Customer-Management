<?php

if (!defined('ABSPATH')) exit;

global $wpdb;
$table = $wpdb->prefix . 'cmp_customers';

// ---------------------------
// SEARCH
// ---------------------------
$search = isset($_GET['s']) ? sanitize_text_field($_GET['s']) : '';

$where = "";
if (!empty($search)) {
    $like = '%' . $wpdb->esc_like($search) . '%';
    $where = $wpdb->prepare(
        "WHERE name LIKE %s OR email LIKE %s OR phone LIKE %s OR cr_number LIKE %s",
        $like,
        $like,
        $like,
        $like
    );
}

// ---------------------------
// PAGINATION SETTINGS
// ---------------------------
$items_per_page = 10;
$page = isset($_GET['paged']) ? max(1, intval($_GET['paged'])) : 1;
$offset = ($page - 1) * $items_per_page;

// Count total
$total_items = $wpdb->get_var("SELECT COUNT(*) FROM $table $where");

// Fetch data
$customers = $wpdb->get_results(
    $wpdb->prepare(
        "SELECT * FROM $table $where ORDER BY id DESC LIMIT %d OFFSET %d",
        $items_per_page,
        $offset
    )
);

// Calculate total pages
$total_pages = ceil($total_items / $items_per_page);

// ---------------------------
// SERIAL NUMBER START
// ---------------------------
$serial = $offset + 1;

?>

<h2>Customer List</h2>

<?php
// Delete success message
if (isset($_GET['msg']) && $_GET['msg'] == 'deleted') {
    echo "<div class='updated'><p>Customer deleted successfully!</p></div>";
}
?>

<!-- SEARCH FORM -->
<form method="get" style="margin-bottom: 15px;">
    <input type="hidden" name="page" value="customer-manager">
    <input type="search" name="s" placeholder="Search customers..." value="<?php echo esc_attr($search); ?>">
    <button class="button">Search</button>
</form>

<table class="wp-list-table widefat fixed striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>DOB</th>
            <th>Age</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>
        <?php if (!empty($customers)) : ?>
        <?php foreach ($customers as $c): ?>
        <tr>
            <td><?= $serial ?></td>
            <td><?= esc_html($c->name) ?></td>
            <td><?= esc_html($c->email) ?></td>
            <td><?= esc_html($c->phone) ?></td>
            <td><?= esc_html($c->dob) ?></td>
            <td><?= cmp_calculate_age($c->dob); ?></td>
            <td><?= esc_html($c->status) ?></td>
            <td>
                <a href="<?php echo admin_url('admin.php?page=edit-customer&id=' . intval($c->id)); ?>">Edit</a> |
                <a href="<?php echo wp_nonce_url(admin_url('admin.php?page=customer-manager&action=delete&id=' . intval($c->id)), 'cmp_delete_customer'); ?>"
                    onclick="return confirm('Are you sure?');">Delete</a>
            </td>
        </tr>
        <?php $serial++;
            endforeach; ?>
        <?php else: ?>
        <tr>
            <td colspan="8">No customers found.</td>
        </tr>
        <?php endif; ?>
    </tbody>
</table>

<!-- PAGINATION -->
<div class="tablenav">
    <div class="tablenav-pages">
        <?php
        echo paginate_links([
            'base' => add_query_arg('paged', '%#%'),
            'format' => '',
            'prev_text' => '«',
            'next_text' => '»',
            'total' => $total_pages,
            'current' => $page
        ]);
        ?>
    </div>
</div>