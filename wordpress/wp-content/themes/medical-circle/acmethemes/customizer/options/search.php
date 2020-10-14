<?php
/*adding sections for Search Placeholder*/
$wp_customize->add_section( 'medical-circle-search', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Search', 'medical-circle' ),
    'panel'          => 'medical-circle-options'
) );

/*Search Placeholder*/
$wp_customize->add_setting( 'medical_circle_theme_options[medical-circle-search-placholder]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['medical-circle-search-placholder'],
    'sanitize_callback' => 'sanitize_text_field'
) );
$wp_customize->add_control( 'medical_circle_theme_options[medical-circle-search-placholder]', array(
    'label'		=> __( 'Search Placeholder', 'medical-circle' ),
    'section'   => 'medical-circle-search',
    'settings'  => 'medical_circle_theme_options[medical-circle-search-placholder]',
    'type'	  	=> 'text',
    'priority'  => 10
) );