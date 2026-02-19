<?php
if (!defined('ABSPATH')) exit;

class CMP_Shortcode
{

    public function __construct()
    {
        add_shortcode('active_customers', [$this, 'render_shortcode']);
    }

    public function render_shortcode($atts)
    {
        ob_start(); // capture output

        include plugin_dir_path(__FILE__) . '../templates/frontend-list.php';

        return ob_get_clean(); // return output
    }
}

new CMP_Shortcode();