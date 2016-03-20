<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

include( plugin_dir_path( __FILE__ ) . 'form.php');

//
// FORM PROCESSING EXCLUDED POST NOT WORKING TODO!!!!!!
//

//include( plugin_dir_path( __FILE__ ) . 'processing.php');


// user registration login form
function dc_registration_form() {
 
	// only show the registration form to non-logged-in members
	if(!is_user_logged_in()) {
 
 
		// check to make sure user registration is enabled
		// make check if allowd in dreamcity
		$registration_enabled = get_option('users_can_register');
 
		// only show the registration form if allowed
		if($registration_enabled) {
			$output = dc_registration_form_fields();
		} else {
			$output = __('User registration is not enabled');
		}
		return $output;
	}
	else {
		echo 'show login then registration';
	}
}
add_shortcode('register_form', 'dc_registration_form');


?>
