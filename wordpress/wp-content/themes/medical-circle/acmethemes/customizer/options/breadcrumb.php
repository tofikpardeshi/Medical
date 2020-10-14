<?php
/*adding sections for breadcrumb */
$wp_customize->add_section( 'medical-circle-breadcrumb-options', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Breadcrumb Options', 'medical-circle' ),
    'panel'          => 'medical-circle-options'
) );

/*show breadcrumb*/
$wp_customize->add_setting( 'medical_circle_theme_options[medical-circle-show-breadcrumb]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['medical-circle-show-breadcrumb'],
    'sanitize_callback' => 'medical_circle_sanitize_checkbox'
) );

$wp_customize->add_control( 'medical_circle_theme_options[medical-circle-show-breadcrumb]', array(
    'label'		=> __( 'Enable Breadcrumb', 'medical-circle' ),
    'section'   => 'medical-circle-breadcrumb-options',
    'settings'  => 'medical_circle_theme_options[medical-circle-show-breadcrumb]',
    'type'	  	=> 'checkbox',
    'priority'  => 10
) );