<?php
/**
 * Class for adding Reusable Block Widget
 *
 * @package AddonsPress
 * @subpackage Gutentor
 * @since 2.0.3
 */
if ( ! class_exists( 'Gutentor_WP_Block_Widget' ) ) {

	class Gutentor_WP_Block_Widget extends WP_Widget {
		/*defaults values for fields*/
		private $defaults = array(
			'title'       => '',
			'wp_block_id' => '',
		);

		function __construct() {
			parent::__construct(
			/*Base ID of your widget*/
				'gutentor_wp_block_widget',
				/*Widget name will appear in UI*/
				esc_html__( 'Addons Gutentor Block', 'gutentor' ),
				/*Widget description*/
				array(
					'description' => esc_html__( 'Feel free to add Gutenberg Block on the Widgets', 'gutentor' ),
				)
			);
			/*Add Scripts*/
			add_action( 'wp_enqueue_scripts', array( $this, 'scripts' ) );
		}

		/*Widget Backend*/
		public function form( $instance ) {
			$instance = wp_parse_args( (array) $instance, $this->defaults );
			/*default values*/
			$title       = esc_attr( $instance['title'] );
			$wp_block_id = absint( $instance['wp_block_id'] );

			printf(
				'<h3><a href="%1$s" target="_blank">%2$s</a></h3>',
				admin_url( 'edit.php?post_type=wp_block' ),
				__( 'Go to here to add Block', 'gutentor' )
			);
			?>
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title (Optional)', 'gutentor' ); ?>:</label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
			</p>
			<?php
			$item_arg   = array(
				'post_type' => 'wp_block',
				'order'     => 'DESC',
			);
			$item_query = new WP_Query( $item_arg );
			if ( $item_query->have_posts() ) :
				printf(
					'<p><label for="%1$s">%2$s</label><br/><small>%4$s</small>' .
					'<select class="widefat" id="%1$s" name="%3$s">',
					$this->get_field_id( 'wp_block_id' ),
					__( 'Select Block:', 'gutentor' ),
					$this->get_field_name( 'wp_block_id' ),
					esc_html__( 'Select block and its content will display in the frontend.', 'gutentor' )
				);
				printf(
					'<option value="%1$s" %2$s>%3$s</option>',
					0,
					selected( 0, $wp_block_id, false ),
					__( 'Select Block', 'gutentor' )
				);
				while ( $item_query->have_posts() ) :
					$item_query->the_post();
					printf(
						'<option value="%1$s" %2$s>%3$s</option>',
						absint( get_the_ID() ),
						selected( get_the_ID(), $wp_block_id, false ),
						get_the_title()
					);
				endwhile;
				wp_reset_postdata();
				echo '</select></p>';
			endif;
		}

		/**
		 * Function to Updating widget replacing old instances with new
		 *
		 * @access public
		 * @since 1.0.0
		 *
		 * @param array $new_instance new arrays value
		 * @param array $old_instance old arrays value
		 * @return array
		 */
		public function update( $new_instance, $old_instance ) {
			$instance                = $old_instance;
			$instance['title']       = sanitize_text_field( $new_instance['title'] );
			$instance['wp_block_id'] = absint( $new_instance['wp_block_id'] );

			return $instance;
		}

		/**
		 * Function to Creating widget front-end. This is where the action happens
		 *
		 * @access public
		 * @since 1.0
		 *
		 * @param array $args widget setting
		 * @param array $instance saved values
		 * @return void
		 */
		public function widget( $args, $instance ) {

			$instance = wp_parse_args( (array) $instance, $this->defaults );

			/*default values*/
			$title       = apply_filters( 'widget_title', ! empty( $instance['title'] ) ? $instance['title'] : '', $instance, $this->id_base );
			$wp_block_id = absint( $instance['wp_block_id'] );

			echo $args['before_widget'];
			if ( ! empty( $title ) ) {
				echo $args['before_title'] . esc_html( $title ) . $args['after_title'];
			}
			if ( ! empty( $wp_block_id ) ) :
				$g_args  = array(
					'p'         => $wp_block_id,
					'post_type' => 'wp_block',
				);
				$g_query = new WP_Query( $g_args );
				/*The Loop*/
				if ( $g_query->have_posts() ) :
					echo '<div class="gutentor-widget gutentor-wp-block-widget">';
					while ( $g_query->have_posts() ) :
						$g_query->the_post();
						$style = get_post_meta( get_the_ID(), 'gutentor_dynamic_css', true );
						echo "<!-- Dynamic CSS -->\n<style type=\"text/css\">\n" . wp_strip_all_tags( wp_kses_post( $style ) ) . "\n</style>";
						the_content();
					endwhile;
					echo '</div>';
				endif;
				wp_reset_postdata();
			endif;
			echo $args['after_widget'];
		}
		/**
		 * Load scripts and styles
		 *
		 * @since    2.1.2
		 * @access   public
		 *
		 * @param null
		 * @return void
		 */
		function scripts() {
			if ( ! is_active_widget( false, false, $this->id_base, true ) ) {
				return;
			}
			$gwb_options = $this->get_settings();
			if ( is_array( $gwb_options ) && ! empty( $gwb_options ) ) {
				foreach ( $gwb_options as $gwb_option ) {
					if ( isset( $gwb_option['wp_block_id'] ) && $gwb_option['wp_block_id'] != 0 ) {
						$wp_block_id = absint( $gwb_option['wp_block_id'] );
						$g_args      = array(
							'p'         => $wp_block_id,
							'post_type' => 'wp_block',
						);
						$g_query     = new WP_Query( $g_args );
						/*The Loop*/
						if ( $g_query->have_posts() ) :
							while ( $g_query->have_posts() ) :
								$g_query->the_post();
								gutentor_hooks()->load_lib_assets();
							endwhile;
						endif;
						wp_reset_postdata();
					}
				}
			}
		}
	} // Class Gutentor_WP_Block_Widget ends here
}
