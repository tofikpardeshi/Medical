<?php
/*adding sections for enabling feature section in front page*/
$wp_customize->add_section( 'medical-circle-enable-feature', array(
    'priority'       => 10,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Enable Feature Section', 'medical-circle' ),
    'panel'          => 'medical-circle-feature-panel'
) );

/*enable feature section*/
$wp_customize->add_setting( 'medical_circle_theme_options[medical-circle-enable-feature]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['medical-circle-enable-feature'],
    'sanitize_callback' => 'medical_circle_sanitize_checkbox'
) );

$wp_customize->add_control( 'medical_circle_theme_options[medical-circle-enable-feature]', array(
    'label'		=> __( 'Enable Feature Section', 'medical-circle' ),
    'description'	=> sprintf( __( 'Feature section will display on front/home page. Feature Section includes Feature Slider and Feature Column.%1$s Note : Please go to %2$s "Static Front Page"%3$s setting, Select "A static page" then "Front page" and "Posts page" to enable it', 'medical-circle' ), '<br />','<b><a class="at-customizer" data-section="static_front_page"> ','</a></b>' ),
    'section'   => 'medical-circle-enable-feature',
    'settings'  => 'medical_circle_theme_options[medical-circle-enable-feature]',
    'type'	  	=> 'checkbox'
) );