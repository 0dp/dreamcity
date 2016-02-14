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


//init 
function init_frontend() {

	//scipts og style vi skal bruge

 	/*
 	wp_register_script( 
 	$handle, 	//$string
 	$src, 	 	//$string
 	$deps,	 	//$array 
 	$ver, 	 	//$string
 	$in_footer  //bool
 	); 
	*/

	wp_register_script ( 'js-dreamcity' , plugins_url( '/js/dreamcity.js',  __FILE__), array( 'jquery' ), '1.0.0', true );
	wp_register_style ( 'css-dreamcity' , plugins_url( '/css/dreamcity.css',  __FILE__), '' , '1.0.0', 'all' );
	

	wp_enqueue_script( 'js-dreamcity' );
	wp_enqueue_style( 'css-dreamcity' );
}

add_action( 'wp_enqueue_scripts', 'init_frontend' );


function init_backend() {
    wp_register_style( 'bootstrap', plugins_url() . '/vendor/bootstrap/css/bootstrap.min.css', false, '1.0.0' );    
    wp_enqueue_style( 'bootstrap' );
}
add_action( 'admin_enqueue_scripts', 'init_backend' );


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
 
add_action('admin_menu', 'dc_admin_reg');