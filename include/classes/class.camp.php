<?php

/** @file

*********************************************************** * class.camp.php *
@brief          Camp class for Dream City project
******************************************************************************

@verbatim

Author
  Lars I. Sauer

Copyright
  NONE

Change Log
  2016-04-05 LSA;   Made constructor private.
                    Made 2 static functions to construct class. "withUserId" and "withDetails"
                    Added "CampNotes" to "fill" function.
                    Pushed into branch "new-camp-class"

Review
  2016-04-05 JHK;   Reviewed

@endverbatim
*****************************************************************************/


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
// Todo LSA; Move SQL come to other function place!

class DreamCityCamp
{   
    public $camp_name = ""; // Camp/project name        
    public $user_id = 0;    // Wordpress userID 
    public $user_email = "";
    
    public $camp_id = 0;    // Camp ID     
    public $camp_description = "";
    public $camp_short_desc = "";
    public $camp_construction = "";
    public $camp_participants = 0;
    private $camp_url = "";
    private $camp_imageURL = "";
    private $camp_iconURL = ""; 
    public $camp_notes = "";
    public $camp_registration_date;
    private $camp_modified;
    
    private $user_login = "";
    public $user_firstname = "";
    public $user_lastname = "";
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
    

    // Use static functions "withUserId" or 
    private function __construct() {
        // allocate your stuff
    }

    // Call this by "DreamCityCamp::withUserId(USERID)" This will return a DreamCityCamp object, or false if failed.
    // Return "Object" or "false"
    public static function withUserId( $id ) {
    
        $instance = new self();
        if( $instance->loadByUserId( $id ) )
        {
            return $instance;
        }
        else{
            return false;    
        }
    }

    public static function withDetails( $aUserLogin, $aUserFirstName, $aUserLastName, $aUserEmail, $aUserPhone, $aCampName,$aCampDescription, $aCampConstruction, $aCampParticipants,$aCampShortDesc, $aWorkshop1, $aWorkshop2, $aWorkshop3, $aWorkshop4){

        $instance = new self();
        $instance->fill($aUserLogin, $aUserFirstName, $aUserLastName, $aUserEmail, $aUserPhone, $aCampName,$aCampDescription, $aCampConstruction, $aCampParticipants,$aCampShortDesc, $aWorkshop1, $aWorkshop2, $aWorkshop3, $aWorkshop4);

        return $instance;
    }
    
    // Load the local camp data based on UserID
    protected function loadByUserId($aUserId){

        global $wpdb;
        $Ok = true;

        $user_info = get_userdata($aUserId);
        if( !$user_info ){
            // We could not find the user?
            return false;
        }

        $table_name = $wpdb->prefix . 'dc_camp';
        $query = $wpdb->prepare( "SELECT * FROM ". $table_name." WHERE user_id = %d", $aUserId);
        $campdata = $wpdb->get_row( $query );

        
        if ( null !== $campdata ) {        

            $table_name = $wpdb->prefix . 'dc_camp_meta';
            //$query = $wpdb->prepare( "SELECT * FROM $table_name WHERE camp_id = %i", $campdata->camp_id);                
            //$workshops =  $wpdb->get_results( $query );

            $ws1 = $wpdb->get_var( $wpdb->prepare( "SELECT meta_value FROM $table_name WHERE camp_id = %d AND meta_key = 'camp_workshop1'", $campdata->camp_id) );
            $ws2 = $wpdb->get_var( $wpdb->prepare( "SELECT meta_value FROM $table_name WHERE camp_id = %d AND meta_key = 'camp_workshop2'", $campdata->camp_id) );
            $ws3 = $wpdb->get_var( $wpdb->prepare( "SELECT meta_value FROM $table_name WHERE camp_id = %d AND meta_key = 'camp_workshop3'", $campdata->camp_id) );
            $ws4 = $wpdb->get_var( $wpdb->prepare( "SELECT meta_value FROM $table_name WHERE camp_id = %d AND meta_key = 'camp_workshop4'", $campdata->camp_id) );

            if($ws1 == NULL)
                $ws1 = "";
            
            if($ws2 == NULL)
                $ws2 = "";
            
            if($ws3 == NULL)
                $ws3 = "";
            
            if($ws4 == NULL)
                $ws4 = "";

            $this->fill($user_info->user_login, $user_info->first_name, $user_info->last_name, $user_info->user_email, $campdata->camp_phone, $campdata->camp_description, $campdata->camp_construction, $campdata->camp_residents,$campdata->camp_short_description, $ws1, $ws2, $ws3, $ws4, $campdata->camp_notes);

            $this->camp_id = $campdata->camp_id;

            return true;
        } else {
            // no camp data found.
            return false;
        }
    }


    protected function fill($aUserLogin, $aUserFirstName, $aUserLastName, $aUserEmail, $aUserPhone, $aCampName,$aCampDescription, $aCampConstruction, $aCampParticipants,$aCampShortDesc, $aWorkshop1, $aWorkshop2, $aWorkshop3, $aWorkshop4, $aCampNotes = NULL){
                                
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
                
        if( $aCampNotes != NULL ){
            $this->camp_notes = strip_tags($aCampNotes);
        }        

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
    
    public function UpdateCampOnUserId(){
        global $wpdb;
        $Ok = true;

        $this->AddCampImageData();

        $table_name = $wpdb->prefix . 'dc_camp';

        $result = $wpdb->update( 
            $table_name, 
            array(                    
                    'camp_name'                  => $this->camp_name,
                    'camp_phone'                 => $this->user_phone,
                    'camp_short_description'     => $this->camp_short_desc,
                    'camp_description'           => $this->camp_description,
                    'camp_residents'             => $this->camp_participants,
                    'camp_notes'                 => $this->camp_notes,
                    'camp_construction'          => $this->camp_construction,
                    'camp_iconURL'               => $this->camp_iconURL,
                    'camp_imageURL'              => $this->camp_imageURL,
                    'camp_modified'              => current_time( 'mysql' )
            ), 
            array( 'user_id' => $this->user_id ),
            array( '%s', '%s', '%s','%s','%d', '%s', '%s','%s','%s', '%s' ), 
            array( '%d' )

        );

        if( $result == false){
            
            $Ok = false;
        }

        // Next update the four workshops.

        return $Ok;
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
                    'camp_short_description'     => $this->camp_short_desc,
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
        //  $wpdb->print_error(); 
        //  echo(" OHH SHIT! userid= ". $this->user_id);
        //  return false;
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
        // //   // failed to store insert camp data.
        //      $Ok = false;
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
                //wp_redirect('http://dream-city.dk/test-side' . '?state=error', 200); exit;
                wp_redirect('http://dream-city.dk/become-a-dreamer/registration' . '?state=error', 200); exit;
                //wp_redirect('http://localhost/wordpress/become-a-dreamer/registration' . '?state=error', 200); exit;
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