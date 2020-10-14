<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Check Isset
 *
 * @param  [mix] $var
 * @return [boolean]
 */
if ( ! function_exists( 'gutentor_isset' ) ) {
	function gutentor_isset( $var ) {
		if ( isset( $var ) ) {
			return $var;
		} else {
			return '';
		}
	}
}

/**
 * Convert into RBG Color
 * gutentor_rgb_string
 *
 * @param  [mix] $rgba
 * @return boolean | string
 */
if ( ! function_exists( 'gutentor_rgb_string' ) ) {
	function gutentor_rgb_string( $rgba ) {
		if ( ! is_array( $rgba ) ) {
			return null;
		}
		$roundA = round( 100 * $rgba['a'] ) / 100;
		return 'rgba(' . round( $rgba['r'] ) . ', ' . round( $rgba['g'] ) . ', ' . round( $rgba['b'] ) . ', ' . $roundA . ')';
	}
}

/**
 * Gutentor String Concat with space
 * gutentor_rgb_string
 *
 * @param  [mix] $rgba
 * @return boolean | string
 */
if ( ! function_exists( 'gutentor_concat_space' ) ) {
	function gutentor_concat_space( $class1, $class2 = '', $class3 = '', $class4 = '', $class5 = '', $class6 = '', $class7 = '', $class8 = '', $class9 = '', $class10 = '' ) {
		$output = $class1;
		if ( $class2 ) {
			$output = $output . ' ' . $class2;
		}
		if ( $class3 ) {
			$output = $output . ' ' . $class3;
		}
		if ( $class4 ) {
			$output = $output . ' ' . $class4;
		}
		if ( $class5 ) {
			$output = $output . ' ' . $class5;
		}
		if ( $class6 ) {
			$output = $output . ' ' . $class6;
		}
		if ( $class7 ) {
			$output = $output . ' ' . $class7;
		}
		if ( $class8 ) {
			$output = $output . ' ' . $class8;
		}
		if ( $class9 ) {
			$output = $output . ' ' . $class9;
		}
		if ( $class10 ) {
			$output = $output . ' ' . $class10;
		}
		return $output;

	}
}


/**
 * Check Empty
 * gutentor_not_empty
 *
 * @param  [mix] $var
 * @return [boolean]
 */
if ( ! function_exists( 'gutentor_not_empty' ) ) {

	function gutentor_not_empty( $var ) {
		if ( trim( $var ) === '' ) {
			return false;
		}
		return true;
	}
}

/**
 * Gutentor Unit Type
 * gutentor_unit_type
 *
 * @param  [mix] $type
 * @return string
 */
if ( ! function_exists( 'gutentor_unit_type' ) ) {

	function gutentor_unit_type( $type ) {
		if ( $type == 'px' ) {
			return 'px';
		} elseif ( $type == 'vh' ) {
			return 'vh';
		} else {
			return '%';
		}
	}
}

/**
 * Generate Css
 * gutentor_generate_css
 *
 * @param  [mix] $prop
 * @param  [mix] $value
 *
 * @return [string]
 */
if ( ! function_exists( 'gutentor_generate_css' ) ) {

	function gutentor_generate_css( $prop, $value ) {
		if ( ! is_string( $prop ) || ! is_string( $value ) ) {
			return '';
		}
		if ( $value ) {
			return '' . $prop . ': ' . $value . ';';
		}
		return '';
	}
}

/**
 * Get post excerpt
 *
 * @return string
 */
if ( ! function_exists( 'gutentor_get_excerpt_by_id' ) ) {
	function gutentor_get_excerpt_by_id( $post_id, $excerpt_length = 200, $in_words = false) {
		$the_post    = get_post( $post_id );
        $the_excerpt = $the_post->post_excerpt;
        if( !$the_excerpt){
            $the_excerpt = $the_post->post_content;
        }
        /*remove style tags*/
        $the_excerpt = preg_replace( '`\[[^\]]*\]`', '', $the_excerpt );
        $the_excerpt = strip_shortcodes( $the_excerpt );
        $the_excerpt = wp_strip_all_tags(  $the_excerpt);
		if( $in_words){
            $the_excerpt = wp_trim_words($the_excerpt, $excerpt_length);
        }
		else{
            $the_excerpt = $the_excerpt ? substr( $the_excerpt, 0, (int) $excerpt_length ).'...' : '';
        }
		return $the_excerpt;
	}
}

