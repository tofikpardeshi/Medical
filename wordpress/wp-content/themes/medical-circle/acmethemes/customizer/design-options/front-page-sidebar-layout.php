<?php
/*adding sections for default layout options panel*/
$wp_customize->add_section( 'medical-circle-front-page-sidebar-layout', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Front/Home Sidebar Layout', 'medical-circle' ),
    'panel'          => 'medical-circle-design-panel'
) );

/*Sidebar Layout*/
$wp_customize->add_setting( 'medical_circle_theme_options[medical-circle-front-page-sidebar-layout]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['medical-circle-front-page-sidebar-layout'],
    'sanitize_callback' => 'medical_circle_sanitize_select'
) );
$choices = medical_circle_sidebar_layout();
$wp_customize->add_control( 'medical_circle_theme_options[medical-circle-front-page-sidebar-layout]', array(
    'choices'  	=> $choices,
    'label'		=> __( 'Front/Home Sidebar Layout', 'medical-circle' ),
    'section'   => 'medical-circle-front-page-sidebar-layout',
    'settings'  => 'medical_circle_theme_options[medical-circle-front-page-sidebar-layout]',
    'type'	  	=> 'select'
) );