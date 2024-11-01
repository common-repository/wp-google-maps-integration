<?php

	$gl 				= $setting['gl'];
	$gl_cb 				= isset( $gl['cb'] ) ? 'checked' : '';
	$gl_gridstyle 		= isset( $gl['grid_style'] ) ? $gl['grid_style'] : '';
	$gl_liststyle 		= isset( $gl['list_style'] ) ? $gl['list_style'] : '';

	$glh 				= isset( $gl['header'] ) ? $gl['header'] : [];
	$glh_cb 			= isset( $glh['cb'] ) ? 'checked' : '';
	$glh_bg 			= isset( $glh['bg'] ) ? $glh['bg'] : '';
	$glh_text 			= isset( $glh['text'] ) ? $glh['text'] : '';
	$glh_textcolor 		= isset( $glh['text_color'] ) ? $glh['text_color'] : '';
	$glhsw_cb 			= isset( $glh['switcher_cb'] ) ? 'checked' : '';
	$glhsw_iconcolor 	= isset( $glh['switcher_iconcolor'] ) ? $glh['switcher_iconcolor'] : '';
	$glhsw_mode 		= isset( $glh['switcher_mode'] ) ? $glh['switcher_mode'] : '';
	$glhswm_grid 		= ( $glhsw_mode == 'grid' ) ? 'selected' : '';
	$glhswm_list 		= ( $glhsw_mode == 'list' ) ? 'selected' : '';

	$glf 				= isset( $gl['filter'] ) ? $gl['filter'] : [];
	$glf_cb 			= isset( $glf['cb'] ) ? 'checked' : '';
	
	$glf_sr_cb 			= isset( $glf['sr_cb'] ) ? 'checked' : '';
	$glf_sb_cb 			= isset( $glf['sb_cb'] ) ? 'checked' : '';
	$glf_sb_val 		= isset( $glf['sb_val'] ) ? $glf['sb_val'] : '';
	$glf_ctg_cb 		= isset( $glf['ctg_cb'] ) ? 'checked' : '';
	$glf_ipp_cb 		= isset( $glf['ipp_cb'] ) ? 'checked' : '';
	$glf_ipp_val 		= isset( $glf['ipp_val'] ) ? $glf['ipp_val'] : '';
	$glf_ipp_sel 		= isset( $glf['ipp_sel'] ) ? $glf['ipp_sel'] : '';

	$glf_fr = isset( $glf['filrange'] ) ? $glf['filrange'] : [];

?>
<!-- [Form Sub Title] - Grid List -->
<div class="form-group form-sub-title">
	<label>Grid List</label>
	<p>Marker Grid List</p>
