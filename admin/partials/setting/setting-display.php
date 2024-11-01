
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
// Prepare Data Variable

?>

<div class="wrap">
<form class="form" role="form" method="post">
	<input type="hidden" name="twgm_nonce" value="<?php echo $twgm_nonce ?>"/>
	
	<div class="twgm-tabs" style="display:none;">
		
		<!-- FORM TABS HEADER -->
		<div class="twgm">
			<div class="twgm-page-title">
				<div class="twgm-main-title">
				<span class="icon dashicons dashicons-admin-settings"></span>
				<span>Settings</span>
				</div>
			</div>
		</div>	
		
		<!-- TABS CONTENT -->
		<ul class="twgm-tabs-content">
			
			<!-- [TAB ONE] Data -->
			<li data-content="ctg-tab-map" class="selected">
				
				<div class="twgm">
					<div class="container" style="width:100%;">

						<!-- [Form Sub Title] - Map Setting -->
						<div class="form-group form-sub-title">
							<label>Map Setting</label>
							<p>Set default value map for admin section</p>
						</div>

						<!-- GMaps API Key -->
						<div class="form-group">
						    <label>Google Maps API Key</label>
						    <input type="text" class="form-control" name="gmapsapikey" 
						    	value="<?php echo $gmaps_api_key ?>" 
						    	placeholder="Please input Google Maps API Key here...">
						</div>

						<!-- Google Maps Theme -->
						<div class="form-group">
						  	<label>Map Style</label>
						  	<textarea class="form-control" rows="7" name="maptheme"
								placeholder="Paste custom map style here..."><?php echo $gmaps_def_theme ?></textarea>
						</div>

						<div class="row">
							<!-- Default Latitude -->
							<div class="form-group col-md-5">
							    <label>Latitude</label>
							    <input type="text" class="form-control" name="maplat" 
							    	value="<?php echo $gmaps_def_lat ?>" 
							    	placeholder="Latitude">
							</div>

							<!-- GMaps API Key -->
							<div class="form-group col-md-5">
							    <label>Longitude</label>
							    <input type="text" class="form-control" name="maplng" 
							    	value="<?php echo $gmaps_def_lng ?>" 
							    	placeholder="Longitude">
							</div>

							<!-- GMaps API Key -->
							<div class="form-group col-md-2">
							    <label>Zoom</label>
							    <input type="number" class="form-control" min="0" max="21" name="defzoom" 
							    	value="<?php echo $gmaps_def_zoom ?>" 
							    	placeholder="Zoom">
							</div>							

						</div>

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

