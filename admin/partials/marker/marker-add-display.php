<?php if ( ! empty( $notice ) ) : ?>
	<div id="notice" class="error">
		<p><?php echo $notice ?></p>
	</div>
<?php endif; ?>

<?php if ( ! empty( $message ) ): ?>
	<div id="message" class="updated">
		<p><?php echo $message ?></p>
	</div>
<?php endif; ?>

<?php 	
	global $wpdb;
	$twgm_nonce 	= wp_create_nonce( basename( __FILE__ ) );
	$setting 		= array_replace_recursive( $setting_default, json_decode( $item['setting'], TRUE ) );
	$form_type	 	= ( absint( $item['id'] ) > 0 ) ? 'Edit' : 'Add';
	$category 		= unserialize( $item['category'] );
	$extrafield 	= unserialize( $item['extrafield'] );

	$md_name 			= $item['name'];
	$md_address 		= $item['address'];
	$md_description 	= $item['description'];
	$md_lat				= $item['lat'];
	$md_lng				= $item['lng'];
	$md_city			= $item['city'];
	$md_state			= $item['state'];
	$md_country			= $item['country'];
	$md_postalcode 		= $item['postalcode'];
	$md_maincategory 	= $item['maincategory'];
	$md_image			= $item['image'];
	$st_icontype		= $setting['icon_type'];
	$st_onclick			= $setting['onclick'];
	$st_behaviour		= $setting['behaviour'];
	$st_animation		= $setting['animation'];
?>

