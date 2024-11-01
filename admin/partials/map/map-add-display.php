
<!-- NOTIFICATION MESSAGE -->
<?php if ( ! empty( $notice ) ) : ?>
	<!-- Error Message -->
	<div id="notice" class="error">
		<p><?php echo $notice ?></p>
	</div>
<?php endif; ?>

<?php if ( ! empty( $message ) ): ?>
	<!-- Save/Update Message -->
	<div id="message" class="updated">
		<p><?php echo $message ?></p>
	</div>
<?php endif; ?>

<?php

global $wpdb;
$twgm_nonce 	= wp_create_nonce( basename( __FILE__ ) );
$form_type 		= ( absint( $item['id'] ) > 0 ) ? 'Edit' : 'Add';

// Prepare Data Variable
$languages = array ( 
		'ar'		=> 'Arabic', 
		'bg'		=> 'Bulgarian', 
		'bn'		=> 'Bengali', 
		'ca'		=> 'Catalan', 
		'cs'		=> 'Czech', 
		'da'		=> 'Danish', 
		'de'		=> 'German', 
		'el'		=> 'Greek', 
		'en'		=> 'English', 
		'en-AU'		=> 'English (Australian)', 
		'en-GB'		=> 'English (Great Britain)', 
		'es'		=> 'Spanish', 
		'eu'		=> 'Basque', 
		'fa'		=> 'Farsi', 
		'fi'		=> 'Finnish', 
		'fil'		=> 'Filipino', 
		'fr'		=> 'French', 
		'gl'		=> 'Galician', 
		'gu'		=> 'Gujarati', 
		'hi'		=> 'Hindi', 
		'hr'		=> 'Croatian', 
		'hu'		=> 'Hungarian', 
		'id'		=> 'Indonesian', 
		'it'		=> 'Italian', 
		'iw'		=> 'Hebrew', 
		'ja'		=> 'Japanese', 
		'kn'		=> 'Kannada', 
		'ko'		=> 'Korean', 
		'lt'		=> 'Lithaunian', 
		'lv'		=> 'Latvian', 
		'ml'		=> 'Malayalam', 
		'mr'		=> 'Marathi', 
		'nl'		=> 'Dutch', 
		'no'		=> 'Norwegian', 
		'pl'		=> 'Polish', 
		'pt'		=> 'Portuguese', 
		'pt-BR'		=> 'Portuguese (Brazil)', 
		'pt-PT'		=> 'Portuguese (Portugal)', 
		'ro'		=> 'Romanian', 
		'ru'		=> 'Russian', 
		'sk'		=> 'Slovak', 
		'sl'		=> 'Slovenian', 
		'sr'		=> 'Serbian', 
		'sv'		=> 'Swedish', 
		'ta'		=> 'Tamil', 
		'te'		=> 'Telugu', 
		'th'		=> 'Thai', 
		'tl'		=> 'Tagalog', 
		'tr'		=> 'Turkish', 
		'uk'		=> 'Ukrainian', 
		'vi'		=> 'Vietnamese', 
		'zh-CN'		=> 'Chinese (Simplified)', 
		'sh-TW'		=> 'Chinese (Traditional)'
	);

	$map_types = array( 'ROADMAP', 'SATELLITE', 'HYBRID', 'TERRAIN' );
	$google_map_layers = array( 'NONE', 'TRAFFIC', 'TRANSIT', 'BICYCLE' );
	$control_positions = array ( 
		'BOTTOM_CENTER' , 
		'BOTTOM_LEFT', 
		'BOTTOM_RIGHT', 
		'LEFT_BOTTOM', 
		'LEFT_CENTER', 
		'LEFT_TOP', 
		'RIGHT_BOTTOM', 
		'RIGHT_CENTER', 
		'RIGHT_TOP', 
		'TOP_CENTER', 
		'TOP_LEFT', 
		'TOP_RIGHT' 
	);

	$setting 	= array_replace_recursive( $default_setting, json_decode( $item['setting'], true ) );
	$marker 	= isset( $item['marker'] ) ? unserialize( $item['marker'] ) : '';
	$route 		= isset( $item['route'] ) ? unserialize( $item['route'] ) : '';
	$control 	= isset( $item['control'] ) ? json_decode( $item['control'], true ) : '';

?>

