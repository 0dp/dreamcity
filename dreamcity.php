<?php
/*
Plugin Name: Dreamcity Medlems Plugin
Plugin URI:  https://github.com/0dp/dreamcity
Description: Medlemsmodul med ansøgning blah blah
Author: 	 Johankat, Lars, Rasmus
Version: 	 1.0.13
Author URI:  https://github.com/0dp/
License:     GPL-3.0
License URI: http://www.gnu.org/licenses/gpl-3.0.txt
GitHub Plugin URI: https://github.com/0dp/dreamcity
GitHub Branch:     master
*/
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
//Includes
include( plugin_dir_path( __FILE__ ) . 'signup/signup.php');
include( plugin_dir_path( __FILE__ ) . 'vendor/new-user-approve/new-user-approve.php');
//include( plugin_dir_path( __FILE__ ) . 'email/registration.php');

include( plugin_dir_path( __FILE__ ) . 'include/funcs.php');
include( plugin_dir_path( __FILE__ ) . 'include/classes/class.camp.php');

include( plugin_dir_path( __FILE__ ) . 'vendor/tcpdf/tcpdf.php');
include( plugin_dir_path( __FILE__ ) . 'vendor/tcpdf/examples/tcpdf_include.php');

include_once dirname( __FILE__ ).'/install/db_install.php';

register_activation_hook( __FILE__,  array( 'dc_installer', 'dc_db_install' ) );

//init 
function init_frontend() {

	//scipts og style vi skal bruge paa frontenden

	wp_enqueue_style('css_dreamcity', plugin_dir_url( __FILE__ ) . 'css/dreamcity.css' );

	wp_enqueue_script( 'js_dreamcity', plugin_dir_url(__FILE__) . 'js/dreamcity.js' );
}

add_action( 'wp_enqueue_scripts', 'init_frontend' );


function init_backend() {
    wp_register_style( 'bootstrap_css', plugins_url( '/vendor/bootstrap/css/bootstrap.min.css', __FILE__ ) );
    wp_register_style( 'custom_admin', plugins_url( '/css/admin.css', __FILE__));
    wp_enqueue_script( 'bootstrap_js', plugins_url( '/vendor/bootstrap/js/bootstrap.min.js', __FILE__ ), array( 'jquery' ) );
    wp_enqueue_style( 'bootstrap_css' );
    wp_enqueue_style( 'custom_admin');
}

add_action( 'admin_init', 'init_backend' ); 
add_action( 'wp_enqueue_scripts', 'init_backend', '0' );


//Registrer sider i backend ie. menu
function dc_admin_reg() {

	/*
	add_menu_page

	$page_title
    (string) (Required) The text to be displayed in the title tags of the page when the menu is selected.

	$menu_title
    (string) (Required) The text to be used for the menu.

	$capability
    (string) (Required) The capability required for this menu to be displayed to the user.
	
	$menu_slug
    (string) (Required) The slug name to refer to this menu by (should be unique for this menu).

	$function
    (callable) (Optional) The function to be called to output the content for this page.
    Default value: ''

	$icon_url
    (string) (Optional) The URL to the icon to be used for this menu. <em> Pass a base64-encoded SVG using a data URI, which will be colored to match the color scheme. This should begin with 'data:image/svg+xml;base64,'. </em> Pass the name of a Dashicons helper class to use a font icon, e.g. 'dashicons-chart-pie'. * Pass 'none' to leave div.wp-menu-image empty so an icon can be added via CSS.
    Default value: ''

	$position
    (int) (Optional) The position in the menu order this one should appear.
    Default value: null
	*/
    
    
    add_menu_page(
        'Dreamcity',
        'Dreamcity',
        'manage_options',
        'dreamcity/admin/admin-dashboard.php',
        '',
        plugins_url( 'dreamcity/images/icon.png' ),
        6
    );

}
 
