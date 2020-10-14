<?php
/*adding sections for blog layout options*/
$wp_customize->add_section( 'medical-circle-design-blog-layout-option', array(
    'priority'       => 30,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Default Blog/Archive Layout', 'medical-circle' ),
    'panel'          => 'medical-circle-design-panel'
) );

/*blog layout*/
$wp_customize->add_setting( 'medical_circle_theme_options[medical-circle-blog-archive-layout]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['medical-circle-blog-archive-layout'],
    'sanitize_callback' => 'medical_circle_sanitize_select'
) );
$choices = medical_circle_blog_layout();
$wp_customize->add_control( 'medical_circle_theme_options[medical-circle-blog-archive-layout]', array(
    'choices'  	    => $choices,
    'label'		    => __( 'Default Blog/Archive Layout', 'medical-circle' ),
    'description'   => __( 'Image display options', 'medical-circle' ),
    'section'       => 'medical-circle-design-blog-layout-option',
    'settings'      => 'medical_circle_theme_options[medical-circle-blog-archive-layout]',
    'type'	  	    => 'select'
) );

/*Read More Text*/
$wp_customize->add_setting( 'medical_circle_theme_options[medical-circle-blog-archive-more-text]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['medical-circle-blog-archive-more-text'],
    'sanitize_callback' => 'sanitize_text_field'
) );
$wp_customize->add_control( 'medical_circle_theme_options[medical-circle-blog-archive-more-text]', array(
    'label'		=> __( 'Read More Text', 'medical-circle' ),
    'section'   => 'medical-circle-design-blog-layout-option',
    'settings'  => 'medical_circle_theme_options[medical-circle-blog-archive-more-text]',
    'type'	  	=> 'text'
) );
