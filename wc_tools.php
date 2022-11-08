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

define('WC_TOOL_PATH',dirname( __FILE__ ));

require('functions.php');


/** WXR_Parser class */
require_once dirname( __FILE__ ) . '/parsers/class-wxr-parser.php';

/** WXR_Parser_SimpleXML class */
require_once dirname( __FILE__ ) . '/parsers/class-wxr-parser-simplexml.php';

/** WXR_Parser_XML class */
require_once dirname( __FILE__ ) . '/parsers/class-wxr-parser-xml.php';

/** WXR_Parser_Regex class */
require_once dirname( __FILE__ ) . '/parsers/class-wxr-parser-regex.php';



function wc_tool_init(){

    require_once ABSPATH . 'wp-admin/includes/import.php';

    if ( ! class_exists( 'WP_Importer' ) ) {
        $class_wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
        if ( file_exists( $class_wp_importer ) ) {
            require $class_wp_importer;
        }
    }


    if( !class_exists('WP_Import') ){
      require('class_wp_import.php');
    }
    require('wc_tools_admin.php');
}

add_action('after_setup_theme','wc_tool_init');



function wc_tools_activated() {

}

function wc_tools_deactivated() {
	update_option('generate_sample_data',0);
}


register_activation_hook( __FILE__, 'wc_tools_activated' );
register_deactivation_hook( __FILE__, 'wc_tools_deactivated' );



