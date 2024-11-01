
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
global $wpdb;
$twgm_nonce 	= wp_create_nonce( basename( __FILE__ ) );
$form_type = ( absint( $item['id'] ) > 0 ) ? 'Edit' : 'Add';

?>

<div class="wrap">
<form class="form" role="form" method="post">
	<input type="hidden" name="twgm_nonce" value="<?php echo $twgm_nonce ?>"/>
	<input type="hidden" name="id" value="<?php echo absint( $item['id'] ) ?>"/>
	
	<div class="twgm-tabs no-nav" style="display:none;">
		
		<!-- FORM TABS HEADER -->
		<div class="twgm">
			<div class="twgm-page-title">
				<div class="twgm-main-title">
				<span class="icon dashicons dashicons-category"></span>
				<span><?php echo $form_type ?> Category</span>
				</div>
			</div>
		</div>
		
		<!-- TABS CONTENT -->
		<ul class="twgm-tabs-content">
			
			<!-- [TAB ONE] Data -->
			<li data-content="ctg-tab-data" class="selected">
				
				<div class="twgm">
					<div class="container" style="width:100%;">

						<!-- [Form Sub Title] - Marker Data -->
						<div class="form-group form-sub-title">
							<label>Category Data</label>
							<p>Please fill below data, this category information will be used by marker</p>
						</div>

						<!-- Name -->
						<div class="form-group">
						    <label>Name</label>
						    <input type="text" class="form-control" name="name" 
						    	value="<?php echo $item['name'] ?>" 
						    	placeholder="Category name">
						</div>

						<!-- Description -->
						<div class="form-group">
						  	<label>Description</label>
						  	<textarea class="form-control" rows="7" name="description"
								placeholder="Specific description about category"><?php echo $item['description'] ?></textarea>
						</div>

						<div class="row">
							<!-- Category Icon -->
							<?php
								$iconpath = esc_url( $item['iconpath'] );
								$ci_img_display = ( !empty( $iconpath ) ) ? 'block' : 'none';
							?>
							<div class="form-group col-md-3"> 
								<label>Icon</label>
								<!-- Custom Icon Upload/Select -->
								<div class="wp-media-wrapper" media-id="icon">
									<div class="form-group">
										<label>Please upload or select Image</label>
										<img src="<?php echo $item['iconpath'] ?>" style="display:<?php echo $ci_img_display ?>;">
										<input type="text" class="form-control" name="iconpath"
											value="<?php echo $item['iconpath'] ?>">
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

