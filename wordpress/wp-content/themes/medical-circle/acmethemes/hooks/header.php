<?php
/**
 * Setting global variables for all theme options saved values
 *
 * @since Medical Circle 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'medical_circle_set_global' ) ) :
    function medical_circle_set_global() {
        /*Getting saved values start*/
        $medical_circle_saved_theme_options = medical_circle_get_theme_options();
        $GLOBALS['medical_circle_customizer_all_values'] = $medical_circle_saved_theme_options;
        /*Getting saved values end*/
    }
endif;
add_action( 'medical_circle_action_before_head', 'medical_circle_set_global', 0 );

/**
 * Doctype Declaration
 *
 * @since Medical Circle 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'medical_circle_doctype' ) ) :
    function medical_circle_doctype() {
        ?><!DOCTYPE html><html <?php language_attributes(); ?>>
        <?php
    }
endif;
add_action( 'medical_circle_action_before_head', 'medical_circle_doctype', 10 );

/**
 * Code inside head tage but before wp_head funtion
 *
 * @since Medical Circle 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'medical_circle_before_wp_head' ) ) :

    function medical_circle_before_wp_head() {
        ?>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="//gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
        <?php
    }
endif;
add_action( 'medical_circle_action_before_wp_head', 'medical_circle_before_wp_head', 10 );

/**
 * Add body class
 *
 * @since Medical Circle 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'medical_circle_body_class' ) ) :

    function medical_circle_body_class( $medical_circle_body_classes ) {

        global $medical_circle_customizer_all_values;
        $medical_circle_enable_animation = $medical_circle_customizer_all_values['medical-circle-enable-animation'];
        /*wow animation*/
        if( 1 != $medical_circle_enable_animation ){
            $medical_circle_body_classes[] = 'acme-animate';
        }
        $medical_circle_body_classes[] = medical_circle_sidebar_selection();

        return $medical_circle_body_classes;

    }
endif;
add_action( 'body_class', 'medical_circle_body_class', 10, 1);

