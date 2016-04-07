<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
$dc_form_success;
$dc_form_message;

// registration form fields
function dc_registration_form_fields() {
	ob_start();	
	global $dc_form_success;
	
	if ( $dc_form_success == "success" ) { 
	?>
            <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Success!</strong> You have now applied for Dreamcity 2016</div>
	<?php
    }		
	else
	{		
		if( $dc_form_success == "error" )
		{	
		?>
            <!--<div class="alert alert-warning alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Fail!</strong>Your registration is not valid</div> -->
            			<?php 
							//wp_redirect('http://dream-city.dk/test-side' . '?state=error', 200); exit; 
							wp_redirect('http://dream-city.dk/become-a-dreamer/registration' . '?state=error', 200); 
							//wp_redirect('http://localhost/wordpress/become-a-dreamer/registration' . '?state=error', 200); 
							exit; 							
						?>		

		<?php
		}
	?>	
		<style>
		.input-group-addon.primary { color: rgb(255, 255, 255); background-color: rgb(50, 118, 177); border-color: rgb(40, 94, 142); } .input-group-addon.success { color: rgb(255, 255, 255); background-color: rgb(92, 184, 92); border-color: rgb(76, 174, 76); } .input-group-addon.info { color: rgb(255, 255, 255); background-color: rgb(57, 179, 215); border-color: rgb(38, 154, 188); } .input-group-addon.warning { color: rgb(255, 255, 255); background-color: rgb(240, 173, 78); border-color: rgb(238, 162, 54); } .input-group-addon.danger { color: rgb(255, 255, 255); background-color: rgb(217, 83, 79); border-color: rgb(212, 63, 58); }
		</style>
		<form id="dc_registration_form" class="dc_form" action="" method="POST" enctype="multipart/form-data">
			<fieldset>
				<p>
					<div class="form-group">
					<label for="dc_user_email"><?php _e('Email'); ?></label>
					<div class="input-group" data-validate="email"> 
					<input name="dc_user_email" id="dc_user_email" class="form-control required" Placeholder="Email" type="email" required/>
					<span class="input-group-addon danger">
						<span class="glyphicon glyphicon-remove">
						</span>
					</span> 
				</div>
			</div>
				</p>
				<p>
					<div class="form-group">
					<label for="dc_user_first" data-validate="length"><?php _e('First Name'); ?></label>
					<div class="input-group" data-validate="length" data-length="3">
					<input name="dc_user_first" id="dc_user_first" class="form-control required" placeholder="First Name" type="text" required/>
					<span class="input-group-addon danger">
						<span class="glyphicon glyphicon-remove">
						</span>
					</span> 
				</div>
			</div>
				</p>
				<p>
					<div class="form-group">
					<label for="dc_user_last" data-validate="length"><?php _e('Last Name'); ?></label>
					<div class="input-group" data-validate="length" data-length="3">
					<input name="dc_user_last" id="dc_user_last" class="form-control required" placeholder="Last Name" type="text" required/>
					<span class="input-group-addon danger">
						<span class="glyphicon glyphicon-remove">
						</span>
					</span> 
				</div>
			</div>
				</p>
				<p>

					<div class="form-group">
					<label for="dc_user_phone" data-validate="phone"><?php _e('Phone #'); ?></label>
					<div class="input-group" data-validate="phone">
					<input name="dc_user_phone" id="dc_user_phone" placeholder="Phone Number required" class="form-control" type="tel" required/>
					<span class="input-group-addon danger">
						<span class="glyphicon glyphicon-remove">
						</span>
					</span> 
					</div>
				</div>
				</p>
				<p>
					<div class="form-group">
					<label for="dc_user_camp_name" data-validate="length"><?php _e('Camp Name / Project Title'); ?></label>
					<div class="input-group" data-validate="length" data-length="3">
					<input name="dc_user_camp_name" id="dc_user_camp_name" class="form-control required" placeholder="Camp Name / Project Title" type="text" required/>
					<span class="input-group-addon danger">
					<span class="glyphicon glyphicon-remove">
					</span>
					</span> 
				</div>
			</div>
				</p>
				<p>
					<div class="form-group">
					<label for="dc_user_participants" data-validate="number"><?php _e('How many people will participate in your camp/project'); ?></label>
					<div class="input-group" data-validate="number">
					<input name="dc_user_participants" id="dc_user_participants" class="form-control required"  placeholder="Participants" type="text" required/>
					<span class="input-group-addon danger">
					<span class="glyphicon glyphicon-remove">
					</span>
					</span> 
				</div>
			</div>					
				</p>
				<p>
					<div style="font-weight: 700; color: #fff; font-family: 'rf4000'; font-size: 1.8rem;"><?php _e('Project description - This needs to include 4 topics from the Dream Up Wheel and the answers to the questions within the topics.'); ?></div></p>
				<p>
					<div class="form-group">
					<label for="dc_user_project_desc_one" data-validate="length"><?php _e('Subject 1'); ?></label>
					<div class="input-group" data-validate="length" data-length="10">
					<textarea rows="3" name="dc_user_project_desc_one" id="dc_user_project_desc_one" class="form-control required" placeholder="1st. Topic from the Dream up Wheel" type="text" required></textarea>
					<span class="input-group-addon danger">
					<span class="glyphicon glyphicon-remove">
					</span>
					</span> 
				</div>
			</div>	
				</p>
			
				<p>
					<div class="form-group">
					<label for="dc_user_project_desc_two" data-validate="length"><?php _e('Subject 2'); ?></label>
					<div class="input-group" data-validate="length" data-length="10">
					<textarea rows="3" name="dc_user_project_desc_two" id="dc_user_project_desc_two" class="form-control required" placeholder="2nd. Topic from the Dream up Wheel" type="text" required></textarea>
					<span class="input-group-addon danger">
					<span class="glyphicon glyphicon-remove">
					</span>
					</span> 
				</div>
			</div>
				</p>

				<p>
					<div class="form-group">
					<label for="dc_user_project_desc_three" data-validate="length"><?php _e('Subject 3'); ?></label>
					<div class="input-group" data-validate="length" data-length="10">
					<textarea rows="3" name="dc_user_project_desc_three" id="dc_user_project_desc_three" class="form-control required" placeholder="3rd. Topic from the Dream up Wheel" type="text" required></textarea>
					<span class="input-group-addon danger">
					<span class="glyphicon glyphicon-remove">
					</span>
					</span> 
				</div>
			</div>
				</p>

				<p>
					<div class="form-group">
					<label for="dc_user_project_desc_four" data-validate="length"><?php _e('Subject 4'); ?></label>
					<div class="input-group" data-validate="length" data-length="10">
					<textarea rows="3" name="dc_user_project_desc_four" id="dc_user_project_desc_four" class="form-control required" placeholder="4th. Topic from the Dream up Wheel" type="text" required></textarea>
					<span class="input-group-addon danger">
					<span class="glyphicon glyphicon-remove">
					</span>
					</span> 
				</div>
			</div>
				</p>
				<p>
					<div class="form-group">
						<label for="dc_user_short_desc" data-validate="length">
							<?php _e('Short project description/teaser for website in English (will be used for press, website etc., in case you change your project to some degree please
send an updated description to dreamcity@roskilde-festival.dk) '); ?>
						</label>
						<div class="input-group" data-validate="length" data-length="10">
							<textarea rows="3" name="dc_user_short_desc" id="dc_user_short_desc" class="form-control required" placeholder="Short camp description" type="text" required></textarea>
							<span class="input-group-addon danger">
								<span class="glyphicon glyphicon-remove">
							</span>
							</span> 
						</div>
					</div>
				</p>

                <p>
                	<div class="form-group">
               			<label for="dc_camp_logo">
                    		<?php _e('Camp Logo - Please upload your camps logo. 300x300px preferably, png or jpg, max file size is 500kb'); ?>
               			</label>
						<div class="input-group" data-validate="file">
                			<input type="file" name="dc_camp_logo" id="dc_camp_logo" class="form-control required" multiple="false" required/>
                			<span class="input-group-addon danger">
								<span class="glyphicon glyphicon-remove">
								</span>
							</span> 
						</div>
					</div>
                	<input type="hidden" name="post_id" id="post_id" value="55" />
               		<?php wp_nonce_field( 'dc_camp_logo', 'dc_camp_logo_nonce' ); ?>
                </p>

				<p>
					<div class="form-group">
               			<label for="dc_camp_img">
                    		<?php _e('Camp Image - Please upload your camps Image. png or jpg, max file size is 500kb'); ?>
                		</label>
						<div class="input-group" data-validate="file">
                			<input type="file" name="dc_camp_img" id="dc_camp_img" class="form-control required" multiple="false" required/>
                			<span class="input-group-addon danger">
								<span class="glyphicon glyphicon-remove">
								</span>
							</span> 
						</div>
					</div>
               		<input type="hidden" name="post_id" id="post_id" value="55" />
                	<?php wp_nonce_field( 'dc_camp_img', 'dc_camp_img_nonce' ); ?>
                </p>

                <p>
                	<div class="form-group">
					<label for="dc_user_project_construction" data-validate="length">
						<?php _e('Does your project include any construction work? (If yes, please send a description and drawing/picture to illustrate your concept to bygdc@roskilde-festival.dk)'); ?>
					</label>
					<div class="input-group" data-validate="length" data-length="1">
					<textarea rows="3" name="dc_user_project_construction" id="dc_user_project_construction" class="form-control" placeholder="Contruction Plans" type="text" required></textarea>
					<span class="input-group-addon danger">
								<span class="glyphicon glyphicon-remove">
								</span>
							</span> 
						</div>
					</div>

				</p>
				<p class="no-pad">
				    <label for="checkbox"><?php _e('On what date do you wish to participate in the mandatory security workshop? (choose at least one)'); ?></label>

				<div class="checkbox">
					<label>
					    <input type="checkbox" name="dc_optionsRadios1" id="dc_optionsRadios1" value="Thursday 17. March" >
						Thursday 17. March @ 17.00-20-00
					</label>
				</div>
				<div class="checkbox">
				 	<label>
				    	<input type="checkbox" name="dc_optionsRadios2" id="dc_optionsRadios2" value="Wednesday 30. March" >
						Wednesday 30. March @ 17.00-20-00
					</label>
				</div>	
				<div class="checkbox">
				 	<label>
				    	<input type="checkbox" name="dc_optionsRadios3" id="dc_optionsRadios3" value="Sunday 3. April" >
						Sunday 3. April @ 13.00-17.00
					</label>
				</div>
				<div class="checkbox">
					<label>
				    	<input type="checkbox" name="dc_optionsRadios4" id="dc_optionsRadios4" value="Sunday 10. April" >
						Sunday 10. April @ 13.00-17.00
					</label>
				</div>
				</p>					
				<p>
					<input type="hidden" name="dc_register_nonce" value="<?php echo wp_create_nonce('dc-register-nonce'); ?>"/>
					<input name="dc_submit" type="submit" class="btn btn-default" value="<?php _e('Register Your Account'); ?>"/>
				</p>
			</fieldset>
		</form>
	<?php
	} // end top else
	return ob_get_clean();
}

