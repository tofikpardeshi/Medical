<?php
/**
 * Widget Image Popup Type
 *
 * @since Medical Circle 1.0.0
 *
 * @param null
 * @return array $medical_circle_gallery_image_popup
 *
 */
if ( !function_exists('medical_circle_gallery_image_popup') ) :
    function medical_circle_gallery_image_popup() {
        $medical_circle_gallery_image_popup =  array(
            'gallery' => __( 'Gallery', 'medical-circle' ),
            'single' => __( 'Single', 'medical-circle' ),
            'disable' => __( 'Disable', 'medical-circle' ),
        );
        return apply_filters( 'medical_circle_gallery_image_popup', $medical_circle_gallery_image_popup );
    }
endif;

/**
 * Class for adding Gallery Section Widget
 *
 * @package Acme Themes
 * @subpackage Medical Circle
 * @since 1.0.0
 */
if ( ! class_exists( 'Medical_Circle_Gallery' ) ) {

    class Medical_Circle_Gallery extends WP_Widget {
        /*defaults values for fields*/
        private $defaults = array(
            'unique_id'         => '',
            'title'             => '',
            'at_all_page_items' => '',
            'column_number'     => 4,
            'image_popup_type'  => 'gallery'
        );

        function __construct() {
            parent::__construct(
            /*Base ID of your widget*/
                'medical_circle_gallery',
                /*Widget name will appear in UI*/
                __('AT Gallery Section', 'medical-circle'),
                /*Widget description*/
                array( 'description' => __( 'Show Gallery Section.', 'medical-circle' ), )
            );
        }

        /*Widget Backend*/
        public function form( $instance ) {
            $instance = wp_parse_args( (array) $instance, $this->defaults );
            /*default values*/
            $unique_id = esc_attr( $instance[ 'unique_id' ] );
            $title = esc_attr( $instance[ 'title' ] );
            $at_all_page_items      = $instance['at_all_page_items'];
	        $column_number = absint( $instance[ 'column_number' ] );

	        /*fixed for previous version bug*/
	        if( $column_number == 0 ){
		        $column_number = 4;
	        }
            $image_popup_type = esc_attr( $instance[ 'image_popup_type' ] );
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

            <!--updated code-->
            <label><?php _e( 'Select Pages For Gallery', 'medical-circle' ); ?>:</label>
            <br/>
            <small><?php _e( 'Add Page, Reorder and Remove. Please do not forget to add Featured Image on selected pages. ', 'medical-circle' ); ?></small>
            <div class="at-repeater">
		        <?php
		        $total_repeater = 0;
		        if  ( is_array($at_all_page_items) && count($at_all_page_items) > 0 ){
			        foreach ($at_all_page_items as $about){
				        $repeater_id  = $this->get_field_id( 'at_all_page_items') .$total_repeater.'page_id';
				        $repeater_name  = $this->get_field_name( 'at_all_page_items' ).'['.$total_repeater.']['.'page_id'.']';
				        ?>
                        <div class="repeater-table">
                            <div class="at-repeater-top">
                                <div class="at-repeater-title-action">
                                    <button type="button" class="at-repeater-action">
                                        <span class="at-toggle-indicator" aria-hidden="true"></span>
                                    </button>
                                </div>
                                <div class="at-repeater-title">
                                    <h3><?php _e( 'Select Item', 'medical-circle' )?><span class="in-at-repeater-title"></span></h3>
                                </div>
                            </div>
                            <div class='at-repeater-inside hidden'>
						        <?php
						        /* see more here https://codex.wordpress.org/Function_Reference/wp_dropdown_pages*/
						        $args = array(
							        'selected'         => $about['page_id'],
							        'name'             => $repeater_name,
							        'id'               => $repeater_id,
							        'class'            => 'widefat at-select',
							        'show_option_none' => __( 'Select Page', 'medical-circle'),
							        'option_none_value'     => 0, // string
						        );
						        wp_dropdown_pages( $args );
						        ?>
                                <div class="at-repeater-control-actions">
                                    <button type="button" class="button-link button-link-delete at-repeater-remove"><?php _e('Remove','medical-circle');?></button> |
                                    <button type="button" class="button-link at-repeater-close"><?php _e('Close','medical-circle');?></button>
	                                <?php
	                                if( get_edit_post_link( $about['page_id'] ) ){
		                                ?>
                                        <a class="button button-link at-postid alignright" target="_blank" href="<?php echo esc_url( get_edit_post_link( $about['page_id'] ) ); ?>">
			                                <?php _e('Full Edit','medical-circle');?>
                                        </a>
		                                <?php
	                                }
	                                ?>
                                </div>
                            </div>
                        </div>
				        <?php
				        $total_repeater = $total_repeater + 1;
			        }
		        }
		        $coder_repeater_depth = 'coderRepeaterDepth_'.'0';
		        $repeater_id  = $this->get_field_id( 'at_all_page_items') .$coder_repeater_depth.'page_id';
		        $repeater_name  = $this->get_field_name( 'at_all_page_items' ).'['.$coder_repeater_depth.']['.'page_id'.']';
		        ?>
                <script type="text/html" class="at-code-for-repeater">
                    <div class="repeater-table">
                        <div class="at-repeater-top">
                            <div class="at-repeater-title-action">
                                <button type="button" class="at-repeater-action">
                                    <span class="at-toggle-indicator" aria-hidden="true"></span>
                                </button>
                            </div>
                            <div class="at-repeater-title">
                                <h3><?php _e( 'Select Item', 'medical-circle' )?><span class="in-at-repeater-title"></span></h3>
                            </div>
                        </div>
                        <div class='at-repeater-inside hidden'>
					        <?php
					        /* see more here https://codex.wordpress.org/Function_Reference/wp_dropdown_pages*/
					        $args = array(
						        'selected'         => '',
						        'name'             => $repeater_name,
						        'id'               => $repeater_id,
						        'class'            => 'widefat at-select',
						        'show_option_none' => __( 'Select Page', 'medical-circle'),
						        'option_none_value'     => 0 // string
					        );
					        wp_dropdown_pages( $args );
					        ?>
                            <div class="at-repeater-control-actions">
                                <button type="button" class="button-link button-link-delete at-repeater-remove"><?php _e('Remove','medical-circle');?></button> |
                                <button type="button" class="button-link at-repeater-close"><?php _e('Close','medical-circle');?></button>
                            </div>
                        </div>
                    </div>
                </script>
		        <?php
		        /*most imp for repeater*/
		        echo '<input class="at-total-repeater" type="hidden" value="'.$total_repeater.'">';
		        $add_field = __('Add Item', 'medical-circle');
		        echo '<span class="button-primary at-add-repeater" id="'.$coder_repeater_depth.'">'.$add_field.'</span><br/>';
		        ?>
            </div>
            <!--updated code-->

            <p>
                <label for="<?php echo $this->get_field_id( 'column_number' ); ?>"><?php _e( 'Column Number', 'medical-circle' ); ?>:</label>
                <select class="widefat" id="<?php echo $this->get_field_id( 'column_number' ); ?>" name="<?php echo $this->get_field_name( 'column_number' ); ?>" >
                    <?php
                    $medical_circle_column_numbers = medical_circle_column_number();
                    foreach ( $medical_circle_column_numbers as $key => $value ){
                        ?>
                        <option value="<?php echo esc_attr( $key )?>" <?php selected( $key, $column_number ); ?>><?php echo esc_html( $value );?></option>
                        <?php
                    }
                    ?>
                </select>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'image_popup_type' ); ?>"><?php _e( 'Image Popup Type', 'medical-circle' ); ?>:</label>
                <select class="widefat" id="<?php echo $this->get_field_id( 'image_popup_type' ); ?>" name="<?php echo $this->get_field_name( 'image_popup_type' ); ?>" >
                    <?php
                    $medical_circle_gallery_image_popup = medical_circle_gallery_image_popup();
                    foreach ( $medical_circle_gallery_image_popup as $key => $value ){
                        ?>
                        <option value="<?php echo esc_attr( $key )?>" <?php selected( $key, $image_popup_type ); ?>><?php echo esc_html( $value );?></option>
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

	        /*updated code*/
	        $page_ids = array();
	        if( isset($new_instance['at_all_page_items'] )){
		        $at_all_page_items    = $new_instance['at_all_page_items'];
		        if  ( is_array($at_all_page_items) && count($at_all_page_items) > 0 ){
			        foreach ($at_all_page_items as $key=>$about ){
				        $page_ids[$key]['page_id'] = absint( $about['page_id'] );
			        }
		        }
	        }
	        $instance['at_all_page_items'] = $page_ids;

            $instance[ 'column_number' ] = absint( $new_instance[ 'column_number' ] );
            $instance[ 'image_popup_type' ] = esc_attr( $new_instance[ 'image_popup_type' ] );
            return $instance;
        }
        /**
         * Function to Creating widget front-end. This is where the action happens
         *
         * @access public
         * @since 1.0.0
         *
         * @param array $args widget setting
         * @param array $instance saved values
         * @return void
         *
         */
        public function widget($args, $instance) {
            $instance = wp_parse_args( (array) $instance, $this->defaults);

            /*default values*/
            $unique_id = !empty( $instance[ 'unique_id' ] ) ? esc_attr( $instance[ 'unique_id' ] ) : esc_attr( $this->id );
            $title = apply_filters( 'widget_title', !empty( $instance['title'] ) ? $instance['title'] : '', $instance, $this->id_base );
	        $at_all_page_items    = $instance['at_all_page_items'];
            $column_number = absint( $instance[ 'column_number' ] );
            $image_popup_type = esc_attr( $instance[ 'image_popup_type' ] );

            echo $args['before_widget'];
            ?>
            <section id="<?php echo $unique_id;?>" class="at-widgets acme-gallery">
                <div class="fullwidth-container">
                    <?php
                    if( !empty( $title) ){
                        echo '<div class="main-title init-animate fadeIn">';
                        if( !empty( $title ) ) {
                            echo $args['before_title'] .esc_html( $title ).$args['after_title'];
                        }
                        echo "</div>";
                    }
                    $post_in = array();
                    if  ( is_array($at_all_page_items) && count($at_all_page_items) > 0 ){
	                    foreach ( $at_all_page_items as $about ){
		                    if( isset( $about['page_id'] ) && !empty( $about['page_id'] ) ){
			                    $post_in[] = $about['page_id'];
		                    }
	                    }
                    }
                    if( !empty ( $post_in ) ) :
	                    $medical_circle_child_page_args = array(
		                    'post__in'         => $post_in,
		                    'orderby'             => 'post__in',
		                    'posts_per_page'      => count( $post_in ),
		                    'post_type'           => 'page',
		                    'no_found_rows'       => true,
		                    'post_status'         => 'publish'
	                    );
	                    $gallery_query = new WP_Query( $medical_circle_child_page_args );
                        ?>
                        <div class="row fullwidth-row">
                            <?php
                            if ( $gallery_query->have_posts() ):
                                $i = 1;
                                while( $gallery_query->have_posts() ):$gallery_query->the_post();
                                    $animation1 = "init-animate fadeIn";
	                                if( 1 == $column_number ){
		                                $medical_circle_column = " col-xs-12";
	                                }
                                    elseif( 2 == $column_number ){
		                                $medical_circle_column = " col-xs-6";
	                                }
                                    elseif( 3 == $column_number ){
		                                $medical_circle_column = " col-xs-12 col-md-4";
	                                }
                                    elseif( 4 == $column_number ){
		                                $medical_circle_column = ' col-xs-12 col-md-3';
	                                }
	                                else{
		                                $medical_circle_column = " col-xs-12 col-md-3";
	                                }
                                    ?>
                                    <div class="at-gallery-item <?php echo esc_attr( $medical_circle_column ); ?>">
                                        <div class="gallery-inner-item <?php echo esc_attr( $animation1 );?>">
                                            <div class="at-middle">
                                                <h3>
                                                    <a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>">
                                                        <?php the_title(); ?>
                                                    </a>
                                                </h3>
                                            </div>
	                                        <?php
	                                        if( 'disable' != $image_popup_type ){
		                                        if( 'gallery' == $image_popup_type ){
			                                        $image_popup_class = 'image-gallery-widget';
		                                        }
		                                        else{
			                                        $image_popup_class = 'single-image-widget';
		                                        }
		                                        $image_url_full = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
		                                        ?>
                                                <a class="at-gallery-hover <?php echo esc_attr( $image_popup_class );?>" href="<?php echo esc_url( $image_url_full[0] );?>"></a>
		                                        <?php
	                                        }
                                            if( has_post_thumbnail() ):
                                                $image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'post-thumbnail' );
                                            else:
                                                $image_url[0] = get_template_directory_uri().'/assets/img/default-image.jpg';
                                            endif;
                                            ?>
                                            <a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>">
                                                <img src="<?php echo esc_url( $image_url[0] ); ?>" alt="<?php the_title_attribute(); ?>" title="<?php the_title_attribute(); ?>" />
                                            </a>
                                        </div>
                                    </div>
                                    <?php
                                    $i++;
                                endwhile;
                            endif;
                            wp_reset_postdata();
                        ?>
                        </div><!--row-->
                        <?php
                    endif;
                    ?>
                </div>
            </section>
            <?php
            echo $args['after_widget'];
        }
    } // Class Medical_Circle_Gallery ends here
}