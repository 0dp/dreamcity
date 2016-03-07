<?php

// registration form fields
function dc_registration_form_fields() {
 
	ob_start(); ?>	
		<h3 class="dc_header"><?php _e('Register New Account'); ?></h3>
		<p>Only one person from your camp should sign up. You will be the contact person!<br/>
			You'll receive a confirmation on email that we have received you application at which point we will evalutate it.<br/>
			If your project is confirmed you will receive login credentials for the website.
 
		<?php 
		// show any error messages after form submission
		//dc_show_error_messages(); ?>
 
		<form id="dc_registration_form" class="dc_form" action="" method="POST">
			<fieldset>
				<p>
					<label for="dc_user_email"><?php _e('Email'); ?></label>
					<input name="dc_user_email" id="dc_user_email" class="form-control required" Placeholder="Email" type="email"/>
				</p>
				<p>
					<label for="dc_user_first"><?php _e('First Name'); ?></label>
					<input name="dc_user_first" id="dc_user_first" class="form-control" placeholder="First Name" type="text"/>
				</p>
				<p>
					<label for="dc_user_last"><?php _e('Last Name'); ?></label>
					<input name="dc_user_last" id="dc_user_last" class="form-control" placeholder="Last Name" type="text"/>
				</p>
				<p>
					<label for="dc_user_phone"><?php _e('Phone #'); ?></label>
					<input name="dc_user_phone" id="dc_user_phone" placeholder="Phone Number" class="form-control" type="tel"/>
				</p>
				<p>
					<label for="dc_user_camp_name"><?php _e('Camp Name / Project Title'); ?></label>
					<input name="dc_user_camp_name" id="dc_user_camp_name" class="form-control" placeholder="Camp Name / Project Title" type="text"/>
				</p>
				<p>
					<label for="dc_user_participants"><?php _e('How many people will participate in your camp/project'); ?></label>
					<input name="dc_user_participants" id="dc_user_participants" class="form-control"  placeholder="Participants" type="text"/>
				</p>
				<p>
					<label for="dc_user_project_desc"><?php _e('Project description - Include one sentence that describes your gift to Dream City 2016 (This will be used for press, website etc., in case you change your project to some degree, please send an updated description to dreamcity@roskilde-festival.dk)'); ?></label>
					<textarea rows="3" name="dc_user_project_desc" id="dc_user_project_desc" class="form-control" placeholder="Project Description" type="text"></textarea>
				</p>
				<p>
					<!-- Should we not have file submission here and/or have it sent to byg_dc? -->
					<label for="dc_user_project_construction"><?php _e('Does your project include any construction work? (If yes, please send a description and drawing/picture to illustrate your concept to bygdc@roskilde-festival.dk)'); ?></label>
					<textarea rows="3" name="dc_user_project_construction" id="dc_user_project_construction" class="form-control" placeholder="Contruction Plans" type="text"></textarea>
				</p>
				<p class="no-pad">
				    <label for="checkbox"><?php _e('On what date do you wish to participate in the mandatory security workshop? (choose at least one)'); ?></label>

				<div class="checkbox">
					<label>
					    <input type="checkbox" name="optionsRadios" id="optionsRadios1" value="option1" >
						Thursday ??. March @ 17.00-20-00
					</label>
				</div>
				<div class="checkbox">
				 	<label>
				    	<input type="checkbox" name="optionsRadios" id="optionsRadios2" value="option2" >
						Wednesday 30. March @ 17.00-20-00
					</label>
				</div>	
				<div class="checkbox">
				 	<label>
				    	<input type="checkbox" name="optionsRadios" id="optionsRadios3" value="option3" >
						Sunday 3. April @ 13.00-17.00
					</label>
				</div>
				<div class="checkbox">
					<label>
				    	<input type="checkbox" name="optionsRadios" id="optionsRadios4" value="option4" >
						Sunday 10. April @ 13.00-17.00
					</label>
				</div>
				</p>					
				<p>
					<input type="hidden" name="dc_register_nonce" value="<?php echo wp_create_nonce('dc-register-nonce'); ?>"/>
					<input type="submit" class="btn btn-default" value="<?php _e('Register Your Account'); ?>"/>
				</p>
			</fieldset>
		</form>
	<?php
	return ob_get_clean();
}

