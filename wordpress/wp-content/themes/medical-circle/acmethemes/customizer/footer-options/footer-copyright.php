<?php
/*adding sections for footer options*/
$wp_customize->add_section( 'medical-circle-footer-copyright-option', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Bottom Copyright Section', 'medical-circle' ),
    'panel'          => 'medical-circle-footer-panel',
) );

/*copyright*/
$wp_customize->add_setting( 'medical_circle_theme_options[medical-circle-footer-copyright]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['medical-circle-footer-copyright'],
    'sanitize_callback' => 'wp_kses_post'
) );
$wp_customize->add_control( 'medical_circle_theme_options[medical-circle-footer-copyright]', array(
    'label'		=> __( 'Copyright Text', 'medical-circle' ),
    'section'   => 'medical-circle-footer-copyright-option',
    'settings'  => 'medical_circle_theme_options[medical-circle-footer-copyright]',
    'type'	  	=> 'text',
    'priority'  => 10
) );

/*footer basic info number*/
$wp_customize->add_setting( 'medical_circle_theme_options[medical-circle-footer-copyright-beside-option]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['medical-circle-footer-copyright-beside-option'],
	'sanitize_callback' => 'medical_circle_sanitize_select'
) );
$choices = medical_circle_footer_copyright_beside_option();
$wp_customize->add_control( 'medical_circle_theme_options[medical-circle-footer-copyright-beside-option]', array(
	'choices'  	=> $choices,
	'label'		=> __( 'Footer Copyright Beside Option', 'medical-circle' ),
	'section'   => 'medical-circle-footer-copyright-option',
	'settings'  => 'medical_circle_theme_options[medical-circle-footer-copyright-beside-option]',
	'type'	  	=> 'select',
) );

/*footer power text enable-disable */
$wp_customize->add_setting( 'medical_circle_theme_options[medical-circle-enable-footer-power-text]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['medical-circle-enable-footer-power-text'],
	'sanitize_callback' => 'medical_circle_sanitize_checkbox'
) );
$wp_customize->add_control( 'medical_circle_theme_options[medical-circle-enable-footer-power-text]', array(
	'label'		=> __( ' Enable Theme Name And Powered By Text ', 'medical-circle' ),
	'section'   => 'medical-circle-footer-copyright-option',
	'settings'  => 'medical_circle_theme_options[medical-circle-enable-footer-power-text]',
	'type'	  	=> 'checkbox'
) );