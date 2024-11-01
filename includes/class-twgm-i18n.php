<?php

class TWGM_i18n {

	public function load_plugin_textdomain ( ) {
		load_plugin_textdomain(
			'twgm',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);
	}

}
