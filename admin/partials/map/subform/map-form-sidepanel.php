<!-- [Form Sub Title] - Side Panel -->
						<?php
							$sidepanel = $setting['sidepanel'];
							$sp_cb = isset( $sidepanel['cb'] ) ? 'checked' : '';
							$sp_posi_left 	= ( $sidepanel['position'] === 'LEFT' ) ? 'selected' : '';
							$sp_posi_right 	= ( $sidepanel['position'] === 'RIGHT' ) ? 'selected' : '';
						?>
						<div class="form-group form-sub-title">
							<label>Side Panel</label>
							<p>Please check Activate and set the settings to use and customize Side Panel feature</p>
						</div>

<div class="form-sub-component">

						<div class="form-group">
							<div class="checkbox">
								<label>
									<input type="checkbox" name="setting[sidepanel][cb]" value="1"
										<?php echo $sp_cb ?>>
									Activate
								</label>
							</div>
						</div>

						<div class="row">
							
							<div class="col-md-3">
								<!-- [SidePanel] - Height -->
								<div class="form-group">
									<label>Height</label>
									<input type="text" class="form-control" name="setting[sidepanel][height]" 
										value="<?php echo $sidepanel['height'] ?>">
								</div>
								<!-- [SidePanel] - Position -->
								<div class="form-group">
									<label>Position</label>
									<select class="form-control" name="setting[sidepanel][position]">
										<option val="left" <?php echo $sp_posi_left ?>>LEFT</option>
										<option val="right" <?php echo $sp_posi_right ?>>RIGHT</option>
									</select>	
								</div>
								<!-- [SidePanel] - First Select -->
								<div class="form-group">
									<label>First Select</label>
									<select class="form-control" name="setting[sidepanel][first_select]">
										<?php
											$tabs = array( 'marker', 'route' );
											$sp_firstselect = $sidepanel['first_select'];
											foreach ( $tabs as $tab ) {
												$selected = ( $sp_firstselect === $tab ) ? 'selected' : '';
												echo '<option value="' . $tab . '" ' . $sp_firstselect . ' ' . $selected . '>' . ucwords( str_replace( '_', ' ', $tab ) ) . '</option>';
											}
										?>
									</select>
								</div>
							</div>
							
							<!-- [SidePanel] - Tab -->
							<?php
								$sel_tabitems = isset( $sidepanel['tabitem'] ) ? $sidepanel['tabitem'] : [];
								$tabitems = array( 'marker', 'route' );
							?>
							<div class="form-group col-md-2">
								<label>Tab</label>
								<?php
									foreach( $tabitems as $ti ) {
										$checked = in_array( $ti, $sel_tabitems ) ? 'checked' : ''; ?>
											<div class="checkbox">
												<label><input type="checkbox" name="setting[sidepanel][tabitem][]" 
													value="<?php echo $ti ?>" <?php echo $checked ?>><?php echo ucwords( $ti ) ?></label>
											</div>
										<?php	
									}
								?>
								
							</div>

							<!-- [SidePanel] - Marker Icon -->
							<?php
								$mitv = $sidepanel['mitv'];
								$mitv_parent_cb = in_array( 'parent', $mitv ) ? 'checked' : ''; 
								$mitv_child_cb = in_array( 'child', $mitv ) ? 'checked' : '';
							?>
							<div class="form-group col-md-2">
								<label>Marker Icon (TreeView)</label>
								<!-- Tab - Marker List -->
								<div class="checkbox">
									<label>
										<input type="checkbox" name="setting[sidepanel][mitv][]" value="parent"
											<?php echo $mitv_parent_cb ?>>
										Parent
									</label>
								</div>
								<!-- Tab - Route List -->
								<div class="checkbox">
									<label>
										<input type="checkbox" name="setting[sidepanel][mitv][]" value="child"
											<?php echo $mitv_child_cb ?>>
										Child
									</label>
									
								</div>
							</div>

						</div>

						<div class="form-group">
					       	<?php
					       		$sp_toggle = $sidepanel['btn_toggle'];
					       		$sp_header = $sidepanel['header'];
					       		$sp_tab = $sidepanel['tab'];
					       		$sp_input = $sidepanel['ele_input'];
					       		$sp_button = $sidepanel['ele_button'];
					       		$sp_select = $sidepanel['ele_select'];
					       		$sp_main = $sidepanel['main'];
					       		$sp_scroll = $sidepanel['scroll'];
					       		$sp_mtv = $sidepanel['mtv'];
					       	?>

							<div class="form-group-title">
					       		<label>Button Toggle Color</label>
					       		<p class="twgm-group-info">Button toggle color setting</p>
					       	</div>
							<div class="row">
								<div class="form-group col-md-2 fg-color">
									<label>Slider</label>
									<div class="box-color color" style="background:<?php echo $sp_toggle['slider'] ?>"></div>
									<input type="hidden" class="form-control" name="setting[sidepanel][btn_toggle][slider]"
										value="<?php echo $sp_toggle['slider'] ?>">
								</div>
								<div class="form-group col-md-2 fg-color">
									<label>Menu Tab</label>
									<div class="box-color color" style="background:<?php echo $sp_toggle['menu_tab'] ?>"></div>
									<input type="hidden" class="form-control" name="setting[sidepanel][btn_toggle][menu_tab]"
										value="<?php echo $sp_toggle['menu_tab'] ?>">
								</div>
							</div>

					       	<div class="form-group-title">
					       		<label>Header Color</label>
					       		<p class="twgm-group-info">Header Color Setting</p>
					       	</div>
							<div class="row">
								<div class="form-group col-md-2 fg-color">
									<label>Background</label>
									<div class="box-color color" style="background:<?php echo $sp_header['background'] ?>"></div>
									<input type="hidden" class="form-control" name="setting[sidepanel][header][background]"
										value="<?php echo $sp_header['background'] ?>">
								</div>
								<div class="form-group col-md-2 fg-color">
									<label>Icon</label>
									<div class="box-color color" style="background:<?php echo $sp_header['icon'] ?>"></div>
									<input type="hidden" class="form-control" name="setting[sidepanel][header][icon]"
										value="<?php echo $sp_header['icon'] ?>">
								</div>
								<div class="form-group col-md-2 fg-color">
									<label>Text</label>
									<div class="box-color color" style="background:<?php echo $sp_header['font'] ?>"></div>
									<input type="hidden" class="form-control" name="setting[sidepanel][header][font]"
										value="<?php echo $sp_header['font'] ?>">
								</div>
							</div>

							<div class="form-group-title">
					       		<label>Tab Color</label>
					       		<p class="twgm-group-info">Tab Panel Setting</p>
					       	</div>
							<div class="row">
								<div class="form-group col-md-2 fg-color">
									<label>Background</label>
									<div class="box-color color" style="background:<?php echo $sp_tab['background'] ?>"></div>
									<input type="hidden" class="form-control" name="setting[sidepanel][tab][background]"
										value="<?php echo $sp_tab['background'] ?>">
								</div>
								<div class="form-group col-md-2 fg-color">
									<label>Icon<br>( Unselected )</label>
									<div class="box-color color" style="background:<?php echo $sp_tab['icon_unselected'] ?>"></div>
									<input type="hidden" class="form-control" name="setting[sidepanel][tab][icon_unselected]"
										value="<?php echo $sp_tab['icon_unselected'] ?>">
								</div>
								<div class="form-group col-md-2 fg-color">
									<label>Icon<br>( Selected )</label>
									<div class="box-color color" style="background:<?php echo $sp_tab['icon_selected'] ?>"></div>
									<input type="hidden" class="form-control" name="setting[sidepanel][tab][icon_selected]"
										value="<?php echo $sp_tab['icon_selected'] ?>">
								</div>
							</div>

							<div class="form-group-title">
					       		<label>Main Color</label>
					       		<p class="twgm-group-info">Main Color Setting</p>
					       	</div>
							<div class="row">
								<div class="form-group col-md-2 fg-color">
									<label>Background</label>
									<div class="box-color color" style="background:<?php echo $sp_main['background'] ?>"></div>
									<input type="hidden" class="form-control" name="setting[sidepanel][main][background]"
										value="<?php echo $sp_main['background'] ?>">
								</div>
								<div class="form-group col-md-2 fg-color">
									<label>Font</label>
									<div class="box-color color" style="background:<?php echo $sp_main['font'] ?>"></div>
									<input type="hidden" class="form-control" name="setting[sidepanel][main][font]"
										value="<?php echo $sp_main['font'] ?>">
								</div>
							</div>

							<div class="form-group-title">
					       		<label>Scroll Color</label>
					       		<p class="twgm-group-info">Scroll Color Setting</p>
					       	</div>
							<div class="row">
								<div class="form-group col-md-2 fg-color">
									<label>Pane</label>
									<div class="box-color color" style="background:<?php echo $sp_scroll['pane'] ?>"></div>
									<input type="hidden" class="form-control" name="setting[sidepanel][scroll][pane]"
										value="<?php echo $sp_scroll['pane'] ?>">
								</div>
								<div class="form-group col-md-2 fg-color">
									<label>Slider</label>
									<div class="box-color color" style="background:<?php echo $sp_scroll['slider'] ?>"></div>
									<input type="hidden" class="form-control" name="setting[sidepanel][scroll][slider]"
										value="<?php echo $sp_scroll['slider'] ?>">
								</div>
							</div>

							<div class="form-group-title">
						       		<label>Input Element Color</label>
						       		<p class="twgm-group-info">Input Element Color Setting</p>
						       	</div>
							<div class="row">
								<div class="form-group col-md-2 fg-color">
									<label>Background</label>
									<div class="box-color color" style="background:<?php echo $sp_input['background'] ?>"></div>
									<input type="hidden" class="form-control" name="setting[sidepanel][ele_input][background]"
										value="<?php echo $sp_input['background'] ?>">
								</div>
								<div class="form-group col-md-2 fg-color">
									<label>Font</label>
									<div class="box-color color" style="background:<?php echo $sp_input['font'] ?>"></div>
									<input type="hidden" class="form-control" name="setting[sidepanel][ele_input][font]"
										value="<?php echo $sp_input['font'] ?>">
								</div>
							</div>

							<div class="form-group-title">
					       		<label>Select Element Color</label>
					       		<p class="twgm-group-info">Select Element Color Setting</p>
					       	</div>
							
							<div class="row">
								<div class="form-group col-md-2 fg-color">
									<label>Background</label>
									<div class="box-color color" style="background:<?php echo $sp_select['background'] ?>"></div>
									<input type="hidden" class="form-control" name="setting[sidepanel][ele_select][background]"
										value="<?php echo $sp_select['background'] ?>">
								</div>
								<div class="form-group col-md-2 fg-color">
									<label>Font</label>
									<div class="box-color color" style="background:<?php echo $sp_select['font'] ?>"></div>
									<input type="hidden" class="form-control" name="setting[sidepanel][ele_select][font]"
										value="<?php echo $sp_select['font'] ?>">
								</div>
							</div>
							<div class="form-group-title">
						   		<label>Button Color</label>
						   		<p class="twgm-group-info">Select Element Color Setting</p>
						   	</div>
							<div class="row">
								<!-- RF - Button Background Color -->
								<div class="form-group col-md-2 fg-color">
									<label>Button Background</label>
									<div class="box-color color" style="background:<?php echo $sp_button['background'] ?>"></div>
									<input type="hidden" class="form-control" name="setting[sidepanel][ele_button][background]"
										value="<?php echo $sp_button['background'] ?>">
								</div>
								<!-- RF - Butotn Icon Color -->
								<div class="form-group col-md-2 fg-color">
									<label>Button Icon</label>
									<div class="box-color color" style="background:<?php echo $sp_button['font'] ?>"></div>
									<input type="hidden" class="form-control" name="setting[sidepanel][ele_button][font]"
										value="<?php echo $sp_button['font'] ?>">
								</div>
							</div>

							<div class="form-group-title">
					       		<label>TreeView</label>
					       		<p class="twgm-group-info">Select Element Color Setting</p>
					       	</div>
					       	<div class="row">
					       		<div class="form-group col-md-2 fg-color">
									<label>Checbox</label>
									<div class="box-color color" style="background:<?php echo $sp_mtv['color_checkbox'] ?>"></div>
									<input type="hidden" class="form-control" name="setting[sidepanel][mtv][color_checkbox]"
										value="<?php echo $sp_mtv['color_checkbox'] ?>">
								</div>
					       	</div>
							<div class="row">
								<div class="form-group col-md-2 fg-color">
									<label>Line Between Parent</label>
									<div class="box-color color" style="background:<?php echo $sp_mtv['color_gap'] ?>"></div>
									<input type="hidden" class="form-control" name="setting[sidepanel][mtv][color_gap]"
										value="<?php echo $sp_mtv['color_gap'] ?>">
								</div>
								<div class="form-group col-md-2">
									<label>Parent Border Type</label>
									<select class="form-control" name="setting[sidepanel][mtv][gap_border_type]">
										<?php
											$border_types = array( 'dotted', 'dashed', 'solid', 'double', 'groove', 'ridge', 'inset', 'outset' );
											$sp_mtv_gbt = $sp_mtv['gap_border_type'];
											foreach ( $border_types as $bt ) {
												$selected = ( $sp_mtv_gbt === $bt ) ? 'selected' : '';
												echo '<option value="' . $bt . '" ' . $selected . '>' . ucwords( str_replace( '_', ' ', $bt ) ) . '</option>';
											}
										?>
									</select>
								</div>
								<div class="form-group col-md-2">
									<label>Parent Border Side</label>
									<select class="form-control" name="setting[sidepanel][mtv][gap_border_side]">
										<?php
											$border_sides = array( 'top', 'bottom', 'left', 'right' );
											$sp_mtv_gbs = $sp_mtv['gap_border_side'];
											foreach ( $border_sides as $bs ) {
												$selected = ( $sp_mtv_gbs === $bs ) ? 'selected' : '';
												echo '<option value="' . $bs . '" ' . $selected . '>' . ucwords( str_replace( '_', ' ', $bs ) ) . '</option>';
											}
										?>
									</select>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-md-2 fg-color">
									<label>Item Border Color</label>
									<div class="box-color color" style="background:<?php echo $sp_mtv['item_border_color'] ?>"></div>
									<input type="hidden" class="form-control" name="setting[sidepanel][mtv][item_border_color]"
										value="<?php echo $sp_mtv['item_border_color'] ?>">
								</div>
								<div class="form-group col-md-2">
									<label>Item Border Type</label>
									<select class="form-control" name="setting[sidepanel][mtv][item_border_type]">
										<?php
											$border_types = array( 'dotted', 'dashed', 'solid', 'double', 'groove', 'ridge', 'inset', 'outset' );
											$sp_mtv_ibt = $sp_mtv['item_border_type'];
											foreach ( $border_types as $bt ) {
												$selected = ( $sp_mtv_ibt === $bt ) ? 'selected' : '';
												echo '<option value="' . $bt . '" ' . $selected . '>' . ucwords( str_replace( '_', ' ', $bt ) ) . '</option>';
											}
										?>
									</select>
								</div>
								<div class="form-group col-md-2">
									<label>Item Border Side</label>
									<select class="form-control" name="setting[sidepanel][mtv][item_border_side]">
										<?php
											$border_sides = array( 'top', 'bottom', 'left', 'right' );
											$sp_mtv_ibs = $sp_mtv['item_border_side'];
											foreach ( $border_sides as $bs ) {
												$selected = ( $sp_mtv_ibs === $bs ) ? 'selected' : '';
												echo '<option value="' . $bs . '" ' . $selected . '>' . ucwords( str_replace( '_', ' ', $bs ) ) . '</option>';
											}
										?>
									</select>
								</div>
							</div>
						</div>

</div>