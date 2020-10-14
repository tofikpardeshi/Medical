<?php
/*adding sections for sidebar options */
$wp_customize->add_section( 'medical-circle-wc-single-product-options', array(
	'priority'       => 20,
	'capability'     => 'edit_theme_options',
	'title'          => esc_html__( 'Single Product', 'medical-circle' ),
	'panel'          => 'medical-circle-wc-panel'
) );

/*Sidebar Layout*/
$wp_customize->add_setting( 'medical_circle_theme_options[medical-circle-wc-single-product-sidebar-layout]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['medical-circle-wc-single-product-sidebar-layout'],
	'sanitize_callback' => 'medical_circle_sanitize_select'
) );
$choices = medical_circle_sidebar_layout();
$wp_customize->add_control( 'medical_circle_theme_options[medical-circle-wc-single-product-sidebar-layout]', array(
	'choices'  	=> $choices,
	'label'		=> esc_html__( 'Single Product Sidebar Layout', 'medical-circle' ),
	'section'   => 'medical-circle-wc-single-product-options',
	'settings'  => 'medical_circle_theme_options[medical-circle-wc-single-product-sidebar-layout]',
	'type'	  	=> 'select'
) );