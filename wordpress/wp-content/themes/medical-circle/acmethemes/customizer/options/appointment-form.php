<?php
/*Appointment Form*/
$wp_customize->add_section( 'medical-circle-appointment-form', array(
	'priority'       => 20,
	'capability'     => 'edit_theme_options',
	'theme_supports' => '',
	'title'          => __( 'Appointment Form', 'medical-circle' ),
	'panel'          => 'medical-circle-options'
) );

/*Appointment title*/
$wp_customize->add_setting( 'medical_circle_theme_options[medical-circle-appointment-form-title]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['medical-circle-appointment-form-title'],
	'sanitize_callback' => 'sanitize_text_field'
) );
$wp_customize->add_control( 'medical_circle_theme_options[medical-circle-appointment-form-title]', array(
	'label'		=> __( 'Form Title', 'medical-circle' ),
	'section'   => 'medical-circle-appointment-form',
	'settings'  => 'medical_circle_theme_options[medical-circle-appointment-form-title]',
	'type'	  	=> 'text',
) );

/*Appointment shortcode*/
$wp_customize->add_setting( 'medical_circle_theme_options[medical-circle-appointment-form-shortcode]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['medical-circle-appointment-form-shortcode'],
	'sanitize_callback' => 'wp_kses_post'
) );
$wp_customize->add_control( 'medical_circle_theme_options[medical-circle-appointment-form-shortcode]', array(
	'label'		=> __( 'Form Shortcode', 'medical-circle' ),
	'section'   => 'medical-circle-appointment-form',
	'settings'  => 'medical_circle_theme_options[medical-circle-appointment-form-shortcode]',
	'type'	  	=> 'text',
) );