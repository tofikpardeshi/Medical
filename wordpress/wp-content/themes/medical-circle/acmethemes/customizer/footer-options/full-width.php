<?php
/*adding sections for footer social options */
$wp_customize->add_section( 'medical-circle-footer-full-width-options', array(
	'priority'       => 10,
	'capability'     => 'edit_theme_options',
	'theme_supports' => '',
	'title'          => __( 'Full Width Footer', 'medical-circle' ),
	'panel'          => 'medical-circle-footer-panel'
) );

/*footer basic info display options*/
$wp_customize->add_setting( 'medical_circle_theme_options[medical-circle-footer-full-width-display-options]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['medical-circle-footer-full-width-display-options'],
	'sanitize_callback' => 'medical_circle_sanitize_select'
) );
$choices = medical_circle_footer_full_width_display_options();
$wp_customize->add_control( 'medical_circle_theme_options[medical-circle-footer-full-width-display-options]', array(
	'choices'  	=> $choices,
	'label'		=> __( 'Footer Full Width Display Options', 'medical-circle' ),
	'section'   => 'medical-circle-footer-full-width-options',
	'settings'  => 'medical_circle_theme_options[medical-circle-footer-full-width-display-options]',
	'type'	  	=> 'select',
) );

/*enable social*/
$wp_customize->add_setting( 'medical_circle_theme_options[medical-circle-footer-enable-social]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['medical-circle-footer-enable-social'],
	'sanitize_callback' => 'medical_circle_sanitize_checkbox',
) );
$description = sprintf( __( 'Add/Edit Social Items from %1$s here%2$s ', 'medical-circle' ), '<a class="at-customizer" data-section="medical-circle-social-options" style="cursor: pointer">','</a>' );
$wp_customize->add_control( 'medical_circle_theme_options[medical-circle-footer-enable-social]', array(
	'label'		=> __( 'Enable social', 'medical-circle' ),
	'description'=> $description,
	'section'   => 'medical-circle-footer-full-width-options',
	'settings'  => 'medical_circle_theme_options[medical-circle-footer-enable-social]',
	'type'	  	=> 'checkbox'
) );

/*footer basic info number*/
$wp_customize->add_setting( 'medical_circle_theme_options[medical-circle-footer-bi-number]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['medical-circle-footer-bi-number'],
	'sanitize_callback' => 'medical_circle_sanitize_select'
) );
$choices = medical_circle_header_bi_number();
$description = sprintf( __( 'Add/Edit Basic Info from %1$s here%2$s ', 'medical-circle' ), '<a class="at-customizer" data-section="medical-circle-header-info" style="cursor: pointer">','</a>' );
$wp_customize->add_control( 'medical_circle_theme_options[medical-circle-footer-bi-number]', array(
	'choices'  	=> $choices,
	'label'		=> __( 'Footer Basic Info Display Number', 'medical-circle' ),
	'description'=> $description,
	'section'   => 'medical-circle-footer-full-width-options',
	'settings'  => 'medical_circle_theme_options[medical-circle-footer-bi-number]',
	'type'	  	=> 'select',
) );