<?php

	$marker_default = array(
		'id'				=> 0,
		'name'				=> '',
		'address'			=> '',
		'description'		=> '',
		'lat'				=> null,
		'lng'				=> null,
		'state'				=> '',
		'city'				=> '',
		'country'			=> '',
		'postalcode'		=> '',
		'category'			=> 'N;',
		'maincategory'		=> 0,
		'image'				=> '',
		'extrafield'		=> 'N;',
		'setting'			=> '{}',
		'time'				=> '0000-00-00 00:00:00'
	);

	if ( isset( $_POST['id'] ) ) {
		$_POST['id'] = absint( $_POST['id'] );
	}
	if ( isset( $_POST['name'] ) ) {
		$_POST['name'] = sanitize_text_field( $_POST['name'] );
	}
	if ( isset( $_POST['address'] ) ) {
		$_POST['address'] = sanitize_text_field( $_POST['address'] );
	}
	if ( isset( $_POST['description'] ) ) {
		$_POST['description'] = esc_textarea( $_POST['description'] );
	}
	if ( isset( $_POST['lat'] ) ) {
		$_POST['lat'] = sanitize_text_field( $_POST['lat'] );
	}
	if ( isset( $_POST['lng'] ) ) {
		$_POST['lon'] = sanitize_text_field( $_POST['lng'] );
	}
	if ( isset( $_POST['city'] ) ) {
		$_POST['city'] = sanitize_text_field( $_POST['city'] );
	}
	if ( isset( $_POST['state'] ) ) {
		$_POST['state'] = sanitize_text_field( $_POST['state'] );
	}
	if ( isset( $_POST['country'] ) ) {
		$_POST['country'] = sanitize_text_field( $_POST['country'] );
	}
	if ( isset( $_POST['postalcode'] ) ) {
		$_POST['postalcode'] = sanitize_text_field( $_POST['postalcode'] );
	}
	if ( isset( $_POST['category'] ) ) {
		$_POST['category'] = serialize( $_POST['category'] );
	}
	if ( isset( $_POST['maincategory'] ) ) {
		$_POST['maincategory'] = absint( $_POST['maincategory'] );
	}
	if ( isset( $_POST['image'] ) ) {
		$_POST['image'] = esc_url( $_POST['image'] );
	}
	if ( isset( $_POST['extrafield'] ) ) {
		$_POST['extrafield'] = serialize( $_POST['extrafield'] );
	}
	$setting_default = array(
		'icon_type' 	=> 'main_category',
		'custom_icon' 	=> '',
		'onclick' 		=> 'show_infowindow',
		'redirect_link' => '',
		'behaviour' 	=> array(),
		'animation' 	=> 'NONE',
	);

	if ( isset( $_POST['setting'] ) ) {
		$_POST['setting'] = json_encode( array_replace_recursive( $setting_default, $_POST['setting'] ) );
	} else {
		$_POST['setting'] = json_encode( $setting_default );
	}

	$log 		= $this->save_item( 'marker', $marker_default );
	$message 	= $log['message'];
	$notice 	= $log['notice'];
	$item 		= $log['item'];

	$this->enqueue_gmaps();
	$this->enqueue_addform_cssjs();
	$this->enqueue_wpmedia();
	$this->enqueue_datatable();

	// Enqueue Script 
	wp_enqueue_script(
		'twgm-marker-add-page',
		plugin_dir_url( __FILE__ ) . 'marker-add-script.js',
		array( 'jquery' ), $this->ver, false );
	// Require Display
	require_once plugin_dir_path( dirname( __FILE__ ) ) . 'marker/marker-add-display.php';

?>