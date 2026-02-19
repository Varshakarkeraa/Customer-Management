<?php
// Security check
if (!defined('ABSPATH')) exit;

global $wpdb;
$table = $wpdb->prefix . 'cmp_customers';

// If form submitted
if (isset($_POST['cmp_add_customer'])) {

    $name     = sanitize_text_field($_POST['name']);
    $email    = sanitize_email($_POST['email']);
    $phone    = sanitize_text_field($_POST['phone']);
    $dob      = sanitize_text_field($_POST['dob']);
    $gender   = sanitize_text_field($_POST['gender']);
    $cr       = sanitize_text_field($_POST['cr_number']);
    $address  = sanitize_text_field($_POST['address']);
    $city     = sanitize_text_field($_POST['city']);
    $country  = sanitize_text_field($_POST['country']);
    $status   = sanitize_text_field($_POST['status']);

    // 1. Check if email already exists in WordPress users
    if (email_exists($email)) {
        echo "<div class='error'><p>Email already exists as WP user!</p></div>";
    } else {
        // 2. Create new WordPress user
        $user_id = wp_create_user($email, $phone, $email);
        wp_update_user(['ID' => $user_id, 'role' => 'contributor']);

        // 3. Insert into custom table
        $wpdb->insert($table, [
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'dob' => $dob,
            'gender' => $gender,
            'cr_number' => $cr,
            'address' => $address,
            'city' => $city,
            'country' => $country,
            'status' => $status
        ]);

        echo "<div class='updated'><p>Customer Added Successfully!</p></div>";
    }
}
?>

<h2>Add Customer</h2>

<form method="post">
    <table class="form-table">

        <tr>
            <th>Name</th>
            <td><input type="text" name="name" required></td>
        </tr>
        <tr>
            <th>Email</th>
            <td><input type="email" name="email" required></td>
        </tr>
        <tr>
            <th>Phone</th>
            <td><input type="number" name="phone" required></td>
        </tr>
        <tr>
            <th>Date of Birth</th>
            <td><input type="date" name="dob" required></td>
        </tr>

        <tr>
            <th>Gender</th>
            <td>
                <select name="gender">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
            </td>
        </tr>

        <tr>
            <th>CR Number</th>
            <td><input type="text" name="cr_number" required></td>
        </tr>
        <tr>
            <th>Address</th>
            <td><input type="text" name="address"></td>
        </tr>
        <tr>
            <th>City</th>
            <td><input type="text" name="city"></td>
        </tr>
        <tr>
            <th>Country</th>
            <td><input type="text" name="country"></td>
        </tr>

        <tr>
            <th>Status</th>
            <td>
                <select name="status">
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </td>
        </tr>

    </table>

    <input type="submit" name="cmp_add_customer" class="button-primary" value="Add Customer">
</form>