</div>
<div class="form-group">

	<div class="checkbox"><label><input type="checkbox" name="setting[gl][cb]" value="1" <?php echo $gl_cb ?>>Activate</label></div>
	
	<!-- DISPLAY -->
	<div class="form-group">
		<label>Default Display Mode</label>
		<select class="form-control" name="setting[gl][header][switcher_mode]">
			<option value="grid" <?php echo $glhswm_grid ?>>Grid</option>
			<option value="list" <?php echo $glhswm_list ?>>List</option>
		</select>
	</div>
	<div class="row">
		<div class="form-group col-md-6">
			<label>Grid HTML</label>
			<textarea class="form-control" rows="5" name="setting[gl][grid_style]"><?php echo str_replace( "\\","", $gl_gridstyle ) ?></textarea>
		</div>
		<div class="from-group col-md-6">
			<label>List HTML</label>
			<textarea class="form-control" rows="5" name="setting[gl][list_style]"><?php echo str_replace( "\\","", $gl_liststyle ) ?></textarea>
		</div>
	</div>


	<!-- HEADER -->
	<div class="form-group-title">
   		<label>Header</label>
   		<p class="twgm-group-info">Setting for GridList Header</p>
   	</div>
	<!-- <div class="checkbox"><label><input type="checkbox" name="setting[gl][header][cb]" value="1" <?php echo $glh_cb ?>>Use Header</label></div> -->
	<div class="row">
		<div class="form-group col-md-3"><label>Header Label</label><input type="text" class="form-control" name="setting[gl][header][text]" value="<?php echo $glh_text ?>"></div>
		<div class="form-group col-md-2 fg-color">
			<label>Font</label>
			<div class="box-color color" style="background:<?php echo $glh_textcolor ?>"></div>
			<input type="hidden" class="form-control" name="setting[gl][header][text_color]"
				value="<?php echo $glh_textcolor ?>">
		</div>
		<div class="form-group col-md-2 fg-color">
			<label>Background</label>
			<div class="box-color color" style="background:<?php echo $glh_bg ?>"></div>
			<input type="hidden" class="form-control" name="setting[gl][header][bg]"
				value="<?php echo $glh_bg ?>">
		</div>
		<div class="form-group col-md-2">
			<label>Grid/List Switcher</label>
			<div class="checkbox"><label><input type="checkbox" name="setting[gl][header][switcher_cb]" value="1" <?php echo $glhsw_cb ?>>Activate</label></div>
		</div>
		<div class="form-group col-md-2 fg-color">
			<label>Switcher Icon</label>
			<div class="box-color color" style="background:<?php echo $glhsw_iconcolor ?>"></div>
			<input type="hidden" class="form-control" name="setting[gl][header][switcher_iconcolor]"
				value="<?php echo $glhsw_iconcolor ?>">
		</div>
	</div>

	<!-- SEARCH -->
	<div class="form-group-title">
   		<label>Search</label>
   		<p class="twgm-group-info">Define latitude and longitude of map center position, you can drag marker on map to get latitude and longitude value automatically</p>
   	</div>
   	<div class="row">
		<div class="col-md-2">
			<div class="checkbox"><label><input type="checkbox" name="setting[gl][filter][sr_cb]" value="1" <?php echo $glf_sr_cb ?>>Use Search</label></div>
   		</div>
   		<div class="form-group col-md-2 fg-color">
			<label>Input Background</label>
			<div class="box-color color" style="background:<?php echo $glhsw_iconcolor ?>"></div>
			<input type="hidden" class="form-control" name="setting[gl][header][switcher_iconcolor]"
				value="<?php echo $glhsw_iconcolor ?>">
		</div>
		<div class="form-group col-md-2 fg-color">
			<label>Input Font</label>
			<div class="box-color color" style="background:<?php echo $glhsw_iconcolor ?>"></div>
			<input type="hidden" class="form-control" name="setting[gl][header][switcher_iconcolor]"
				value="<?php echo $glhsw_iconcolor ?>">
		</div>
		<div class="form-group col-md-2 fg-color">
			<label>Button Background</label>
			<div class="box-color color" style="background:<?php echo $glhsw_iconcolor ?>"></div>
			<input type="hidden" class="form-control" name="setting[gl][header][switcher_iconcolor]"
				value="<?php echo $glhsw_iconcolor ?>">
		</div>
		<div class="form-group col-md-2 fg-color">
			<label>Button Font</label>
			<div class="box-color color" style="background:<?php echo $glhsw_iconcolor ?>"></div>
			<input type="hidden" class="form-control" name="setting[gl][header][switcher_iconcolor]"
				value="<?php echo $glhsw_iconcolor ?>">
		</div>
		<div class="form-group col-md-2 fg-color">
			<label>Form</label>
			<div class="box-color color" style="background:<?php echo $glhsw_iconcolor ?>"></div>
			<input type="hidden" class="form-control" name="setting[gl][header][switcher_iconcolor]"
				value="<?php echo $glhsw_iconcolor ?>">
		</div>
   	</div>
	

	<!-- FILTER -->

	<div class="form-group-title">
   		<label>Filter</label>
   		<p class="twgm-group-info">Define latitude and longitude of map center position, you can drag marker on map to get latitude and longitude value automatically</p>
   	</div>
	<div class="checkbox"><label><input type="checkbox" name="setting[gl][filter][cb]" value="1" <?php echo $glf_cb ?>>Use Filter</label></div>
	<div class="row">
		<div class="col-md-3">
			<div class="form-group bg-group">
				<div class="checkbox">
					<label><input type="checkbox" name="setting[gl][filter][sb_cb]" 
						value="1" <?php echo $glf_sb_cb ?>>Sort By</label>
				</div>
				<label>Sort By Value</label>
				<input type="text" name="setting[gl][filter][sb_val]" class="form-control" 
					value="<?php echo $glf_sb_val ?>">
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group bg-group">
				<div class="checkbox">
					<label><input type="checkbox" name="setting[gl][filter][ipp_cb]" 
						value="1" <?php echo $glf_ipp_cb ?> >Items Per Page</label>
				</div>
				<label>Items Per Page Options</label>
				<input type="text" name="setting[gl][filter][ipp_val]" class="form-control" 
					value="<?php echo $glf_ipp_val ?>">
			</div>			
			<div class="form-group"><label>Items Per Page</label><input type="text" name="setting[gl][filter][ipp_sel]" class="form-control" value="<?php echo $glf_ipp_sel ?>"></div>
		</div>
		<div class="col-md-3">
			<div class="form-group bg-group">
				<div class="checkbox">
					<label><input type="checkbox" name="setting[gl][filter][ctg_cb]" 
						value="1" <?php echo $glf_ctg_cb?>>Categories</label>
				</div>		
			</div>
		</div>
	</div>

	<div class="form-group bg-group">
		<label>Slider Filter Range (Number)</label>
		<table class="table">
			<thead>
				<tr>
					<th>Label</th>
					<th>Filtered Key</th>
					<th>Min. Value</th>
					<th>Max. Value</th>
					<th>Remove</th>
				</tr>
			</thead>
			<tbody id="filrange-tbody">
				<?php
					$ele_name = 'setting[gl][filter][filrange]';
					foreach ( $glf_fr as $key => $fr ) {
						echo 
							'<tr fr-id="' . $key . '">' . 
								'<td><input type="text" name="' . $ele_name . '[' . $key . '][label]" value="' . $fr['label'] . '"></td>' . 
								'<td><input type="text" name="' . $ele_name . '[' . $key . '][filtered_key]" value="' . $fr['filtered_key'] . '"></td>' . 
								'<td><input type="text" name="' . $ele_name . '[' . $key . '][min_val]" value="' . $fr['min_val'] . '"></td>' . 
								'<td><input type="text" name="' . $ele_name . '[' . $key . '][max_val]" value="' . $fr['max_val'] . '"></td>' . 
								'<td><span class="glyphicon glyphicon-trash remove-fil_range"></span></td>' . 
							'<tr>';
					}
				?>
			</tbody>
		</table>
		<button type="button" class="btn" id="add-filrange"><span class="glyphicon glyphicon-plus"></span> Filter Range</button>
	</div>
	
	<?php
		
		$glfc 				= isset( $glf['color'] ) ? $glf['color'] : [];
		
		$glfc_bg 			= isset( $glfc['bg'] ) ? $glfc['bg'] : '';
		$glfc_font 			= isset( $glfc['font'] ) ? $glfc['font'] : '';
		$glfc_labelicon 	= isset( $glfc['labelicon'] ) ? $glfc['labelicon'] : '';
		$glfc_slideri 		= isset( $glfc['slideri'] ) ? $glfc['slideri'] : '';
		$glfc_slidero 		= isset( $glfc['slidero'] ) ? $glfc['slidero'] : '';

		$glfc_btn_bg 		= isset( $glfc['btn_bg'] ) ? $glfc['btn_bg'] : '';
		$glfc_btn_icon 		= isset( $glfc['btn_icon'] ) ? $glfc['btn_icon'] : '';

		$glfc_sel_bg 		= isset( $glfc['sel_bg'] ) ? $glfc['sel_bg'] : '';
		$glfc_sel_font 		= isset( $glfc['sel_font'] ) ? $glfc['sel_font'] : '';
		$glfc_selos_bg 		= isset( $glfc['selos_bg'] ) ? $glfc['selos_bg'] : '';
		$glfc_selou_bg 		= isset( $glfc['selou_bg'] ) ? $glfc['selou_bg'] : '';
		$glfc_selos_font 	= isset( $glfc['selos_font'] ) ? $glfc['selos_font'] : '';
		$glfc_selou_font 	= isset( $glfc['selou_font'] ) ? $glfc['selou_font'] : '';
	?>

	<div class="form-group-title">
   		<label>Main Color</label>
   		<p class="twgm-group-info">Select Element Color Setting</p>
   	</div>
	<div class="row">
		<!-- Background Color -->
		<div class="form-group col-md-2 fg-color">
			<label>Background</label>
			<div class="box-color color" style="background:<?php echo $glfc_bg ?>"></div>
			<input type="hidden" class="form-control" name="setting[gl][filter][color][bg]"
				value="<?php echo $glfc_bg ?>">
		</div>
		<!-- Font Color -->
		<div class="form-group col-md-2 fg-color">
			<label>Font</label>
			<div class="box-color color" style="background:<?php echo $glfc_font ?>"></div>
			<input type="hidden" class="form-control" name="setting[gl][filter][color][font]"
				value="<?php echo $glfc_font ?>">
		</div>
		<!-- Label Icon Color -->
		<div class="form-group col-md-2 fg-color">
			<label>Label Icon</label>
			<div class="box-color color" style="background:<?php echo $glfc_labelicon ?>"></div>
			<input type="hidden" class="form-control" name="setting[gl][filter][color][labelicon]"
				value="<?php echo $glfc_labelicon ?>">
		</div>
	</div>

	<div class="form-group-title">
   		<label>Button Color</label>
   		<p class="twgm-group-info">Select Element Color Setting</p>
   	</div>
	<div class="row">
		<!-- Button Background Color -->
			<div class="form-group col-md-2 fg-color">
				<label>Background</label>
				<div class="box-color color" style="background:<?php echo $glfc_btn_bg ?>"></div>
				<input type="hidden" class="form-control" name="setting[gl][filter][color][btn_bg]"
					value="<?php echo $glfc_btn_bg ?>">
			</div>		
		<!-- Button Icon Color -->
			<div class="form-group col-md-2 fg-color">
				<label>Icon</label>
				<div class="box-color color" style="background:<?php echo $glfc_btn_icon ?>"></div>
				<input type="hidden" class="form-control" name="setting[gl][filter][color][btn_icon]"
					value="<?php echo $glfc_btn_icon ?>">
			</div>		
		
	</div>

	<div class="form-group-title">
   		<label>Select Color</label>
   		<p class="twgm-group-info">Select Element Color Setting</p>
   	</div>
	<!-- SELECT COLOR -->
	<div class="row">
		<!-- Background -->
			<div class="form-group col-md-2 fg-color">
				<label>Background</label>
				<div class="box-color color" style="background:<?php echo $glfc_sel_bg ?>"></div>
				<input type="hidden" class="form-control" name="setting[gl][filter][color][sel_bg]"
					value="<?php echo $glfc_sel_bg ?>">
			</div>		
		<!-- Font -->
			<div class="form-group col-md-2 fg-color">
				<label>Font</label>
				<div class="box-color color" style="background:<?php echo $glfc_sel_font ?>"></div>
				<input type="hidden" class="form-control" name="setting[gl][filter][color][sel_font]"
					value="<?php echo $glfc_sel_font ?>">
			</div>
		<!-- Option Background (Unselect) -->
			<div class="form-group col-md-2 fg-color">
				<label>Option Background (Unselect)</label>
				<div class="box-color color" style="background:<?php echo $glfc_selou_bg ?>"></div>
				<input type="hidden" class="form-control" name="setting[gl][filter][color][selou_bg]"
					value="<?php echo $glfc_selou_bg ?>">
			</div>		
		<!-- Option Background (Select) -->
			<div class="form-group col-md-2 fg-color">
				<label>Option Background (Select)</label>
				<div class="box-color color" style="background:<?php echo $glfc_selos_bg ?>"></div>
				<input type="hidden" class="form-control" name="setting[gl][filter][color][selos_bg]"
					value="<?php echo $glfc_selos_bg ?>">
			</div>		
		<!-- Option Font (Unselect) -->
			<div class="form-group col-md-2 fg-color">
				<label>Option Font (Unselect)</label>
				<div class="box-color color" style="background:<?php echo $glfc_selou_font ?>"></div>
				<input type="hidden" class="form-control" name="setting[gl][filter][color][selou_font]"
					value="<?php echo $glfc_selou_font ?>">
			</div>		
		<!-- Option Font (Select) -->
			<div class="form-group col-md-2 fg-color">
				<label>Option Font (Select)</label>
				<div class="box-color color" style="background:<?php echo $glfc_selos_font ?>"></div>
				<input type="hidden" class="form-control" name="setting[gl][filter][color][selos_font]"
					value="<?php echo $glfc_selos_font ?>">
			</div>		
		
	</div>

	<div class="form-group-title">
   		<label>Slider Color</label>
   		<p class="twgm-group-info">Select Element Color Setting</p>
   	</div>
	<div class="row">
		<!-- Slider (Inside) Color -->
		<div class="form-group col-md-2 fg-color">
			<label>Slider (Inside)</label>
			<div class="box-color color" style="background:<?php echo $glfc_slideri ?>"></div>
			<input type="hidden" class="form-control" name="setting[gl][filter][color][slideri]"
				value="<?php echo $glfc_slideri ?>">
		</div>		
		<!-- Slider (Outside) Color -->
		<div class="form-group col-md-2 fg-color">
			<label>Slider (Outside)</label>
			<div class="box-color color" style="background:<?php echo $glfc_slidero ?>"></div>
			<input type="hidden" class="form-control" name="setting[gl][filter][color][slidero]"
				value="<?php echo $glfc_slidero ?>">
		</div>
	</div>



	
	

</div>