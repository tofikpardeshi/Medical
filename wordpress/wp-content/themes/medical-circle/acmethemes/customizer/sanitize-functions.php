<?php
/**
 * Function to sanitize number
 *
 * @since Medical Circle 1.0.0
 *
 * @param $medical_circle_input
 * @param $medical_circle_setting
 * @return int || float || numeric value
 *
 */
if ( ! function_exists( 'medical_circle_sanitize_number' ) ) :
	function medical_circle_sanitize_number ( $medical_circle_input, $medical_circle_setting ) {
		$medical_circle_sanitize_text = sanitize_text_field( $medical_circle_input );

		// If the input is an number, return it; otherwise, return the default
		return ( is_numeric( $medical_circle_sanitize_text ) ? $medical_circle_sanitize_text : $medical_circle_setting->default );
	}
endif;

/**
 * Sanitizing the checkbox
 *
 * @since Medical Circle 1.0.0
 *
 * @param $checked
 * @return Boolean
 *
 */
if ( !function_exists('medical_circle_sanitize_checkbox') ) :
	function medical_circle_sanitize_checkbox( $checked ) {
		// Boolean check.
		return ( ( isset( $checked ) && true == $checked ) ? true : false );
	}
endif;

/**
 * Sanitizing the page/post
 *
 * @since Medical Circle 1.0.0
 *
 * @param $input user input value
 * @return sanitized output as $input
 *
 */
if ( !function_exists('medical_circle_sanitize_page') ) :
	function medical_circle_sanitize_page( $input ) {
		// Ensure $input is an absolute integer.
		$page_id = absint( $input );
		// If $page_id is an ID of a published page, return it; otherwise, return false
		return ( 'publish' == get_post_status( $page_id ) ? $page_id : false );
	}
endif;

/**
 * Sanitizing the select callback example
 *
 * @since Medical Circle 1.0.0
 *
 * @see sanitize_key()               https://developer.wordpress.org/reference/functions/sanitize_key/
 * @see $wp_customize->get_control() https://developer.wordpress.org/reference/classes/wp_customize_manager/get_control/
 *
 * @param $input
 * @param $setting
 * @return sanitized output
 *
 */
if ( !function_exists('medical_circle_sanitize_select') ) :
	function medical_circle_sanitize_select( $input, $setting ) {

		// Ensure input is a slug.
		$input = sanitize_key( $input );

		// Get list of choices from the control associated with the setting.
		$choices = $setting->manager->get_control( $setting->id )->choices;

		// If the input is a valid key, return it; otherwise, return the default.
		return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
	}
endif;

function medical_circle_sanitize_allowed_html ( $input ) {
	$allowed_html = wp_kses_allowed_html();
	$output = wp_kses($input, $allowed_html );
	return $output;
}

function medical_circle_sanitize_textarea( $input ) {
	if ( current_user_can( 'unfiltered_html' ) ) {
		$output = $input;
	} else {
		$output = medical_circle_sanitize_allowed_html( $input );
	}
	return $output;
}