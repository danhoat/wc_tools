<?php
function check_role_exists($role){

	$check  =  $GLOBALS['wp_roles']->is_role( $role );
	return $check
}