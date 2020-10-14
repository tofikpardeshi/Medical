<?php
/*adding sections for header social options */
$wp_customize->add_section( 'medical-circle-social-options', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Social Options', 'medical-circle' ),
    'panel'          => 'medical-circle-options'
) );

/*repeater social data*/
$wp_customize->add_setting( 'medical_circle_theme_options[medical-circle-social-data]', array(
	'sanitize_callback' => 'medical_circle_sanitize_social_data',
	'default' => $defaults['medical-circle-social-data']
) );
$wp_customize->add_control(
	new AT_Repeater_Control(
		$wp_customize,
		'medical_circle_theme_options[medical-circle-social-data]',
		array(
			'label'   => __('Social Options Selection','medical-circle'),
			'description'=> __('Select Social Icons and enter link','medical-circle'),
			'section' => 'medical-circle-social-options',
			'settings' => 'medical_circle_theme_options[medical-circle-social-data]',
			'repeater_main_label' => __('Social Icon','medical-circle'),
			'repeater_add_control_field' => __('Add New Icon','medical-circle')
		),
		array(
			'icon' => array(
				'type'        => 'icons',
				'label'       => __( 'Select Icon', 'medical-circle' ),
			),
			'link' => array(
				'type'        => 'url',
				'label'       => __( 'Enter Link', 'medical-circle' ),
			),
			'checkbox' => array(
				'type'        => 'checkbox',
				'label'       => __( 'Open in New Window', 'medical-circle' ),
			),
		)
	)
);