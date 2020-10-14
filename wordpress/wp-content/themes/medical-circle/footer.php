<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Acme Themes
 * @subpackage Medical Circle
 */

/**
 * medical_circle_action_after_content hook
 * @since Medical Circle 1.0.0
 *
 * @hooked null
 */
do_action( 'medical_circle_action_after_content' );

/**
 * medical_circle_action_before_footer hook
 * @since Medical Circle 1.0.0
 *
 * @hooked null
 */
do_action( 'medical_circle_action_before_footer' );

/**
 * medical_circle_action_footer hook
 * @since Medical Circle 1.0.0
 *
 * @hooked medical_circle_footer - 10
 */
do_action( 'medical_circle_action_footer' );

/**
 * medical_circle_action_after_footer hook
 * @since Medical Circle 1.0.0
 *
 * @hooked null
 */
do_action( 'medical_circle_action_after_footer' );

/**
 * medical_circle_action_after hook
 * @since Medical Circle 1.0.0
 *
 * @hooked medical_circle_page_end - 10
 */
do_action( 'medical_circle_action_after' );

wp_footer();
?>
</body>
</html>