<div class="wrap">
<form class="form" role="form" method="post">
	<input type="hidden" name="twgm_nonce" value="<?php echo $twgm_nonce ?>"/>
	<input type="hidden" id="marker-id" name="id" value="<?php echo absint( $item['id'] ) ?>"/>

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
				<span class="icon dashicons dashicons-location"></span>
				<span><?php echo $form_type ?> Marker</span>
				</div>
			</div>
		</div>
		
		<!-- TABS TABS NAVIGATION -->
		<nav>
			<ul class="twgm-tabs-navigation">
				<li><a data-content="ctg-tab-data" class="selected" href="#">Data</a></li>
				<li><a data-content="ctg-tab-category" href="#">Category</a></li>
				<li><a data-content="ctg-tab-setting" href="#">Setting</a></li>
			</ul> <!-- cd-tabs-navigation -->
		</nav>	
		
		<!-- TABS CONTENT -->
		<ul class="twgm-tabs-content">
			
			<!-- [TAB ONE] Data -->
			<li data-content="ctg-tab-data" class="selected">
				
				<div class="twgm">
					<div class="container" style="width:100%;">
						
						<!-- [Form Sub Title] - Marker Data -->
						<div class="form-group form-sub-title">
							<label>Marker Data</label>
							<p>Please fill the information to marker, this information can be displayed on the map</p>
						</div>
						
						<div class="row">
							
							<div class="col-md-6">
								
								<!-- Name -->
								<div class="form-group">
								    <label>Name</label>
								    <input type="text" class="form-control" name="name" 
								    	value="<?php echo $item['name'] ?>" 
								    	placeholder="Location name">
								</div>
								
								<!-- Address -->
								<div class="form-group">
								    <label>Address</label>
								    <input type="text" class="form-control" name="address" 
								    	value="<?php echo $item['address'] ?>" 
								    	placeholder="Location address">
								</div>
								
								<!-- Description -->
								<div class="form-group">
								  	<label>Description</label>
								  	<textarea class="form-control" rows="7" style="resize:none;" name="description"
										placeholder="Specific description about location"><?php echo $item['description'] ?></textarea>
								</div>
								
								<!-- Position -->
								<div class="form-group">
							       	<div class="form-group-title">
							       		<label>Position</label>
							       		<p class="twgm-group-info">Drag marker to set Latitude and Longitude</p>
							       	</div>
							       	<div class="row">
							       		<!-- Latitude -->
							       		<div class="form-group col-md-6">
							       			<label>Latitude</label>
								    		<input type="text" id="lat" class="form-control" name="lat"
								    			value="<?php echo $item['lat'] ?>">
							       		</div>
							       		<!-- Longitude -->		
							       		<div class="form-group col-md-6">
							       			<label>Longitude</label>
								    		<input type="text" id="lng" class="form-control" name="lng"
								    			value="<?php echo $item['lng'] ?>">
							       		</div>
							       </div>
							    </div>

							</div>
							
							<div class="col-md-6">

								<!-- Map -->
							    <div class="form-group" >
							    	<label>Location Map</label>
							    	<div class="checkbox">
										<label style="font-size:11px;">
											<input type="checkbox" id="cb-specific-infowindow" value="">
											Show InfoWindow for specific information
										</label>
									</div>
							    	<div id="map" style="width:100%; height:330px;"></div>
							    	<label style="font-size:11px;">
							    		Find your location here:
							    	</label>
							    	<input type="text" id="address-finder" class="form-control">
							    </div>

							    <!-- Fill Button -->
							    <div id="fill-btn" class="row" style="display:none;">
						    		<div class="col-md-12">
							    		<div data-fill="city" class="btn btn-blue btn-fill btn-sm">City</div>
							    		<div data-fill="state" class="btn btn-blue btn-fill btn-sm">State</div>
							    		<div data-fill="country" class="btn btn-blue btn-fill btn-sm">Country</div>
							    		<div data-fill="postal-code" class="btn btn-blue btn-fill btn-sm">Postal Code</div>
							    		<div data-fill="all" class="btn btn-blue btn-fill btn-sm">All</div>
						    		</div>
						    	</div>

						    </div>

					    </div>
						
					    <!-- State, City, Country, PostalCode -->
					    <div class="form-group">
					    	<div class="form-group-title">
						    	<label>Additional Information</label>
						    	<p class="twgm-group-info">You can fill these info using buttons below map</p>
					    	</div>
					    	
					    	<div class="row">

					    		<!-- City -->
					    		<div class="form-group col-md-3">
					    			<label>
					    				<span class="glyphicon glyphicon-arrow-down btn-fill" data-fill="city"></span>
					    				City
					    			</label>
					    			<input type="text" id="city" class="form-control" name="city" 
					    				value="<?php echo $item['city'] ?>"
					    				placeholder="Enter city here">
					    		</div>
					    		
					    		<!-- State -->
					    		<div class="form-group col-md-3">
					    			<label>
					    				<span class="glyphicon glyphicon-arrow-down btn-fill" data-fill="state"></span>
					    				State
					    			</label>
					    			<input type="text" id="state" class="form-control" name="state" 
					    				value="<?php echo $item['state'] ?>"
					    				placeholder="Enter state here">
					    		</div>

					    		<!-- Country -->
					    		<div class="form-group col-md-3">
					    			<label>
					    				<span class="glyphicon glyphicon-arrow-down btn-fill" data-fill="country"></span>
					    				Country
					    			</label>
					    			<input type="text" id="country" class="form-control" name="country" 
					    				value="<?php echo $item['country'] ?>"
					    				placeholder="Enter country here">
					    		</div>

					    		<!-- Postal Code -->
					    		<div class="form-group col-md-3">
					    			<label>
					    				<span class="glyphicon glyphicon-arrow-down btn-fill" data-fill="postal-code"></span>
					    				Postal Code
					    			</label>
					    			<input type="text" id="postal-code" class="form-control" name="postalcode" 
					    				value="<?php echo $item['postalcode'] ?>"
					    				placeholder="Enter postal code here">
					    		</div>

					    	</div>

					    </div>

					    <!-- [Form Sub Title] -->
						<div class="form-sub-title" style="margin-bottom:-15px;">
							<label>Custom Information</label>
							<p>Please click below button to add new information field</p>
						</div>
					    
					    <!-- Extra Field -->
						<div class="form-group">
							<div class="row" style="margin-top:5px;">
								<div class="col-md-3">
									<div id="add-extra-field" class="btn btn-sm">
										<span class="glyphicon glyphicon-plus"></span>
										Add Extra Field
									</div>	
								</div>
							</div>
						</div>

						<!-- [EF] - Form -->
						<div id="extra-field-form" class="form-group" style="display:none;">
							<div class="row" style="background:#eeeeee; padding:10px 0px;">
								<div class="col-md-2">
									<label>Data Key</label>
								</div>
								<div class="col-md-4">
									<input id="extra-field-key" type="input" class="form-control" placeholder="Please enter data key">
									<div id="extra-field-ok" class="btn ef-form-btn">
										<span class="glyphicon glyphicon-ok"></span>
									</div>
									<div id="extra-field-cancel" class="btn ef-form-btn">
										<span class="glyphicon glyphicon-remove"></span>
									</div>
								</div>
							</div>
						</div>

						<!-- [EF] - Result -->
						<div id="extra-field-result" class="form-group">
							<?php
								if ( $extrafield !== NULL ) {
									foreach ($extrafield as $key => $value) {
										?>
										<div class="row single-extra-field" style="padding:5px 0px;">
											<div class="col-md-2">
												<label><?php echo $key ?></label>
											</div>
											<div class="col-md-4">
												<input name="extrafield[<?php echo $key ?>]" type="text" class="form-control" placeholder="Please enter data value"
													value="<?php echo $value ?>">
												<div class="remove-extra-field">
													<span class="glyphicon glyphicon-remove"></span>
												</div>
											</div>
										</div>
										<?php
									}	
								}
							?>
						</div>

					</div>
				</div>

			</li>
			
			<!-- [TAB TWO] Category -->
			<li data-content="ctg-tab-category">

				<div class="twgm">
					<div class="container" style="width:100%">

						<!-- [Form Sub Title] -->
						<div class="form-group form-sub-title">
							<label>Marker Category</label>
							<p>Please choose single or multiple category to marker and assign main category to it. All selected category will be displayed on the below category table</p>
						</div>

						<!-- Category Table -->
						<input type="hidden" id="category" name="category" value="<?php echo $category ?>">
						<table id="category-table" class="display" cellspacing="0" width="100%">
							<!-- Table Head -->
							<thead>
								<tr>
									<th>Check</th>
									<th>Name</th>
									<th>Description</th>
									<th>Icon</th>
								</tr>
							</thead>
							<!-- Table Body -->
							<tbody>
								<?php
									$table_name = $wpdb->prefix . 'twgm_category';
									$results 	= $wpdb->get_results( 'SELECT * FROM ' . $table_name );
									$number 	= 0;
									$category 	= explode( ',', $category );
									$selctg 	= array();
									foreach ( $results  as $key => $row ) {
										$my_column = $row->name;
										$number++;
										$checked = '';
										if ( in_array( $row->id, $category ) ) {
											$checked = 'checked';
											array_push( $selctg, 
												array( 
													'id' => $row->id,
													'name' => $row->name,
													'description' => $row->description,
													'iconpath' => $row->iconpath
												) 
											) ;
										}										
										?>
										<tr>
											<td>
												<input class="ctg-id" 
													name="category_id[]" 
													value="<?php echo intval( $row->id )?>" 
													type="checkbox" 
													<?php echo $checked ?>>
											</td>
											<td class="ctg-name">
												<?php echo esc_html( $row ->name ) ?>
											</td>
											<td class="ctg-desc">
												<?php echo esc_html( $row->description ) ?>
											</td>
											<td class="ctg-icon">
												<img class="ctg-img" style="" src="<?php echo esc_url( $row->iconpath ) ?>">
											</td>
										</tr>
										<?php
									}
								?>
							</tbody>
						</table>

						<!-- [Form Sub Title] -->
						<div class="form-group form-sub-title" style="margin-top:30px; margin-bottom:-15px;">
							<label>Main Category</label>
							<p>Please choose main category for this marker</p>
						</div>

						<!-- Main Category Table -->
						<div style="width:100%; background:white; overflow:auto;">
							<table class="table">
							  	<thead>
							    	<tr>
							      		<th style="width:70px;">Select</th>
							      		<th>Name</th>
							      		<th style="width:60px;">Icon</th>
							    	</tr>
							  	</thead>
							  	<tbody id="selected-category-table">
							  		<?php
							  			foreach ( $selctg as $ctg ) {
							  				$is_checked = ( absint( $md_maincategory ) === absint( $ctg['id'] ) ) ? 'checked' : '';
							  				?>
							  				<tr ctg-id="<?php echo $ctg['id'] ?>">
							  					<td><input type="radio" name="maincategory" value="<?php echo $ctg['id'] ?>" <?php echo $is_checked ?>></td>
							  					<td><?php echo $ctg['name'] ?></td>
							  					<td><img class="ctg-img" src="<?php echo $ctg['iconpath'] ?>"></td>
							  				</tr>
							  				<?php
							  			}
							  		?>
							  	</tbody>
							</table>
						</div>

					</div>
				</div>
			</li>
			
			<!-- [TAB THREE] Setting -->
			<li data-content="ctg-tab-setting">
				
				<div class="twgm">
					<div class="container" style="width:100%">
						
						<!-- [Form Sub TItle] -->
						<div class="form-group form-sub-title">
							<label>Marker Setting</label>
							<p>This setting will apply to marker when displayed on map</p>
						</div>

						<!-- Start First Line -->
						<div class="row"> 

							<!-- Icon Type -->
							<?php
								$rb_maincategory 	= ( $st_icontype === 'main_category' ) ? 'checked' : '';
								$rb_customicon 		= ( $st_icontype === 'custom_icon' ) ? 'checked' : '';
								$st_customicon		= esc_url( $setting['custom_icon'] );
								$ci_wrap_display 	= ( $rb_customicon === 'checked' ) ? 'block' : 'none';
								$ci_img_display 	= ( ! empty( $st_customicon ) ) ? 'block' : 'none';
							?>
							<div class="form-group col-md-3">
								<label>Icon Type</label>
								<div class="radio">
								  	<label><input type="radio" name="setting[icon_type]" value="main_category"
								  		<?php echo $rb_maincategory ?>>Main Category</label>
								</div>
								<div class="radio">
								  	<label><input type="radio" name="setting[icon_type]" value="custom_icon"
								  		<?php echo $rb_customicon?>>Custom Icon</label>
								</div>
								<!-- Custom Icon Upload/Select -->
								<div class="wp-media-wrapper" media-id="icon" style="display:<?php echo $ci_wrap_display ?>;">
									<div class="form-group">
										<label>Please upload or select Image</label>
										<img src="<?php echo $st_customicon?>" style="display:<?php echo $ci_img_display ?>;">
										<input type="text" class="form-control" name="setting[custom_icon]"
											value="<?php echo $st_customicon?>">
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
							
							<!-- On Click -->
							<?php 
								$rb_none 			= ( $st_onclick === 'none' ) ? 'checked' : '';
								$rb_showinfowindow 	= ( $st_onclick === 'show_infowindow' ) ? 'checked' : '';
								$rb_redirect_link 	= ( $st_onclick === 'redirect_link' ) ? 'checked' : '';
								$rl_input_display 	= ( $st_onclick === 'redirect_link' ) ? 'block' : 'none;';
								$st_redirectlink	= esc_url( $setting['redirect_link'] );
							?>
							<div class="form-group col-md-3">
								<label>On Click</label>
								<div class="radio">
								  	<label><input type="radio" name="setting[onclick]" value="none"
								  		<?php echo $rb_none ?>>None</label>
								</div>
								<div class="radio">
								  	<label><input type="radio" name="setting[onclick]" value="show_infowindow"
								  		<?php echo $rb_showinfowindow ?>>Show InfoWindow</label>
								</div>
								<div class="radio">
								  	<label><input type="radio" name="setting[onclick]" value="redirect_link"
								  		<?php echo $rb_redirect_link ?>>Redirect To Link</label>
								</div>
								<div id="redirect-link" style="display:<?php echo $rl_input_display ?>;">
									<input type="text" name="setting[redirect_link]" class="form-control"
										value="<?php echo $st_redirectlink ?>">
								</div>
							</div>

							<!-- Behaviour -->
							<?php
								$cb_draggable = in_array( 'draggable', $st_behaviour ) ? 'checked' : '';
								$cb_disableclick = in_array( 'disable_click', $st_behaviour ) ? 'checked' : '';
								$cb_defaultopeniw = in_array( 'default_openiw', $st_behaviour ) ? 'checked' : '';
							?>
							<div class="form-group col-md-3">
								<label>Behaviour</label>
								<div class="checkbox">
								  	<label><input type="checkbox" name="setting[behaviour][]" value="draggable" <?php echo $cb_draggable ?>>Draggable</label>
								</div>
								<div class="checkbox">
								  	<label><input type="checkbox" name="setting[behaviour][]" value="disable_click" <?php echo $cb_disableclick ?>>Disable Click</label>
								</div>
								<div class="checkbox">
								  	<label><input type="checkbox" name="setting[behaviour][]" value="default_openiw" <?php echo $cb_defaultopeniw ?>>Default Open InfoWindow</label>
								</div>
							</div>

							<!-- Animation -->
							<div class="form-group col-md-3">
								<label>Animation</label>
								<select class="form-control" name="setting[animation]">
									<?php
										$animations = array( 'NONE', 'DROP', 'BOUNCE' );
										foreach ( $animations as $animation ) {
											$is_checked = ( $animation === $st_animation ) ? 'selected' : '';
											echo '<option value="' . $animation . '" ' . $is_checked . '>' . ucwords( $animation ) . '</option>';
										}
									?>
								</select>
							</div>

						</div>
						<!-- End First Line -->

						<!-- Start Second Line -->
						<div class="row">
							<!-- Location Image -->
							<?php
								$li_img_display = ( ! empty( $md_image ) ) ? 'block' : 'none';
							?>
							<div class="form-group col-md-3"> 
								<label>Location Image</label>
								<!-- Custom Icon Upload/Select -->
								<div class="wp-media-wrapper" media-id="image">
									<div class="form-group">
										<label>Please upload or select Image</label>
										<img src="<?php echo $md_image ?>" style="display:<?php echo $li_img_display ?>;">
										<input type="text" class="form-control" name="image"
											value="<?php echo $md_image ?>">
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
						<!-- End Second Line -->

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