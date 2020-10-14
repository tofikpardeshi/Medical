<?php
/*Site Logo*/
$wp_customize->add_setting( 'medical_circle_theme_options[medical-circle-display-site-logo]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['medical-circle-display-site-logo'],
	'sanitize_callback' => 'medical_circle_sanitize_checkbox'
) );
$wp_customize->add_control( 'medical_circle_theme_options[medical-circle-display-site-logo]', array(
	'label'		=> __( 'Display Logo', 'medical-circle' ),
	'section'   => 'title_tagline',
	'settings'  => 'medical_circle_theme_options[medical-circle-display-site-logo]',
	'type'	  	=> 'checkbox',
	'priority'  => 70
) );

/*Site Title*/
$wp_customize->add_setting( 'medical_circle_theme_options[medical-circle-display-site-title]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['medical-circle-display-site-title'],
	'sanitize_callback' => 'medical_circle_sanitize_checkbox'
) );
$wp_customize->add_control( 'medical_circle_theme_options[medical-circle-display-site-title]', array(
	'label'		=> __( 'Display Site Title', 'medical-circle' ),
	'section'   => 'title_tagline',
	'settings'  => 'medical_circle_theme_options[medical-circle-display-site-title]',
	'type'	  	=> 'checkbox',
	'priority'  => 70
) );

/*Site Tagline*/
$wp_customize->add_setting( 'medical_circle_theme_options[medical-circle-display-site-tagline]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['medical-circle-display-site-tagline'],
	'sanitize_callback' => 'medical_circle_sanitize_checkbox'
) );
$wp_customize->add_control( 'medical_circle_theme_options[medical-circle-display-site-tagline]', array(
	'label'		=> __( 'Display Site Tagline', 'medical-circle' ),
	'section'   => 'title_tagline',
	'settings'  => 'medical_circle_theme_options[medical-circle-display-site-tagline]',
	'type'	  	=> 'checkbox',
	'priority'  => 70
) );