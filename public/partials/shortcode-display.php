<?php
	$id = $atts['id'];
	$sp_style = '';
	$cr_style = '';
	$gr_style = '';
?>

<?php

/* ----- FUNCTION ----- */

?>

<!-- TWGM SHORTCODE -->
<div class="twgm" style="display:none;">
	<?php
		echo $carousel_html_outside_top;
	?>
	<div class="twgm-container">
		<!-- Map -->
		<div class="twgm-map" id="map-<?php echo $atts['id'] ?>" style="width:100%; height:500px;"></div>
		<!-- Side Panel -->	
		<?php
			$feedback_style = '';
			$tab_style = 'height: calc(100% - 80px);
				height: -moz-calc(100% - 80px);
				height: -webkit-calc(100% - 80px);
				height: -o-calc(100% - 80px);';
		?>
		<div class="twgm-sp" id="sp-<?php echo $id ?>" style="">
			<div class="twgm-sp-tabs" id="sp-tabs-<?php echo $id ?>" style="height:100%">
				<!-- [SP] - Header -->
				<div class="twgm-sp-header-box" style="">
					<div class="twgm-sp-togglenav hide-menu">&#xf20d</div>
					<div class="twgm-sp-header-title">
						<div class="twgm-sph-icon"></div>
						<div class="twgm-sph-text"></div>
					</div>
				</div>
				<!-- [SP] - Nav -->
				<ul class="twgm-sp-nav" id="sp-nav-<?php echo $id ?>" style="">
					<li><a href="#tab-marker-<?php echo $id ?>" class="sp-nav-item">&#xf3a3</a></li>
					<li><a href="#tab-directions-<?php echo $id ?>" class="sp-nav-item">&#xf398</a></li>
					<li><a href="#tab-route-<?php echo $id ?>" class="sp-nav-item">&#xf262</a></li>
					<li><a href="#tab-nearby-<?php echo $id ?>" class="sp-nav-item">&#xf279</a></li>
					<li><a href="#tab-layer-<?php echo $id ?>" class="sp-nav-item">&#xf229</a></li>
					<li><a href="#tab-map_setting-<?php echo $id ?>" class="sp-nav-item">&#xf2f7</a></li>
				</ul>
				<!-- [SP] - Content -->
				<div class="twgm-sp-content" id="sp-content-<?php echo $id ?>" style="height:100%;">
					
					<!-- [SPTab] - Marker -->
					<div id="tab-marker-<?php echo $id ?>" class="nano" style="<?php echo $tab_style ?>">
						<div class="nano-content">
							<div class="tree-list" id="sp-marker-treeview-<?php echo $id ?>"></div>
						</div>
					</div>

					<!-- [SPTab] - Directions -->
					<div id="tab-directions-<?php echo $id ?>" class="nano" style="<?php echo $tab_style ?>">
						<div class="nano-content">
							<div id="sp-directions-<?php echo $id ?>">
								<!-- Directions Panel -->
								<div class="directions-panel">
									<div class="use-gps">Use My Location</div>
									<div class="directions-inputs">
										<p>
											<label style=""><div class="ionicons icon-label">&#xf456</div>Start</label>
											<input style="width:100%;" type="text" value="" class="dir-source" />
										</p>
										<p>
											<label style=""><div class="ionicons icon-label">&#xf456</div>End</label>
											<input style="width:100%;" type="text" value="" class="dir-destination" />
										</p>
										<div class="get-directions">Get Directions</div>
										<div class="pane-reset">Reset</div>
									</div>
								</div>
								<!-- Directions Steps -->
								<div class="direction-steps">
									<p class="msg">Direction Steps Will Render Here</p>
								</div>
							</div>
						</div>
					</div>

					<!-- [SPTab] - Route -->
					<div id="tab-route-<?php echo $id ?>" class="nano" style="<?php echo $tab_style ?>">
						<div class="nano-content">	
							<div class="route-list tree-list">
								<ul class="checktree"></ul>
							</div>
						</div>
					</div>

					<!-- [SPTab] - Nearby -->
					<div id="tab-nearby-<?php echo $id ?>" class="nano" style="<?php echo $tab_style ?>">
						<div class="nano-content">
							<div id="sp-np-<?php echo $id ?>">
								<div class="panel">
									<!-- NP - Anchor Type -->
									<select class="anchor-type">
										<option value="geocode" selected>Geocode</option>
										<option value="selmarker">Marker</option>
									</select>
									<!-- NP - Anchor Name -->
									<input type="text" class="anchor-name-geocode" style="display:block;">
									<input type="text" class="anchor-name-selmarker" style="display:none;" disabled>
									<!-- NP - Selected Type -->
									<div class="np-type"></div>
									<!-- NP - Process Button -->
									<div class="btn-npfind">Find Nearby Place</div>
								</div>
								<div class="np-nav">
									<div class="btn-exit">Exit</div>	
								</div>
								<div class="np-result">
									<div class="place-list"></div>
									<div class="btn-npmore">More Place</div>
								</div>

								<div class="place-details">
								</div>

								<div class="place-route" style="display:none;">
									<div class="route-orig"></div>
									<div class="route-tm">
										<div class="tm-opt"><div class="tm-icon" tm_val="WALKING">&#xf3bb</div></div>
										<div class="tm-opt"><div class="tm-icon" tm_val="DRIVING">&#xf36f</div></div>
										<div class="tm-opt"><div class="tm-icon" tm_val="BICYCLING">&#xf369</div></div>
										<div class="tm-opt"><div class="tm-icon" tm_val="TRANSIT">&#xf36d</div></div>
									</div>
									<div class="route-info">
										<div class="des-image"></div>
										<div class="des-info">
											<div class="des-name"></div>
											<div class="des-addr"></div>
											<div class="des-rating"></div>
											<div class="des-types"></div>
										</div>
									</div>
									<div id="twgm-np-route-<?php echo $id ?>" class="route-step"></div>
								</div>
							</div>
						</div>
					</div>
					
					<!-- [SPTab] - Layer -->
					<div id="tab-layer-<?php echo $id ?>" class="nano" style="<?php echo $tab_style ?>">
						<div class="nano-content">
							<div id="sp-layer-<?php echo $id ?>" class="tree-list">
								<div class="layer-list">

									<div class="kmlz-wrap">
										<label>KML/KMZ</label>
										<div class="kmlz-list"></div>
									</div>
									<div class="twgm-gap"></div>

									<div class="fusiontable-wrap">
										<label>Fusion Table</label>
										<div class="fusiontable-list"></div>
									</div>
									<div class="twgm-gap"></div>

									<div class="geojson-wrap">
										<label>GeoJSON</label>
										<div class="geojson-list"></div>
									</div>
									<div class="twgm-gap"></div>

								</div>

								<div class="shape-wrap">
									<label>Shape</label>
									<div class="shape-list"></div>
								</div>

							</div>
						</div>						
					</div>
					
					<div id="tab-map_setting-<?php echo $id ?>" style="<?php echo $tab_style ?>">
						<div class="nano-content">
							6
						</div>
					</div>
				</div>
			</div>
			<!-- Close Open Button -->
			<div class="twgm-sp-btn" style="" id="sp-btn-<?php echo $id ?>"></div>
		</div>
		<!-- Carousel Inside -->
		<?php
			echo $carousel_html_inside;
		?>
	</div>
	<!-- Carousel Outside -->
	<?php 
		echo $carousel_html_outside_bottom;
	?>
	<!-- Marker Grid List -->
	<style scoped>

		.gl-main-right[max-width~="100px"] .twgm-tile-item {
			display: none;
		}
		.gl-main-right[min-width~="0px"] .twgm-tile-item {
		    width: 100%;
		}
		.gl-main-right[min-width~="250px"] .twgm-tile-item {
		    width: 50%;
		}
		.gl-main-right[min-width~="400px"] .twgm-tile-item {
			width: 33.3334%;
		}


		.twgm[max-width~="350px"] .twgm-sp {
			position: relative !important;
			height: 300px !important;
			margin-top: 0px !important;
			width: 100% !important;
			left: 0px !important;
		}

		.twgm[max-width~="350px"] .twgm-sp-header-box {
			left: 0px !important;
			width: 100% !important;
			top: 0px !important;
		}

		.twgm[max-width~="350px"] .twgm-sp-nav {
			position: absolute !important;
			width: 100% !important;
			height: 40px !important;
			top: 55px !important;
		}

		.twgm[max-width~="350px"] .twgm-sp-nav > li {
			float: left !important;
			width: 40px !important;
			clear: none !important;
		}

		.twgm[max-width~="350px"] .twgm-sp-content {
			height: 205px !important;
			position: absolute !important;
			top: 95px !important;
			width: 100% !important;
		}

		.twgm[max-width~="350px"] .twgm-sp-content .ui-tabs-panel {
			height: 100% !important;
			width: 100% !important;
			margin-top: 0px !important;
		}

	</style>
	<div id="twgm-gl-<?php echo $id ?>"></div>
</div>

<!-- TWGM SCRIPT -->
<script type="text/javascript">
document.addEventListener("DOMContentLoaded", function(event) { 
  //do work

	(function ( $ ) {
		'use strict';
		$(document).ready(function () {

			$('.twgm').show();

			$('#map-<?php echo $atts['id'] ?>').setTWGM(
				<?php 
					echo json_encode( $result_map ) . ',' .
					json_encode( $result_marker ) . ',' .
					json_encode( $result_category ) . ','.
					json_encode( $result_route ) . ','.
					json_encode( $result_shape ) . ',' . 
					json_encode( $result_infowindow ) . ','.
					'[],'. // post_marker
					'[]' // cpt_marker
				?>
			);

		});
	})( jQuery );
});
</script>