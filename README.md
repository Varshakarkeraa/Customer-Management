# Customer Management Plugin

## Installation
1. Upload the `customer-management-plugin` folder to `wp-content/plugins/`.
2. Activate the plugin in WordPress admin.

## Features
- Add/Edit/Delete/View customer records
- Pagination & Search in admin
- shortcode `[active_customers]` with AJAX pagination & search

## Shortcode Usage
- Place `[active_customers]` in any page or post
- Active customers will display with pagination & search

## Developer Notes
- Custom database table: `wp_cmp_customers`
- Age is calculated dynamically based on DOB
- Email uniqueness check for WordPress user creation

## Dummy Data
- Included in `SQL_dump.sql`
