<?php

//include( plugin_dir_path( __FILE__ ) . 'signup/form.php');
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
			//$output = "hejk";
		} else {
			$output = __('User registration is not enabled');
		}
		return $output;
	}
}
add_shortcode('register_form', 'dc_registration_form');


// registration form fields
function dc_registration_form_fields() {
 
	ob_start(); ?>	
		<h3 class="rf4000-bold"><?php _e('Register New Account'); ?></h3>
 
		<?php 
		// show any error messages after form submission
		//dc_show_error_messages(); ?>
 
		<form id="dc_registration_form" class="dc_form" action="" method="POST">
			<fieldset>
				<div class="form-group">
					<label for="dc_user_Login"><?php _e('Username'); ?></label>
					<input name="dc_user_login" id="dc_user_login" class="form-control required" placeholder="Username" type="text"/>
				</div>
				<div class="form-group">
					<label for="dc_user_email"><?php _e('Email'); ?></label>
					<input name="dc_user_email" id="dc_user_email" class="form-control required" type="email"/>
				</div>
				<div class="form-group">
					<label for="dc_user_first"><?php _e('First Name'); ?></label>
					<input name="dc_user_first" id="dc_user_first" class="form-control" type="text"/>
				</div>
				<div class="form-group">
					<label for="dc_user_last"><?php _e('Last Name'); ?></label>
					<input name="dc_user_last" id="dc_user_last" class="form-control" type="text"/>
				</div>
				<div class="form-group">
					<label for="password"><?php _e('Password'); ?></label>
					<input name="dc_user_pass" id="password" class="form-control required" type="password"/>
				</div>
				<div class="form-group">
					<label for="password_again"><?php _e('Password Again'); ?></label>
					<input name="dc_user_pass_confirm" id="password_again" class="form-control required" type="password"/>
				</div>
				<div class="form-group">
					<input type="hidden" name="dc_register_nonce" value="<?php echo wp_create_nonce('dc-register-nonce'); ?>"/>
					<input type="submit" value="<?php _e('Register Your Account'); ?>"/>
				</div>
			</fieldset>
		</form>
	<?php
	return ob_get_clean();
}

?>
