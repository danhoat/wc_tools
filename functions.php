<?php

function check_role_exists($role){

	$check  =  $GLOBALS['wp_roles']->is_role( $role );
	return $check;
}

function wc_log($input){

	$log_file = WP_CONTENT_DIR.'/log.log';
	if( is_array($input) || is_object( $input ) ){
		error_log( print_r($input, TRUE), 3, $log_file );
	}else {
		error_log($input . "\n" , 3, $log_file);
	}

}