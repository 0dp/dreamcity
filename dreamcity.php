<?php
/*
Plugin Name: Dreamcity Medlems Plugin
Plugin URI:  https://github.com/0dp/dreamcity
Description: Medlemsmodul med ansøgning blah blah
Author: 	 Johankat, Lars, Rasmus
Version: 	 0.0.1
Author URI:  https://github.com/0dp/
License:     GPL-3.0
License URI: http://www.gnu.org/licenses/gpl-3.0.txt
*/

//Includes
include( plugin_dir_path( __FILE__ ) . 'signup/signup.php');
include( plugin_dir_path( __FILE__ ) . 'vendor/new-user-approve/new-user-approve.php');

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
    wp_enqueue_script( 'bootstrap_js', plugins_url( '/vendor/bootstrap/js/bootstrap.min.js', __FILE__ ), array( 'jquery' ) );
    wp_enqueue_style( 'bootstrap_css' );
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

