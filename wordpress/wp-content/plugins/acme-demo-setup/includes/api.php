<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( ! class_exists( 'Acme_Demo_Setup_Template_Library_Api' ) ) {
	/**
	 * @package Acme Themes
	 * @subpackage Acme Demo Setup Template Library Api
	 * @since 2.0.1
     *
     * Call like this
     * SITEURL/wp-json/acmethemes-demo-api/v1/fetch_templates/
	 *
	 */
	class Acme_Demo_Setup_Template_Library_Api extends WP_Rest_Controller {

		/**
		 * Rest route namespace.
		 *
		 * @var Acme_Demo_Setup_Template_Library_Api
		 */
		public $namespace = 'acmethemes-demo-api/';

		/**
		 * Rest route version.
		 *
		 * @var Acme_Demo_Setup_Template_Library_Api
		 */
		public $version = 'v1';

		/**
		 * Initialize the class
		 */
		public function run() {
			add_action( 'rest_api_init', array( $this, 'register_routes' ) );
        }

		/**
		 * Register REST API route
		 */
		public function register_routes() {
			$namespace = $this->namespace . $this->version;

            register_rest_route(
                $namespace,
                '/fetch_templates',
                array(
                    array(
                        'methods'	=> \WP_REST_Server::READABLE,
                        'callback'	=> array( $this, 'fetch_templates' ),
                        'args'		=> array(
                            'theme-slug'	=> array(
                                'type'        => 'string',
                                'required'    => true,
                                'description' => __( 'Theme Slug', 'acme-demo-setup' ),
                            ),
                        ),
                        'permission_callback' => '__return_true',
                    ),
                )
            );
		}

		/**
		 * Function to fetch templates.
		 *
		 * @return array|bool|\WP_Error
		 */
		public function fetch_templates( \WP_REST_Request $request ) {
            if ( ! $request->get_param( 'theme-slug' ) ) {
                return false;
            }
            $theme_slug = $request->get_param( 'theme-slug' );

            $templates = acme_demo_setup_get_templates_lists( $theme_slug );
			return rest_ensure_response( $templates );
		}

		/**
		 * Gets an instance of this object.
		 * Prevents duplicate instances which avoid artefacts and improves performance.
		 *
		 * @static
		 * @access public
		 * @since 1.0.1
		 * @return object
		 */
		public static function get_instance() {
			// Store the instance locally to avoid private static replication
			static $instance = null;

			// Only run these methods if they haven't been ran previously
			if ( null === $instance ) {
				$instance = new self();
			}

			// Always return the instance
			return $instance;
		}

		/**
		 * Throw error on object clone
		 *
		 * The whole idea of the singleton design pattern is that there is a single
		 * object therefore, we don't want the object to be cloned.
		 *
		 * @access public
		 * @since 1.0.0
		 * @return void
		 */
		public function __clone() {
			// Cloning instances of the class is forbidden.
			_doing_it_wrong( __FUNCTION__, esc_html__( 'Cheatin&#8217; huh?', 'acme-demo-setup' ), '1.0.0' );
		}

		/**
		 * Disable unserializing of the class
		 *
		 * @access public
		 * @since 1.0.0
		 * @return void
		 */
		public function __wakeup() {
			// Unserializing instances of the class is forbidden.
			_doing_it_wrong( __FUNCTION__, esc_html__( 'Cheatin&#8217; huh?', 'acme-demo-setup' ), '1.0.0' );
		}
	}

}
Acme_Demo_Setup_Template_Library_Api::get_instance()->run();