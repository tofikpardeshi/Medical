<?php

/**
 * The Gutentor theme hooks callback functionality of the plugin.
 *
 * @link       https://www.gutentor.com/
 * @since      1.0.0
 *
 * @package    Gutentor
 */

/**
 * The Gutentor theme hooks callback functionality of the plugin.
 *
 * Since Gutentor theme is hooks base theme, this file is main callback to add/remove/edit the functionality of the Gutentor Plugin
 *
 * @package    Gutentor
 * @author     Gutentor <info@gutentor.com>
 */
class Gutentor_Hooks {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * library loaded
	 * Check it Library Loaded
	 *
	 * @since    2.1.2
	 * @access   public
	 * @var      string    $library_loaded
	 */
	public $library_loaded = false;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {}

	/**
	 * Main Gutentor_Hooks Instance
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @return object $instance Gutentor_Hooks Instance
	 */
	public static function instance() {

		// Store the instance locally to avoid private static replication
		static $instance = null;

		// Only run these methods if they haven't been ran previously
		if ( null === $instance ) {
			$instance              = new Gutentor_Hooks();
			$instance->plugin_name = GUTENTOR_PLUGIN_NAME;
			$instance->version     = GUTENTOR_VERSION;
		}

		// Always return the instance
		return $instance;
	}

	/**
	 * Callback functions for customize_register,
	 * Add Panel Section control
	 *
	 * @since    1.0.0
	 * @access   public
	 *
	 * @param object $wp_customize
	 * @return void
	 */
	function customize_controls_enqueue_scripts() {
		wp_enqueue_style( 'gutentor-custom-control', GUTENTOR_URL . 'includes/customizer/custom-controls/assets/custom-controls.css' );
		wp_style_add_data( 'gutentor-custom-control', 'rtl', 'replace' );

		wp_enqueue_script( 'gutentor-custom-control', GUTENTOR_URL . 'includes/customizer/custom-controls/assets/custom-controls.js', array( 'jquery', 'wp-color-picker', 'customize-base', 'jquery-ui-core', 'jquery-ui-slider', 'jquery-ui-sortable', 'jquery-ui-draggable' ), false, true );

		wp_localize_script(
			'gutentor-custom-control',
			'cwp_general',
			array(
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
				'wpnonce' => wp_create_nonce( 'cwp_general_nonce' ),
			)
		);
		wp_localize_script(
			'gutentor-custom-control',
			'gutentorLocalize',
			array(
				'colorPalettes' => gutentor_default_color_palettes(),
			)
		);
	}

