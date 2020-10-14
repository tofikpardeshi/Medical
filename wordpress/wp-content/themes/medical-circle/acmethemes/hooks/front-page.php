<?php
/**
 * Front page hook for all WordPress Conditions
 *
 * @since Medical Circle 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'medical_circle_featured_slider' ) ) :

    function medical_circle_featured_slider() {
        global $medical_circle_customizer_all_values;

        $medical_circle_enable_feature = $medical_circle_customizer_all_values['medical-circle-enable-feature'];
        if( is_front_page() && 1 == $medical_circle_enable_feature && !is_home() ) :
            do_action( 'medical_circle_action_feature_slider' );
        endif;
    }
endif;
add_action( 'medical_circle_action_front_page', 'medical_circle_featured_slider', 10 );

if ( ! function_exists( 'medical_circle_front_page' ) ) :

    function medical_circle_front_page() {
        global $medical_circle_customizer_all_values;

        $medical_circle_hide_front_page_content = $medical_circle_customizer_all_values['medical-circle-hide-front-page-content'];

        /*show widget in front page, now user are not force to use front page*/
        if( is_active_sidebar( 'medical-circle-home' ) && !is_home() ){
            dynamic_sidebar( 'medical-circle-home' );
        }
        if ( 'posts' == get_option( 'show_on_front' ) ) {
            include( get_home_template() );
        }
        else {
            if( 1 != $medical_circle_hide_front_page_content ){
                include( get_page_template() );
            }
        }
    }
endif;
add_action( 'medical_circle_action_front_page', 'medical_circle_front_page', 20 );