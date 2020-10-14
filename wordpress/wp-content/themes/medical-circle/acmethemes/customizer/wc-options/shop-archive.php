<?php
/*adding sections for sidebar options */
$wp_customize->add_section( 'medical-circle-wc-shop-archive-option', array(
	'priority'       => 20,
	'capability'     => 'edit_theme_options',
	'title'          => esc_html__( 'Shop Archive Sidebar Layout', 'medical-circle' ),
	'panel'          => 'medical-circle-wc-panel'
) );

/*Sidebar Layout*/
$wp_customize->add_setting( 'medical_circle_theme_options[medical-circle-wc-shop-archive-sidebar-layout]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['medical-circle-wc-shop-archive-sidebar-layout'],
	'sanitize_callback' => 'medical_circle_sanitize_select'
) );
$choices = medical_circle_sidebar_layout();
$wp_customize->add_control( 'medical_circle_theme_options[medical-circle-wc-shop-archive-sidebar-layout]', array(
	'choices'  	=> $choices,
	'label'		=> esc_html__( 'Shop Archive Sidebar Layout', 'medical-circle' ),
	'section'   => 'medical-circle-wc-shop-archive-option',
	'settings'  => 'medical_circle_theme_options[medical-circle-wc-shop-archive-sidebar-layout]',
	'type'	  	=> 'select'
) );

/*wc-product-column-number*/
$wp_customize->add_setting( 'medical_circle_theme_options[medical-circle-wc-product-column-number]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['medical-circle-wc-product-column-number'],
	'sanitize_callback' => 'absint'
) );
$wp_customize->add_control( 'medical_circle_theme_options[medical-circle-wc-product-column-number]', array(
	'label'		=> esc_html__( 'Products Per Row', 'medical-circle' ),
	'section'   => 'medical-circle-wc-shop-archive-option',
	'settings'  => 'medical_circle_theme_options[medical-circle-wc-product-column-number]',
	'type'	  	=> 'number'
) );

/*wc-shop-archive-total-product*/
$wp_customize->add_setting( 'medical_circle_theme_options[medical-circle-wc-shop-archive-total-product]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['medical-circle-wc-shop-archive-total-product'],
	'sanitize_callback' => 'absint'
) );
$wp_customize->add_control( 'medical_circle_theme_options[medical-circle-wc-shop-archive-total-product]', array(
	'label'		=> esc_html__( 'Total Products Per Page', 'medical-circle' ),
	'section'   => 'medical-circle-wc-shop-archive-option',
	'settings'  => 'medical_circle_theme_options[medical-circle-wc-shop-archive-total-product]',
	'type'	  	=> 'number'
) );