<?php
/*adding sections for header social options */
$wp_customize->add_section( 'medical-circle-header-info', array(
	'priority'       => 20,
	'capability'     => 'edit_theme_options',
	'theme_supports' => '',
	'title'          => __( 'Basic Info', 'medical-circle' ),
	'panel'          => 'medical-circle-header-panel'
) );

/*header basic info display options*/
$wp_customize->add_setting( 'medical_circle_theme_options[medical-circle-header-bi-display-options]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['medical-circle-header-bi-display-options'],
	'sanitize_callback' => 'medical_circle_sanitize_select'
) );
$choices = medical_circle_header_bi_display_options();
$wp_customize->add_control( 'medical_circle_theme_options[medical-circle-header-bi-display-options]', array(
	'choices'  	=> $choices,
	'label'		=> __( 'Header Basic Info Display Options', 'medical-circle' ),
	'section'   => 'medical-circle-header-info',
	'settings'  => 'medical_circle_theme_options[medical-circle-header-bi-display-options]',
	'type'	  	=> 'select',
) );

/*header basic info number*/
$wp_customize->add_setting( 'medical_circle_theme_options[medical-circle-header-bi-number]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['medical-circle-header-bi-number'],
	'sanitize_callback' => 'medical_circle_sanitize_select'
) );
$choices = medical_circle_header_bi_number();
$wp_customize->add_control( 'medical_circle_theme_options[medical-circle-header-bi-number]', array(
	'choices'  	=> $choices,
	'label'		=> __( 'Header Basic Info Number Display', 'medical-circle' ),
	'section'   => 'medical-circle-header-info',
	'settings'  => 'medical_circle_theme_options[medical-circle-header-bi-number]',
	'type'	  	=> 'select',
) );

/*first info*/
$wp_customize->add_setting('medical_circle_theme_options[medical-circle-first-info-message]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> '',
	'sanitize_callback' => 'esc_attr'
));

$wp_customize->add_control(
	new Medical_Circle_Customize_Message_Control(
		$wp_customize,
		'medical_circle_theme_options[medical-circle-first-info-message]',
		array(
			'section'   => 'medical-circle-header-info',
			'description'    => "<hr /><h2>".__('First Info','medical-circle')."</h2>",
			'settings'  => 'medical_circle_theme_options[medical-circle-first-info-message]',
			'type'	  	=> 'message',
		)
	)
);
$wp_customize->add_setting( 'medical_circle_theme_options[medical-circle-first-info-icon]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['medical-circle-first-info-icon'],
	'sanitize_callback' => 'medical_circle_sanitize_allowed_html'
) );

$wp_customize->add_control(
	new Medical_Circle_Customize_Icons_Control(
		$wp_customize,
		'medical_circle_theme_options[medical-circle-first-info-icon]',
		array(
			'label'		=> __( 'Icon', 'medical-circle' ),
			'section'   => 'medical-circle-header-info',
			'settings'  => 'medical_circle_theme_options[medical-circle-first-info-icon]',
			'type'	  	=> 'text'
		)
	)
);

$wp_customize->add_setting( 'medical_circle_theme_options[medical-circle-first-info-title]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['medical-circle-first-info-title'],
	'sanitize_callback' => 'medical_circle_sanitize_allowed_html'
) );
$wp_customize->add_control( 'medical_circle_theme_options[medical-circle-first-info-title]', array(
	'label'		=> __( 'Title', 'medical-circle' ),
	'section'   => 'medical-circle-header-info',
	'settings'  => 'medical_circle_theme_options[medical-circle-first-info-title]',
	'type'	  	=> 'text'
) );

$wp_customize->add_setting( 'medical_circle_theme_options[medical-circle-first-info-desc]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['medical-circle-first-info-desc'],
	'sanitize_callback' => 'medical_circle_sanitize_allowed_html'
) );
$wp_customize->add_control( 'medical_circle_theme_options[medical-circle-first-info-desc]', array(
	'label'		=> __( 'Very Short Description', 'medical-circle' ),
	'section'   => 'medical-circle-header-info',
	'settings'  => 'medical_circle_theme_options[medical-circle-first-info-desc]',
	'type'	  	=> 'text'
) );

/*Second Info*/
$wp_customize->add_setting('medical_circle_theme_options[medical-circle-second-info-message]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> '',
	'sanitize_callback' => 'esc_attr'
));

$wp_customize->add_control(
	new Medical_Circle_Customize_Message_Control(
		$wp_customize,
		'medical_circle_theme_options[medical-circle-second-info-message]',
		array(
			'section'   => 'medical-circle-header-info',
			'description'    => "<hr /><h2>".__('Second Info','medical-circle')."</h2>",
			'settings'  => 'medical_circle_theme_options[medical-circle-second-info-message]',
			'type'	  	=> 'message',
		)
	)
);
$wp_customize->add_setting( 'medical_circle_theme_options[medical-circle-second-info-icon]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['medical-circle-second-info-icon'],
	'sanitize_callback' => 'medical_circle_sanitize_allowed_html'
) );
$wp_customize->add_control(
	new Medical_Circle_Customize_Icons_Control(
		$wp_customize,
		'medical_circle_theme_options[medical-circle-second-info-icon]',
		array(
			'label'		=> __( 'Icon', 'medical-circle' ),
			'section'   => 'medical-circle-header-info',
			'settings'  => 'medical_circle_theme_options[medical-circle-second-info-icon]',
			'type'	  	=> 'text'
		)
	)
);

$wp_customize->add_setting( 'medical_circle_theme_options[medical-circle-second-info-title]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['medical-circle-second-info-title'],
	'sanitize_callback' => 'medical_circle_sanitize_allowed_html'
) );
$wp_customize->add_control( 'medical_circle_theme_options[medical-circle-second-info-title]', array(
	'label'		=> __( 'Title', 'medical-circle' ),
	'section'   => 'medical-circle-header-info',
	'settings'  => 'medical_circle_theme_options[medical-circle-second-info-title]',
	'type'	  	=> 'text'
) );

