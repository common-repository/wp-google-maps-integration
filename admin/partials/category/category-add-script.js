(function($) {
	'use strict';
	$(document).ready(function() {
		
		// Show All after load complete
		$('.twgm-tabs').show();

		// WP Media
		var curBtn = '';
		$('.wp-media-wrapper').on('click', '.select-img', function() {
			tb_show( 
				'Upload a Image', 
				'media-upload.php?referer=media_page&type=image&TB_iframe=true&post_id=0', 
				false
			);
			curBtn = '';
			curBtn = $(this).parent().parent().parent().attr('media-id');
			return false;
		});
		$('.wp-media-wrapper').on('click', '.remove-img', function() {
			var wrapper = $(this).parent().parent().parent();
			console.log(wrapper);
			wrapper.find('input').val('');
			wrapper.find('img').attr('src', '').hide();
		});
		window.send_to_editor = function(html) {				
			var image_url = $(html).filter('img').attr('src');
				if (curBtn === "icon") {
					var wrapper = $('.wp-media-wrapper[media-id="icon"]');
					wrapper.find('input').val(image_url);
					wrapper.find('img').attr('src', image_url).show();
				}
			tb_remove();
		}



	});
})(jQuery);