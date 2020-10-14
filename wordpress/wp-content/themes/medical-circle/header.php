<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Acme Themes
 * @subpackage Medical Circle
 */

/**
 * medical_circle_action_before_head hook
 * @since Medical Circle 1.0.0
 *
 * @hooked medical_circle_set_global -  0
 * @hooked medical_circle_doctype -  10
 */
do_action( 'medical_circle_action_before_head' );?>
	<head>

		<?php
		/**
		 * medical_circle_action_before_wp_head hook
		 * @since Medical Circle 1.0.0
		 *
		 * @hooked medical_circle_before_wp_head -  10
		 */
		do_action( 'medical_circle_action_before_wp_head' );

		wp_head();
		?>

	</head>
<body <?php body_class();?>>

<?php
/**
 * WordPress Default Hook
 * Triggered after the opening <body> tag.
 * wp_body_open hook
 *
 * @since WordPress 5.2
 *
 */
do_action( 'wp_body_open' );
/**
 * medical_circle_action_before hook
 * @since Medical Circle 1.0.0
 *
 * @hooked medical_circle_site_start - 20
 */
do_action( 'medical_circle_action_before' );

/**
 * medical_circle_action_before_header hook
 * @since Medical Circle 1.0.0
 *
 * @hooked medical_circle_skip_to_content - 10
 */
do_action( 'medical_circle_action_before_header' );

/**
 * medical_circle_action_header hook
 * @since Medical Circle 1.0.0
 *
 * @hooked medical_circle_header - 10
 */
do_action( 'medical_circle_action_header' );

/**
 * medical_circle_action_after_header hook
 * @since Medical Circle 1.0.0
 *
 * @hooked null
 */
do_action( 'medical_circle_action_after_header' );

/**
 * medical_circle_action_before_content hook
 * @since Medical Circle 1.0.0
 *
 * @hooked null
 */
do_action( 'medical_circle_action_before_content' );