// CREATE USER ROLE ON PLUGIN ACTIVATION
// CURRENTLY TO WORK ADD do_action( 'dc_alert_hook' ); TO PAGE TEMPLATE FILE

   function add_roles_on_plugin_activation() {
       add_role( 'dreamer', 'Dreamer', array( 'read' => true, 'level_0' => true ) );
   }
   register_activation_hook( __FILE__, 'add_roles_on_plugin_activation' );


//ADD ALERTS TO PAGES

function dc_alert() {

    //CHECK STATE
    if ( isset( $_GET['state'] ) ) {
        $state = $_GET['state'];
        //IF SUCCESS
        if ($state == 'success') { 
            echo '<div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Success!</strong> You have now applied for Dreamcity 2016</div>';
            }
        if ($state == 'error') { 
              echo '<div class="alert alert-warning alert-dismissible" role="alert">
             <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
             <strong>Fail!</strong>Camp might already been registered. Check with your fellow dreamers</div>';

            }
    }

   
}

// ADD ACTIONS

add_filter( 'dc_alert_hook', 'dc_alert' );
add_action('admin_menu', 'dc_admin_reg');


function alertbox() {

    ob_start();
    do_action( 'dc_alert_hook' );
    return ob_get_clean();
}

add_shortcode( 'alertbox', 'alertbox' );




/**
 * Redirect user after successful login.
 *
 * @param string $redirect_to URL to redirect to.
 * @param string $request URL the user is coming from.
 * @param object $user Logged user's data.
 * @return string
 */
function my_login_redirect( $redirect_to, $request, $user ) {
    //is there a user to check?
    global $user;
    if ( isset( $user->roles ) && is_array( $user->roles ) ) {
        //check for admins
        if ( in_array( 'administrator', $user->roles ) ) {
            // redirect them to the default place
            return $redirect_to;
        } 
        if ( in_array( 'dreamer', $user->roles ) ) {
            // redirect them to the default place
            return 'http://dream-city.dk/backstage-dreamer/';
        }
        else {
            return home_url();
        }
    } else {
        return $redirect_to;
    }
}

add_filter( 'login_redirect', 'my_login_redirect', 10, 3 );


//DREAM CITY LOGO ON LOGIN
function my_login_logo() { ?>
    <style type="text/css">
        @font-face{
            font-family:'rf4000-bold';
            src:url('http://dream-city.dk/fonts/4000-bold-webfont.eot');
            src:url('http://www.dream-city.dk/fonts/4000-bold-webfont.eot?#iefix') format('embedded-opentype'),
            url('http://dream-city.dk/fonts/4000-bold-webfont.woff') format('woff'),
            url('http://dream-city.dk/fonts/4000-bold-webfont.ttf') format('truetype');
            font-weight:normal;
            font-style:normal;
        }

        @font-face{
            font-family:'rf4000';
            src:url('http://dream-city.dk/fonts/4000-regular-webfont.eot');
            src:url('http://dream-city.dk/fonts/4000-regular-webfont.eot?#iefix') format('embedded-opentype'),
            url('http://dream-city.dk/fonts/4000-regular-webfont.woff') format('woff'),
            url('http://dream-city.dk/fonts/4000-regular-webfont.ttf') format('truetype');
            font-weight:400;
            font-style:normal;
        }
        body {
            background: #2E2E2E;
            font-family: rf4000;
        }

        #login {
             width: 470px;
             padding: 8% 0 0;
             margin: auto;
}
        .login h1 a {
            background-image: url('http://www.dream-city.dk/wp-content/uploads/2016/03/dreamcity-bubblelogo-greenwhite-300x213.png');
            padding-bottom: 30px;
            background-size: 160px;
            width: auto;
        }
        
        .login #login_error, .login .message {
            border-left: 0;
            padding: 12px;
            margin-left: 0;
            background-color: #434343;
            -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
            box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
            color: #D3874E;
            text-transform: uppercase;
            font-family: rf4000-bold;
        }

        .login form {
            margin-top: 20px;
            margin-left: 0;
            padding: 26px 24px 46px;
            background: #434343;
            -webkit-box-shadow: 0 1px 3px rgba(0,0,0,.13);
            box-shadow: 0 1px 3px rgba(0,0,0,.13);
        }

        .login label {
            color: #D1864E;
            font-size: 14px;
            text-transform: uppercase;
            font-family: rf4000-bold;
        }

        .wp-core-ui .button-primary {
            background: #D3874E;
            border-color: transparent;
            -webkit-box-shadow: none;
            box-shadow: none;
            color: #fff;
            text-decoration: none;
            text-shadow: none;
            text-transform: uppercase;
            font-family: rf4000-bold;
            border-radius: 0;
        }  

        .wp-core-ui .button-primary:hover {
            background: #262626;
            border-color: transparent;
            -webkit-box-shadow: none;
            box-shadow: none;
            color: #D3874E;
            text-decoration: none;
            text-shadow: none;
            text-transform: uppercase;
            font-family: rf4000-bold;
            border-radius: 0;
        }  

        input[type="text"] {
                color: #D3874E;

        }
    </style>
    
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );

