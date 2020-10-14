<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used to
 * add/remove/edit the functionality of the Gutentor Plugin
 *
 * @link       https://www.gutentor.com/
 * @since      1.0.0
 *
 * @package    Gutentor
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * functionality of the plugin
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Gutentor
 * @author     Gutentor <info@gutentor.com>
 */
class Gutentor {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Gutentor_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * Full Name of plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_full_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_full_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Main Instance
	 *
	 * Insures that only one instance of Gutentor exists in memory at any one
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
			$instance = new Gutentor();

			do_action( 'gutentor_loaded' );
		}

		// Always return the instance
		return $instance;
	}

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		if ( defined( 'GUTENTOR_VERSION' ) ) {
			$this->version = GUTENTOR_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name      = GUTENTOR_PLUGIN_NAME;
		$this->plugin_full_name = esc_html__( 'Gutentor', 'gutentor' );

		if ( function_exists( 'register_block_type' ) ) {
			$this->load_dependencies();
			$this->set_locale();

			$this->define_hooks();
			$this->load_hooks();
		}
	}


	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Gutentor_Loader. Orchestrates the hooks of the plugin.
	 * - Gutentor_i18n. Defines internationalization functionality.
	 * - Gutentor_Admin. Defines all hooks for the admin area.
	 * - Gutentor_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once GUTENTOR_PATH . 'includes/loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once GUTENTOR_PATH . 'includes/i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once GUTENTOR_PATH . 'includes/customizer/sanitize.php';

		require_once GUTENTOR_PATH . 'includes/functions.php';
		require_once GUTENTOR_PATH . 'includes/hooks.php';

		/* admin */
		require_once GUTENTOR_PATH . 'includes/admin/class-helper.php';
		require_once GUTENTOR_PATH . 'includes/admin/class-admin.php';

		/*
		Blocks*/
		/*block-base*/
		require_once GUTENTOR_PATH . 'includes/block-base/class-block-base.php';
		require_once GUTENTOR_PATH . 'includes/block-base/class-post-query-elements.php';
		require_once GUTENTOR_PATH . 'includes/block-base/class-block-hooks.php';
		require_once GUTENTOR_PATH . 'includes/block-base/class-post-module-hooks.php';
		require_once GUTENTOR_PATH . 'includes/block-base/class-post-carousel-hooks.php';

		/*Blocks*/
		require_once GUTENTOR_PATH . 'includes/blocks/class-about-block.php';
		require_once GUTENTOR_PATH . 'includes/blocks/class-accordion.php';
		require_once GUTENTOR_PATH . 'includes/blocks/class-advanced-columns.php';
		require_once GUTENTOR_PATH . 'includes/blocks/class-author-profile.php';
		require_once GUTENTOR_PATH . 'includes/blocks/class-blog-post.php';/* ***Do not remove required for PHP BLOCK*/
		require_once GUTENTOR_PATH . 'includes/blocks/class-call-to-action.php';
		require_once GUTENTOR_PATH . 'includes/blocks/class-content-box.php';
		require_once GUTENTOR_PATH . 'includes/blocks/class-count-down.php';
		require_once GUTENTOR_PATH . 'includes/blocks/class-counter-box.php';
		require_once GUTENTOR_PATH . 'includes/blocks/class-divider.php';
		require_once GUTENTOR_PATH . 'includes/blocks/class-featured-block.php';
		require_once GUTENTOR_PATH . 'includes/blocks/class-gallery.php';
		require_once GUTENTOR_PATH . 'includes/blocks/class-google-map.php';/* ***Do not remove required for PHP BLOCK*/
		require_once GUTENTOR_PATH . 'includes/blocks/class-element-google-map.php';/* ***Do not remove required for PHP BLOCK*/
		require_once GUTENTOR_PATH . 'includes/blocks/class-icon-box.php';
		require_once GUTENTOR_PATH . 'includes/blocks/class-image-box.php';
		require_once GUTENTOR_PATH . 'includes/blocks/class-image-slider.php';
		require_once GUTENTOR_PATH . 'includes/blocks/class-list.php';
		require_once GUTENTOR_PATH . 'includes/blocks/class-notification.php';
		require_once GUTENTOR_PATH . 'includes/blocks/class-opening-hours.php';
		require_once GUTENTOR_PATH . 'includes/blocks/class-pricing.php';
		require_once GUTENTOR_PATH . 'includes/blocks/class-progress-bar.php';
		require_once GUTENTOR_PATH . 'includes/blocks/class-restaurant-menu.php';
		require_once GUTENTOR_PATH . 'includes/blocks/class-show-more.php';
		require_once GUTENTOR_PATH . 'includes/blocks/class-single-column.php';
		require_once GUTENTOR_PATH . 'includes/blocks/class-social.php';
		require_once GUTENTOR_PATH . 'includes/blocks/class-tabs.php';
		require_once GUTENTOR_PATH . 'includes/blocks/class-team.php';
		require_once GUTENTOR_PATH . 'includes/blocks/class-testimonial.php';
		require_once GUTENTOR_PATH . 'includes/blocks/class-timeline.php';
		require_once GUTENTOR_PATH . 'includes/blocks/class-video-popup.php';
		require_once GUTENTOR_PATH . 'includes/sidebar-widget/class-reusable-block-widget.php';

		/*Post Modules*/
		require_once GUTENTOR_PATH . 'includes/blocks/class-p1-blog.php';/* ***Do not remove required for PHP BLOCK*/
		require_once GUTENTOR_PATH . 'includes/blocks/class-p2-feature-module.php';/* ***Do not remove required for PHP BLOCK*/
		require_once GUTENTOR_PATH . 'includes/blocks/class-p5-news-ticker.php';/* ***Do not remove required for PHP BLOCK*/
		require_once GUTENTOR_PATH . 'includes/blocks/class-p6.php';/* ***Do not remove required for PHP BLOCK*/

		/*Rest API*/
		require_once GUTENTOR_PATH . 'includes/tools/class-self-api-handler.php';

		require_once GUTENTOR_PATH . 'includes/tools/class-gutentor-extend-api.php';

		/*Advanced Import*/
		require_once GUTENTOR_PATH . 'includes/tools/class-advanced-import.php';

		/*Dynamic CSS*/
		require_once GUTENTOR_PATH . 'includes/dynamic-css.php';

		$this->loader = new Gutentor_Loader();
	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Gutentor_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Gutentor_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_hooks() {

		$plugin_hooks = gutentor_hooks();

		/*Hook: some options for Gutentor.*/
		$this->loader->add_action( 'customize_register', $plugin_hooks, 'customize_register' );
		$this->loader->add_action( 'customize_controls_enqueue_scripts', $plugin_hooks, 'customize_controls_enqueue_scripts' );

		/*Hook: Register Scripts*/
		$this->loader->add_action( 'init', $plugin_hooks, 'register_script_style' );

		/*Hook: Both Frontend and Backend assets.*/
		$this->loader->add_action( 'enqueue_block_assets', $plugin_hooks, 'block_assets' );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_hooks, 'load_last_scripts', 99 );

		/*Hook: Editor assets.*/
		$this->loader->add_action( 'enqueue_block_editor_assets', $plugin_hooks, 'block_editor_assets' );

		/*Hook: Google Map Setting.*/
		$this->loader->add_action( 'init', $plugin_hooks, 'register_gmap_settings' );

		/*Hook Adding Block Categories*/
		$this->loader->add_filter( 'block_categories', $plugin_hooks, 'add_block_categories', 99999 );

		/*Adding Body Class*/
		$this->loader->add_filter( 'body_class', $plugin_hooks, 'add_body_class' );

		/*Adding Admin Body Class*/
		$this->loader->add_filter( 'admin_body_class', $plugin_hooks, 'add_admin_body_class' );

		/*Adding page templates*/
		$this->loader->add_filter( 'theme_page_templates', $plugin_hooks, 'gutentor_add_page_template' );
		$this->loader->add_filter( 'page_template', $plugin_hooks, 'gutentor_redirect_page_template' );

		/*Adding style*/
		$this->loader->add_filter( 'wp_kses_allowed_html', $plugin_hooks, 'allow_style_tags' );

		/*Quick fix for acmethemes fontawesome*/
		$this->loader->add_filter( 'gutentor_default_options', $plugin_hooks, 'acmethemes_alter_default_options' );

		$this->loader->add_action( 'widgets_init', $plugin_hooks, 'register_gutentor_reusable_block_selector_widget' );

		/*gutentor_force_load_block_assets*/
		$this->loader->add_action( 'gutentor_force_load_block_assets', $plugin_hooks, 'force_load_block_assets' );

	}
	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function load_hooks() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Gutentor_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
