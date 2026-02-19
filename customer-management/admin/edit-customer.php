<?php
global $wpdb;
$table = $wpdb->prefix . 'cmp_customers';

$id = intval($_GET['id']);
$customer = $wpdb->get_row("SELECT * FROM $table WHERE id = $id");

if ($_POST) {
    $data = [
        'name'      => sanitize_text_field($_POST['name']),
        'email'     => sanitize_email($_POST['email']),
        'phone'     => sanitize_text_field($_POST['phone']),
        'dob'       => $_POST['dob'],
        'gender'    => $_POST['gender'],
        'cr_number' => sanitize_text_field($_POST['cr_number']),
        'address'   => sanitize_textarea_field($_POST['address']),
        'city'      => sanitize_text_field($_POST['city']),
        'country'   => sanitize_text_field($_POST['country']),
    ];

    $wpdb->update($table, $data, ['id' => $id]);

    echo "<div class='updated'><p>Customer updated successfully!</p></div>";
    $customer = (object) array_merge((array)$customer, $data);
}
?>

<div class="wrap">
    <h1>Edit Customer</h1>

    <form method="post">
        <table class="form-table">
            <tr>
                <th>Name</th>
                <td><input type="text" name="name" value="<?php echo $customer->name; ?>" required></td>
            </tr>

            <tr>
                <th>Email</th>
                <td><input type="email" name="email" value="<?php echo $customer->email; ?>" required></td>
            </tr>

            <tr>
                <th>Phone</th>
                <td><input type="text" name="phone" value="<?php echo $customer->phone; ?>"></td>
            </tr>

            <tr>
                <th>Date of Birth</th>
                <td><input type="date" name="dob" value="<?php echo $customer->dob; ?>"></td>
            </tr>

            <tr>
                <th>Age</th>
                <td>
                    <input type="text" value="<?php echo cmp_calculate_age($customer->dob); ?>" readonly>
                </td>
            </tr>

            <tr>
                <th>Gender</th>
                <td>
                    <select name="gender">
                        <option value="male" <?php selected($customer->gender, 'male'); ?>>Male</option>
                        <option value="female" <?php selected($customer->gender, 'female'); ?>>Female</option>
                        <option value="other" <?php selected($customer->gender, 'other'); ?>>Other</option>
                    </select>
                </td>
            </tr>

            <tr>
                <th>CR Number</th>
                <td><input type="text" name="cr_number" value="<?php echo $customer->cr_number; ?>"></td>
            </tr>

            <tr>
                <th>Address</th>
                <td><textarea name="address"><?php echo $customer->address; ?></textarea></td>
            </tr>

            <tr>
                <th>City</th>
                <td><input type="text" name="city" value="<?php echo $customer->city; ?>"></td>
            </tr>

            <tr>
                <th>Country</th>
                <td><input type="text" name="country" value="<?php echo $customer->country; ?>"></td>
            </tr>
        </table>

        <button type="submit" class="button button-primary">Update Customer</button>
    </form>
</div>