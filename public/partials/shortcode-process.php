<?php
	
	// Language
	$st_language = isset( $map_setting['language'] ) ? $map_setting['language'] : '';
	$this->enqueue_gmaps( $st_language );
	$this->enqueue_external_font();
	$this->enqueue_elementquery();
	$this->enqueue_tabs();
	$this->enqueue_infobox();
	$this->enqueue_markerclusterer();
	$this->enqueue_markertreeview();
	$this->enqueue_lighterbox();
	$this->enqueue_nanoscroll();
	$this->enqueue_nouislider();
	$this->enqueue_jcarousel();
	$this->enqueue_gridlist();
	$this->enqueue_front();

	// Custom Style
	$style 	= $map_setting['sidepanel']['color'];
	$id 	= $atts['id'];
    $css = "
        #sp-" . $id . " .twgm-sp-content .tree-list .twgm-checkbox {
    		color: " . $style['checkbox'] . ";
		}

		#sp-" . $id . " .checktree li > ul > li {
			border-left: 1px dashed " . $style['border'] . ";
		}

		#sp-" . $id . " .checktree > li {
			border-bottom: 1px solid " . $style['gap'] . ";
		}

    ";
    $this->inject_style( $css );

	require plugin_dir_path( dirname( __FILE__ ) ) . 'partials/shortcode-display.php';
	
?>