<?php
	// Installation du plugin  
   
  	// Base de Données
	function mlab_install()
	{
	   global $wpdb;
	   
	   add_option( "mlab_db_version", MLAB_PLUGIN_VERSION );
	
	   $table_name = $wpdb->prefix . MLAB_DB_TABLE;
	   
	   $charset_collate = '';
	   if ( ! empty( $wpdb->charset ) )
	   {  
		   $charset_collate = "  CHARACTER SET {$wpdb->charset}";
	   }	
	   if ( ! empty( $wpdb->collate ) )
	   {
		  $charset_collate .= " COLLATE {$wpdb->collate}";
	   }
	   
	   $sql = "CREATE TABLE $table_name (
				id mediumint(9) NOT NULL AUTO_INCREMENT,
				options mediumtext NULL,
				titre tinytext NOT NULL,
				text longtext NOT NULL,
				mlab_key VARCHAR(55) DEFAULT '' NULL,
				UNIQUE KEY id (id)
				) $charset_collate;";	  
	  require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	  dbDelta( $sql );		
	}
  
	// Données initiales
	function mlab_install_data()
	{
		global $wpdb;
	    $table_name = $wpdb->prefix . MLAB_DB_TABLE;
	    $result	 = $wpdb->get_results( "SELECT * FROM $table_name WHERE id = 1" );
	   
	    $titre		= ( empty( $result ) )? "Magneticlab Popup System": $result[0]->titre;
	    $text		= ( empty( $result ) )? __('Enter your text here','mlab_popup'): $result[0]->text;
	    $options 	= serialize( array( "activate" 	=> '0',
									    "width"		=> '350'
									)
							 );
	    $options	= ( empty( $result ) )? $options: $result[0]->options;
	    $mlab_key 	= "";	 
	    $wpdb->replace( $table_name, 
					   array( 'id' => 1,
							  'options' => $options,
							  'titre' => $titre,
							  'text' => $text,
							  'mlab_key' => $mlab_key 
							)
					  );
	}
	
	function mlab_init()
	{	   
		load_plugin_textdomain('mlab_popup', false, MLAB_PLUGIN_SLUG . '/lang' );
		if ( get_site_option( 'mlab_db_version' ) != MLAB_PLUGIN_VERSION ) {
			mlab_install();
		}
	}
	
	function mlab_uninstall()
	{
		//drop mlab_popup db table
		global $wpdb;
		$table_name = $wpdb->prefix . MLAB_DB_TABLE;
		$wpdb->query( "DROP TABLE IF EXISTS $table_name " ); 
		delete_option( 'mlab_db_version' ); 		
	}
	
	
