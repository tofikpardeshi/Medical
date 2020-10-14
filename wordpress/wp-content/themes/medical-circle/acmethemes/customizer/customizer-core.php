<?php
/**
 * Header top display options of elements
 *
 * @since Medical Circle 1.0.0
 *
 * @param null
 * @return array $medical_circle_header_top_display_selection
 *
 */
if ( !function_exists('medical_circle_header_top_display_selection') ) :
	function medical_circle_header_top_display_selection() {
		$medical_circle_header_top_display_selection =  array(
			'hide' => __( 'Hide', 'medical-circle' ),
			'left' => __( 'on Top Left', 'medical-circle' ),
			'right' => __( 'on Top Right', 'medical-circle' )
		);
		return apply_filters( 'medical_circle_header_top_display_selection', $medical_circle_header_top_display_selection );
	}
endif;

/**
 * Header Basic Info display Options
 *
 * @since Medical Circle 1.0.0
 *
 * @param null
 * @return array $medical_circle_header_bi_display_options
 *
 */
if ( !function_exists('medical_circle_header_bi_display_options') ) :
	function medical_circle_header_bi_display_options() {
		$medical_circle_header_bi_display_options =  array(
			'hide' => __( 'Hide', 'medical-circle' ),
			'before-menu' => __( 'Before Menu', 'medical-circle' ),
			'after-menu' => __( 'After Menu', 'medical-circle' )
		);
		return apply_filters( 'medical_circle_header_bi_display_options', $medical_circle_header_bi_display_options );
	}
endif;

/**
 * Header Basic Info number
 *
 * @since Medical Circle 1.0.0
 *
 * @param null
 * @return array $medical_circle_header_bi_number
 *
 */
if ( !function_exists('medical_circle_header_bi_number') ) :
	function medical_circle_header_bi_number() {
		$medical_circle_header_bi_number =  array(
			1 => __( '1', 'medical-circle' ),
			2 => __( '2', 'medical-circle' ),
			3 => __( '3', 'medical-circle' ),
			4 => __( '4', 'medical-circle' ),
		);
		return apply_filters( 'medical_circle_header_bi_number', $medical_circle_header_bi_number );
	}
endif;

/**
 * Footer full width options
 *
 * @since Medical Circle 1.0.0
 *
 * @param null
 * @return array $medical_circle_footer_full_width_display_options
 *
 */
if ( !function_exists('medical_circle_footer_full_width_display_options') ) :
	function medical_circle_footer_full_width_display_options() {
		$medical_circle_footer_full_width_display_options =  array(
			'hide' => __( 'Hide', 'medical-circle' ),
			'top' => __( 'Top Footer', 'medical-circle' ),
			'bottom' => __( 'Bottom Footer', 'medical-circle' )
		);
		return apply_filters( 'medical_circle_footer_full_width_display_options', $medical_circle_footer_full_width_display_options );
	}
endif;

/**
 * Footer copyright beside options
 *
 * @since Medical Circle 1.0.0
 *
 * @param null
 * @return array $medical_circle_footer_copyright_beside_option
 *
 */
if ( !function_exists('medical_circle_footer_copyright_beside_option') ) :
	function medical_circle_footer_copyright_beside_option() {
		$medical_circle_footer_copyright_beside_option =  array(
			'hide' => __( 'Hide', 'medical-circle' ),
			'social' => __( 'Social Links', 'medical-circle' ),
			'footer-menu' => __( 'Footer Menu', 'medical-circle' )
		);
		return apply_filters( 'medical_circle_footer_copyright_beside_option', $medical_circle_footer_copyright_beside_option );
	}
endif;

/**
 * medical_circle_menu_right_button_link_options
 *
 * @since Medical Circle 1.0.0
 *
 * @param null
 * @return array $medical_circle_menu_right_button_link_options
 *
 */
if ( !function_exists('medical_circle_menu_right_button_link_options') ) :
	function medical_circle_menu_right_button_link_options() {
		$medical_circle_menu_right_button_link_options =  array(
			'disable' => __( 'Disable', 'medical-circle' ),
			'appointment' => __( 'Open Appointment Form', 'medical-circle' ),
			'link' => __( 'One Link', 'medical-circle' )
		);
		return apply_filters( 'medical_circle_menu_right_button_link_options', $medical_circle_menu_right_button_link_options );
	}
endif;

/**
 * Feature slider selection
 *
 * @since Mercantile 1.0.0
 *
 * @param null
 * @return array $medical_circle_slider_text_align
 *
 */
