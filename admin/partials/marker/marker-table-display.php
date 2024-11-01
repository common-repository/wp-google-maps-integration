<?php	
	require_once plugin_dir_path( dirname( __FILE__ ) ) . 'marker/class-marker-table.php';
	global $wpdb;
	if ( isset( $_POST['marker-import'] ) ) {
		$this->marker_import();
	}
	$table = new TWGM_Marker_Table();
	$table->prepare_items();
	$total_pages = $table->_pagination_args['total_pages'];
	if ( isset( $_GET['paged'] ) ) {
		$current_paged = absint( $_GET['paged'] );
		if ( ( $current_paged > 0 ) && ( $current_paged <= $total_pages ) ) {
			$_SESSION['twgm_marker_current_page'] = $current_paged;
		} else {
			$_SESSION['twgm_marker_current_page'] = 1;
		}
	} 
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->	
<div class="wrap">
	<div class="twgm-dl">
		<div class="header-title">
			<div class="icon-wrap">
				<span class="dashicons dashicons-location"></span>Marker
			</div>
		</div>
		<div class="table-wrap">
			<!-- NOTICATION -->
			<?php
				if ( isset( $_SESSION['twgm_marker_total_del'] ) ) {
					if ( absint( $_SESSION['twgm_marker_total_del'] ) > 0 ) {
						echo '<div class="updated below-h2" id="message"><p>' . sprintf( __( 'Items deleted: %d', 'twgm' ), absint( $_SESSION['twgm_marker_total_del'] ) ) . '</p></div>';
					}
					$_SESSION['twgm_marker_total_del'] = 0;
				}
			?>
			
			<!-- MANAGE BUTTON -->
			<div class="manage-btn-wrap">
				<div class="btn-add"><a href="<?php echo get_admin_url( get_current_blog_id(), 'admin.php?page=twgm-marker-add' ) ?>"><span class="dashicons dashicons-plus"></span>Add Data</a></div>	
			</div>
			<!-- FORM TABLE -->
			<form id="marker-table" method="POST">
				<?php $table->search_box( 'Search Markers', 'name' );// Tambahan saja ?>
				<input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>"/>
				<?php $table->display() ?>
			</form>

		</div>
	</div>
</div>
	
<script>	
	(function($) {
	'use strict';
	$(document).ready(function() {
		$('input[type=file]').change(function(e) {
	  		$('#file-path').val($(this).val());
		});
	});
	})(jQuery);
</script>