/**
 * Gutentor dynamic CSS
 *
 * @param array $dynamic_css
 *    $dynamic_css = array(
 * 'all'=>'css',
 * '768'=>'css',
 * );
 * @return mixed
 * @since    1.0.0
 */
if ( ! function_exists( 'gutentor_get_dynamic_css' ) ) {

	function gutentor_get_dynamic_css( $dynamic_css = array() ) {
		$getCSS      = '';
		$dynamic_css = apply_filters( 'gutentor_get_dynamic_css', $dynamic_css );

		if ( is_array( $dynamic_css ) ) {
			foreach ( $dynamic_css as $screen => $css ) {
				if ( $screen == 'all' ) {

					if ( is_array( $css ) ) {
						$getCSS .= implode( ' ', $css );
					} else {
						$getCSS .= $css;
					}
				} elseif ( $screen == 'tablet' ) {

					$getCSS .= '@media (min-width: 720px) {';
					if ( is_array( $css ) ) {
						$getCSS .= implode( ' ', $css );
					} else {
						$getCSS .= $css;
					}
					$getCSS .= '}';
				} elseif ( $screen == 'desktop' ) {

					$getCSS .= '@media (min-width: 992px) {';
					if ( is_array( $css ) ) {
						$getCSS .= implode( ' ', $css );
					} else {
						$getCSS .= $css;
					}
					$getCSS .= '}';
				}
			}
		}
		$output = $getCSS;

		return $output;
	}
}

/**
 *  GutentorButtonOptionsClasses
 *
 * @param null
 * @return string
 *
 * @since Gutentor 1.0.0
 */
if ( ! function_exists( 'GutentorButtonOptionsClasses' ) ) {

	function GutentorButtonOptionsClasses( $button ) {
		if ( $button === null || empty( $button ) ) {
			return false;
		}
		$output = '';
		$position = isset( $button['position'] ) ? $button['position'] : '';
		if($position){
			$output = 'gutentor-icon-' . $position;
		}
		return $output;
	}
}


/**
 *  GutentorBackgroundOptionsCSSClasses
 *
 * @param null
 * @return string
 *
 * @since Gutentor 1.0.0
 */
if ( ! function_exists( 'GutentorBackgroundOptionsCSSClasses' ) ) {

	/**
	 * Background Classes
	 *
	 * @param {string} backgroundType - The Background type
	 * @return {array} The inline CSS class.
	 */
	function GutentorBackgroundOptionsCSSClasses( $backgroundType ) {
		if ( $backgroundType === null || empty( $backgroundType ) ) {
			return false;
		}
		if ( 'image' === $backgroundType ) {
			return 'has-image-bg has-custom-bg';
		} elseif ( 'color' === $backgroundType ) {
			return 'has-color-bg has-custom-bg';
		} elseif ( 'video' === $backgroundType ) {
			return 'has-video-bg has-custom-bg';
		}
	}
}

/**
 * Set video output.
 *
 * @param {string} backgroundType
 * @param {object} backgroundVideo
 * @param {boolean} backgroundVideoLoop
 * @param {boolean} backgroundVideoMuted
 * @return {string} The video output container.
 */
if ( ! function_exists( 'GutentorBackgroundVideoOutput' ) ) {
	function GutentorBackgroundVideoOutput( $backgroundType, $backgroundVideo, $backgroundVideoLoop, $backgroundVideoMuted ) {
		if ( ! $backgroundVideo ) {
			return false;
		}
		$backgroundVideo_src = ( array_key_exists( 'url', $backgroundVideo ) ) ? $backgroundVideo['url'] : false;
		if ( 'video' === $backgroundType && $backgroundVideo_src ) {
			$muted = $backgroundVideoMuted ? "muted" : '';
			$video_container = '<video 
            autoPlay="true"
                loop="' . $backgroundVideoLoop . '"
                ' . $muted . '
                class="gutentor-bg-video"
                >
				<source
					type="video/mp4"
					src="' . $backgroundVideo_src . '"
				/>
			</video>';
			return $video_container;
		}
	}
}

/**
 *  GutentorButtonOptionsClasses
 *
 * @param null
 * @return string
 *
 * @since Gutentor 1.0.0
 */
