<?php
/**
 * Sample implementation of the Custom Header feature.
 *
 * You can add an optional custom header image to header.php like so ...
 *
	<?php if ( get_header_image() ) : ?>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
		<img src="<?php header_image(); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="">
	</a>
	<?php endif; // End header image check. ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package Medical Circle
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses medical_circle_header_style()
 */
function medical_circle_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'medical_circle_custom_header_args', array(
		'default-image'      => get_template_directory_uri() . '/assets/img/medical.jpg',
		'width'              => 1920,
		'height'             => 1280,
		'flex-height'        => true,
		'header-text'        => false
	) ) );
	register_default_headers( array(
		'default-image' => array(
			'url'           => '%s/assets/img/medical.jpg',
			'thumbnail_url' => '%s/assets/img/medical.jpg',
			'description'   => __( 'Default Header Image', 'medical-circle' ),
		),
	) );
}
add_action( 'after_setup_theme', 'medical_circle_custom_header_setup' );