<div class="wrap">
<form class="form" role="form" method="post" id="map-form">
	<input type="hidden" name="twgm_nonce" value="<?php echo $twgm_nonce ?>"/>
	<input type="hidden" id="map-id" name="id" value="<?php echo absint( $item['id'] ) ?>"/>

	<!-- DEFAULT SETTING -->
	<input type="hidden" id="twgm-gmaps-def-lat" value="<?php echo get_option( 'twgm_gmaps_def_lat', 0 ) ?>">
	<input type="hidden" id="twgm-gmaps-def-lng" value="<?php echo get_option( 'twgm_gmaps_def_lng', 0 ) ?>">
	<input type="hidden" id="twgm-gmaps-def-theme" value="<?php echo htmlspecialchars( str_replace( "\\", "", json_decode( get_option( 'twgm_gmaps_def_theme', '' ) ) ),ENT_COMPAT ) ?>">
	<input type="hidden" id="twgm-gmaps-def-zoom" value="<?php echo get_option( 'twgm_gmaps_def_zoom', 10 ) ?>">
	
	<div class="twgm-tabs" style="display:none;">
		
		<!-- FORM TABS HEADER -->
		<div class="twgm">
			<div class="twgm-page-title">
				<div class="twgm-main-title">
				<span class="icon dashicons dashicons-location-alt"></span>
				<span><?php echo $form_type ?> Map</span>
				</div>
			</div>
		</div>
		
		<!-- TABS TABS NAVIGATION -->
		<nav>
			<ul class="twgm-tabs-navigation">
				<li><a data-content="ctg-tab-data" class="selected" href="#">Data</a></li>
				<li><a data-content="ctg-tab-marker" href="#">Marker</a></li>
				<li><a data-content="ctg-tab-additional" href="#">Additional</a></li>
				<li><a data-content="map-tab-setting" href="#">Setting</a></li>
			</ul> <!-- cd-tabs-navigation -->
		</nav>	
		
		<!-- TABS CONTENT -->
		<ul class="twgm-tabs-content">

			<!-- [TAB ONE] Data -->
			<li data-content="ctg-tab-data" class="selected">
				<div class="twgm">
					<div class="container" style="width:100%;">

					<!-- MAP MAIN DATA -->
					<?php 
						require_once plugin_dir_path( dirname( __FILE__ ) ) . 'map/subform/map-form-mapdata.php';
					?>

					</div>
				</div>
			</li>

			<!-- [TAB TWO] - Marker -->
			<li data-content="ctg-tab-marker">
				<div class="twgm">
					<div class="container" style="width:100%">
					
					<!-- MARKER AND ITS SETTING -->
					<?php
						require_once plugin_dir_path( dirname( __FILE__ ) ) . 'map/subform/map-form-marker.php';
					?>

					</div>
				</div>
			</li>

			<!-- [TAB THREE] - Additional -->
			<li data-content="ctg-tab-additional">				
				<div class="twgm">
					<div class="container" style="width:100%">
					
					<!-- ADDITIONAL LAYER -->	
					<?php
						require_once plugin_dir_path( dirname( __FILE__ ) ) . 'map/subform/map-form-additional.php';
					?>					

					</div>
				</div>
			</li>

			<!-- [TAB FOUR] - Setting -->
			<li data-content="map-tab-setting">
				
				<div class="twgm">
					<div class="container" style="width:100%">

					<!-- MAP CONTROL -->						
					<?php
					require_once plugin_dir_path( dirname( __FILE__ ) ) . 'map/subform/map-form-control.php';
					?>

					<!-- STREETVIEW PANORAMA -->
					<?php
					//require_once plugin_dir_path( dirname( __FILE__ ) ) . 'map/subform/map-form-streetviewpanorama.php';
					?>

					<!-- GRID OVERLAY -->
					<?php
					//require_once plugin_dir_path( dirname( __FILE__ ) ) . 'map/subform/map-form-gridoverlay.php';
					?>

					<!-- LIMIT POSITION -->
					<?php
					//	require_once plugin_dir_path( dirname( __FILE__ ) ) . 'map/subform/map-form-limitposition.php';
					?>

					<!-- SIDEPANEL -->
					<?php
						require_once plugin_dir_path( dirname( __FILE__ ) ) . 'map/subform/map-form-sidepanel.php';
					?>

					<!-- INFOWINDOW -->
					<?php
						require_once plugin_dir_path( dirname( __FILE__ ) ) . 'map/subform/map-form-infowindow.php';
					?>						

					<!-- CAROUSEL -->
					<?php
					//	require_once plugin_dir_path( dirname( __FILE__ ) ) . 'map/subform/map-form-carousel.php';
					?>

					<!-- DIRECTIONS SERVICE -->
					<?php
					//	require_once plugin_dir_path( dirname( __FILE__ ) ) . 'map/subform/map-form-directionsservice.php';
					?>

					<!-- NEARBY PLACE -->
					<?php
					//	require_once plugin_dir_path( dirname( __FILE__ ) ) . 'map/subform/map-form-nearbyplace.php';
					?>

					<!-- CPT MARKER -->
					<?php
					//	require_once plugin_dir_path( dirname( __FILE__ ) ) . 'map/subform/map-form-cptmarker.php';
					?>					

					<!-- GRID LIST -->
					<?php 
					//	require_once plugin_dir_path( dirname( __FILE__ ) ) . 'map/subform/map-form-gridlist.php';
					?>

					<!-- RADIUS FILTER -->
					<?php
					//	require_once plugin_dir_path( dirname( __FILE__ ) ) . 'map/subform/map-form-radiusfilter.php';
					?>


					</div>
				</div>
			</li>

		</ul>

		<!-- FORM TABS FOOTER -->
		<div class="twgm twgm-footer">
			<div class="twgm-mark">Dynamic Google Map<br>www.trapesium.net</div>
			<div class="twgm-submit-wrapper">
				<button type="submit" class="btn btn-orange">
					<span class="glyphicon glyphicon glyphicon-saved"></span>
					Submit
				</button>
			</div>
		</div>

	</div>
</form>
</div>

