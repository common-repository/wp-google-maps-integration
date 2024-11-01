<?php

	$route_default = array(
			'id'			=> 0,
			'name'			=> '',
			'description' 	=> '',
			'startpoint'	=> 0,
			'endpoint'		=> 0,
			'setting'		=> '{}',
			'waypoints'		=> 'N;',
			'stopover' 		=> 'N;',
			'time'			=> '0000-00-00 00:00:00'
		);

		$default_setting = array(
			'travelmode' => '1',
			'unitsystem' => 'METRIC',
			'stroke' => array(
				'color' => 'black',
				'weight' => '2'
			),
			// 'draggable' => '1',
			// 'usingwaypoint' => '1'
		);

		// SANITIZE
		if ( isset( $_POST['id'] ) ) {
			$_POST['id'] = absint( $_POST['id'] );
		}
		if ( isset( $_POST['name'] ) ) {
			$_POST['name'] = sanitize_text_field( $_POST['name'] );
		}
		if ( isset( $_POST['description'] ) ) {
			$_POST['description'] = esc_textarea( $_POST['description'] );
		}
		if ( isset( $_POST['startpoint'] ) ) {
			$_POST['startpoint'] = absint( $_POST['startpoint'] );
		}
		if ( isset( $_POST['endpoint'] ) ) {
			$_POST['endpoint'] = absint( $_POST['endpoint'] );
		}
		if ( isset( $_POST['waypoints'] ) ) {
			$_POST['waypoints'] = serialize( $_POST['waypoints'] );
		}
		if ( isset( $_POST['stopover'] ) ) {
			$_POST['stopover'] = serialize( $_POST['stopover'] );
		}
		// JSON ENCODE
		if ( isset( $_POST['setting'] ) ) {
			$_POST['setting'] = json_encode( array_replace_recursive( $default_setting, $_POST['setting'] ) );
		} else {
			$_POST['setting'] = json_encode( $default_setting );
		}

		$log = $this->save_item( 'route', $route_default );
		$message	= $log['message'];
		$notice		= $log['notice'];
		$item 		= $log['item'];

		$this->enqueue_gmaps();
		$this->enqueue_addform_cssjs();
		$this->enqueue_colorpicker();
		$this->enqueue_datatable();

		// Enqueue Script 
		wp_enqueue_script(
			'twgm-category-add-page',
			plugin_dir_url( __FILE__ ) . 'route-add-script.js',
			array( 'jquery' ), $this->ver, false );
		// Required Display
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'route/route-add-display.php';

?>