if ( ! function_exists( 'GutentorAnimationOptionsDataAttr' ) ) {

	/**
	 * Background Classes
	 *
	 * @param {string} backgroundType - The Background type
	 * @return {array} The inline CSS class.
	 */
	function GutentorAnimationOptionsDataAttr( $valueAnimation ) {
		if ( $valueAnimation === null || empty( $valueAnimation ) ) {
			return false;
		}
		$animation_attr = '';

		$animation = ( isset( $valueAnimation['Animation'] ) && $valueAnimation['Animation'] ) ? $valueAnimation['Animation'] : '';
		if ( 'none' !== $animation ) {
			if ( ! empty( $animation ) ) {
				$animation_class = 'data-wow-animation = "' . $animation . '"';
				$animation_attr  = gutentor_concat_space( $animation_attr, $animation_class );
			}
			$delay = ( isset( $valueAnimation['Delay'] ) && $valueAnimation['Delay'] ) ? $valueAnimation['Delay'] : '';
			if ( ! empty( $delay ) ) {
				$delay_class    = 'data-wow-delay = "' . $delay . 's"';
				$animation_attr = gutentor_concat_space( $animation_attr, $delay_class );
			}
			$speed = ( isset( $valueAnimation['Speed'] ) && $valueAnimation['Speed'] ) ? $valueAnimation['Speed'] : '';
			if ( ! empty( $speed ) ) {
				$speed_class    = 'data-wow-speed = "' . $speed . 's"';
				$animation_attr = gutentor_concat_space( $animation_attr, $speed_class );
			}

			$iteration = ( isset( $valueAnimation['Iteration'] ) && $valueAnimation['Iteration'] ) ? $valueAnimation['Iteration'] : '';
			if ( ! empty( $iteration ) ) {
				$iteration_class = 'data-wow-iteration = "' . $iteration . '"';
				$animation_attr  = gutentor_concat_space( $animation_attr, $iteration_class );
			}
		}
		return $animation_attr;

	}
}

/**
 *  Customize Default Options
 *
 * @param null
 * @return array $gutentor_default_options
 *
 * @since Gutentor 1.0.0
 */
if ( ! function_exists( 'gutentor_get_default_options' ) ) :
	function gutentor_get_default_options() {
		$default_theme_options = array(
			'gutentor_map_api'                 => 'AIzaSyAq-PUmXMM3M2aQnwUslzap0TXaGyZlqZE',
			'gutentor_force_load_block_assets' => false,
			'gutentor_import_and_export_block_control' => false,
			'gutentor_dynamic_style_location'  => 'head',
			'gutentor_font_awesome_version'    => 5,
		);

		return apply_filters( 'gutentor_default_options', $default_theme_options );
	}
endif;

/**
 * Get options
 *
 * @param null
 * @return mixed gutentor_get_options
 *
 * @since Gutentor 1.0.0
 */
if ( ! function_exists( 'gutentor_get_options' ) ) :

	function gutentor_get_options( $key = '' ) {
		if ( ! empty( $key ) ) {
			$gutentor_default_options = gutentor_get_default_options();
			$gutentor_get_options     = get_option( $key, isset( $gutentor_default_options[ $key ] ) ? $gutentor_default_options[ $key ] : '' );
			return $gutentor_get_options;
		}
		return false;
	}
endif;

/**
 * Return "theme support" values from the current theme, if set.
 *
 * @return boolean
 * @since Gutentor 1.0.0
 */
if ( ! function_exists( 'gutentor_get_theme_support' ) ) :

	function gutentor_get_theme_support() {
		$theme_support = get_theme_support( 'gutentor' );

		return $theme_support;
	}
endif;

/**
 * Default color palettes
 *
 * @param null
 * @return array $gutentor_default_color_palettes
 *
 * @since CosmosWP 1.0.0
 */
if ( ! function_exists( 'gutentor_default_color_palettes' ) ) {

	function gutentor_default_color_palettes() {
		$palettes = array(
			'#000000',
			'#ffffff',
			'#dd3333',
			'#dd9933',
			'#eeee22',
			'#81d742',
			'#1e73be',
			'#8224e3',
		);
		return apply_filters( 'gutentor_default_color_palettes', $palettes );
	}
}

