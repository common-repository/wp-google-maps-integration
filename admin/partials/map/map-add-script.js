(function($) {
	'use strict';
	$(document).ready(function() {

		// Display tabs after all loaded
		$('.twgm-tabs').show();

		// Initial - Color
		var colorPickerSettings = {
			customBG: '#222',
			margin: '4px -2px 0',
			doRender: 'div div',

			buildCallback: function($elm) {
				var colorInstance = this.color,
					colorPicker = this;

				$elm.prepend('<div class="cp-panel">' +
					'R <input type="text" class="cp-r" /><br>' +
					'G <input type="text" class="cp-g" /><br>' +
					'B <input type="text" class="cp-b" /><hr>' +
					'H <input type="text" class="cp-h" /><br>' +
					'S <input type="text" class="cp-s" /><br>' +
					'B <input type="text" class="cp-v" /><hr>' +
					'<input type="text" class="cp-HEX" />' +
				'</div>').on('change', 'input', function(e) {
					var value = this.value,
						className = this.className,
						type = className.split('-')[1],
						color = {};

					color[type] = value;
					colorInstance.setColor(type === 'HEX' ? value : color,
						type === 'HEX' ? 'HEX' : /(?:r|g|b)/.test(type) ? 'rgb' : 'hsv');
					colorPicker.render();
					this.blur();
				});
			},

			cssAddon: // could also be in a css file instead
				'.cp-color-picker{box-sizing:border-box; width:220px;}' +
				'.cp-color-picker .cp-panel {line-height: 21px; float:right;' +
					'padding:0 1px 0 8px; margin-top:-1px; overflow:visible}' +
				'.cp-xy-slider:active {cursor:none;}' +
				'.cp-panel, .cp-panel input {color:#bbb; font-family:monospace,' +
					'"Courier New",Courier,mono; font-size:12px; font-weight:bold;}' +
				'.cp-panel input {width:28px; height:12px; padding:2px 3px 1px;' +
					'text-align:right; line-height:12px; background:transparent;' +
					'border:1px solid; border-color:#222 #666 #666 #222;'+
					'font-size:10px; font-weight: normal;}' +
				'.cp-panel hr {margin:0 -2px 2px; height:1px; border:0;' +
					'background:#666; border-top:1px solid #222;}' +
				'.cp-panel .cp-HEX {width:44px; position:absolute; margin:1px -3px 0 -2px;}' +
				'.cp-alpha {width:155px;}',

			renderCallback: function($elm, toggled) {
				var alpha = this.color.colors.alpha;
				var colors = this.color.colors.RND,
					modes = {
						r: colors.rgb.r, g: colors.rgb.g, b: colors.rgb.b,
						h: colors.hsv.h, s: colors.hsv.s, v: colors.hsv.v,
						HEX: this.color.colors.HEX
					};

				$('input', '.cp-panel').each(function() {
					this.value = modes[this.className.substr(3)];
				});
				
				$elm.parent().find('input').val('rgba('+modes.r+','+modes.g+','+modes.b+','+alpha+')');
			}
		};
		$('.color').colorPicker(colorPickerSettings);

		// Initial - Data Table
		initDataTable('marker', 'markers');
		initDataTable('route', 'routes');

		// Initial - WP Media
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
			wrapper.find('input').val('');
			wrapper.find('img').attr('src', '').hide();
		});
		window.send_to_editor = function( html ) {				
			var image_url = $(html).filter('img').attr('src');
				if (curBtn !== "") {
					var wrapper = $('.wp-media-wrapper[media-id="' + curBtn + '"]');
					wrapper.find('input').val(image_url);
					wrapper.find('img').attr('src', image_url).show();
				}
			tb_remove();
		}

		// Map Default Plugin Setting
		// Set Default Map Theme, Position & Zoom based on Plugin Setting
		var lat = $('#center-lat').val(),
			lng = $('#center-lng').val(),
			zoom = '10',
			theme = '',
			map_type_id = google.maps.MapTypeId.ROADMAP;
		if ( $( '#map-id' ).val() === '0' ) {
			lat = ( $( '#twgm-gmaps-def-lat' ).val() ) ? $( '#twgm-gmaps-def-lat' ).val() : '0';
			lng = ( $( '#twgm-gmaps-def-lng' ).val() ) ? $( '#twgm-gmaps-def-lng' ).val() : '0';
		}
		zoom = ( $( '#twgm-gmaps-def-zoom' ).val() ) ? $( '#twgm-gmaps-def-zoom' ).val() : '10';
		theme = ( $( '#twgm-gmaps-def-theme' ).val() ) ? $( '#twgm-gmaps-def-theme' ).val() : '';

		try {
			if ( theme.trim() !== '' ) {
				theme = JSON.parse( theme.replace( /\\"/g, '"' ) );
				theme = new google.maps.StyledMapType( theme, { name: 'Plugin Style' } );
				map_type_id = 'custom_style';
			}
		} catch( error ) {
			alert( 'Dynamic Google Maps Error -> Default Map Style, error = ' + error );
			theme = '';
		}

		// Initialize Map and Marker
		var latLng = new google.maps.LatLng(lat, lng);
		var map = new google.maps.Map(document.getElementById('map-center-position'), {
			zoom: Number( zoom ),
			scrollwheel: false,
			center: latLng,
			mapTypeId: map_type_id, //google.maps.MapTypeId.ROADMAP,
			mapTypeControlOptions: {
				mapTypeIds: [ google.maps.MapTypeId.ROADMAP, 'custom_style' ]
			},
		});
		
		// Set Default Map Style
		if ( map_type_id === 'custom_style' ) {
			map.mapTypes.set( 'custom_style', theme );
		}

		var marker = new google.maps.Marker({
			title: 'Please drag this marker to change latitude and longitude',
			position: latLng,
			map: map,
			draggable: true
		});

		// Update current position info
		updateMarkerPosition(latLng);
		
		// Add dragging listener
		google.maps.event.addListener(marker, 'drag', function() {
			updateMarkerPosition(marker.getPosition());
		});


		function updateMarkerPosition(position) {
			$('#center-lat').val(position.lat());
			$('#center-lng').val(position.lng());
		}

		/* -- DATA TABLE -- */
		function initDataTable ( tableId, inputId ) {
			$('#' + tableId + '-table').DataTable({
				'scrollX': true
			});
			$('#' + tableId + '-table tbody').on('click', 'input', function() {
				var ids = [];
				ids = $('#' + inputId).val().split(',');
				var id = $(this).val();
				if (this.checked) {
					ids.push(id);
				} else {
					for (var i = 0; i < ids.length; i++) {
						if (id === ids[i]) {
							ids.splice(i,1);
						}
					}
				}
				$('#' + inputId).val(ids);
			});
		}

		/* -- CPT MARKER FORM -- */

	});
})(jQuery);