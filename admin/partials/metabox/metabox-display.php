
<!--

MOREWORK

* Validate & Sanitize Input
* Escaping Output

-->


<div class="twgm">
<div class="container" style="width:100%;">
	<p>
		<label for="use_marker"><input type="checkbox" name="twgm_applymarker" value="true" <?php if( isset( $mbd['_twgm_applymarker'] ) && ( $mbd['_twgm_applymarker'][0] == 'true' ) ) echo 'checked' ?>>Apply Marker for this Post</label>
	</p>

	<!-- MAP -->
	<div class="row-field">
		<p>
			<label class="twgm-row-title"><?php _e( 'Map', 'twgm' ) ?></label>
			<div id="map" style="width:100%;height:250px;"></div>
		</p>
	</div>

	<!-- LOCATION ADDRESS -->
	<div class="row-field">
	    <p>
	        <label for="twgm-adr" class="twgm-row-title"><?php _e( 'Location Address', 'twgm' )?></label>
	        <input type="text" name="twgm[address]" id="twgm-adr" class="twgm-fullwidth"
				value="<?php if ( isset ( $twgm_data->address ) ) echo $twgm_data->address; ?>" />
	    </p>
	</div>
	
	<!-- LATITUDE -->
	<div class="row-field">
		<p>
	        <label for="twgm-lat" class="twgm-row-title"><?php _e( 'Latitude', 'twgm' )?></label>
	        <input type="text" name="twgm[lat]" id="twgm-lat"
				value="<?php if ( isset ( $twgm_data->lat ) ) echo $twgm_data->lat; ?>" />
	    </p>
	</div>

	<!-- LONGITUDE -->	
	<div class="row-field">
		<p>
	        <label for="twgm-lon" class="twgm-row-title"><?php _e( 'Longitude', 'twgm' )?></label>
	        <input type="text" name="twgm[lng]" id="twgm-lon" 
				value="<?php if ( isset ( $twgm_data->lng ) ) echo $twgm_data->lng; ?>" />
	    </p>
	</div>

	<!-- DESCRIPTION -->
	<div class="row-field">
		<p>
			<label for="twgm-desc" class="twgm-row-title"><?php _e( 'Description', 'twgm' )?></label>
			<textarea type="text" name="twgm[description]" id="twgm-desc" 
				rows="3" style="width:100%"><?php if ( isset( $twgm_data->description ) ) echo $twgm_data->description; ?></textarea>
		</p>
	</div>

<!-- MARKER CATEGORY -->
<div class="row-field">
	<p>
		<label class="twgm-row-title"><?php _e( 'Category', 'twgm' )?></label>
		<div class="twgm-row-content">
			<?php
				
				// IMPORTANT : Please Fix the table to 'twgm_category'
				$tbname = $wpdb->prefix . 'twgm_category';
				$results = $wpdb->get_results( 'SELECT * FROM ' . $tbname );
				
				$twgm_ctg = isset( $mbd['_twgm_category'] ) ? $mbd['_twgm_category'][0] : 'N;';
				$twgm_ctg = unserialize( $twgm_ctg );
				$twgm_ctg = unserialize( $twgm_ctg );
				$twgm_ctg_string = '';
				$twgm_ctg_array = [];

				foreach ( $results  as $key => $row ) {
					$checked = '';
					if ( is_array( $twgm_ctg ) ) {
						$checked = in_array( $row->id, $twgm_ctg ) ? 'checked' : '';
						if ( $checked == 'checked' ) {
							$twgm_ctg_string .= ',' . $row->id;
							array_push( $twgm_ctg_array, array( 'id' => $row->id, 'name' => $row->name) );							
						}
					}
				?>
				
					<label for="twgm-ctg-cb-<?php echo $row->id;?>">
						<input type="checkbox" name="twgm_category[]" class="twgm_ctg" id="twgm-ctg-cb-<?php echo $row->id;?>" 
							value="<?php echo $row->id;?>" <?php echo $checked; ?> />
						<?php echo $row->name;?>
					</label>
				
				<?php
				}
			?>
			<input type="hidden" id="selected_ctg" value="<?php echo $twgm_ctg_string; ?>">
		</div>
	</p>