function dc_process_reg_form(){
	
	global $dc_form_success;
	
	$Ok = true;
	$dc_form_success = "";
	
	if (isset( $_POST["dc_user_email"] ) && isset( $_POST["dc_register_nonce"] ) && wp_verify_nonce($_POST['dc_register_nonce'], 'dc-register-nonce')) 
	{
		$camp_workshop1 = "";
		$camp_workshop2 = "";
		$camp_workshop3 = "";
		$camp_workshop4 = "";

		$user_login      = $_POST["dc_user_email"];  
		$user_email      = $_POST["dc_user_email"];
		$user_first      = $_POST["dc_user_first"];
		$user_last       = $_POST["dc_user_last"];
		$camp_phone      = $_POST["dc_user_phone"];
		$camp_name       = $_POST["dc_user_camp_name"];
		$camp_pat_no     = $_POST["dc_user_participants"];
		$camp_pro_desc   = $_POST["dc_user_project_desc_one"] ."\r\n\r\n". $_POST["dc_user_project_desc_two"] ."\r\n\r\n". $_POST["dc_user_project_desc_three"] ."\r\n\r\n". $_POST["dc_user_project_desc_four"];
		$camp_pro_cons   = $_POST["dc_user_project_construction"];
		$camp_short_desc = $_POST['dc_user_short_desc'];

		
		if( isset( $_POST["dc_optionsRadios1"]) )
			$camp_workshop1 = $_POST["dc_optionsRadios1"];
		if( isset( $_POST["dc_optionsRadios2"] ))
			$camp_workshop2 = $_POST["dc_optionsRadios2"];
		if( isset( $_POST["dc_optionsRadios3"] ))
			$camp_workshop3 = $_POST["dc_optionsRadios3"];
		if( isset( $_POST["dc_optionsRadios4"] ))
			$camp_workshop4 = $_POST["dc_optionsRadios4"];		


		$camp = DreamCityCamp::withDetails($user_login, $user_first, $user_last, $user_email, $camp_phone, $camp_name,$camp_pro_desc, $camp_pro_cons, $camp_pat_no, $camp_short_desc, $camp_workshop1, $camp_workshop2, $camp_workshop3, $camp_workshop4);

		$email_inuse = email_exists($camp->user_email);
		
		$user_status = 'approved';
		
		if( $email_inuse ){
			$user_status = get_user_meta( $email_inuse, 'pw_user_status', true );
		}
		
		if ( empty( $user_status ) ) {
		    $user_status = 'approved';
		}
		

		if( $camp->HasError() ){
			$dc_form_success = "error";
			$Ok = false;
		}
		else{
			if( $email_inuse && $user_status == 'denied' ){	
				$camp->user_id = $email_inuse;
				$camp_old_data = DreamCityCamp::withUserId($camp->user_id);
				
				$camp->camp_id = $camp_old_data->camp_id;
				$camp->camp_notes = $camp_old_data->camp_notes;

				if( !$camp->UpdateCampOnUserId() ){
					$dc_form_success = "error";	
					$Ok = false;
				}else{
					dc_camp_update_notes($camp->camp_id, date("Y-m-d H:i:s") . " - Camp reaplied", true);
					update_user_meta( $camp->user_id, 'pw_user_status', 'pending' );
				}
        	}
			else if( !$camp->AddCampToDatabase() ){	// This will reject if user already exist! as this will try to create new camp.		
				// Show an error?
				$dc_form_success = "error";		
				$Ok = false;
			}	
			//wp_new_user_notification($camp->user_id,'', 'both'); 
			// log the new user in
			//wp_setcookie($user_login, $user_pass, true);
			//wp_set_current_user($new_user_id, $user_login); 
			//do_action('wp_login', $user_login); 
			// send the newly created user to the home page after logging them in and add a confirmation message
			
			if ( $Ok ){
				$to = $camp->user_email;
				$message = sprintf( "Hey %s. \r\nWe have received your registration. Once we have reviewed it we will get back to you. \r\r\n\n Dream On", $camp->camp_name, ENT_QUOTES );
				$subject = "Welcome to Dream City";
				
				$att = create_pdf($camp);


				wp_mail( $to, $subject, $message, '', $att );
				//wp_mail( $to, $subject, $message, '' );
				
				//$Ok = true;
				
				$dc_form_success = "success";

				//return $dc_registration_form_fields;
				
				//wp_redirect('http://dream-city.dk/test-side' . '?state=success', 200); exit;
				wp_redirect('http://dream-city.dk/become-a-dreamer/registration' . '?state=success', 200); exit;
				//wp_redirect('http://localhost/wordpress/become-a-dreamer/registration' . '?state=success', 200); exit;
			}
		}
	}		
}


add_action('init', 'dc_process_reg_form');
?>
