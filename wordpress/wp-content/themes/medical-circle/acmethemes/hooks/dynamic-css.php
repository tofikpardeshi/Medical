<?php
/**
 * Dynamic css
 *
 * @since Medical Circle 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'medical_circle_dynamic_css' ) ) :

    function medical_circle_dynamic_css() {

        global $medical_circle_customizer_all_values;
        /*Color options */
        $medical_circle_header_height = esc_attr( $medical_circle_customizer_all_values['medical-circle-header-height'] );
        $medical_circle_primary_color = esc_attr( $medical_circle_customizer_all_values['medical-circle-primary-color'] );
        $medical_circle_header_top_bg_color = esc_attr( $medical_circle_customizer_all_values['medical-circle-header-top-bg-color'] );
        $medical_circle_footer_bg_color = esc_attr( $medical_circle_customizer_all_values['medical-circle-footer-bg-color'] );
        $medical_circle_footer_bottom_bg_color = esc_attr( $medical_circle_customizer_all_values['medical-circle-footer-bottom-bg-color'] );

        /*animation*/
        $medical_circle_enable_animation = $medical_circle_customizer_all_values['medical-circle-enable-animation'];

        $custom_css = '';
        /*animation*/
        if( 1 == $medical_circle_enable_animation ){
            $custom_css .= "
             .init-animate {
                visibility: visible !important;
             }
             ";
        }
        /*background*/
        $bg_image_url ='';
        if( get_header_image() ){
            $bg_image_url = esc_url( get_header_image() );
        }
        $custom_css .= "
              .inner-main-title {
                background-image:url('{$bg_image_url}');
                background-repeat:no-repeat;
                background-size:cover;
                background-attachment:fixed;
                background-position: center; 
                height: {$medical_circle_header_height}px;
            }";

        /*color*/
        $custom_css .= "
            .top-header,
            article.post .entry-header .year,
            .wpcf7-form input.wpcf7-submit ::before ,
            .btn-primary::before {
                background-color: {$medical_circle_header_top_bg_color};
            }";
        $custom_css .= "
            .site-footer{
                background-color: {$medical_circle_footer_bg_color};
            }";
        $custom_css .= "
            .copy-right{
                background-color: {$medical_circle_footer_bottom_bg_color};
            }";
        $custom_css .= "
	        .site-title,
	        .site-title a,
	        .site-description,
	        .site-description a,
            a:hover,
            a:active,
            a:focus,
            .widget li a:hover,
            .posted-on a:hover,
            .author.vcard a:hover,
            .cat-links a:hover,
            .comments-link a:hover,
            .edit-link a:hover,
            .tags-links a:hover,
            .byline a:hover,
            .main-navigation .acme-normal-page .current_page_item a,
            .main-navigation .acme-normal-page .current-menu-item a,
            .main-navigation .active a,
            .main-navigation .navbar-nav >li a:hover,
            .team-item h3 a:hover,
            .news-notice-content .news-content a:hover,
            .single-item .fa,
            .department-title-wrapper .department-title.active a,
			.department-title-wrapper .department-title.active a i,
			.department-title-wrapper .department-title:hover a,
			 .at-social .socials li a{
                color: {$medical_circle_primary_color};
            }";

        /*background color*/
        $custom_css .= "
            .navbar .navbar-toggle:hover,
            .main-navigation .current_page_ancestor > a:before,
            .comment-form .form-submit input,
            .btn-primary,
            .line > span,
            .wpcf7-form input.wpcf7-submit,
            .wpcf7-form input.wpcf7-submit:hover,
            i.slick-arrow:hover,
            article.post .entry-header,
            .sm-up-container,
            .btn-primary.btn-reverse:before,
            #at-shortcode-bootstrap-modal .modal-header{
                background-color: {$medical_circle_primary_color};
                color:#fff;
            }";

        /*borders*/
        $custom_css .= "
            .blog article.sticky{
                border: 2px solid {$medical_circle_primary_color};
            }";
        wp_add_inline_style( 'medical-circle-style', $custom_css );
    }
endif;
add_action( 'wp_enqueue_scripts', 'medical_circle_dynamic_css', 99 );