<!-- [Form Sub Title] - Control -->
<?php 
	
	$zoom = isset( $control['zoom'] ) ? $control['zoom'] : '';
	$zoom_cb = isset( $zoom['cb'] ) ? 'checked' : '';
	$zoom_po = isset( $zoom['position'] ) ? $zoom['position'] : '';

	$fs = isset( $control['fullscreen'] ) ? $control['fullscreen'] : '';
	$fs_cb = isset( $fs['cb'] ) ? 'checked' : '';
	$fs_po = isset( $fs['position'] ) ? $fs['position'] : '';

	$sv = isset( $control['streetview'] ) ? $control['streetview'] : '';
	$sv_cb = isset( $sv['cb'] ) ? 'checked' : '';
	$sv_po = isset( $sv['position'] ) ? $sv['position'] : '';

	$maptype = isset( $control['maptype'] ) ? $control['maptype'] : '';
	$maptype_cb = isset( $maptype['cb'] ) ? 'checked' : '';
	$maptype_po = isset( $maptype['position'] ) ? $maptype['position'] : '';
	$maptype_st = isset( $maptype['style'] ) ? $maptype['style'] : 'HORIZONTAL_BAR'; 
	$hb_sel = ( $maptype_st === 'HORIZONTAL_BAR' ) ? 'selected' : '';
	$dm_sel = ( $maptype_st === 'DROPDOWN_MENU' ) ? 'selected' : '';

	$scale = isset( $control['scale'] ) ? $control['scale'] : '';
	$scale_cb = isset( $scale['cb'] ) ? 'checked' : '';

?>
<div class="form-group form-sub-title">
	<label>Control</label>
	<p>Please check and set the settings for each control to use it</p>
</div>

<!-- [Control] - First Line -->
<div class="row">
	<!-- [Control] - Zoom -->
	<div class="form-group col-md-2">
		<label>Zoom</label>
		<div class="checkbox">
			<label style="">
				<input type="checkbox" name="control[zoom][cb]" value="1" <?php echo $zoom_cb ?>>
				Active
			</label>
		</div>
		<label>Position</label>
		<select class="form-control" name="control[zoom][position]">
			<?php
				foreach ( $control_positions as $control_position ) {
					$val = explode( '_', $control_position );
					$selected = ( $control_position == $zoom_po ) ? 'selected' : '';
					echo 
						'<option value="' . $control_position . '" ' . $selected . '>' . ucwords( strtolower( $val[0] ) ) . ' ' . ucwords( strtolower( $val[1] ) ) . '</option>';
				}
			?>
		</select>
	</div>
	<!-- [Control] - Fullscreen -->
	<div class="form-group col-md-2">
		<label>Fullscreen</label>
		<div class="checkbox">
			<label style="">
				<input type="checkbox" name="control[fullscreen][cb]" value="1" <?php echo $fs_cb ?>>
				Active
			</label>
		</div>
		<label>Position</label>
		<select class="form-control" name="control[fullscreen][position]">
			<?php
				foreach ( $control_positions as $control_position ) {
					$val = explode( '_', $control_position );
					$selected = ( $control_position == $fs_po ) ? 'selected' : '';
					echo 
						'<option value="' . $control_position . '" ' . $selected . '>' . ucwords( strtolower( $val[0] ) ) . ' ' . ucwords( strtolower( $val[1] ) ) . '</option>';
				}
			?>
		</select>
	</div>
	<!-- [Control] - StreetView -->
	<div class="form-group col-md-2">
		<label>Street View</label>
		<div class="checkbox">
			<label style="">
				<input type="checkbox" name="control[streetview][cb]" value="1" <?php echo $sv_cb ?>>
				Active
			</label>
		</div>
		<label>Position</label>
		<select class="form-control" name="control[streetview][position]">
			<?php
				foreach ( $control_positions as $control_position ) {
					$val = explode( '_', $control_position );
					$selected = ( $control_position == $sv_po ) ? 'selected' : '';
					echo 
						'<option value="' . $control_position . '" ' . $selected . '>' . ucwords( strtolower( $val[0] ) ) . ' ' . ucwords( strtolower( $val[1] ) ) . '</option>';
				}
			?>
		</select>
	</div>
	<!-- [Control] - Zoom -->
	<div class="form-group col-md-2">
		<label>Map Type</label>
		<div class="checkbox">
			<label style="">
				<input type="checkbox" name="control[maptype][cb]" value="1" <?php echo $maptype_cb ?>>
				Active
			</label>
		</div>
		<label>Position</label>
		<select class="form-control" name="control[maptype][position]">
			<?php
				foreach ( $control_positions as $control_position ) {
					$val = explode( '_', $control_position );
					$selected = ( $control_position == $maptype_po ) ? 'selected' : '';
					echo 
						'<option value="' . $control_position . '" ' . $selected . '>' . ucwords( strtolower( $val[0] ) ) . ' ' . ucwords( strtolower( $val[1] ) ) . '</option>';
				}
			?>
		</select>
		<label>Style</label>
		<select class="form-control" name="control[maptype][style]">
			<option value="HORIZONTAL_BAR" <?php echo $hb_sel ?>>Horizontal Bar</option>
			<option value="DROPDOWN_MENU" <?php echo $dm_sel ?>>Dropdown Menu</option>
		</select>
	</div>
	<!-- [Control] - Scale -->
	<div class="form-group col-md-2">
		<label>Scale</label>
		<div class="checkbox">
			<label style="">
				<input type="checkbox" name="control[scale][cb]" value="1" <?php echo $scale_cb ?>>
				Active
			</label>
		</div>
	</div>
</div>

<!-- [Control] - Second Line -->
<div class="row">
	
</div>