/**
 * Add Category Dynamic Css
 *
 * @param array $data
 * @param array $attributes
 * @return array | boolean
 * @since    1.0.0
 * @access   public
 */
if ( ! function_exists( 'gutentor_pm_post_categories_color' ) ) {
	function gutentor_pm_post_categories_color( $imp = false ) {
		$important = $imp ? ' !important;' : ';';

		/* device type */
		$local_dynamic_css = '';
		/*category color options*/
		$args       = array(
			'orderby'    => 'id',
			'hide_empty' => 0,
		);
		$categories = get_categories( $args );
		if ( $categories ) {
			foreach ( $categories as $category_list ) {
				$cat_color_css = '';
				/*get customize id*/
				$cat_color = 'gutentor-cat-' . esc_attr( $category_list->term_id );
				/* get category Color options */
				$cat_color = get_option( $cat_color );
				$cat_color = json_decode( $cat_color, true );
				/* cat text color */
				$cat_text_color = ( ! is_null( $cat_color ) && isset( $cat_color['text-color'] ) && ! empty( $cat_color['text-color'] ) ) ? $cat_color['text-color'] : '#1974d2';

				if ( $cat_text_color ) {
					$cat_color_css .= 'color:' . $cat_text_color . $important;

				}
				/* cat bg color */
				$cat_bg_color = ( ! is_null( $cat_color ) && isset( $cat_color['background-color'] ) && ! empty( $cat_color['background-color'] ) ) ? $cat_color['background-color'] : '#ffffff';
				if ( $cat_bg_color ) {
					$cat_color_css .= 'background:' . $cat_bg_color . $important;
				}
				/* add cat color css */
				if ( ! empty( $cat_color_css ) ) {
					$local_dynamic_css .= ".gutentor-categories .gutentor-cat-{$category_list->slug}{
                       " . $cat_color_css . '
                    }';
				}
				/* cat hover text color */
				$cat_color_hover_css  = '';
				$cat_text_hover_color = ( ! is_null( $cat_color ) && isset( $cat_color['text-hover-color'] ) && ! empty( $cat_color['text-hover-color'] ) ) ? $cat_color['text-hover-color'] : '#ffffff';

				if ( $cat_text_hover_color ) {
					$cat_color_hover_css .= 'color:' . $cat_text_hover_color . $important;
				}
				/* cat hover  bg color */
				$cat_bg_hover_color = ( ! is_null( $cat_color ) && isset( $cat_color['background-hover-color'] ) && ! empty( $cat_color['background-hover-color'] ) ) ? $cat_color['background-hover-color'] : '#1974d2';

				if ( $cat_bg_hover_color ) {
					$cat_color_hover_css .= 'background:' . $cat_bg_hover_color . $important;

				}
				/*add hover css*/
				if ( ! empty( $cat_color_hover_css ) ) {
					$local_dynamic_css .= ".gutentor-categories .gutentor-cat-{$category_list->slug}:hover{
                        " . $cat_color_hover_css . '
                    }';
				}
			}
		}
		return $local_dynamic_css;
	}
}

/**
 * Add Post Format Dynamic Css
 *
 * @param array $data
 * @param array $attributes
 * @return array | boolean
 * @since    1.0.0
 * @access   public
 */
if ( ! function_exists( 'gutentor_post_format_colors' ) ) {

	function gutentor_post_format_colors( $imp = false ) {
		$important         = $imp ? ' !important;' : ';';
		$local_dynamic_css = '';
		/*Post Format color options*/
		$post_formats = get_theme_support( 'post-formats' );
		if ( is_array( $post_formats ) && ! empty( $post_formats ) && isset( $post_formats[0] ) ) {
			$post_formats = $post_formats[0];
			if ( is_array( $post_formats ) && ! empty( $post_formats ) ) {
				array_unshift( $post_formats, 'standard' );
				foreach ( $post_formats as $post_format ) {
					$post_format_color_css = '';
					$post_format_data      = get_option( 'gutentor-pf-' . esc_attr( $post_format ) );
					$post_format_data      = json_decode( $post_format_data, true );
					$bg_color              = ( ! is_null( $post_format_data ) && isset( $post_format_data['bg_color'] ) && ! empty( $post_format_data['bg_color'] ) ) ? $post_format_data['bg_color'] : '#fff';
					$icon_color            = ( ! is_null( $post_format_data ) && isset( $post_format_data['icon_color'] ) && ! empty( $post_format_data['icon_color'] ) ) ? $post_format_data['icon_color'] : '#1974d2';
					if ( $icon_color ) {
						$post_format_color_css .= 'color:' . $icon_color . $important;
					}
					if ( $bg_color ) {
						$post_format_color_css .= 'background:' . $bg_color . $important;
					}
					/* add post format css */
					if ( ! empty( $post_format_color_css ) ) {
						$local_dynamic_css .= ".gutentor-post-format.gutentor-post-format-{$post_format}{
                       " . $post_format_color_css . '
                    }';
					}
				}
			}
		}

		return $local_dynamic_css;
	}
}

