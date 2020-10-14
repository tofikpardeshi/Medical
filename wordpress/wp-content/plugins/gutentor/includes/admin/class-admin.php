<?php
/**
 * Do things related with admin settings
 *
 * @since 1.0.0
 */

if ( ! class_exists( 'Gutentor_Admin' ) ) {
	/**
	 * Class Gutentor_Admin.
	 */
	class Gutentor_Admin extends Gutentor_Helper {

		protected static $page_slug = 'gutentor';

		public function __construct() {

			add_action( 'admin_menu', array( __CLASS__, 'admin_pages' ) );
			add_action( 'admin_init', array( __CLASS__, 'redirect' ) );

			$admin_scripts_access = array( 'gutentor', 'gutentor-getting-started', 'gutentor-blocks' );
			if ( isset( $_REQUEST['page'] ) && in_array( $_REQUEST['page'], $admin_scripts_access ) ) {
				add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );
			}
			add_action( 'enqueue_block_editor_assets', array( $this, 'admin_editor_scripts' ), '99' );
			self::initialize_ajax();
		}



		/**
		 * Redirect to plugin page when plugin activated
		 *
		 * @since 1.0.0
		 */
		public static function redirect() {
			if ( get_option( '__gutentor_do_redirect' ) ) {
				update_option( '__gutentor_do_redirect', false );
				if ( ! is_multisite() ) {
					exit( wp_redirect( admin_url( 'admin.php?page=' . self::$page_slug ) ) );
				}
			}
		}

		/**
		 * Admin Page Menu and submenu page
		 *
		 * @since 1.0.0
		 */
		public static function admin_pages() {

			if ( ! current_user_can( 'manage_options' ) ) {
				return;
			}

			add_menu_page(
				'gutentor',
				esc_html__( 'Gutentor', 'gutentor' ),
				'manage_options',
				self::$page_slug,
				array( __CLASS__, 'getting_started_template' ),
				'data:image/svg+xml;base64,' . base64_encode(
					'<svg version="1.1" id="gray-logo" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 width="44px" height="47.042px" viewBox="0 0 44 47.042" enable-background="new 0 0 44 47.042" xml:space="preserve">
<path fill="#9FA4A9" d="M42.397,13.536l-16.293-9.45c-0.732-0.424-1.935-0.427-2.667-0.006l-0.44,0.252
	c0.045,0.085,0.071,0.182,0.071,0.284v5.565c0,0.341-0.275,0.616-0.617,0.616h-5.565c-0.341,0-0.619-0.275-0.619-0.616V8.2
	l-1.199,0.69v6.151c0,0.382-0.31,0.69-0.689,0.69h-6.21c-0.38,0-0.688-0.309-0.688-0.69V13.25l-0.376,0.216
	c-0.734,0.422-1.338,1.461-1.339,2.309L5.76,18.553h3.42c0.327,0,0.593,0.265,0.593,0.594v5.348c0,0.329-0.266,0.596-0.593,0.596
	H5.748l-0.019,9.521c-0.001,0.849,0.597,1.89,1.33,2.313l16.295,9.452c0.732,0.424,1.935,0.428,2.669,0.005l16.332-9.388
	c0.732-0.421,1.336-1.461,1.337-2.311l0.039-18.834C43.732,15.003,43.134,13.961,42.397,13.536z M34.535,30.71l-9.631,5.758
	L15.086,31l-0.175-11.235l9.643-5.771l9.1,5.067l-1.393,2.499l-7.657-4.263l-6.807,4.074l0.122,7.935l6.933,3.86l6.82-4.08v-1.083
	l-6.103-0.122l0.059-2.861l8.906,0.179V30.71z"/>
<path fill="#9FA4A9" d="M5.866,11.788c0,0.111-0.09,0.203-0.201,0.203H3.849c-0.11,0-0.202-0.092-0.202-0.203V9.974
	c0-0.113,0.091-0.203,0.202-0.203h1.816c0.111,0,0.201,0.09,0.201,0.203V11.788z"/>
<path fill="#9FA4A9" d="M4.048,17.141c0,0.187-0.15,0.336-0.336,0.336H0.691c-0.187,0-0.336-0.149-0.336-0.336v-3.022
	c0-0.184,0.149-0.334,0.336-0.334h3.021c0.186,0,0.336,0.15,0.336,0.334V17.141z"/>
<rect x="8.79" y="9.445" fill="#9FA4A9" width="5.202" height="5.202"/>
<rect x="17.342" y="5.137" fill="#9FA4A9" width="4.82" height="4.819"/>
<path fill="#9FA4A9" d="M9.261,7.286c0,0.179-0.145,0.324-0.324,0.324H6.025C5.847,7.61,5.7,7.465,5.7,7.286V4.375
	c0-0.178,0.146-0.325,0.325-0.325h2.912c0.179,0,0.324,0.146,0.324,0.325V7.286z"/>
<path fill="#9FA4A9" d="M15.298,6.035c0,0.178-0.145,0.323-0.323,0.323h-2.913c-0.179,0-0.324-0.145-0.324-0.323V3.121
	c0-0.177,0.146-0.323,0.324-0.323h2.913c0.178,0,0.323,0.146,0.323,0.323V6.035z"/>
<path fill="#9FA4A9" d="M19.745,2.948c0,0.149-0.122,0.271-0.272,0.271h-2.455c-0.152,0-0.274-0.123-0.274-0.271V0.491
	c0-0.149,0.122-0.272,0.274-0.272h2.455c0.15,0,0.272,0.124,0.272,0.272V2.948z"/>
<rect x="4.154" y="19.683" fill="#9FA4A9" width="4.546" height="4.546"/>
</svg>'
				),
				110
			);

			add_submenu_page(
				'gutentor',
				esc_html__( 'Getting Started Page', 'gutentor' ),
				esc_html__( 'Getting Started', 'gutentor' ),
				'manage_options',
				self::$page_slug,
				array( __CLASS__, 'getting_started_template' )
			);

			add_submenu_page(
				'gutentor',
				esc_html__( 'Blocks', 'gutentor' ),
				esc_html__( 'Blocks', 'gutentor' ),
				'manage_options',
				'gutentor-blocks',
				array( __CLASS__, 'gutentor_blocks_template' )
			);
		}

		/**
		 * Enqueue styles & scripts for frontend & backend
		 *
		 * @access public
		 * @uses wp_enqueue_style
		 * @return void
		 * @since Gutentor 1.0.0
		 */
		public static function admin_scripts() {

			/*
			---------------------------------------------*
			* Register Style for Admin Page               *
			*---------------------------------------------*/
			$scripts = array(
				array(
					'handler'  => 'magnific-popup',
					'absolute' => true,
					'style'    => GUTENTOR_URL . 'assets/library/magnific-popup/magnific-popup' . GUTENTOR_SCRIPT_PREFIX . '.css',
				),
				array(
					'handler'  => 'gutentor-admin-css',
					'absolute' => true,
					'style'    => GUTENTOR_URL . 'dist/blocks.admin.build.css',
				),
				array(
					'handler'  => 'magnific-popup',
					'absolute' => true,
					'script'   => GUTENTOR_URL . 'assets/library/magnific-popup/jquery.magnific-popup' . GUTENTOR_SCRIPT_PREFIX . '.js',
				),
				array(
					'handler'  => 'gutentor-admin-js',
					'absolute' => true,
					'script'   => GUTENTOR_URL . 'assets/js/admin-script' . GUTENTOR_SCRIPT_PREFIX . '.js',
				),
			);

			self::enqueue( $scripts );

			$localize = array(
				'ajax_url'   => admin_url( 'admin-ajax.php' ),
				'ajax_nonce' => wp_create_nonce( 'gutentor-block-nonce' ),
			);
			wp_localize_script( 'gutentor-admin-js', 'GUTENTOR_SETTINGS', $localize );
		}

		/**
		 * Enqueue styles & scripts for frontend & backend
		 *
		 * @access public
		 * @uses wp_enqueue_style
		 * @return void
		 * @since Gutentor 1.0.0
		 */
		public static function admin_editor_scripts() {

			/*
			---------------------------------------------*
			 * Register Style for Admin Page               *
			 *---------------------------------------------*/
			$scripts = array(
				array(
					'handler'    => 'gutentor-block-deactivate-js',
					'absolute'   => true,
					'script'     => GUTENTOR_URL . 'assets/js/blocks-deactivate' . GUTENTOR_SCRIPT_PREFIX . '.js',
					'dependency' => array( 'wp-blocks' ),
				),
			);

			self::enqueue( $scripts );

			$localize = array(
				'status' => self::block_action(),
			);
			wp_localize_script( 'gutentor-block-deactivate-js', 'GUTENTOR_BLOCKS', $localize );

		}

		/**
		 * Render Getting Started Template
		 *
		 * @return void
		 */
		public static function getting_started_template() {
			require_once GUTENTOR_PATH . 'includes/admin/templates/getting-started-page.php';
		}

		/**
		 * Render Blocks Template
		 *
		 * @since 1.0.0
		 */
		public static function gutentor_blocks_template() {
			require_once GUTENTOR_PATH . 'includes/admin/templates/admin-page.php';
		}

		/**
		 * Initialize Ajax
		 */
		public static function initialize_ajax() {
			// Ajax requests.
			add_action( 'wp_ajax_activate_block', array( __CLASS__, 'activate_block' ) );
			add_action( 'wp_ajax_deactivate_block', array( __CLASS__, 'deactivate_block' ) );

			add_action( 'wp_ajax_bulk_activate_blocks', array( __CLASS__, 'bulk_activate_blocks' ) );
			add_action( 'wp_ajax_bulk_deactivate_blocks', array( __CLASS__, 'bulk_deactivate_blocks' ) );
		}

		public static function block_action( $action = 'get', $blocks = array() ) {

			$key = '_GUTENTOR_BLOCKS';
			switch ( $action ) {
				case 'get':
					return self::get_option( $key, array() );
				case 'update':
					self::update_option( $key, $blocks );
					break;

			}
		}

		public static function is_block_active( $block_id ) {
			$blocks = self::block_action();

			if ( ! isset( $blocks[ $block_id ] ) || $blocks[ $block_id ] == $block_id ) {
				return true;
			} else {
				return false;
			}
		}

		public static function is_all_block_active() {
			$blocks = self::block_action();
			foreach ( $blocks as $b ) {
				if ( $b == 'disabled' ) {
					return false;
				}
			}

			return true;
		}

		/**
		 * Activate block
		 */
		public static function activate_block() {

			check_ajax_referer( 'gutentor-block-nonce', 'nonce' );

			$block_id            = sanitize_text_field( $_POST['block_id'] );
			$blocks              = self::block_action();
			$blocks[ $block_id ] = $block_id;
			$blocks              = array_map( 'esc_attr', $blocks );

			// Update blocks.
			self::update_option( '_GUTENTOR_BLOCKS', $blocks );

			echo $block_id;

			die();
		}

		/**
		 * Deactivate block
		 */
		public static function deactivate_block() {

			check_ajax_referer( 'gutentor-block-nonce', 'nonce' );

			$block_id            = sanitize_text_field( $_POST['block_id'] );
			$blocks              = self::block_action();
			$blocks[ $block_id ] = 'disabled';
			$blocks              = array_map( 'esc_attr', $blocks );

			// Update blocks.
			self::block_action( 'update', $blocks );

			echo $block_id;

			die();
		}

		/**
		 * Activate all module
		 */
		public static function bulk_activate_blocks() {

			check_ajax_referer( 'gutentor-block-nonce', 'nonce' );

			// Get all blocks.
			$all_blocks = self::$block_list;
			$new_blocks = array();

			// Set all extension to enabled.
			foreach ( $all_blocks as $slug => $value ) {
				$_slug                = str_replace( 'gutentor/', '', $slug );
				$new_blocks[ $_slug ] = $_slug;
			}

			// Escape attrs.
			$new_blocks = array_map( 'esc_attr', $new_blocks );

			// Update new_extensions.
			self::block_action( 'update', $new_blocks );

			echo 'success';

			die();
		}

		/**
		 * Deactivate all module
		 */
		public static function bulk_deactivate_blocks() {

			check_ajax_referer( 'gutentor-block-nonce', 'nonce' );

			// Get all extensions.
			$old_blocks = self::$block_list;
			$new_blocks = array();

			// Set all extension to enabled.
			foreach ( $old_blocks as $slug => $value ) {
				$_slug                = str_replace( 'gutentor/', '', $slug );
				$new_blocks[ $_slug ] = 'disabled';
			}

			// Escape attrs.
			$new_blocks = array_map( 'esc_attr', $new_blocks );

			// Update new_extensions.
			self::update_option( '_GUTENTOR_BLOCKS', $new_blocks );

			echo 'success';

			die();
		}

		public static function elements() {

			$gutentor_elements = array(
				'e1'      => array(
					'title'       => esc_html__( 'Advanced Text', 'gutentor' ),
					'description' => esc_html__( 'Insert text with advanced options ', 'gutentor' ),
				),
				'e2'      => array(
					'title'       => esc_html__( 'Button', 'gutentor' ),
					'description' => esc_html__( 'Prompt visitors to take action with attractive buttons.', 'gutentor' ),
				),
				'e3'      => array(
					'title'       => esc_html__( 'Counter', 'gutentor' ),
					'description' => esc_html__( ' Insert an animated number to display the counter number.', 'gutentor' ),
				),
				'divider' => array(
					'title'       => esc_html__( 'Divider', 'gutentor' ),
					'description' => esc_html__( 'Divider differentiate sections and elements with shape.', 'gutentor' ),
				),
				'e4'      => array(
					'title'       => esc_html__( 'Google Map', 'gutentor' ),
					'description' => esc_html__( 'Display a Google Map on your website with Google Map API.', 'gutentor' ),
				),
				'e5'      => array(
					'title'       => esc_html__( 'Icon', 'gutentor' ),
					'description' => esc_html__( 'Insert an icon to symbolize the text', 'gutentor' ),
				),
				'e6'      => array(
					'title'       => esc_html__( 'Image', 'gutentor' ),
					'description' => esc_html__( 'Insert an image to create extra value on the content.', 'gutentor' ),
				),
				'e7'      => array(
					'title'       => esc_html__( 'List', 'gutentor' ),
					'description' => esc_html__( 'Represent the paragraphs in tabbed styles', 'gutentor' ),
				),
				'e8'      => array(
					'title'       => esc_html__( 'Pricing', 'gutentor' ),
					'description' => esc_html__( 'Insert the pricing to showcase the price of the product.', 'gutentor' ),
				),
				'e9'      => array(
					'title'       => esc_html__( 'Progress Bar', 'gutentor' ),
					'description' => esc_html__( 'Showcase the progress of the work in an animated form.', 'gutentor' ),
				),
				'e10'     => array(
					'title'       => esc_html__( 'Rating', 'gutentor' ),
					'description' => esc_html__( 'Insert the rating element to represent the rating from 1-5 star.', 'gutentor' ),
				),
				'e0'      => array(
					'title'       => esc_html__( 'Simple Text', 'gutentor' ),
					'description' => esc_html__( 'Insert text with minimal options ', 'gutentor' ),
				),
				'e11'     => array(
					'title'       => esc_html__( 'Video Popup', 'gutentor' ),
					'description' => esc_html__( 'Insert video in your website.', 'gutentor' ),
				),

			);

			return apply_filters( 'gutentor_elements_in_admin_page', $gutentor_elements );
		}


		public static function modules() {

			$gutentor_modules = array(

				'm6' => array(
					'title'       => esc_html__( 'Accordion ', 'gutentor' ),
					'description' => esc_html__( 'Design collapsable items and pin any Gutentor Elements in Accordion Body.', 'gutentor' ),
				),
				'm4' => array(
					'title'       => esc_html__( 'Advanced Columns', 'gutentor' ),
					'description' => esc_html__( 'Insert advanced columns to create customizable columns within the page. ', 'gutentor' ),
				),
				'm1' => array(
					'title'       => esc_html__( 'Button Group', 'gutentor' ),
					'description' => esc_html__( ' Insert button group and add unlimited buttons.', 'gutentor' ),
				),
				'm0' => array(
					'title'       => esc_html__( 'Carousel', 'gutentor' ),
					'description' => esc_html__( 'Insert carousel column and add element inside the columns. ', 'gutentor' ),
				),
				'm3' => array(
					'title'       => esc_html__( 'Container/Cover Block', 'gutentor' ),
					'description' => esc_html__( 'Insert whole block of single container on the page', 'gutentor' ),
				),
				'm2' => array(
					'title'       => esc_html__( 'Dynamic Columns', 'gutentor' ),
					'description' => esc_html__( 'Insert dynamic columns to insert unlimited predefined columns ', 'gutentor' ),
				),
				'm9' => array(
					'title'       => esc_html__( 'Form Wrapper', 'gutentor' ),
					'description' => esc_html__( 'Use (contact form) shortcode and design form input field, text area and button according to your need.', 'gutentor' ),
				),
				'm8' => array(
					'title'       => esc_html__( 'Icon Group ', 'gutentor' ),
					'description' => esc_html__( 'Insert multiple icons in the Icon Group and create beautiful social profile links and icon designs.', 'gutentor' ),
				),
				'm5' => array(
					'title'       => esc_html__( 'Slider ', 'gutentor' ),
					'description' => esc_html__( 'Insert slider container and add elements within the container.', 'gutentor' ),
				),
				'm7' => array(
					'title'       => esc_html__( 'Tabs ', 'gutentor' ),
					'description' => esc_html__( 'Add tab items with tab title and content, allowed to add any gutentor element inside it.', 'gutentor' ),
				),

			);

			return apply_filters( 'gutentor_modules_in_admin_page', $gutentor_modules );
		}

		public static function posts() {

			$gutentor_posts = array(

				'p4' => array(
					'title'       => esc_html__( 'Advanced Post Module', 'gutentor' ),
					'description' => esc_html__( 'Combination of multiple blocks like Post Module, Post Header, Post Footer.', 'gutentor' ),
				),
				'p6' => array(
					'title'       => esc_html__( 'Duplex Post Module', 'gutentor' ),
					'description' => esc_html__( 'Design post in two different ways – Feature Post and Normal Post, post design will be more beautiful.', 'gutentor' ),
				),
				'p5' => array(
					'title'       => esc_html__( 'News Ticker', 'gutentor' ),
					'description' => esc_html__( 'Display Marquee, Vertical, Horizontal or Typewriter News Ticker from post or post type.', 'gutentor' ),
				),
				'p3' => array(
					'title'       => esc_html__( 'Post Carousel', 'gutentor' ),
					'description' => esc_html__( 'Display post or post type in carousel mode.', 'gutentor' ),
				),
				'p2' => array(
					'title'       => esc_html__( 'Post Feature Module', 'gutentor' ),
					'description' => esc_html__( 'Display post with news and magazine style.', 'gutentor' ),
				),
				'p1' => array(
					'title'       => esc_html__( 'Post Module', 'gutentor' ),
					'description' => esc_html__( 'Display Blog post with list and grid view from post module.', 'gutentor' ),
				),
			);
			return apply_filters( 'gutentor_posts_in_admin_page', $gutentor_posts );
		}

		public static function content() {

			$gutentor_block_collection = array(
				'about-block'        => array(
					'title'       => esc_html__( 'About Block', 'gutentor' ),
					'description' => esc_html__( 'The About block gives short description related to product, person or any items with a large section of a photo, title, description, and button with customise setting and different templates.', 'gutentor' ),
				),
				'accordion'          => array(
					'title'       => esc_html__( 'Accordion', 'gutentor' ),
					'description' => esc_html__( 'The Accordion block helps you to display information in collapsible rows with title ,description and button. Generally this block can be helpful for display FAQ and other informative message. ', 'gutentor' ),
				),
				'advanced-columns'   => array(
					'title'       => esc_html__( 'Advanced Columns', 'gutentor' ),
					'description' => esc_html__( 'The Advanced block has a number of advanced features of a column where it facilitates user to choose layout of row in term of column.e.g 1 column, 2 column layout and many more.', 'gutentor' ),
				),
				'author-profile'     => array(
					'title'       => esc_html__( 'Author Profile', 'gutentor' ),
					'description' => esc_html__( 'The Author Profile block allows user to display information related to author with title, description and button', 'gutentor' ),
				),
				'blog-post'          => array(
					'title'       => esc_html__( 'Blog Post', 'gutentor' ),
					'description' => esc_html__( 'The Blog Post block display collection of posts with different setting related to post items and many more templates.', 'gutentor' ),
				),
				'callback-to-action' => array(
					'title'       => esc_html__( 'Callback To Action', 'gutentor' ),
					'description' => esc_html__( 'The Call to Action block helps user to trigger certain action with collection of button.It is usable to link learn more, download, buy etc.', 'gutentor' ),
				),
				'content-box'        => array(
					'title'       => esc_html__( 'Content Box', 'gutentor' ),
					'description' => esc_html__( 'Content Box block is useful to preset plain title, content and button without image and icon.', 'gutentor' ),
				),
				'count-down'         => array(
					'title'       => esc_html__( 'Countdown', 'gutentor' ),
					'description' => esc_html__( 'This block is useful for setting a countdown feature on your website. It is extremely helpful for any event show related website.', 'gutentor' ),
				),
				'counter-box'        => array(
					'title'       => esc_html__( 'Counter', 'gutentor' ),
					'description' => esc_html__( 'Counter Block represents the facts and figure related to any product, item or any product with cool animation , features and many more fascinated templates.', 'gutentor' ),
				),
				'featured-block'     => array(
					'title'       => esc_html__( 'Featured Block', 'gutentor' ),
					'description' => esc_html__( 'The Featured block displays large section with a photo, title, description, and button with awesome template. Generally, it is useful to header part of the site.', 'gutentor' ),
				),
				'gallery'            => array(
					'title'       => esc_html__( 'Gallery', 'gutentor' ),
					'description' => esc_html__( 'The Gallery Block allows user to create mesmerizing gallery of image with caption which is perfect showcase of image of portfolio, services or product.', 'gutentor' ),
				),
				'google-map'         => array(
					'title'       => esc_html__( 'Google Map', 'gutentor' ),
					'description' => esc_html__( 'Google Map block facilitates user to display the location of organization, company or any place with advanced features of google map. ', 'gutentor' ),
				),
				'icon-box'           => array(
					'title'       => esc_html__( 'Icon Box', 'gutentor' ),
					'description' => esc_html__( 'Icon Box block facilitates to show off a short brief about the users services with Font Awesome icons with cool templates and features.', 'gutentor' ),
				),
				'image-box'          => array(
					'title'       => esc_html__( 'Image Box', 'gutentor' ),
					'description' => esc_html__( 'The Image Box display information with image, title, description and button which modify by available features and cool templates.', 'gutentor' ),
				),
				'image-slider'       => array(
					'title'       => esc_html__( 'Image Slider', 'gutentor' ),
					'description' => esc_html__( 'The Image Slider Block display adorable slider with image, title, description and button which modify by available features and cool templates.', 'gutentor' ),
				),
				'opening-hours'      => array(
					'title'       => esc_html__( 'Opening Hours', 'gutentor' ),
					'description' => esc_html__( 'The Opening Hours Block depicts the information related to opening schedule of any organization or any place with cool templates.', 'gutentor' ),
				),
				'pricing'            => array(
					'title'       => esc_html__( 'Pricing Box', 'gutentor' ),
					'description' => esc_html__( 'The Pricing Box block represents the pricing details of any commodity with number of customize features and cool templates .', 'gutentor' ),
				),
				'progress-bar'       => array(
					'title'       => esc_html__( 'Progress Bar', 'gutentor' ),
					'description' => esc_html__( 'The progress bar block facilitates user create a customizable bar and/or circle progress counter to represent percentage values.', 'gutentor' ),
				),
				'restaurant-menu'    => array(
					'title'       => esc_html__( 'Restaurant Menu', 'gutentor' ),
					'description' => esc_html__( 'The Restaurant Menu block represents the information items and recipes available in restaurant with different features and cool templates.', 'gutentor' ),
				),
				'social'             => array(
					'title'       => esc_html__( 'Social', 'gutentor' ),
					'description' => esc_html__( 'The Social block displays the social networks page on website with different templates and a number of features.', 'gutentor' ),
				),
				'tabs'               => array(
					'title'       => esc_html__( 'Tabs', 'gutentor' ),
					'description' => esc_html__( 'The Tab block facilitates user to display content in a fully tabbed UX which contains title, description and buttons with number of templates.', 'gutentor' ),
				),
				'team'               => array(
					'title'       => esc_html__( 'Team', 'gutentor' ),
					'description' => esc_html__( 'With the team block users can create an attractive and sophisticated team section where they can represent the team members of their company in a professional way.', 'gutentor' ),
				),
				'testimonial'        => array(
					'title'       => esc_html__( 'Testimonial', 'gutentor' ),
					'description' => esc_html__( 'The Testimonial block display the feedback or quotation given by your user which helps site visitor to trust on your product, services.', 'gutentor' ),
				),
				'timeline'           => array(
					'title'       => esc_html__( 'Timeline', 'gutentor' ),
					'description' => esc_html__( 'The Timeline block has ability to represents the user information or events in chronological order with different styles.  ', 'gutentor' ),
				),
				'video-popup'        => array(
					'title'       => esc_html__( 'Video Popup', 'gutentor' ),
					'description' => esc_html__( 'The Video Popup block display video from youtube link or custom uploaded video in popup mode with number of styles ,video control.', 'gutentor' ),
				),
			);

			return apply_filters( 'gutentor_block_in_admin_page', $gutentor_block_collection );
		}
	}
}
new Gutentor_Admin();
