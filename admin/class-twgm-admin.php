<?php


class TWGM_Admin {

	private $plugin_name;
	private $ver;

	public function __construct( $plugin_name, $ver ) {
		$this->plugin_name = $plugin_name;
		$this->ver = $ver;
	}

	public function enqueue_styles ( ) { }
	
	public function enqueue_scripts ( ) { }

	public function enqueue_wpmedia ( ) {
		wp_enqueue_style( 'thickbox' );
		wp_enqueue_script( 'media-upload' );
		wp_enqueue_script( 'thickbox' );
	}

	public function enqueue_gmaps ( ) {
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

	public function enqueue_addform_cssjs ( ) {
		// Icon Font
		wp_enqueue_style(
			'twgm-addform-ionicons',
			plugin_dir_url( __FILE__ ) . 'fonts/ionicons.woff',
			array(), null, false );
		// Style
		wp_enqueue_style( 
			'twgm-addform-reset', 
			plugin_dir_url( __FILE__ ) . 'css/reset.css', 
			array(), null, false );

		wp_enqueue_style( 
			'twgm-addform-bootstrap-css', 
			plugin_dir_url( __FILE__ ) . 'css/bootstrap.css', 
			array(), null, false );
		
		wp_enqueue_style( 
			'twgm-addform-tabs-css', 
			plugin_dir_url( __FILE__ ) . 'css/tabs.css', 
			array(), null, false );
		wp_enqueue_style(
			'twgm-addform-css',
			plugin_dir_url( __FILE__ ) . 'css/addform.css',
			array(), null, false );
		// Script
		wp_enqueue_script( 
			'twgm-addform-tabs-js', 
			plugin_dir_url( __FILE__ ) . 'js/tabs.js', 
			array( 'jquery' ), $this->ver, false );
		wp_enqueue_script( 
			'twgm-addform-bootstrap-js', 
			plugin_dir_url( __FILE__ ) . 'js/bootstrap.js', 
			array( 'jquery' ), $this->ver, false );
	}

	public function enqueue_datalist_cssjs ( ) {
		// Icon FOnt
		// Style
		wp_enqueue_style(
			'twgm-datalist-css',
			plugin_dir_url( __FILE__ ) . 'css/datalist.css',
			array(), null, false );
		// Script
	}

	public function enqueue_datatable ( ) {
		// Style
		wp_enqueue_style(
			'twgm-datatable-style',
			plugin_dir_url( __FILE__ ) . 'css/datatable.css', 
			array(), null, false );
		// Script
		wp_enqueue_script( 
			'twgm-datatable-script', 
			plugin_dir_url( __FILE__ ) . 'js/datatable.js', 
			array( 'jquery' ), $this->ver, false );
			
	}

	function enqueue_colorpicker() {
		wp_enqueue_script( 
			'twgm-colorpicker', 
			plugin_dir_url( __FILE__ ) . 'js/colorpicker.js', 
			array(), $this->ver, false );
	}	

	function enqueue_codemirror() {
		// Primary
		wp_enqueue_script( 'twgm-cm-js', plugin_dir_url( __FILE__ ). 'codemirror/codemirror.js', array( 'jquery' ), $this->ver, false );
		wp_enqueue_style( 'twgm-cm-st', plugin_dir_url( __FILE__ ) . 'codemirror/codemirror.css', array(), null, false );
		// Theme
		wp_enqueue_style( 'twgm-cm-th', plugin_dir_url( __FILE__ ) . 'codemirror/material.css', array(), null, false );
		// Required Language
		wp_enqueue_script( 'twgm-cm-xml', plugin_dir_url( __FILE__ ). 'codemirror/xml.js', array( 'jquery' ), $this->ver, false );
		wp_enqueue_script( 'twgm-cm-jvs', plugin_dir_url( __FILE__ ). 'codemirror/javascript.js', array( 'jquery' ), $this->ver, false );
		wp_enqueue_script( 'twgm-cm-css', plugin_dir_url( __FILE__ ). 'codemirror/css.js', array( 'jquery' ), $this->ver, false );
		wp_enqueue_script( 'twgm-cm-php', plugin_dir_url( __FILE__ ). 'codemirror/php.js', array( 'jquery' ), $this->ver, false );
		wp_enqueue_script( 'twgm-cm-clk', plugin_dir_url( __FILE__ ). 'codemirror/clike.js', array( 'jquery' ), $this->ver, false );
	}

	function is_item_valid ( ) {
		return true;
	}

	function save_item( $page, $item_default ) {
		global $wpdb;
		$tbname = $wpdb->prefix . 'twgm_' . $page; 
		$message = '';
		$notice = '';
		$_POST['time'] = date('Y-m-d H:i:s');
		if ( isset( $_POST['twgm_nonce'] ) && wp_verify_nonce( $_POST['twgm_nonce'], $page . '-add-display.php' ) ) {
			$item = shortcode_atts( $item_default, $_POST );
			$item_valid = $this->is_item_valid( $page );
			if ( $item_valid === true ) {
				if ( $item['id'] == 0 ) {
					$result = $wpdb->insert( $tbname, $item );
					$item['id'] = $wpdb->insert_id;
					if ( $result ) {
						$message = __( 'Item was successfully saved', 'twgm' );
					} else {
						$notice = __( 'There was an error while saving', 'twgm' );
					}
				} else {
					$result = $wpdb->update( $tbname, $item, array( 'id' => $item['id'] ) );
					if ( $result > 0 ) {
						$message = __( 'Item was successfully updated', 'twgm' );
					} else if ( $result === false ) {
						$notice = __( 'There was an error while updating item', 'twgm' );
					} else if ( $result === 0 ) {
						$message = __( 'Success, but no item data were updated', 'twgm' );
					}
				}
			} else {
				$notice = $item_valid;
			}
		} else {
			$item = $item_default;
			if ( isset( $_GET['id'] ) ) {
				$item = $wpdb->get_row( $wpdb->prepare( 'SELECT * FROM ' . $tbname . ' WHERE id = %d', $_REQUEST['id'] ), ARRAY_A );
				if ( ! $item ) {
					$item 	= $item_default;
					$notice	= __( 'Item not found', 'twgm' );
				}
			}
		}
		return array(
				'message' 	=> $message,
				'notice' 	=> $notice,
				'item'		=> $item
			);
	}

	function delete_item( $page, $action, $table ) {
		global $wpdb;
		$tbname = $wpdb->prefix . 'twgm_' . $page;
		$result = false;
		$total_id = 0;
		switch ( $action ) {
			// Single Delete
			case 'sdel':
				if ( isset( $_GET['twgm_tnonce'] ) && isset( $_GET['id'] ) && wp_verify_nonce( $_GET['twgm_tnonce'], 'twgm_' . $page . '_del_' . $_GET['id'] ) ) {
					
					// Single Backup Delete
					if ( $page === 'backup' ) {
						$bd = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $tbname WHERE id=%d", $_GET['id'] ), ARRAY_A );
						if ( count( $bd ) > 0 ) {
							$fn = $bd[0]['name'];
							$upload_dir = wp_upload_dir();
							$dir_name = $upload_dir['basedir'] . '/twgm/';
							if ( ! unlink( $dir_name . $fn ) ) {
							  	echo ("Error deleting");
							}
							else {
							  	echo ("Deleted");
							}
						}
					}

					$id = is_array( $_GET['id'] ) ? $_GET['id'][0] : $_GET['id'];
					$id = absint( $id );
					if ( $id > 0 ) {
						$result = $wpdb->query( "DELETE FROM $tbname WHERE id=$id" );
						$total_id = 1;
					}
				}
				break;
			// Bulk Delete
			case 'bdel':
				if ( isset( $_POST['_wpnonce'] ) && ! empty( $_POST['_wpnonce'] ) && isset( $_POST['id'] ) ) {
					$nonce  = filter_input( INPUT_POST, '_wpnonce', FILTER_SANITIZE_STRING );
					$action = 'bulk-' . $table->_args['plural'];
					if ( ! wp_verify_nonce( $nonce, $action ) ) {
						wp_die( 'Nope! Security check failed!' );
					} else {
						$ids = isset( $_POST['id'] ) ? $_POST['id'] : array();
						if ( is_array( $ids ) ) {
							foreach( $ids as $i => $val ) {
								if ( preg_match('/^\d+$/', $val ) && $val > 0 ) {
									$ids[$i] = absint( $val );
								} else {
									unset( $ids[ $i ] );
								}
							}
						}
						if ( ! empty( $ids ) ) {
							$total_id = 1;
							if ( is_array( $ids ) ) {
								$total_id = count( $ids );
								$ids = implode( ',', $ids );
							}

							// Bulk Backup File Delete
							if ( $page === 'backup' ) {
								$bds = $wpdb->get_results( "SELECT * FROM $tbname WHERE id IN($ids)", ARRAY_A );
								if ( count( $bds ) > 0 ) {
									foreach( $bds as $bd ) {
										$fn = $bd['name'];
										$upload_dir = wp_upload_dir();
										$dir_name = $upload_dir['basedir'] . '/twgm/';
										if ( ! unlink( $dir_name . $fn ) ) {
										  	echo ("Error deleting");
										}
										else {
										  	echo ("Deleted");
										}
									}
								}
							}

							$result = $wpdb->query( "DELETE FROM $tbname WHERE id IN($ids)" );
						}
					}
				}
				break;
			// Default
			default:
				break;
		}
		return array( 'result' => $result, 'total_id' => $total_id );
	}

	public function admin_menu ( ) {
		add_menu_page(
			__( 'WP Google Maps Integration', 'twgm' ),
			__( 'WP Google Maps Integration', 'twgm' ),
			'unknown',
			'twgm',
			array( $this, 'user_manual_page' )
		);
		
		$map_table_page = add_submenu_page(
			'twgm',
			__( 'Map', 'twgm' ),
			__( 'Map', 'twgm' ),
			'twgm_map_table',
			'twgm-map-table',
			array( $this, 'map_table_page' )
		);
		add_action( "load-$map_table_page", array( $this, 'map_table_option' ) );
		
		add_submenu_page(
			'twgm',
			__( 'Add Map', 'twgm' ),
			__( 'Add Map', 'twgm' ),
			'twgm_map_add',
			'twgm-map-add',
			array( $this, 'map_add_page' )
		);
		
		$marker_table_page = add_submenu_page(
			'twgm',
			__( 'Marker', 'twgm' ),
			__( 'Marker', 'twgm' ),
			'twgm_marker_table',
			'twgm-marker-table',
			array( $this, 'marker_table_page' )
		);
		add_action( "load-$marker_table_page", array( $this, 'marker_table_option' ) );

		add_submenu_page(
			'twgm',
			__( 'Add Marker', 'twgm' ),
			__( 'Add Marker', 'twgm' ),
			'twgm_marker_add',
			'twgm-marker-add',
			array( $this, 'marker_add_page' )
		);	
		
		$category_table_page = add_submenu_page( 
			'twgm',
			__( 'Category', 'twgm' ),
			__( 'Category', 'twgm' ),
			'twgm_category_table',
			'twgm-category-table',
			array( $this, 'category_table_page' )
		);
		add_action( "load-$category_table_page", array( $this, 'category_table_option' ) );
		
		add_submenu_page( 
			'twgm',
			__( 'Add Category', 'twgm' ),
			__( 'Add Category', 'twgm' ),
			'twgm_category_add',
			'twgm-category-add',
			array( $this, 'category_add_page' )
		);
		
		$route_table_page = add_submenu_page( 
			'twgm',
			__( 'Route', 'twgm' ),
			__( 'Route', 'twgm' ),
			'twgm_route_table',
			'twgm-route-table',
			array( $this, 'route_table_page' )
		);
		add_action( "load-$route_table_page", array( $this, 'route_table_option' ) );
		
		add_submenu_page( 
			'twgm',
			__( 'Add Route', 'twgm' ),
			__( 'Add Route', 'twgm' ),
			'twgm_route_add',
			'twgm-route-add',
			array( $this, 'route_add_page' )
		);
		
		/* shape_table_page */
		
		/* infowindow_table_page */

		/* backup_page */
		
		/* role_permission */
		
		
		add_submenu_page( 
			'twgm',
			__( 'Settings', 'twgm' ),
			__( 'Settings', 'twgm' ),
			'twgm_setting',
			'twgm-setting',
			array( $this, 'setting_page' )
		);

	}

	function user_manual_page ( ) {
		echo 'user manual';
	}

	// MARKER
	function marker_table_page ( ) {
		if ( current_user_can( 'twgm_marker_table') ) {
			$this->enqueue_datalist_cssjs();
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/marker/marker-table-display.php';
		}
	}
	function marker_table_option ( ) {
    	session_start();
    	$option = 'per_page';
    	$args = array(
        	'label' 	=> 'Markers per page',
        	'default' 	=> 20,
        	'option' 	=> 'markers_per_page'
    	);
    	add_screen_option( $option, $args );
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/marker/class-marker-table.php';
    	$table = new TWGM_Marker_Table();
    	$action = $table->current_action();
    	if ( $action ) {
			$log = $this->delete_item( 'marker', $action, $table );
			if ( $log['total_id'] > 0 ) {
				$paged_param = '';
				if ( isset( $_SESSION['twgm_marker_current_page'] ) ) {
					if ( $_SESSION['twgm_marker_current_page'] > 0 ) {
						$paged_param = '&paged=' . $_SESSION['twgm_marker_current_page'];
					}
				}
				$_SESSION['twgm_marker_total_del'] = $log['total_id'];				
				wp_redirect( admin_url( 'admin.php?page=twgm-marker-table' . $paged_param ) );
				exit;
			}
		}
	}

	function marker_add_page ( ) {
		if ( current_user_can ( 'twgm_marker_add' ) ) {
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/marker/marker-add-process.php';
		}
	}

	// MAP
	function map_table_page ( ) {
		if ( current_user_can ( 'twgm_map_table' ) ) {
			$this->enqueue_datalist_cssjs();
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/map/map-table-display.php';
		}
	}

	function map_add_page ( ) {
		if ( current_user_can ( 'twgm_map_add' ) ) {
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/map/map-add-process.php';
		}
	}

	function map_table_option ( ) {
		session_start();
    	$option = 'per_page';
    	$args = array(
        	'label' 	=> 'Maps per page',
        	'default' 	=> 20,
        	'option' 	=> 'maps_per_page'
    	);
    	add_screen_option( $option, $args );
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/map/class-map-table.php';
    	$table = new TWGM_Map_Table();
    	$action = $table->current_action();
    	if ( $action ) {
			$log = $this->delete_item( 'map', $action, $table );
			if ( $log['total_id'] > 0 ) {
				$paged_param = '';
				if ( isset( $_SESSION['twgm_map_current_page'] ) ) {
					if ( $_SESSION['twgm_map_current_page'] > 0 ) {
						$paged_param = '&paged=' . $_SESSION['twgm_map_current_page'];
					}
				}
				$_SESSION['twgm_map_total_del'] = $log['total_id'];				
				wp_redirect( admin_url( 'admin.php?page=twgm-map-table' . $paged_param ) );
				exit;
			}
		}
	}

	// CATEGORY
	function category_table_page ( ) {
		if ( current_user_can( 'twgm_category_table' ) ) {
			$this->enqueue_datalist_cssjs();
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/category/category-table-display.php';
		}
	}

	function category_add_page ( ) {
		if ( current_user_can( 'twgm_category_add' ) ) {
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/category/category-add-process.php';
		}
	}

	function category_table_option ( ) {
		session_start();
    	$option = 'per_page';
    	$args = array(
        	'label' 	=> 'Categories per page',
        	'default' 	=> 20,
        	'option' 	=> 'categories_per_page'
    	);
    	add_screen_option( $option, $args );
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/category/class-category-table.php';
    	$table = new TWGM_Category_Table();
    	$action = $table->current_action();
    	if ( $action ) {
			$log = $this->delete_item( 'category', $action, $table );
			if ( $log['total_id'] > 0 ) {
				$paged_param = '';
				if ( isset( $_SESSION['twgm_category_current_page'] ) ) {
					if ( $_SESSION['twgm_category_current_page'] > 0 ) {
						$paged_param = '&paged=' . $_SESSION['twgm_category_current_page'];
					}
				}
				$_SESSION['twgm_category_total_del'] = $log['total_id'];				
				wp_redirect( admin_url( 'admin.php?page=twgm-category-table' . $paged_param ) );
				exit;
			}
		}
	}

	// ROUTE
	function route_table_page ( ) {
		if ( current_user_can( 'twgm_route_table' ) ) {
			$this->enqueue_datalist_cssjs();
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/route/route-table-display.php';
		}
	}

	function route_add_page ( ) {
		if ( current_user_can( 'twgm_route_add' ) ) {
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/route/route-add-process.php';
		}
	}

	function route_table_option ( ) {
		session_start();
    	$option = 'per_page';
    	$args = array(
        	'label' 	=> 'Routes per page',
        	'default' 	=> 20,
        	'option' 	=> 'routes_per_page'
    	);
    	add_screen_option( $option, $args );
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/route/class-route-table.php';
    	$table = new TWGM_Route_Table();
    	$action = $table->current_action();
    	if ( $action ) {
			$log = $this->delete_item( 'route', $action, $table );
			if ( $log['total_id'] > 0 ) {
				$paged_param = '';
				if ( isset( $_SESSION['twgm_route_current_page'] ) ) {
					if ( $_SESSION['twgm_route_current_page'] > 0 ) {
						$paged_param = '&paged=' . $_SESSION['twgm_route_current_page'];
					}
				}
				$_SESSION['twgm_route_total_del'] = $log['total_id'];				
				wp_redirect( admin_url( 'admin.php?page=twgm-route-table' . $paged_param ) );
				exit;
			}
		}
	}

	// SHAPE

	// INFOWINDOW

	// BACKUP
	
	// ROLE PERMISSION
	
	// SETTINGS
	function setting_page ( ) {
		if ( current_user_can( 'twgm_setting' ) ) {
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/setting/setting-process.php';
		}
	}
}

?>