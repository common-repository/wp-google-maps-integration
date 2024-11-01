(function( $, window, document, undefined ) {


	var pluginName = 'TWGM';


	// -- DEFAULT CONTROL --
	var default_map_control = {
		zoom: {
			//cb: '1',
			position: 'RIGHT_BOTTOM'
		},
		fullscreen: {
			//cb: '1',
			position: 'RIGHT_TOP'
		},
		streetview: {
			//cb: '1',
			position: 'RIGHT_BOTTOM'
		},
		map_type: {
			//cb: '1',
			position: 'RIGHT_BOTTOM',
			style: 'HORIZONTAL_BAR'
		},
		scale: {
			//cb: '1',
		}
	};


	// -- DEFAULT LAYER --
	var default_map_layer = {
		kmlz: [],
		fusion_table: [],
		geojson: [],
		gml: ''
	};
	var default_layer_kmlz = {
		// cb,
		name: '',
		url: ''
	}
	var default_layer_fusiontable = {
		//cb,
		name: '',
		select: '',
		from: '',
		where: ''
		//using_heat_map:
	}
	var default_layer_geojson = {
		//cb,
		name: '',
		url: ''
	}


	// -- DEFAULT CUSTOM MAP TYPE --
	var default_map_custom_type = {
		//active: '1',
		name: '',
		style: '[]'
	};


	// -- DEFAULT SETTING --
	var default_map_setting = {
		size: {
			width: '100%',
			height: '400px',
		},
		type: {
			active: [],
			first_select: 'ROADMAP'
		},
		custom_type: [],
		language: 'en',
		default_zoom: '1',
		z_index: '9999',
		behaviour: [],
		position: {
			lat: '0',
			lng: '0'
		},
		center_marker: '',
		default_marker: '',
		undefined_category_name: '',
		//uncategorized_marker_group: '1',
		marker_cluster: {
			//cb: '1',
			max_zoom: '4',
			grid: '10'
		},
		cos: {
			on_click: [],
			fill_color: 'rgba( 0, 0, 0, 0.2 )',
			stroke_color: 'rgba( 1, 1, 1, 0.2 )',
			stroke_weight: 1,
			radius: 20
		},
		dirserv: {
			//cb : '1',
			route_color: 'rgba( 0,0,0,1 )',
			route_weight: 2,
		},
		np: {
			//cb : '1',
			place_types: []
		},
		svp: {
			//cb: '1',
			lat: 0,
			lng: 0,
			pov_heading: 0,
			pov_pitch: 0,
			pov_zoom: 1,
			control: []
		},
		grid_overlay: {
			//cb: '1',
			border_color: '#fff',
			border_width: '2',
			border_style: 'SOLID',
			width: '50',
			height: '50',
			font_size: '10px'
		},
		limitation : {
			south_west: {
				lat: 0,
				lng: 0
			},
			north_east: {
				lat: 0,
				lng: 0
			},
			zoom_level: {
				from: 0,
				to: 19
			}
		},
		sidepanel: {
			// cb,
			height: '100%',
			position: 'right',
			first_select: 'marker',
			tabitem: [],
			mitv: [],
			btn_toggle: {
				slider: '',
				menu_tab: '',
			},
			header: {
				background: '',
				icon: '',
				font: ''
			},
			tab: {
				background: '',
				icon_unselected: '',
				icon_selected: ''
			},
			scroll: {
				pane: '',
				slider: ''
			},
			main: {
				background: '',
				font: '',
			},
			ele_input: {
				background: '',
				font: '',
			},
			ele_select: {
				background: '',
				font: '',
			},
			mtv: {
				color_gap: '',
				color_checkbox: '',
				item_border_color: '',
				item_border_type: '',
				item_border_side: ''
			}
		},
		infowindow: {
			representation: 'single',
			general_marker: '0',
			post_marker: '0',
			genmarker_defaultiwhtml: '',
			postmarker_defaultiwhtml: ''
		},
		carousel: {
			//cb,
			position: 'left-ins',
			item_html: '',
			navigation: {
				arrow: 'rgba( 0, 0, 0, 0.5 )',
				background: 'rgba( 1, 1, 1, 0.5 )'
			},
			togglebg: '',
			item_width: '100px',
			item_height: '60px'
		},
		gl: {
			//cb,
			header: {
				switcher_mode: 'grid',
				text: '',
				text_color: 'rgba( 1, 1, 1, 1 )',
				bg: 'rgba( 0, 0, 0, 1 )',
				// switcher_cb: '1',
				btnicon_color: 'rgba( 1, 1, 1, 1)'
			},
			search: {
				//cb,
				input_color_bg: 'rgba( 1, 1, 1, 1 )',
				input_color_font: 'rgba( 0, 0, 0, 1 )',
				button_color_bg: 'rgba( 0, 0, 0, 0.5 )',
				button_color_font: 'rgba( 1, 1, 1, 1 )',
				form_color_bg: 'rgba( 1, 1, 1, 0.3 )'
			},
			filter: {
				//cb,
				//sb_cb,
				sb_val: '',
				//ipp_cb, 
				ipp_val: '',
				//ctg_cb,
				filrange: [],
				color: {
					bg: '',
					font: '',
					label_icon: '',
					btn_bg: '',
					btn_icon: '',
					sel_bg: '',
					sel_font: '',
					slideri: '',
					slidero: ''
				}
			},
			grid_style: '',
			list_style: '',
		},
		rf: {
			//cb,
			val: {
				def: 0,
				min: 0,
				max: 2,
				unit: 'km'
			},
			color: {
				formbg: '',
				font: '',
				labelicon: '',
				slideri: '',
				slidero: '',
				btnbg: '',
				btnicon: '',
				inpbg: '',
				inpfont: '',
				cr: '',
				crs: '',
				crw: ''
			}
		}

	};


	$.fn.setTWGM = function( map, marker, category, route, shape, infowindow, postMarker, cptMarker ) {
		return this.each(function() {
			if ( ! $.data( this, 'plugin_' + pluginName ) ) {
				$.data( this, 'plugin_' + pluginName, new TWGM( this, map, marker, category, route, shape, infowindow, postMarker, cptMarker ) );
			}
		});
	}


	function TWGM ( element, map, marker, category, route, shape, infowindow, postMarker, cptMarker ) {
		
		// Plugin
		this.element 	= element;
		this._name 		= pluginName;

		// Map
		this.id 			= map.id;
		this.name 			= map.name;
		this.description 	= map.description;
		this.setting 		= $.extend( true, {}, default_map_setting, JSON.parse( map.setting ) );
		this.control		= $.extend( true, {}, default_map_control, JSON.parse( map.control ) );
		this.layer 			= $.extend( true, {}, default_map_layer, JSON.parse( map.layer ) );
		this.cpt 			= JSON.parse( map.cpt );
		// Category
		this.category 		= category;
		// Marker
		this.marker 		= marker;
		// Route
		this.route 			= route;
		// Shape
		this.shape 			= shape;
		// Infowindow
		this.infowindow 	= infowindow;
		// Post Marker
		this.post_marker 	= postMarker;
		// CPT Marker
		this.cpt_marker 	= cptMarker; 

		this.init();
	}

	TWGM.prototype.setMapSize = function () {
		var size = this.setting.size;
		var width = ( size.width !== '' ) ? size.width : '100%';
		var height = ( size.height !== '' ) ? size.height : '500px';
		$( this.map_ele ).width( width ).height( height );
		$( this.element ).width( width );
	}

	TWGM.prototype.prepMapPosition = function () {
		var position = this.setting.position;
		var latLng = new google.maps.LatLng( position.lat, position.lng );
		this.centerPosition = latLng;
	}

	TWGM.prototype.prepMapType = function () {
		var type = this.setting.type;
		var first_select = ( type.first_select !== '' ) ? type.first_select : 'ROADMAP';
		var active = type.active;
		var map_type_ids = [];
		var map_type_id;

		if ( active.indexOf( 'ROADMAP' ) > -1 ) {
			map_type_ids.push( google.maps.MapTypeId.ROADMAP );	
			if ( first_select === 'ROADMAP' ) {
				map_type_id = google.maps.MapTypeId.ROADMAP;
			}	
		}
		if ( active.indexOf( 'SATELLITE' ) > -1 ) {
			map_type_ids.push( google.maps.MapTypeId.SATELLITE );
			if ( first_select === 'SATELLITE' ) {
				map_type_id = google.maps.MapTypeId.SATELLITE;
			}
		}
		if ( active.indexOf( 'HYBRID' ) > -1 ) {
			map_type_ids.push( google.maps.MapTypeId.HYBRID );
			if ( first_select === 'HYBRID' ) {
				map_type_id = google.maps.MapTypeId.HYBRID;
			}
		}
		if ( active.indexOf( 'TERRAIN' ) > -1 ) {
			map_type_ids.push( google.maps.MapTypeId.TERRAIN );
			if ( first_select === 'TERRAIN' ) {
				map_type_id = google.maps.MapTypeId.TERRAIN;
			}
		}

		var custom_type = this.setting.custom_type;
		this.custom_type = custom_type;
		for ( var id in custom_type ) {
			if ( custom_type[ id ].active ) {
				map_type_ids.push( 'ct-' + id );
				if ( first_select === id ) {
					map_type_id = 'ct-' + id;
				}
			}
		}

		this.mapTypeIds = map_type_ids;
		this.mapTypeId = map_type_id;
	}

	TWGM.prototype.init = function () {
		
		var twgm 	= this;
		var setting = this.setting;

		this.map_ele = $( this.element ).find( '#map-' + this.id )[0];
		this.setMapSize();
		
		this.prepMapPosition();
		var def_zoom =  ( !isNaN( Number( setting.default_zoom ) ) ) ? Number( setting.default_zoom ) : 10;
		this.prepMapType();

		// Initialize Map
		this.map = new google.maps.Map(
			this.map_ele, {
				zoom: parseInt( def_zoom ),
				center: this.centerPosition,
				mapTypeControlOptions: {
					mapTypeIds: this.mapTypeIds
				},
				mapTypeId: this.mapTypeId,
				fullScreenControl: false
			}
		);

		
		this.setMapCustomTypeStyle();
		this.setMapBehaviour();
		//this.setRadiusFilter();
		this.setMapCenterMarker();
		//this.setMapGridOverlay();
		//this.setMapStreetViewPanorama();
		//this.setMapLimitation();
		this.setRoute();
		//this.setLayer();
		this.setCOS();
		this.setSidePanel();
		this.prepInfoWindow();
		this.setMarkerAndCategory();
		this.setMarkerTreeView();
		this.setMarkerCluster();
		//this.setDirectionsService();
		//this.setShape();
		//this.setCarousel();
		//this.setGridList();
		//this.setNearbyPlaceService();
		this.setMapControl();
	}

	
	TWGM.prototype.setMapCustomTypeStyle = function () {
		var type = this.setting.type;
		var custom_type = this.setting.custom_type; 
		var first_select = ( type.first_select !== '' ) ? type.first_select : 'ROADMAP';
		var temp_ct_name = '';
		try {
			//if ( Array.isArray( custom_type ) ) {
				for ( var id in custom_type ) {
					custom_type[ id ] = $.extend( true, {}, default_map_custom_type, custom_type[ id ] );
					if ( custom_type[ id ].active ) {
						var ct_name = custom_type[ id ].name;
						temp_ct_name = ct_name;
						var ct_style = ( custom_type[ id ].style !== '' ) ? custom_type[ id ].style : '[]';
						ct_style = JSON.parse( ct_style.replace( /\\"/g, '"' ) );
						ct_style = new google.maps.StyledMapType( ct_style, { name: ct_name } );
						this.map.mapTypes.set( 'ct-' + id, ct_style );
					}
				}
			//}
		} catch( error ) {
			console.log( 'Dynamic Google Maps Error -> Map Custom Type Style : ct_name = ' + temp_ct_name + ', error = ' + error );
		}	
	}


	TWGM.prototype.setMapBehaviour = function () {
		var behaviour = this.setting.behaviour;
		if ( Array.isArray( behaviour ) ) {
			// scroll zoom
			if ( behaviour.indexOf( 'scroll_zoom' ) > -1 ) {
				this.map.setOptions( { scrollwheel: true } );
			} else {
				this.map.setOptions( { scrollwheel: false } );
			}
			// double click zoom
			if ( behaviour.indexOf( 'double_click_zoom' ) > -1 ) {
				this.map.setOptions( { disableDoubleClickZoom: false } );
			} else {
				this.map.setOptions( { disableDoubleClickZoom: true } );
			}
			// draggable 
			if ( behaviour.indexOf( 'draggable' ) > -1 ) {
				this.map.setOptions( { draggable: true } );
			} else {
				this.map.setOptions( { draggable: false } );
			}
			// 45 imagery
			if ( behaviour.indexOf( '45_image' ) > -1 ) {
				this.map.setTilt( 45 );
			}
		} 
	}


	TWGM.prototype.setMapControl = function () {
		var twgm 	= this;
		var control = this.control;
		
		twgm.fullscreen_status = false;

		// zoom
		var zoom = control.zoom;
		if ( zoom.cb ) {
			this.map.setOptions({
				zoomControl: true,
				zoomControlOptions: {
					position: TWGM_GetGooglePosition( zoom.position )
				}
			});
		} else {
			this.map.setOptions( { zoomControl: false } );
		}
		// map type
		var maptype = control.maptype;
		if( maptype.cb ) {
			this.map.setOptions({
				mapTypeControl: true,
				mapTypeControlOptions: {
					position: TWGM_GetGooglePosition( maptype.position ),
					style: eval( "google.maps.MapTypeControlStyle." + maptype.style ),
					mapTypeIds: this.mapTypeIds
				}
			});
		} else {
			this.map.setOptions( { mapTypeControl: false } );
		}
		// scale
		var scale = control.scale;
		if( scale.cb ) {
			this.map.setOptions({ scaleControl: true });
		} else {
			this.map.setOptions({ scaleControl: false });
		}
		// street view
		var streetview = control.streetview;
		if( streetview.cb ) {
			this.map.setOptions({
				streetViewControl: true,
				streetViewControlOptions:{
					position: TWGM_GetGooglePosition( streetview.position )
				}
			});
		} else {
			this.map.setOptions({ streetViewControl: false });
		}
		// fullscreen
		if( control.fullscreen.cb ) {
			var twgm = this;
			var zindex = ( this.setting.z_index ) ? this.setting.z_index : 100;
			var jcarousel_old_position = $( '#jcarousel-' + twgm.id ).css('position');
			this.map.controls[ TWGM_GetGooglePosition( control.fullscreen.position ) ].push( 
				TWGM_FullScreenControl( 
					this.map, 
					zindex, 
					"&#xf25e", 
					"&#xf267",
					function () {
						google.maps.event.trigger( twgm.map, "resize" );
						
						// Set Side Panel
						$( twgm.element ).find( '#sp-' + twgm.id ).css({ 'position' : 'fixed', 'z-index' : zindex }).removeClass( 'twgm-sp-min' );
						$( twgm.element ).find( '#sp-' + twgm.id ).TWGM_VAlign().css({ 'display':'block' });
						twgm.setScrollSP();
						
						// Set Carousel
						if ( twgm.setting.carousel.cb && twgm.setting.carousel.position.indexOf( 'ins' ) > -1 ) {
							$( twgm.element ).find( '#jcarousel-' + twgm.id ).css({ 'position' : 'fixed', 'z-index' : zindex });
						}

						// Set Filter Radius
						$( twgm.element ).find( '#rad_form-' + twgm.id ).css({ 'position' : 'fixed', 'z-index' : zindex });
						twgm.fullscreen_status = true;
						$( window ).resize();
					},
					function () {
						google.maps.event.trigger( twgm.map, "resize" );
						
						// Set Side Panel
						$( twgm.element ).find( '#sp-' + twgm.id ).css({'position':'', 'z-index': '', 'height' : twgm.setting.sidepanel.height, 'width' : '' })
							.find( '.twgm-sp-togglemin' ).removeClass( 'kuncup' );
						$( twgm.element ).find( '#sp-' + twgm.id ).TWGM_VAlign().css({ 'display' : 'block' }).addClass( 'twgm-sp-min' );
						twgm.setScrollSP();
						
						// Set Carousel
						if ( twgm.setting.carousel.cb && twgm.setting.carousel.position.indexOf( 'ins' ) > -1 ) {
							$( twgm.element ).find( '#jcarousel-' + twgm.id ).css({'position': jcarousel_old_position, 'z-index': ''});
						}

						// Set Filter Radius
						$( twgm.element ).find( '#rad_form-' + twgm.id ).css({'position':'absolute', 'z-index': '1'});
						twgm.fullscreen_status = false;
						$( window ).resize();
					}
				) 
			);
		}
	}


	TWGM.prototype.setMapCenterMarker = function () {
		var url = this.setting.center_marker;
		if ( url !== '' ) {
			var marker = new google.maps.Marker({
				position: this.centerPosition,
				map: this.map,
				icon: url
			});
		}
	}


	TWGM.prototype.setSidePanel = function () {
		
		var id = this.id;
		var sidepanel = this.setting.sidepanel;
		var twgm = this;

		if ( sidepanel.cb ) {
			var height = sidepanel.height;
			var position = sidepanel.position;
			var first_select = sidepanel.first_select;
			var tabitem = ( sidepanel.tabitem ) ? sidepanel.tabitem : [];

			var e_sidepanel 		= $( this.element ).find( '#sp-' + id );
			var e_sp_button 		= e_sidepanel.find( '.twgm-sp-btn' );
			var e_sp_nav 			= e_sidepanel.find( '.twgm-sp-nav' );
			var e_sp_header_box 	= e_sidepanel.find( '.twgm-sp-header-box' );
			var e_sph_title 		= e_sidepanel.find( '.twgm-sp-header-title' );
			var e_sph_icon 			= e_sidepanel.find( '.twgm-sph-icon' );
			var e_sph_text 			= e_sidepanel.find( '.twgm-sph-text' );
			var e_sp_togglenav 		= e_sidepanel.find( '.twgm-sp-togglenav' );
			var e_sp_togglemin 		= e_sidepanel.find( '.twgm-sp-togglemin' );
			var nav_hide_options 	= {};
			var nav_show_options 	= {};

			e_sidepanel.height( sidepanel.height );
			e_sidepanel.TWGM_VAlign().css({ 'display':'block' });
			e_sp_nav.find('.sp-nav-item').each( function () {
				$( this ).css({ 'color' : sidepanel.tab.icon_unselected });
			});

			if ( position === 'RIGHT' ) {
				nav_hide_options['right'] = '-=40';
				nav_show_options['right'] = '+=40';
				e_sp_nav.css({ 'float' : 'right' });
				e_sp_header_box.css({ 'text-align' : 'left', 'left' : '0px' });
				e_sp_togglenav.css({ 'float' : 'right' });
				e_sp_togglemin.css({ 'float' : 'right' });
				e_sidepanel.css({ 'right' : '-300px' });
				e_sp_button.css({ 'position' : 'absolute', 'left' : '-10px', 'border-radius' : '4px 0px 0px 4px', 'box-shadow' : 'inset -2px 0px 2px rgba(0, 0, 0, 0.3)' })
					.TWGM_VAlign()
					.TWGM_ToggleClick( function () {
						e_sidepanel.TWGM_VAlign();
						if ( e_sp_togglenav.hasClass('hide-menu') ) {
							e_sidepanel.animate( { 'right' : '-42px' }, 50 );
						} else {
							e_sidepanel.animate( { 'right' : '-0px' }, 50 );
						}
					}, function () {
						e_sidepanel.animate( { 'right' : '-' + e_sidepanel.outerWidth() }, 50 );
					});
			} else if ( position === 'LEFT' ) {
				nav_hide_options['left'] = '-=40';
				nav_show_options['left'] = '+=40';
				e_sp_nav.css({ 'float' : 'left' });
				e_sp_header_box.css({ 'text-align' : 'right', 'right' : '0px' });
				e_sp_togglenav.css({ 'float' : 'left' });
				e_sp_togglemin.css({ 'float' : 'left' });
				e_sidepanel.css({ 'left' : '-300px' });
				e_sp_button.css({ 'position' : 'absolute', 'right' : '-10px', 'border-radius' : '0px 4px 4px 0px', 'box-shadow' : 'inset 2px 0px 2px rgba(0, 0, 0, 0.3)' })
					.TWGM_VAlign()
					.TWGM_ToggleClick( function () {
						e_sidepanel.TWGM_VAlign();
						if ( e_sp_togglenav.hasClass( 'hide-menu' ) ) {
							e_sidepanel.animate( { 'left' : '-42px' }, 50 );
						} else {
							e_sidepanel.animate( { 'left' : '-0px' }, 50 );
						}
					}, function () {
						e_sidepanel.animate( {'left' : '-' + e_sidepanel.outerWidth() }, 50 );
					});
			}

			google.maps.event.addDomListener(window, "resize", function() {
			 	e_sidepanel.TWGM_VAlign();
    		});

			// Initial - Tabs
			e_sidepanel.find( '#sp-tabs-' + id ).tabs().addClass( 'ui-tabs-vertical ui-helper-clearfix' );
			
			for ( var i = 0; i < tabitem.length; i++ ) {
				e_sp_nav.find( "a[href='#tab-" + tabitem[ i ] + "-" + id + "']" ).parent().show();
			}

			// Initial - Tabs Item Listener
			e_sp_nav.on( 'click', '.sp-nav-item', function (e) {
				var icon = $( this ).html();
				var tab_id = $( this ).attr( 'href' );
				var header_text = '';
	    		switch ( tab_id ) {
	    			case '#tab-marker-' + id:
	    				header_text = 'Marker';
	    				twgm.setScrollSPMarkerTab();
	    				break;
	    			case '#tab-directions-' + id:
	    				header_text = 'Directions';
	    				twgm.setScrollSPDirectionsTab();
	    				break;
	    			case '#tab-route-' + id:
	    				header_text = 'Route';
	    				twgm.setScrollSPRouteTab();
	    				break;
	    			case '#tab-nearby-' + id:
	    				header_text = 'Nearby';
	    				twgm.setScrollSPNearbyTab();
	    				break;
	    			case '#tab-layer-' + id:
	    				header_text = 'Layer';
	    				twgm.setScrollSPLayerTab();
	    				break;
	    			case '#tab-map_setting-' + id:
	    				header_text = 'Setting'
	    				twgm.setScrollSPSettingTab();
	    				break;
	    		}
	    		e_sp_nav.find('.sp-nav-item').each( function () {
					$( this ).css({ 'color' : sidepanel.tab.icon_unselected });
				});
	    		$( this ).css({ 'color' : sidepanel.tab.icon_selected });
	    		e_sph_icon.html( icon );
	    		e_sph_text.html( header_text );
	    		return false;
			});
			e_sp_nav.find( '.sp-nav-item[href="#tab-' + first_select + '-' + id + '"]' ).trigger( 'click' );
			
			// Initial - Toogle Nav Listener
			e_sp_togglenav.on( 'click', function() {
				if ( $( this ).hasClass( 'hide-menu' ) ) {
					$( e_sidepanel ).animate( nav_show_options, 50 );
					$( this ).removeClass( 'hide-menu' );
				} else {
					$( e_sidepanel ).animate( nav_hide_options, 50 );
					$( this ).addClass( 'hide-menu' );
				}
			});

			e_sp_togglemin.on( 'click', function() {
				if ( twgm.fullscreen_status ) {
					if ( !$( this ).hasClass( 'kuncup' ) ) {
						document.getElementById( 'sp-' + twgm.id ).style.setProperty( 'height', '52px','important' );
						document.getElementById( 'sp-' + twgm.id ).style.setProperty( 'width', '52px', 'important' );
						$( this ).addClass( 'kuncup' );
						return false;
					} else {
						e_sidepanel.css({
							'height' : twgm.setting.sidepanel.height,
							'width' : ''
						});
						$( this ).removeClass( 'kuncup' );
						return false;
					}
				}
			});

		}

	}

	TWGM.prototype.prepInfoWindow = function () {
		var infowindows = this.infowindow;
		this.rendered_infowindow = [];
		for ( var i = 0; i < infowindows.length; i++ ) {
			var result 		= '';
			var infowindow 	= infowindows[ i ];
			var content 	= JSON.parse( infowindow.content );
			var arrow 		= JSON.parse( infowindow.arrow );
			var closebtn 	= JSON.parse( infowindow.closebutton );
			var content_css 	= 'position : absolute;';
			var arrow_css 		= '';
			var closebtn_css 	= ''; 
			result += '<div>' + content.html + '</div>';
			// Set Content
			switch ( content.basedposition ) {
				case '1' : 
					content_css += 'top : ' + content.yposition + 'px;' +
						'left : ' + content.xposition + 'px;';
					break;
				case '2' : 
					content_css += 'bottom : ' + content.yposition + 'px;' + 
						'left : ' + content.xposition + 'px;';
					break;
			}
			// Set Arrow
			if ( infowindow.usingarrow === '1' ) {
				switch ( arrow.basedposition ) {
					case '1' : 
						arrow_css += 'top : ' + arrow.yposition + 'px;' +
							'left : ' + arrow.xposition + 'px;';
						break;
					case '2' : 
						arrow_css += 'bottom : ' + arrow.yposition + 'px;' +
							'left : ' + arrow.xposition + 'px;';
						break;
				}
				switch ( arrow.type ) {
					case '1' : 
						var point1 	= arrow.pointone;
						var point2 	= arrow.pointtwo;
						var point3 	= arrow.pointthree;
						var color 	= arrow.color;
						switch ( arrow.direction ) {
							// Up
							case '1' : 
								arrow_css += 'border-left : ' + point1 + 'px solid transparent;' +
									'border-right : ' + point2 + 'px solid transparent;' +
									'border-bottom : ' + point3 + 'px solid ' + color + ';';
								break;
							// Down
							case '2' : 
								arrow_css += 'border-left : ' + point1 + 'px solid transparent;' +
									'border-right : ' + point2 + 'px solid transparent;' +
									'border-top : ' + point3 + 'px solid ' + color + ';';
								break;
							// Left
							case '3' :
								arrow_css += 'border-top : ' + point1 + 'px solid transparent;' +
									'border-bottom : ' + point2 + 'px solid transparent;' +
									'border-right : ' + point3 + 'px solid ' + color + ';';
								break;
							// Right
							case '4' :
								arrow_css += 'border-top : ' + point1 + 'px solid transparent;' +
									'border-bottom : ' + point2 + 'px solid transparent;' +
									'border-left : ' + point3 + 'px solid ' + color + ';';
								break;
						}
						arrow_css += 'width : 0px;' + 
							'height : 0px;' + 
							'position : absolute;';
						break;
					case '2' : 
						var arrow_url 		= arrow.url;
						var arrow_width 	= arrow.width;
						var arrow_height 	= arrow.height;
							arrow_css += 'width : ' + arrow_width + 'px;' +
								'height : ' + arrow_height + 'px;' +
								'position : absolute;' +
								'background-image : url(' + arrow_url + ');' +
								'background-size : ' + arrow_width + 'px ' + arrow_height + 'px;' +
								'background-repeat : no-repeat;';
						break;
				}
				result += '<div class="twgm-iw-arrow" style="' + arrow_css + '"></div>';
			}
			// Set Close Button
			if ( infowindow.usingclosebutton === '1' ) {
				switch ( closebtn.basedposition ) {
					case '1' : 
						closebtn_css += 'top : ' + closebtn.yposition + 'px;' + 
							'left : ' + closebtn.xposition + 'px;';
						break;
					case '2' : 
						closebtn_css += 'bottom : ' + closebtn.yposition + 'px;' +
							'left : ' + closebtn.xposition + 'px;'
						break;
				}
				closebtn_css += 'background-image : url(' + closebtn.url + ');' + 
					'background-size : ' + closebtn.width + 'px ' + closebtn.height + 'px;' +
					'background-repeat : no-repeat;' + 
					'height : ' + closebtn.height + 'px;' + 
					'width : ' + closebtn.width + 'px;' +
					'position : absolute;';
				result += '<div class="twgm-iw-closebtn" style="' + closebtn_css + '"></div>';
			}
			// Add Rendered Infowindow
			this.rendered_infowindow[ i ] = {
				id: infowindow.id,
				name: infowindow.name,
				description: infowindow.description,
				html: result,
				content_css: content_css,
				using_arrow: infowindow.usingarrow,
				using_closebtn: infowindow.usingclosebutton,
				info_content: content.html
			};
		}
	}

	
	TWGM.prototype.setInfowindow = function ( iw_id, marker ) {
		var container 		= document.createElement( 'div' );
		var html 			= '';
		var info_content 	= '';
		var using_arrow, 
			using_closebtn, 
			options, 
			result;
		
		// Get content for Infowindow
		if ( iw_id === '0' ) {
			if ( marker.data.type ) {
				// POST
				if ( marker.data.type === 'post' ) {
					html = this.setting.infowindow.postmarker_defaultiwhtml;
				}
			} else {
				// General Marker
				html = this.setting.infowindow.genmarker_defaultiwhtml;	
			}
		} else {
			var custom_iw = this.rendered_infowindow;
			for ( var i = 0; i < custom_iw.length; i++ ) {
				if ( iw_id ===  custom_iw[ i ].id ) {
					container.style.cssText = custom_iw[ i ].content_css;
					html 			= custom_iw[ i ].html.replace( /\\"/g, '"' );
					using_arrow 	= ( custom_iw[ i ].using_arrow );
					using_closebtn 	= ( custom_iw[ i ].using_closebtn );
					info_content 	= ( custom_iw[ i ].info_content.replace( /\\"/g, '"' ) );
					break;
				}
			}
		}

		// Preparing content, replacing with key-value match
		html = TWGM_ReplaceInfo( html, marker );

		// Create infowindow object
		if ( iw_id === '0' ) {
			result = new google.maps.InfoWindow({
				disableAutoPan: true
			});
			result.isDisplay = false;
			result.setContent( html );
			// close listener
			google.maps.event.addListener( result, 'closeclick', function () {
			   this.isDisplay = false;
			});
			// open listener
			google.maps.event.addListener( result, 'domready', function () {
				this.isDisplay = true;
			});
		} else {
			container.innerHTML = html;
			var options = {
				content 				: container,
				disableAutoPan 			: true,
				maxWidth 				: 0,
				zIndex 					: null,
				boxStyle 				: { opacity: 1 },
				closeBoxURL 			: ( using_closebtn === '1' ) ? 'use' : '',
				closeBoxMargin 			: '-115px 2px 2px -20px',
				closeBoxStyle 			: 'width:20px; height:20px;',
				infoBoxClearance 		: new google.maps.Size( 1, 1 ),
				isHidden 				: false,
				pane 					: 'floatPane',
				enableEventPropagation 	: false
			};
			result = new InfoBox( options );
			result.isDisplay = false;
			// close listener
			google.maps.event.addListener( result, 'closeclick', function () {
			   this.isDisplay = false;
			});
			// open listener
			google.maps.event.addListener( result, 'domready', function () {
				this.isDisplay = true;
			});
		}
		return result;
	}

	TWGM.prototype.setSingleInfoWindow = function ( iw_id, type = null ) {
		var container 		= document.createElement( 'div' );
		var html 			= '';
		var info_content 	= '';
		var using_arrow, 
			using_closebtn, 
			options, 
			result;
		// Get content for Infowindow
		if ( iw_id === '0' ) {
			if ( type ) {
				// POST or CPT Marker
				if ( type === 'post' ) {
					html = this.setting.infowindow.postmarker_defaultiwhtml;
				}
			} else {
				// General Marker
				html = this.setting.infowindow.genmarker_defaultiwhtml;	
			}
		} else {
			var custom_iw = this.rendered_infowindow;
			for ( var i = 0; i < custom_iw.length; i++ ) {
				if ( iw_id ===  custom_iw[ i ].id ) {
					container.style.cssText = custom_iw[ i ].content_css;
					html 			= custom_iw[ i ].html.replace( /\\"/g, '"' );
					using_arrow 	= ( custom_iw[ i ].using_arrow );
					using_closebtn 	= ( custom_iw[ i ].using_closebtn );
					info_content 	= ( custom_iw[ i ].info_content.replace( /\\"/g, '"' ) );
					break;
				}
			}
		}

		//Create infowindow object
		if ( iw_id === '0' ) {
			result = new google.maps.InfoWindow({
				disableAutoPan: true
			});
			result.isDisplay = false;
			result.raw_content = html;
			// close listener
			google.maps.event.addListener( result, 'closeclick', function () {
			   this.isDisplay = false;
			});
			// open listener
			google.maps.event.addListener( result, 'domready', function () {
				this.isDisplay = true;
			});
		} else {
			container.innerHTML = html;
			var options = {
				content 				: container,
				disableAutoPan 			: true,
				maxWidth 				: 0,
				zIndex 					: null,
				boxStyle 				: { opacity: 1 },
				closeBoxURL 			: ( using_closebtn === '1' ) ? 'use' : '',
				closeBoxMargin 			: '-115px 2px 2px -20px',
				closeBoxStyle 			: 'width:20px; height:20px;',
				infoBoxClearance 		: new google.maps.Size( 1, 1 ),
				isHidden 				: false,
				pane 					: 'floatPane',
				enableEventPropagation 	: false
			};
			result = new InfoBox( options );
			result.raw_content = container;
			result.info_content = info_content;
			result.isDisplay = false;
			// close listener
			google.maps.event.addListener( result, 'closeclick', function () {
			   this.isDisplay = false;
			});
			// open listener
			google.maps.event.addListener( result, 'domready', function () {
				this.isDisplay = true;
			});
		}
		result.id = iw_id;
		return result;
	}

	TWGM.prototype.setMarkerAndCategory = function () {
		
		var twgm 						= this;
		var markers 					= this.marker;
		var categories 					= this.category;
		var undefined_category_name 	= this.setting.undefined_category_name;
		var def_marker_icon				= ( this.setting.default_marker ) ? this.setting.default_marker : 'https://maps.gstatic.com/mapfiles/ms2/micons/red-dot.png';
		var iw_set 						= this.setting.infowindow;
		var is_category_found 			= false;

		// Rewrite null iconpath of category and change to def_marker_icon
		for ( var i = 0; i < categories.length; i++ ) {
			if ( categories[ i ].iconpath === '' ) {
				categories[ i ].iconpath = def_marker_icon;
			}
		}

		this.markers 					= [];
		this.prep_markers 				= [];
		this.markers_cluster 			= [];
		this.prep_categories 			= [];
		this.prep_categories_id 		= [];
		
		// Initial Undefined Category
		if ( this.setting.uncategorized_marker_group ) {
			this.prep_markers.push({
				item: {
					id 				: 'cat-0',
					label 			: undefined_category_name,
					description 	: '',
					checked 		: false,
					display 		: true,
					icon 			: def_marker_icon			
				},
				children: []
			});
			this.prep_categories.push({
				id 		: '0',
				name 	: undefined_category_name
			});
		}

		// Single Infowindow
		var siw_genmarker 	= this.setSingleInfoWindow( iw_set.general_marker );
		var siw_postmarker 	= this.setSingleInfoWindow( iw_set.post_marker, 'post' );
		var siw_cptmarker 	= [];
		for ( var key in this.cpt ) {
			var cpt_setting = this.cpt[ key ];
			siw_cptmarker.push({
				id: key,
				iw: this.setSingleInfoWindow( cpt_setting.def_infowindow, 'cpt' )
			});
		}

		for ( var i = 0; i < markers.length; i++ ) {
			var md 				= markers[ i ];
			md.setting 			= JSON.parse( md.setting );
			var icontype 		= md.setting.icon_type;
			var custom_icon 	= ( icontype === 'custom_icon' ) ? md.setting.custom_icon : '';
			var onclick 		= md.setting.onclick;
			var redirect_link 	= ( onclick === 'redirect_link' ) ? md.setting.redirect_link : ''; 
			var behaviour 		= ( ( md.setting.behaviour ) && Array.isArray( md.setting.behaviour ) ) ? md.setting.behaviour : [];
			var animation 		= md.setting.animation;
			
			var marker = new google.maps.Marker({
				position: new google.maps.LatLng( md.lat, md.lng ),
				draggable: ( behaviour.indexOf( 'draggable' ) > -1 ),
				clickable: ( behaviour.indexOf( 'disable_click' ) == -1 ),
				optimized: false
			});

			marker.setTitle( md.name );
			marker.data 				= {}
			marker.data.id 				= md.id;
			marker.data.name 			= md.name;
			marker.data.description 	= md.description;
			marker.data.address 		= md.address;
			marker.data.lat 			= md.lat;
			marker.data.lng 			= md.lng;
			marker.data.city 			= md.city;
			marker.data.country 		= md.country;
			marker.data.state 			= md.state;
			marker.data.postalcode 		= md.postalcode;
			marker.data.image 			= md.image;
			marker.data.redirect_link 	= md.setting.redirect_link;
			marker.data.extrafield 		= ( md.extrafield ) ? md.extrafield : [];
			marker.data.setting 		= md.setting;
			marker.data.iconpath 		= '';
			marker.data.cat_check 		= 0;
			marker.data.category 		= [];
			marker.data.category_name 	= '';
			marker.data.type 			= md.type;
			marker.data.display 		= true;

			// Set Post and CPT data
			if ( marker.data.type ) {
				marker.data.post_content 	= md.post_content;
				marker.data.post_category 	= md.post_category;
				marker.data.post_tags 		= md.post_tags;
				marker.data.post_terms 		= md.post_terms;
				marker.data.permalink 		= md.permalink;
			}

			if ( marker.data.type === 'cpt' ) {
				marker.data.cpt_id = md.cpt_id;
				md.def_icon = ( md.def_icon !== '' ) ? md.def_icon : def_marker_icon;
				marker.setIcon( md.def_icon );
				marker.data.iconpath = md.def_icon;
			}

			// Push category id if integer and not empty string
			md.category = md.category.replace(/(^,)|(,$)/g, "");
			md.category = md.category.split( ',' );
			for ( var mdci = 0; mdci < md.category.length; mdci++ ) {
				if( md.category[ mdci ] ) {
					if ( !isNaN( Number( md.category[ mdci ] ) ) || md.category[ mdci ].startsWith( 'cpt' ) ) {
						marker.data.category.push( md.category[ mdci ] );
					}
				}
			}

			// Multiple InfoBox
			if ( iw_set.representation === 'multiple' ) {
				if ( md.type ) { 
					// Post or CPT
					marker.data.infobox = this.setInfowindow( md.infowindow_id, marker );
				} else {
					// General
					marker.data.infobox = this.setInfowindow( iw_set.general_marker, marker );
				}
			}

			// Marker Animation
			if ( animation !== 'NONE' ) {
				switch ( md.setting.animation ) {
					case 'DROP' : 
						marker.setAnimation( google.maps.Animation.DROP );
						break;
					case 'BOUNCE' : 
						marker.setAnimation( google.maps.Animation.BOUNCE );
						break;
				}
			}

			// Default Open Infobox
			if ( behaviour.indexOf( 'default_openiw' ) > -1 ) {
				if ( marker.data.infobox ) {
					marker.data.infobox.open( this.map, marker );
				} else {
					// Post Marker
					if ( md.type === 'post' ) {
						marker.data.def_iw = this.setInfowindow( iw_set.post_marker, marker );
						marker.data.def_iw.open( this.map, marker );
					} 
					// CPT Marker
					else if ( md.type === 'cpt' ) {
						for ( var key in this.cpt ) {
							var cpt_setting = this.cpt[ key ];
							if ( key == marker.data.cpt_id ) {
								marker.data.def_iw = this.setInfowindow( cpt_setting.def_infowindow, marker );
								marker.data.def_iw.open( this.map, marker );
							}
						}				
					} 
					// General Marker
					else {
						marker.data.def_iw = this.setInfowindow( iw_set.general_marker, marker );
						marker.data.def_iw.open( this.map, marker );
					}
				}
			}

			// === MARKER ON CLICK ===
			// SHOW INFOWINDOW
			if ( md.setting.onclick === 'show_infowindow' ) {
				if ( behaviour.indexOf( 'disable_click' ) === -1 ) {
					google.maps.event.addListener( marker, 'click', ( function ( marker ) {
						return function () {
							if ( twgm.anchor_type === 'selmarker' ) {
								twgm.setNearbyPlaceAnchorType( this );
							} else {
								// Multiple Infowindow
								if ( marker.data.infobox ) {
									marker.data.infobox.open( this.map, this );
								} else {
								// Single Infowindow									
									if ( this.data.type ) { 
										// POST MARKER
										if ( this.data.type === 'post' ) {
											siw_postmarker.close();
											if ( siw_postmarker.id !== '0' ) {
												// Custom Infowindow
												siw_postmarker.getContent().childNodes[0].innerHTML = TWGM_ReplaceInfo( siw_postmarker.info_content, this );
											} else {
												// General Infowindow
												siw_postmarker.setContent( TWGM_ReplaceInfo( siw_postmarker.raw_content, this ) );	
											}
											siw_postmarker.open( this.map, this );
										}
										// CPT MARKER
										if ( this.data.type === 'cpt' ) {
											for ( var j = 0; j < siw_cptmarker.length; j++ ) {
												if ( this.data.cpt_id == siw_cptmarker[ j ].id ) {
													siw_cptmarker[ j ].iw.close();
													if ( siw_cptmarker[ j ].iw.id !== '0' ) {
														// Custom Infowindow
														siw_cptmarker[ j ].iw.getContent().childNodes[0].innerHTML = TWGM_ReplaceInfo( siw_cptmarker[ j ].iw.info_content, this );
													} else {
														// General Infowindow
														siw_cptmarker[ j ].iw.setcontent( TWGM_ReplaceInfo( siw_cptmarker[ j ].iw.raw_content, this ) );
													}
													siw_cptmarker[ j ].iw.open( this.map, this );
												}
											}
										}
									} else { 
										// GENERAL MARKER
										siw_genmarker.close();
										if ( siw_genmarker.id !== '0' ) {
											// Custom Infowindow
											siw_genmarker.getContent().childNodes[0].innerHTML = TWGM_ReplaceInfo( siw_genmarker.info_content, this );
										} else { 
											// Default Infowindow
											siw_genmarker.setContent( TWGM_ReplaceInfo( siw_genmarker.raw_content, this ) );
										}
										siw_genmarker.open( this.map, this );
									}
								}
								
								this.map.panTo( this.getPosition() );
								
								// Set COS Position
								if ( twgm.setting.cos.on_click.indexOf( 'map_marker') > -1 ) {
									twgm.setCOSPosition( this.getPosition() );
								}
								// Set Carousel Position
								if ( twgm.setting.carousel.cb ) {
									twgm.setCarouselItemPosition( marker.data.id );
								}
							}
						}
					})( marker ));
				}
			}
			// REDIRECT LINK 
			else if ( marker.data.setting.onclick === 'redirect_link' ) {
				if ( behaviour.indexOf( 'disable_click' ) === -1 ) {
					google.maps.event.addListener( marker, 'click', ( function ( marker ) {
						return function () {
							if ( twgm.anchor_type === 'selmarker' ) {
								// Set nearby anchor with this marker ...
								twgm.setNearbyPlaceAnchorType( this );
							} else {
								this.map.panTo( this.getPosition() );
								// Set COS Position
								if ( twgm.setting.cos.on_click.indexOf( 'map_marker') > -1 ) {
									twgm.setCOSPosition( this.getPosition() );
								}
								// Set Carousel Position
								if ( twgm.setting.carousel.cb ) {
									twgm.setCarouselItemPosition( marker.data.id );
								}
								window.open( marker.data.setting.redirect_link, '_blank' );

							}
						}
					})( marker));
				}
			}
			// PERMALINK 
			else if ( marker.data.setting.onclick === 'permalink' ) {
				if ( behaviour.indexOf( 'disable_click' ) === -1 ) {
					google.maps.event.addListener( marker, 'click', ( function ( marker ) {
						return function () {
							if ( twgm.anchor_type === 'selmarker' ) {
								// Set nearby anchor with this marker ...
								twgm.setNearbyPlaceAnchorType( this );
							} else {
								this.map.panTo( this.getPosition() );
								// Set COS Position
								if ( twgm.setting.cos.on_click.indexOf( 'map_marker') > -1 ) {
									twgm.setCOSPosition( this.getPosition() );
								}
								// Set Carousel Position
								if ( twgm.setting.carousel.cb ) {
									twgm.setCarouselItemPosition( marker.data.id );
								}
								window.open( marker.data.permalink, '_blank' );
							}
						}
					})( marker));
				}
			} 
			// NONE
			else if ( marker.data.setting.onclick === 'none' ) {
				if ( behaviour.indexOf( 'disable_click' ) === -1 ) {
					google.maps.event.addListener( marker, 'click', ( function ( marker ) {
						return function () {
							if ( twgm.anchor_type === 'selmarker' ) {
								// Set nearby anchor with this marker ...
								twgm.setNearbyPlaceAnchorType( this );
							} else {
								this.map.panTo( this.getPosition() );
								// Set COS Position
								if ( twgm.setting.cos.on_click.indexOf( 'map_marker') > -1 ) {
									twgm.setCOSPosition( this.getPosition() );
								}
								// Set Carousel Position
								if ( twgm.setting.carousel.cb ) {
									twgm.setCarouselItemPosition( marker.data.id );
								}
							}
						}
					})( marker));
				}
			}

			// Event to automatically show/hide infowindow related to the marker cluster
			if ( this.setting.marker_cluster.cb ) {
				if ( marker.data.setting.onclick === 'show_infowindow' || behaviour.indexOf( 'disable_click' ) === -1 ) {
					google.maps.event.addListener( marker, 'map_changed', function() {
						if ( this.data.def_iw ) {
							if ( this.getMap() ) {
								if ( this.data.def_iw.isDisplay ) {
									this.data.def_iw.open( this.map, this );
								} 
							} else {
								this.data.def_iw.close();
							}
						}
						if ( this.data.infobox ) {
							if ( this.getMap() ) {
								if ( this.data.infobox.isDisplay ) {
									this.data.infobox.open( this.map, this );
								} 
							} else {
								this.data.infobox.close();
							}
						}
					});
				}
			}


			// Set Marker Icon and Category in looping together
			var icon_url	= ''
			var cat_prev 	= [];
			// Set marker icon with custom_icon
			if ( md.setting.icon_type === 'custom_icon' ) {
				md.setting.custom_icon = ( md.setting.custom_icon !== '' ) ? md.setting.custom_icon : def_marker_icon;
				icon_url = md.setting.custom_icon;
				marker.setIcon( icon_url );
				marker.data.iconpath = icon_url;
			}

			is_category_found = false;
			if ( marker.data.category.length > 0 ) {

				for ( var mci = 0; mci < marker.data.category.length; mci++ ) {
					var mc_id = marker.data.category[ mci ];

					for ( var ci = 0; ci < categories.length; ci ++ ) {
						var category = categories[ ci ];
						
						// Set marker icon with main_category icon
						if ( md.maincategory === category.id ) {
							if ( md.setting.icon_type === 'main_category' ) {
								icon_url = category.iconpath;
								marker.setIcon( icon_url );
								marker.data.iconpath = icon_url;

								// rewrite iconpath
								if ( cat_prev.length > 0 ) {
									for ( var cpi = 0; cpi < cat_prev.length; cpi++ ) {
										for ( var pmi = 0; pmi < this.prep_markers.length; pmi++ ) {
											if ( this.prep_markers[ pmi ].item.id === 'cat-' + cat_prev[ cpi ] ) {
												var pmchild = this.prep_markers[ pmi ].children;
												for ( var cpmi = 0; cpmi < pmchild.length; cpmi++ ) {
													if ( pmchild[ cpmi ].item.id === 'mar-' + cat_prev[ cpi ] + '-' + marker.data.id ) {
														pmchild[ cpmi ].item.icon = icon_url;
														break;
													}
												}
												break;
											}			
										}
									}
								}

							}
						}

						if ( mc_id === category.id ) {
							if ( this.prep_categories_id.indexOf( mc_id ) == -1 ) {
								this.prep_categories_id.push( mc_id );
								this.prep_categories.push( category );
								cat_prev.push( mc_id );
								this.prep_markers.push({
									item: {
										id: 'cat-' + mc_id,
										label: category.name,
										descrpition: category.description,
										checked: false,
										display: true,
										icon: category.iconpath,
									},
									children: [{
										item: {
											id: 'mar-' + mc_id + '-' + marker.data.id,
											label: marker.data.name,
											parent_label: category.name,
											marker: marker,
											checked: true,
											display: true,
											icon: icon_url
										}
									}]	
								});
								marker.data.cat_check += 1;
								marker.data.category_name += category.name + ', ';
								is_category_found = true;
							} else {
								for ( var pmi = 0; pmi < this.prep_markers.length; pmi++ ) {
									if ( this.prep_markers[ pmi ].item.id === 'cat-' + mc_id ) {
										cat_prev.push( mc_id );
										this.prep_markers[ pmi ].children.push({
											item: {
												id: 'mar-' + mc_id + '-' + marker.data.id,
												label: marker.data.name,
												parent_label: category.name,
												marker: marker,
												checked: true,
												display: true,
												icon: icon_url
											}
										});
										marker.data.cat_check += 1;
										marker.data.category_name += category.name + ', ';
										is_category_found = true;
										break;
									}
								}
							}
							break;
						}
					}
				}
			} 

			if ( icon_url === '' ) {
				icon_url = def_marker_icon;
				marker.setIcon( icon_url );
				marker.data.iconpath = icon_url;
				if ( cat_prev.length > 0 ) {
					for ( var cpi = 0; cpi < cat_prev.length; cpi++ ) {
						for ( var pmi = 0; pmi < this.prep_markers.length; pmi++ ) {
							if ( this.prep_markers[ pmi ].item.id === 'cat-' + cat_prev[ cpi ] ) {
								var pmchild = this.prep_markers[ pmi ].children;
								for ( var cpmi = 0; cpmi < pmchild.length; cpmi++ ) {
									if ( pmchild[ cpmi ].item.id === 'mar-' + cat_prev[ cpi ] + '-' + marker.data.id ) {
										pmchild[ cpmi ].item.icon = icon_url;
										break;
									}
								}
								break;
							}			
						}
					}
				}
			}

			if ( ! is_category_found ) {
				marker.data.category.push( '0' );
				if ( this.setting.uncategorized_marker_group ) {
					for ( var pmi = 0; pmi < this.prep_markers.length; pmi++ ) {
						if ( this.prep_markers[ pmi ].item.id === 'cat-0' ) {
							this.prep_markers[ pmi ].children.push( {
								item: {
									id: 'mar-' + '0' + '-' + marker.data.id,
									label: marker.data.name,
									parent_label: this.prep_markers[ pmi ].label,
									marker: marker,
									checked: true,
									display: true,
									icon: icon_url
								}
							});
							break;
						}
					}
				} else {
					this.prep_markers.push({
						item: {
							id: 'mar-' + '0' + '-' + marker.data.id,
							label: marker.data.name,
							parent_label: '',//this.prep_markers[ pmi ].label,
							marker: marker,
							checked: true,
							display: true,
							icon: icon_url
						}
					});
				}
				marker.data.cat_check += 1;
			}

			// trim first and last comma
			marker.data.category_name = marker.data.category_name.replace( /(^,)|(,$)/g, "" );

			marker.setMap( this.map );
			this.markers[ i ] = marker;
			if ( marker.getVisible() ) {
				this.markers_cluster[ i ] = marker;
			}

		}

		// Get first prep_markers (undefined_group) and push it to the end of prep_markers
		if ( this.setting.uncategorized_marker_group ) {
			var undefined_category = this.prep_markers.shift();
			if ( undefined_category.children.length > 0 ) {
				this.prep_markers.push( undefined_category );
			}
		}
	}

	TWGM.prototype.setMarkerCluster = function () {
		var marker_cluster = this.setting.marker_cluster;
		var max_zoom = !isNaN( Number( marker_cluster.max_zoom ) ) ? Number( marker_cluster.max_zoom ) : 0;
		var grid_size = !isNaN( Number( marker_cluster.grid ) ) ? Number( marker_cluster.grid ) : 0;
		if ( marker_cluster.cb ) {
			this.mc = new MarkerClusterer(
				this.map,
				this.markers_cluster,
				{
					maxZoom: max_zoom,
					gridSize: grid_size
				}
			);	
		}
	}


	TWGM.prototype.setMarkerTreeView = function () {
		var twgm = this;
		if ( twgm.setting.sidepanel.cb && twgm.setting.sidepanel.tabitem ) {
			if ( twgm.setting.sidepanel.tabitem.indexOf( 'marker' ) > -1 ) {
				$( this.element ).find( '#sp-marker-treeview-' + this.id ).markerCheckTree({
					data 				: this.prep_markers,
					onCheck 			: function( elm ) { twgm.callbackMarkerTreeOnCheck( elm ); },
					onUnCheck 			: function( elm ) { twgm.callbackMarkerTreeOnUnCheck( elm ); },
					onExpand 			: function( elm ) { twgm.callbackMarkerTreeOnExpand( elm ); },
					onCollapse 			: function( elm ) { twgm.callbackMarkerTreeOnCollapse( elm ); },
					onLabelClick 		: function( elm ) { twgm.callBackMarkerTreeOnLabelClick( elm ); },
					isUsingParentIcon 	: ( twgm.setting.sidepanel.mitv.indexOf( 'parent' ) > -1 ),
					isUsingChildIcon 	: ( twgm.setting.sidepanel.mitv.indexOf( 'child' ) > -1 ) 
				}, this );
				this.setScrollSPMarkerTab();
			}
		}
	}


	TWGM.prototype.setScrollSPMarkerTab = function () {
		$( this.element ).find('#sp-content-' + this.id + ' #tab-marker-' + this.id ).nanoScroller({
			preventPageScrolling: true,
			paneBackground: this.setting.sidepanel.scroll.pane,
		    sliderBackground: this.setting.sidepanel.scroll.slider,
		});
	}
	TWGM.prototype.setScrollSPDirectionsTab = function () {
		$( this.element ).find('#sp-content-' + this.id + ' #tab-directions-' + this.id ).nanoScroller({
			preventPageScrolling: true,
			paneBackground: this.setting.sidepanel.scroll.pane,
		    sliderBackground: this.setting.sidepanel.scroll.slider,
		});
	}
	TWGM.prototype.setScrollSPRouteTab = function () {
		$( this.element ).find('#sp-content-' + this.id + ' #tab-route-' + this.id ).nanoScroller({
			preventPageScrolling: true,
			paneBackground: this.setting.sidepanel.scroll.pane,
		    sliderBackground: this.setting.sidepanel.scroll.slider,
		});
	}
	TWGM.prototype.setScrollSPNearbyTab = function () {
		$( this.element ).find( '#sp-content-' + this.id + ' #tab-nearby-' + this.id ).nanoScroller({
			preventPageScrolling: true,
			paneBackground: this.setting.sidepanel.scroll.pane,
		    sliderBackground: this.setting.sidepanel.scroll.slider,
		});
		$( this.element ).find( '#sp-content-' + this.id + ' #tab-nearby-' + this.id ).trigger( 'update' );
	}
	TWGM.prototype.setScrollSPLayerTab = function () {
		$( this.element ).find('#sp-content-' + this.id + ' #tab-layer-' + this.id ).nanoScroller({
			preventPageScrolling: true,
			paneBackground: this.setting.sidepanel.scroll.pane,
		    sliderBackground: this.setting.sidepanel.scroll.slider,
		});
	}
	TWGM.prototype.setScrollSPSettingTab = function () {
		$( this.element ).find('#sp-content-' + this.id + ' #tab-map_setting-' + this.id ).nanoScroller({
			preventPageScrolling: true,
			paneBackground: this.setting.sidepanel.scroll.pane,
		    sliderBackground: this.setting.sidepanel.scroll.slider,
		});
	}
	
	TWGM.prototype.setScrollSP = function () {
		this.setScrollSPMarkerTab();
		this.setScrollSPDirectionsTab();
		this.setScrollSPRouteTab();
		this.setScrollSPNearbyTab();
		this.setScrollSPLayerTab();
		this.setScrollSPSettingTab();
	}

	TWGM.prototype.callbackMarkerTreeOnExpand = function () {
		this.setScrollSPMarkerTab();
	}

	TWGM.prototype.callbackMarkerTreeOnCollapse = function () {
		this.setScrollSPMarkerTab();
	}


	TWGM.prototype.callbackMarkerTreeOnCheck = function ( elm ) {
		id = ( $( elm ).attr( 'rel' ) ).split( '-' )[ 2 ];
		type = ( $( elm ).attr( 'rel' ) ).split( '-' )[ 0 ];
		if ( type === 'mar' ) {
			for ( i = 0; i < this.markers.length; i++ ) {
				if ( this.markers[ i ].data.id == id ) {
					this.markers[ i ].data.cat_check += 1;
					if( this.markers[ i ].data.cat_check === 1 ) {
						this.markers[ i ].setMap( this.map );
						if ( this.setting.marker_cluster.cb ) {
							this.mc.addMarker( this.markers[ i ] );
						}

						if ( this.markers[ i ].data.infobox && this.markers[ i ].data.infobox.isDisplay )
							this.markers[ i ].data.infobox.open( this.map, this.markers[ i ] );
						if ( this.markers[ i ].data.def_iw && this.markers[ i ].data.def_iw.isDisplay )
							this.markers[ i ].data.def_iw.open( this.map, this.markers[ i ] );
					}
					break;
				}
			}
		}
	}

	TWGM.prototype.callbackMarkerTreeOnUnCheck = function ( elm ) {
		id = ( $( elm ).attr( 'rel' ) ).split( '-' )[ 2 ];
		type = ( $( elm ).attr( 'rel' ) ).split( '-' )[ 0 ];
		if ( type === 'mar' ) {
			for ( i = 0; i < this.markers.length; i++ ) {
				if ( this.markers[ i ].data.id == id ) {
					this.markers[ i ].data.cat_check -= 1;
					if( this.markers[ i ].data.cat_check === 0 ) {
						this.markers[ i ].setMap( null );
						if ( this.setting.marker_cluster.cb ) {
							this.mc.removeMarker( this.markers[ i ] );	
						}

						if ( this.markers[ i ].data.infobox )
							this.markers[ i ].data.infobox.close();
						if ( this.markers[ i ].data.def_iw )
							this.markers[ i ].data.def_iw.close();
					}
					break;
				}
			}
		}
	}

	TWGM.prototype.callBackMarkerTreeOnLabelClick = function ( elm ) {
		var mrkId = ( $( elm ).attr( 'rel' ) ).split( '-' )[2];
		var mrkType = ( $( elm ).attr( 'rel' ) ).split( '-' )[0];
	 	if ( mrkType == 'mar' ) {
		 	for ( i = 0; i < this.markers.length; i++ ) {
		 		if ( this.markers[ i ].data.id == mrkId ) {
		 			this.map.panTo( this.markers[ i ].getPosition() );
		 			if ( this.setting.cos.on_click.indexOf( 'tab_panel' ) > -1 ) {
						this.cos_shape.setPosition( this.markers[i].getPosition() );
						this.cos_shape.setMap( this.map );
					}
					if ( this.setting.carousel.cb ) {
						this.setCarouselItemPosition( mrkId );
					}
					break;
		 		}
		 	}

		}
	}

	TWGM.prototype.setCOS = function ( ) {
		var cos 			= this.setting.cos;
		var fillcolor 		= cos.fill_color;
		var strokecolor 	= cos.stroke_color;
		var strokeweight 	= !isNaN( Number( cos.stroke_weight ) ) ? Number( cos.stroke_weight ) : 0;
		var radius 			= !isNaN( Number( cos.radius ) ) ? Number( cos.radius ) : 100;

		var cos_shape = new google.maps.Marker({
            //map: this.map,
            position: this.centerPosition,
            title: "circle",
            icon: {
              strokeColor: strokecolor,
              strokeOpacity: 1.0,
              strokeWeight: strokeweight,
              fillColor: fillcolor,
              fillOpacity: 1.0,
              path: google.maps.SymbolPath.CIRCLE,
              scale: radius,
              anchor: new google.maps.Point(0, 0),
              //zIndex: -99999999999
            },
            clickable: false,
            //optimized: false,
			zIndex: -99999
        });
		//return cos_shape;
		this.cos_shape = cos_shape;
	}

	TWGM.prototype.setCOSPosition = function( position ) {
		this.cos_shape.setPosition( position );
		this.cos_shape.setMap( this.map );
	}


	TWGM.prototype.callbackShapeTreeOnCheck = function ( elm ) {
		id = ( $( elm ).attr( 'rel' ) );
		for ( var i = 0; i < this.prep_shapes.length; i++ ) {
			if ( this.prep_shapes[ i ].children.length > 0 ) {
				for ( var j = 0; j < this.prep_shapes[ i ].children.length; j++ ) {
					if ( id === this.prep_shapes[i].children[j].item.id ) {
						this.prep_shapes[i].children[j].item.shape.setMap( this.map );
					}
				}
			}
		}
	}
	TWGM.prototype.callbackShapeTreeOnUnCheck = function ( elm ) {
		id = ( $( elm ).attr( 'rel' ) );
		for ( var i = 0; i < this.prep_shapes.length; i++ ) {
			if ( this.prep_shapes[ i ].children.length > 0 ) {
				for ( var j = 0; j < this.prep_shapes[ i ].children.length; j++ ) {
					if ( id === this.prep_shapes[i].children[j].item.id ) {
						this.prep_shapes[i].children[j].item.shape.setMap( null );
					}
				}
			}
		}
	}
	TWGM.prototype.callbackShapeTreeOnExpand = function () {
		this.setScrollSPLayerTab();
	}
	TWGM.prototype.callbackShapeTreeOnCollapse = function () {
		this.setScrollSPLayerTab();
	}
	TWGM.prototype.callbackShapeTreeOnLabelClick = function ( elm ) {
		id = ( $( elm ).attr( 'rel' ) );
		for ( var i = 0; i < this.prep_shapes.length; i++ ) {
			if ( this.prep_shapes[ i ].children.length > 0 ) {
				for ( var j = 0; j < this.prep_shapes[ i ].children.length; j++ ) {
					if ( id === this.prep_shapes[i].children[j].item.id ) {
						var type = this.prep_shapes[ i ].children[ j ].item.shape.type;
						if ( type === 'marker' ) {
							this.map.setCenter( this.prep_shapes[i].children[j].item.shape.getPosition() );
						} else if ( type === 'circle' || type === 'rectangle' ) {
							this.map.setCenter( this.prep_shapes[i].children[j].item.shape.getBounds().getCenter() );
						} else {
							this.map.setCenter( this.prep_shapes[i].children[j].item.bounds.getCenter() );
						}
					}
				}
			}
		}
	}


	TWGM.prototype.setRoute = function () {
		var twgm = this;
		var routes = this.route;
		this.prep_routes = [];
		var icoArrowExpanded 		= '&#xf123';
		var icoArrowCollapsed 		= '&#xf124';

		var def_travelmode = [ 'DRIVING', 'WALKING', 'TRANSIT', 'BICYCLING' ];
		var def_unitsystem = [ 'METRIC', 'IMPERIAL' ];

		var tab_route = $( this.element ).find( '#tab-route-' + twgm.id );

		$( routes ).each( function () {
			var route = this;
			var ds = new google.maps.DirectionsService;
			var dd = new google.maps.DirectionsRenderer;
			var setting = JSON.parse( route.setting );
			var stroke_color 	= setting.stroke.color;
			var stroke_weight 	= Number( setting.stroke.weight );
			var waypoints = [];

			if ( setting.usingwaypoint ) {
				for ( var i = 0; i < route.waypoints.length; i++ ) {
					var wp_id = route.waypoints[ i ];
					for ( var j = 0; j < route.result_waypoints.length; j++ ) {
						var rwp = route.result_waypoints[ j ];
						if ( rwp.id === wp_id ) {
							var stopover = ( route.stopover.indexOf( wp_id ) > -1 );
							waypoints.push({
								location: new google.maps.LatLng( rwp.lat, rwp.lng ),
								stopover: stopover
							});
							break;
						}	
					}
				}
			}

			var strokeStyle =  
					'background: ' + stroke_color + ';' + 
                    'height: 7px;' + 
                    'width: 20px;' + 
                    'background-repeat: no-repeat;' + 
                    'float: left; ' + 
                    'margin-left: 5px;' + 
                    'margin-right: 5px;' + 
                    'margin-top: 7px;' +
                    'border-radius: 4px;' + 
                    'box-shadow: 1px 1px 1px rgba(0, 0, 0, 0.2);' ;

			tab_route.find( '.route-list .checktree' ).append( 
				'<li id="route-' + route.id + '">'+
					'<div class="twgm-arrow collapsed" style="display:none;">'+icoArrowCollapsed+'</div>'+
		            '<div class="twgm-checkbox checked">&#xf373</div>' +
		            '<div class="route-stroke" style="' + strokeStyle + '"></div>' + 
		            '<label style="" class="marker-label">' + 
		                route.name + 
		            '</label>' +
		            '<div id="route-step-'+route.id+'" style="display:none;"></div>' +
		        '</li>'
			);

			dd.setMap( twgm.map );
			dd.setOptions({
				draggable: ( setting.draggable ),
				polylineOptions: {
					strokeColor: setting.stroke.color,
					strokeWeight: !isNaN( stroke_weight ) ? stroke_weight : 1,
				},
				preserveViewport: true
			});

			var sp_lat = ( route.splat ) ? route.splat : 0;
			var sp_lng = ( route.splng ) ? route.splng : 0;
			var ep_lat = ( route.eplat ) ? route.eplat : 0;
			var ep_lng = ( route.eplng ) ? route.eplng : 0;

			var travel_mode = ( setting.travelmode && def_travelmode.indexOf( setting.travelmode ) > -1 ) ? setting.travelmode : 'DRIVING';
			var unit_system = ( setting.unitsystem && def_travelmode.indexOf( setting.unitsystem) > -1 ) ? setting.unitsystem : 'METRIC';

			dd.setPanel( tab_route.find( '#route-step-' + route.id )[0] );
			
			ds.route({
				origin: new google.maps.LatLng( sp_lat, sp_lng ),
				destination: new google.maps.LatLng( ep_lat, ep_lng ),
				waypoints: waypoints,
				travelMode: google.maps.TravelMode[ travel_mode ],
				unitSystem: google.maps.UnitSystem[ unit_system ]
			}, function ( response, status ) {
				if ( status === google.maps.DirectionsStatus.OK ) {
					dd.setDirections( response );
					tab_route.find( '#route-' + route.id + ' .twgm-arrow' ).show();
				} else {
					window.alert( route.name + ' : Directions request failed due to ' + status );
				}
			});

			tab_route.find( '#route-' + route.id + ' .twgm-arrow' ).on( 'click', function() {
				if ( $( this ).hasClass( 'collapsed' ) ) {
					$( this ).parent().find( '#route-step-' + route.id ).show();
					$( this ).removeClass( 'collapsed' ).addClass( 'expanded' ).html( icoArrowExpanded );
					twgm.setScrollSPRouteTab();
				} else {
					$( this ).parent().find( '#route-step-' + route.id ).hide();
					$( this ).removeClass( 'expanded' ).addClass( 'collapsed' ).html( icoArrowCollapsed );
					twgm.setScrollSPRouteTab();
				}
			});

			twgm.prep_routes.push({
				id: route.id,
				dd: dd,
				ds: ds
			});
			
		});

		this.setScrollSPRouteTab();

		tab_route.find( '.route-list' ).on( 'click', '.twgm-checkbox', function() {
			var route_id = $( this ).parent().attr( 'id' );
			for ( var i = 0; i < twgm.prep_routes.length; i++ ) {
				if ( ( 'route-' + twgm.prep_routes[ i ].id ) === route_id ) {
					if ( $(this).hasClass( 'checked' ) ) {
						twgm.prep_routes[i].dd.setMap( null );
						$(this).removeClass( 'checked' ).html( '&#xf372' );
					} else {
						twgm.prep_routes[i].dd.setMap( twgm.map );
						$( this ).addClass( 'checked' ).html( '&#xf373' );
					}	
				}
			}
		});

		tab_route.bind('DOMNodeInserted DOMNodeRemoved', function(event) {
		    if ( event.type == 'DOMNodeInserted' ) {
		    	tab_route.trigger( 'mouseleave' );
		    	twgm.setScrollSPRouteTab();
		    } else {
		        // alert('Content removed! Current content:' + '\n\n' + this.innerHTML);
		    }
		});
	}

	TWGM.prototype.setAllListener = function () {

	}




	/*
	----------------- External Function ---------------------
		All functions below this line are external function.
	---------------------------------------------------------
	*/

	$.fn.stars = function() {
	    return $(this).each(function() {
	        // Get the value
	        var val = parseFloat($(this).html());
	        // Make sure that the value is in 0 - 5 range, multiply to get width
	        var size = Math.max(0, (Math.min(5, val))) * 7;
	        // Create stars holder
	        var $span = $('<span />').width(size);
	        // Replace the numerical value with stars
	        $(this).html($span);
	    });
	}

	function TWGM_GetDistanceKM( lat1, lon1, lat2, lon2 ) {
		// Radius of earth in mil -> var R = 3959; 
	  	var R = 6371; // Radius of the earth in km
	  	var dLat = deg2rad( lat2 - lat1 );  // deg2rad below
	  	var dLon = deg2rad( lon2 - lon1 ); 
	  	var a = 
	    	Math.sin( dLat / 2 ) * Math.sin(dLat/2) +
	    	Math.cos( deg2rad( lat1 ) ) * Math.cos( deg2rad( lat2 ) ) * 
	    	Math.sin( dLon /2 ) * Math.sin( dLon / 2 ); 
	  	var c = 2 * Math.atan2( Math.sqrt( a ), Math.sqrt( 1 - a ) ); 
	  	var d = R * c; // Distance in km
	  	return d;
	}

	function deg2rad ( deg ) {
	  return deg * ( Math.PI / 180 )
	}

	function TWGM_ReplaceInfo ( html, marker ) {
		pattern = /\{(.*?)\}/g;
		var matches = [];
		var match;
		var ef_key = '';
		while ( ( match = pattern.exec( html ) ) != null ) {
		  matches.push(match);
		}
		if ( matches ) {
			for ( var i = 0; i < matches.length; i++ ) {
				if ( matches[ i ][1].startsWith('ef:') ) {
					ef_key = matches[ i ][1].split( ':' )[1];				
					if ( marker.data.extrafield[ ef_key ] ) {
						html = html.replace( matches[ i ][0], marker.data.extrafield[ ef_key ] );
					} else {
						html = html.replace( matches[ i ][0], '' );
					}
				} else {
					if ( marker.data[ matches[ i ][1] ] ) {
						html = html.replace( matches[ i ][0], marker.data[ matches[ i ][1] ] );	
					} else {
						html = html.replace( matches[ i ][0], '' );	
					}
				}
			}
		}
		return html;
	}


	$.fn.TWGM_VAlign = function () {
		return this.each( function ( i ) {
			var h = $( this ).height();
			var oh = $( this ).outerHeight();
			var mt = ( h + ( oh - h ) ) / 2;	
			$( this ).css( "margin-top", "-" + mt + "px" );	
			$( this ).css( "top", "50%" );
		});	
	};

	$.fn.TWGM_ToggleClick = function () {
		var functions = arguments;
		return this.click( function () {
			var iteration = $( this ).data( 'iteration' ) || 0;
			functions[ iteration ].apply( this, arguments );
			iteration = ( iteration + 1 ) % functions.length ;
			$( this ).data( 'iteration', iteration );
		});
	};

	function TWGM_GetGooglePosition ( position ){
		switch ( position ) {
			case 'BOTTOM_CENTER':
				return google.maps.ControlPosition.BOTTOM_CENTER;
			case 'BOTTOM_LEFT':
				return google.maps.ControlPosition.BOTTOM_LEFT;
			case 'BOTTOM_RIGHT':
				return google.maps.ControlPosition.BOTTOM_RIGHT;
			case 'LEFT_BOTTOM':
				return google.maps.ControlPosition.LEFT_BOTTOM;
			case 'LEFT_CENTER':
				return google.maps.ControlPosition.LEFT_CENTER;
			case 'LEFT_TOP':
				return google.maps.ControlPosition.LEFT_TOP;
			case 'RIGHT_BOTTOM':
				return google.maps.ControlPosition.RIGHT_BOTTOM;
			case 'RIGHT_CENTER':
				return google.maps.ControlPosition.RIGHT_CENTER;
			case 'RIGHT_TOP':
				return google.maps.ControlPosition.RIGHT_TOP;
			case 'TOP_CENTER':
				return google.maps.ControlPosition.TOP_CENTER;
			case 'TOP_LEFT':
				return google.maps.ControlPosition.TOP_LEFT;
			case 'TOP_RIGHT':
				return google.maps.ControlPosition.TOP_RIGHT;
		}
	}

	/* 
	JS Module	: DOOGAL - Custom Google Maps FullScreen Control
	Author 		: Doogal
	Web			: http://www.doogal.co.uk/FullScreen.php
	<reference path="../typings/google.maps.d.ts" />
	*/
	
	function TWGM_GetButtonIcon( text, className ) {
		"use strict";
		var controlDiv = document.createElement( "div" );
		controlDiv.className 		= className;
		controlDiv.index 			= 1;
		controlDiv.style.padding 	= "10px";

		// set CSS for the control border.
		var controlUi = document.createElement( "div" );
		controlUi.style.backgroundColor = 'rgb( 255, 255, 255 )';
		controlUi.style.color 			= '#565656';
		controlUi.style.cursor 			= 'pointer';
		controlUi.style.textAlign 		= 'center';
		controlUi.style.boxShadow 		= 'rgba( 0, 0, 0, 0.3 ) 0px 1px 4px -1px';
		controlUi.style.borderRadius 	= '2px';
		
		// set CSS for the control interior.
		var controlText = document.createElement( "div" );
		controlText.className = 'ionicons';
		controlText.style.fontSize 		= '18px';
		controlText.style.lineHeight 	= '30px';
		controlText.style.width 		= '30px';
		controlText.style.height 		= '30px';
		controlText.innerHTML 			= text;
		
		controlDiv.appendChild(controlUi);
		controlUi.appendChild(controlText);

		$( controlUi ).on( "mouseenter", function () {
			controlUi.style.backgroundColor = "rgb( 235, 235, 235 )";
			controlUi.style.color = "#000";
		});
		$( controlUi ).on( "mouseleave", function () {
			controlUi.style.backgroundColor = "rgb( 255, 255, 255 )";
			controlUi.style.color = "#565656";
		});
		return controlDiv;
	}

	function TWGM_AddCircle ( location, map, fillcolor ) {      
  		var circleOverlay = new google.maps.Circle({      
	      	strokeColor: '#FFFFFF', 
	      	strokeOpacity: 1,
	      	strokeWeight: 2, 
	      	fillColor: ( fillcolor ) ? fillcolor : '#FFFFFF', 
	      	fillOpacity: 1,
	      	map: map,
	      	center: location,
	      	radius: 1000,
	      	draggable: false
    	});    
    	return circleOverlay;
	}   
	
	function TWGM_FullScreenControl( map, zindex, enterText, exitText, goFullscreenCallback, exitFullscreenCallback ) {
		"use strict";
		if ( enterText === void 0 ) enterText = null;
		if ( exitText === void 0 ) exitText = null; 
		if ( enterText == null ) enterText = "Fullscreen";
		if ( exitText == null ) exitText = "Exit Fullscreen";
		
		var interval;
		var controlDiv 	= TWGM_GetButtonIcon( enterText, "fullscreen" );
		var fullScreen 	= false;
		var mapDiv 		= map.getDiv();
		var mapId 		= mapDiv.id.split( '-' )[1];
		var divStyle 	= mapDiv.style;
		if ( mapDiv.runtimeStyle ) {
			divStyle 	= mapDiv.runtimeStyle;
		}
		var originalPos 	= divStyle.position;
		var originalWidth 	= divStyle.width;
		var originalHeight 	= divStyle.height;
		
		// ie8 hack
		if ( originalWidth === "" ) {
			originalWidth = mapDiv.style.width;
		}
		if ( originalHeight === "" ) {
			originalHeight = mapDiv.style.height;
		}
		var originalTop 	= divStyle.top;
		var originalLeft 	= divStyle.left;
		var originalZIndex 	= divStyle.zIndex;
		var bodyStyle = document.body.style;
		if ( document.body.runtimeStyle ) {
			bodyStyle = document.body.runtimeStyle;
		}
		var originalOverflow = bodyStyle.overflow;

		controlDiv.goFullScreen = function () {	

			var center = map.getCenter();
			mapDiv.style.position 	= "fixed";
			mapDiv.style.width 		= "100%";
			mapDiv.style.height 	= "100%";
			mapDiv.style.top 		= "0";
			mapDiv.style.left 		= "0";
			mapDiv.style.zIndex 	= zindex;

			$( mapDiv ).parentsUntil( 'body' ).each( function () {
				$( this ).css({
					'-webkit-transform' : 'unset',
					'-moz-transform' : 'unset', 
					'-ms-transform' : 'unset',
					'-o-transform' : 'unset', 
					'transform' : 'unset',
					'z-index' : zindex
				});
			});

			document.body.style.overflow = "hidden";
			$( controlDiv ).find( "div div" ).html( exitText );
			fullScreen = true;
			google.maps.event.trigger( map, "resize" );
			map.setCenter( center );

			// this works around street view causing the map to disappear, which is caused by Google Maps setting the 
			// css position back to relative. There is no event triggered when Street View is shown hence the use of setInterval
			interval = setInterval( function () {
				if ( mapDiv.style.position !== "fixed" ) {
					mapDiv.style.position = "fixed";
					google.maps.event.trigger( map, "resize" );
				}
				if ( goFullscreenCallback ) {
					goFullscreenCallback();	
				}
				$( '.pac-container' ).css({'z-index' : zindex});
			}, 100 );

			if ( goFullscreenCallback ) {
				goFullscreenCallback();
			}
		};

		controlDiv.exitFullScreen = function () {

			var center = map.getCenter();
			
			$( mapDiv ).parentsUntil( 'body' ).each( function () {
				$( this ).css({
					'-webkit-transform' : '',
					'-moz-transform' : '', 
					'-ms-transform' : '',
					'-o-transform' : '', 
					'transform' : '',
					'z-index' : '',
				});
			});

			if ( originalPos === "" ) {
				mapDiv.style.position = "relative";
			}
			else {
				mapDiv.style.position = originalPos;
			}
			mapDiv.style.width 		= originalWidth;
			mapDiv.style.height 	= originalHeight;
			mapDiv.style.top 		= originalTop;
			mapDiv.style.left 		= originalLeft;
			mapDiv.style.zIndex 	= originalZIndex;

			document.body.style.overflow = originalOverflow;
			$( controlDiv ).find( "div div" ).html( enterText );
			fullScreen = false;
			google.maps.event.trigger( map, "resize" );
			map.setCenter( center );
			clearInterval( interval );

			if ( exitFullscreenCallback ) {
				exitFullscreenCallback();
			}
		};

		// setup the click event listener
		google.maps.event.addDomListener( controlDiv, "click", function () {
			if ( ! fullScreen ) {
				controlDiv.goFullScreen();
			}
			else {
				controlDiv.exitFullScreen();
			}
		});
		return controlDiv;
	}

})( jQuery, window, document );