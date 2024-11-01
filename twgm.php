<?php


/**
 *
 * @link              https://twgm.trapesium.net
 * @since             1.0
 * @package           twgm
 *
 * @wordpress-plugin
 * Plugin Name:       WP Google Maps Integration
 * Plugin URI:        https://twgm.trapesium.net
 * Description:       This is a plugin that lets users take advantage of Google Maps Service in place and route management and display it in list form.
 * Version:           1.2
 * Author:            Trapesium
 * Author URI:        https://trapesium.net
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       twgm
 * Domain Path:       /languages
 */


if ( ! defined( 'WPINC' ) ) {
	die;	
}


global $twgm_db_ver;
$twgm_db_ver = '1.2';


add_action( 'activated_plugin', 'twgm_save_error' );
function twgm_save_error ( ) {
	update_option( 'plugin_error', ob_get_contents( ) );
}


function twgm_create_table ( ) {	
	global $wpdb;
	global $twgm_db_ver;
	$old_ver = get_option( 'twgm_db_ver' );
	$charset_collate = $wpdb->get_charset_collate();
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	
	if ( $old_ver != $twgm_db_ver ) {
		
		// Marker
		$table_name = $wpdb->prefix . 'twgm_marker';
		$sql = "CREATE TABLE " . $table_name . " (
			id int(11) NOT NULL AUTO_INCREMENT,
			name VARCHAR(255) NOT NULL,
			address VARCHAR(255) NOT NULL,
			description TEXT NOT NULL,
			lat DOUBLE,
			lng DOUBLE, 
			state VARCHAR(255),
			city VARCHAR(255),
			country VARCHAR(255),
			postalcode VARCHAR(255),
			setting TEXT,
			category VARCHAR(255),
			maincategory int(11),
			image VARCHAR(255),
			extrafield TEXT,
			time DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
			PRIMARY KEY  (id)
		) $charset_collate;";
		dbDelta( $sql );
		
		// Category
		$table_name = $wpdb->prefix . 'twgm_category';
		$sql = "CREATE TABLE " . $table_name . " (
		  	id int(11) NOT NULL AUTO_INCREMENT,
		  	name VARCHAR(255) NOT NULL,
		  	description VARCHAR(255) NOT NULL,
		  	iconpath VARCHAR(255) NOT NULL,
		  	time DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
		  	PRIMARY KEY  (id)
		) $charset_collate;";
		dbDelta( $sql );

		// Route
		$table_name = $wpdb->prefix . 'twgm_route';
		$sql = "CREATE TABLE " . $table_name . " (
			id int(11) NOT NULL AUTO_INCREMENT,
			name VARCHAR(255) NOT NULL,
			description VARCHAR(255) NOT NULL,
			startpoint VARCHAR(255) NOT NULL,
			endpoint VARCHAR(255) NOT NULL,
			waypoints VARCHAR(255),
			stopover VARCHAR(255),
			setting TEXT,
			time DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
			PRIMARY KEY  (id)
		) $charset_collate;";
		dbDelta( $sql );

		// Shape
		
		// Infowindow
		
		// Map
		$table_name = $wpdb->prefix . 'twgm_map';
		$sql = "CREATE TABLE " . $table_name . " (
			id int(11) NOT NULL AUTO_INCREMENT,
			name VARCHAR(255) NOT NULL,
			description VARCHAR(255),
			setting TEXT,
			marker TEXT,
			route TEXT,
			control TEXT,
			layer TEXT,
			shape VARCHAR(255),
			cpt TEXT,
			time DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
			PRIMARY KEY  (id)
		) $charset_collate;";
		dbDelta( $sql );

		// Backup
		
		
		// Database Versioning
		if ( $old_ver ) {
			update_option( 'twgm_db_ver', $twgm_db_ver );
		} else {
			add_option( 'twgm_db_ver', $twgm_db_ver );
		}
	}
}



function twgm_load_widget ( ) {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-twgm-widget.php';
	register_widget( 'TWGM_Widget' );
}
add_action( 'widgets_init', 'twgm_load_widget' );



function twgm_load_mbox ( ) {
	require_once plugin_dir_path( __FILE__ ) . 'admin/partials/metabox/class-metabox.php';
	new TWGM_Metabox();
}
add_action( 'load-post-new.php', 'twgm_load_mbox' );
add_action( 'load-post.php', 'twgm_load_mbox' );



function twgm_install ( $networkwide ) {
	/* WARNING : Please add Uninstall Script */
	global $wpdb;
	if ( function_exists( 'is_multisite' ) && is_multisite() ) {
		if ( $networkwide ) {
			$old_blog = $wpdb->blogid;
			$blogids = $wpdb->get_col( "SELECT blog_id FROM $wpdb->blogs" );
			foreach ( $blogids as $blogid ) {
				switch_to_blog( $blogid );
				twgm_create_table();
			}
			switch_to_blog ( $old_blog );
			return;
		}
	}
	twgm_create_table();
}


/* Plugin Activation Callback */
register_activation_hook( __FILE__, 'activate_twgm' );
function activate_twgm ( $networkwide ) {
	twgm_install( $networkwide );
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-twgm-activator.php';
	TWGM_Activator::activate();
}


/* Plugin Deactivation Callback */
register_deactivation_hook( __FILE__, 'deactivate_twgm' );
function deactivate_twgm ( ) {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-twgm-deactivator.php';
 	TWGM_Deactivator::deactivate();
}


/* Set Screen Options for Table*/
add_filter( 'set-screen-option', 'twgm_set_screen', 10, 3 );
function twgm_set_screen ( $status, $option, $value ) {
	return $value;
}

/* MEDIA FOR MARKER ICONS */
function twgm_media_menu($tabs) {
	$newtab = array('twgmmi' =>  __('Marker Icons', 'twgm'));
	return array_merge($tabs, $newtab);
}
add_filter('media_upload_tabs', 'twgm_media_menu');

function twgm_media_menu_handle() {
	wp_enqueue_script( 'twgm-marker-icon-js', plugins_url( 'admin/js/markericon_uploads.js', __FILE__ ), 'jquery' );
	wp_enqueue_style( 'twgm-marker-icon-css', plugins_url( 'admin/css/markericon_uploads.css', __FILE__ ) );
	return wp_iframe( 'media_twgm_process');
}
function media_twgm_process() {	
	media_upload_header();
	$icons = scandir( plugin_dir_path( __FILE__ ) . 'assets/marker-icons' );
	?>
	<div class="twgm-marker-wrap">
	<?php
	foreach( $icons as $icon ) {
		if ( $icon === '.' || $icon === '..' ) continue;
		?>
		<div class="twgm-marker-icon">
			<img src="<?php echo plugins_url( 'assets/marker-icons/', __FILE__ ) . $icon ?>">
			<input type="radio" name="twgm-mi-selected" class="twgm-marker-radio">
		</div>
		<?php
	}
	?>
	</div>
	<div class="twgm-button-wrap">
		<input type="button" id="twgm-marker-ok" class="btn" value="OK">
	</div>
	<?php
}
add_action('media_upload_twgmmi', 'twgm_media_menu_handle');



/* Run this Plugin */
require plugin_dir_path( __FILE__ ) . 'includes/class-twgm.php';
function run_twgm ( ) {
	$plugin = new TWGM();
	$plugin->run();
}
run_twgm();


?>