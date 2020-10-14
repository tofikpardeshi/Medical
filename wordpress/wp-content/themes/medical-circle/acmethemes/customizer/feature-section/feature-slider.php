<?php
/*adding sections for category section in front page*/
$wp_customize->add_section( 'medical-circle-feature-page', array(
    'priority'       => 10,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Feature Slider Selection', 'medical-circle' ),
    'panel'          => 'medical-circle-feature-panel'
) );

/* feature parent all-slides selection */
$slider_pages = array();
$slider_pages_obj = get_pages();
$slider_pages[''] = esc_html__('Select Slider Page','medical-circle');
foreach ($slider_pages_obj as $mc_page) {
	$slider_pages[$mc_page->ID] = $mc_page->post_title;
}
$wp_customize->add_setting( 'medical_circle_theme_options[medical-circle-slides-data]', array(
	'sanitize_callback' => 'medical_circle_sanitize_slider_data',
	'default' => $defaults['medical-circle-slides-data']
) );
$wp_customize->add_control(
	new AT_Repeater_Control(
		$wp_customize,
		'medical_circle_theme_options[medical-circle-slides-data]',
		array(
			'label'   => __('Slider Selection','medical-circle'),
			'description'=> __('Select Page For Slider','medical-circle'),
			'section' => 'medical-circle-feature-page',
			'settings' => 'medical_circle_theme_options[medical-circle-slides-data]',
			'repeater_main_label' => __('Select Slide of Slider','medical-circle'),
			'repeater_add_control_field' => __('Add New Slide','medical-circle')
		),
		array(
			'selectpage' => array(
				'type'        => 'select',
				'label'       => __( 'Select Page For Slide', 'medical-circle' ),
				'options'   => $slider_pages
			),
			'button_1_text' => array(
				'type'        => 'text',
				'label'       => __( 'Button One Text', 'medical-circle' ),
			),
			'button_1_link' => array(
				'type'        => 'url',
				'label'       => __( 'Button One Link', 'medical-circle' ),
			),
			'button_2_text' => array(
				'type'        => 'text',
				'label'       => __( 'Button Two Text', 'medical-circle' ),
			),
			'button_2_link' => array(
				'type'        => 'url',
				'label'       => __( 'Button Two Link', 'medical-circle' ),
			)
		)
	)
);

/*enable animation*/
$wp_customize->add_setting( 'medical_circle_theme_options[medical-circle-feature-slider-enable-animation]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['medical-circle-feature-slider-enable-animation'],
    'sanitize_callback' => 'medical_circle_sanitize_checkbox'
) );
$wp_customize->add_control( 'medical_circle_theme_options[medical-circle-feature-slider-enable-animation]', array(
    'label'		    => __( 'Enable Animation', 'medical-circle' ),
    'section'       => 'medical-circle-feature-page',
    'settings'      => 'medical_circle_theme_options[medical-circle-feature-slider-enable-animation]',
    'type'	  	    => 'checkbox'
) );

/*display-title*/
$wp_customize->add_setting( 'medical_circle_theme_options[medical-circle-feature-slider-display-title]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['medical-circle-feature-slider-display-title'],
    'sanitize_callback' => 'medical_circle_sanitize_checkbox'
) );
$wp_customize->add_control( 'medical_circle_theme_options[medical-circle-feature-slider-display-title]', array(
    'label'		    => __( 'Display Title', 'medical-circle' ),
    'section'       => 'medical-circle-feature-page',
    'settings'      => 'medical_circle_theme_options[medical-circle-feature-slider-display-title]',
    'type'	  	    => 'checkbox'
) );

/*display-excerpt*/
$wp_customize->add_setting( 'medical_circle_theme_options[medical-circle-feature-slider-display-excerpt]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['medical-circle-feature-slider-display-excerpt'],
	'sanitize_callback' => 'medical_circle_sanitize_checkbox'
) );
$wp_customize->add_control( 'medical_circle_theme_options[medical-circle-feature-slider-display-excerpt]', array(
	'label'		    => __( 'Display Excerpt', 'medical-circle' ),
	'section'       => 'medical-circle-feature-page',
	'settings'      => 'medical_circle_theme_options[medical-circle-feature-slider-display-excerpt]',
	'type'	  	    => 'checkbox'
) );

/*Image Display Behavior*/
$wp_customize->add_setting( 'medical_circle_theme_options[medical-circle-fs-image-display-options]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['medical-circle-fs-image-display-options'],
    'sanitize_callback' => 'medical_circle_sanitize_select'
) );
$choices = medical_circle_fs_image_display_options();
$wp_customize->add_control( 'medical_circle_theme_options[medical-circle-fs-image-display-options]', array(
    'choices'  	=> $choices,
    'label'		=> __( 'Feature Slider Image Display Options', 'medical-circle' ),
    'section'   => 'medical-circle-feature-page',
    'settings'  => 'medical_circle_theme_options[medical-circle-fs-image-display-options]',
    'type'	  	=> 'radio'
) );

/*Slider Selection Text Align*/
$wp_customize->add_setting( 'medical_circle_theme_options[medical-circle-feature-slider-text-align]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['medical-circle-feature-slider-text-align'],
	'sanitize_callback' => 'medical_circle_sanitize_select',
) );
$choices = medical_circle_slider_text_align();
$wp_customize->add_control( 'medical_circle_theme_options[medical-circle-feature-slider-text-align]', array(
	'choices'  	=> $choices,
	'label'		=> __( 'Slider Text Align', 'medical-circle' ),
	'section'       => 'medical-circle-feature-page',
	'settings'  => 'medical_circle_theme_options[medical-circle-feature-slider-text-align]',
	'type'	  	=> 'select'
) );