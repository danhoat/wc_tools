<?php 

Class WC_Tools_Admin{

    function __construct(){
        
        add_action( 'admin_menu', array($this, 'add_tool_menu'), 100 );
        add_action( 'admin_enqueue_scripts', array($this,'add_tool_style') );
   
    }

     function add_tool_style() {
        wp_enqueue_style( 'wc-tools-style', plugins_url('tools.css', __FILE__) );
    }

    function add_tool_menu() {

        $menu_title = 'Tools';
        add_submenu_page( 'woocommerce', __( 'WooCommerce extensions', 'woocommerce' ), $menu_title, 'manage_woocommerce', 'wc-tools', array($this,'tools_page')  );
    }
    function genera_sample_data(){

        $userdata = array(
            'user_email'            => 'vendor@gmail.com',   
            'first_name'            => 'Test ',  
            'last_name'             => 'Vendor',  
            'user_login'            => 'test',
            'role'                  => 'vendor',
            'user_pass'             => '123456',
        );  

        // Create User with vendor role.
        // should call check vendor role by check_role_exists 
        $user_id = wp_insert_user($userdata);

        $userdata = array(
            'user_email'            => 'pending@gmail.com',   
            'first_name'            => 'Pending ',  
            'last_name'             => 'Vendor',  
            'role'                  => 'pending_vendor',
            'user_login'            => 'pending',
            'user_pass'             => '123456',
        );  
        // Create User with pending_vendor role.
        $user_id = wp_insert_user($userdata);

        $this->insert_product();
        update_option('generate_sample_data', 1);
    }
    function insert_product(){

        $data = array(
            'post_title'   => "Simple product 1",
            'post_content' => "Simple product  content goes here…",
            'post_status'  => "publish",
            'post_excerpt' => "product excerpt content…",
            'post_type'    => "product"
        );

        // create a simple product
        $simple_p_id = wp_insert_post( $data );
        wp_set_object_terms ($simple_p_id,'simple','product_type');
        update_post_meta($simple_p_id,'_regular_price', 100);
        update_post_meta( $simple_p_id, '_stock', '100');
        update_post_meta($simple_p_id,'_manage_stock','yes');
        update_post_meta( $simple_p_id, '_sku', "skusimple1");

        $post = array(
            'post_title'   => "Product with Variations 2",
            'post_content' => "product post content goes here…",
            'post_status'  => "publish",
            'post_excerpt' => "product excerpt content…",
            'post_name'    => "test_prod_vars2", //name/slug
            'post_type'    => "product"
        );

        //Create product/post:
        $new_product_id = wp_insert_post( $post );
        //make product type be variable:
        wp_set_object_terms ($new_product_id,'variable','product_type');
        $avail_attributes = array(
            '2xl',
            'xl',
            'lg',
            'md',
            'sm'
        );
        wp_set_object_terms($new_product_id, $avail_attributes, 'pa_size');

        $thedata = Array('pa_size'=>Array(
            'name'=>'pa_size',
            'value'=>'',
            'is_visible' => '1', 
            'is_variation' => '1',
            'is_taxonomy' => '1'
        ));
        update_post_meta( $new_product_id,'_product_attributes',$thedata);


        //set product values:
        update_post_meta($new_product_id,'_manage_stock','yes');
        update_post_meta( $new_product_id, '_stock_status', 'instock');
        update_post_meta( $new_product_id, '_weight', "0.06" );
        update_post_meta( $new_product_id, '_sku', "skutest1");
        update_post_meta( $new_product_id, '_stock', "100" );
        update_post_meta( $new_product_id, '_visibility', 'visible' );
    }
    

    function tools_page() { 


        $inserted = get_option('generate_sample_data', 0);

        if( isset($_POST['genera_sample']) && !$inserted ){
            $this->genera_sample_data();
        } ?>

        <div class="top-bar">
           <h1> <?php _e('Tools','wc_tool');?></h1>
        </div>

        <div class="wp-header-end"></div>

        <div class="wrap">
           
            <div class="marketplace-content-wrapper">
               
                <?php if( !$inserted){?>
                <form method="POST">
                   <input type="hidden" name="genera_sample" value="1">
                   <label><?php _e('Click this button to generate sample data','wc_tool');?></label>
                    <button type="submit" class="btn-tool"> <?php _e('Generate Sample Data','wc_tool');?> </button>
               </form>
               <?php } else { ?>
                <?php _e('Sample data was inserted','wc_test');?>
               <?php } ?>
            </div>
        </div>
        <?php

    }

}
new WC_Tools_Admin();