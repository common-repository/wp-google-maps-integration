<?php

class TWGM_MetaBox {

    public function __construct() {    
        add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
        add_action( 'save_post', array( $this, 'save' ) );
        add_action( 'admin_print_styles', array( $this, 'style' ) );
        add_action( 'admin_print_scripts', array( $this, 'script' ) );
    }
 
    public function add_meta_box( $post_type ) {       
		add_meta_box( 'twgm_mbox', __( 'TWGM', 'twgm' ), array( $this, 'render_form' ), 'post' ); 
		/*
        $post_types = array( 'post', 'fwrtgm_cpt' );
        if ( in_array( $post_type, $post_types )) {
            add_meta_box(
                'fwrtgm_mbox',            		// Unique ID
                __( 'FWRT GMaps', 'fwrtgm' ),      	// Box title
                array( $this, 'render_form'), 	// Content callback
                $post_type
            );
        }
        */
    }
 

    public function save( $post_id ) {

    	if ( ! 'post' == $_POST['post_type'] ) {
    		return;
    	}

        $is_autosave = wp_is_post_autosave( $post_id );
		$is_revision = wp_is_post_revision( $post_id );
		$is_valid_nonce = ( isset( $_POST[ 'twgm_mbox_nonce' ] ) && wp_verify_nonce( $_POST[ 'twgm_mbox_nonce' ], basename( __FILE__ ) ) ) ? true : false;

		if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
			return;
		}

		if ( isset( $_POST['twgm_applymarker'] ) ) {
			update_post_meta( $post_id, '_twgm_applymarker', 'true' );
		} else {
			update_post_meta( $post_id, '_twgm_applymarker', 'false' );
		}

		if ( isset( $_POST['twgm'] ) ) {

			if ( isset( $_POST['twgm']['address'] ) ) {
				$_POST['twgm']['address'] = sanitize_text_field( $_POST['twgm']['address'] );
			}
			if ( isset( $_POST['twgm']['lat'] ) ) {
				$_POST['twgm']['lat'] = sanitize_text_field( $_POST['twgm']['lat'] );
			}
			if ( isset( $_POST['twgm']['lng'] ) ) {
				$_POST['twgm']['lng'] = sanitize_text_field( $_POST['twgm']['lng'] );
			}
			if ( isset( $_POST['twgm']['image'] ) ) {
				$_POST['twgm']['image'] = esc_url( $_POST['twgm']['image'] );
			}

			update_post_meta( $post_id, '_twgm_data', json_encode( $_POST['twgm'] ) );

		}
		
		if ( isset( $_POST['twgm_category'] ) ) {
			update_post_meta( $post_id, '_twgm_category', serialize( $_POST['twgm_category'] ) );
		} else {
			update_post_meta( $post_id, '_twgm_category', 'N;' );
		}

		if ( isset( $_POST['twgm_map'] ) ) {
			update_post_meta( $post_id, '_twgm_map', serialize( $_POST[ 'twgm_map' ] ) );
		} else {
			update_post_meta( $post_id, '_twgm_map', 'N;' );
		}
		
		/*if ( isset( $_POST['fwrtgm_icon'] ) ) {
			update_post_meta( $post_id, '_fwrtgm_icon', absint( $_POST['fwrtgm_icon'] ) );
		} else {
			update_post_meta( $post_id, '_fwrtgm_icon', '0' );
		}*/
    }
 

    public function render_form( $post ) {
    	
    	global $wpdb;

		wp_nonce_field( basename( __FILE__ ), 'twgm_mbox_nonce' );
		$mbd = get_post_meta( $post->ID );
		$twgm_data = isset( $mbd['_twgm_data'] ) ? json_decode( $mbd['_twgm_data'][0] ) : null;
		require_once plugin_dir_path( __FILE__ ) . 'metabox-display.php';
    }


    public function style() {
		
		global $typenow;

		if ( $typenow == 'post' ) {
			wp_enqueue_style( 'twgm_mbox_css', plugin_dir_url( __FILE__ ) . '../../css/metabox.css' );
			wp_enqueue_style( 'twgm_grid_css', plugin_dir_url( __FILE__ ) . '../../css/grid.css' );
		}
	}


	public function script() {

		global $typenow;

		$this->enqueue_gmaps();
		$this->enqueue_wpmedia();
		
		if ( $typenow == 'post' ) {
			wp_enqueue_script( 'twgm_mbox_js', plugin_dir_url( __FILE__ ) . 'metabox-script.js', array( 'jquery' ) );
		}
	}

	function enqueue_wpmedia() {
		wp_enqueue_script( 'media-upload' );
		wp_enqueue_script( 'thickbox' );
		wp_enqueue_style( 'thickbox' );
	}

	function enqueue_gmaps() {

		$added_url = '';
		$gmaps_api_key = get_option( 'twgm_gmaps_api_key', false );
		
		if ( $gmaps_api_key ) {
			$added_url = 'key=' . $gmaps_api_key . '&';
		}

		wp_enqueue_script( 
			'twgm-googleapis', 
			'https://maps.googleapis.com/maps/api/js?' . $added_url . 'v=3.exp&amp;sensor=false&amp;libraries=places,drawing', 
			array( 'jquery' ), 
			NULL, 
			false 
		);
	}

}