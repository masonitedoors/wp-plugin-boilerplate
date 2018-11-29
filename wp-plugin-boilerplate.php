<?php
/**
 * WP Plugin Boilerplate plugin for WordPress
 *
 * @package           WP_Plugin_Boilerplate
 *
 * @wordpress-plugin
 * Plugin Name:       WP Plugin Boilerplate
 * Description:       A WordPress plugin boilerplate for Masonite.
 * Version:           1.0.0
 * Author:            Masonite
 * Author URI:        https://www.masonite.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp-plugin-boilerplate
 * Domain Path:       /languages
 */

declare( strict_types = 1 );

// Autoload plugin classes.
if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
	require __DIR__ . '/vendor/autoload.php';
}

// If this file is called directly, abort.
defined( 'WPINC' ) || die();

/**
 * The code that runs during plugin activation.
 * This action is documented in lib/class-activator.php
 */
\register_activation_hook( __FILE__, '\Masonite\WP_Plugin_Boilerplate\Activator::activate' );

/**
 * The code that runs during plugin deactivation.
 * This action is documented in lib/class-deactivator.php
 */
\register_deactivation_hook( __FILE__, '\Masonite\WP_Plugin_Boilerplate\Deactivator::deactivate' );

/**
 * Begins execution of the plugin.
 */
\add_action(
	'plugins_loaded',
	function () {
		$plugin = new \Masonite\WP_Plugin_Boilerplate\Plugin();
		$plugin->run();
	}
);
