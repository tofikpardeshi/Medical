<?php
/*adding footer options panel*/
$wp_customize->add_panel( 'medical-circle-footer-panel', array(
    'priority'       => 80,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Footer Options', 'medical-circle' ),
    'description'    => __( 'Customize your awesome site footer ', 'medical-circle' )
) );

/*
* file for full with footer options
*/
require medical_circle_file_directory('acmethemes/customizer/footer-options/full-width.php');

/*
* file for footer logo options
*/
require medical_circle_file_directory('acmethemes/customizer/footer-options/footer-copyright.php');