if ( !function_exists('medical_circle_slider_text_align') ) :
	function medical_circle_slider_text_align() {
		$medical_circle_slider_text_align =  array(
			'alternate'   => __( 'Alternate', 'medical-circle' ),
			'text-left'   => __( 'Left', 'medical-circle' ),
			'text-right'  => __( 'Right', 'medical-circle' ),
			'text-center' => __( 'Center', 'medical-circle' )
		);
		return apply_filters( 'medical_circle_slider_text_align', $medical_circle_slider_text_align );
	}
endif;

/**
 * Featured Slider Image Options
 *
 * @since Medical Circle 1.0.0
 *
 * @param null
 * @return array $medical_circle_fs_image_display_options
 *
 */
if ( !function_exists('medical_circle_fs_image_display_options') ) :
    function medical_circle_fs_image_display_options() {
        $medical_circle_fs_image_display_options =  array(
            'full-screen-bg' => __( 'Full Screen Background', 'medical-circle' ),
            'responsive-img' => __( 'Responsive Image', 'medical-circle' )
        );
        return apply_filters( 'medical_circle_fs_image_display_options', $medical_circle_fs_image_display_options );
    }
endif;

/**
 * Sidebar layout options
 *
 * @since Medical Circle 1.0.0
 *
 * @param null
 * @return array $medical_circle_sidebar_layout
 *
 */
if ( !function_exists('medical_circle_sidebar_layout') ) :
    function medical_circle_sidebar_layout() {
        $medical_circle_sidebar_layout =  array(
            'right-sidebar'=> __( 'Right Sidebar', 'medical-circle' ),
            'left-sidebar'=> __( 'Left Sidebar' , 'medical-circle' ),
            'both-sidebar'  => __( 'Both Sidebar' , 'medical-circle' ),
            'middle-col'  => __( 'Middle Column' , 'medical-circle' ),
            'no-sidebar'=> __( 'No Sidebar', 'medical-circle' )
        );
        return apply_filters( 'medical_circle_sidebar_layout', $medical_circle_sidebar_layout );
    }
endif;

/**
 * Blog layout options
 *
 * @since Medical Circle 1.0.0
 *
 * @param null
 * @return array $medical_circle_blog_layout
 *
 */
if ( !function_exists('medical_circle_blog_layout') ) :
    function medical_circle_blog_layout() {
        $medical_circle_blog_layout =  array(
            'left-image' => __( 'Show Image', 'medical-circle' ),
            'no-image' => __( 'No Image', 'medical-circle' )
        );
        return apply_filters( 'medical_circle_blog_layout', $medical_circle_blog_layout );
    }
endif;

/**
 *  Default Theme layout options
 *
 * @since Medical Circle 1.0.0
 *
 * @param null
 * @return array $medical_circle_theme_layout
 *
 */