</div>


	<?php
		$isdisplay = ( count( $twgm_ctg_array ) > 0 ) ? 'block' : 'none';
	?>
	<div id="twgm-main-icon" class="row-field" style="display: <?php echo $isdisplay; ?>;">
		<p>
			<label class="twgm-row-title"><?php _e( 'Select Main Icon', 'twgm' )?></label>
			<div class="twgm-row-content" id="main_ctg">
			<?php
				for ( $i = 0; $i < count( $twgm_ctg_array ); $i++ ) {
					$checked = '';
					if ( isset( $twgm_data->maincategory ) ) 
						$checked = ( $twgm_ctg_array[ $i ]['id'] == $twgm_data->maincategory ) ? 'checked' : '';
					echo '<label><input type="radio" value="' . $twgm_ctg_array[$i]['id']. '" name="twgm[maincategory]" id="twgm-ctg-rb-' . $twgm_ctg_array[ $i ]['id'] . '" ' . $checked . '>' . $twgm_ctg_array[ $i ]['name'] . '</label>';
				}
			?>
			</div>
		</p>
	</div>

<!-- MARKER ON CLICK -->
<div class="row-field">
<?php
	$sel_showinfowindow 	= ( $twgm_data->onclick === 'show_infowindow' ) ? 'selected' : '';
	$sel_permalink 			= ( $twgm_data->onclick === 'permalink' ) ? 'selected' : '';
	$sel_redirectlink 		= ( $twgm_data->onclick === 'redirect_link' ) ? 'selected' : '';
?>
	<p>
		<label for="twgm-moc" class="twgm-row-title"><?php _e( 'On Click', 'twgm' )?></label>
		<select name="twgm[onclick]" id="twgm-moc">
			<option value="show_infowindow" <?php echo $sel_showinfowindow ?>><?php _e( 'Show InfoWindow', 'twgm' )?></option>';
			<option value="permalink" <?php echo $sel_permalink ?>><?php _e( 'Redirect to Post Link', 'twgm' )?></option>';
			<option value="redirect_link" <?php echo $sel_redirectlink ?>><?php _e( 'Redirect to Custom Link', 'twgm' )?></option>';
		</select>
	</p>

</div>

<!-- REDIRECT URL -->
<?php
	$isdisplay = ( $sel_redirectlink === 'selected' ) ? 'block' : 'none';
?>
<div class="row-field" id="twgm-redirect_url" style="display:<?php echo $isdisplay ?>;">
	<p>
		<label for="twgm-ru" class="twgm-row-title"><?php _e( 'Redirect Url', 'twgm' )?></label>
		<input type="text" name="twgm[redirect_link]" id="twgm-ru"
			value="<?php if ( isset ( $twgm_data->redirect_link ) ) echo $twgm_data->redirect_link; ?>" />
	</p>
</div>

<!-- ICON TYPE -->
<div class="row-field">
	<?php
		$sel_maincategory 	= ( $twgm_data->icon_type === 'main_category' ) ? 'selected' : '';
		$sel_customicon 	= ( $twgm_data->icon_type === 'custom_icon' ) ? 'selected' : '';
	?>
	<p>
		<label for="twgm-ic" class="twgm-row-title"><?php _e( 'Icon Type', 'twgm' )?></label>
		<select name="twgm[icon_type]" id="twgm-it">
			<option value="main_category" <?php echo $sel_maincategory ?>>Main Category</option>
			<option value="custom_icon" <?php echo $sel_customicon ?>>Custom Icon</option>	
		</select>
	</p>
</div>

<!-- CUSTOM ICON -->
<?php
	$isdisplay = ( $sel_customicon === 'selected' ) ? 'block' : 'none';
?>
<div class="row-field" id="twgm-custom_icon" style="display:<?php echo $isdisplay ?>;">	
	<p>
		<label class="twgm-row-title"><?php _e( 'Custom Icon', 'twgm' ) ?></label>

		<div class="twgm-image-content">
			<?php
				$isdisplay = ( isset( $twgm_data->custom_icon ) && strlen( $twgm_data->custom_icon ) > 0 ) ? 'block' : 'none';
			?>
			<input type="text" id="ciimage" name="twgm[custom_icon]" 
				value="<?php if ( isset( $twgm_data->custom_icon ) ) echo esc_url( $twgm_data->custom_icon ) ?>">
			<p>
				<img id="customiconimage" src="<?php if ( isset( $twgm_data->custom_icon ) ) echo esc_url( $twgm_data->custom_icon ) ?>" 
					style="width:150px;display:<?php echo $isdisplay ?>;">
			</p>
			<button type="button" class="button" name="select_customicon" id="select_customicon">Select Icon</button>
			<button type="button" class="button" name="remove_customicon" id="remove_customicon">Remove Icon</button>
		</div>

	</p>							
