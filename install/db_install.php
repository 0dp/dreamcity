<?php

global $dc_db_version;
$dc_db_version = '1.0';


function dcdb_install () {
   	global $wpdb;
   	global $dc_db_version;

   	$table_name = $wpdb->prefix . "dc_camp";

	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE $table_name (
  		camp_id mediumint(9) NOT NULL AUTO_INCREMENT,
  		user_id int(10) NOT NULL,
  		camp_name nvarchar(100) NOT NULL, 
  		camp_description nvarchar(max) NOT NULL,
  		camp_url varchar(70) DEFAULT '' NOT NULL,
  		camp_imageURL varchar(55) DEFAULT '' NOT NULL,
  		camp_iconURL varchar(55) DEFAULT '' NOT NULL,
  		camp_residents smallint(9) DEFAULT 0 NOT NULL,
		camp_notes nvarchar(max), DEFAULT NULL,
  		UNIQUE KEY camp_id (camp_id)
		) $charset_collate;";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );

	add_option( 'dc_db_version', $dc_db_version );

}

function dc_install_data() {
	global $wpdb;
	
	$welcome_name = 'Mr. WordPress';
	$welcome_text = 'Congratulations, you just completed the installation!';
	
	$table_name = $wpdb->prefix . 'dc_camp';
	
	$wpdb->insert( 
		$table_name, 
		array( 
			'user_id' => 0,
			'camp_name' => $welcome_name, 
			'camp_description' => $welcome_text,
			'camp_url' => 'test',
			'camp_imageURL' => '',
			'camp_iconURL' => '',
			'camp_residents' => '',
			'camp_notes' => ''
		) 
	);
}




function dc_update_db_check() {
    global $dc_db_version;
    if ( get_site_option( 'dc_db_version' ) != $dc_db_version ) {
        dc_install();
    }
}


?>