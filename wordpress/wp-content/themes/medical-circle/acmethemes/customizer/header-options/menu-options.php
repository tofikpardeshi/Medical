<?php
/*check for medical-circle-menu-right-button-options*/
if ( !function_exists('medical_circle_menu_right_button_if_not_disable') ) :
	function medical_circle_menu_right_button_if_not_disable() {
		$medical_circle_customizer_all_values = medical_circle_get_theme_options();
		if( 'disable' != $medical_circle_customizer_all_values['medical-circle-menu-right-button-options'] ){
			return true;
		}
		return false;
	}
endif;

if ( !function_exists('medical_circle_menu_right_button_if_appointment') ) :
	function medical_circle_menu_right_button_if_appointment() {
		$medical_circle_customizer_all_values = medical_circle_get_theme_options();
		if( 'appointment' == $medical_circle_customizer_all_values['medical-circle-menu-right-button-options'] ){
			return true;
		}
		return false;
	}
endif;

if ( !function_exists('medical_circle_menu_right_button_if_link') ) :
	function medical_circle_menu_right_button_if_link() {
		$medical_circle_customizer_all_values = medical_circle_get_theme_options();
		if( 'link' == $medical_circle_customizer_all_values['medical-circle-menu-right-button-options'] ){
			return true;
		}
		return false;
	}
endif;

/*Menu Section*/
$wp_customize->add_section( 'medical-circle-menu-options', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Menu Options', 'medical-circle' ),
    'panel'          => 'medical-circle-header-panel'
) );

/*enable sticky*/
$wp_customize->add_setting( 'medical_circle_theme_options[medical-circle-enable-sticky]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['medical-circle-enable-sticky'],
    'sanitize_callback' => 'medical_circle_sanitize_checkbox'
) );

$wp_customize->add_control( 'medical_circle_theme_options[medical-circle-enable-sticky]', array(
    'label'		=> __( 'Enable Sticky Menu', 'medical-circle' ),
    'section'   => 'medical-circle-menu-options',
    'settings'  => 'medical_circle_theme_options[medical-circle-enable-sticky]',
    'type'	  	=> 'checkbox'
) );

/*Button Right Message*/
$wp_customize->add_setting('medical_circle_theme_options[medical-circle-menu-right-button-message]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> '',
	'sanitize_callback' => 'esc_attr'
));

$wp_customize->add_control(
	new Medical_Circle_Customize_Message_Control(
		$wp_customize,
		'medical_circle_theme_options[medical-circle-menu-right-button-message]',
		array(
			'section'   => 'medical-circle-menu-options',
			'description'    => "<hr /><h2>".__('Special Button On Menu Right','medical-circle')."</h2>",
			'settings'  => 'medical_circle_theme_options[medical-circle-menu-right-button-message]',
			'type'	  	=> 'message'
		)
	)
);

/*Button Link Options*/
$wp_customize->add_setting( 'medical_circle_theme_options[medical-circle-menu-right-button-options]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['medical-circle-menu-right-button-options'],
	'sanitize_callback' => 'medical_circle_sanitize_select'
) );
$choices = medical_circle_menu_right_button_link_options();
$wp_customize->add_control( 'medical_circle_theme_options[medical-circle-menu-right-button-options]', array(
	'choices'  	    => $choices,
	'label'		    => __( 'Button Options', 'medical-circle' ),
	'section'       => 'medical-circle-menu-options',
	'settings'      => 'medical_circle_theme_options[medical-circle-menu-right-button-options]',
	'type'	  	    => 'select'
) );

/*Button title*/
$wp_customize->add_setting( 'medical_circle_theme_options[medical-circle-menu-right-button-title]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['medical-circle-menu-right-button-title'],
	'sanitize_callback' => 'sanitize_text_field'
) );
$wp_customize->add_control( 'medical_circle_theme_options[medical-circle-menu-right-button-title]', array(
	'label'		=> __( 'Button Title', 'medical-circle' ),
	'section'   => 'medical-circle-menu-options',
	'settings'  => 'medical_circle_theme_options[medical-circle-menu-right-button-title]',
	'type'	  	=> 'text',
	'active_callback'   => 'medical_circle_menu_right_button_if_not_disable'
) );

/*Button Right appointment Message*/
$wp_customize->add_setting('medical_circle_theme_options[medical-circle-menu-right-button-appointment-message]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> '',
	'sanitize_callback' => 'esc_attr'
));
$description = sprintf( __( 'Add Form Shortcode from %1$s here%2$s ', 'medical-circle' ), '<a class="at-customizer" data-section="medical-circle-appointment-form" style="cursor: pointer">','</a>' );
$wp_customize->add_control(
	new Medical_Circle_Customize_Message_Control(
		$wp_customize,
		'medical_circle_theme_options[medical-circle-menu-right-button-appointment-message]',
		array(
			'section'   => 'medical-circle-menu-options',
			'description'    => $description,
			'settings'  => 'medical_circle_theme_options[medical-circle-menu-right-button-appointment-message]',
			'type'	  	=> 'message',
			'active_callback'   => 'medical_circle_menu_right_button_if_appointment'
		)
	)
);

/*Button link*/
$wp_customize->add_setting( 'medical_circle_theme_options[medical-circle-menu-right-button-link]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['medical-circle-menu-right-button-link'],
	'sanitize_callback' => 'esc_url_raw'
) );
$wp_customize->add_control( 'medical_circle_theme_options[medical-circle-menu-right-button-link]', array(
	'label'		=> __( 'Button Link', 'medical-circle' ),
	'section'   => 'medical-circle-menu-options',
	'settings'  => 'medical_circle_theme_options[medical-circle-menu-right-button-link]',
	'type'	  	=> 'url',
	'active_callback'   => 'medical_circle_menu_right_button_if_link'
) );