<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://www.acmethemes.com/
 * @since      1.0.0
 *
 * @package    Acme Themes
 * @subpackage Acme_Demo_Setup
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Acme Themes
 * @subpackage Acme_Demo_Setup
 * @author     Acme Themes <info@acmethemes.com>
 */
class Acme_Demo_Setup_i18n {

	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'acme-demo-setup',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}
}