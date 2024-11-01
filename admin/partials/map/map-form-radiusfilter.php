<?php
	
	// main
	$rf 	= $setting['rf'];
	$rf_cb 	= isset( $rf['cb'] ) ? 'checked' : '';

	// value
	$rfv 			= $rf['val'];
	$rfv_def 		= $rfv['def'];
	$rfv_max 		= $rfv['max'];
	$rfv_min 		= $rfv['min'];
	$rfv_unit 		= $rfv['unit'];

	// color
	$rfc 			= $rf['color'];
	$rfc_bg 		= $rfc['formbg'];
	$rfc_font 		= $rfc['font'];
	$rfc_slideri 	= $rfc['slideri'];
	$rfc_slidero 	= $rfc['slidero'];
	$rfc_btn_bg 	= $rfc['btnbg'];
	$rfc_btn_icon 	= $rfc['btnicon'];
	$rfc_inp_bg 	= $rfc['inpbg'];
	$rfc_inp_font 	= $rfc['inpfont'];
	$rfc_labelicon  = $rfc['labelicon'];
	$rfc_cr			= $rfc['cr'];

?>

<!-- [Form Sub Title] - Radius Filter (RF) -->
<div class="form-group form-sub-title">
	<label>Radius Filter</label>
	<p>Fitur ini digunakan untuk memfilter marker yang ada pada map berdasarkan geolocation dan jarak radius</p>
</div>

<div class="form-group">
	
	<!-- RF - Active  -->
	<div class="checkbox">
		<label><input type="checkbox" name="setting[gl][cb]" value="1" <?php echo $gl_cb ?>>Activate</label>
	</div>

	<!-- RF - Value Definition -->
	<div class="row">
		<!-- RF - Default -->
		<div class="form-group col-md-3">
			<label>Default</label>
			<input type="number" class="form-control" name="setting[rf][val][def]"
				value="<?php echo $rfv_def ?>">
		</div>
		<!-- RF - Min -->
		<div class="form-group col-md-3">
			<label>Min</label>
			<input type="number" class="form-control" name="setting[rf][val][min]"
				value="<?php echo $rfv_min ?>">
		</div>
		<!-- RF - Max -->
		<div class="form-group col-md-3">
			<label>Max</label>
			<input type="number" class="form-control" name="setting[rf][val][max]"
				value="<?php echo $rfv_max ?>">
		</div>
		<!-- RF - Unit -->
		<div class="form-group col-md-3">
			<label>Unit</label>
			<select class="form-control" name="setting[rf][val][unit]">
				<option <?php if ( $rfv_unit === 'km' ) echo 'selected' ?>>km</option>
				<option <?php if ( $rfv_unit === 'mill' ) echo 'selected' ?>>mill</option>
			</select>
		</div>
	</div>

	<!-- RF - Color Definition -->
	<div class="row">
		<!-- RF - Background Color -->
		<div class="form-group col-md-2 fg-color">
			<label>Form Background</label>
			<div class="box-color color" style="background:<?php echo $rfc_bg ?>"></div>
			<input type="hidden" class="form-control" name="setting[rf][color][formbg]"
				value="<?php echo $rfc_bg ?>">
		</div>
		<!-- RF - Font Color -->
		<div class="form-group col-md-2 fg-color">
			<label>Font</label>
			<div class="box-color color" style="background:<?php echo $rfc_font ?>"></div>
			<input type="hidden" class="form-control" name="setting[rf][color][font]"
				value="<?php echo $rfc_font ?>">
		</div>
		<!-- RF - Slider Inner Color -->
		<div class="form-group col-md-2 fg-color">
			<label>Slider (Inside)</label>
			<div class="box-color color" style="background:<?php echo $rfc_slideri ?>"></div>
			<input type="hidden" class="form-control" name="setting[rf][color][slideri]"
				value="<?php echo $rfc_slideri ?>">
		</div>
		<!-- RF - Slider Outer Color -->
		<div class="form-group col-md-2 fg-color">
			<label>Slider (Outside)</label>
			<div class="box-color color" style="background:<?php echo $rfc_slidero ?>"></div>
			<input type="hidden" class="form-control" name="setting[rf][color][slidero]"
				value="<?php echo $rfc_slidero ?>">
		</div>
		<!-- RF - Button Background Color -->
		<div class="form-group col-md-2 fg-color">
			<label>Button Background</label>
			<div class="box-color color" style="background:<?php echo $rfc_btn_bg ?>"></div>
			<input type="hidden" class="form-control" name="setting[rf][color][btnbg]"
				value="<?php echo $rfc_btn_bg ?>">
		</div>
		<!-- RF - Butotn Icon Color -->
		<div class="form-group col-md-2 fg-color">
			<label>Button Icon</label>
			<div class="box-color color" style="background:<?php echo $rfc_btn_icon ?>"></div>
			<input type="hidden" class="form-control" name="setting[rf][color][btnicon]"
				value="<?php echo $rfc_btn_icon ?>">
		</div>
	</div>
	<div class="row">
		<!-- RF - Input Background Color -->
		<div class="form-group col-md-2 fg-color">
			<label>Input (Background)</label>
			<div class="box-color color" style="background:<?php echo $rfc_inp_bg ?>"></div>
			<input type="hidden" class="form-control" name="setting[rf][color][inpbg]"
				value="<?php echo $rfc_inp_bg ?>">
		</div>
		<!-- RF - Input Font Color -->
		<div class="form-group col-md-2 fg-color">
			<label>Input (Font)</label>
			<div class="box-color color" style="background:<?php echo $rfc_inp_font ?>"></div>
			<input type="hidden" class="form-control" name="setting[rf][color][inpfont]"
				value="<?php echo $rfc_inp_font ?>">
		</div>
		<!-- RF - Input Font Color -->
		<div class="form-group col-md-2 fg-color">
			<label>Label Icon</label>
			<div class="box-color color" style="background:<?php echo $rfc_labelicon ?>"></div>
			<input type="hidden" class="form-control" name="setting[rf][color][labelicon]"
				value="<?php echo $rfc_labelicon ?>">
		</div>
		<!-- RF - Butotn Icon Color -->
		<div class="form-group col-md-2 fg-color">
			<label>Circle Range</label>
			<div class="box-color color" style="background:<?php echo $rfc_cr ?>"></div>
			<input type="hidden" class="form-control" name="setting[rf][color][cr]"
				value="<?php echo $rfc_cr ?>">
		</div>
	</div>

</div>