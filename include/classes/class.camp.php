<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
// Todo LSA; Move SQL come to other function place!

class DreamCityCamp
{	

	public $camp_name = ""; // Camp/project name		
	public $user_id = 0;    // Wordpress userID	
	public $user_email = "";
	
	private $camp_id = 0;    // Camp ID		
	private $camp_description = "";
	private $camp_short_desc = "";
	private $camp_construction = "";
	private $camp_participants = 0;
	private $camp_url = "";
	private $camp_imageURL = "";
	private $camp_iconURL = "";	
	private $camp_notes = "";
	private $camp_registration_date;
	private $camp_modified;
	
	private $user_login = "";
	private $user_firstname = "";
	private $user_lastname = "";
	private $user_phone = "";
	
	private $camp_workshop1 = "";
	private $camp_workshop2 = "";
	private $camp_workshop3 = "";
	private $camp_workshop4 = "";	
	
	public $newupload;
			
	public $fail_sql = false;
	
	public $fail_email_taken = false;
	public $fail_phone_taken = false;
	public $fail_user_details = false;
		
	public $fail_campname = false;
	public $fail_campdescription = false;	
	
	private $camp_valid_status = false;	
	
    public $success = array();
	public $error_array = array();
	
	function __construct($aUserLogin, $aUserFirstName, $aUserLastName, $aUserEmail, $aUserPhone, $aCampName,$aCampDescription, $aCampConstruction, $aCampParticipants,$aCampShortDesc, $aWorkshop1, $aWorkshop2, $aWorkshop3, $aWorkshop4){
								
        //Sanitize		
		$this->user_login = sanitize($aUserLogin);
		$this->user_firstname = sanitize($aUserFirstName);
		$this->user_lastname = sanitize($aUserLastName);		
		$this->user_email = sanitize($aUserEmail);
		$this->user_phone = sanitize($aUserPhone);
		
		//$this->camp_name = sanitize($aCampName);
		$this->camp_name = strip_tags($aCampName);		
		$this->camp_description = sanitizeKeepNewline($aCampDescription);
		$this->camp_short_desc = sanitizeKeepNewline($aCampShortDesc);		
		$this->camp_construction = sanitize($aCampConstruction);
		$this->camp_participants = $aCampParticipants;

		$this->camp_workshop1 = sanitize($aWorkshop1);
		$this->camp_workshop2 = sanitize($aWorkshop2);
		$this->camp_workshop3 = sanitize($aWorkshop3);
		$this->camp_workshop4 = sanitize($aWorkshop4);
				
		if( $this->camp_name == "" ){
		  $this->fail_campname = true;          
		}		
		else if(dc_emailExists($this->user_email))
		{
			$this->fail_email_taken = true;
		}
        else if(dc_phoneExists($this->user_phone))
		{
			$this->fail_phone_taken = true;          
		}        
		else
		{
			//No problems have been found.
			$this->camp_valid_status = true;
		}
	}
	
	public function HasError(){
		$Ok = false;
	
		if( $this->fail_email_taken || 
			$this->fail_phone_taken || 
			$this->fail_user_details || 
			$this->fail_campname || 
			$this->fail_campdescription )
		{
			$Ok = true;
		}
		
		return $Ok;
	}
	
	private function AddCampImageData(){
		$Ok_logo = true;
		$Ok_image = true;
		
		if (!function_exists('wp_generate_attachment_metadata')){
				require_once(ABSPATH . "wp-admin" . '/includes/image.php');
				require_once(ABSPATH . "wp-admin" . '/includes/file.php');
				require_once(ABSPATH . "wp-admin" . '/includes/media.php');
		}
		
		if ($_FILES) {
            if ($_FILES['dc_camp_logo']) {
                $mime = $_FILES['dc_camp_logo']['type'];
				$filesize = $_FILES['dc_camp_logo']['size'];
				$maxsizef = 524288;
				
				if($filesize > $maxsizef){
					$Ok_logo = false;
					//$error_array[] = 'error size, max file size = 500 KB';
				}
				
				if(($mime != 'image/jpeg') && ($mime != 'image/jpg') && ($mime != 'image/png')){
					$Ok_logo = false;
					//$error_array[] ='error type , please upload: jpg, jpeg, png';
				}
				
				if( $Ok_logo ){
					$attach_id = media_handle_upload( 'dc_camp_logo', $this->user_id );
					$this->camp_iconURL = wp_get_attachment_url($attach_id);
				}
            }
									
			if ($_FILES['dc_camp_img']) {
                $mime = $_FILES['dc_camp_img']['type'];
				$filesize = $_FILES['dc_camp_img']['size'];
				$maxsizef = 524288;
				
				if($filesize > $maxsizef){
					$Ok_image = false;
					//$error_array[] = 'error size, max file size = 500 KB';
				}
				
				if(($mime != 'image/jpeg') && ($mime != 'image/jpg') && ($mime != 'image/png')){
					$Ok_image = false;
					//$error_array[] ='error type , please upload: jpg, jpeg, png';
				} 
				
				if( $Ok_image ){
					$attach_id = media_handle_upload( 'dc_camp_img', $this->user_id );
					$this->camp_imageURL = wp_get_attachment_url($attach_id);
				}
            }
		}
	}	
	
