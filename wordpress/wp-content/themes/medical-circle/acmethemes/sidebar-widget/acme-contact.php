<?php
/**
 * Class for adding Contact Section Widget
 *
 * @package Acme Themes
 * @subpackage Medical Circle
 * @since 1.0.0
 */
if ( ! class_exists( 'Medical_Circle_Contact' ) ) {

    class Medical_Circle_Contact extends WP_Widget {
        /*defaults values for fields*/
        private $defaults = array(
            'unique_id'     => '',
            'title'         => '',
            'shortcode'     => '',
            'page_id'       => '',
            'background_options' => 'default'
        );

        function __construct() {
            parent::__construct(
            /*Base ID of your widget*/
                'medical_circle_contact',
                /*Widget name will appear in UI*/
                __('AT Contact Section', 'medical-circle'),
                /*Widget description*/
                array( 'description' => __( 'Show Contact Section.', 'medical-circle' ), )
            );
        }

        /*Widget Backend*/
        public function form( $instance ) {
            $instance = wp_parse_args( (array) $instance, $this->defaults );
            /*default values*/
            $unique_id = esc_attr( $instance[ 'unique_id' ] );
            $title = esc_attr( $instance[ 'title' ] );
            $shortcode = esc_attr( $instance[ 'shortcode' ] );
            $page_id = absint( $instance[ 'page_id' ] );
	        $background_options = esc_attr( $instance['background_options'] );
	        ?>
            <p>
                <label for="<?php echo $this->get_field_id( 'unique_id' ); ?>"><?php _e( 'Section ID', 'medical-circle' ); ?>:</label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'unique_id' ); ?>" name="<?php echo $this->get_field_name( 'unique_id' ); ?>" type="text" value="<?php echo $unique_id; ?>" />
                <br />
                <small><?php _e('Enter a Unique Section ID. You can use this ID in Menu item for enabling One Page Menu.','medical-circle')?></small>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'medical-circle' ); ?>:</label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'shortcode' ); ?>"><?php _e( 'Enter Shortcode', 'medical-circle' ); ?>:</label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'shortcode' ); ?>" name="<?php echo $this->get_field_name( 'shortcode' ); ?>" type="text" value="<?php echo $shortcode; ?>" />
                <small>
                    <?php
                    printf( __( 'Download contact form 7 from %1$shere%2$s', 'medical-circle' ), "<a target='_blank' href='".esc_url( 'https://wordpress.org/plugins/contact-form-7/' )."''>","</a>" );
                    ?>
                </small>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'page_id' ); ?>"><?php _e( 'Select Page For Contact', 'medical-circle' ); ?>:</label>
                <br />
                <small><?php _e( 'Select page and its title and excerpt will display in the frontend. No need of subpages.', 'medical-circle' ); ?></small>
                <?php
                /* see more here https://codex.wordpress.org/Function_Reference/wp_dropdown_pages*/
                $args = array(
                    'selected'              => $page_id,
                    'name'                  => $this->get_field_name( 'page_id' ),
                    'id'                    => $this->get_field_id( 'page_id' ),
                    'class'                 => 'widefat',
                    'show_option_none'      => __('Select Page','medical-circle'),
                    'option_none_value'     => 0 // string
                );
                wp_dropdown_pages( $args );
                ?>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'background_options' ); ?>"><?php _e( 'Background Options', 'medical-circle' ); ?>:</label>
                <select class="widefat" id="<?php echo $this->get_field_id( 'background_options' ); ?>" name="<?php echo $this->get_field_name( 'background_options' ); ?>">
			        <?php
			        $medical_circle_background_options = medical_circle_background_options();
			        foreach ( $medical_circle_background_options as $key => $value ) {
				        ?>
                        <option value="<?php echo esc_attr( $key ) ?>" <?php selected( $key, $background_options ); ?>><?php echo esc_html( $value ); ?></option>
				        <?php
			        }
			        ?>
                </select>
            </p>
            <?php
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
         *
         */
        public function update( $new_instance, $old_instance ) {
            $instance = $old_instance;
            $instance[ 'unique_id' ] = sanitize_key( $new_instance[ 'unique_id' ] );
            $instance[ 'title' ] = sanitize_text_field( $new_instance[ 'title' ] );
            $instance[ 'shortcode' ] = wp_kses_post( $new_instance[ 'shortcode' ] );
            $instance[ 'page_id' ] = absint( $new_instance[ 'page_id' ] );
	        $instance['background_options'] = sanitize_key( $new_instance['background_options'] );

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
         *
         */
        public function widget($args, $instance) {
            $animation1 = 'init-animate fadeIn';
            $animation2 = 'init-animate fadeIn';

            $instance = wp_parse_args( (array) $instance, $this->defaults);

            /*default values*/
            $unique_id = !empty( $instance[ 'unique_id' ] ) ? esc_attr( $instance[ 'unique_id' ] ) : esc_attr( $this->id );
            $title = apply_filters( 'widget_title', !empty( $instance['title'] ) ? $instance['title'] : '', $instance, $this->id_base );
            $shortcode = wp_kses_post( $instance[ 'shortcode' ] );
            $page_id = absint( $instance[ 'page_id' ] );
	        $background_options = esc_attr( $instance['background_options'] );
	        $bg_gray_class = $background_options == 'gray'?'at-gray-bg':'';

            echo $args['before_widget'];
            ?>
            <section id="<?php echo $unique_id;?>" class="at-widgets acme-contact <?php echo $bg_gray_class;?>">
                <div class="contact-form">
                    <div class="container">
                        <div class="row">
                            <?php
                            if( !empty( $title ) ) {
                                echo '<div class="main-title init-animate fadeIn">';
                                echo $args['before_title'] .esc_html( $title ).$args['after_title'];
                                echo '</div>';
                            }
                            $next_col = "col-md-12";
	                        if( !empty ( $page_id ) ) :
		                        $medical_circle_child_page_args = array(
			                        'page_id'             => $page_id,
			                        'posts_per_page'      => 1,
			                        'post_type'           => 'page',
			                        'no_found_rows'       => true,
			                        'post_status'         => 'publish'
		                        );
		                        $service_query = new WP_Query( $medical_circle_child_page_args );
		                        /*The Loop*/
		                        if ( $service_query->have_posts() ):
			                        while( $service_query->have_posts() ):$service_query->the_post();
				                        ?>
                                        <div class="col-sm-6  <?php echo $animation1; ?>">
					                        <?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
                                            <div class="contact-page-content">
						                        <?php
						                        the_content();
						                        ?>
                                            </div>
                                        </div>
				                        <?php
			                        endwhile;
			                        $next_col = "col-md-6";
		                        endif;
	                        endif;
	                        ?>
                            <div class="col-sm-6  <?php echo $next_col.' '.$animation2; ?>">
                                <?php echo do_shortcode( $shortcode ); ?>
                            </div>

                        </div>
                    </div>
                </div>
            </section>
            <?php
            echo $args['after_widget'];
        }
    } // Class Medical_Circle_Contact ends here
}