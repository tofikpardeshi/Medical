<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Acme Themes
 * @subpackage Medical Circle
 */
if ( ! function_exists( 'medical_circle_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function medical_circle_entry_footer() {
	// Hide author, category and tag text for pages.
	if ( 'post' === get_post_type() ) {
	    printf(
            '%s',
            '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '"><i class="fa fa-user"></i>' . esc_html( get_the_author() ) . '</a></span>'
        );

		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'medical-circle' ) );
		if ( $categories_list && medical_circle_categorized_blog() ) {
            printf( '<span class="cat-links"><i class="fa fa-folder-o"></i>%1$s</span>', $categories_list ); // WPCS: XSS OK.
        }

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'medical-circle' ) );
		if ( $tags_list ) {
            printf( '<span class="tags-links"><i class="fa fa-tags"></i>%1$s</span>', $tags_list ); // WPCS: XSS OK.
        }
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link"><i class="fa fa-comment-o"></i>';
		comments_popup_link( esc_html__( 'Leave a comment', 'medical-circle' ), esc_html__( '1 Comment', 'medical-circle' ), esc_html__( '% Comments', 'medical-circle' ) );
		echo '</span>';
	}

	if ( get_edit_post_link() ) :
		edit_post_link(
			sprintf(
			/* translators: %s: Name of current post */
				esc_html__( 'Edit %s', 'medical-circle' ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			),
			'<span class="edit-link"><i class="fa fa-edit "></i>',
			'</span>'
		);
	endif;
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
if ( ! function_exists( 'medical_circle_categorized_blog' ) ) :
	function medical_circle_categorized_blog() {
		if ( false === ( $all_the_cool_cats = get_transient( 'medical_circle_categories' ) ) ) {
			// Create an array of all the categories that are attached to posts.
			$all_the_cool_cats = get_categories( array(
				'fields'     => 'ids',
				'hide_empty' => 1,

				// We only need to know if there is more than one category.
				'number'     => 2,
			) );

			// Count the number of categories that are attached to the posts.
			$all_the_cool_cats = count( $all_the_cool_cats );

			set_transient( 'medical_circle_categories', $all_the_cool_cats );
		}

		if ( $all_the_cool_cats > 1 ) {
			// This blog has more than 1 category so medical_circle_categorized_blog should return true.
			return true;
		} else {
			// This blog has only 1 category so medical_circle_categorized_blog should return false.
			return false;
		}
	}
endif;


/**
 * Flush out the transients used in medical_circle_categorized_blog.
 */
if ( ! function_exists( 'medical_circle_category_transient_flusher' ) ) :
	function medical_circle_category_transient_flusher() {
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}
		// Like, beat it. Dig?
		delete_transient( 'medical_circle_categories' );
	}
endif;
add_action( 'edit_category', 'medical_circle_category_transient_flusher' );
add_action( 'save_post',     'medical_circle_category_transient_flusher' );