/**
 * Add Post Featured Format Dynamic Css
 *
 * @param array $data
 * @param array $attributes
 * @return array | boolean
 * @since    1.0.0
 * @access   public
 */
if ( ! function_exists( 'gutentor_post_featured_format_colors' ) ) {

	function gutentor_post_featured_format_colors( $imp = false ) {
		$important         = $imp ? ' !important;' : ';';
		$local_dynamic_css = '';
		/*Post Format color options*/
		$post_formats = get_theme_support( 'post-formats' );
		if ( is_array( $post_formats ) && ! empty( $post_formats ) && isset( $post_formats[0] ) ) {
			$post_formats = $post_formats[0];
			if ( is_array( $post_formats ) && ! empty( $post_formats ) ) {
				array_unshift( $post_formats, 'standard' );
				foreach ( $post_formats as $post_format ) {
					$post_format_color_css = '';
					$post_format_data      = get_option( 'gutentor-pf-' . esc_attr( $post_format ) );
					$post_format_data      = json_decode( $post_format_data, true );
					$bg_color              = ( ! is_null( $post_format_data ) && isset( $post_format_data['bg_color'] ) && ! empty( $post_format_data['bg_color'] ) ) ? $post_format_data['bg_color'] : '#fff';
					$icon_color            = ( ! is_null( $post_format_data ) && isset( $post_format_data['icon_color'] ) && ! empty( $post_format_data['icon_color'] ) ) ? $post_format_data['icon_color'] : '#1974d2';
					if ( $icon_color ) {
						$post_format_color_css .= 'color:' . $icon_color . $important;
					}
					if ( $bg_color ) {
						$post_format_color_css .= 'background:' . $bg_color . $important;
					}
					/* add post format css */
					if ( ! empty( $post_format_color_css ) ) {
						$local_dynamic_css .= ".gutentor-post-featured-format.gutentor-post-format-{$post_format}{
                       " . $post_format_color_css . '
                    }';
					}
				}
			}
		}

		return $local_dynamic_css;
	}
}

/**
 * gutentor_is_edit_page
 *
 * @since    1.0.0
 * @access   public
 */
if ( ! function_exists( 'gutentor_is_edit_page' ) ) {
	function gutentor_is_edit_page() {
		// make sure we are on the backend
		if ( ! is_admin() ) {
			return false;
		}
		global $pagenow;
		return in_array( $pagenow, array( 'post.php', 'post-new.php' ) );
	}
}

/**
 * Get Default Post Format
 *
 * @param array $post_format
 * @return string
 * @since    1.0.0
 * @access   public
 */
if ( ! function_exists( 'gutentor_get_post_format_default_icon' ) ) {
	function gutentor_get_post_format_default_icon( $post_format ) {
		switch ( $post_format ) :
			case 'aside':
				$icon = 'fas fa-columns';
				break;
			case 'image':
				$icon = 'fas fa-image';
				break;
			case 'video':
				$icon = 'fas fa-video';
				break;
			case 'quote':
				$icon = 'fas fa-quote-right';
				break;
			case 'link':
				$icon = 'fas fa-link';
				break;
			case 'gallery':
				$icon = 'far fa-images';
				break;
			case 'status':
				$icon = 'far fa-comment-dots';
				break;
			case 'audio':
				$icon = 'fas fa-microphone';
				break;
			case 'chat':
				$icon = 'far fa-comment-alt';
				break;
			default:
				$icon = 'fas fa-file-alt';
				break;
		endswitch;

		return $icon;

	}
}

/**
 * Get Default Post Format Icon
 *
 * @param array $post_format
 * @return string
 * @since    1.0.0
 * @access   public
 */
