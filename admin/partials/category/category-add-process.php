<?php 
	$category_default = array(
		'id' 			=> 0,
		'name' 			=> '',
		'description' 	=> '',
		'iconpath' 		=> '',
		'time'			=> '0000-00-00 00:00:00'
	);

	if ( isset( $_POST['id'] ) ) {
		$_POST['id'] = absint( $_POST['id'] );
	}
	if ( isset( $_POST['name'] ) ) {
		$_POST['name'] = sanitize_text_field( $_POST['name'] );
	}
	if ( isset( $_POST['description'] ) ) {
		$_POST['description'] = esc_textarea( $_POST['description'] );
	}
	if ( isset( $_POST['iconpath'] ) ) {
		$_POST['iconpath'] = esc_url( $_POST['iconpath'] );
	}

	$log = $this->save_item( 'category', $category_default );
	$message 	= $log['message'];
	$notice 	= $log['notice'];
	$item 		= $log['item'];

	$this->enqueue_addform_cssjs();
	$this->enqueue_wpmedia();
	
	// Enqueue Script 
	wp_enqueue_script(
		'twgm-category-add-page',
		plugin_dir_url( __FILE__ ) . 'category-add-script.js',
		array( 'jquery' ), $this->ver, false );
	// Required Display
	require_once plugin_dir_path( dirname( __FILE__ ) ) . 'category/category-add-display.php';
?>