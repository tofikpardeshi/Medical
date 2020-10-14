<?php
/*adding theme options panel*/
$wp_customize->add_panel( 'medical-circle-design-panel', array(
    'priority'       => 80,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Layout/Design Option', 'medical-circle' )
) );

$wp_customize->get_section( 'background_image' )->panel = 'medical-circle-design-panel';
$wp_customize->get_section( 'background_image' )->priority = 50;

/*
* file for animation options
*/
require medical_circle_file_directory('acmethemes/customizer/design-options/animation.php');

/*
* file for front page hiding content
*/
require medical_circle_file_directory('acmethemes/customizer/design-options/front-page-content.php');

/*
* file for sidebar layout
*/
require medical_circle_file_directory('acmethemes/customizer/design-options/sidebar-layout.php');

/*
* file for front page sidebar layout options
*/
require medical_circle_file_directory('acmethemes/customizer/design-options/front-page-sidebar-layout.php');

/*
* file for front archive sidebar layout options
*/
require medical_circle_file_directory('acmethemes/customizer/design-options/archive-sidebar-layout.php');

/*
* file for blog layout
*/
require medical_circle_file_directory('acmethemes/customizer/design-options/blog-layout.php');

/*
* file for color options
*/
require medical_circle_file_directory('acmethemes/customizer/design-options/colors-options.php');