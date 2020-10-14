<?php
/**
 * Template Name: Gutentor Full Width
 *
 * @link https://developer.wordpress.org/themes/template-files-section/page-template-files/
 *
 * @package Gutentor
 */
get_header();
do_action( 'gutentor_template_before_loop' );
/* Start the Loop */
while ( have_posts() ) :
	the_post();

	the_content();

	// If comments are open or we have at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) {
		comments_template();
	}

endwhile; // End of the loop.
do_action( 'gutentor_template_after_loop' );
get_footer();
