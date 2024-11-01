<?php

class TWGM_Public {
	
	// Primary Variable
	private $plugin_name;
	private $ver;

	// TWGM Variable
	private $map_id;
	private $infowindows = [];

	public function __constraint ( $plugin_name, $version ) {	
		$this->plugin_name = $plugin_name;
		$this->ver = $version;
	}

	public function enqueue_styles () {
	}

	public function enqueue_scripts () {	
	}

	public function enqueue_front () {
		// Icon Fonts
		wp_enqueue_style( 
			'twgm-iconfont', 
			plugin_dir_url( __FILE__ ) . 'fonts/ionicons.woff',
			array(), null, false );
		// Style
	    wp_enqueue_style( 
	    	'twgm-front-style', 
	    	plugin_dir_url( __FILE__ ) . 'css/twgm-front.css', 
	    	array(), null, false );
		// Script
		wp_enqueue_script( 
			'twgm-front-script', 
			plugin_dir_url( __FILE__ ) . 'js/twgm-front.js', 
			array( 'jquery' ), $this->ver, false );
	}

	public function enqueue_tabs () {
		// Style
		wp_enqueue_style( 
			'twgm-ui-tabs-style', 
			plugin_dir_url( __FILE__ ) . 'css/twgm-tabs.css', 
			array(), null, false );
		// Script
		wp_enqueue_script( 'jquery-ui-tabs' );
	}

	public function enqueue_gmaps ( $lng = '' ) {
		$added_url = '';
		$gmaps_api_key = get_option( 'twgm_gmaps_api_key', false );
		if ( $gmaps_api_key ) {
			$added_url = 'key=' . $gmaps_api_key . '&';
		}
		if ( ! $lng == '' ) {
			$added_url .= 'language=' . $lng . '&';
		}
		wp_enqueue_script( 
			'googleapis', 
			'https://maps.googleapis.com/maps/api/js?' . $added_url . 'v=3.exp&libraries=places,drawing,panoramio,geometry,weather', 
			array( 'jquery' ), 
			NULL, 
			false 
		);
	}

	public function enqueue_external_font( ) {
		// Google Font
		wp_enqueue_style( 
			'twgm-google-fonts', 
			'https://fonts.googleapis.com/css?family=Open+Sans:400,500,700,300', 
			false 
		);
	}

	public function enqueue_infobox ( ) {
		wp_enqueue_script( 
			'twgm-infobox', 
			plugin_dir_url( __FILE__ ) . 'js/infobox.js', 
			array( 'jquery' ), $this->ver, false );
	}

	public function enqueue_markerclusterer ( ) {
		wp_enqueue_script( 
			'twgm-markerclusterer', 
			plugin_dir_url( __FILE__ ). 'js/markerclusterer.min.js', 
			array( 'jquery' ), $this->ver, false );
	}

	public function enqueue_markertreeview ( ) {
		wp_enqueue_style( 
			'twgm-tv-style', 
			plugin_dir_url( __FILE__ ) . 'css/markerchecktree.css', 
			array(), null, false );
	    wp_enqueue_style( 
	    	'twgm-tv-icon', 
	    	plugin_dir_url( __FILE__ ) . 'css/checktree_icon.png', 
	    	array(), null, false );
	    wp_enqueue_script( 
	    	'twgm-tv-script', 
	    	plugin_dir_url( __FILE__ ) . 'js/markerchecktree.js', 
	    	array( 'jquery' ), $this->ver, false );
	}

	public function enqueue_nanoscroll ( ) {
		wp_enqueue_style( 
			'twgm-nns-style1', 
			plugin_dir_url( __FILE__ ) . 'lib/nanoscroll/bin/css/nanoscroller.css', 
			array(), null, false );
        wp_enqueue_style( 
        	'twgm-nns-style2', 
        	plugin_dir_url( __FILE__ ) . 'lib/nanoscroll/bin/css/style.css', 
        	array(), null, false );
        wp_enqueue_script( 
        	'twgn-nns-script1', 
        	plugin_dir_url( __FILE__ ) . 'lib/nanoscroll/bin/javascripts/overthrow.min.js', 
        	array( 'jquery' ), $this->ver, false );
        wp_enqueue_script( 
        	'twgm-nss-script2', 
        	plugin_dir_url( __FILE__ ) . 'lib/nanoscroll/bin/javascripts/jquery.nanoscroller.js', 
        	array( 'jquery' ), $this->ver, false );
	}

