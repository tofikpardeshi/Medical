<?php
/*adding sections for category section in front page*/
$wp_customize->add_section( 'medical-circle-feature-column', array(
    'priority'       => 10,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Feature Column Selection', 'medical-circle' ),
    'panel'          => 'medical-circle-feature-panel'
) );

/*feature parent page selection */
$wp_customize->add_setting( 'medical_circle_theme_options[medical-circle-feature-column-1]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['medical-circle-feature-column-1'],
    'sanitize_callback' => 'medical_circle_sanitize_number'
) );
$wp_customize->add_control( 'medical_circle_theme_options[medical-circle-feature-column-1]', array(
    'label'		    => __( 'Select Page for Feature Column 1', 'medical-circle' ),
    'section'       => 'medical-circle-feature-column',
    'settings'      => 'medical_circle_theme_options[medical-circle-feature-column-1]',
    'type'	  	    => 'dropdown-pages',
    'priority'      => 10
) );

/*Feature Column 1 Background Color*/
$wp_customize->add_setting( 'medical_circle_theme_options[medical-circle-feature-column-1-color]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['medical-circle-feature-column-1-color'],
    'sanitize_callback' => 'sanitize_hex_color'
) );

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'medical_circle_theme_options[medical-circle-feature-column-1-color]',
        array(
            'label'		=> __( 'Feature Column 1 Background Color', 'medical-circle' ),
            'section'   => 'medical-circle-feature-column',
            'settings'  => 'medical_circle_theme_options[medical-circle-feature-column-1-color]',
            'type'	  	=> 'color',
            'priority'      => 20
        )
    )
);

/* feature parent page selection */
$wp_customize->add_setting( 'medical_circle_theme_options[medical-circle-feature-column-2]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['medical-circle-feature-column-2'],
    'sanitize_callback' => 'medical_circle_sanitize_number'
) );
$wp_customize->add_control( 'medical_circle_theme_options[medical-circle-feature-column-2]', array(
    'label'		    => __( 'Select Page for Feature Column 2', 'medical-circle' ),
    'section'       => 'medical-circle-feature-column',
    'settings'      => 'medical_circle_theme_options[medical-circle-feature-column-2]',
    'type'	  	    => 'dropdown-pages',
    'priority'      => 30
) );

/*Feature Column 2 Background Color*/
$wp_customize->add_setting( 'medical_circle_theme_options[medical-circle-feature-column-2-color]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['medical-circle-feature-column-2-color'],
    'sanitize_callback' => 'sanitize_hex_color'
) );

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'medical_circle_theme_options[medical-circle-feature-column-2-color]',
        array(
            'label'		=> __( 'Feature Column 2 Background Color', 'medical-circle' ),
            'section'   => 'medical-circle-feature-column',
            'settings'  => 'medical_circle_theme_options[medical-circle-feature-column-2-color]',
            'type'	  	=> 'color',
            'priority'      => 40
        )
    )
);

/* feature parent page selection */
$wp_customize->add_setting( 'medical_circle_theme_options[medical-circle-feature-column-3]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['medical-circle-feature-column-3'],
    'sanitize_callback' => 'medical_circle_sanitize_number'
) );
$wp_customize->add_control( 'medical_circle_theme_options[medical-circle-feature-column-3]', array(
    'label'		    => __( 'Select Page for Feature Column 3', 'medical-circle' ),
    'section'       => 'medical-circle-feature-column',
    'settings'      => 'medical_circle_theme_options[medical-circle-feature-column-3]',
    'type'	  	    => 'dropdown-pages',
    'priority'      => 40
) );

/*Feature Column 3 Background Color*/
$wp_customize->add_setting( 'medical_circle_theme_options[medical-circle-feature-column-3-color]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['medical-circle-feature-column-3-color'],
    'sanitize_callback' => 'sanitize_hex_color'
) );

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'medical_circle_theme_options[medical-circle-feature-column-3-color]',
        array(
            'label'		=> __( 'Feature Column 3 Background Color', 'medical-circle' ),
            'section'   => 'medical-circle-feature-column',
            'settings'  => 'medical_circle_theme_options[medical-circle-feature-column-3-color]',
            'type'	  	=> 'color',
            'priority'      => 50
        )
    )
);