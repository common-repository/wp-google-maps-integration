
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
	$twgm_nonce 		= wp_create_nonce( basename( __FILE__ ) );
	$form_type 			= ( absint( $item['id'] ) > 0 ) ? 'Edit' : 'Add';
	$waypoints 			= unserialize( $item['waypoints'] );
	$stopover 			= unserialize( $item['stopover'] );
	$setting 			= json_decode( $item['setting'], TRUE );

	$md_name 			= isset( $item['name'] ) ? $item['name'] : '';
	$md_description 	= isset( $item['description'] ) ? $item['description'] : '';
	$md_startpoint		= isset( $item['startpoint'] ) ? absint( $item['startpoint'] ) : 0;
	$md_endpoint 		= isset( $item['endpoint'] ) ? absint( $item['endpoint'] ) : 0;
	$st_travelmode		= isset( $setting['travelmode'] ) ? $setting['travelmode'] : 'DRIVING';
	$st_strokecolor		= isset( $setting['stroke']['color'] ) ? $setting['stroke']['color'] : 'gray';
	$st_strokeweight 	= isset( $setting['stroke']['weight'] ) ? $setting['stroke']['weight'] : 0;
	$st_draggable 		= isset( $setting['draggable'] ) ? 1 : 0;
	$st_unitsystem 		= isset( $setting['unitsystem'] ) ? $setting['unitsystem'] : 'METRIC';
	$st_usingwaypoint	= isset( $setting['usingwaypoint'] ) ? 1 : 0;


	// Get Markers
	global $wpdb;
	$table_name = $wpdb->prefix . 'twgm_marker';
	$markers 	= $wpdb->get_results( 'SELECT * FROM ' . $table_name . ' ORDER BY name'); 
?>