/**
 * Start site div
 *
 * @since Medical Circle 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'medical_circle_site_start' ) ) :

    function medical_circle_site_start() {
        ?>
        <div class="site" id="page">
        <?php
    }
endif;
add_action( 'medical_circle_action_before', 'medical_circle_site_start', 20 );

/**
 * Skip to content
 *
 * @since Medical Circle 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'medical_circle_skip_to_content' ) ) :

    function medical_circle_skip_to_content() {
        ?>
        <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'medical-circle' ); ?></a>
        <?php
    }
endif;
add_action( 'medical_circle_action_before_header', 'medical_circle_skip_to_content', 10 );

/**
 * Main header
 *
 * @since Medical Circle 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'medical_circle_header' ) ) :
    function medical_circle_header() {
        global $medical_circle_customizer_all_values;
        $medical_circle_enable_header_top = $medical_circle_customizer_all_values['medical-circle-enable-header-top'];
        if( 1 == $medical_circle_enable_header_top ){
            ?>
            <div class="top-header">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6 text-left">
                            <?php
                                $medical_circle_header_top_menu_display_selection = $medical_circle_customizer_all_values['medical-circle-header-top-menu-display-selection'];
                                $medical_circle_header_top_news_display_selection = $medical_circle_customizer_all_values['medical-circle-header-top-news-display-selection'];
                                $medical_circle_header_top_social_display_selection = $medical_circle_customizer_all_values['medical-circle-header-top-social-display-selection'];

                                if( 'left' == $medical_circle_header_top_menu_display_selection ){
                                    do_action('medical_circle_action_top_menu');
                                }
                                if( 'left' == $medical_circle_header_top_social_display_selection ){
                                    do_action('medical_circle_action_social_links');
                                }
                                if( 'left' == $medical_circle_header_top_news_display_selection ){
                                    do_action('medical_circle_action_newsnotice');
                                }
                            ?>
                        </div>
                        <div class="col-sm-6 text-right">
                            <?php
                                if( 'right' == $medical_circle_header_top_menu_display_selection ){
                                    do_action('medical_circle_action_top_menu');
                                }
                                if( 'right' == $medical_circle_header_top_social_display_selection ){
                                    do_action('medical_circle_action_social_links');
                                }
                                if( 'right' == $medical_circle_header_top_news_display_selection ){
                                    do_action('medical_circle_action_newsnotice');
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
         $medical_circle_nav_class = '';
         $medical_circle_enable_sticky = $medical_circle_customizer_all_values['medical-circle-enable-sticky'];
         if( 1 == $medical_circle_enable_sticky ){
            $medical_circle_nav_class .= ' medical-circle-sticky';
         }

         $medical_circle_header_bi_display_options = $medical_circle_customizer_all_values['medical-circle-header-bi-display-options'];
         $medical_circle_header_bi_number = $medical_circle_customizer_all_values['medical-circle-header-bi-number'];
         if( 'before-menu' == $medical_circle_header_bi_display_options ){
             echo '<div class="info-icon-box-wrapper at-gray-bg hidden-sm hidden-xs"><div class="container">';
             do_action('medical_circle_action_basic_info', $medical_circle_header_bi_number, $medical_circle_header_bi_number );
             echo "</div></div>";
         }
        ?>
        <div class="navbar at-navbar <?php echo $medical_circle_nav_class; ?>" id="navbar" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><i class="fa fa-bars"></i></button>
                    <?php
                    $medical_circle_display_site_logo = $medical_circle_customizer_all_values['medical-circle-display-site-logo'];
	                $medical_circle_display_site_title = $medical_circle_customizer_all_values['medical-circle-display-site-title'];
	                $medical_circle_display_site_tagline = $medical_circle_customizer_all_values['medical-circle-display-site-tagline'];
	                
                    if( 1== $medical_circle_display_site_logo || 1 == $medical_circle_display_site_title || 1 == $medical_circle_display_site_tagline ):
                        if ( 1 == $medical_circle_display_site_logo && function_exists( 'the_custom_logo' ) ):
                            the_custom_logo();
                        endif;
                        if ( 1== $medical_circle_display_site_title  ):
                            if ( is_front_page() && is_home() ) : ?>
                                <h1 class="site-title">
                                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
                                </h1>
                            <?php else : ?>
                                <p class="site-title">
                                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
                                </p>
                            <?php endif;
                        endif;
                        if ( 1== $medical_circle_display_site_tagline  ):
                            $description = get_bloginfo( 'description', 'display' );
                            if ( $description || is_customize_preview() ) : ?>
                                <p class="site-description"><?php echo esc_html( $description ); ?></p>
                            <?php endif;
                        endif;
                    endif;
                    ?>
                </div>
                <?php
                $medical_circle_menu_right_button_link_options = $medical_circle_customizer_all_values['medical-circle-menu-right-button-options'];
                    $medical_circle_button_title = $medical_circle_customizer_all_values['medical-circle-menu-right-button-title'];
                    $medical_circle_button_link = $medical_circle_customizer_all_values['medical-circle-menu-right-button-link'];
                    if( 'disable' != $medical_circle_menu_right_button_link_options ){
                        $medical_circle_button_title = !empty( $medical_circle_button_title )?$medical_circle_button_title:__('Book Appointment','medical-circle');
                        if( 'appointment' == $medical_circle_menu_right_button_link_options ){
                          ?>
                           <a class="featured-button btn btn-primary hidden-xs hidden-sm hidden-xs" href="#" data-toggle="modal" data-target="#at-shortcode-bootstrap-modal"><?php echo esc_html( $medical_circle_button_title ); ?></a>
                          <?php
                        }
                        else{
                        ?>
                            <a class="featured-button btn btn-primary hidden-xs hidden-sm hidden-xs" href="<?php echo esc_url( $medical_circle_button_link ); ?>"><?php echo esc_html( $medical_circle_button_title ); ?></a>
                        <?php
                        }
                    }
                ?>
                <div class="main-navigation navbar-collapse collapse">
                    <?php
                    if( is_front_page() && !is_home() && has_nav_menu( 'one-page') ){
                        wp_nav_menu(
                            array(
                                'theme_location' => 'one-page',
                                'menu_id' => 'primary-menu',
                                'menu_class' => 'nav navbar-nav navbar-right acme-one-page',
                                'container' => false,
                            )
                        );
                    }
                    else{
                         wp_nav_menu(
                            array(
                                'theme_location' => 'primary',
                                'menu_id' => 'primary-menu',
                                'menu_class' => 'nav navbar-nav navbar-right acme-normal-page',
                                'container' => false
                            )
                        );
                    }

                   ?>
                </div><!--/.nav-collapse -->
            </div>
        </div>
        <?php

        if( 'after-menu' == $medical_circle_header_bi_display_options ){
             echo '<div class="info-icon-box-wrapper at-gray-bg hidden-sm hidden-xs"><div class="container">';
             do_action('medical_circle_action_basic_info', $medical_circle_header_bi_number, $medical_circle_header_bi_number );
             echo "</div></div>";
         }
    }
endif;
add_action( 'medical_circle_action_header', 'medical_circle_header', 10 );