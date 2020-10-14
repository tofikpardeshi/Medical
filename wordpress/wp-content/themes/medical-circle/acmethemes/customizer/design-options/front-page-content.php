<?php
/*active callback function for front-page-header*/
if ( !function_exists('medical_circle_active_callback_front_page_header') ) :
    function medical_circle_active_callback_front_page_header() {
        $medical_circle_customizer_all_values = medical_circle_get_theme_options();
        if( 1 != $medical_circle_customizer_all_values['medical-circle-hide-front-page-content'] ){
            return true;
        }
        return false;
    }
endif;

/*adding sections for footer social options */
$wp_customize->add_section( 'medical-circle-front-page-content', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Front Page Content Options', 'medical-circle' ),
    'panel'          => 'medical-circle-design-panel'
) );

/*hide front page content*/
$wp_customize->add_setting( 'medical_circle_theme_options[medical-circle-hide-front-page-content]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['medical-circle-hide-front-page-content'],
    'sanitize_callback' => 'medical_circle_sanitize_checkbox',
) );
$wp_customize->add_control( 'medical_circle_theme_options[medical-circle-hide-front-page-content]', array(
    'label'		 => __( 'Hide Front Page Content', 'medical-circle' ),
    'description'=> __( 'You may want to hide front page content and want to show only Feature section and Home Widgets. Check this to hide front page content.', 'medical-circle' ),
    'section'   => 'medical-circle-front-page-content',
    'settings'  => 'medical_circle_theme_options[medical-circle-hide-front-page-content]',
    'type'	  	=> 'checkbox',
    'priority'  => 10
) );

/*hide front page content*/
$wp_customize->add_setting( 'medical_circle_theme_options[medical-circle-hide-front-page-header]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['medical-circle-hide-front-page-header'],
    'sanitize_callback' => 'medical_circle_sanitize_checkbox',
) );
$wp_customize->add_control( 'medical_circle_theme_options[medical-circle-hide-front-page-header]', array(
    'label'		 => __( 'Hide Front Page Header', 'medical-circle' ),
    'description'=> __( 'You may want to hide front page header and want to show only Feature section and Home Widgets. Check this to hide front page Header.', 'medical-circle' ),
    'section'   => 'medical-circle-front-page-content',
    'settings'  => 'medical_circle_theme_options[medical-circle-hide-front-page-header]',
    'type'	  	=> 'checkbox',
    'priority'  => 20,
    'active_callback'   => 'medical_circle_active_callback_front_page_header'
) );