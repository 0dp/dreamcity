<?php

// registration form fields
function dc_registration_form_fields() {
 
	ob_start(); ?>	
		<h3 class="dc_header"><?php _e('Register New Account'); ?></h3>
		<p>Only one person from your camp should sign up. You will be the contact person!<br/>
			You receive a confirmation on email that we have received you application at which point we will evalutate it.<br/>
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
				<p>
					<label for="password">'Password'</label>
					<input name="dc_user_pass" id="password" class="form-control required" placeholder="Password" type="password"/>
				</p>
				<p>
					<label for="password_again"><?php _e('Password Again'); ?></label>
					<input name="dc_user_pass_confirm" id="password_again" class="form-control placeholder="Password Again" required" type="password"/>
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
?>