if ( ! function_exists( 'gutentor_get_post_format_icon' ) ) {
	function gutentor_get_post_format_icon( $post_format ) {
		$icon = gutentor_get_options( 'gutentor-pf-' . esc_attr( $post_format ) );
		if ( ! $icon ) {
			$icon = gutentor_get_post_format_default_icon( $post_format );
		}
		return $icon;
	}
}

/**
 * Get All Post Format Icon
 *
 * @param array $post_format
 * @return string
 * @since    1.0.0
 * @access   public
 */
if ( ! function_exists( 'gutentor_get_all_post_format_icons' ) ) {
	function gutentor_get_all_post_format_icons() {
		$post_formats = get_theme_support( 'post-formats' );
		$icons        = array();
		if ( is_array( $post_formats ) && ! empty( $post_formats ) && isset( $post_formats[0] ) ) {
			$post_formats = $post_formats[0];
			if ( is_array( $post_formats ) && ! empty( $post_formats ) ) {
				array_unshift( $post_formats, 'standard' );
				foreach ( $post_formats as $post_format ) {
					$post_format_icon         = gutentor_get_post_format_icon( $post_format );
					$decoded_post_format_icon = json_decode( gutentor_get_post_format_icon( $post_format ) );
					$icons[ $post_format ]    = is_null( $decoded_post_format_icon ) ? $post_format_icon : $decoded_post_format_icon;
				}
			}
		}
		return $icons;
	}
}

/**
 * Check Post Format Enable
 *
 * @return boolean
 * @since    1.0.0
 * @access   public
 */
if ( ! function_exists( 'gutentor_check_post_format_support_enable' ) ) {
	function gutentor_check_post_format_support_enable() {
		$post_formats = get_theme_support( 'post-formats' );
		if ( is_array( $post_formats ) && ! empty( $post_formats ) && isset( $post_formats[0] ) ) {
			if ( is_array( $post_formats[0] ) && ! empty( $post_formats[0] ) ) {
				return true;
			}
		}
		return false;
	}
}

/**
 * Convert boolean to string
 * gutentor_boolean_to_string
 *
 * @param  [mix] $var
 * @return [boolean]
 */
if ( ! function_exists( 'gutentor_boolean_to_string' ) ) {
	function gutentor_boolean_to_string( $var ) {
		if ( $var ) {
			return 'true';
		} else {
			return 'false';
		}
	}
}

/**
 * Convert array to html attr
 *
 * @param  [array] $attr_list
 * @return [string]
 */
if ( ! function_exists( 'gutentor_get_html_attr' ) ) {
	function gutentor_get_html_attr( $attr_list ) {
		if ( ! is_array( $attr_list ) ) {
			return '';
		}
		$attr = '';
		foreach ( $attr_list as $key => $value ) {
			if ( $value ) {
				$attr .= esc_attr( $key ) . '="' . esc_attr( $value ) . '" ';
			}
		}
		return $attr;
	}
}

/**
 * Function to create query args
 *
 * @param  [array] $attr
 * @return array
 */
function gutentor_get_query( $attr ) {
	$query_args = array(
		'posts_per_page'      => isset( $attr['posts_per_page'] ) ? $attr['posts_per_page'] : 3,
		'post_type'           => isset( $attr['post_type'] ) ? $attr['post_type'] : 'post',
		'orderby'             => isset( $attr['orderby'] ) ? $attr['orderby'] : 'date',
		'order'               => isset( $attr['order'] ) ? $attr['order'] : 'desc',
		'paged'               => isset( $attr['paged'] ) ? $attr['paged'] : 1,
		'ignore_sticky_posts' => true,
		'post_status'         => 'publish',
	);

	if ( isset( $attr['taxonomy'] ) && $attr['taxonomy'] &&
		isset( $attr['term'] ) && $attr['term'] && $attr['term'] != 'gAll' ) {
		$query_args['tax_query'] = array(
			array(
				'taxonomy' => $attr['taxonomy'],
				'field'    => 'id',
				'terms'    => $attr['term'],
			),
		);
	}
	if ( isset( $attr['offset'] ) && $attr['offset'] && ! ( $query_args['paged'] > 1 ) ) {
		$query_args['offset'] = isset( $attr['offset'] ) ? $attr['offset'] : 0;
	}
	if ( isset( $attr['post__in'] ) && $attr['post__in'] ) {
		$query_args['post__in'] = explode( ',', $attr['post__in'] );
	}
	if ( isset( $attr['post__not_in'] ) && $attr['post__not_in'] ) {
		$query_args['post__not_in'] = explode( ',', $attr['post__not_in'] );
	}
	return $query_args;
}

