<?php

global $dc_db_version;
$dc_db_version = '3.0';


Class dc_installer {
    
	
	static function dc_db_install(){
		dc_installer::install_db_camp();
		dc_installer::install_db_camp_meta();		
	}		
	
	static function install_db_camp(){
        global $wpdb;
		global $dc_db_version;

		$table_name = $wpdb->prefix . "dc_camp";
		$charset_collate = $wpdb->get_charset_collate();		
		
		$sql = "CREATE TABLE $table_name (
			camp_id bigint(20) NOT NULL AUTO_INCREMENT,
			user_id bigint(20) NOT NULL,
			camp_name text(100) NOT NULL, 
			camp_phone varchar(12) NOT NULL,
			camp_short_description text NOT NULL,
			camp_description text NOT NULL,
			camp_construction text NULL,
			camp_url varchar(70) DEFAULT '' NULL,
			camp_imageURL varchar(100) DEFAULT '' NULL,
			camp_iconURL varchar(100) DEFAULT '' NULL,
			camp_residents smallint(9) DEFAULT 0 NOT NULL,
			camp_notes text DEFAULT NULL,
			camp_registration_date datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
			camp_modified datetime DEFAULT '0000-00-00 00:00:00' NULL,
			UNIQUE KEY camp_id (camp_id)
			) $charset_collate;";

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );

		add_option( 'dc_db_version', $dc_db_version );
    }
	
	static function install_db_camp_meta(){
        global $wpdb;
		global $dc_db_version;

		$table_name = $wpdb->prefix . "dc_camp_meta";
		$charset_collate = $wpdb->get_charset_collate();		
		
		$sql = "CREATE TABLE $table_name (
			meta_id bigint(20) NOT NULL AUTO_INCREMENT,
			camp_id bigint(20) DEFAULT 0 NOT NULL,
			meta_key varchar(255) DEFAULT NULL,
			meta_value longtext DEFAULT NULL,		
			UNIQUE KEY meta_id (meta_id)
			) $charset_collate;";

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );

		add_option( 'dc_db_version', $dc_db_version );
    }
    
	static function dc_update_db_check() {
		global $dc_db_version;
		if ( get_site_option( 'dc_db_version' ) != $dc_db_version ) {
			dcdb_install();
		}
	}	
}

//register_activation_hook( plugin_dir_path( __FILE__ ) . 'install/db_install.php', 'dcdb_install' );

//add_action( 'plugins_loaded', 'dc_update_db_check' );

?>