/**
 *name: jquery.highCheckTree
 *author: yan, xuekai
 *version: 0.2.1
*/

( function ( $ ) {
	jQuery.fn.markerCheckTree = function ( settings, twgm ) {
		$settings = $.extend({
			data				: [],
			onExpand 			: null,
			onCollapse 			: null,
			onPreCheck 			: null,
			onCheck 			: null,
			onUnCheck 			: null,
			onLabelClick 		: null,
			onLabelHoverOver 	: null,
			onLabelHoverOut 	: null,
			isDisplayParent 	: false,
			isUsingGroup 		: true,
			isUsingParentIcon 	: false,
			isUsingChildIcon 	: false,
		}, settings );
		
		var container 	= $( this );
		var $tree 		= this;
		var icoArrowExpanded 		= '&#xf123';
		var icoArrowCollapsed 		= '&#xf124';
		var icoCheck 				= '&#xf373';
		var icoUnCheck 				= '&#xf372';
		var icoHalfCheck 			= '&#xf371';

		function getChildrenHTML ( treesdata, parent = null ) {
			var result 				= '';
			var dataLen 			= treesdata.length;
			var checkedClass 		= '';
			var checkedChildren;
			var node;
			var childLen;
			var arrowClass;
			var checkboxIcon 		= '';
			var totalChecked 		= 0;
			var totalDisplay 		= 0;

			for ( var i = 0; i < dataLen; i++ ) {
				node 		= treesdata[ i ];
				childLen 	= node.children ? node.children.length : 0;
				arrowClass 	= 'collapsed';
				$.data( $tree, node.item.id, node );
				if ( childLen === 0 ) {
					arrowClass 		= 'nochildren';
					checkedClass 	= node.item.checked ? 'checked' : ''; 
				} else {
					var checkedChildren = $.grep( node.children, function ( el ) {
						return el.item.checked;
					});
					checkedClass = checkedChildren.length === 0 ? '' : checkedChildren.length === childLen ? 'checked' : 'half_checked';
				}
				checkboxIcon = checkedClass === 'checked' ? icoCheck : icoUnCheck;
				var iconStyle 	= 
					'background: url(' + node.item.icon + ');' +
                    'background-position: 50% 50%;' + 
                    'background-size: auto 20px;' + 
                    'height: 20px;' + 
                    'width: 20px;' + 
                    'background-repeat: no-repeat;' + 
                    'float: left; ' + 
                    'margin-right: 5px;';
                var markerIcon 	= '';
                if ( ( settings.isUsingParentIcon ) && node.item.id.startsWith( 'cat' ) ) {
                	markerIcon = '<div style="' + iconStyle + '"></div>';
                }
                if ( ( settings.isUsingChildIcon ) && node.item.id.startsWith( 'mar' ) ) {
                	markerIcon = '<div style="' + iconStyle + '"></div>';
                }
                if ( node.item.display ) {
                	totalDisplay++;
                	
                	// add checked item total
                	if ( node.item.checked ) {
                		totalChecked++;
                	}
                	if ( settings.isDisplayParent ) {
                        var parent = '';
                        parent = 
                            '<li>' +
                                '<label style="font-size: 14px;font-weight:bold;">' + 
                                    node.item.parent_label + 
                                '</label>' +
                            '</li>';
                        result +=  
                            parent + 
                            '<li rel="' + node.item.id + '">' +
                                '<div class="twgm-checkbox ' + checkedClass + '"></div>' + 
                                markerIcon + 
                                '<label style="" class="">' + 
                                    node.item.label + 
                                '</label>' + 
                            '</li>' ;
                    } else {
                        result += 
                            '<li rel="' + node.item.id + '">'+
                                '<div class="twgm-arrow ' + arrowClass + '"></div>' +
                                '<div class="twgm-checkbox ' + checkedClass + '">' + checkboxIcon + '</div>' + 
                                markerIcon + 
                                '<div class="marker-label">' + 
                                    node.item.label + 
                                '</div>'+
                            '</li>';
                    } 
                }
			}
			
			if ( parent ) {
				if ( totalChecked <= 0 ) {
					parent.find( '.twgm-checkbox' ).
						removeClass( 'checked half_checked' ).
						html( icoUnCheck );
				} else if ( totalChecked > 0 && totalChecked < totalDisplay ) {
					parent.find( '.twgm-checkbox' ).
						removeClass( 'checked half_checked' ).
						addClass( 'half_checked' ).
						html( icoHalfCheck );
				} else {
					parent.find( '.twgm-checkbox' ).
						removeClass( 'checked half_checked' ).
						addClass( 'checked' ).
						html( icoCheck );
				}
			}

			return result;
		}

		function updateChildrenNodes ( $li, data, isExpanded ) {
			if ( data.children && data.children.length > 0 ) {
				var innerHTML = isExpanded ? '<ul>' : '<ul style="display:none;">';
				innerHTML += getChildrenHTML( data.children, $li ) + '</ul>';
				$li.append( innerHTML );
			}
			$li.addClass( 'sp-treeview-updated' );
		}

		( function initialCheckTree() {
			var treesHTML = '<ul class="checktree">';
			treesHTML += getChildrenHTML( settings.data );
			// initial parent element
			container.empty().append( treesHTML + '</ul>' );
			// initial child element
			container.find( '.checktree > li' ).each( function () {
				if ( ! $(this).attr('rel').startsWith( 'mar' ) ) {
					$( this ).find( '.twgm-arrow' ).removeClass( 'collapsed' ).addClass( 'expanded' ).html( icoArrowExpanded );
					updateChildrenNodes( $( this ), $.data( $tree, $( this ).attr( 'rel' ) ), true );
				}
			});
		})();

		// Bind selectchange to checkbox
		container.off( 'selectchange', '.twgm-checkbox' ).on( 'selectchange', '.twgm-checkbox', function () {
			if ( settings.onPreCheck ) {
				if ( ! settings.onPreCheck( $( this ).parent() ) ) {
					return;
				}
			}
			var $li 			= $( this ).parent();
			var dataSource 		= $.data( $tree, $li.attr( 'rel' ) );
			var $all 			= $( this ).siblings( 'ul' ).find( '.twgm-checkbox' );
			var $checked 		= $all.filter( '.checked' );
			// all children are checked
			if ( $all.length === $checked.length ) {
				$( this ).removeClass( 'half_checked' ).addClass( 'checked' ).html( icoCheck );
				dataSource.item.checked = true;
				if ( settings.onCheck ) {
					settings.onCheck( $li );
				}
			// all children are unchecked
			} else if ( $checked.length === 0 ) {
				dataSource.item.checked = false;
				$( this ).removeClass( 'checked' ).removeClass( 'half_checked' ).html( icoUnCheck );
				if ( settings.onUnCheck ) {
					settings.onUnCheck( $li );
				}
			// some children are checked
			} else {
				dataSource.item.checked = false;
				$( this ).removeClass( 'checked' ).addClass( 'half_checked' ).html( icoHalfCheck );
				if ( settings.onHalfCheck && ! $( this ).hasClass( 'half_checked' ) ) {
					settings.onHalfCheck( $li );
				}
			}
		});

		// Expand and Collapse Node
		container.off( 'click', '.twgm-arrow' ).on( 'click', '.twgm-arrow', function () {
			if ( $( this ).hasClass( 'nochildren' ) ) {
				return;
			}
			var $li = $( this ).parent();
			if ( ! $li.hasClass( 'sp-treeview-updated' ) ) {
				updateChildrenNodes( $li, $.data( $tree, $li.attr( 'rel' ) ), true );
				$( this ).removeClass( 'collapsed' ).addClass( 'expanded' );
				if ( settings.onExpand ) {
					settings.onExpand( $li );
				}
			} else {
				$ ( this ).siblings( 'ul' ).toggle();
				if ( $( this ).hasClass( 'collapsed' ) ) {
					$( this ).removeClass( 'collapsed' ).addClass( 'expanded' ).html( icoArrowExpanded );
					if ( settings.onExpand ) {
						settings.onExpand( $li );
					}
				} else {
					$( this ).removeClass( 'expanded' ).addClass( 'collapsed' ).html( icoArrowCollapsed );
					if ( settings.onCollapse ) { 
						settings.onCollapse( $li );
					}
				}
			}
		});

		// Check and Uncheck Node
		container.off( 'click', '.twgm-checkbox' ).on( 'click', '.twgm-checkbox', function () {
			var $li 		= $( this ).parent();
			var dataSource 	= $.data( $tree, $li.attr( 'rel' ) );
			if ( ! $li.hasClass( 'sp-treeview-updated' ) ) {
				updateChildrenNodes( $li, dataSource, false );
			}
			if ( settings.onPreCheck ) {
				if ( ! settings.onPreCheck( $li ) ) {
					return;
				}
			}
			$( this ).removeClass( 'half_checked' ).toggleClass( 'checked' );
			if ( $( this ).hasClass( 'checked' ) ) {
				$( this ).html( icoCheck );
				dataSource.item.checked = true;
				if ( settings.onCheck ) {
					settings.onCheck( $li );
				}
				// Find all uncheckd children and check it
				$( this ).siblings( 'ul' ).find( '.twgm-checkbox' ).not( '.checked' ).removeClass( 'half_checked' ).addClass( 'checked' ).html( icoCheck ).each( function () {
					var $subli = $( this ).parent();
					$.data( $tree, $subli.attr( 'rel' ) ).item.checked = true;
					if ( settings.onCheck ) {
						settings.onCheck( $subli );
					}
				});
			} else {
				$( this ).html( icoUnCheck );
				dataSource.item.checked = false;
				if ( settings.onUnCheck ) {
					settings.onUnCheck( $li );
				}
				// Find all checked children and uncheck it
				$( this ).siblings( 'ul' ).find( '.twgm-checkbox' ).filter( '.checked' ).removeClass( 'half_checked' ).removeClass( 'checked' ).html( icoUnCheck ).each( function () {
					var $subli = $( this ).parent();
					$.data( $tree, $subli.attr( 'rel' ) ).item.checked = false;
					if ( settings.onUnCheck ) {
						settings.onUnCheck( $subli );
					}
				});
			}
			$( this ).parents( 'ul' ).siblings( '.twgm-checkbox' ).trigger( 'selectchange' );
		});

		// Label click listener
		container.off( 'click', '.marker-label' ).on( 'click', '.marker-label', function () {
			if ( settings.onLabelClick ) settings.onLabelClick( $( this ).parent() );
		});

		container.off( 'mouseenter', '.marker-label' ).on( 'mouseenter', '.marker-label', function() {
            $( this ).addClass( "sp-hover-marker" );
            if ( settings.onLabelHoverOver ) settings.onLabelHoverOver( $( this ).parent() );
        } );

        container.off( 'mouseleave', '.marker-label' ).on( 'mouseleave', '.marker-label', function() {
            $( this ).removeClass( "sp-hover-marker" );
            if ( settings.onLabelHoverOut ) settings.onLabelHoverOut( $( this ).parent() );
        });
	};
})(jQuery);