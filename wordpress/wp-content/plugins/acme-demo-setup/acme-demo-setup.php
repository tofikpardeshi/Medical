<?php
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
    exit;
}

/**
 *
 * @link              https://www.acmethemes.com/
 * @since             2.0.0
 * @package           Acme Themes
 * @subpackage        Acme Demo Setup
 *
 * @wordpress-plugin
 * Plugin Name:       Acme Demo Setup
 * Plugin URI:        
 * Description:       Install Template Demo Library for Acme Themes
 * Version:           2.0.3
 * Author:            acmethemes
 * Author URI:        https://www.acmethemes.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       acme-demo-setup
 * Domain Path:       /languages
 */

/*Define Constants for this plugin*/
define( 'ACME_DEMO_SETUP_VERSION', '2.0.3' );
define( 'ACME_DEMO_SETUP_PLUGIN_NAME', 'acme-demo-setup' );
define( 'ACME_DEMO_SETUP_PATH', plugin_dir_path( __FILE__ ) );
define( 'ACME_DEMO_SETUP_URL', plugin_dir_url( __FILE__ ) );
define( 'ACME_DEMO_SETUP_TEMPLATE_URL', ACME_DEMO_SETUP_URL.'includes/demo-data/' );
define( 'ACME_DEMO_SETUP_SCRIPT_PREFIX', ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-acme-demo-setup-activator.php
 */
function activate_acme_demo_setup() {
    require_once ACME_DEMO_SETUP_PATH . 'includes/activator.php';
    Acme_Demo_Setup_Activator::activate();
}


/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require ACME_DEMO_SETUP_PATH . 'includes/init.php';


/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-acme-demo-setup-deactivator.php
 */
function deactivate_acme_demo_setup() {
    require_once ACME_DEMO_SETUP_PATH . 'includes/deactivator.php';
    Acme_Demo_Setup_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_acme_demo_setup' );
register_deactivation_hook( __FILE__, 'deactivate_acme_demo_setup' );

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
if( !function_exists( 'run_acme_demo_setup')){

    function run_acme_demo_setup() {

        return Acme_Demo_Setup::instance();
    }
    run_acme_demo_setup()->run();
}