if ( !function_exists('medical_circle_get_default_theme_options') ) :
    function medical_circle_get_default_theme_options() {

        $default_theme_options = array(

	        /*basic info*/
	        'medical-circle-header-bi-display-options'  => 'hide',
	        'medical-circle-header-bi-number'  => 4,
	        'medical-circle-first-info-icon'  => 'fa-volume-control-phone',
	        'medical-circle-first-info-title'  => __('Emergency 24 Hours', 'medical-circle'),
	        'medical-circle-first-info-desc'  => __('01-123-223-4567', 'medical-circle'),
	        'medical-circle-second-info-icon'  => 'fa-envelope-o',
	        'medical-circle-second-info-title'  => __('Send us a Mail', 'medical-circle'),
	        'medical-circle-second-info-desc'  => __('email@mydomain.com', 'medical-circle'),
	        'medical-circle-third-info-icon'  => 'fa-map-marker',
	        'medical-circle-third-info-title'  => __('Our Location', 'medical-circle'),
	        'medical-circle-third-info-desc'  => __('Elmonte California', 'medical-circle'),
	        'medical-circle-forth-info-icon'  => 'fa-clock-o',
	        'medical-circle-forth-info-title'  => __('Working Hours', 'medical-circle'),
	        'medical-circle-forth-info-desc'  => __('Mon - Sun 08:00 19:00', 'medical-circle'),

	        /*logo and site title*/
	        'medical-circle-display-site-logo'  => '',
	        'medical-circle-display-site-title'  => 1,
	        'medical-circle-display-site-tagline'  => 1,

	        /*header height*/
	        'medical-circle-header-height'  => 300,

            /*header top*/
            'medical-circle-enable-header-top'  => '',
	        'medical-circle-header-top-menu-display-selection'  => 'right',
	        'medical-circle-header-top-news-display-selection'  => 'left',
	        'medical-circle-header-top-social-display-selection'  => 'right',
            'medical-circle-newsnotice-title'  => __( 'News', 'medical-circle' ),
            'medical-circle-newsnotice-cat'  => 0,

	        /*menu options*/
            'medical-circle-enable-sticky'  => 1,
            'medical-circle-menu-right-button-options'  => 'appointment',
            'medical-circle-menu-right-button-title'  => __('Book Appointment','medical-circle'),
            'medical-circle-menu-right-button-link'  => '',

	        /*feature section options*/
	        'medical-circle-enable-feature'  => '',
            'medical-circle-feature-column-1'  => 0,
            'medical-circle-feature-column-2'  => 0,
            'medical-circle-feature-column-3'  => 0,
            'medical-circle-feature-column-1-color'  => '#5eb8e4',
            'medical-circle-feature-column-2-color'  => '#009ddb',
            'medical-circle-feature-column-3-color'  => '#088edd',
	        'medical-circle-slides-data'  => '',
            'medical-circle-feature-slider-enable-animation'  => 1,
            'medical-circle-feature-slider-display-title'  => 1,
            'medical-circle-feature-slider-display-excerpt'  => 1,
            'medical-circle-fs-image-display-options'  => 'full-screen-bg',
            'medical-circle-feature-slider-text-align'  => 'text-center',

            /*footer options*/
            'medical-circle-footer-copyright'  => __( '&copy; All right reserved 2017', 'medical-circle' ),
	        'medical-circle-footer-copyright-beside-option'  => 'footer-menu',
	        'medical-circle-footer-full-width-display-options'  => 'hide',
	        'medical-circle-footer-enable-social'  => 1,
	        'medical-circle-footer-bi-number'  => 3,
	        'medical-circle-enable-footer-power-text'  => 1,

	        /*layout/design options*/
	        'medical-circle-enable-animation'  => '',

	        'medical-circle-single-sidebar-layout'  => 'right-sidebar',
            'medical-circle-front-page-sidebar-layout'  => 'right-sidebar',
            'medical-circle-archive-sidebar-layout'  => 'right-sidebar',

            'medical-circle-blog-archive-layout'  => 'left-image',
	        'medical-circle-blog-archive-more-text'  => __( 'Read More', 'medical-circle' ),

	        'medical-circle-primary-color'  => '#00a4ef',
            'medical-circle-header-top-bg-color'  => '#088edd',
            'medical-circle-footer-bg-color'  => '#3a3a3a',
            'medical-circle-footer-bottom-bg-color'  => '#2d2d2d',

            'medical-circle-hide-front-page-content'  => '',
            'medical-circle-hide-front-page-header'  => '',

            /*theme options*/
            'medical-circle-appointment-form-title'  => __( 'Make Appointment', 'medical-circle' ),
            'medical-circle-appointment-form-shortcode'  => '',
	        'medical-circle-show-breadcrumb'  => 0,
            'medical-circle-search-placholder'  => __( 'Search', 'medical-circle' ),
            'medical-circle-social-data'  => '',

	          /*woocommerce*/
	        'medical-circle-wc-shop-archive-sidebar-layout'     => 'no-sidebar',
	        'medical-circle-wc-product-column-number'           => 4,
	        'medical-circle-wc-shop-archive-total-product'      => 16,
	        'medical-circle-wc-single-product-sidebar-layout'   => 'no-sidebar',
        );

        return apply_filters( 'medical_circle_default_theme_options', $default_theme_options );
    }
endif;

/**
 *  Get theme options
 *
 * @since Medical Circle 1.0.0
 *
 * @param null
 * @return array medical_circle_theme_options
 *
 */
if ( !function_exists('medical_circle_get_theme_options') ) :
    function medical_circle_get_theme_options() {

        $medical_circle_default_theme_options = medical_circle_get_default_theme_options();
        $medical_circle_get_theme_options = get_theme_mod( 'medical_circle_theme_options');
        if( is_array( $medical_circle_get_theme_options )){
            return array_merge( $medical_circle_default_theme_options ,$medical_circle_get_theme_options );
        }
        else{
            return $medical_circle_default_theme_options;
        }
    }
endif;