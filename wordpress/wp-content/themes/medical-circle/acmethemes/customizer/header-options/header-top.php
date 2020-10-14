<?php
/*check if enable header top*/
if ( !function_exists('medical_circle_is_enable_header_top') ) :
	function medical_circle_is_enable_header_top() {
		$medical_circle_customizer_all_values = medical_circle_get_theme_options();
		if( 1 == $medical_circle_customizer_all_values['medical-circle-enable-header-top'] ){
			return true;
		}
		return false;
	}
endif;

/*adding sections for header options*/
$wp_customize->add_section( 'medical-circle-header-top-option', array(
    'priority'       => 10,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Header Top', 'medical-circle' ),
    'panel'          => 'medical-circle-header-panel',
) );

/*header top enable*/
$wp_customize->add_setting( 'medical_circle_theme_options[medical-circle-enable-header-top]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['medical-circle-enable-header-top'],
    'sanitize_callback' => 'medical_circle_sanitize_checkbox',
) );
$wp_customize->add_control( 'medical_circle_theme_options[medical-circle-enable-header-top]', array(
    'label'		=> __( 'Enable Header Top Options', 'medical-circle' ),
    'section'   => 'medical-circle-header-top-option',
    'settings'  => 'medical_circle_theme_options[medical-circle-enable-header-top]',
    'type'	  	=> 'checkbox'
) );

/*header top message*/
$wp_customize->add_setting('medical_circle_theme_options[medical-circle-header-top-message]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> '',
	'sanitize_callback' => 'esc_attr'
));

$wp_customize->add_control(
	new Medical_Circle_Customize_Message_Control(
		$wp_customize,
		'medical_circle_theme_options[medical-circle-header-top-message]',
		array(
			'section'   => 'medical-circle-header-top-option',
			'description'    => "<hr /><h2>".__('Display Different Element on Top Right or Left','medical-circle')."</h2>",
			'settings'  => 'medical_circle_theme_options[medical-circle-header-top-message]',
			'type'	  	=> 'message',
			'active_callback'   => 'medical_circle_is_enable_header_top'
		)
	)
);

/*Top Menu Display*/
$choices = medical_circle_header_top_display_selection();
$wp_customize->add_setting( 'medical_circle_theme_options[medical-circle-header-top-menu-display-selection]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['medical-circle-header-top-menu-display-selection'],
	'sanitize_callback' => 'medical_circle_sanitize_select'
) );
$description = sprintf( __( 'Add/Edit Menu Items from %1$s here%2$s and select Menu Location : Top Menu ( Support First Level Only ) ', 'medical-circle' ), '<a class="at-customizer button button-primary" data-panel="nav_menus" style="cursor: pointer">','</a>' );
$wp_customize->add_control( 'medical_circle_theme_options[medical-circle-header-top-menu-display-selection]', array(
	'choices'  	=> $choices,
	'label'		=> __( 'Top Menu Display', 'medical-circle' ),
	'description'		=> $description,
	'section'   => 'medical-circle-header-top-option',
	'settings'  => 'medical_circle_theme_options[medical-circle-header-top-menu-display-selection]',
	'type'	  	=> 'select',
	'active_callback'   => 'medical_circle_is_enable_header_top'
) );

/*News/Notice display*/
$wp_customize->add_setting( 'medical_circle_theme_options[medical-circle-header-top-news-display-selection]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['medical-circle-header-top-news-display-selection'],
	'sanitize_callback' => 'medical_circle_sanitize_select'
) );
$wp_customize->add_control( 'medical_circle_theme_options[medical-circle-header-top-news-display-selection]', array(
	'choices'  	=> $choices,
	'label'		=> __( 'News/Notice Display', 'medical-circle' ),
	'section'   => 'medical-circle-header-top-option',
	'settings'  => 'medical_circle_theme_options[medical-circle-header-top-news-display-selection]',
	'type'	  	=> 'select',
	'active_callback'   => 'medical_circle_is_enable_header_top'
) );

/*Social Display*/
$wp_customize->add_setting( 'medical_circle_theme_options[medical-circle-header-top-social-display-selection]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['medical-circle-header-top-social-display-selection'],
	'sanitize_callback' => 'medical_circle_sanitize_select'
) );
$description = sprintf( __( 'Add/Edit Social Items from %1$s here%2$s ', 'medical-circle' ), '<a class="at-customizer button button-primary" data-section="medical-circle-social-options" style="cursor: pointer">','</a>' );
$wp_customize->add_control( 'medical_circle_theme_options[medical-circle-header-top-social-display-selection]', array(
	'choices'  	=> $choices,
	'label'		=> __( 'Social Display', 'medical-circle' ),
	'description'=> $description,
	'section'   => 'medical-circle-header-top-option',
	'settings'  => 'medical_circle_theme_options[medical-circle-header-top-social-display-selection]',
	'type'	  	=> 'select',
	'active_callback'   => 'medical_circle_is_enable_header_top'
) );

/*header top message*/
$wp_customize->add_setting('medical_circle_theme_options[medical-circle-header-top-newsnotice-message]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> '',
	'sanitize_callback' => 'esc_attr'
));

$wp_customize->add_control(
	new Medical_Circle_Customize_Message_Control(
		$wp_customize,
		'medical_circle_theme_options[medical-circle-header-top-newsnotice-message]',
		array(
			'section'   => 'medical-circle-header-top-option',
			'description'    => "<hr />",
			'settings'  => 'medical_circle_theme_options[medical-circle-header-top-newsnotice-message]',
			'type'	  	=> 'message',
			'active_callback'   => 'medical_circle_is_enable_header_top'
		)
	)
);

/*News title*/
$wp_customize->add_setting( 'medical_circle_theme_options[medical-circle-newsnotice-title]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['medical-circle-newsnotice-title'],
    'sanitize_callback' => 'sanitize_text_field'
) );
$wp_customize->add_control( 'medical_circle_theme_options[medical-circle-newsnotice-title]', array(
    'label'		=> __( 'News/Notice/Announcement Title', 'medical-circle' ),
    'section'   => 'medical-circle-header-top-option',
    'settings'  => 'medical_circle_theme_options[medical-circle-newsnotice-title]',
    'type'	  	=> 'text',
    'active_callback'   => 'medical_circle_is_enable_header_top'
) );

/* News cat selection */
$wp_customize->add_setting( 'medical_circle_theme_options[medical-circle-newsnotice-cat]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['medical-circle-newsnotice-cat'],
    'sanitize_callback' => 'medical_circle_sanitize_number'
) );

$wp_customize->add_control(
    new Medical_Circle_Customize_Category_Dropdown_Control(
        $wp_customize,
        'medical_circle_theme_options[medical-circle-newsnotice-cat]',
        array(
            'label'		=> __( 'Select Category News/Notice/Announcement', 'medical-circle' ),
            'section'   => 'medical-circle-header-top-option',
            'settings'  => 'medical_circle_theme_options[medical-circle-newsnotice-cat]',
            'type'	  	=> 'category_dropdown',
            'active_callback'   => 'medical_circle_is_enable_header_top'
        )
    )
);