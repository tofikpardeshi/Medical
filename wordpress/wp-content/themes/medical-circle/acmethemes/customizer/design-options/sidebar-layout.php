<?php
/*adding sections for sidebar options */
$wp_customize->add_section( 'medical-circle-design-sidebar-layout-option', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Default Page/Post Sidebar Layout', 'medical-circle' ),
    'panel'          => 'medical-circle-design-panel'
) );

/*Sidebar Layout*/
$wp_customize->add_setting( 'medical_circle_theme_options[medical-circle-single-sidebar-layout]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['medical-circle-single-sidebar-layout'],
    'sanitize_callback' => 'medical_circle_sanitize_select'
) );
$choices = medical_circle_sidebar_layout();
$wp_customize->add_control( 'medical_circle_theme_options[medical-circle-single-sidebar-layout]', array(
    'choices'  	=> $choices,
    'label'		=> __( 'Default Page/Post Sidebar Layout', 'medical-circle' ),
    'description'=> __( 'Single Page/Post Sidebar', 'medical-circle' ),
    'section'   => 'medical-circle-design-sidebar-layout-option',
    'settings'  => 'medical_circle_theme_options[medical-circle-single-sidebar-layout]',
    'type'	  	=> 'select'
) );