add_filter('register','no_register_link');
function no_register_link($url){
    return '';
}




   

if(isset($_GET["page"]) && $_GET['page'] == "dreamcity/admin/admin-dashboard.php")
{    
    

    global $plugin_page;
    if ( isset($_POST['download_csv'])) {
        global $wpdb;

    $pending = $wpdb->get_results( 
    "SELECT DISTINCT wp0_users.display_name, wp0_users.user_email, wp0_usermeta.*, wp0_dc_camp.*,wp0_dc_camp_meta.*
    FROM wp0_dc_camp 
    LEFT JOIN wp0_dc_camp_meta ON wp0_dc_camp.camp_id = wp0_dc_camp_meta.camp_id
    LEFT JOIN wp0_users ON wp0_dc_camp.user_id = wp0_users.ID
    LEFT JOIN wp0_usermeta ON wp0_usermeta.user_id = wp0_users.ID WHERE wp0_usermeta.meta_value = 'pending' GROUP BY wp0_users.ID
    ");
                                    
        // Set header row values
        $csv_fields=array();
        $csv_fields[] = 'Camp Name';
        $csv_fields[] = 'Contact Person';
        $csv_fields[] = 'Email';
        $csv_fields[] = 'Phone';
        $csv_fields[] = 'Residents';
        $csv_fields[] = 'Short Description';
        $csv_fields[] = 'Project Description';
        $csv_fields[] = 'Project Construction';
        $csv_fields[] = 'Workshop';

        $output_filename = 'pending_dreamers_export.csv';
        $output_handle = @fopen( 'php://output', 'w' );
     

        header( 'Cache-Control: must-revalidate, post-check=0, pre-check=0' );
        header( 'Content-Description: File Transfer' );
        header( 'Content-type: text/csv; charset=iso-8859-1');
        header( 'Content-Disposition: attachment; filename=' . $output_filename );
        header( 'Expires: 0' );
        header( 'Pragma: no-cache' ); 



        // Insert header row
        fputcsv( $output_handle, $csv_fields, ";", '"');

        // Parse results to csv format
        foreach ($pending as $Result) {
            $leadArray = array();
            $leadArray[] = utf8_decode($Result->camp_name);
            $leadArray[] = utf8_decode($Result->display_name);
            $leadArray[] = utf8_decode($Result->user_email);
            $leadArray[] = utf8_decode($Result->camp_phone);
            $leadArray[] = utf8_decode($Result->camp_residents);
            $leadArray[] = utf8_decode($Result->camp_short_description);
            $leadArray[] = utf8_decode($Result->camp_description);
            $leadArray[] = utf8_decode($Result->camp_construction);
            $leadArray[] = utf8_decode($Result->meta_value);
            //echo var_dump($Result);
            //$leadArray = (array) $Result; // Cast the Object to an array
            // Add row to file
            fputcsv( $output_handle, $leadArray, ";", '"');
            }
        
        // Close output file stream
        fclose( $output_handle ); 

        die();
    }

}
?>