	private function StoreCamp(){
		
		global $wpdb;
		$Ok = true;
		$table_name = $wpdb->prefix . 'dc_camp';
		//$wpdb->show_errors();

		// echo '<pre>' . $this->user_id .'<br/>'. $this->camp_name .'<br/>'. $this->user_phone .'<br/>desc:'. $this->camp_description .'<br/>'. $this->camp_participants .'<br/>'. $this->camp_construction .'<br/>ico'. $this->camp_iconURL .'<br/>img'. $this->camp_imageURL . '</pre>';
		
		$wpdb->insert( 
		 		$table_name, 
                array(
                    'user_id'                    => $this->user_id,
                    'camp_name'                  => $this->camp_name,
                    'camp_phone'                 => $this->user_phone,
                    'camp_short_description'	 => $this->camp_short_desc,
                    'camp_description'           => $this->camp_description,
                    'camp_residents'             => $this->camp_participants,
                    'camp_construction'          => $this->camp_construction,
                    'camp_iconURL'               => $this->camp_iconURL,
                    'camp_imageURL'              => $this->camp_imageURL,
                    'camp_registration_date'     => current_time( 'mysql' )
                ) 
            );		
			
		// if( !$Ok ){			
  //           var_dump($Ok);	
		// 	$wpdb->print_error(); 
		// 	echo(" OHH SHIT! userid= ". $this->user_id);
		// 	return false;
		// }	

        $this->camp_id = $wpdb->insert_id;
		//echo $this->camp_id;
		// Insert workshop dates
		// if( $this->camp_id > 0 ){
			$table_name = $wpdb->prefix . 'dc_camp_meta';		
			if( $this->camp_workshop1 != "" ){
				$wpdb->insert( 
					$table_name, 
					array(
						'camp_id'                => $this->camp_id,
						'meta_key'               => 'camp_workshop1',
						'meta_value'             => $this->camp_workshop1,
					) 
				);	
			}
			if( $this->camp_workshop2 != "" ){
				$wpdb->insert( 
					$table_name, 
					array(
						'camp_id'                => $this->camp_id,
						'meta_key'               => 'camp_workshop2',
						'meta_value'             => $this->camp_workshop2,
					) 
				);		
			}
			if( $this->camp_workshop3 != "" ){
				$wpdb->insert( 
					$table_name, 
					array(
						'camp_id'                => $this->camp_id,
						'meta_key'               => 'camp_workshop3',
						'meta_value'             => $this->camp_workshop3,
					) 
				);		
			}
			if( $this->camp_workshop4 != "" ){
				$wpdb->insert( 
					$table_name, 
					array(
						'camp_id'                => $this->camp_id,
						'meta_key'               => 'camp_workshop4',
						'meta_value'             => $this->camp_workshop4,
					) 
				);		
			}
		// }
		// else{
		// // 	// failed to store insert camp data.
		//  	$Ok = false;
		// }
		
		return $Ok;
		
	}
	
	public function AddCampToDatabase() {
		global $wpdb;				
		$Ok = true;

		if(!$this->camp_valid_status ){
			return false;
		}
		else
		{	 
			 $user_pass = wp_generate_password( 12, false );
			 
			 // Create the Wordpress user.
			 $new_user_id = wp_insert_user(array(		 
			  'user_login'    => $this->user_login,
			  'user_pass'    => $user_pass,
			  'user_email'    => $this->user_email,
			  'first_name'    => $this->user_firstname,
			  'last_name'     => $this->user_lastname,
			  'user_registered' => date('Y-m-d H:i:s'),
			  'role'        => 'dreamer'
			));
		
			if ( is_wp_error( $new_user_id ) ) {
				$error_string = $new_user_id->get_error_message();
				//echo '<div id="message" class="error"><p>' . $error_string . '</p></div>';
				wp_redirect('http://dream-city.dk/test-side' . '?state=error', 200); exit; 		

				//echo "Failed to create user : ". $new_user_id;
				$Ok = false;
			}else{			
				//echo( "User created : ". $this->user_id );
				$this->user_id = $new_user_id;
				//echo '<div id="message" class="error"><p>' . $this->user_id . '</p></div>';
				$this->AddCampImageData();
				$Ok = $this->StoreCamp();
			}
		}
		// Do some kind of roll-back if !Ok ?
		
		return $Ok;		
	}
}

//add_action( 'init', 'AddCampToDatabase' );
?>