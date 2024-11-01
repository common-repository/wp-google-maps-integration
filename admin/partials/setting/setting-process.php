<?php

	$gmaps_api_key 		= '';
	$gmaps_def_theme 	= '';
	$gmaps_def_lat 		= '';
	$gmaps_def_lng 		= '';
	$gmaps_def_zoom 	= '';
	
	# GMaps Api Key
	if ( isset( $_POST['gmapsapikey'] ) ) {
		$gmaps_api_key = $_POST['gmapsapikey'];
		update_option( 'twgm_gmaps_api_key', $gmaps_api_key );
	} else {
		$gmaps_api_key = get_option ( 'twgm_gmaps_api_key', '' );
	}

	#GMaps Default Map Theme
	if ( isset( $_POST['maptheme' ] ) ) {
		$gmaps_def_theme = $_POST['maptheme'];
		update_option( 'twgm_gmaps_def_theme', json_encode( $gmaps_def_theme ) );
		$gmaps_def_theme = str_replace( "\\", "", $gmaps_def_theme );
	} else {
		$gmaps_def_theme = str_replace( "\\", "", json_decode( get_option( 'twgm_gmaps_def_theme', '' ) ) );
	}

	# GMaps Default Map Latitude
	if ( isset( $_POST['maplat'] ) ) {
		if ( is_numeric( $_POST['maplat'] ) ) {
			if ( ctype_digit( $_POST['maplat'] ) ) {
				$_POST['maplat'] .= '.0';
			}
			if ( preg_match( '/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/', $_POST['maplat'] ) ) {
				$gmaps_def_lat = $_POST['maplat'];
			} else {
				$gmaps_def_lat = 0;
			}
		} else {
			$gmaps_def_lat = 0;
		}
		update_option( 'twgm_gmaps_def_lat', $gmaps_def_lat );
	} else {
		$gmaps_def_lat = get_option( 'twgm_gmaps_def_lat', 0 );
	}

	# GMaps Default Map Longitude
	if ( isset( $_POST['maplng'] ) ) {
		if ( is_numeric( $_POST['maplng'] ) ) {
			if ( ctype_digit( $_POST['maplng'] ) ) {
				$_POST['maplng'] .= '.0';
			}
			if ( preg_match( '/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/', $_POST['maplng'] ) ) {
				$gmaps_def_lng = $_POST['maplng'];
			} else {
				$gmaps_def_lng = 0;
			}
		} else {
			$gmaps_def_lng = 0;
		}
		update_option( 'twgm_gmaps_def_lng', $gmaps_def_lng );
	} else {
		$gmaps_def_lng = get_option( 'twgm_gmaps_def_lng', 0 );
	}

	# GMaps Default Map Zoom
	if ( isset( $_POST['defzoom'] ) ) {
		if ( ctype_digit( $_POST['defzoom'] ) ) {
			$gmaps_def_zoom = $_POST['defzoom'];
		} else {
			$gmaps_def_zoom = 10;
		}
		update_option( 'twgm_gmaps_def_zoom', $gmaps_def_zoom );
	} else {
		$gmaps_def_zoom = get_option( 'twgm_gmaps_def_zoom', 10 );
	}

	$this->Enqueue_addform_cssjs();

	// Enqueue Script 
	wp_enqueue_script(
		'twgm-setting-page',
		plugin_dir_url( __FILE__ ) . 'setting-script.js',
		array( 'jquery' ), $this->ver, false );

	// Required Display
	require_once plugin_dir_path( dirname( __FILE__ ) ) . 'setting/setting-display.php';
?>