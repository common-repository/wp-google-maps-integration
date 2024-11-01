(function($) {
	'use strict';
	$(document).ready(function() {
		$('#twgm-marker-ok').on('click', function() {
			var sel_img;
			$( '.twgm-marker-wrap' ).find( '.twgm-marker-radio' ).each( function() {
				if ( $( this ).is(":checked") ) {
					sel_img = ( $( this ).parent().find( 'img' ) );
				}
			});
			self.parent.send_to_editor( sel_img );
		});
	});
})(jQuery);