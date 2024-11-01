<!-- [Form Sub Title] - Layer -->

<!-- [Form Sub Title] - Routes -->
<div class="form-group form-sub-title">
	<label>Routes</label>
	<p>Please check for adding these routes into map</p>
</div>

<input type="hidden" id="routes" name="route" value="<?php echo $route ?>">
<table id="route-table" class="display" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th>Select</th>
			<th>Name</th>
			<th>Start Point</th>
			<th>End Point</th>
		</tr>
	</thead>
	<tbody>
		<?php

			$table_name = $wpdb->prefix . 'twgm_route';
			$ltable = $wpdb->prefix . 'twgm_marker';
			$results = $wpdb->get_results( 
				'SELECT r.id, r.name, l1.name AS sp, l2.name AS ep FROM ' . $table_name . ' r LEFT JOIN ' . $ltable . ' l1 on l1.id = r.startpoint LEFT JOIN ' . $ltable . ' l2 on l2.id = r.endpoint' );
			$number1 = 0;
			$routes = explode( ',', $route );
			foreach ( $results  as $key => $row ) {
				$number1 ++;
				$checked = in_array( $row->id, $routes ) ? 'checked' : '';
				echo '<tr>';
				echo '<td><input class="maproutes" name="maproutes[]" value="' . esc_attr( $row->id ) . '" type="checkbox" ' . $checked . '></td>';
				echo '<td>' . esc_html( $row->name ) . '</td>';
				echo '<td>' . esc_html( $row->sp ) . '</td>';
				echo '<td>' . esc_html( $row->ep ) . '</td>';
				echo '</tr>';
			}
		?>
	</tbody>
</table>