<?php
/**
 * Display default slider
 *
 * @since Medical Circle 1.0.0
 *
 * @param int $post_id
 * @return void
 *
 */
if ( !function_exists('medical_circle_default_slider') ) :
    function medical_circle_default_slider(){
        global $medical_circle_customizer_all_values;
        $bg_image_style = '';
        if ( get_header_image() ) :
            $bg_image_style .= 'background-image:url(' . esc_url( get_header_image() ) . ');background-repeat:no-repeat;background-size:cover;background-position:center;';
        else:
            $bg_image_style .= 'background-image:url(' . esc_url( get_template_directory_uri()."/assets/img/default-image.jpg" ) . ');background-repeat:no-repeat;background-size:cover;background-position:center;';
        endif; // End header image check.

        $text_align = 'text-left';
        $animation1 = 'init-animate';
        $animation2 = 'init-animate';
        ?>
        <div class="image-slider-wrapper home-fullscreen ">
            <div class="acme-slick-carausel">
                <div class="item" style="<?php echo $bg_image_style; ?>">
                    <div class="slider-content <?php echo $text_align;?>">
                        <div class="container">
                            <div class="banner-title <?php echo $animation1;?>">
                                <?php _e('Medical Circle','medical-circle' );?>
                            </div>
                            <div class="image-slider-caption <?php echo $animation2;?>">
                                <?php _e('The modern Medical WordPress Theme','medical-circle' );?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
endif;

/**
 * Featured Slider display
 *
 * @since Medical Circle 1.0.0
 *
 * @param null
 * @return void
 */

if ( ! function_exists( 'medical_circle_feature_slider' ) ) :

    function medical_circle_feature_slider( ){
        global $medical_circle_customizer_all_values;

        $medical_circle_slides_data = json_decode( $medical_circle_customizer_all_values['medical-circle-slides-data'] );
	    $medical_circle_feature_slider_text_align = $medical_circle_customizer_all_values['medical-circle-feature-slider-text-align'];

        $medical_circle_feature_slider_enable_animation = $medical_circle_customizer_all_values['medical-circle-feature-slider-enable-animation'];
        $medical_circle_feature_slider_image_only = $medical_circle_customizer_all_values['medical-circle-feature-slider-display-title'];
        $medical_circle_feature_slider_image_excerpt = $medical_circle_customizer_all_values['medical-circle-feature-slider-display-excerpt'];
        $medical_circle_fs_image_display_options = $medical_circle_customizer_all_values['medical-circle-fs-image-display-options'];

	    $post_in = array();
	    $slides_other_data = array();
	    if( is_array( $medical_circle_slides_data ) ){
		    foreach ( $medical_circle_slides_data as $slides_data ){
			    if( isset( $slides_data->selectpage ) && !empty( $slides_data->selectpage ) ){
				     $post_in[] = $slides_data->selectpage;
                        $selectpage =  $slides_data->selectpage;
                        if( function_exists('pll_get_post')){
                           $selectpage =  pll_get_post($slides_data->selectpage);
                        }
                        $slides_other_data[$selectpage] = array(
				           'button-1-text' =>$slides_data->button_1_text,
				           'button-1-link' =>$slides_data->button_1_link,
				           'button-2-text' =>$slides_data->button_2_text,
				           'button-2-link' =>$slides_data->button_2_link
                    );
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
		    $slider_query = new WP_Query( $medical_circle_child_page_args );
		    /*The Loop*/
		    if ( $slider_query->have_posts() ):
			    ?>
                <div class="image-slider-wrapper home-fullscreen <?php echo $medical_circle_fs_image_display_options; ?>">
                    <div class="acme-slick-carausel">
					    <?php
					    $slider_index = 1;
					    $text_align = '';
					    $animation1 = '';
					    $animation2 = '';
					    $animation3 = '';
					    $animation4 = '';

					    $bg_image_style = '';
					    if( 'alternate' != $medical_circle_feature_slider_text_align ){
						    $text_align = $medical_circle_feature_slider_text_align;
					    }
					    if( 1 == $medical_circle_feature_slider_enable_animation ){
						    $animation1 = 'init-animate fadeInDown';
						    $animation2 = 'init-animate fadeInDown1';
						    $animation3 = 'init-animate fadeInLeft';
						    $animation4 = 'init-animate fadeInRight';
					    }
					    while( $slider_query->have_posts() ):$slider_query->the_post();

						    if( 'alternate' == $medical_circle_feature_slider_text_align ){
							    if( 1 == $slider_index ){
								    $text_align = 'text-left';
							    }
                                elseif ( 2 == $slider_index ){
								    $text_align = 'text-center';
							    }
							    else{
								    $text_align = 'text-right';
							    }
						    }
						    if (has_post_thumbnail()) {
							    $image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
						    }
						    else {
							    $image_url[0] = get_template_directory_uri().'/assets/img/default-image.jpg';
						    }
						    if( 'full-screen-bg' == $medical_circle_fs_image_display_options ){
							    $bg_image_style = 'background-image:url(' . esc_url( $image_url[0] ) . ');background-repeat:no-repeat;background-size:cover;background-position:center;';
						    }
						    $slides_single_data = $slides_other_data[get_the_ID()];
						    ?>
                            <div class="item" style="<?php echo $bg_image_style; ?>">
							    <?php
							    if( 'responsive-img' == $medical_circle_fs_image_display_options ){
								    echo '<img src="'.esc_url( $image_url[0] ).'"/>';
							    }
							    ?>
                                <div class="slider-content <?php echo $text_align;?>">
                                    <div class="container">
									    <?php
									    if( 1 == $medical_circle_feature_slider_image_only ){
										    ?>
                                            <div class="banner-title <?php echo $animation1;?>"><?php the_title()?></div>
										    <?php
									    }
									    if( 1 == $medical_circle_feature_slider_image_excerpt ){
										    ?>
                                            <div class="image-slider-caption <?php echo $animation2;?>">
											    <?php the_excerpt(); ?>
                                            </div>
										    <?php
									    }
									    if( !empty( $slides_single_data['button-1-text'] ) ){
										    ?>
                                            <a href="<?php echo esc_url( $slides_single_data['button-1-link'] )?>" class="<?php echo $animation3;?> btn btn-primary btn-reverse outline-outward banner-btn">
											    <?php echo esc_html( $slides_single_data['button-1-text'] ); ?>
                                            </a>
										    <?php
									    }
									    if( !empty( $slides_single_data['button-2-text'] ) ){
										    ?>
                                            <a href="<?php echo esc_url( $slides_single_data['button-2-link'] )?>" class="<?php echo $animation4;?> btn btn-primary outline-outward banner-btn">
											    <?php echo esc_html( $slides_single_data['button-2-text'] ); ?>
                                            </a>
										    <?php
									    }
									    ?>
                                    </div>
                                </div>
                            </div>
						    <?php
						    $slider_index ++;
						    if( 3 < $slider_index ){
							    $slider_index = 1;
						    }
					    endwhile;
					    ?>
                    </div>
                </div>
			    <?php
			    wp_reset_postdata();
		    else:
			    medical_circle_default_slider();
		    endif;
	    else:
		    medical_circle_default_slider();
        endif;
    }
endif;
add_action( 'medical_circle_action_feature_slider', 'medical_circle_feature_slider', 0 );