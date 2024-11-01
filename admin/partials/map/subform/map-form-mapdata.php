	
	<?php 
	 /* SUB FORM - MAP DATA (MD) */
	?>

	<!-- [FormSubTitle] - Marker Data -->
	<div class="form-group form-sub-title">
		<label>Map Data</label>
		<p>Please fill map information, this information can help you to differentiate between another map.</p>
	</div>

	<!-- MD - Name -->
	<div class="form-group">
	    <label>Name</label>
	    <input type="text" class="form-control" name="name" placeholder="Map name"
	    	value="<?php echo $item['name'] ?>">
	</div>

	<!-- MD - Description -->
	<div class="form-group">
	  	<label>Description</label>
	  	<textarea class="form-control" rows="7" style="resize:none;" name="description"
			placeholder="Specific description about map"><?php echo $item['description'] ?></textarea>
	</div>

	<!-- MD - Map Size -->
	<?php
		$size = $setting['size'];
	?>
	<div class="form-group">
	   	<div class="form-group-title">
	   		<label>Map Size</label>
	   		<p class="twgm-group-info">Set map size width and height in number format and followed by <b>px</b> or <b>%</b> sign without space</p>
	   	</div>
	   	<div class="row">
	   		<!-- Width -->
	   		<div class="form-group col-md-6">
	   			<label>Width</label>
	    		<input type="text" id="lat" class="form-control" name="setting[size][width]"
	    			value="<?php echo $size['width'] ?>">
	   		</div>
	   		<!-- Height -->		
	   		<div class="form-group col-md-6">
	   			<label>Height</label>
	    		<input type="text" id="lng" class="form-control" name="setting[size][height]"
	    			value="<?php echo $size['height'] ?>">
	   		</div>
	   </div>
	</div>

	<!-- Map Type & Map Style -->
	<?php

		$type 				= isset( $setting['type'] ) ? $setting['type'] : '';
		$type_active 		= isset( $type['active'] ) ? $type['active'] : array();
		$type_firstselect 	= isset( $type['first_select'] ) ? $type['first_select'] : ''; 
		$custom_type 		= isset( $setting['custom_type'] ) ? $setting['custom_type'] : array();
		$max_custom_type_id = 0;
	?>
	<div class="form-group">
		<label>Map Type</label>
		<table class="table" id="maptype-table">
			<thead>
				<th>Activate</th>
				<th>First Select</th>
				<th>Name</th>
				<th>Style</th>
				<th>Remove</th>
			</thead>
			<tbody>
				<?php
					foreach ( $map_types as $maptype ) {
						$checked = in_array( $maptype, $type_active ) ? 'checked' : '';
						$fs_checked = ( $type_firstselect === $maptype ) ? 'checked' : '';
						?>
							<tr>
								<!-- Activate -->
								<td>
									<input type="checkbox" name="setting[type][active][]" value="<?php echo $maptype ?>" <?php echo $checked ?>>
								</td>
								<!-- First Select -->
								<td>
									<input type="radio" name="setting[type][first_select]" value="<?php echo $maptype ?>" <?php echo $fs_checked ?>>
								</td>
								<!-- Name -->
								<td>
									<?php echo $maptype ?>													
								</td>
								<!-- Style -->
								<td>
									Default style
								</td>
								<!-- Remove -->
								<td>
									Cannot be removed
								</td>
							</tr>
						<?php
					}
					?>
						<tr>
							<!-- Activate -->
							<td>
								<input type="checkbox" name="setting[custom_type][1][active]" value="1" <?php echo $ct_active ?>>
							</td>
							<!-- First Select -->
							<td>
								<input type="radio" name="setting[type][first_select]" value="1" <?php echo $fs_checked ?>>
							</td>
							<!-- Name -->
							<td>
								<input type="text" class="form-control" name="setting[custom_type][1][name]"
									value="<?php echo $ct_name ?>">											
							</td>
							<!-- Style -->
							<td>
								<textarea class="form-control" rows="1" name="setting[custom_type][1][style]"><?php echo str_replace( "\\","", $ct_style ) ?></textarea>
							</td>
							<!-- Remove -->
							<td>
								Cannot be removed
							</td>
						</tr>				    			
			</tbody>
		</table>
		<input type="hidden" id="max-custom-type-id" value="<?php echo $max_custom_type_id ?>">
		
	</div>

	<div class="row">
		
		<!-- Map Language -->
		<?php
			$language 	= isset( $setting['language'] ) ? $setting['language'] : '';
		?>
		<div class="form-group col-md-3">
			<label>Map Language</label>
			<select class="form-control" name="setting[language]">
				<?php
					foreach ( $languages as $key => $val ) {
						$selected = ( $language === $key ) ? 'selected' : '';
						echo '<option value="' . $key . '" ' . $selected . '>' . $val . '</option>';
					}
				?>
			</select>
		</div>

		<!-- Default Zoom -->
		<?php
			$def_zoom = isset( $setting['default_zoom'] ) ? $setting['default_zoom'] : 10;
		?>
		<div class="form-group col-md-3">
			<label>Default Zoom</label>
			<input type="number" min="0" max="21" class="form-control" name="setting[default_zoom]"
				value="<?php echo $def_zoom ?>">
		</div>

		<!-- Z-Index -->
		<?php
			$z_index = isset( $setting['z_index'] ) ? $setting['z_index'] : 0;
		?>
		<div class="form-group col-md-3">
			<label>Z-Index</label>
			<input type="number" class="form-control" name="setting[z_index]"
				value="<?php echo $z_index ?>">
		</div>

		<!-- Behaviour -->
		<?php
			$behaviour = isset( $setting['behaviour'] ) ? $setting['behaviour'] : array();
			$sz_cb = in_array( 'scroll_zoom', $behaviour ) ? 'checked' : '';
			$dcz_cb = in_array( 'double_click_zoom', $behaviour ) ? 'checked' : '';
			$drg_cb = in_array( 'draggable', $behaviour ) ? 'checked' : '';
			$fourtyfiveimage_cb = in_array( '45_image', $behaviour ) ? 'checked' : '';
		?>
		<div class="form-group col-md-3">
			<label>Behaviour</label>
			<div class="checkbox">
			  	<label><input type="checkbox" name="setting[behaviour][]" value="scroll_zoom"
			  		<?php echo $sz_cb ?>>Scroll Zoom</label>
			</div>
			<div class="checkbox">
			  	<label><input type="checkbox" name="setting[behaviour][]" value="double_click_zoom"
			  		<?php echo $dcz_cb ?>>Double Click Zoom</label>
			</div>
			<div class="checkbox">
			  	<label><input type="checkbox" name="setting[behaviour][]" value="draggable"
			  		<?php echo $drg_cb ?>>Draggable</label>
			</div>
			<div class="checkbox">
			  	<label><input type="checkbox" name="setting[behaviour][]" value="45_image"
			  		<?php echo $fourtyfiveimage_cb ?>>45 Degree Image</label>
			</div>
		</div>

	</div>

	<!-- Map Center -->
	<?php
		$position 		= isset( $setting['position'] ) ? $setting['position'] : '';
		$position_lat 	= isset( $position['lat'] ) ? $position['lat'] : '';
		$position_lng 	= isset( $position['lng'] ) ? $position['lng'] : '';
	?>
	<div class="form-group">
		<div id="map-center-position" style="width:100%; height:330px;"></div>
	</div>
	<div class="form-group">
	   	<div class="form-group-title">
	   		<label>Center Position</label>
	   		<p class="twgm-group-info">Define latitude and longitude of map center position, you can drag marker on map to get latitude and longitude value automatically</p>
	   	</div>
	   	<div class="row">
	   		<!-- Latitude -->
	   		<div class="form-group col-md-6">
	   			<label>Latitude</label>
	    		<input type="text" id="center-lat" class="form-control" name="setting[position][lat]"
	    			value="<?php echo $position_lat ?>">
	   		</div>
	   		<!-- Longitude -->		
	   		<div class="form-group col-md-6">
	   			<label>Longitude</label>
	    		<input type="text" id="center-lng" class="form-control" name="setting[position][lng]"
	    			value="<?php echo $position_lng ?>">
	   		</div>
	   </div>
	</div>