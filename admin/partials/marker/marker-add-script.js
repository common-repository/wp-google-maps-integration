(function($) {
	'use strict';
	$(document).ready(function() {

		/* -- Initialize -- */
		
		// Show All after load complete
		$('.twgm-tabs').show();

		// Gray all btn-fill for geocode
		$('span.btn-fill').css({'color':'gainsboro'});

		// Category Table
		var category_table = $('#category-table').DataTable({
			'scrollX': true
		});
		
		// [RadioButton] - Custom Icon
		$('input[type=radio][name="setting[icon_type]"]').change(function() {
			var wrapper = $('.wp-media-wrapper[media-id="icon"]'); 
        	if (this.value === 'main_category') {
            	wrapper.hide();
       		}
        	else if (this.value === 'custom_icon') {
            	wrapper.show();
        	}
    	});

    	// [RadioButton] - Redirect Link
    	$('input[type=radio][name="setting[onclick]"]').change(function() {
    		if (this.value === 'redirect_link') {
    			$('#redirect-link').show();
    		} else {
    			$('#redirect-link').hide();
    		}
    	});
			
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
				if (curBtn === 'image') {
					var wrapper = $('.wp-media-wrapper[media-id="image"]');
					wrapper.find('input').val(image_url);
					wrapper.find('img').attr('src', image_url).show();
				}
			tb_remove();
		}

		// Category CheckBox
		var categoryData = [];
		$('#category-table').on('click','input', function() {
			var id = $(this).val();
			var row = $(this).closest('tr');
			var name = row.find('.ctg-name').html().toString();
			var iconPath = row.find('.ctg-icon').find('img').attr('src');
			if (this.checked) {
				addCategory(id);
				addCategoryEle({id, name, iconPath});
			} else {
				delCategory(id);
				delCategoryEle(id);
			}
		});
		function addCategory(id) {
			var category = $('#category').val().split(',');
			var available = false;
			for (var i = 0; i < category.length; i++) {
				if (id === category[i]) {
					available = true;
					break;
				}
			}
			if (!available) {
				category.push(id);
				$('#category').val(category);
			}
		}
		function delCategory(id) {
			var category = $('#category').val().split(',');
			for (var i = 0; i < category.length; i++) {
				if (id === category[i]) {
					category.splice(i,1);
				}
			}
			$('#category').val(category);
			if (category.length <= 1) {
				$('#selected-category').hide();
			}
		}
		function delCategoryEle(id) {
			$('#selected-category-table tr input[value="'+id+'"]').each(function() {
				var parent = $(this).parent().parent();
				if ($(parent).attr('ctg-id') === id) {
					$(parent).remove();
				}
			});
		}
		function addCategoryEle(categoryData) {
			if ( categoryData.iconPath === '' ) {
				//categoryData.iconPath = '//:0';
			}
			$('#selected-category-table').append(
				'<tr ctg-id="'+categoryData.id+'">'+
					'<td>'+
						'<input type="radio" name="maincategory" value="'+categoryData.id+'">'+
					'</td>'+
					'<td>'+
						categoryData.name+
					'</td>'+
					'<td>'+
						'<img class="ctg-img" src="'+categoryData.iconPath+'">'+
					'</td>'+
				'</tr>'
			);
		}

		// [ExtraField] - Custom Information
		$('#add-extra-field').on('click', function() {
			$('#extra-field-form').show();
		});
		$('#extra-field-ok').on('click', function() {
			var key = $('#extra-field-key').val();
			$('#extra-field-key').val('');
			addExtraFieldEle(key);
			$('#extra-field-form').hide();
		});
		$('#extra-field-cancel').on('click', function() {
			$('#extra-field-key').val('');
			$('#extra-field-form').hide();
		});
		$('#extra-field-result').on('click', '.remove-extra-field', function() {
			$(this).parent().parent().remove();
		});


		function addExtraFieldEle(key) {
			var res =
				'<div class="row single-extra-field" style="padding:5px 0px;">'+
					'<div class="col-md-2">'+
						'<label>'+key+'</label>'+
					'</div>'+
					'<div class="col-md-4">'+
						'<input name="extrafield['+key+']" type="text" class="form-control" placeholder="Please enter data value">'+
						'<div class="remove-extra-field">'+
							'<span class="glyphicon glyphicon-remove"></span>'+
						'</div>'+
					'</div>'+
				'</div>';
			$('#extra-field-result').append(res);
		}
		function delExtraFieldEle() {

		}

		// Map
		const NUMBER = 'street_number';
		const ADDRESS = 'route';
		const AREA = 'administrative_area_level_4';
		const DISTRICT = 'administrative_area_level_3';
		const CITY = 'administrative_area_level_2';
		const STATE = 'administrative_area_level_1';
		const COUNTRY = 'country';
		const POSTAL_CODE = 'postal_code';
		var locNumber, locAddress, locArea, locDistrict, 
			locCity, locState, locCountry, locPostalcode,
			specificIW = false,
			iwContent = '',
			geocoder = new google.maps.Geocoder(), 
			infoWindow = new google.maps.InfoWindow();
		
		// [CheckBox] -- Specific InfoWindow
    	$('#cb-specific-infowindow').on('click', function() {
    		if (this.checked) {
    			specificIW = true;
    			infoWindow.open(map, marker);
    		} else {
    			specificIW = false;
    			infoWindow.close();
    		}
    	});

    	// Set Default Map Theme, Position & Zoom based on Plugin Setting
		var lat = $('#lat').val(),
			lng = $('#lng').val(),
			zoom = '10',
			theme = '',
			map_type_id = google.maps.MapTypeId.ROADMAP;
		if ( $( '#marker-id' ).val() === '0' ) {
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
		var map = new google.maps.Map(document.getElementById('map'), {
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
		geocodePosition(latLng);
		
		// Add dragging listener
		google.maps.event.addListener(marker, 'dragstart', function() {
			infoWindow.close();
			updateMarkerAddress('Dragging');
		});
		google.maps.event.addListener(marker, 'drag', function() {
			updateMarkerPosition(marker.getPosition());
		});
		google.maps.event.addListener(marker, 'dragend', function() {
			geocodePosition(marker.getPosition());
		});
		
		// Autocomplete
		var input = document.getElementById('address-finder'),
			autoComplete = new google.maps.places.Autocomplete(input);
		autoComplete.bindTo('bounds', map);
		autoComplete.addListener('place_changed', function() {
			var place = autoComplete.getPlace();
			if (typeof place !== 'undefined') {
				infoWindow.close();
				marker.setVisible(false);
				if (!place.geometry) {
					alert("Autocomplete's returned place contains no geometry");
					return;
				}
				if (place.geometry.viewport) {
					map.fitBounds(place.geometry.viewport);
				} else {
					map.setCenter(place.geometry.location);
					map.setZoom(16);
				}
				latLng = place.geometry.location;
				marker.setPosition(latLng);
				marker.setVisible(true);
				$('#lat').val(latLng.lat());
				$('#lng').val(latLng.lng());
				var address = '';
				if (place.address_components) {
					var ac = place.address_components;
					address = [
						(ac[0] && ac[0].short_name || ''),
						(ac[1] && ac[1].short_name || ''),
						(ac[2] && ac[2].short_name || '')
					].join(' ');
				}
				geocodePosition(latLng);
			}
		});

		// Geocode by LatLng
		$('#get-position').click(function() {
			var newPosition = new google.maps.latLng( 
				$('#lat').val(),
				$('#lng').val()
			);
			marker.setPosition(newPosition);
			map.setCenter(newPosition);
			geocodePosition(newPosition);
		});
		
		// Fill Geocode Information (City, State, Country, Postal Code)
		$('.btn-fill').on('click', function() {
			var dataFill = $(this).attr('data-fill');
			fillExtraInfo(dataFill); 
		});

		function fillExtraInfo(type) {
			switch (type) {
				case 'city':
					$('#city').val(locCity);
					break;
				case 'state':
					$('#state').val(locState);
					break;
				case 'country':
					$('#country').val(locCountry);
					break;
				case 'postal-code':
					$('#postal-code').val(locPostalcode);
					break;
				case 'all':
					$('#city').val(locCity);
					$('#state').val(locState);
					$('#country').val(locCountry);
					$('#postal-code').val(locPostalcode);
					break;
			}
		}

		function clearGeocodeData() {
			locNumber = '';
			locAddress = '';
			locArea = '';
			locDistrict = '';
			locCity = '';
			locState = '';
			locCountry = '';
			locPostalcode = '';
		}

		function geocodePosition(position){
			geocoder.geocode({
				latLng: position
			}, function(responses) {
				if (responses && responses.length > 0) {
					clearGeocodeData();
					var addressComponent = responses[0].address_components,
						totalAddressComponent = addressComponent.length,
						longName = '',
						shortName = '',
						type = '';
					locNumber = '';
					locAddress = '';
					locArea = '';
					locDistrict = '';
					$('span.btn-fill').css({'color':'gainsboro'});
					locCity = '';
					locState = '';
					locCountry = '';
					locPostalcode = '';
					for (var i = 0; i < totalAddressComponent; i++ ) {
						if (addressComponent[i]['types'][0]) {
							type = addressComponent[i]['types'][0];
							longName = addressComponent[i].long_name;
							switch (type) {
								case NUMBER:
									locNumber = longName;
									break;
								case ADDRESS:
									locAddress = longName;
									break;
								case AREA:
									locArea = longName;
									break;
								case DISTRICT:
									locDistrict = longName;
									break;
								case CITY:
									locCity = longName;
									$('span.btn-fill[data-fill="city"]').css({'color':'#ff4f4f'});
									break;
								case STATE:
									locState = longName;
									$('span.btn-fill[data-fill="state"]').css({'color':'#ff4f4f'});
									break;
								case COUNTRY:
									locCountry = longName;
									$('span.btn-fill[data-fill="country"]').css({'color':'#ff4f4f'});
									break;
								case POSTAL_CODE:
									locPostalcode = longName;
									$('span.btn-fill[data-fill="postal-code"]').css({'color':'#ff4f4f'});
									break;
							}
						}
					}
					setIWContent();
					updateMarkerAddress(responses[0].formatted_address);
					if (specificIW) {
						infoWindow.open(map, marker);	
					}
				} else {
					updateMarkerAddress('Cannot determine address at this location');
				}
			});
		}

		function setIWContent() {
			iwContent = 
				'<table>' +
					'<tr><td><b>Number</b></td><td>' + locNumber + '</td></tr>' +
					'<tr><td><b>Address</b></td><td>' + locAddress + '</td></tr>' + 
					'<tr><td><b>Area</b></td><td>' + locArea + '</td></tr>' + 
					'<tr><td><b>District</b></td><td>' + locDistrict + '</td></tr>' +
					'<tr><td><b>City</b></td><td>' + locCity + '</td></tr>' + 
					'<tr><td><b>State</b></td><td>' + locState + '</td></tr>' + 
					'<tr><td><b>Country</b></td><td>' + locCountry + '</td></tr>' + 
					'<tr><td><b>Postal Code</b></td><td>' + locPostalcode + '</td></tr>' +
				'</table>';
			infoWindow.setContent(iwContent);
		}

		function updateMarkerAddress(str) {
			$('#address-finder').val(str);
		}

		function updateMarkerPosition(position) {
			$('#lat').val(position.lat());
			$('#lng').val(position.lng());
		}


	});
})(jQuery);