	public function enqueue_elementquery ( ) {
		wp_enqueue_script( 
			'twgm-elquery-script1', 
			plugin_dir_url( __FILE__ ) . 'lib/elementquery/javascript/ResizeSensor.js', 
			array( 'jquery' ), $this->ver, false );
	    wp_enqueue_script( 
	    	'twgm-elquery-script2', 
	    	plugin_dir_url( __FILE__ ) . 'lib/elementquery/javascript/ElementQueries.js', 
	    	array( 'jquery' ), $this->ver, false );
	}

	function starts_with ( $haystack, $needle ) {
    	return $needle === "" || strrpos( $haystack, $needle, -strlen( $haystack ) ) !== false;
	}

	function ends_with ( $haystack, $needle ) {
    	return $needle === "" || ( ( $temp = strlen( $haystack ) - strlen( $needle ) ) >= 0 && strpos( $haystack, $needle, $temp ) !== false );
	}

	function get_markers_post ( $map_id, $infowindow = 0 ) {
		$result = [];
		$args = array(
			'numberposts' 	=> -1,
			'post_type' 	=> 'post',
			//'suppress_filters' => true,
			'meta_query' 	=> array(
				array(
					'key' 		=> '_twgm_applymarker',
					'value' 	=> 'true'
				)
			)
		);
		$query = new WP_Query( $args );
		while ( $query->have_posts() ) {
			$query->the_post();
			$post_id 	= get_the_ID();
			$post_meta 	= get_post_meta( $post_id );
			// prepare maps data from marker post
			$maps = isset( $post_meta['_twgm_map'][0] ) ? $post_meta['_twgm_map'][0] : 'N;';
			$maps = unserialize( unserialize( $maps ) );
			// check available map
			if ( ! ( is_array( $maps ) && in_array( $map_id, $maps ) ) ) {
				continue;
			}
			// post categories
			$res_post_category 	= '';
			$post_category 		= get_the_category();
			if ( $post_category ) {
				foreach ( $post_category as $pcat ) {
					$res_post_category .= $pcat->name . ', ';
				}
				$res_post_category = trim( $res_post_category, ', ' );
			}
			// post tags
			$res_post_tags 		= '';
			$post_tags 			= get_the_tags();
			if ( $post_tags ) {
				foreach ( $post_tags as $ptag ) {
					$res_post_tags .= $ptag->name . ', ';
				}
				$res_post_tags 	= trim( $res_post_tags, ', ' );
			}
			// post terms
			$res_post_terms 	= $res_post_category . ', ' . $res_post_tags;
			// post_content
			$res_post_content 	= get_the_content();
			// marker post data
			$data = isset( $post_meta['_twgm_data'][0] ) ? $post_meta['_twgm_data'][0] : '{}';
			$data = json_decode( $data, TRUE );
			$address 		= isset( $data['address'] ) ? $data['address'] : '';
			$lat 			= isset( $data['lat'] ) ? $data['lat'] : '';
			$lng 			= isset( $data['lng']) ? $data['lng'] : '';
			$city 			= isset( $data['city'] ) ? $data['city'] : '';
			$state 			= isset( $data['state'] ) ? $data['state'] : '';
			$country 		= isset( $data['country'] ) ? $data['country'] : '';
			$postalcode 	= isset( $data['postalcode'] ) ? $data['postalcode'] : '';
			$image 			= isset( $data['image'] ) ? $data['image'] : '';
			$description 	= isset( $data['description'] ) ? $data['description'] : '';
			$behaviour 		= [];
			
			// selected category
			$res_category 	= '';
			$selected_category = isset( $post_meta['_twgm_category'][0] ) ? $post_meta['_twgm_category'][0] : 'N;';
			$selected_category = unserialize( unserialize( $selected_category ) );
			if ( is_array( $selected_category ) ) {
				foreach ( $selected_category as $scat ) {
					$res_category .= ',' . $scat;
				}
			}
			// set meta key-value post to extrafield of marker
			$res_extrafield = [];
			foreach ( $post_meta as $key => $val ) {
				if ( $this->starts_with( $key, 'twgmpef_' ) ) {
					$ef_key = substr( $key, 8 );
					$ef_val = isset( $post_meta[ $key ][0] ) ? $post_meta[ $key ][0] : '';
					$res_extrafield[ $ef_key ] = $ef_val;
				}
			}
			// set default data to marker
			$marker = array(
				'id' 				=> 'post_' . $post_id, //$post_id,
				'name' 				=> the_title( '', '', false ),
				'description' 		=> $description,
				'address' 			=> $address,
				'lat' 				=> $lat,
				'lng' 				=> $lng,
				'city' 				=> $city,
				'state' 			=> $state,
				'country' 			=> $country,
				'postalcode' 		=> $postalcode,
				'image' 			=> $image,
				'extrafield' 		=> $res_extrafield,
				'category' 			=> $res_category,
				'maincategory' 		=> isset( $data['maincategory'] ) ? $data['maincategory'] : '',
				'infowindow_id'		=> $infowindow,
				'setting' 			=> [],
				'permalink' 		=> get_permalink(),
				'post_content' 		=> $res_post_content,
				'post_category' 	=> $res_post_category,
				'post_tags' 		=> $res_post_tags,
				'post_terms' 		=> $res_post_terms,
				'post_type'			=> 'post',
				'type' 				=> 'post',
			);

			$setting 					= [];
			$setting['icon_type'] 		= isset( $data['icon_type'] ) ? $data['icon_type'] : 'main_category';
			$setting['custom_icon'] 	= isset( $data['custom_icon'] ) ? $data['custom_icon'] : '';
			$setting['animation'] 		= isset( $data['animation'] ) ? $data['animation'] : 'NONE';
			$setting['onclick'] 		= isset( $data['onclick'] ) ? $data['onclick'] : '';
			$setting['redirect_link'] 	= isset( $data['redirect_link'] ) ? $data['redirect_link'] : '';

			$behaviour_values = array( 'draggable', 'disable_click', 'default_openiw' );
			foreach ( $behaviour_values as $bv ) {
				if ( isset( $data[ $bv ] ) ) {
					array_push( $behaviour, $bv );
				}
			}

			$setting['behaviour'] 		= $behaviour;
			$marker['setting'] 			= json_encode( $setting );
			array_push( $result, $marker );
		}
		wp_reset_postdata();
		return $result;
	}