$wp_customize->add_setting( 'medical_circle_theme_options[medical-circle-second-info-desc]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['medical-circle-second-info-desc'],
	'sanitize_callback' => 'medical_circle_sanitize_allowed_html'
) );
$wp_customize->add_control( 'medical_circle_theme_options[medical-circle-second-info-desc]', array(
	'label'		=> __( 'Very Short Description', 'medical-circle' ),
	'section'   => 'medical-circle-header-info',
	'settings'  => 'medical_circle_theme_options[medical-circle-second-info-desc]',
	'type'	  	=> 'text'
) );

/*third info*/
$wp_customize->add_setting('medical_circle_theme_options[medical-circle-third-info-message]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> '',
	'sanitize_callback' => 'esc_attr'
));

$wp_customize->add_control(
	new Medical_Circle_Customize_Message_Control(
		$wp_customize,
		'medical_circle_theme_options[medical-circle-third-info-message]',
		array(
			'section'   => 'medical-circle-header-info',
			'description'    => "<hr /><h2>".__('Third Info','medical-circle')."</h2>",
			'settings'  => 'medical_circle_theme_options[medical-circle-third-info-message]',
			'type'	  	=> 'message',
		)
	)
);
$wp_customize->add_setting( 'medical_circle_theme_options[medical-circle-third-info-icon]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['medical-circle-third-info-icon'],
	'sanitize_callback' => 'medical_circle_sanitize_allowed_html'
) );
$wp_customize->add_control(
	new Medical_Circle_Customize_Icons_Control(
		$wp_customize,
		'medical_circle_theme_options[medical-circle-third-info-icon]',
		array(
			'label'		=> __( 'Icon', 'medical-circle' ),
			'section'   => 'medical-circle-header-info',
			'settings'  => 'medical_circle_theme_options[medical-circle-third-info-icon]',
			'type'	  	=> 'text'
		)
	)
);

$wp_customize->add_setting( 'medical_circle_theme_options[medical-circle-third-info-title]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['medical-circle-third-info-title'],
	'sanitize_callback' => 'medical_circle_sanitize_allowed_html'
) );
$wp_customize->add_control( 'medical_circle_theme_options[medical-circle-third-info-title]', array(
	'label'		=> __( 'Title', 'medical-circle' ),
	'section'   => 'medical-circle-header-info',
	'settings'  => 'medical_circle_theme_options[medical-circle-third-info-title]',
	'type'	  	=> 'text'
) );

$wp_customize->add_setting( 'medical_circle_theme_options[medical-circle-third-info-desc]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['medical-circle-third-info-desc'],
	'sanitize_callback' => 'medical_circle_sanitize_allowed_html'
) );
$wp_customize->add_control( 'medical_circle_theme_options[medical-circle-third-info-desc]', array(
	'label'		=> __( 'Very Short Description', 'medical-circle' ),
	'section'   => 'medical-circle-header-info',
	'settings'  => 'medical_circle_theme_options[medical-circle-third-info-desc]',
	'type'	  	=> 'text'
) );

/*forth*/
$wp_customize->add_setting('medical_circle_theme_options[medical-circle-forth-info-message]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> '',
	'sanitize_callback' => 'esc_attr'
));

$wp_customize->add_control(
	new Medical_Circle_Customize_Message_Control(
		$wp_customize,
		'medical_circle_theme_options[medical-circle-forth-info-message]',
		array(
			'section'   => 'medical-circle-header-info',
			'description'    => "<hr /><h2>".__('Forth Info','medical-circle')."</h2>",
			'settings'  => 'medical_circle_theme_options[medical-circle-forth-info-message]',
			'type'	  	=> 'message',
		)
	)
);
$wp_customize->add_setting( 'medical_circle_theme_options[medical-circle-forth-info-icon]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['medical-circle-forth-info-icon'],
	'sanitize_callback' => 'medical_circle_sanitize_allowed_html'
) );
$wp_customize->add_control(
	new Medical_Circle_Customize_Icons_Control(
		$wp_customize,
		'medical_circle_theme_options[medical-circle-forth-info-icon]',
		array(
			'label'		=> __( 'Icon', 'medical-circle' ),
			'section'   => 'medical-circle-header-info',
			'settings'  => 'medical_circle_theme_options[medical-circle-forth-info-icon]',
			'type'	  	=> 'text'
		)
	)
);

$wp_customize->add_setting( 'medical_circle_theme_options[medical-circle-forth-info-title]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['medical-circle-forth-info-title'],
	'sanitize_callback' => 'medical_circle_sanitize_allowed_html'
) );
$wp_customize->add_control( 'medical_circle_theme_options[medical-circle-forth-info-title]', array(
	'label'		=> __( 'Title', 'medical-circle' ),
	'section'   => 'medical-circle-header-info',
	'settings'  => 'medical_circle_theme_options[medical-circle-forth-info-title]',
	'type'	  	=> 'text'
) );

$wp_customize->add_setting( 'medical_circle_theme_options[medical-circle-forth-info-desc]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['medical-circle-forth-info-desc'],
	'sanitize_callback' => 'medical_circle_sanitize_allowed_html'
) );
$wp_customize->add_control( 'medical_circle_theme_options[medical-circle-forth-info-desc]', array(
	'label'		=> __( 'Very Short Description', 'medical-circle' ),
	'section'   => 'medical-circle-header-info',
	'settings'  => 'medical_circle_theme_options[medical-circle-forth-info-desc]',
	'type'	  	=> 'text'
) );