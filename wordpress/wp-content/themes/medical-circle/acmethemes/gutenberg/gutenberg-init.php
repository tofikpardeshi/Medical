<?php
if ( ! function_exists( 'medical_circle_gutenberg_setup' ) ) :
	/**
	 * Making theme gutenberg compatible
	 */
	function medical_circle_gutenberg_setup() {
		add_theme_support( 'align-wide' );
		add_theme_support( 'wp-block-styles' );
	}
endif;
add_action( 'after_setup_theme', 'medical_circle_gutenberg_setup' );

function medical_circle_dynamic_editor_styles(){

	global $medical_circle_customizer_all_values;
	$medical_circle_link_color               = esc_attr( $medical_circle_customizer_all_values['medical_circle-link-color'] );
	$medical_circle_link_hover_color         = esc_attr( $medical_circle_customizer_all_values['medical_circle-link-hover-color'] );

	$custom_css = '';

	$custom_css .= "
            .edit-post-visual-editor, 
			.edit-post-visual-editor p {
               color: #666;
            }";

	$custom_css .= "
	        .wp-block .wp-block-heading h1, 
	        .wp-block .wp-block-heading h1 a,
	        .wp-block .wp-block-heading h2,
	        .wp-block .wp-block-heading h2 a,
	        .wp-block .wp-block-heading h3, 
	        .wp-block .wp-block-heading h3 a,
	        .wp-block .wp-block-heading h4, 
	        .wp-block .wp-block-heading h4 a,
	        .wp-block .wp-block-heading h5, 
	        .wp-block .wp-block-heading h5 a,
	        .wp-block .wp-block-heading h6,
	        .wp-block .wp-block-heading h6 a{
	            color: 3a3a3a;
	        }";

	$custom_css .= "
	        .wp-block a{
	            color: {$medical_circle_link_color};
	        }";
	$custom_css .= "
	        .wp-block a:hover,
	        .wp-block a:active,
	        .wp-block a:focus{
	            color: {$medical_circle_link_hover_color};
	        }";

        return wp_strip_all_tags( $custom_css );	
}

/**
 * Enqueue block editor style
 */
function medical_circle_block_editor_styles() {
	wp_enqueue_style( 'medical_circle-googleapis', '//fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i', array(), null );
	wp_enqueue_style( 'medical_circle-block-editor-styles', get_template_directory_uri() . '/acmethemes/gutenberg/gutenberg-edit.css', false, '1.0' );

	/**
	 * Styles from the customizer
	 */
	wp_add_inline_style( 'medical_circle-block-editor-styles', medical_circle_dynamic_editor_styles() );
}
add_action( 'enqueue_block_editor_assets', 'medical_circle_block_editor_styles',99 );

function medical_circle_gutenberg_scripts() {
	wp_enqueue_style( 'medical_circle-block-front-styles', get_template_directory_uri() . '/acmethemes/gutenberg/gutenberg-front.css', false, '1.0' );
	wp_style_add_data( 'medical_circle-block-front-styles', 'rtl', 'replace' );
}
add_action( 'wp_enqueue_scripts', 'medical_circle_gutenberg_scripts' );