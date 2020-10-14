<?php
/**
 * Adds Medical Circle Theme Widgets in SiteOrigin Pagebuilder Tabs
 *
 * @since Medical Circle 1.0.0
 *
 * @param null
 * @return null
 *
 */
function medical_circle_siteorigin_widgets($widgets) {
    $theme_widgets = array(
        'Medical_Circle_About',
        'Medical_Circle_Accordion',
        'Medical_Circle_Posts_Col',
        'Medical_Circle_Contact',
        'Medical_Circle_Department',
        'Medical_Circle_Gallery',
        'Medical_Circle_Social',
        'Medical_Circle_Team',
        'Medical_Circle_Testimonial'
    );
    foreach($theme_widgets as $theme_widget) {
        if( isset( $widgets[$theme_widget] ) ) {
            $widgets[$theme_widget]['groups'] = array('medical-circle');
            $widgets[$theme_widget]['icon']   = 'dashicons dashicons-screenoptions';
        }
    }
    return $widgets;
}
add_filter('siteorigin_panels_widgets', 'medical_circle_siteorigin_widgets');

/**
 * Add a tab for the theme widgets in the page builder
 *
 * @since Medical Circle 1.0.0
 *
 * @param null
 * @return null
 *
 */
function medical_circle_siteorigin_widgets_tab($tabs){
    $tabs[] = array(
        'title'  => __('AT Medical Circle Widgets', 'medical-circle'),
        'filter' => array(
            'groups' => array('medical-circle')
        )
    );
    return $tabs;
}
add_filter('siteorigin_panels_widget_dialog_tabs', 'medical_circle_siteorigin_widgets_tab', 20);