	function convert_array_int ( $string ) {
		$result = array();
		$string = explode( ',', $string );
		if ( is_array( $string ) ) {
			foreach ( $string as $id ) {
				if ( is_numeric( $id ) ) {
					array_push( $result, $id );
				}
			}
			if ( count( $result ) > 0 ) {
				return $result;
			} else {
				return array();
			}

		} else {
			return array();
		}
	}


	function inject_style ( $style ) {
        wp_add_inline_style( 'twgm-front-style', $style );
	}

	function validate_rgba ( $color1, $color2 = null ) {
		if ( preg_match( "/rgba\((\s*\d+\s*,){3}[\d\.]+\)/", $color1 ) ) {
			return $color1;
		} else {
			if ( $color2 ) {
				return $color2;
			} else {
				return 'rgba( 255, 255, 255, 1 )';
			}
		}
	}


	function shortcode_handler( $atts ) {

		if ( isset( $atts['id'] ) ) {

			global $wpdb;

			$table_marker 		= $wpdb->prefix . 'twgm_marker';
			$table_category 	= $wpdb->prefix . 'twgm_category';
			$table_route 		= $wpdb->prefix	. 'twgm_route';
			$table_shape 		= $wpdb->prefix	. 'twgm_shape';
			$table_map 			= $wpdb->prefix	. 'twgm_map';
			$table_infowindow 	= $wpdb->prefix . 'twgm_infowindow';

			$result_marker 		= '';
			$result_category 	= '';
			$result_route 		= '';
			$result_shape 		= '';
			$result_map 		= '';
			$result_infowindow 	= '';


			// GET - MAP
			$result_map = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM $table_map WHERE id = %d", absint( $atts['id'] ) ), ARRAY_A );
			if ( is_null( $result_map ) ) {
				return;
			}


			// GET - CATEGORY
			$result_category = $wpdb->get_results( "SELECT * FROM $table_category order by id", ARRAY_A );


			// PREPARE - MAP DATA
			$map_setting 	= json_decode( $result_map['setting'], true );
			$map_marker 	= $this->convert_array_int( unserialize( $result_map['marker'] ) );
			
			$map_route 		= $this->convert_array_int( unserialize( $result_map['route'] ) );

			$general_marker_infowindow 	= intval( $map_infowindow['general_marker'] );
			$post_marker_infowindow 	= intval( $map_infowindow['post_marker'] );


			// GET - MARKER
			if ( count( $map_marker ) > 0 ) {
				$map_marker 	= implode( ',', $map_marker );
				$result_marker 	= $wpdb->get_results( "SELECT * FROM $table_marker WHERE id IN ( $map_marker )", ARRAY_A );
				if ( is_array( $result_marker ) || is_object( $result_marker ) ) {
					for ( $i = 0; $i < count( $result_marker ); $i++ ) {
						$result_marker[ $i ]['category'] 	= unserialize( $result_marker[ $i ]['category'] );
						$result_marker[ $i ]['extrafield'] 	= unserialize( $result_marker[ $i ]['extrafield'] );
					}
				}
			}


			// GET - POST MARKER
			$result_postmarker = [];
			$result_postmarker = $this->get_markers_post( $atts['id'], $post_marker_infowindow );
			if ( count( $result_postmarker ) > 0 ) {
				$result_marker = array_merge( $result_marker, $result_postmarker );
			}


			// GET - CPT MARKER
			$result_cptmarker 		= [];


			// GET - INFOWINDOW
			if ( count( $cptmarker_infowindow ) > 0 ) {
				$cptmarker_infowindow 	= implode( ',', $cptmarker_infowindow );
			} else {
				$cptmarker_infowindow 	= '0';
			}
			$infowindow_id 			= $general_marker_infowindow . ',' . $post_marker_infowindow . ',' . $cptmarker_infowindow;
			$result_infowindow 		= $wpdb->get_results( "SELECT * FROM $table_infowindow WHERE id IN( $infowindow_id )", ARRAY_A );


			// GET - SHAPE 
			$result_shape			= [];

			// GET - ROUTE
			if ( count( $map_route ) > 0 ) {	
				$map_route 		= implode( ',', $map_route );
				//$result_route 	= $wpdb->get_results( "SELECT * FROM $table_route WHERE id IN( $map_route )", ARRAY_A );
				$result_route 	= $wpdb->get_results( 
					"SELECT 
						$table_route.*, 
						m1.name as spname, 
						m2.name as epname, 
						m1.lat as splat, 
						m1.lng as splng, 
						m2.lat as eplat, 
						m2.lng as eplng 
					FROM $table_route 
					LEFT JOIN $table_marker as m1 ON $table_route.startpoint = m1.id 
					LEFT JOIN $table_marker as m2 ON $table_route.endpoint = m2.id 
					WHERE $table_route.id IN( $map_route )", ARRAY_A );
			}
			if ( is_array( $result_route ) ) {
				for ( $i = 0; $i < count( $result_route ); $i++ ) {
					$result_route[ $i ]['waypoints'] =  $this->convert_array_int( unserialize( $result_route[ $i ]['waypoints'] ) );
					$result_route[ $i ]['result_waypoints'] = array();
					$result_route[ $i ]['stopover'] = $this->convert_array_int( unserialize( $result_route[ $i ]['stopover'] ) ); 
					if ( count( $result_route[ $i ]['waypoints'] ) > 0 ) {
						$waypoints = implode( ',', $result_route[ $i ]['waypoints'] );
						$result_waypoints = $wpdb->get_results( "SELECT id, name, lat, lng FROM $table_marker WHERE id IN( $waypoints )", ARRAY_A );
						if ( count( $result_waypoints ) > 0 ) {
							$result_route[ $i ]['result_waypoints'] = $result_waypoints;
						} else {
							$result_route[ $i ]['result_waypoints'] = array();
						}
					}
				}
			}


			// SET - CAROUSEL
			$carousel_html_inside = '';
			$carousel_html_outside_top = '';
			$carousel_html_outside_bottom = '';

			
			//require plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/shortcode-process.php';
			// Language
			$st_language = isset( $map_setting['language'] ) ? $map_setting['language'] : '';
			$this->enqueue_gmaps( $st_language );
			$this->enqueue_external_font();
			$this->enqueue_elementquery();
			$this->enqueue_tabs();
			$this->enqueue_infobox();
			$this->enqueue_markerclusterer();
			$this->enqueue_markertreeview();
			$this->enqueue_nanoscroll();
			$this->enqueue_front();

			// Custom Style
			$id 	= $atts['id'];
			$sps 	= $map_setting['sidepanel'];
			$gl 	= $map_setting['gl'];
			$crs 	= $map_setting['carousel'];
		    $random_id = rand();
		    $css = "

		    	/* --- SIDEPANEL --- */
		    	#sp-" . $id . " {
		    		background: " . $this->validate_rgba( $sps['main']['background'] ) .";
		    		color: " . $this->validate_rgba( $sps['main']['font'] ) . ";
				}
		    	/* Slider Toggle */
		    	#sp-" . $id . " .twgm-sp-btn {
		    		background: " . $this->validate_rgba( $sps['btn_toggle']['slider'] ) .";
				}
				/* Header - Backgorund*/
				#sp-" . $id . " .twgm-sp-header-box {
		    		background: " . $this->validate_rgba( $sps['header']['background'] ) .";
				}
				/* Header - Font */
				#sp-" . $id . " .twgm-sp-header-title {
		    		color: " . $this->validate_rgba( $sps['header']['font'] ) .";
				}
				/* Header - Icon */
				#sp-" . $id . " .twgm-sph-icon {
		    		color: " . $this->validate_rgba( $sps['header']['icon'] ) .";
				}
				/* Input */
				#sp-" . $id . " input {
		    		background: " . $this->validate_rgba( $sps['ele_input']['background'] ) .";
		    		color: " . $this->validate_rgba( $sps['ele_input']['font'] ) . ";
				}
				/* Select */
				#sp-" . $id . " select {
					background: " . $this->validate_rgba( $sps['ele_select']['background'] ) . ";
					color: " . $this->validate_rgba( $sps['ele_select']['font'] ) . ";
				}
				/* Nav Toggle */ 
				#sp-" . $id . " .twgm-sp-togglenav {
		    		color: " . $this->validate_rgba( $sps['btn_toggle']['menu_tab'] ) .";
				}
				#sp-" . $id . " .twgm-sp-nav {
		    		background: " . $this->validate_rgba( $sps['tab']['background'] ) .";
				}
		        #sp-" . $id . " .twgm-sp-content .tree-list .twgm-checkbox {
		    		color: " . $this->validate_rgba( $sps['mtv']['color_checkbox'] ) . ";
				}
				#sp-" . $id . " .checktree li > ul > li {
					border-" . $sps['mtv']['item_border_side'] . ": 1px " . $sps['mtv']['item_border_type'] . " " . $this->validate_rgba( $sps['mtv']['item_border_color'] ) . ";
				}
				#sp-" . $id . " .checktree > li {
					border-bottom: 1px solid " . $this->validate_rgba( $sps['mtv']['color_gap'] ) . ";
				}

		    ";
		    $this->inject_style( $css );

			//require plugin_dir_path( dirname( __FILE__ ) ) . 'partials/shortcode-display.php';

			$id = $atts['id'];
			$sp_style = '';
			$cr_style = '';
			$gr_style = '';

			$result_html = 
			'<p>&nbsp;</p>
			<div class="twgm" id="twgm-' . $id . '-' . $random_id . '" style="display:none;">'
				. $carousel_html_outside_top . 
				'<div class="twgm-container">
					<div class="twgm-map-container">
						<!-- Map -->
						<div class="twgm-map" id="map-' . $id . '" style="width:100%; height:500px;"></div>
						<!-- Carousel Inside -->'
						. $carousel_html_inside . 
					'</div>
					<!-- Side Panel -->';
					
						$feedback_style = '';
						$tab_style = 'height: calc(100% - 80px);
							height: -moz-calc(100% - 80px);
							height: -webkit-calc(100% - 80px);
							height: -o-calc(100% - 80px);';
					
			$result_html .=		
					'<div class="twgm-sp twgm-sp-min" id="sp-' . $id . '" style="">
						<div class="twgm-sp-tabs" id="sp-tabs-' . $id . '" style="height:100%">
							
							<!-- [SP] - Header -->
							<div class="twgm-sp-header-box" style="">
								<div class="twgm-sp-togglenav hide-menu">&#xf20d</div>
								<div class="twgm-sp-togglemin">&#xf20d</div>
								<div class="twgm-sp-header-title">
									<div class="twgm-sph-icon"></div>
									<div class="twgm-sph-text"></div>
								</div>
							</div>
							
							<!-- [SP] - Nav -->
							<ul class="twgm-sp-nav" id="sp-nav-' . $id . '" style="">
								<li style="display:none;"><a href="#tab-marker-' . $id . '" class="sp-nav-item">&#xf3a3</a></li>
								<li style="display:none;"><a href="#tab-route-' . $id . '" class="sp-nav-item">&#xf262</a></li>
							</ul>
							
							<!-- [SP] - Content -->
							<div class="twgm-sp-content" id="sp-content-' . $id . '" style="height:100%;">
								
								<!-- [SPTab] - Marker -->
								<div id="tab-marker-' . $id . '" class="nano" style="' . $tab_style .'">
									<div class="nano-content">
										<div class="tree-list" id="sp-marker-treeview-'. $id .'"></div>
									</div>
								</div>

								<!-- [SPTab] - Route -->
								<div id="tab-route-' . $id . '" class="nano" style="' . $tab_style .'">
									<div class="nano-content">	
										<div class="route-list tree-list">
											<ul class="checktree"></ul>
										</div>
									</div>
								</div>

							</div>

						</div>
						<!-- Close Open Button -->
						<div class="twgm-sp-btn" style="" id="sp-btn-' . $id . '"></div>
					</div>
					
				</div>
				<!-- Carousel Outside -->' 
					. $carousel_html_outside_bottom .
				'<!-- Marker Grid List -->
				<style scoped>

					.twgm[max-width~="350px"] .twgm-sp-min {
						position: relative !important;
						height: 300px !important;
						margin-top: 0px !important;
						width: 100% !important;
						left: 0px !important;
					}

					.twgm[max-width~="350px"] .twgm-sp {
						height: 300px !important;
					}

					.twgm[max-width~="350px"] .twgm-sp-min .twgm-sp-header-box {
						left: 0px !important;
						width: 100% !important;
						top: 0px !important;
					}

					.twgm[max-width~="350px"] .twgm-sp-min .twgm-sp-nav {
						position: absolute !important;
						width: 100% !important;
						height: 40px !important;
						top: 55px !important;
					}

					.twgm[max-width~="350px"] .twgm-sp-min .twgm-sp-nav > li {
						float: left !important;
						width: 40px !important;
						clear: none !important;
					}

					.twgm[max-width~="350px"] .twgm-sp-min .twgm-sp-content {
						height: 205px !important;
						position: absolute !important;
						top: 95px !important;
						width: 100% !important;
					}

					.twgm[max-width~="350px"] .twgm-sp-min .twgm-sp-content .ui-tabs-panel {
						height: 100% !important;
						width: 100% !important;
						margin-top: 0px !important;
					}

					.twgm[max-width~="350px"] .twgm-sp-min .twgm-sp-togglenav {
						display: none;
					}

					/*
					.twgm[max-width~="350px"] .twgm-sp-togglemin {
						display: block;
					}*/

				</style>
				<div id="twgm-gl-' . $id . '"></div>
			</div>

			<!-- TWGM SCRIPT -->
			<script type="text/javascript">
			document.addEventListener("DOMContentLoaded", function(event) { 
			  //do work

				(function ( $ ) {
					"use strict";
					$(document).ready(function () {

						$( ".twgm" ).show();

						$( "#twgm-' . $id . '-' . $random_id . '").setTWGM(' .
								json_encode( $result_map ) . ',' .
								json_encode( $result_marker ) . ',' .
								json_encode( $result_category ) . ','.
								json_encode( $result_route ) . ','.
								json_encode( $result_shape ) . ',' . 
								json_encode( $result_infowindow ) . ','.
								'[],'. // post_marker
								'[] // cpt_marker
						);

					});
				})( jQuery );
			});
			</script>';

			return $result_html;

		}
	}

}
?>