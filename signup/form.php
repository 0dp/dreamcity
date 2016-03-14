<?php

function dc_process_reg_form(){
	
	$Ok = false;
	
	if (isset( $_POST["dc_user_email"] ) && wp_verify_nonce($_POST['dc_register_nonce'], 'dc-register-nonce')) 
	{
		$user_login     = $_POST["dc_user_email"];  
		$user_email     = $_POST["dc_user_email"];
		$user_first     = $_POST["dc_user_first"];
		$user_last      = $_POST["dc_user_last"];
		$camp_phone     = $_POST["dc_user_phone"];
		$camp_name      = $_POST["dc_user_camp_name"];
		$camp_pat_no    = $_POST["dc_user_participants"];
		$camp_pro_desc  = $_POST["dc_user_project_desc"];
		$camp_pro_cons  = $_POST["dc_user_project_construction"];
		$camp_workshop1 = $_POST["optionsRadios1"];
		$camp_workshop2 = $_POST["optionsRadios2"];
		$camp_workshop3 = $_POST["optionsRadios3"];
		$camp_workshop4 = $_POST["optionsRadios4"];
		
		if( isset( $_POST["optionsRadios1"]) )
			$camp_workshop1 = $_POST["optionsRadios1"];
		if( isset( $_POST["optionsRadios2"] ))
			$camp_workshop2 = $_POST["optionsRadios2"];
		if( isset( $_POST["optionsRadios3"] ))
			$camp_workshop3 = $_POST["optionsRadios3"];
		if( isset( $_POST["optionsRadios4"] ))
			$camp_workshop4 = $_POST["optionsRadios4"];		
		
		$camp = new DreamCityCamp($user_login, $user_first, $user_last, $user_email, $camp_phone, $camp_name,$camp_pro_desc, $camp_pro_cons, $camp_pat_no, $camp_workshop1, $camp_workshop2, $camp_workshop3, $camp_workshop4);
		if( $camp->HasError() ){
					
		}
		else if( !$camp->AddCampToDatabase() ){			
			// Show an error?		
		}else{
			
			//wp_new_user_notification($camp->user_id,'', 'both'); 
			// log the new user in
			//wp_setcookie($user_login, $user_pass, true);
			//wp_set_current_user($new_user_id, $user_login); 
			//do_action('wp_login', $user_login); 
			// send the newly created user to the home page after logging them in and add a confirmation message
			
			$to = $camp->user_email;
			$message = sprintf( 'Hey [%s]. We have reveiced your registration. Oncer we have reviewed it we will get back to you. \n\n Dream On', $camp->camp_name, ENT_QUOTES );
			$subject = "Welcome to Dream City";
			
			wp_mail( $to, $subject, $message, dc_email_header() );
			
			$Ok = true;
			
			//wp_redirect(home_url() . '?state=success'); exit;
		}
	}	
	
	return $Ok;	
}


// registration form fields
function dc_registration_form_fields() {
	ob_start(); 
	$process = false;
	$result = false;
	
	if (isset( $_POST["dc_user_email"] ) && wp_verify_nonce($_POST['dc_register_nonce'], 'dc-register-nonce')){
		$process = true;		
		$result = dc_process_reg_form();		
	}
	
	if ( $process && $result ) { 
            echo '<div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Success!</strong> You have now applied for Dreamcity 2016</div>';
    }		
	else
	{
		if( $process ) { 
            echo '<div class="alert alert-warning alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Fail!</strong>Your registration is not valid</div>';
        }
	?>	
		<h3 class="dc_header"><?php _e('New Dreamer Registration'); ?></h3>
		<p>
			Only one person from your camp should sign up. You will be the contact person!<br/>
			You'll receive a confirmation on email that we have received you application at which point we will evalutate it.<br/>
			If your project is confirmed you will receive login credentials for the website.
		</p>
 
		<form id="dc_registration_form" class="dc_form" action="http://dream-city.dk/test-side/" method="POST" enctype="multipart/form-data">
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

                <p>
                <label for="dc_camp_logo">
                    <?php _e('Camp Logo - Please upload your camps logo. 300x300px preferably, png or jpg, max file size is 500kb'); ?>
                </label>

                <input type="file" name="dc_camp_logo" id="dc_camp_logo"  multiple="false" />
                <input type="hidden" name="post_id" id="post_id" value="55" />
                <?php wp_nonce_field( 'dc_camp_logo', 'dc_camp_logo_nonce' ); ?>
                </p>
				<p>
                <label for="dc_camp_img">
                    <?php _e('Camp Image - Please upload your camps Image. png or jpg, max file size is 500kb'); ?>
                </label>

                <input type="file" name="dc_camp_img" id="dc_camp_img"  multiple="false" />
                <input type="hidden" name="post_id" id="post_id" value="55" />
                <?php wp_nonce_field( 'dc_camp_img', 'dc_camp_img_nonce' ); ?>
                </p>
					<label for="dc_user_project_construction"><?php _e('Does your project include any construction work? (If yes, please send a description and drawing/picture to illustrate your concept to bygdc@roskilde-festival.dk)'); ?></label>
					<textarea rows="3" name="dc_user_project_construction" id="dc_user_project_construction" class="form-control" placeholder="Contruction Plans" type="text"></textarea>
				</p>
				<p class="no-pad">
				    <label for="checkbox"><?php _e('On what date do you wish to participate in the mandatory security workshop? (choose at least one)'); ?></label>

				<div class="checkbox">
					<label>
					    <input type="checkbox" name="optionsRadios1" id="optionsRadios1" value="Thursday 17. March" >
						Thursday 17. March @ 17.00-20-00
					</label>
				</div>
				<div class="checkbox">
				 	<label>
				    	<input type="checkbox" name="optionsRadios2" id="optionsRadios2" value="Wednesday 30. March" >
						Wednesday 30. March @ 17.00-20-00
					</label>
				</div>	
				<div class="checkbox">
				 	<label>
				    	<input type="checkbox" name="optionsRadios3" id="optionsRadios3" value="Sunday 3. April" >
						Sunday 3. April @ 13.00-17.00
					</label>
				</div>
				<div class="checkbox">
					<label>
				    	<input type="checkbox" name="optionsRadios4" id="optionsRadios4" value="Sunday 10. April" >
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
	} // end top else
	return ob_get_clean();
}

//add_action('init', 'dc_process_reg_form');
?>