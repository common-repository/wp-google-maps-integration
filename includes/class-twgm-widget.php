<?php
/**
 * TWGM Widget Class
 *
 * @since 0.1
 */
class TWGM_Widget extends WP_Widget {

	public function __construct () {
		$widget_ops = array( 
			'classname' 	=> 'shortcode_widget', 
			'description' 	=> __('Shortcode or HTML or Plain Text.', 'twgm' ) 
		);
		$control_ops = array( 
			'width' => 400, 
			'height' => 350
		);
		parent::__construct( 
			'twgm_widget', 
			__('TWGM Widget', 'twgm'), 
			$widget_ops, 
			$control_ops
		);
	}

	/**
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		/** This filter is documented in wp-includes/default-widgets.php */
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		
		/**
		 * Filter the content of the Text widget.
		 *
		 * @param string    $widget_text The widget content.
		 * @param WP_Widget $instance    WP_Widget instance.
		 */
		
		$text = do_shortcode( apply_filters( 'widget_text', empty( $instance['map'] ) ? '' : "[twgm id='" . absint( $instance['map'] ) . "']", $instance ) );
		
		echo $args['before_widget'];
		if ( ! empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		} ?>
			<div class="textwidget"><?php echo $text; ?></div>
		<?php
		echo $args['after_widget'];
	}

	/**
	 * @param array $new_instance
	 * @param array $old_instance
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		
		if ( current_user_can('unfiltered_html') ) {
			$instance['map'] = $new_instance['map'];
		}
		else {
			$instance['map'] = absint( $new_instance['map'] );
		}
		
		return $instance;
	}

	/**
	 * @param array $instance
	 */
	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'map' => '' ) );
		$title = strip_tags( $instance['title'] );
		$map_id = absint( $instance['map'] );
		?>
		
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', 'twgm' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" 
				name="<?php echo $this->get_field_name('title'); ?>" type="text" 
				value="<?php echo esc_attr($title); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('map'); ?>"><?php _e( 'Map:' ); ?></label>
			<select class="widefat" id="<?php echo $this->get_field_id('map'); ?>" 
				name="<?php echo $this->get_field_name('map'); ?>"><?php echo $text; ?>
				<?php
					global $wpdb;
					$table_map = $wpdb->prefix . 'twgm_map';
					$maps = $wpdb->get_results( "SELECT id,name FROM $table_map order by id", ARRAY_A );
					foreach( $maps as $map ) {
						$selected = ( $map_id === absint( $map['id'] ) ) ? 'selected' : '';
						?>	
							<option value="<?php echo absint( $map['id'] ) ?>" <?php echo $selected ?>><?php echo $map['name'] . ' - ' . "[twgm id='" . absint( $map['id'] ) . "']" ?></option> 
						<?php
					}
				?>
			</select>
		</p>
		
		<?php
	
	}
}
