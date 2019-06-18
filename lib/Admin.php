<?php

declare( strict_types = 1 );

namespace Masonite\WP\My_Plugin_Name;

/**
 * The dashboard-specific functionality of the plugin.
 *
 * Defines the My Plugin Name, version, and two examples hooks for how to
 * enqueue the dashboard-specific stylesheet and JavaScript.
 */
class Admin extends Plugin {

	/**
	 * Initialize the class and set its properties.
	 */
	public function __construct() {
		// Exit if not in wp-admin.
		if ( ! is_admin() ) {
			return;
		}
	}

	/**
	 * Register the stylesheets for the Dashboard.
	 */
	public function enqueue_styles() : void {
		wp_enqueue_style(
			self::get_plugin_name(),
			plugin_dir_url( dirname( __FILE__ ) ) . 'dist/styles/admin.css',
			[],
			self::get_plugin_version(),
			'all'
		);
	}

	/**
	 * Register the JavaScript for the dashboard.
	 */
	public function enqueue_scripts() : void {
		wp_enqueue_script(
			self::get_plugin_name(),
			plugin_dir_url( dirname( __FILE__ ) ) . 'dist/scripts/admin.js',
			[],
			self::get_plugin_version(),
			'all'
		);
	}

	/**
	 * Register the options page for the plugin.
	 */
	public function register_options_page() : void {
		add_submenu_page(
			'options-general.php',
			__( 'My Plugin Name Settings', 'my-plugin-name' ),
			__( 'My Plugin Name', 'my-plugin-name' ),
			'manage_options',
			'my-plugin-name',
			[ $this, 'options_page_cb' ]
		);
	}

	/**
	 * Callback for the options page.
	 */
	public function options_page_cb() : void {
		include_once 'Admin/options-page.php';
	}

	/**
	 * Add a link to the plugin's options page.
	 *
	 * @param array  $links       The plugin action links.
	 * @param string $plugin_file The plugin's main file.
	 * @param array  $plugin_data The plugin data.
	 * @param string $context     The context.
	 */
	public function settings_link( $links, $plugin_file, $plugin_data, $context ) : array {
		if ( ! current_user_can( 'manage_options' ) ) {
			return $links;
		}

		// Add new item to the links array.
		array_unshift(
			$links,
			sprintf( '<a href="%s">%s</a>', esc_attr( self::get_settings_page_url() ), __( 'Settings', 'my-plugin-name' ) )
		);

		return $links;
	}

	/**
	 * Return the plugin's settings page URL.
	 */
	protected function get_settings_page_url() : string {
		$base = admin_url( 'options-general.php' );

		return add_query_arg( 'page', 'my-plugin-name', $base );
	}

}
