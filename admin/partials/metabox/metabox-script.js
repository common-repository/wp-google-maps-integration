(function( $ ) {
	'use strict';
	$(document).ready(function() {
		
		// MARKER ON CLICK
		$('#twgm-moc').on('change', function () {
			if( $(this).val() === 'redirect_link' ) {
				$('#twgm-redirect_url').show();
			} else {
				$('#twgm-redirect_url').hide();
			}
		});
		
		// ICON TYPE
		$('#twgm-it').on('change', function() {
			if( $( this ).val() === 'custom_icon' ) {
				$( '#twgm-custom_icon' ).show();
			} else {
				$( '#twgm-custom_icon' ).hide();
			}
		});


		var input = (document.getElementById('twgm-adr'));
		
		var map = new google.maps.Map(
				document.getElementById("map"), {
					zoom: 13,
					center: new google.maps.LatLng( $( '#twgm-lat' ).val() , $( '#twgm-lon' ).val() ),
					mapTypeId: google.maps.MapTypeId.ROADMAP,
					fullscreenControl: false
			});
		google.maps.event.trigger(map, 'resize');

		var marker = new google.maps.Marker({
				position: new google.maps.LatLng( $( '#twgm-lat' ).val() , $( '#twgm-lon' ).val() ),
				draggable: true,
				clickable: true,
				map: map

			});
		marker.addListener('drag', fillLatLng);
		marker.addListener('dragend', fillLatLng);
		function fillLatLng( event ) {
			$( '#twgm-lat' ).val( event.latLng.lat() );
			$( '#twgm-lon' ).val( event.latLng.lng() );
		}

		var autocomplete = new google.maps.places.Autocomplete( input );
		
		autocomplete.addListener( 'place_changed', function() {
			
			var place = autocomplete.getPlace();
			
			if (typeof place != 'undefined'){
				
				if (!place.geometry) {
					window.alert("Autocomplete's returned place contains no geometry");
					return;
				}
				
				var latLng = place.geometry.location;
				$( '#twgm-lat' ).val( latLng.lat() );
				$( '#twgm-lon' ).val( latLng.lng() );
				
				var newPosition = new google.maps.LatLng( latLng.lat(), latLng.lng() ); 
				map.setCenter( newPosition );

				marker.setPosition( newPosition );

			}
		});

		$( '.twgm_ctg' ).on( 'click', function () {
			var id = ( $( this ).attr( 'id' ) );
			var isChecked = $(this).is(':checked');
			id = id.split( '-' )[3];
			var selected_ctg = $( '#selected_ctg' ).val();
			selected_ctg = selected_ctg.split( ',' );
			if( isChecked ) {
				if ( selected_ctg.indexOf( id ) == -1 ) {
					selected_ctg.push( id );
				}
			} else {
				var index = selected_ctg.indexOf( id ); 
				if (  index != -1 ) {
					selected_ctg.splice( index, 1 );
				}
			}
			$( '#selected_ctg' ).val( selected_ctg );
			
			var mainIconContent = '';
			if ( selected_ctg.length > 1 ) {
				for ( var i = 1; i < selected_ctg.length; i++ ) {
					var ctgName = $('label[for="twgm-ctg-cb-'+selected_ctg[i]+'"]').text().trim();
					mainIconContent += '<label><input type="radio" value="' + selected_ctg[i] + '" name="twgm[icon]" id="twgm-ctg-rb-'+selected_ctg[i]+'">' + ctgName + '</label>';	
				}
				$('#main_ctg').html(mainIconContent);
				$('#twgm-main-icon').show();
			} else {
				$('#twgm-main-icon').hide();
			}

			
		});
		
		var buttonName = '';
		// IWIMAGE
		$('#select_iwimage').click( function() {
			tb_show('Upload a Image', 'media-upload.php?referer=media_page&type=image&TB_iframe=true&post_id=0', false);
			buttonName = '';
			buttonName = 'iwimage';
			return false;
		});

		$( '#remove_iwimage' ).click( function() {
			$( '#iwimage' ).val( '' );
			$( '#infowindowimage' ).attr( 'src', '' );
			$( '#infowindowimage' ).hide();
		});

		// CUSTOM ICON
		$('#select_customicon').click( function() {
			tb_show('Upload a Image', 'media-upload.php?referer=media_page&type=image&TB_iframe=true&post_id=0', false);
			buttonName = '';
			buttonName = 'customicon';
			return false;
		});

		$( '#remove_customicon' ).click( function() {
			$( '#ciimage' ).val( '' );
			$( '#customiconimage' ).attr( 'src', '' );
			$( '#customiconimage' ).hide();
		})

		window.send_to_editor = function(html) {				
			var image_url = $(html).filter("img").attr('src');
			if ( buttonName === 'iwimage' ) {
				$('#iwimage').val(image_url);
				$("#infowindowimage").attr("src", image_url);
				$("#infowindowimage").show();
			}
			if ( buttonName === 'customicon' ) {
				$('#ciimage').val(image_url);
				$("#customiconimage").attr("src", image_url);
				$("#customiconimage").show();
			}
			tb_remove();
		}
		
	
	});
})( jQuery );
