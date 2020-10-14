<?php
/*adding sections for default layout options panel*/
$wp_customize->add_section( 'medical-circle-archive-sidebar-layout', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Category/Archive Sidebar Layout', 'medical-circle' ),
    'panel'          => 'medical-circle-design-panel'
) );

/*Sidebar Layout*/
$wp_customize->add_setting( 'medical_circle_theme_options[medical-circle-archive-sidebar-layout]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['medical-circle-archive-sidebar-layout'],
    'sanitize_callback' => 'medical_circle_sanitize_select'
) );
$choices = medical_circle_sidebar_layout();
$wp_customize->add_control( 'medical_circle_theme_options[medical-circle-archive-sidebar-layout]', array(
    'choices'  	    => $choices,
    'label'		    => __( 'Category/Archive Sidebar Layout', 'medical-circle' ),
    'description'   => __( 'Sidebar Layout for listing pages like category, author etc', 'medical-circle' ),
    'section'       => 'medical-circle-archive-sidebar-layout',
    'settings'      => 'medical_circle_theme_options[medical-circle-archive-sidebar-layout]',
    'type'	  	    => 'select'
) );