<div class="wrap">
<form class="form" role="form" method="post">
	<input type="hidden" name="twgm_nonce" value="<?php echo $twgm_nonce ?>"/>
	<input type="hidden" name="id" value="<?php echo absint( $item['id'] ) ?>"/>
	
	<div class="twgm-tabs" style="display:none;">
		
		<!-- FORM TABS HEADER -->
		<div class="twgm">
			<div class="twgm-page-title">
				<div class="twgm-main-title">
				<span class="icon dashicons dashicons-share"></span>
				<span><?php echo $form_type ?> Route</span>
				</div>
			</div>
		</div>
		
		<!-- TABS TABS NAVIGATION -->
		<nav>
			<ul class="twgm-tabs-navigation">
				<li><a data-content="ctg-tab-data" class="selected" href="#">Data</a></li>
				<li><a data-content="ctg-tab-waypoints" href="#">Waypoints</a></li>
				<li><a data-content="ctg-tab-setting" href="#">Setting</a></li>
			</ul> <!-- cd-tabs-navigation -->
		</nav>	
		
		<!-- TABS CONTENT -->
		<ul class="twgm-tabs-content">
			
			<!-- [TAB ONE] Data -->
			<li data-content="ctg-tab-data" class="selected">
				
				<div class="twgm">
					<div class="container" style="width:100%;">

					<!-- [Form Sub Title] - Route Data -->
						<div class="form-group form-sub-title">
							<label>Route Data</label>
							<p>Please fill below information to this route, this information can allow you to find the route that you want when adding to the map</p>
						</div>

						<!-- Name -->
						<div class="form-group">
						    <label>Name</label>
						    <input type="text" class="form-control" name="name" 
						    	value="<?php echo $md_name ?>" 
						    	placeholder="Location name">
						</div>

						<!-- Description -->
						<div class="form-group">
						  	<label>Description</label>
						  	<textarea class="form-control" rows="7" name="description"
								placeholder="Specific description about location"><?php echo $md_description ?></textarea>
						</div>

						
						<div class="row">

							<!-- Start Point -->
							<div class="form-group col-md-6">
								<label>Start Point</label>
								<select class="form-control" name="startpoint">
									<?php 
										$selected = '';
										if ( $md_startpoint === 0 ) {
											$selected = 'selected';
										}
									?>
									<option value="0" <?php echo $selected ?>>Please select Start Point</option>
									<?php
										foreach ( $markers  as $key => $row ) {
											$selected = ( absint( $row->id ) === $md_startpoint ) ? 'selected' : '';
											$id = $row->id;
											$name = $row->name;
											echo '<option value="' . esc_attr( $id ) . '" ' . $selected . '>' . esc_html( $name ) . '</option>';
										}
									?>
								</select>
							</div>

							<!-- End Point -->
							<div class="form-group col-md-6">
								<label>End Point</label>
								<select class="form-control" name="endpoint">
									<?php
										$selected = '';
										if ( $md_endpoint === 0 ) {
											$selected = 'selected';
										}
									?>
									<option value="0" <?php echo $selected ?>>Please select End Point</option>
									<?php
										foreach ( $markers  as $key => $row ) {
											$selected = ( absint( $row->id ) === $md_endpoint ) ? 'selected' : '';
											$id = $row->id;
											$name = $row->name;
											echo '<option value="' . esc_attr( $id ) . '" ' . $selected . '>' . esc_html( $name ) . '</option>';
										}
									?>
								</select>
							</div>

						</div>

					</div>
				</div>
			</li>

			<!-- [TAB TWO] Waypoints -->
			<li data-content="ctg-tab-waypoints">

				<div class="twgm">
					<div class="container" style="width:100%">

						<!-- Using Waypoints -->
						<div class="form-group">
							<label>Please check to activate using waypoint</label>
							<div class="checkbox">
								<?php
									$cb_usingwaypoint = ( $st_usingwaypoint === 1 ) ? 'checked' : '';
								?>
							  	<label><input type="checkbox" name="setting[usingwaypoint]" value="1" <?php echo $cb_usingwaypoint ?>>Activate</label>
							</div>
						</div>

						<!-- Waypoints Input -->
						<input type="hidden" name="waypoints" id="waypoints" value="<?php echo $waypoints;?>">
						<input type="hidden" name="stopover" id="stopover" value="<?php echo $stopover;?>">

						<!-- Markers Table -->
						<table id="markertable" class="display" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>Select</th>
									<th>Name</th>
									<th>Address</th>
									<th>Latitude</th>
									<th>Longitude</th>
									<th>Stopover</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$number 			= 0;
									$waypoints 			= explode( ',', $waypoints );
									$stopover 			= explode( ',', $stopover );
									foreach ( $markers  as $key => $row ) {
										$number++;
										$checked = in_array( $row->id, $waypoints ) ? 'checked' : '';
										$checked2 = in_array( $row->id, $stopover ) ? 'checked' : '';
										echo '<tr>';
										echo '<td><input value="' . absint( $row->id ) . '" cbtype="waypoint" type="checkbox" ' . $checked . '></td>';
										echo '<td id="name_cate">' . esc_html( $row->name ) . '</td>';
										echo '<td id="parentid_cate">' . esc_html( $row->address ) . '</td>';
										echo '<td id="latitude">' . esc_html( $row->lat ) . '</td>';
										echo '<td id="longitude">' . esc_html( $row->lng ) . '</td>';
										echo '<td><input value="' . absint( $row->id ) . '" cbtype="stopover" type="checkbox" ' . $checked2 . '></td>';
										echo '</tr>';
									}
								?>
							</tbody>
						</table>

					</div>
				</div>
			</li>

			<!-- [TAB THREE] Setting -->
			<li data-content="ctg-tab-setting">
				
				<div class="twgm">
					<div class="container" style="width:100%">

						<div class="row">
							<!-- Travel Mode -->
							<div class="form-group col-md-6">
								<label>Travel Mode</label>
								<select class="form-control" name="setting[travelmode]">
									<?php
										$travelmode = array( 
											'DRIVING' => 'Driving', 
											'WALKING' => 'Walking', 
											'BICYCLING' => 'Bicycling', 
											'TRANSIT' => 'Transit' 
										);
										while ( list( $key, $val ) = each( $travelmode ) ) { 
											echo '<option value="' . $key . '"' . ( ( $st_travelmode == $key ) ? 'selected' : '' ) . '>' . $val . '</option>'; 
										}
									?>
								</select>
							</div>

							<!-- Unit System -->
							<?php
								$unitsystem = array( 
									'METRIC' => 'Metric', 
									'IMPERIAL' => 'Imperial' 
								); 
							?>
							<div class="form-group col-md-6">
								<label>Unit System</label>
								<select class="form-control" name="setting[unitsystem]">
									<?php
										while ( list( $key, $val ) = each( $unitsystem ) ) { 
											$selected = ( $st_unitsystem === $key ) ? 'selected' : '';
											echo '<option value="' . $key . '"' . $selected . '>' . $val . '</option>'; 
										}
									?>
								</select>
							</div>
						</div>

						<div class="row">
							<!-- [Route] - Color -->
							<div class="form-group col-md-2 fg-color">
								<label>Route Color</label>
								<div class="box-color color" style="background:<?php echo $st_strokecolor ?>"></div>
								<input type="hidden" class="form-control" name="setting[stroke][color]"
									value="<?php echo $st_strokecolor ?>">
							</div>		

							<!-- [Route] - Weight -->
							<div class="form-group col-md-2">
								<label>Stroke Weight</label>
								<input type="number" class="form-control" name="setting[stroke][weight]"
									value="<?php echo $st_strokeweight ?>">
							</div>

							<!-- [Route] - Draggable -->
							<div class="form-group col-md-2">
								<label>Draggable</label>
								<div class="checkbox">
									<?php
										$cb_draggable = ( $st_draggable === 1 ) ? 'checked' : '';
									?>
								  	<label><input type="checkbox" name="setting[draggable]" value="1" <?php echo $cb_draggable ?>>Activate</label>
								</div>
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

