<?php
/*adding sections for header options panel*/
$wp_customize->add_section( 'medical-circle-animation', array(
    'priority'       => 2,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Animation', 'medical-circle' ),
    'panel'          => 'medical-circle-design-panel'
) );

/*header logo text display options*/
$wp_customize->add_setting( 'medical_circle_theme_options[medical-circle-enable-animation]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['medical-circle-enable-animation'],
    'sanitize_callback' => 'medical_circle_sanitize_checkbox'
) );
$wp_customize->add_control( 'medical_circle_theme_options[medical-circle-enable-animation]', array(
    'label'		=> __( 'Disable animation', 'medical-circle' ),
    'description'   => __( 'Check this to disable overall site animation effect provided by theme', 'medical-circle' ),
    'section'   => 'medical-circle-animation',
    'settings'  => 'medical_circle_theme_options[medical-circle-enable-animation]',
    'type'	  	=> 'checkbox'
) );