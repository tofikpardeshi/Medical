<?php
/**
 * The front-page template file.
 *
 * @package Acme Themes
 * @subpackage Medical Circle
 * @since Medical Circle 1.0.0
 */
get_header();

/**
 * medical_circle_action_front_page hook
 * @since Medical Circle 1.0.0
 *
 * @hooked medical_circle_featured_slider -  10
 * @hooked medical_circle_front_page -  20
 */
do_action( 'medical_circle_action_front_page' );

get_footer();