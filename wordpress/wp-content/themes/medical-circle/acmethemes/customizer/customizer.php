<?php
/**
 * Medical Circle Theme Customizer.
 *
 * @package Acme Themes
 * @subpackage Medical Circle
 */

/*
* file for upgrade to pro
*/
require medical_circle_file_directory('acmethemes/customizer/customizer-pro/class-customize.php');

/*
* file for customizer core functions
*/
require medical_circle_file_directory('acmethemes/customizer/customizer-core.php');
/*
* file for customizer sanitization functions
*/
require medical_circle_file_directory('acmethemes/customizer/sanitize-functions.php');

/**
 * Adding different options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function medical_circle_customize_register( $wp_customize ) {

    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

    /*saved options*/
    $options  = medical_circle_get_theme_options();

    /*defaults options*/
    $defaults = medical_circle_get_default_theme_options();

    /*custom controls*/
    require medical_circle_file_directory('acmethemes/customizer/custom-controls.php');
	require medical_circle_file_directory('acmethemes/customizer/customizer-repeater/customizer-control-repeater.php');

    /*
     * file for feature panel of home page
     */
    require medical_circle_file_directory('acmethemes/customizer/feature-section/feature-panel.php');

    /*
    * file for header panel
    */
    require medical_circle_file_directory('acmethemes/customizer/header-options/header-panel.php');

    /*
    * file for customizer footer section
    */
    require medical_circle_file_directory('acmethemes/customizer/footer-options/footer-panel.php');

    /*
    * file for design/layout panel
    */
    require medical_circle_file_directory('acmethemes/customizer/design-options/design-panel.php');

    /*
     * file for options panel
     */
    require medical_circle_file_directory('acmethemes/customizer/options/options-panel.php');

	/*woocommerce options*/
	if ( medical_circle_is_woocommerce_active() ) :
		require_once medical_circle_file_directory('acmethemes/customizer/wc-options/wc-panel.php');
	endif;

    /*sorting core and widget for ease of theme use*/
    $wp_customize->get_section( 'static_front_page' )->priority = 10;
    
    $medical_circle_home_section = $wp_customize->get_section( 'sidebar-widgets-medical-circle-home' );
    if ( ! empty( $medical_circle_home_section ) ) {
        $medical_circle_home_section->panel = '';
        $medical_circle_home_section->title = __( 'Home Main Content Area ', 'medical-circle' );
        $medical_circle_home_section->priority = 80;
    }

}
add_action( 'customize_register', 'medical_circle_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function medical_circle_customize_preview_js() {
    wp_enqueue_script( 'medical-circle-customizer', get_template_directory_uri() . '/acmethemes/core/js/customizer.js', array( 'customize-preview' ), '1.1.2', true );
}
add_action( 'customize_preview_init', 'medical_circle_customize_preview_js' );


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function medical_circle_customize_controls_scripts() {
    wp_enqueue_script( 'medical-circle-customizer-controls', get_template_directory_uri() . '/acmethemes/core/js/customizer-controls.js', array( 'customize-preview' ), '1.1.0', true );
}
add_action( 'customize_controls_enqueue_scripts', 'medical_circle_customize_controls_scripts' );