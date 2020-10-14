<?php
/*adding header options panel*/
$wp_customize->add_panel( 'medical-circle-header-panel', array(
    'priority'       => 30,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Header Options', 'medical-circle' ),
    'description'    => __( 'Customize your awesome site header ', 'medical-circle' )
) );

/*
* file for header top options
*/
require medical_circle_file_directory('acmethemes/customizer/header-options/header-top.php');

/*
* file for header logo options
*/
require medical_circle_file_directory('acmethemes/customizer/header-options/header-logo.php');

/*
* file for basic info
*/
require medical_circle_file_directory('acmethemes/customizer/header-options/basic-info.php');

/*
 * file for menu options
*/
require medical_circle_file_directory('acmethemes/customizer/header-options/menu-options.php');

/*adding header image inside this panel*/
$wp_customize->get_section( 'header_image' )->panel = 'medical-circle-header-panel';
$wp_customize->get_section( 'header_image' )->description = __( 'Applied to header image of inner pages.', 'medical-circle' );

/* feature section height*/
$wp_customize->add_setting( 'medical_circle_theme_options[medical-circle-header-height]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['medical-circle-header-height'],
    'sanitize_callback' => 'medical_circle_sanitize_number'
) );

$wp_customize->add_control( 'medical_circle_theme_options[medical-circle-header-height]', array(
    'type'        => 'range',
    'priority'    => 1,
    'section'     => 'header_image',
    'label'		  => __( 'Inner Page Header Section Height', 'medical-circle' ),
    'description' => __( 'Control the height of Header section. The minimum height is 100px and maximium height is 500px', 'medical-circle' ),
    'input_attrs' => array(
        'min'   => 100,
        'max'   => 500,
        'step'  => 1,
        'class' => 'medical-circle-header-height',
        'style' => 'color: #0a0',
    )
) );