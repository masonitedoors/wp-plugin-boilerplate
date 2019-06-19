<?php
/**
 * Plugin Name:       My Plugin Name
 * Description:       A brief description of what this plugin does.
 * Version:           1.0.0
 * Author:            Masonite
 * Author URI:        https://www.masonite.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       my-plugin-name
 * Domain Path:       /languages
 */

namespace Masonite\WP\My_Plugin_Name;

// If this file is called directly, abort.
defined( 'WPINC' ) || die();

/**
 * Autoload the plugin's classes.
 */
require_once __DIR__ . '/inc/autoload.php';

/**
 * The code that runs during plugin activation.
 * This action is documented in lib/Activator.php
 */
register_activation_hook( __FILE__, __NAMESPACE__ . '\Activator::activate' );

/**
 * The code that runs during plugin deactivation.
 * This action is documented in lib/Deactivator.php
 */
register_deactivation_hook( __FILE__, __NAMESPACE__ . '\Deactivator::deactivate' );

/**
 * Begins execution of the plugin.
 */
add_action(
	'plugins_loaded',
	function () {
		$plugin = new Plugin();
		$plugin->run();
	}
);
