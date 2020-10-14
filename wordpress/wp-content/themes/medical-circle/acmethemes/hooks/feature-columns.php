<?php
/**
 * Display Feature Columns
 *
 * @since Medical Circle 1.0.0
 *
 * @return void
 *
 */
if ( !function_exists('medical_circle_feature_column') ) :
    function medical_circle_feature_column() {
        global $medical_circle_customizer_all_values;
        $medical_circle_feature_column_1 = $medical_circle_customizer_all_values['medical-circle-feature-column-1'];
        $medical_circle_feature_column_1_color = $medical_circle_customizer_all_values['medical-circle-feature-column-1-color'];
        $medical_circle_feature_column_2 = $medical_circle_customizer_all_values['medical-circle-feature-column-2'];
        $medical_circle_feature_column_2_color = $medical_circle_customizer_all_values['medical-circle-feature-column-2-color'];
        $medical_circle_feature_column_3 = $medical_circle_customizer_all_values['medical-circle-feature-column-3'];
        $medical_circle_feature_column_3_color = $medical_circle_customizer_all_values['medical-circle-feature-column-3-color'];
	    $thumbnail = 'large';

        $post_in = array();
        if( 0 != $medical_circle_feature_column_1 ){
            $post_in[] = $medical_circle_feature_column_1;
        }
        if( 0 != $medical_circle_feature_column_2 ){
            $post_in[] = $medical_circle_feature_column_2;
        }
        if( 0 != $medical_circle_feature_column_3 ){
            $post_in[] = $medical_circle_feature_column_3;
        }
        if( !empty( $post_in ) ) :
            ?>
            <!--feature columns-->
            <section class="feature-column">
                <div class="container">
                    <div class="row">
                        <?php
                        $medical_circle_child_page_args = array(
                            'post__in'         => $post_in,
                            'orderby'             => 'post__in',
                            'posts_per_page'      => 3,
                            'post_type'           => 'page',
                            'no_found_rows'       => true,
                            'post_status'         => 'publish'
                        );
                        $feature_columns_query = new WP_Query( $medical_circle_child_page_args );
                        $feature_columns_number = $feature_columns_query->post_count;
                        /*The Loop*/
                        if ( $feature_columns_query->have_posts() ):
                        $i = 1;
                        while( $feature_columns_query->have_posts() ):$feature_columns_query->the_post();
                            $clearfix = '';
                            if( 1 == $feature_columns_number ){
                                $b_col = "col-sm-12";
                            }
                            elseif( 3 == $feature_columns_number ){
                                $b_col = "col-sm-4";
                            }
                            elseif( 4 == $feature_columns_number ){
                                $b_col = "col-sm-3";
                            }
                            else{
                                $b_col = "col-sm-6";
                            }
                            if( 1 == $i ){
                                $bg_color = $medical_circle_feature_column_1_color;
                            }
                            elseif ( 2 == $i ){
                                $bg_color = $medical_circle_feature_column_2_color;
                            }
                            elseif ( 3 == $i ){
                                $bg_color = $medical_circle_feature_column_3_color;
                            }
                            else{
                                $bg_color = $medical_circle_feature_column_3_color;
                            }
                            $init_animate_content = "init-animate";
                            ?>
                            <div class="feature-col <?php echo esc_attr( $init_animate_content )?> <?php echo esc_attr( $b_col ); ?>" style="background-color: <?php echo esc_attr( $bg_color );?>">
                                <div class="feature-col-item">
                                    <?php
                                    if( has_post_thumbnail() ):
	                                    ?>
                                        <!--post thumbnal options-->
                                        <div class="post-thumb">
                                            <a href="<?php the_permalink(); ?>">
			                                    <?php the_post_thumbnail( $thumbnail ); ?>
                                            </a>
                                        </div><!-- .post-thumb-->
	                                    <?php
                                    endif;
                                    echo '<div class="feature-col-content">';
                                    the_title( sprintf( '<h3><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' );
                                    the_excerpt();
                                    echo "</div>";
                                    ?>
                                </div>
                            </div>
                            <?php
                            echo $clearfix;
                            $i++;
                        endwhile;
                        ?>
                    </div>
                    <?php
                    endif;
                    ?>
                </div>
            </section>
            <?php
        endif;
        ?>
        <div class="clearfix"></div>
        <?php
    }
endif;
add_action( 'medical_circle_action_feature_slider', 'medical_circle_feature_column', 20 );