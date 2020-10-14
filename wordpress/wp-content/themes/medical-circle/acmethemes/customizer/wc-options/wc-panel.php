<?php
/*adding theme options panel*/
$wp_customize->add_panel( 'medical-circle-wc-panel', array(
	'priority'       => 100,
	'capability'     => 'edit_theme_options',
	'title'          => esc_html__( 'WooCommerce Options', 'medical-circle' )
) );

/*
* file for shop archive
*/
require_once medical_circle_file_directory('acmethemes/customizer/wc-options/shop-archive.php');

/*
* file for single product
*/
require_once medical_circle_file_directory('acmethemes/customizer/wc-options/single-product.php');