<?php
/**
 * Footer ful width content
 *
 * @since Medical Circle 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'medical_circle_footer_full_width' ) ) :
	function medical_circle_footer_full_width(){
		global $medical_circle_customizer_all_values;
		$medical_circle_footer_bi_number = $medical_circle_customizer_all_values['medical-circle-footer-bi-number'];
		echo '<div class="footer-ful-width">';
		echo '<div class="container">';
		echo '<div class="row">';
		$col = 'col-md-12';
		if ( 1 == $medical_circle_customizer_all_values['medical-circle-footer-enable-social'] ){
			echo "<div class='col-md-3'>";
			do_action('medical_circle_action_social_links');
			echo "</div>";
			$col = 'col-md-9';
		}
		echo "<div class='".$col."'>";
		do_action('medical_circle_action_basic_info', $medical_circle_footer_bi_number, $medical_circle_footer_bi_number );
		echo "</div>";

		echo "</div>";/*.row*/
		echo "</div>";/*.container*/
		echo "</div>";/*.footer-ful-width*/
	}
endif;

/**
 * Footer content
 *
 * @since Medical Circle 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'medical_circle_footer' ) ) :

    function medical_circle_footer() {

        global $medical_circle_customizer_all_values;
	    $medical_circle_footer_full_width_display_options = $medical_circle_customizer_all_values['medical-circle-footer-full-width-display-options'];
	    ?>
        <div class="clearfix"></div>
        <footer class="site-footer">
            <?php
            if(
            is_active_sidebar('footer-col-one') ||
            is_active_sidebar('footer-col-two') ||
            is_active_sidebar('footer-col-three') ||
            is_active_sidebar('footer-col-four') ||
            'top' == $medical_circle_footer_full_width_display_options
            ) {
                ?>
                <div class="footer-columns at-fixed-width">
                    <?php
                    if( 'top' == $medical_circle_footer_full_width_display_options ){
	                    medical_circle_footer_full_width();
                    }
                    if(
                    is_active_sidebar('footer-col-one') ||
                    is_active_sidebar('footer-col-two') ||
                    is_active_sidebar('footer-col-three') ||
                    is_active_sidebar('footer-col-four')
                    ){
                       ?>
                        <div class="container">
                            <div class="row">
			                    <?php
			                    $footer_top_col = 'col-sm-3 init-animate';
			                    if (is_active_sidebar('footer-col-one')) : ?>
                                    <div class="footer-sidebar <?php echo esc_attr($footer_top_col); ?>">
					                    <?php dynamic_sidebar('footer-col-one'); ?>
                                    </div>
			                    <?php endif;
			                    if (is_active_sidebar('footer-col-two')) : ?>
                                    <div class="footer-sidebar <?php echo esc_attr($footer_top_col); ?>">
					                    <?php dynamic_sidebar('footer-col-two'); ?>
                                    </div>
			                    <?php endif;
			                    if (is_active_sidebar('footer-col-three')) : ?>
                                    <div class="footer-sidebar <?php echo esc_attr($footer_top_col); ?>">
					                    <?php dynamic_sidebar('footer-col-three'); ?>
                                    </div>
			                    <?php endif;
			                    if (is_active_sidebar('footer-col-four')) : ?>
                                    <div class="footer-sidebar <?php echo esc_attr($footer_top_col); ?>">
					                    <?php dynamic_sidebar('footer-col-four'); ?>
                                    </div>
			                    <?php endif; ?>
                            </div>
                        </div><!-- bottom-->
                        <?php
                    }
                    ?>

                </div>
                <div class="clearfix"></div>
                <?php
            }
            if( 'bottom' == $medical_circle_footer_full_width_display_options ){
	            medical_circle_footer_full_width();
            }
            ?>
            <div class="copy-right">
                <div class='container'>
                    <div class="row">
                        <div class="col-sm-6 init-animate">
                            <div class="footer-copyright text-left">
                                <?php
                                if( isset( $medical_circle_customizer_all_values['medical-circle-footer-copyright'] ) ): ?>
                                    <p class="at-display-inline-block">
                                        <?php echo wp_kses_post( $medical_circle_customizer_all_values['medical-circle-footer-copyright'] ); ?>
                                    </p>
                                <?php endif;
                                if( 1 == $medical_circle_customizer_all_values['medical-circle-enable-footer-power-text'] ){
	                                echo '<div class="site-info at-display-inline-block">';
	                                printf( esc_html__( '%1$s by %2$s', 'medical-circle' ), 'Medical Circle', '<a href="http://www.acmethemes.com/" rel="designer">Acme Themes</a>' );
	                                echo '</div><!-- .site-info -->';
                                }
                                ?>
                            </div>
                        </div>
                        <div class="col-sm-6 init-animate">
                            <?php
                            $medical_circle_footer_copyright_beside_option = $medical_circle_customizer_all_values['medical-circle-footer-copyright-beside-option'];
                            if( 'hide' != $medical_circle_footer_copyright_beside_option ){
	                            if ( 'social' == $medical_circle_footer_copyright_beside_option ) {
		                            /**
		                             * Social Sharing
		                             * medical_circle_action_social_links
		                             * @since Medical Circle 1.0.0
		                             *
		                             * @hooked medical_circle_social_links -  10
		                             */
		                            echo "<div class='text-right'>";
		                            do_action('medical_circle_action_social_links');
		                            echo "</div>";
	                            }
	                            else{
		                            echo "<div class='at-first-level-nav text-right'>";
		                            wp_nav_menu(
			                            array(
				                            'theme_location' => 'footer-menu',
				                            'container' => false,
				                            'depth' => 1
                                        )
		                            );
		                            echo "</div>";
	                            }
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <a href="#page" class="sm-up-container"><i class="fa fa-angle-up sm-up"></i></a>
            </div>
        </footer>
    <?php
    }
endif;
add_action( 'medical_circle_action_footer', 'medical_circle_footer', 10 );

/**
 * Page end
 *
 * @since Medical Circle 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'medical_circle_page_end' ) ) :

    function medical_circle_page_end() {
	    global $medical_circle_customizer_all_values;
	    $medical_circle_appointment_form_shortcode = $medical_circle_customizer_all_values['medical-circle-appointment-form-shortcode'];
	    $medical_circle_appointment_form_title = $medical_circle_customizer_all_values['medical-circle-appointment-form-title'];
	    if( !empty( $medical_circle_appointment_form_shortcode ) ){
	        ?>
            <!-- Modal -->
            <div id="at-shortcode-bootstrap-modal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
	                        <?php
	                        if( !empty( $medical_circle_appointment_form_title ) ){
		                        ?>
                                <h4 class="modal-title"><?php echo esc_html( $medical_circle_appointment_form_title ); ?></h4>
		                        <?php
	                        }
	                        ?>
                        </div>
                        <div class="modal-body">
                            <?php echo do_shortcode($medical_circle_appointment_form_shortcode);?>
                        </div>
                    </div><!--.modal-content-->
                </div>
            </div><!--#at-shortcode-bootstrap-modal-->
		    <?php
        }
	    ?>
        </div><!-- #page -->
    <?php
    }
endif;
add_action( 'medical_circle_action_after', 'medical_circle_page_end', 10 );