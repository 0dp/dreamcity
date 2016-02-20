<?php

// registration form fields
function dc_registration_form_fields() {
 
	ob_start(); ?>	
		<h3 class="dc_header"><?php _e('Register New Account'); ?></h3>
 
		<?php 
		// show any error messages after form submission
		dc_show_error_messages(); ?>
 
		<form id="dc_registration_form" class="dc_form" action="" method="POST">
			<fieldset>
				<p>
					<label for="dc_user_Login"><?php _e('Username'); ?></label>
					<input name="dc_user_login" id="dc_user_login" class="required" type="text"/>
				</p>
				<p>
					<label for="dc_user_email"><?php _e('Email'); ?></label>
					<input name="dc_user_email" id="dc_user_email" class="required" type="email"/>
				</p>
				<p>
					<label for="dc_user_first"><?php _e('First Name'); ?></label>
					<input name="dc_user_first" id="dc_user_first" type="text"/>
				</p>
				<p>
					<label for="dc_user_last"><?php _e('Last Name'); ?></label>
					<input name="dc_user_last" id="dc_user_last" type="text"/>
				</p>
				<p>
					<label for="password"><?php _e('Password'); ?></label>
					<input name="dc_user_pass" id="password" class="required" type="password"/>
				</p>
				<p>
					<label for="password_again"><?php _e('Password Again'); ?></label>
					<input name="dc_user_pass_confirm" id="password_again" class="required" type="password"/>
				</p>
				<p>
					<input type="hidden" name="dc_register_nonce" value="<?php echo wp_create_nonce('dc-register-nonce'); ?>"/>
					<input type="submit" value="<?php _e('Register Your Account'); ?>"/>
				</p>
			</fieldset>
		</form>
	<?php
	return ob_get_clean();
}

?>