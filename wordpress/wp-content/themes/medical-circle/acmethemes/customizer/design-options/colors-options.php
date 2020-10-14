<?php
/*customizing default colors section and adding new controls-setting too*/
$wp_customize->add_section( 'colors', array(
    'priority'       => 40,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Colors', 'medical-circle' ),
    'panel'          => 'medical-circle-design-panel'
) );

/*Primary color*/
$wp_customize->add_setting( 'medical_circle_theme_options[medical-circle-primary-color]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['medical-circle-primary-color'],
    'sanitize_callback' => 'sanitize_hex_color'
) );

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'medical_circle_theme_options[medical-circle-primary-color]',
        array(
            'label'		=> __( 'Primary Color', 'medical-circle' ),
            'section'   => 'colors',
            'settings'  => 'medical_circle_theme_options[medical-circle-primary-color]',
            'type'	  	=> 'color'
        ) )
);

/*Header TOP color*/
$wp_customize->add_setting( 'medical_circle_theme_options[medical-circle-header-top-bg-color]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['medical-circle-header-top-bg-color'],
    'sanitize_callback' => 'sanitize_hex_color'
) );

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'medical_circle_theme_options[medical-circle-header-top-bg-color]',
        array(
            'label'		=> __( 'Header Top Background Color', 'medical-circle' ),
            'description'=> __( 'Also used as secondary color', 'medical-circle' ),
            'section'   => 'colors',
            'settings'  => 'medical_circle_theme_options[medical-circle-header-top-bg-color]',
            'type'	  	=> 'color'
        )
    )
);

/* Footer Background Color*/
$wp_customize->add_setting( 'medical_circle_theme_options[medical-circle-footer-bg-color]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['medical-circle-footer-bg-color'],
    'sanitize_callback' => 'sanitize_hex_color'
) );

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'medical_circle_theme_options[medical-circle-footer-bg-color]',
        array(
            'label'		=> __( 'Footer Background Color', 'medical-circle' ),
            'section'   => 'colors',
            'settings'  => 'medical_circle_theme_options[medical-circle-footer-bg-color]',
            'type'	  	=> 'color'
        )
    )
);

/* Footer Bottom Background Color*/
$wp_customize->add_setting( 'medical_circle_theme_options[medical-circle-footer-bottom-bg-color]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['medical-circle-footer-bottom-bg-color'],
    'sanitize_callback' => 'sanitize_hex_color'
) );

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'medical_circle_theme_options[medical-circle-footer-bottom-bg-color]',
        array(
            'label'		=> __( 'Footer Bottom Background Color', 'medical-circle' ),
            'section'   => 'colors',
            'settings'  => 'medical_circle_theme_options[medical-circle-footer-bottom-bg-color]',
            'type'	  	=> 'color'
        )
    )
);