<?php
/*adding feature options panel*/
$wp_customize->add_panel( 'medical-circle-feature-panel', array(
    'priority'       => 40,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Featured Section Options', 'medical-circle' ),
    'description'    => __( 'Customize your awesome site feature section ', 'medical-circle' )
) );

/*
* file for feature section enable
*/
require medical_circle_file_directory('acmethemes/customizer/feature-section/feature-enable.php');

/*
* file for feature slider category
*/
require medical_circle_file_directory('acmethemes/customizer/feature-section/feature-slider.php');

/*
* file for feature slider category
*/
require medical_circle_file_directory('acmethemes/customizer/feature-section/feature-columns.php');