	/**
	 * Callback functions for customize_register,
	 * Add Panel Section control
	 *
	 * @since    1.0.0
	 * @access   public
	 *
	 * @param object $wp_customize
	 * @return void
	 */
	function customize_register( $wp_customize ) {
		require_once GUTENTOR_PATH . 'includes/customizer/custom-controls/group/class-control-group.php';
		$defaults = gutentor_get_default_options();

		/**
		 * Gutentor Theme options Panel
		 */
		$wp_customize->add_panel(
			'gutentor-general-theme-options-panel',
			array(
				'title'    => esc_html__( 'Gutentor Options', 'gutentor' ),
				'priority' => 100,
			)
		);

		/*adding sections for general options*/
		$wp_customize->add_section(
			'gutentor-general-theme-options',
			array(
				'priority'   => 10,
				'capability' => 'edit_theme_options',
				'title'      => esc_html__( 'General Options', 'gutentor' ),
				'panel'      => 'gutentor-general-theme-options-panel',
			)
		);

		/*Google map api*/
		$wp_customize->add_setting(
			'gutentor_map_api',
			array(
				'type'              => 'option',
				'default'           => $defaults['gutentor_map_api'],
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control(
			'gutentor_map_api',
			array(
				'label'    => esc_html__( 'Google Map API Key', 'gutentor' ),
				'section'  => 'gutentor-general-theme-options',
				'settings' => 'gutentor_map_api',
				'type'     => 'text',
			)
		);

		/*Force Load Dynamic CSS*/
		$wp_customize->add_setting(
			'gutentor_force_load_block_assets',
			array(
				'type'              => 'option',
				'default'           => $defaults['gutentor_force_load_block_assets'],
				'sanitize_callback' => 'gutentor_sanitize_checkbox',
			)
		);
		$wp_customize->add_control(
			'gutentor_force_load_block_assets',
			array(
				'label'    => esc_html__( 'By default Gutentor Assets Only load on single page and post. By checking this box Gutentor Assets will load on all pages.', 'gutentor' ),
				'section'  => 'gutentor-general-theme-options',
				'settings' => 'gutentor_force_load_block_assets',
				'type'     => 'checkbox',
			)
		);

		/*Disable Import and Export Block Button*/
		$wp_customize->add_setting(
			'gutentor_import_and_export_block_control',
			array(
				'type'              => 'option',
				'default'           => $defaults['gutentor_import_and_export_block_control'],
				'sanitize_callback' => 'gutentor_sanitize_checkbox',
			)
		);
		$wp_customize->add_control(
			'gutentor_import_and_export_block_control',
			array(
				'label'    => esc_html__( 'By default Gutentor Import and Export Block are visible in Editor. By checking this checkbox Import and Export Block will hide from Editor.', 'gutentor' ),
				'section'  => 'gutentor-general-theme-options',
				'settings' => 'gutentor_import_and_export_block_control',
				'type'     => 'checkbox',
			)
		);

		/*gutentor_dynamic_style_location*/
		$wp_customize->add_setting(
			'gutentor_dynamic_style_location',
			array(
				'type'              => 'option',
				'default'           => $defaults['gutentor_dynamic_style_location'],
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control(
			'gutentor_dynamic_style_location',
			array(
				'choices'  => array(
					'head' => esc_html__( 'Head', 'gutentor' ),
					'file' => esc_html__( 'File', 'gutentor' ),
				),
				'label'    => esc_html__( 'Dynamic CSS Options', 'gutentor' ),
				'section'  => 'gutentor-general-theme-options',
				'settings' => 'gutentor_dynamic_style_location',
				'type'     => 'select',
			)
		);

		/*gutentor_font_awesome_version*/
		$wp_customize->add_setting(
			'gutentor_font_awesome_version',
			array(
				'type'              => 'option',
				'default'           => $defaults['gutentor_font_awesome_version'],
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			'gutentor_font_awesome_version',
			array(
				'choices'  => array(
					'5' => esc_html__( 'Font Awesome 5', 'gutentor' ),
					'4' => esc_html__( 'Font Awesome 4', 'gutentor' ),
				),
				'label'    => esc_html__( 'Font Awesome Version', 'gutentor' ),
				'section'  => 'gutentor-general-theme-options',
				'settings' => 'gutentor_font_awesome_version',
				'type'     => 'select',
			)
		);

		/*adding sections for Category Color*/
		$wp_customize->add_section(
			'gutentor-theme-categories-options',
			array(
				'priority'   => 20,
				'capability' => 'edit_theme_options',
				'title'      => esc_html__( 'Category Color', 'gutentor' ),
				'panel'      => 'gutentor-general-theme-options-panel',
			)
		);

		/*categories*/
		$i          = 10;
		$args       = array(
			'orderby'    => 'id',
			'hide_empty' => 0,
		);
		$categories = get_categories( $args );
		if ( $categories ) {
			foreach ( $categories as $category_list ) {

				$wp_customize->add_setting(
					'gutentor-cat-' . $category_list->term_id . '',
					array(
						'type'              => 'option',
						'sanitize_callback' => 'gutentor_sanitize_field_background',
						'default'           => '',
					)
				);
				$wp_customize->add_control(
					new Gutentor_Custom_Control_Group(
						$wp_customize,
						'gutentor-cat-' . $category_list->term_id . '',
						array(
							'label'    => sprintf( __( '"%s" Color', 'gutentor' ), $category_list->cat_name ),
							'section'  => 'gutentor-theme-categories-options',
							'settings' => 'gutentor-cat-' . $category_list->term_id . '',
							'priority' => $i,
						),
						array(
							'background-color'       => array(
								'type'  => 'color',
								'label' => esc_html__( 'Background Color', 'gutentor' ),
							),
							'background-hover-color' => array(
								'type'  => 'color',
								'label' => esc_html__( 'Background Hover Color', 'gutentor' ),
							),
							'text-color'             => array(
								'type'  => 'color',
								'label' => esc_html__( 'Text Color', 'gutentor' ),
							),
							'text-hover-color'       => array(
								'type'  => 'color',
								'label' => esc_html__( 'Text Hover Color', 'gutentor' ),
							),
						)
					)
				);
				$i++;
			}
		}

		/*post format*/
        $post_formats = get_theme_support( 'post-formats' );
        if ( is_array( $post_formats ) && ! empty( $post_formats ) && isset( $post_formats[0] ) ) {
            $post_formats = $post_formats[0];
            if ( is_array( $post_formats ) && ! empty( $post_formats ) ) {
                /*adding sections for post format*/
                $wp_customize->add_section(
                    'gutentor-theme-post-format-options',
                    array(
                        'priority'   => 30,
                        'capability' => 'edit_theme_options',
                        'title'      => esc_html__( 'Post Format Icon', 'gutentor' ),
                        'panel'      => 'gutentor-general-theme-options-panel',
                    )
                );
                array_unshift( $post_formats, 'standard' );
                foreach ( $post_formats as $post_format ) {
                    $default = gutentor_get_post_format_default_icon( $post_format );
                    $wp_customize->add_setting(
                        'gutentor-pf-' . esc_attr( $post_format ) . '',
                        array(
                            'type'              => 'option',
                            'sanitize_callback' => 'gutentor_sanitize_field_background',
                            'default'           => '',
                        )
                    );
                    $wp_customize->add_control(
                        new Gutentor_Custom_Control_Group(
                            $wp_customize,
                            'gutentor-pf-' . esc_attr( $post_format ) . '',
                            array(
                                'label'    => sprintf( __( '%s Icon', 'gutentor' ), ucfirst( esc_attr( $post_format ) ) ),
                                'section'  => 'gutentor-theme-post-format-options',
                                'settings' => 'gutentor-pf-' . esc_attr( $post_format ) . '',
                                'priority' => $i,
                            ),
                            array(
                                'icon'       => array(
                                    'type'        => 'text',
                                    'default'     => $default,
                                    'label'       => esc_html__( 'Icon Class Name', 'gutentor' ),
                                    'description' => esc_html__( 'Eg: fas fa-tags', 'gutentor' ),
                                ),
                                'bg_color'   => array(
                                    'type'    => 'color',
                                    'default' => '',
                                    'label'   => esc_html__( 'Background Color', 'gutentor' ),
                                ),
                                'icon_color' => array(
                                    'type'    => 'color',
                                    'default' => '',
                                    'label'   => esc_html__( 'Icon Color', 'gutentor' ),
                                ),
                            )
                        )
                    );
                }
            }
        }

	}

	/**
	 * Get Thumbnail all sizes.
	 *
	 * @since 2.0.0
	 */
	public static function get_thumbnail_all_sizes() {

		$sizes       = get_intermediate_image_sizes();
		$image_sizes = array();

		$image_sizes[] = array(
			'value' => 'full',
			'label' => esc_html__( 'Full', 'gutentor' ),
		);

		foreach ( $sizes as $size ) {
			if ( in_array( $size, array( 'thumbnail', 'medium', 'medium_large', 'large' ), true ) ) {
				$image_sizes[] = array(
					'value' => $size,
					'label' => ucwords( trim( str_replace( array( '-', '_' ), array( ' ', ' ' ), $size ) ) ),
				);
			}
		}
		return $image_sizes;
	}

	/**
	 * Callback functions for block_categories,
	 * Adding Block Categories
	 *
	 * @since    1.0.0
	 * @access   public
	 *
	 * @param array $categories
	 * @return array
	 */
	public function add_block_categories( $categories ) {

		return array_merge(
			array(
				array(
					'slug'  => 'gutentor-elements',
					'title' => __( 'Gutentor Elements', 'gutentor' ),
				),
				array(
					'slug'  => 'gutentor-modules',
					'title' => __( 'Gutentor Modules', 'gutentor' ),
				),
				array(
					'slug'  => 'gutentor-posts',
					'title' => __( 'Gutentor Posts', 'gutentor' ),
				),
				array(
					'slug'  => 'gutentor',
					'title' => __( 'Gutentor Widgets', 'gutentor' ),
				),
			),
			$categories
		);
	}

	/**
	 * Callback functions for init,
	 * Register Settings for Google Maps Block
	 *
	 * @since    1.0.0
	 * @access   public
	 *
	 * @param null
	 * @return void
	 */
	public function register_gmap_settings() {

		register_setting(
			'gutentor_map_api',
			'gutentor_map_api',
			array(
				'type'              => 'string',
				'description'       => __( 'Google Map API key for the Google Maps Gutenberg Block.', 'gutentor' ),
				'sanitize_callback' => 'sanitize_text_field',
				'show_in_rest'      => true,
				'default'           => '',
			)
		);
		register_setting(
			'gutentor_force_load_block_assets',
			'gutentor_force_load_block_assets',
			array(
				'type'              => 'boolean',
				'description'       => __( 'Force Load Gutentor Assets on All Pages', 'gutentor' ),
				'sanitize_callback' => 'gutentor_sanitize_checkbox',
				'show_in_rest'      => true,
				'default'           => '',
			)
		);
		register_setting(
			'gutentor_dynamic_style_location',
			'gutentor_dynamic_style_location',
			array(
				'type'              => 'string',
				'description'       => __( 'Dynamic CSS options.', 'gutentor' ),
				'sanitize_callback' => 'sanitize_text_field',
				'show_in_rest'      => true,
				'default'           => '',
			)
		);
		register_setting(
			'gutentor_font_awesome_version',
			'gutentor_font_awesome_version',
			array(
				'type'              => 'string',
				'description'       => __( 'Font Awesome Version', 'gutentor' ),
				'sanitize_callback' => 'sanitize_text_field',
				'show_in_rest'      => true,
				'default'           => '5',
			)
		);
	}

	/**
	 * Callback functions for init,
	 * Register scripts and styles
	 *
	 * @since    2.1.2
	 * @access   public
	 *
	 * @param null
	 * @return void
	 */
    function register_script_style(){ // phpcs:ignore
		/*Animate CSS*/
		wp_register_style(
			'animate',
			GUTENTOR_URL . 'assets/library/animatecss/animate.min.css',
			array(),
			'3.7.2'
		);

		/*CountUP JS*/
		wp_register_script(
			'countUp', // Handle.
			GUTENTOR_URL . 'assets/library/countUp/countUp.min.js',
			array( 'jquery' ), // Dependencies.
			'1.9.3', // Version.
			true // Enqueue the script in the footer.
		);

		/*flexMenu*/
		wp_register_script(
			'flexMenu', // Handle.
			GUTENTOR_URL . 'assets/library/flexMenu/flexmenu.min.js',
			array( 'jquery' ), // Dependencies
			'1.6.2', // Version: File modification time.
			true // Enqueue the script in the footer.
		);

		/*FontAwesome CSS*/
		if ( 4 == gutentor_get_options( 'gutentor_font_awesome_version' ) ) {
			wp_register_style(
				'fontawesome', // Handle.
				GUTENTOR_URL . 'assets/library/font-awesome-4.7.0/css/font-awesome.min.css',
				array(),
				'4'
			);
		} else {
			wp_register_style(
				'fontawesome', // Handle.
				GUTENTOR_URL . 'assets/library/fontawesome/css/all.min.css',
				array(),
				'5.12.0'
			);
		}

		/*Isotope Js*/
		wp_register_script(
			'isotope', // Handle.
			GUTENTOR_URL . 'assets/library/isotope/isotope.pkgd.min.js',
			array( 'jquery' ), // Dependencies, defined above.
			'3.0.6', // Version: File modification time.
			true // Enqueue the script in the footer.
		);

		/*jquery-easypiechart Js*/
		wp_register_script(
			'jquery-easypiechart', // Handle.
			GUTENTOR_URL . 'assets/library/jquery-easypiechart/jquery.easypiechart.min.js',
			array( 'jquery' ), // Dependencies, defined above.
			'2.1.7', // Version: File modification time.
			true // Enqueue the script in the footer.
		);

		/*Magnific Popup CSS*/
		wp_register_style(
			'magnific-popup',
			GUTENTOR_URL . 'assets/library/magnific-popup/magnific-popup.min.css',
			array(),
			'1.8.0'
		);
		/*Magnific Popup JS*/
		wp_register_script(
			'magnific-popup', // Handle.
			GUTENTOR_URL . 'assets/library/magnific-popup/jquery.magnific-popup.min.js',
			array( 'jquery' ), // Dependencies, defined above.
			'1.1.0', // Version: File modification time.
			true // Enqueue the script in the footer.
		);

		/*Slick CSS*/
		wp_register_style(
			'slick',
			GUTENTOR_URL . 'assets/library/slick/slick.min.css',
			array(),
			'1.8.1'
		);

		/*Slick JS*/
		wp_register_script(
			'slick', // Handle.
			GUTENTOR_URL . 'assets/library/slick/slick.min.js',
			array( 'jquery' ), // Dependencies, defined above.
			'1.8.1', // Version: File modification time.
			true // Enqueue the script in the footer.
		);

		/*sticky sidebar*/
		wp_register_script(
			'theia-sticky-sidebar', // Handle.
			GUTENTOR_URL . 'assets/library/theia-sticky-sidebar/theia-sticky-sidebar.min.js',
			array( 'jquery' ), // Dependencies
			'4.0.1', // Version
			true // Enqueue the script in the footer.
		);

		/*Waypoints JS*/
		wp_register_script(
			'waypoints', // Handle.
			GUTENTOR_URL . 'assets/library/waypoints/jquery.waypoints.min.js',
			array( 'jquery' ), // Dependencies
			'4.0.1', // Version
			true // Enqueue the script in the footer.
		);
		/*Wow js*/
		wp_register_script(
			'wow', // Handle.
			GUTENTOR_URL . 'assets/library/wow/wow.min.js',
			array( 'jquery' ), // Dependencies
			'1.2.1', // Version: File modification time.
			true // Enqueue the script in the footer.
		);

		/*AcmeTicker*/
		wp_register_script(
			'acmeticker', // Handle.
			GUTENTOR_URL . 'assets/library/acmeticker/acmeticker.min.js',
			array( 'jquery' ), // Dependencies
			'1.0.0', // Version
			true // Enqueue the script in the footer.
		);
		/* Wpness Grid Styles*/
		wp_register_style(
			'wpness-grid',
			GUTENTOR_URL . 'assets/library/wpness-grid/wpness-grid' . GUTENTOR_SCRIPT_PREFIX . '.css',
			array(),
			'1.0.0'
		);
		/*Gutentor Specific CSS/JS*/
		wp_register_style(
			'gutentor-css', // Handle.
			GUTENTOR_URL . 'dist/blocks.style.build.css',
			array( 'wp-editor' ), // Dependency to include the CSS after it.
			GUTENTOR_VERSION // Version: File modification time.
		);
		/*Gutentor Woo CSS/JS*/
		wp_register_style(
			'gutentor-woo-css', // Handle.
			GUTENTOR_URL . 'dist/gutentor-woocommerce.css',
			array( 'wp-editor' ), // Dependency to include the CSS after it.
			GUTENTOR_VERSION // Version: File modification time.
		);
		wp_register_script(
			'gutentor-block', // Handle.
			GUTENTOR_URL . 'assets/js/gutentor' . GUTENTOR_SCRIPT_PREFIX . '.js',
			array( 'jquery' ), // Dependencies, defined above.
			GUTENTOR_VERSION, // Version: File modification time.
			true // Enqueue the script in the footer.
		);
		/*CSS for default/popular themes*/
		$templates        = array( 'twentynineteen', 'twentytwenty', 'generatepress' );
		$current_template = get_template();
		if ( in_array( $current_template, $templates ) ) {
			wp_register_style(
				'gutentor-theme-' . esc_attr( $current_template ), // Handle.
				GUTENTOR_URL . 'dist/gutentor-' . esc_attr( $current_template ) . '.css',
				array(), // Dependency to include the CSS after it.
				GUTENTOR_VERSION // Version: File modification time.
			);
			wp_style_add_data( 'gutentor-theme-' . esc_attr( $current_template ), 'rtl', 'replace' );
		}
	}

	/**
	 * Load scripts and styles
	 *
	 * @since    2.1.2
	 * @access   public
	 *
	 * @param null
	 * @return void
	 */
	function load_lib_assets() {
		/*
		fontawesome CSS
		load front end and backend
		Reason: Common for many blocks
		*/
		wp_enqueue_style( 'fontawesome' );
		wp_style_add_data( 'fontawesome', 'rtl', 'replace' );

		if ( ! is_admin() ) {

			/*
			Animate CSS
			load front
			Reason: needed on all blocks since animate option is everywhere
			*/
			wp_enqueue_style( 'animate' );
			wp_style_add_data( 'animate', 'rtl', 'replace' );

			/*Wow is needed for Animate CSS*/
			wp_enqueue_script( 'wow' );

			/*
			For CountUP JS
			Load Frontend only
			Used By: gutentor/counter-box and gutentor/e3
			*/
			if ( has_block( 'gutentor/counter-box' ) || has_block( 'gutentor/e3' ) ) {
				wp_enqueue_script( 'countUp' );
			}

			/*
			For isotope JS
			Load Frontend only
			Used by: gutentor/filter
			*/
			if ( has_block( 'gutentor/filter' ) ) {
				/*isotope JS*/
				wp_enqueue_script( 'isotope' );
			}

			/*
			jquery-easypiechart
			Load Frontend only
			Used By: gutentor/progress-bar and gutentor/e9
			*/
			if ( has_block( 'gutentor/progress-bar' ) || has_block( 'gutentor/e9' ) ) {
				/*Easy Pie Chart Js*/
				wp_enqueue_script( 'jquery-easypiechart' );
			}

			/*
			Maginific popup
			Load Frontend only
			Used By:
			gutentor/video-popup,
			gutentor/e11,
			gutentor/e2,
			gutentor/gallery and
			gutentor/filter
			*/
			if ( has_block( 'gutentor/video-popup' )
				|| has_block( 'gutentor/e11' )
				|| has_block( 'gutentor/e2' )
				|| has_block( 'gutentor/gallery' )
				|| has_block( 'gutentor/filter' )
			) {
				/*Maginific popup*/
				wp_enqueue_style( 'magnific-popup' );
				wp_style_add_data( 'magnific-popup', 'rtl', 'replace' );
				// magnify popup  Js
				wp_enqueue_script( 'magnific-popup' );
			}

			/*
			Slick Slider
			Load Frontend only
			Used By:
			gutentor/image-slider
			gutentor/m5
			gutentor/m0
			gutentor/m7
			gutentor/p3
			if pro installed
			*/
			if ( has_block( 'gutentor/image-slider' )
				|| has_block( 'gutentor/m5' )
				|| has_block( 'gutentor/m0' )
				|| has_block( 'gutentor/m7' )
				|| has_block( 'gutentor/p3' )
				|| function_exists( 'gutentor_pro' )
			) {
				/*Slick*/
				wp_enqueue_style( 'slick' );
				wp_enqueue_script( 'slick' );
			}

			/*
			waypoints js
			Load Frontend only
			Used By:
			gutentor/progress-bar
			gutentor/e9
			gutentor/counter-box
			gutentor/e3
			*/
			if ( has_block( 'gutentor/counter-box' ) || has_block( 'gutentor/e3' ) ||
				has_block( 'gutentor/progress-bar' ) || has_block( 'gutentor/e9' ) ) {
				wp_enqueue_script( 'waypoints' );
			}

			/*
			masonry js
			Load Frontend only
			Used By:
			gutentor/gallery
			*/
			if ( has_block( 'gutentor/gallery' ) ) {
				wp_enqueue_script( 'masonry' );
			}

			/*
			flexMenu js
			Load Frontend only
			Used By:
			gutentor/p4
			*/
			if ( has_block( 'gutentor/p4' ) ) {
				wp_enqueue_script( 'flexMenu' );
			}

			/*
			webticker js
			Load Frontend only
			/**/
			if ( has_block( 'gutentor/p5' ) ) {
				wp_enqueue_script( 'acmeticker' );
			}

			/*
			theia-sticky-sidebar' js
			Load Frontend only
			*/
			if ( has_block( 'gutentor/m4' ) ) {
				wp_enqueue_script( 'theia-sticky-sidebar' );
			}

			/*
			Google Map JS
			Load Frontend only
			Used By:
			gutentor/google-map
			gutentor/e4
			*/
			if ( has_block( 'gutentor/google-map' ) || has_block( 'gutentor/e4' ) ) {

				// Get the API key
				if ( gutentor_get_options( 'gutentor_map_api' ) ) {
					$apikey = gutentor_get_options( 'gutentor_map_api' );
				} else {
					$apikey = false;
				}

				// Don't output anything if there is no API key
				if ( null === $apikey || empty( $apikey ) ) {
					return;
				}

				wp_enqueue_script(
					'gutentor-google-maps',
					GUTENTOR_URL . 'assets/js/google-map-loader' . GUTENTOR_SCRIPT_PREFIX . '.js',
					array( 'jquery' ), // Dependencies, defined above.
					'1.0.0',
					true
				);

				wp_enqueue_script(
					'google-maps',
					'https://maps.googleapis.com/maps/api/js?key=' . $apikey . '&libraries=places&callback=initMapScript',
					array( 'gutentor-google-maps' ),
					'1.0.0',
					true
				);
			}
		}

		/*wpness grid Needed for Admin and Frontend*/
		wp_enqueue_style( 'wpness-grid' );
		wp_style_add_data( 'wpness-grid', 'rtl', 'replace' );

		$this->library_loaded = true;
		if ( gutentor_is_edit_page() ) {
			$this->load_last_scripts();
		}

	}
	/**
	 * Callback functions for enqueue_block_assets,
	 * Enqueue Gutenberg block assets for both frontend + backend.
	 *
	 * @since    1.0.0
	 * @access   public
	 *
	 * @param null
	 * @return void
	 */
	function block_assets() { // phpcs:ignore

		if ( ! ( is_singular() || gutentor_is_edit_page() || apply_filters( 'gutentor_force_load_block_assets', false ) ) ) {
			return;
		}
		$this->load_lib_assets();
	}

	/**
	 * Load gutentor scripts at last
	 * Becuase it has lot of dependency
	 *
	 * @since    2.1.2
	 * @access   public
	 *
	 * @param null
	 * @return void|boolean
	 */
	function load_last_scripts() {
		if ( ! $this->library_loaded ) {
			return false;
		}
		/*Gutentor Specific CSS/JS*/
		wp_enqueue_style( 'gutentor-css' );
        wp_style_add_data( 'gutentor-css', 'rtl', 'replace' );

        /*For WooCommerce*/
        if( gutentor_is_woocommerce_active()){
            wp_enqueue_style( 'gutentor-woo-css' );
            wp_style_add_data( 'gutentor-woo-css', 'rtl', 'replace' );
        }

		wp_enqueue_script( 'gutentor-block' );
		wp_localize_script(
			'gutentor-block',
			'gutentorLS',
			array(
				'fontAwesomeVersion' => gutentor_get_options( 'gutentor_font_awesome_version' ),
				'restNonce'          => wp_create_nonce( 'wp_rest' ),
				'restUrl'            => esc_url_raw( rest_url() ),
			)
		);

		/*CSS for default/popular themes*/
		$templates        = array( 'twentynineteen', 'twentytwenty', 'generatepress' );
		$current_template = get_template();
		if ( in_array( $current_template, $templates ) ) {
			wp_enqueue_style( 'gutentor-theme-' . esc_attr( $current_template ) );
			wp_style_add_data( 'gutentor-theme-' . esc_attr( $current_template ), 'rtl', 'replace' );
		}
	}

	/**
	 * Callback functions for enqueue_block_editor_assets,
	 * Enqueue Gutenberg block assets for backend only.
	 *
	 * @since    1.0.0
	 * @access   public
	 *
	 * @param null
	 * @return void
	 */
	public function block_editor_assets() { // phpcs:ignore

		// Scripts.
		wp_enqueue_script(
			'gutentor-js', // Handle.
			GUTENTOR_URL . 'dist/blocks.build.js', // Block.build.js: We register the block here. Built with Webpack.
			array( 'jquery', 'lodash', 'wp-api', 'wp-i18n', 'wp-blocks', 'wp-components', 'wp-compose', 'wp-data', 'wp-editor', 'wp-edit-post', 'wp-element', 'wp-keycodes', 'wp-plugins', 'wp-rich-text', 'wp-viewport' ), // Dependencies, defined above.
			GUTENTOR_VERSION, // Version: File modification time.
			true // Enqueue the script in the footer.
		);

		wp_set_script_translations( 'gutentor-js', 'gutentor' );

		wp_localize_script(
			'gutentor-js',
			'gutentor',
			array(
				'currentTheme'                    => get_template(),
				'postModuleGlobalCategoriesColor' => gutentor_pm_post_categories_color( true ),
				'thumbnailAllSizes'               => self::get_thumbnail_all_sizes(),
				'mapsAPI'                         => '',
				'dirUrl'                          => GUTENTOR_URL,
				'iconSvg'                         => GUTENTOR_URL . 'assets/img/block-icons/icon.svg',
				'singleColSvg'                    => GUTENTOR_URL . 'assets/img/block-icons/single-column.svg',
				'pricingSvg'                      => GUTENTOR_URL . 'assets/img/block-icons/pricing.svg',
				'simpleTextSvg'                   => GUTENTOR_URL . 'assets/img/block-icons/simple-text.svg',
				'coverSvg'                        => GUTENTOR_URL . 'assets/img/block-icons/cover.svg',
				'carouselSvg'                     => GUTENTOR_URL . 'assets/img/block-icons/carousel.svg',
				'sliderSvg'                       => GUTENTOR_URL . 'assets/img/block-icons/slider.svg',
				'openHoursSvg'                    => GUTENTOR_URL . 'assets/img/block-icons/opening-hours.svg',
				'notificationSvg'                 => GUTENTOR_URL . 'assets/img/block-icons/notification.svg',
				'advancedTextSvg'                 => GUTENTOR_URL . 'assets/img/block-icons/advance-text.svg',
				'featuredSvg'                     => GUTENTOR_URL . 'assets/img/block-icons/featured-block.svg',
				'tabSvg'                          => GUTENTOR_URL . 'assets/img/block-icons/tabs.svg',
				'counterSvg'                      => GUTENTOR_URL . 'assets/img/block-icons/counter.svg',
				'contentBoxSvg'                   => GUTENTOR_URL . 'assets/img/block-icons/content-box.svg',
				'buttonSvg'                       => GUTENTOR_URL . 'assets/img/block-icons/button.svg',
				'buttonGroupSvg'                  => GUTENTOR_URL . 'assets/img/block-icons/button-group.svg',
				'dynamicColSvg'                   => GUTENTOR_URL . 'assets/img/block-icons/dynamic-col.svg',
				'AdvPostSvg'                      => GUTENTOR_URL . 'assets/img/block-icons/advanced-post-module.svg',
				'newsTickerSvg'                   => GUTENTOR_URL . 'assets/img/block-icons/news-ticker.svg',
				'postFeaturedModuleSvg'           => GUTENTOR_URL . 'assets/img/block-icons/post-feature-module.svg',
				'postModuleSvg'                   => GUTENTOR_URL . 'assets/img/block-icons/post-module.svg',
			    'duplexPostModuleSvg'             => GUTENTOR_URL . 'assets/img/block-icons/duplex-post-module.svg',
				/*widget blocks*/
                'aboutSvgW'                         => GUTENTOR_URL . 'assets/img/block-icons/about.svg',
                'authorSvgW'                        => GUTENTOR_URL . 'assets/img/block-icons/author.svg',
                'calltoactionSvgW'                  => GUTENTOR_URL . 'assets/img/block-icons/calltoaction.svg',
                'countdownSvgW'                         => GUTENTOR_URL . 'assets/img/block-icons/countdown.svg',
                'dividerSvgW'                         => GUTENTOR_URL . 'assets/img/block-icons/divider.svg',
                'gallerySvgW'                         => GUTENTOR_URL . 'assets/img/block-icons/gallery.svg',
                'imageSvgW'                         => GUTENTOR_URL . 'assets/img/block-icons/image.svg',
                'listSvgW'                         => GUTENTOR_URL . 'assets/img/block-icons/list.svg',
                'mapSvgW'                         => GUTENTOR_URL . 'assets/img/block-icons/map.svg',
                'restaurantmenuSvgW'                         => GUTENTOR_URL . 'assets/img/block-icons/restaurantmenu.svg',
                'progressbarSvgW'                         => GUTENTOR_URL . 'assets/img/block-icons/progressbar.svg',
                'ratingSvgW'                         => GUTENTOR_URL . 'assets/img/block-icons/rating.svg',
                'showmoreSvgW'                         => GUTENTOR_URL . 'assets/img/block-icons/showmore.svg',
                'socialSvgW'                         => GUTENTOR_URL . 'assets/img/block-icons/social.svg',
                'teamSvgW'                         => GUTENTOR_URL . 'assets/img/block-icons/team.svg',
                'testimonialsSvgW'                         => GUTENTOR_URL . 'assets/img/block-icons/testimonial.svg',
                'timelineSvgW'                         => GUTENTOR_URL . 'assets/img/block-icons/timeline.svg',
                'videoSvgW'                         => GUTENTOR_URL . 'assets/img/block-icons/video.svg',
				'defaultImage'                    => GUTENTOR_URL . 'assets/img/default-image.jpg',
				'gutentorSvg'                     => GUTENTOR_URL . 'assets/img/gutentor.svg',
				'gutentorWhiteSvg'                => GUTENTOR_URL . 'assets/img/gutentor-white-logo.svg',
				'm6Svg'                           => GUTENTOR_URL . 'assets/img/block-icons/accordion-module.svg',
				'm9Svg'                           => GUTENTOR_URL . 'assets/img/block-icons/shortcode.svg',
				'templateLibrarySvg'                           => GUTENTOR_URL . 'assets/img/block-icons/template-library.svg',
				'fontAwesomeVersion'              => gutentor_get_options( 'gutentor_font_awesome_version' ),
				'checkPostFormatSupport'          => gutentor_check_post_format_support_enable(),
				'postFormatsIcons'                => gutentor_get_all_post_format_icons(),
				'postFormatsColors'               => gutentor_post_format_colors(),
				'postFeaturedFormatsColors'       => gutentor_post_featured_format_colors(),
				'postTypeList'                    => gutentor_get_post_types(),
				'is_woocommerce_active'           => gutentor_is_woocommerce_active(),
				'disableImportExportBlockBtn'     => ( gutentor_get_options( 'gutentor_import_and_export_block_control' ) ) ? 'true' : 'false',
				'gActiveProTemplates'             => apply_filters('gutentor_is_pro_active', array(
				    'Gutentor' => false,
                )),
				'nonce'                           => wp_create_nonce( 'gutentorNonce' ),
			)
		);

		// Scripts.
		wp_enqueue_script(
			'gutentor-editor-block-js', // Handle.
			GUTENTOR_URL . 'assets/js/block-editor' . GUTENTOR_SCRIPT_PREFIX . '.js',
			array( 'jquery' ), // Dependencies, defined above.
			GUTENTOR_VERSION, // Version: File modification time.
			true // Enqueue the script in the footer.
		);

		// Styles.
		wp_enqueue_style(
			'gutentor-editor-css', // Handle.
			GUTENTOR_URL . 'dist/blocks.editor.build.css',
			array( 'wp-edit-blocks' ), // Dependency to include the CSS after it.
			GUTENTOR_VERSION // Version: File modification time.
		);
		wp_style_add_data( 'gutentor-editor-css', 'rtl', 'replace' );

	}

	/**
	 * Callback functions for body_class,
	 * Adding Body Class.
	 *
	 * @since    1.0.0
	 * @access   public
	 *
	 * @param array $classes
	 * @return array
	 */
	function add_body_class( $classes ) {

		$classes[] = 'gutentor-active';
		return $classes;
	}

	/**
	 * Callback functions for body_class,
	 * Adding Admin Body Class.
	 *
	 * @since    1.0.0
	 * @access   public
	 *
	 * @param string $classes
	 * @return string
	 */
	function add_admin_body_class( $classes ) {
		// Wrong: No space in the beginning/end.
		$classes .= ' gutentor-active ';
        if ( current_theme_supports( 'align-wide' ) ){
            $classes .= ' gutentor-wide-width ';
        }

		return $classes;
	}

	/**
	 * Create Page Template
	 *
	 * @param {string} $templates
	 * @return string $templates
	 */
	function gutentor_add_page_template( $templates ) {
		$templates['template-gutentor-full-width.php'] = esc_html__( 'Gutentor Full Width', 'gutentor' );
		$templates['template-gutentor-canvas.php']     = esc_html__( 'Gutentor Canvas', 'gutentor' );
		return $templates;
	}

	/**
	 * Redirect Custom Page Template
	 *
	 * @param {string} $templates
	 * @return string $templates
	 */
	function gutentor_redirect_page_template( $template ) {
		$post          = get_post();
		$page_template = get_post_meta( $post->ID, '_wp_page_template', true );
		if ( 'template-gutentor-full-width.php' == basename( $page_template ) ) {
			$template = GUTENTOR_PATH . '/page-templates/template-gutentor-full-width.php';
			return $template;
		} elseif ( 'template-gutentor-canvas.php' == basename( $page_template ) ) {
			$template = GUTENTOR_PATH . '/page-templates/template-gutentor-canvas.php';
			return $template;
		}
		return $template;
	}

	/**
	 * Allowed style on post save
	 * Since gutentor add internal style per post page
	 *
	 * @param  array $allowedposttags
	 * @return  array
	 */
	public function allow_style_tags( $allowedposttags ) {
		$allowedposttags['style'] = array(
			'type' => true,
		);
		return $allowedposttags;
	}

	/**
	 * By default gutentor use fontawesome 5
	 * Changing default fontawesome to 4
	 * Quick fix for acmethemes
	 *
	 * @param  array $defaults, All default options of gutentor
	 * @return array $defaults, modified version of default
	 */
	function acmethemes_alter_default_options( $defaults ) {
		$current_theme        = wp_get_theme();
		$current_theme_author = $current_theme->get( 'Author' );
		if ( $current_theme_author != 'acmethemes' ) {
			return $defaults;
		}

		$defaults['gutentor_font_awesome_version'] = 4; /*default is fontawesome 5, we change here 4*/
		return $defaults;
	}

	/**
	 * Force Load Gutentor Assets on All Pages
	 * By default Gutentor Assets Only load on single page and post. By checking this box Gutentor Assets will load on all pages.
	 */
	function force_load_block_assets() {
		return gutentor_get_options( 'gutentor_force_load_block_assets' );
	}

	/**
	 * Register Gutentor_Reusable_Block_Widget
	 */
	function register_gutentor_reusable_block_selector_widget() {
		register_widget( 'Gutentor_WP_Block_Widget' );
	}
}

/**
 * Begins execution of the hooks.
 *
 * @since    1.0.0
 */
function gutentor_hooks() {
	return Gutentor_Hooks::instance();
}
