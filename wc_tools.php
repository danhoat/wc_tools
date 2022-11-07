<?php
/**
 * Plugin Name: WC tools 
 * Plugin URI: https://abc.com/
 * Description: An eCommerce toolkit that helps insert sample data
 * Version: 1.0
 * Author: danng
 * Author URI: https://danng.com
 * Text Domain: wc_tool
 * Requires at least: 5.8
 * Requires PHP: 7.2
 *
 * @package WooCommerce
 */

require_once('wc_tools_admin.php');


function wctest_activated() {

}

function wctest_deactivated() {
	update_option('generate_sample_data',0);
}


register_activation_hook( __FILE__, 'wctest_activated' );
register_deactivation_hook( __FILE__, 'wctest_deactivated' );



