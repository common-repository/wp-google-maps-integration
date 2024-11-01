			<!-- Marker Table -->
						<div class="form-group form-sub-title">
							<label>Marker On Map</label>
							<p>Please select marker you want to display on map</p>
						</div>

						<input type="hidden" id="markers" name="marker"
							value="<?php echo $marker ?>">
						<table id="marker-table" class="display" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>Select</th>
									<th>Name</th>
									<th>Address</th>
									<th>Latitude</th>
									<th>Longitude</th>
								</tr>
							</thead>
							<tbody>
								<?php

									$table_name = $wpdb->prefix . 'twgm_marker';
									$results = $wpdb->get_results( 'SELECT * FROM ' . $table_name );
									$number = 0;
									$markers = explode( ',', $marker );
									foreach ( $results  as $key => $row ) {
										$number++;
										$checked = in_array( $row->id, $markers ) ? 'checked' : '';
										echo '<tr>';
										echo '<td><input class="mapmarkers" name="mapmarkers[]" value="' . esc_attr( absint( $row->id ) ) . '" type="checkbox" ' . $checked . '></td>';
										echo '<td id="name_cate">' . esc_html( $row->name ) . '</td>';
										echo '<td id="parentid_cate">' . esc_html( $row->address ) . '</td>';
										echo '<td id="latitude">' . esc_html( $row->lat ) . '</td>';
										echo '<td id="longitude">' . esc_html( $row->lng ) . '</td>';
										echo '</tr>';
									}
								?>
							</tbody>
						</table>

						<!-- Undefined Category Name-->
						<?php
							$ucn = isset( $setting['undefined_category_name'] ) ? $setting['undefined_category_name'] : '';
						?>
						<div class="form-group">
							<label>Undefined Category Name</label>
							<input type="text" class="form-control" name="setting[undefined_category_name]" value="<?php echo $ucn ?>">
						</div>

						<!-- Undefined Category Group -->
						<?php
							$umg_cb = isset( $setting['uncategorized_marker_group'] ) ? 'checked' : '';
						?>
						<div class="form-gorup">
							<div class="checkbox">
								<label style="">
									<input type="checkbox" name="setting[uncategorized_marker_group]" value="1" <?php echo $umg_cb ?>>
									Please check if you want to use an uncategorized marker grouping
								</label>
							</div>
						</div>
						
						<!-- CENTER MARKER ICON -->
						<?php
							$center_marker = isset( $setting['center_marker'] ) ? esc_url( $setting['center_marker'] ) : '';
							$display = ( $center_marker !== '' ) ? 'block' : 'none'; 
						?>

						<div class="form-group form-sub-title">
							<label>Marker Icon</label>
							<p>Default setting for center marker</p>
						</div>

						<div class="row">

							<div class="form-group col-md-3"> 
								<label>Center Marker Icon</label>
								<!-- Custom Icon Upload/Select -->
								<div class="wp-media-wrapper" media-id="center_marker_icon">
									<div class="form-group">
										<label>Please upload or select Image</label>
										<img src="<?php echo $center_marker ?>" style="display:<?php echo $display ?>;">
										<input type="text" class="form-control" name="setting[center_marker]"
											value="<?php echo $center_marker ?>">
										<div class="btn-wrapper">
											<div class="btn select-img">
												<span class="glyphicon glyphicon-picture"></span>
											</div>
											<div class="btn remove-img">
												<span class="glyphicon glyphicon-remove"></span>
											</div>
										</div>
									</div>
								</div>
							</div>

						</div>

						<!-- [Form Sub Title] - Marker Cluster -->
						<?php 
							$mc 		= isset( $setting['marker_cluster'] ) ? $setting['marker_cluster'] : '';
							$mc_cb 		= isset( $mc['cb'] ) ? 'checked' : '';
							$mc_maxzoom = isset( $mc['max_zoom'] ) ? $mc['max_zoom'] : 1;
							$mc_grid 	= isset( $mc['grid'] ) ? $mc['grid'] : 10;
						?>
						<div class="form-group form-sub-title">
							<label>Marker Cluster</label>
							<p>Please activate and set the settings for marker cluster to use this feature</p>
						</div>

						<!-- [MarkerCluster] - Activate -->
						<div class="form-group">
							<div class="checkbox">
								<label style="">
									<input type="checkbox" name="setting[marker_cluster][cb]" value="1" <?php echo $mc_cb ?>>
									Activate
								</label>
							</div>
						</div>

						<!-- [MarkerCluster] -->
						<div class="row">
							<!-- [MarkerCluster] - Max Zoom -->
							<div class="form-group col-md-2">
							  	<label>Max Zoom</label>
							  	<input type="number" class="form-control"  name="setting[marker_cluster][max_zoom]" 
							  		value="<?php echo $mc_maxzoom ?>">
							</div>
							<!-- [MarkerCluster] - Grid -->
							<div class="form-group col-md-2">
								<label>Grid</label>
							  	<input type="number" class="form-control" name="setting[marker_cluster][grid]"
							  		value="<?php echo $mc_grid ?>">
							</div>
						</div>

						<!-- [Form Sub Title] - Circle on Selected -->
						<?php
							$cos = isset( $setting['cos'] ) ? $setting['cos'] : '';
							$cos_oc = isset( $cos['on_click'] ) ? $cos['on_click'] : array();
							$carousel_cb = in_array( 'carousel', $cos_oc ) ? 'checked' : '';
							$tabpanel_cb = in_array( 'tab_panel', $cos_oc ) ? 'checked' : '';
							$gridlist_cb = in_array( 'grid_list', $cos_oc ) ? 'checked' : '';
							$mapmarker_cb = in_array( 'map_marker', $cos_oc ) ? 'checked' : '';
							$cos_fillcolor = isset( $cos['fill_color'] ) ? $cos['fill_color'] : '#FFF';
							$cos_strokecolor = isset( $cos['stroke_color'] ) ? $cos['stroke_color'] : '#FFF';
							$cos_strokeweight = isset( $cos['stroke_weight'] ) ? $cos['stroke_weight'] : '2';
							$cos_radius = isset( $cos['radius'] ) ? $cos['radius'] : '100';
						?>
						<div class="form-group form-sub-title">
							<label>Circle on Selected Marker</label>
							<p>Please select element/features of item marker to activate circle overlay for selected marker where onclick event is triggered</p>
						</div>

						<!-- [CoS] - Show Circle On -->
						<div class="form-group">
							<label>On Click</label>
							<div class="checkbox">
								<label style="">
									<input type="checkbox" name="setting[cos][on_click][]" value="tab_panel" <?php echo $tabpanel_cb ?>>
									Side Panel
								</label>
							</div>
							<div class="checkbox">
								<label style="">
									<input type="checkbox" name="setting[cos][on_click][]" value="map_marker" <?php echo $mapmarker_cb ?>>
									Map
								</label>
							</div>
						</div>

						<!-- COS - Style -->
						<div class="form-group-title">
					       	<label>Circle Style</label>
					       		<p class="twgm-group-info">Input Element Color Setting</p>
					       	</div>
						<div class="row">
							<div class="form-group col-md-2 fg-color">
								<label>Fill Color</label>
								<div class="box-color color" style="background:<?php echo $cos_fillcolor ?>"></div>
								<input type="hidden" class="form-control" name="setting[cos][fill_color]"
									value="<?php echo $cos_fillcolor ?>">
							</div>
							<div class="form-group col-md-2 fg-color">
								<label>Stroke Color</label>
								<div class="box-color color" style="background:<?php echo $cos_strokecolor ?>"></div>
								<input type="hidden" class="form-control" name="setting[cos][stroke_color]"
									value="<?php echo $cos_strokecolor ?>">
							</div>
							<div class="form-group col-md-2 fg-color">
								<label>Stroke Weight</label>
								<input type="number" class="form-control" name="setting[cos][stroke_weight]"
									value="<?php echo $cos_strokeweight ?>">
							</div>
							<div class="form-group col-md-2 fg-color">
								<label>Radius</label>
								<input type="number" class="form-control" name="setting[cos][radius]"
									value="<?php echo $cos_radius ?>">
							</div>
						</div>

						



						<!-- SINGLE CPT MARKER -->
						<div class="form-group cptm-single" style="padding:17px; border:1px solid #cccccc; border-radius:4px; display:none;">
							
							<!-- [Form Sub Title] - Marker Data -->
							<div class="form-group form-sub-title">
								<label>CPT Marker Data</label>
								<p>Please fill data for CPT Marker, these data contains <b>meta_key</b> required to call all match data from CPT Table</p>
							</div>

							<!-- [CPTM] - Main Data -->
							<div class="row">
								
								<!-- [CPTM] - Post Type -->
								<div class="form-group col-md-3">
									<label>Post Type</label>
									<select class="form-control">
										<option>Post Type 1</option>
										<option>Post Type 2</option>
										<option>Post Type 3</option>
									</select>
								</div>
								
								<!-- [CPTM] - Latitude -->
								<div class="form-group col-md-3">
									<label>Latitude</label>
									<input type="text" class="form-control">
								</div>
								
								<!-- [CPTM] - Longitude -->
								<div class="form-group col-md-3">
									<label>Longitude</label>
									<input type="text" class="form-control">
								</div>
							
							</div>
							
							<!-- [CPTM] - New Field Button -->
							<div class="form-group">
								<button type="button" class="btn btn-info">Add New Field</button>
							</div>
							
							<!-- [CPTM] - New Field Form -->
							<div class="row cptm-newfield"></div>
								
							
							<!-- [CPTM] - Optional Data 1 -->
							<div class="row">

								<!-- [CPTM] - Default Icon -->
								<div class="form-group col-md-3"> 
									<label>Marker Icon</label>
									<!-- Custom Icon Upload/Select -->
									<div class="wp-media-wrapper" media-id="image">
										<div class="form-group">
											<label>Please upload or select Image</label>
											<img src="" style="display:none">
											<input type="text" class="form-control" name="image"
												value="">
											<div class="btn-wrapper">
												<div class="btn btn-blue select-img">
													<span class="glyphicon glyphicon-picture"></span>
												</div>
												<div class="btn btn-red remove-img">
													<span class="glyphicon glyphicon-remove"></span>
												</div>
											</div>
										</div>
									</div>
								</div>

								<!-- [CPTM] - Marker Behaviour -->
								<div class="form-group col-md-3">
									<label>Behaviour</label>
									<div class="checkbox">
									  	<label><input type="checkbox" value="draggable">Draggable</label>
									</div>
									<div class="checkbox">
									  	<label><input type="checkbox" value="disable_click">Disable Click</label>
									</div>
									<div class="checkbox">
									  	<label><input type="checkbox" value="default_openiw">Default Open InfoWindow</label>
									</div>
								</div>

							</div>

							<!-- [CPTM] - Optional Data 2 -->
							<div class="row">

								<!-- [CPTM] - Infowindow Style ID -->
								<div class="form-group col-md-3">
									<label>Infowindow Style ID</label>
									<input type="text" class="form-control">
								</div>

								<!-- [CPTM] - Category Default Name -->
								<div class="form-group col-md-3">
									<label>Category Name</label>
									<input type="text" class="form-control">
								</div>

								<!-- [CPTM] - Marker Animation -->
								<div class="form-group col-md-3">
									<label>Marker Animation</label>
									<select class="form-control">
										<option>NONE</option>
										<option>BOUNCE</option>
										<option>DROP</option>
									</select>
								</div>

							</div>

							<!-- [CPTM] - Remove Button -->
							<button type="button" class="btn btn-danger">Remove</button>

						</div>
