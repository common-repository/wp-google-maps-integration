<?php

class TWGM_Activator {

	public static function activate ( ) {
		self::set_admin_capability();
	}

	static function set_admin_capability ( ) {
		$capabilities = array(
			'user_manual',
			'marker_table',
			'marker_add',
			'marker_export',
			'marker_import',
			'category_table',
			'category_add',
			'route_table',
			'route_add',
			'shape_table',
			'shape_add',
			'map_table',
			'map_add',
			'backup',
			'rolepermission',
			'setting',
			'infowindow_table',
			'infowindow_add'
		);
		$role = get_role( 'administrator' );
		foreach ( $capabilities as $capability ) {
			$role->add_cap( 'twgm_' . $capability );
		}
	}
}

?>