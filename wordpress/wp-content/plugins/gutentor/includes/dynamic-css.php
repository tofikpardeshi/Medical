<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Gutentor_Dynamic_CSS' ) ) :

	/**
	 * Create Dynamic CSS
	 *
	 * @package Gutentor
	 * @since 1.0.0
	 */
	class Gutentor_Dynamic_CSS {

		/**
		 * Rest route namespace.
		 *
		 * @var $namespace
		 */
		public $namespace = 'gutentor-dynamic-css/';

		/**
		 * Rest route version.
		 *
		 * @var $version
		 */
		public $version = 'v1';

		/**
		 * $all_google_fonts
		 *
		 * @var array
		 * @access public
		 * @since 1.0.0
		 */
		public $all_google_fonts = array();

		/**
		 * Main Instance
		 *
		 * Insures that only one instance of Gutentor_Dynamic_CSS exists in memory at any one
		 * time. Also prevents needing to define globals all over the place.
		 *
		 * @since    1.0.0
		 * @access   public
		 *
		 * @return object
		 */
		public static function instance() {

			// Store the instance locally to avoid private static replication
			static $instance = null;

			// Only run these methods if they haven't been ran previously
			if ( null === $instance ) {
				$instance = new Gutentor_Dynamic_CSS();
			}

			// Always return the instance
			return $instance;
		}

		/**
		 * Run functionality with hooks
		 *
		 * @since    1.0.0
		 * @access   public
		 *
		 * @return void
		 */
		public function run() {
			/*Rest Api to save*/
			add_action( 'rest_api_init', array( $this, 'register_routes' ) );

			add_action( 'render_block', array( $this, 'remove_block_css' ), 9999, 2 );
			add_filter( 'wp_head', array( $this, 'dynamic_css' ), 99 );
			add_action( 'wp_enqueue_scripts', array( $this, 'dynamic_css_enqueue' ), 9999 );

			add_filter( 'wp_head', array( $this, 'enqueue_google_fonts' ), 100 );
			add_filter( 'admin_head', array( $this, 'admin_enqueue_google_fonts' ), 100 );

		}

		/**
		 * Get google font url
		 *
		 * @since    1.0.0
		 * @access   public
		 *
		 * @return string
		 */
		public function isGutentorMetaExists() {
			return get_post_meta( get_the_ID(), 'gutentor_dynamic_css', true );
		}

		/**
		 * Get google font url
		 *
		 * @since    1.0.0
		 * @access   public
		 *
		 * @return string
		 */

		public function get_google_font_url( $gfonts ) {
			$fonts_url           = '';
			$unique_google_fonts = array();

			if ( ! empty( $gfonts ) ) {
				foreach ( $gfonts as $single_google_font ) {
					$font_family = str_replace( ' ', '+', $single_google_font['family'] );
					if ( isset( $single_google_font['font-weight'] ) ) {
						$unique_google_fonts[ $font_family ]['font-weight'][] = $single_google_font['font-weight'];
					}
				}
			}
			$google_font_family = '';
			if ( ! empty( $unique_google_fonts ) ) {
				foreach ( $unique_google_fonts as $font_family => $unique_google_font ) {
					if ( ! empty( $font_family ) ) {
						if ( $google_font_family ) {
							$google_font_family .= '|';
						}
						$google_font_family .= $font_family;
						if ( isset( $unique_google_font['font-weight'] ) ) {
							$unique_font_weights = array_unique( $unique_google_font['font-weight'] );
							if ( ! empty( $unique_font_weights ) ) {
								$google_font_family .= ':' . join( ',', $unique_font_weights );
							} else {
								$google_font_family .= ':' . 'regular';
							}
						}
					}
				}
			}

			if ( $google_font_family ) {
				$google_font_family = str_replace( 'italic', 'i', $google_font_family );
				$fonts_url          = add_query_arg(
					array(
						'family' => $google_font_family,
					),
					'//fonts.googleapis.com/css'
				);
			}
			return $fonts_url;
		}

		/**
		 * Register REST API route
		 */
		public function register_routes() {
			$namespace = $this->namespace . $this->version;

			register_rest_route(
				$namespace,
				'/save_dynamic_css',
				array(
					array(
						'methods'             => 'POST',
						'callback'            => array( $this, 'save_dynamic_css' ),
						'permission_callback' => function () {
							return current_user_can( 'edit_posts' );
						},
						'args'                => array(),
					),

				)
			);
		}

		/**
		 * Function to fetch template JSON.
		 *
		 * @return string
		 */
		public function save_dynamic_css( $request ) {

			$message = array();
			$params  = $request->get_params();
			$post_id = absint( $params['post_id'] );
			if ( $post_id ) {
				$message[]   = __( 'Have Post ID ', 'gutentor' );
				$dynamic_css = $params['dynamic_css'];
				$css         = $dynamic_css['css'];
				$gfonts      = $dynamic_css['gfonts'];
				if ( ! empty( $gfonts ) ) {
					$message[]       = __( 'Google fonts is not empty', 'gutentor' );
					$google_font_url = $this->get_google_font_url( $gfonts );
					if ( $google_font_url ) {
						$message[] = __( 'Successfully get google fonts url', 'gutentor' );
						update_post_meta( $post_id, 'gutentor_gfont_url', esc_url_raw( $google_font_url ) );
						$message[] = __( 'Successfully saved google fonts url', 'gutentor' );
					} else {
						$message[] = __( 'Fail to get google fonts url', 'gutentor' );
					}
				}
				// We will probably need to load this file
				if ( $css ) {
					$message[] = __( 'CSS is not empty', 'gutentor' );

					$minified_css = gutentor_dynamic_css()->minify_css( $css );
					update_post_meta( $post_id, 'gutentor_dynamic_css', $minified_css );
					$message[] = __( 'Successfully saved gutentor dynamic css', 'gutentor' );

					global $wp_filesystem;
					if ( ! $wp_filesystem ) {
						require_once ABSPATH . 'wp-admin' . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'file.php';
					}
					$upload_dir = wp_upload_dir();
					$dir        = trailingslashit( $upload_dir['basedir'] ) . 'gutentor' . DIRECTORY_SEPARATOR;

					WP_Filesystem();
					if ( ! $wp_filesystem->is_dir( $dir ) ) {
						$message[] = $dir . __( ' not exists', 'gutentor' );
						if ( $wp_filesystem->mkdir( $dir ) ) {
							$message[] = $dir . __( ' created', 'gutentor' );
						} else {
							$message[] = $dir . __( ' create permission issue', 'gutentor' );
						}
					} else {
						$message[] = $dir . __( ' exists', 'gutentor' );

					}
					if ( $wp_filesystem->put_contents( $dir . 'p-' . $post_id . '.css', $minified_css, 0644 ) ) {
						$message[] = __( 'Successfully created css file ', 'gutentor' ) . 'p-' . $post_id . '.css';
					} else {
						$message[] = __( 'Permission denied to create css file ', 'gutentor' ) . 'p-' . $post_id . '.css';
					}
				}
			} else {
				$message[] = __( 'No Post ID ', 'gutentor' );
			}
			wp_send_json_success( $message );
		}

		/**
		 * Set all_google_fonts
		 *
		 * @since    1.0.0
		 * @access   public
		 *
		 * @return void
		 */
		public function google_block_typography_prep( $block ) {
			if ( ! $this->isGutentorMetaExists() ) {
				if ( is_array( $block ) && isset( $block['attrs'] ) ) {
					$typography_data = array_filter(
						$block['attrs'],
						function ( $key ) {
							return strpos( $key, 'Typography' );
						},
						ARRAY_FILTER_USE_KEY
					);

					foreach ( $typography_data as $key => $typography ) {
						if ( is_array( $typography )
                            && isset( $typography['fontType'] )
                            && 'google' == $typography['fontType']
                            && isset( $typography['googleFont'] )
                            && isset( $typography['fontWeight'] )
                        ) {
							$this->all_google_fonts[] = array(
								'family'      => $typography['googleFont'] ,
								'font-weight' => $typography['fontWeight'],
							);

						}
					}
				}
			}

		}

		/**
		 * Prepare $post object for google font url or typography
		 *
		 * @since    1.1.4
		 * @access   public
		 *
		 * @return void
		 */
		public function post_google_typography_prep( $post ) {
			if ( isset( $post->ID ) ) {
				if ( has_blocks( $post->ID ) ) {
					if ( isset( $post->post_content ) ) {
						$blocks = parse_blocks( $post->post_content );
						if ( is_array( $blocks ) && ! empty( $blocks ) ) {
							foreach ( $blocks as $i => $block ) {
								/*google typography*/
								gutentor_dynamic_css()->google_block_typography_prep( $block );
							}
						}
					}
				}
			}
		}

		/**
		 * add google font on admin
		 *
		 * @since    1.0.0
		 * @access   public
		 *
		 * @return void|boolean
		 */
		public function admin_enqueue_google_fonts() {
			global $pagenow;
			if ( ! is_admin() ) {
				return false;
			}

			if ( in_array( $pagenow, array( 'post.php', 'post-new.php' ) ) ) {
				if ( ! $this->isGutentorMetaExists() ) {
					global $post;
					$blocks = parse_blocks( $post->post_content );
					if ( ! is_array( $blocks ) || empty( $blocks ) ) {
						return false;
					}
					foreach ( $blocks as $i => $block ) {
						$this->google_block_typography_prep( $block );
					}
				}
				$this->enqueue_google_fonts();
			}
		}

		/**
		 * Remove style from Gutentor Blocks
		 *
		 * @since    1.0.0
		 * @access   public
		 *
		 * @param string $block_content
		 * @param array  $block
		 * @return mixed
		 *
		 * Depreciated will be removed on version 2.0.3
		 */
		public function remove_block_css( $block_content, $block ) {
			if ( $this->isGutentorMetaExists() ) {
				return $block_content;
			}

			if ( ! is_admin() && is_array( $block ) && isset( $block['blockName'] ) && strpos( $block['blockName'], 'gutentor' ) !== false ) {
				$block_content = preg_replace( '~<style(.*?)</style>~Usi', '', $block_content );
			}
			return $block_content;
		}

		/**
		 * Add Googe Fonts
		 *
		 * @since    1.0.0
		 * @access   public
		 *
		 * @param string $block_content
		 * @param array  $block
		 * @return Mixed
		 */
		public function enqueue_google_fonts() {

			/*font family wp_enqueue_style*/
			if ( get_post_meta( get_the_ID(), 'gutentor_gfont_url', true ) ) {
				$fonts_url = get_post_meta( get_the_ID(), 'gutentor_gfont_url', true );
			} else {
				$all_google_fonts = apply_filters( 'gutentor_enqueue_google_fonts', $this->all_google_fonts );

				if ( empty( $all_google_fonts ) ) {
					return false;
				}
				$fonts_url = $this->get_google_font_url( $all_google_fonts );
			}

			if ( $fonts_url ) {
				echo '<link id="gutentor-google-fonts" href="' . esc_url( $fonts_url ) . '" rel="stylesheet" />';
			}
		}

		/**
		 * Get CSS without empty selector
		 * Call after minification of CSS
		 *
		 * @since    2.1.0
		 * @access   public
		 *
		 * @param string $minified_css
		 * @return string
		 */
		function get_css_without_empty_selector_after_minify( $minified_css ) {
			$css_explode        = explode( '}', $minified_css );
			$result             = '';
			$double_braces_open = false;
			foreach ( $css_explode as $index => $item ) {
				/*check if double braces*/
				$is_double_braces = substr_count( $item, '{' ) > 1;
				if ( $is_double_braces || ( $item != '' && substr( $item, -1 ) != '{' ) ) {
					if ( $is_double_braces ) {
						$inner_explode = explode( '{', $item );/*max 0,1,2 array,2optional if css property present*/
						$inner_item    = $inner_explode[0] . '{';
						if ( isset( $inner_explode[2] ) && $inner_explode[2] != '' ) {
							$inner_item .= $inner_explode[1] . '{' . $inner_explode[2] . '}';
						}
						$result .= $inner_item;
					} else {
						$result .= $item . '}';
					}

					/*check if double braces*/
					if ( $is_double_braces ) {
						$double_braces_open = true;
					}
				}
				/*close double braces*/
				if ( $double_braces_open && $item == '' ) {
					$result            .= '}';
					$double_braces_open = false;
				}
				/*
				How about more than double braces
				Not needed for now*/
			}
			return $result;
		}


		/**
		 * Minify CSS
		 *
		 * @since    1.0.0
		 * @access   public
		 *
		 * @param string $css
		 * @return string
		 */
		public function minify_css( $css = '' ) {

			// Return if no CSS
			if ( ! $css ) {
				return '';
			}

			// remove comments
			$css = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css );

			// Normalize whitespace
			$css = preg_replace( '/\s+/', ' ', $css );

			// Remove ; before }
			$css = preg_replace( '/;(?=\s*})/', '', $css );

			// Remove space after , : ; { } */ >
			$css = preg_replace( '/(,|:|;|\{|}|\*\/|>) /', '$1', $css );

			// Remove space before , ; { }
			$css = preg_replace( '/ (,|;|\{|})/', '$1', $css );

			// Strips leading 0 on decimal values (converts 0.5px into .5px)
			$css = preg_replace( '/(:| )0\.([0-9]+)(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}.${2}${3}', $css );

			// Strips units if value is 0 (converts 0px to 0)
			$css = preg_replace( '/(:| )(\.?)0(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}0', $css );

			// Trim
			$css = trim( $css );

			/*
			get_css_without_empty_selector since 2.1.0
			Double call it to fix media query issue
			*/
			$css = $this->get_css_without_empty_selector_after_minify( $css );
			$css = $this->get_css_without_empty_selector_after_minify( $css );

			// Return minified CSS
			return $css;

		}

		/**
		 * Inner_blocks
		 *
		 * @since      1.0.0
		 * @package    Gutentor
		 * @author     Gutentor <info@gutentor.com>
		 *
		 * @param array $blocks
		 * @return mixed
		 */
		public function inner_blocks( $blocks ) {
			$get_style = '';

			foreach ( $blocks as $i => $block ) {

				/*google typography*/
				$this->google_block_typography_prep( $block );

				if ( isset( $block['innerBlocks'] ) && ! empty( $block['innerBlocks'] ) && is_array( $block['innerBlocks'] ) ) {
					$get_style .= $this->inner_blocks( $block['innerBlocks'] );
				}
				if ( $block['blockName'] === 'core/block' && ! empty( $block['attrs']['ref'] ) ) {
					$reusable_block = get_post( $block['attrs']['ref'] );

					if ( ! $reusable_block || 'wp_block' !== $reusable_block->post_type ) {
						return '';
					}

					if ( 'publish' !== $reusable_block->post_status || ! empty( $reusable_block->post_password ) ) {
						return '';
					}

					$blocks     = parse_blocks( $reusable_block->post_content );
					$get_style .= $this->inner_blocks( $blocks );
				}

				if ( is_array( $block ) && isset( $block['innerHTML'] ) ) {
					preg_match( "'<style>(.*?)</style>'si", $block['innerHTML'], $match );
					if ( isset( $match[1] ) ) {
						$get_style .= $match[1];
					}
				}
			}
			return $get_style;
		}

		/**
		 * Single Stylesheet
		 *
		 * @since      1.0.0
		 * @package    Gutentor
		 * @author     Gutentor <info@gutentor.com>
		 *
		 * @param object $this_post
		 * @return mixed
		 */
		public function single_stylesheet( $this_post ) {

			$get_style = '';
			if ( isset( $this_post->ID ) ) {
				if ( has_blocks( $this_post->ID ) ) {
					if ( $this->isGutentorMetaExists() ) {
						$get_style = $this->isGutentorMetaExists();
					} elseif ( isset( $this_post->post_content ) ) {

						$blocks = parse_blocks( $this_post->post_content );
						if ( ! is_array( $blocks ) || empty( $blocks ) ) {
							return false;
						}
						$get_style = $this->inner_blocks( $blocks );
					}
				}
			}
			return $get_style;
		}

		/**
		 * css prefix
		 *
		 * @since      1.0.0
		 * @package    Gutentor
		 * @author     Gutentor <info@gutentor.com>
		 *
		 * @return mixed
		 */
		public function css_prefix( $post = false ) {
			if ( ! $post ) {
				global  $post;
			}
			if ( isset( $post ) && isset( $post->ID ) && has_blocks( $post->ID ) ) {
				return $post->ID;
			}
			return false;
		}

		/**
		 * Get dynamic CSS
		 *
		 * @since    1.0.0
		 * @access   public
		 *
		 * @param object $post
		 * @return mixed
		 */
		public function get_singular_dynamic_css( $post = false ) {

			$getCSS = '';
			if ( $post ) {
				$getCSS = $this->single_stylesheet( $post );
			} elseif ( is_singular() ) {
				global $post;
				$getCSS = $this->single_stylesheet( $post );
			} elseif ( is_archive() || is_home() || is_search() ) {
				global $wp_query;
				if ( isset( $wp_query->posts ) ) {
					foreach ( $wp_query->posts as $post ) {
						$getCSS .= $this->single_stylesheet( $post );
					}
				}
			}

			$output = gutentor_dynamic_css()->minify_css( $getCSS );
			return $output;
		}

		/**
		 * Callback function for wp_head
		 *
		 * @since    1.0.0
		 * @access   public
		 *
		 * @return void
		 */
		public static function dynamic_css() {
			if ( is_customize_preview() ) {
				?>
				<style type="text/css">
					<?php
					echo gutentor_post_format_colors( true );
					echo gutentor_post_featured_format_colors( true );
					echo gutentor_pm_post_categories_color( true );
					?>
				</style>
				<?php
			}
			if ( has_block( 'gutentor/p1' ) || has_block( 'gutentor/p2' ) ) {
				?>
				<style type="text/css">
					<?php
					echo gutentor_post_format_colors( true );
					echo gutentor_pm_post_categories_color( true );
					?>
				</style>
				<?php
			}
			if ( has_block( 'gutentor/p6' ) ) {
				?>
				<style type="text/css">
					<?php
					echo gutentor_post_format_colors( true );
					echo gutentor_post_featured_format_colors( true );
					echo gutentor_pm_post_categories_color( true );
					?>
				</style>
				<?php
			}

			$singularCSS = $combineCSS = '';

			if ( 'file' == apply_filters( 'gutentor_dynamic_style_location', 'head' ) ) {

				global $wp_customize;
				$upload_dir = wp_upload_dir();
				if ( is_singular() ) {
					global  $post;
					$cssPrefix = gutentor_dynamic_css()->css_prefix( $post );
					if ( isset( $wp_customize ) || ! file_exists( $upload_dir['basedir'] . '/gutentor/p-' . $cssPrefix . '.css' ) ) {
						$singularCSS = gutentor_dynamic_css()->get_singular_dynamic_css( $post );
						$combineCSS .= $singularCSS;
					}
				} elseif ( is_archive() || is_home() || is_search() ) {
					global $wp_query;
					if ( isset( $wp_query->posts ) ) {
						foreach ( $wp_query->posts as $post ) {
							$cssPrefix = gutentor_dynamic_css()->css_prefix( $post );
							if ( isset( $wp_customize ) || ! file_exists( $upload_dir['basedir'] . '/gutentor/p-' . $cssPrefix . '.css' ) ) {
								$singularCSS = gutentor_dynamic_css()->get_singular_dynamic_css( $post );
								$combineCSS .= $singularCSS;
							}
						}
					}
				}

				// Render CSS in the head
				if ( ! empty( $combineCSS ) ) {
					echo "<!-- Gutentor Dynamic CSS -->\n<style type=\"text/css\" id='gutentor-dynamic-css'>\n" . wp_strip_all_tags( wp_kses_post( $combineCSS ) ) . "\n</style>";
				}
			} else {
				if ( is_singular() ) {
					global  $post;
					$singularCSS .= gutentor_dynamic_css()->get_singular_dynamic_css( $post );
				} elseif ( is_archive() || is_home() || is_search() ) {
					global $wp_query;
					if ( isset( $wp_query->posts ) ) {
						foreach ( $wp_query->posts as $post ) {
							$singularCSS .= gutentor_dynamic_css()->get_singular_dynamic_css( $post );
						}
					}
				}
				$combineCSS = $singularCSS;
				// Render CSS in the head
				if ( ! empty( $combineCSS ) ) {
					echo "<!-- Gutentor Dynamic CSS -->\n<style type=\"text/css\" id='gutentor-dynamic-css'>\n" . wp_strip_all_tags( wp_kses_post( $combineCSS ) ) . "\n</style>";
				}
			}
		}


		/**
		 * Callback function for wp_enqueue_scripts
		 *
		 * @since    1.0.0
		 * @access   public
		 *
		 * @return void
		 */
		public static function dynamic_css_enqueue() {

			// If File is not selected
			if ( 'file' != apply_filters( 'gutentor_dynamic_style_location', 'head' ) ) {
				return false;
			}

			global $wp_customize;
			$upload_dir = wp_upload_dir();

			// Render CSS from the custom file
			if ( ! isset( $wp_customize ) ) {

				if ( is_singular() ) {
					global  $post;
					$cssPrefix   = gutentor_dynamic_css()->css_prefix( $post );
					$singularCSS = gutentor_dynamic_css()->get_singular_dynamic_css( $post );
					if ( ! empty( $singularCSS ) && file_exists( $upload_dir['basedir'] . '/gutentor/p-' . $cssPrefix . '.css' ) ) {
						wp_enqueue_style( 'gutentor-dynamic-' . $cssPrefix, trailingslashit( $upload_dir['baseurl'] ) . 'gutentor/p-' . $cssPrefix . '.css', false, null );
					}
				} elseif ( is_archive() || is_home() || is_search() ) {
					global $wp_query;
					if ( isset( $wp_query->posts ) ) {
						foreach ( $wp_query->posts as $post ) {
							$cssPrefix   = gutentor_dynamic_css()->css_prefix( $post );
							$singularCSS = gutentor_dynamic_css()->get_singular_dynamic_css( $post );
							if ( ! empty( $singularCSS ) && file_exists( $upload_dir['basedir'] . '/gutentor/p-' . $cssPrefix . '.css' ) ) {
								wp_enqueue_style( 'gutentor-dynamic-' . $cssPrefix, trailingslashit( $upload_dir['baseurl'] ) . 'gutentor/p-' . $cssPrefix . '.css', false, null );
							}
						}
					}
				}
			}
		}

	}
endif;

/**
 * Call Gutentor_Dynamic_CSS
 *
 * @since    1.0.0
 * @access   public
 */
if ( ! function_exists( 'gutentor_dynamic_css' ) ) {

	function gutentor_dynamic_css() {

		return Gutentor_Dynamic_CSS::instance();
	}
	gutentor_dynamic_css()->run();
}
