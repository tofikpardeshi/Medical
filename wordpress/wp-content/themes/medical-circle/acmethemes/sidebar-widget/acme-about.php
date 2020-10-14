<?php
/**
 * Class for adding About Section Widget
 *
 * @package Acme Themes
 * @subpackage Medical Circle
 * @since 1.0.0
 */
if ( ! class_exists( 'Medical_Circle_About' ) ) {

	class Medical_Circle_About extends WP_Widget {
		/*defaults values for fields*/
		private $defaults = array(
			'unique_id'         => '',
			'title'             => '',
			'at_all_page_items' => '',
			'column_number'     => 3,
			'background_options'=> 'default',
		);

		function __construct() {
			parent::__construct(
			/*Base ID of your widget*/
				'medical_circle_about',
				/*Widget name will appear in UI*/
				__( 'AT About/Service Section', 'medical-circle' ),
				/*Widget description*/
				array( 'description' => __( 'Show Section with beautiful Icons.', 'medical-circle' ), )
			);
		}

		/*Widget Backend*/
		public function form( $instance ) {
			$instance = wp_parse_args( (array) $instance, $this->defaults );
			/*default values*/
			$unique_id     = esc_attr( $instance['unique_id'] );
			$title         = esc_attr( $instance['title'] );
            $at_all_page_items      = $instance['at_all_page_items'];
			$column_number = absint( $instance['column_number'] );
			$background_options = sanitize_key( $instance['background_options'] );
			?>
            <p>
                <label for="<?php echo $this->get_field_id( 'unique_id' ); ?>"><?php _e( 'Section ID', 'medical-circle' ); ?>:</label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'unique_id' ); ?>" name="<?php echo $this->get_field_name( 'unique_id' ); ?>" type="text" value="<?php echo $unique_id; ?>"/>
                <br/>
                <small><?php _e( 'Enter a Unique Section ID. You can use this ID in Menu item for enabling One Page Menu.', 'medical-circle' ) ?></small>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'medical-circle' ); ?>:</label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>"/>
            </p>

            <!--updated code-->
            <label><?php _e( 'Select Pages For About', 'medical-circle' ); ?>:</label>
            <br/>
            <small><?php _e( 'Add Page, Reorder and Remove. Please do not forget to add Icon and Excerpt  on selected pages.', 'medical-circle' ); ?></small>
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
									'option_none_value'     => 0 // string
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
                <select class="widefat" id="<?php echo $this->get_field_id( 'column_number' ); ?>" name="<?php echo $this->get_field_name( 'column_number' ); ?>">
					<?php
					$medical_circle_about_column_numbers = medical_circle_column_number();
					foreach ( $medical_circle_about_column_numbers as $key => $value ) {
						?>
                        <option value="<?php echo esc_attr( $key ) ?>" <?php selected( $key, $column_number ); ?>><?php echo esc_html( $value ); ?></option>
						<?php
					}
					?>
                </select>
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
		 * @since 1.0
		 *
		 * @param array $new_instance new arrays value
		 * @param array $old_instance old arrays value
		 *
		 * @return array
		 *
		 */
		public function update( $new_instance, $old_instance ) {
			$instance                  = $old_instance;
			$instance['unique_id']     = sanitize_key( $new_instance['unique_id'] );

			$instance['title']         = sanitize_text_field( $new_instance['title'] );

			/*updated code*/
			$page_ids = array();
			if( isset($new_instance['at_all_page_items'] )){
				$at_all_page_items    = $new_instance['at_all_page_items'];
				if  (is_array($at_all_page_items) && count($at_all_page_items) > 0 ){
					foreach ($at_all_page_items as $key=>$about ){
						$page_ids[$key]['page_id'] = absint( $about['page_id'] );
					}
				}
            }
			$instance['at_all_page_items'] = $page_ids;
			
			$instance['column_number'] = absint( $new_instance['column_number'] );
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
		 *
		 * @return void
		 *
		 */
		public function widget( $args, $instance ) {
			$instance = wp_parse_args( (array) $instance, $this->defaults );
			/*default values*/
			$unique_id     = ! empty( $instance['unique_id'] ) ? esc_attr( $instance['unique_id'] ) : esc_attr( $this->id );
			$title         = apply_filters( 'widget_title', ! empty( $instance['title'] ) ? $instance['title'] : '', $instance, $this->id_base );
            $at_all_page_items    = $instance['at_all_page_items'];
            $column_number = absint( $instance['column_number'] );
            $background_options = esc_attr( $instance['background_options'] );
            $bg_gray_class = $background_options == 'gray'?'at-gray-bg':'';

            echo $args['before_widget'];
			?>
            <section id="<?php echo esc_attr( $unique_id ); ?>" class="at-widgets acme-abouts <?php echo $bg_gray_class;?>">
                <div class="container">
					<?php
					if ( ! empty( $title ) ) {
						echo '<div class="main-title init-animate fadeIn">';
						echo $args['before_title'] . esc_html( $title ) . $args['after_title'];
						echo '</div>';
					}
					?>
                    <div class="row">
						<?php
						$post_in = array();
						if  ( is_array($at_all_page_items) && count($at_all_page_items) > 0  ){
							foreach ( $at_all_page_items as $about ){
								if( isset( $about['page_id'] ) && !empty( $about['page_id'] ) ){
									$post_in[] = $about['page_id'];
								}
							}
						}
						if( !empty( $post_in )) :
                            $medical_circle_child_page_args = array(
                                    'post__in'         => $post_in,
                                    'orderby'             => 'post__in',
                                    'posts_per_page'      => count( $post_in ),
                                    'post_type'           => 'page',
                                    'no_found_rows'       => true,
                                    'post_status'         => 'publish'
                            );
							$about_query = new WP_Query( $medical_circle_child_page_args );

							/*The Loop*/
							if ( $about_query->have_posts() ):
								$i = 1;
								while ( $about_query->have_posts() ):$about_query->the_post();
									$animation1 = "init-animate fadeIn";

									if ( 1 == $column_number ) {
										$b_col = "col-sm-12";
									} elseif ( 2 == $column_number ) {
										$b_col = "col-sm-6";
									} elseif ( 3 == $column_number ) {
										$b_col = "col-sm-12 col-md-4";
									} else {
										$b_col = "col-sm-12 col-md-3";
									}
									?>
                                    <div class="<?php echo esc_attr( $b_col ); ?> column">
                                        <div class="single-item <?php echo esc_attr( $animation1 ); ?>">
                                            <div class="icon">
												<?php
												$medical_circle_icon = get_post_meta( get_the_ID(), 'medical-circle-featured-icon', true );
												$medical_circle_icon = isset( $medical_circle_icon ) ? esc_attr( $medical_circle_icon ) : '';
												if ( ! empty ( $medical_circle_icon ) ) { ?>
                                                    <a href="<?php the_permalink() ?>">
                                                        <i class="fa <?php echo esc_attr( $medical_circle_icon ); ?>"></i>
                                                    </a>
												<?php
												}
												else {
													echo '<a href="' . esc_url( get_the_permalink() ) . '"><i class="fa fa-suitcase"></i></a>';
												}
												?>
                                            </div>
                                            <div class="content">
                                                <h3 class="title">
                                                    <a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>">
			                                            <?php the_title(); ?>
                                                    </a>
                                                </h3>
                                                <div class="details">
	                                                <?php the_excerpt(); ?>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
									<?php
									if ( 0 == $i % $column_number ) {
										echo "<div class='clearfix'></div>";
									}
									$i ++;
								endwhile;
							endif;
							wp_reset_postdata();
						endif;

						?>
                    </div>
                </div>
            </section>
			<?php
			echo $args['after_widget'];
		}
	} // Class Medical_Circle_About ends here
}