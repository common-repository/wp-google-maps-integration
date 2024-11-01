<?php
	if( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) 
		exit();

	function twgm_delete_table() {
		global $wpdb;
		$tables = array( 'marker', 'category', 'route', 'shape', 'infowindow', 'map', 'backup' );
		$prefix = $wpdb->prefix;
		$query 	= '';
		foreach ( $tables as $table ) {
			$query = 'DROP TABLE IF EXISTS ' . $prefix . 'twgm_' . $table . ';';
			$wpdb->query( $query );
		}
	}

	function twgm_delete_option() {
		delete_option( 'twgm_db_ver' );
	    delete_option( 'twgm_gmaps_api_key' );
		delete_option( 'twgm_gmaps_def_lat' );
		delete_option( 'twgm_gmaps_def_lng' );
		delete_option( 'twgm_gmaps_def_theme' );
		delete_option( 'twgm_gmaps_def_zoom' );
	}

	function twgm_delete_postmeta() {
		global $wpdb;
		$query = "DELETE FROM " . $wpdb->prefix . "postmeta WHERE meta_key LIKE '%twgm%'";
		$wpdb->query( $query );
	}

	function twgm_delete_data() {
		twgm_delete_table();
		twgm_delete_option();
		twgm_delete_postmeta();
	}

	if ( is_multisite() ) 
	{
	    global $wpdb;
	    $blogs = $wpdb->get_results( "SELECT blog_id FROM {$wpdb->blogs}", ARRAY_A );

	    if( ! empty( $blogs ) )
	    {
	        foreach ( $blogs as $blog ) 
	        {
		    	switch_to_blog( $blog['blog_id'] );
		    	twgm_delete_data();
	        }
	    }
	} else {
	    twgm_delete_data();
	}

?>