function dc_add_new_dreamer() {
    global $wpdb, $new_user_id, $user_login, $user_email, $user_first, $user_last, $camp_phone, $camp_name, $camp_name, $camp_pat_no, $camp_pro_desc, $camp_pro_cons, $camp_workshop;

    if (isset( $_POST["dc_user_email"] ) && wp_verify_nonce($_POST['dc_register_nonce'], 'dc-register-nonce')) {
    $user_login    = $_POST["dc_user_email"];  
    $user_email    = $_POST["dc_user_email"];
    $user_first    = $_POST["dc_user_first"];
    $user_last     = $_POST["dc_user_last"];
    $camp_phone    = $_POST["dc_user_phone"];
    $camp_name     = $_POST["dc_user_camp_name"];
    $camp_pat_no   = $_POST["dc_user_participants"];
    $camp_pro_desc = $_POST["dc_user_project_desc"];
    $camp_pro_cons = $_POST["dc_user_project_construction"];
    $camp_workshop = $_POST["optionsRadios"];

    //FINISH CHECKS

    // this is required for username checks
    // require_once(ABSPATH . WPINC . '/registration.php');
 
    // if(username_exists($user_login)) {
    //   // Username already registered
    //   dc_errors()->add('username_unavailable', __('Username already taken'));
    // }
    // if(!validate_username($user_login)) {
    //   // invalid username
    //   dc_errors()->add('username_invalid', __('Invalid username'));
    // }
    // if($user_login == '') {
    //   // empty username
    //   dc_errors()->add('username_empty', __('Please enter a username'));
    // }
    // if(!is_email($user_email)) {
    //   //invalid email
    //   dc_errors()->add('email_invalid', __('Invalid email'));
    // }
    // if(email_exists($user_email)) {
    //   //Email address already registered
    //   dc_errors()->add('email_used', __('Email already registered'));
    // }
    //if($user_pass == '') {
      // passwords do not match
     // dc_errors()->add('password_empty', __('Please enter a password'));
    //}
    //if($user_pass != $pass_confirm) {
      // passwords do not match
      //dc_errors()->add('password_mismatch', __('Passwords do not match'));
    //}
 
   // $errors = dc_errors()->get_error_messages();
    $errors = '';
 
    // only create the user in if there are no errors
    if(empty($errors)) {
 
        $new_user_id = wp_insert_user(array(
          'user_login'    => $user_login,
          //'user_pass'     => $user_pass,
          'user_email'    => $user_email,
          'first_name'    => $user_first,
          'last_name'     => $user_last,
          'user_registered' => date('Y-m-d H:i:s'),
          'role'        => 'dreamer'
        )
      );

        //insert into wp_dc_camp
        // camp_id mediumint(9) NOT NULL AUTO_INCREMENT,
        // user_id int(10) NOT NULL,
        // camp_name text(100) NOT NULL, 
        // camp_description text NOT NULL,
        // camp_url varchar(70) DEFAULT '' NOT NULL,
        // camp_imageURL varchar(100) DEFAULT '' NOT NULL,
        // camp_iconURL varchar(100) DEFAULT '' NOT NULL,
        // camp_residents smallint(9) DEFAULT 0 NOT NULL,
        // camp_notes text DEFAULT NULL,
        // camp_registration_date datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
        // camp_modified datetime DEFAULT '0000-00-00 00:00:00' NULL,
        function dc_new_camp() {
            global $wpdb, $new_user_id, $camp_name, $camp_phone, $camp_pro_desc, $camp_pat_no, $camp_pro_cons;
            $table_name = $wpdb->prefix . 'dc_camp';

            $wpdb->insert( 
                $table_name, 
                array(
                    'user_id'                => $new_user_id,
                    'camp_name'              => $camp_name,
                    'camp_phone'             => $camp_phone,
                    'camp_description'       => $camp_pro_desc,
                    'camp_residents'         => $camp_pat_no,
                    'camp_construction'      => $camp_pro_cons,
                    'camp_registration_date' => current_time( 'mysql' ), 
                ) 
            );

//print_r($new_user_id);
        }
        dc_new_camp();
    if($new_user_id) {
        // send an email to the admin alerting them of the registration
        wp_new_user_notification($new_user_id);
 
        // log the new user in
        //wp_setcookie($user_login, $user_pass, true);
        //wp_set_current_user($new_user_id, $user_login); 
        //do_action('wp_login', $user_login);
 
        // send the newly created user to the home page after logging them in and add a confirmation message
        wp_redirect(home_url() . '?state=success'); exit;
      }
 
    }
 
  }
}
add_action('init', 'dc_add_new_dreamer');
?>