</div>

<div class="row-field">
<!-- MARKER ANIMATION -->
	<p>
		<label for="twgm-animation" class="twgm-row-title"><?php _e( 'Animation', 'twgm' )?></label>
		<select name="twgm[animation]" id="twgm-animation">
			<option value="DROP" <?php if ( isset ( $twgm_data->animation ) ) selected( $twgm_data->animation, 'DROP' ); ?>><?php _e( 'Drop', 'twgm' )?></option>';
			<option value="BOUNCE" <?php if ( isset ( $twgm_data->animation ) ) selected($twgm_data->animation, 'BOUNCE' ); ?>><?php _e( 'Bounce', 'twgm' )?></option>';
		</select>
	</p>
</div>

<div class="row-field">
<!-- MARKER BEHAVIOUR -->
	<p>
		<label class="twgm-row-title"><?php _e( 'Behaviour', 'twgm' )?></label>
		<div class="twgm-row-static">
			<?php
				$draggable_chk = isset( $twgm_data->draggable ) ? 'checked' : '';
				$disableclick_chk = isset( $twgm_data->disable_click ) ? 'checked' : '';
				$defaultopeniw_chk = isset( $twgm_data->default_openiw ) ? 'checked' : '';
			?>
			<label>
				<input type="checkbox" name="twgm[draggable]" value="true" <?php echo $draggable_chk ?>><?php _e( 'Draggable', 'twgm' ) ?>
			</label>
			<label>
				<input type="checkbox" name="twgm[disable_click]" value="true" <?php echo $disableclick_chk ?>><?php _e( 'Disable Click', 'twgm' ) ?>
			</label>
			<label>
				<input type="checkbox" name="twgm[default_openiw]" value="true" <?php echo $defaultopeniw_chk ?>><?php _e( 'Default Open InfoWindow', 'twgm' ) ?>
			</label>
		</div>

	</p>
</div>

<div class="row-field">
<!-- SELECT MAP -->
	<p>
		<label class="twgm-row-title"><?php _e( 'Select Map', 'twgm' )?></label>
		<div class="twgm-row-content">
			<?php
				
				$tbname = $wpdb->prefix . 'twgm_map';
				$results = $wpdb->get_results( 'SELECT * FROM ' . $tbname );
				
				$twgm_map = isset( $mbd['_twgm_map'] ) ? $mbd['_twgm_map'][0] : 'N;';
				$twgm_map = unserialize( $twgm_map );
				$twgm_map = unserialize( $twgm_map );
				
				foreach ($results  as $key => $row) {
					$checked = '';
					if ( is_array( $twgm_map ) ) {
						$checked = in_array( $row->id, $twgm_map ) ? 'checked' : '';
					}
				?>
				
					<label for="twgm-map-cb-<?php echo $row->id;?>">
						<input type="checkbox" name="twgm_map[]" id="twgm-map-cb-<?php echo $row->id;?>" 
							value="<?php echo $row->id;?>" <?php echo $checked; ?> />
						<?php echo $row->name;?>
					</label>
				
				<?php
				}
			?>
		</div>
	</p>
</div>

<div class="row-field">	
<p>
	<label class="twgm-row-title"><?php _e( 'Image', 'twgm' ) ?></label>

	<div class="twgm-image-content">
		<?php
			$isdisplay = ( isset( $twgm_data->image ) && strlen( $twgm_data->image ) > 0 ) ? 'block' : 'none';
		?>
		<input type="text" id="iwimage" name="twgm[image]" value="<?php if ( isset( $twgm_data->image ) ) echo esc_url( $twgm_data->image ) ?>">
		<p>
			<img id="infowindowimage" src="<?php if ( isset( $twgm_data->image ) ) echo esc_url( $twgm_data->image ) ?>" style="width:150px;display:<?php echo $isdisplay ?>;">
		</p>
		<button type="button" class="button" name="select_iwimage" id="select_iwimage">Select Image</button>
		<button type="button" class="button" name="remove_iwimage" id="remove_iwimage">Remove Image</button>
	</div>

</p>							
</div>
	
</div>
</div>