/**
 * Function to create query args
 *
 * @param  [array] $attr
 * @return array
 */
function gutentor_get_block_by_id( $blocks, $blockId ) {
	if ( is_array( $blocks ) && ! empty( $blocks ) ) {
		foreach ( $blocks as $block ) {

			if ( isset( $block['attrs']['gID'] ) && $block['attrs']['gID'] == $blockId ) {
				return $block;
			}
			if ( isset( $block['innerBlocks'] ) && ! empty( $block['innerBlocks'] ) && is_array( $block['innerBlocks'] ) ) {
				if ( gutentor_get_block_by_id( $block['innerBlocks'], $blockId ) ) {
					return gutentor_get_block_by_id( $block['innerBlocks'], $blockId );
				}
			}
		}
	}
	return array();
}

/**
 * Function create pagination
 *
 * @param  [array] $attr
 * @return String
 */
function gutentor_pagination( $paged = false, $max_num_pages = false ) {
	$phtml = '';
	if ( ! $paged ) {
		$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
	}
	if ( ! $max_num_pages ) {
		global $wp_query;
		$max_num_pages = $wp_query->max_num_pages;
		if ( ! $max_num_pages ) {
			$max_num_pages = 1;
		}
	}
	$mid_pages = $paged >= 3 ? array( $paged - 1, $paged, $paged + 1 ) : array( 1, 2, 3 );
	if ( $max_num_pages > 1 ) {
		if ( ! in_array( 1, $mid_pages ) ) {
			$phtml .= '<li class="gutentor-pagination-item">
                    <a class="gutentor-pagination-link" href="#" data-gpage="1">' . __( '1', 'gutentor' ) . '</a>
                </li>';
		}
		if ( $paged > 3 ) {
			$phtml .= '<li class="gutentor-pagination-item gutentor-pagination-dots"><a class="gutentor-pagination-link" href="#">...</a></li>';
		}
		foreach ( $mid_pages as $i ) {
			if ( $max_num_pages >= $i ) {
				$is_active = $paged === $i ? ' gutentor-pagination-active' : '';
				$phtml    .= '<li class="gutentor-pagination-item' . $is_active . '">
                    <a class="gutentor-pagination-link" href="#" data-gpage="' . $i . '">' . __( $i, 'gutentor' ) . '</a>
                </li>';
			}
		}
		if ( $max_num_pages > $paged + 1 ) {
			if ( $max_num_pages > 3 ) {
				$phtml .= '<li class="gutentor-pagination-item gutentor-pagination-dots"><a class="gutentor-pagination-link" href="#">...</a></li>';
			}
			if ( $max_num_pages > 3 ) {
				$phtml .= '<li class="gutentor-pagination-item">
                    <a class="gutentor-pagination-link" href="#" data-gpage="' . $max_num_pages . '">' . __( $max_num_pages, 'gutentor' ) . '</a>
                </li>';
			}
		}
	}
	return $phtml;
}


/**
 * Get Post Types.
 *
 * @since 2.1.0
 */
function gutentor_get_post_types() {

	$post_types = get_post_types(
		array(
			'public'       => true,
			'show_in_rest' => true,
		),
		'objects'
	);

	$options = array();

	foreach ( $post_types as $post_type ) {
		if ( 'product' === $post_type->name || 'attachment' === $post_type->name ) {
			continue;
		}

		$options[] = array(
			'value' => $post_type->name,
			'label' => $post_type->label,
		);
	}

	return $options;
}

function gutentor_is_array_empty( $array ) {
	foreach ( $array as $key => $val ) {
		if ( trim( $val ) !== '' ) {
			return false;
		}
	}
	return true;
}

/**
 * check if WooCommerce activated
 */
if ( !function_exists( 'gutentor_is_woocommerce_active' ) ) {

	function gutentor_is_woocommerce_active() {
		return class_exists( 'WooCommerce' ) ? true : false;
	}
}