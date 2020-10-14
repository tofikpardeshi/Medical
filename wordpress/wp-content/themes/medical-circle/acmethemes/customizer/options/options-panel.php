<?php
/*adding theme options panel*/
$wp_customize->add_panel( 'medical-circle-options', array(
    'priority'       => 90,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Theme Options', 'medical-circle' ),
    'description'    => __( 'Customize your awesome site with theme options ', 'medical-circle' )
) );

/*
* file for header breadcrumb options
*/
require medical_circle_file_directory('acmethemes/customizer/options/breadcrumb.php');

/*
* file for header search options
*/
require medical_circle_file_directory('acmethemes/customizer/options/search.php');

/*
* file for appointment form
*/
require medical_circle_file_directory('acmethemes/customizer/options/appointment-form.php');

/*
* file for social options
*/
require medical_circle_file_directory('acmethemes/customizer/options/social-options.php');