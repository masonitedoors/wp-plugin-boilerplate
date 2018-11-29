<?php
/**
 * The dashboard-specific functionality of the plugin.
 *
 * @package    WP_Plugin_Boilerplate
 */

declare( strict_types = 1 );

namespace Masonite\WP_Plugin_Boilerplate;

/**
 * The dashboard-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the dashboard-specific stylesheet and JavaScript.
 *
 * @package    WP_Plugin_Boilerplate
 */
class Admin {

	/**
	 * The plugin's instance.
	 *
	 * @var    Plugin $plugin This plugin's instance.
	 */
	private $plugin;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @param Plugin $plugin This plugin's instance.
	 */
	public function __construct( Plugin $plugin ) {
		$this->plugin = $plugin;
	}

	/**
	 * Register the stylesheets for the Dashboard.
	 */
	public function enqueue_styles() {
		\wp_enqueue_style(
			$this->plugin->get_plugin_name(),
			\plugin_dir_url( dirname( __FILE__ ) ) . 'dist/styles/admin.css',
			[],
			$this->plugin->get_version(),
			'all'
		);
	}

	/**
	 * Register the JavaScript for the dashboard.
	 */
	public function enqueue_scripts() {
		\wp_enqueue_script(
			$this->plugin->get_plugin_name(),
			\plugin_dir_url( dirname( __FILE__ ) ) . 'dist/scripts/admin.js',
			[],
			$this->plugin->get_version(),
			'all'
		);
	}

	/**
	 * Register the options page for the plugin.
	 */
	public function register_options_page() {
		\add_submenu_page(
			'options-general.php',
			__( 'WP Plugin Boilerplate Settings', 'wp-plugin-boilerplate' ),
			__( 'WP Plugin Boilerplate', 'wp-plugin-boilerplate' ),
			'manage_options',
			'wp-plugin-boilerplate',
			[ $this, 'options_page_cb' ]
		);
	}

	/**
	 * Callback for the options page.
	 */
	public function options_page_cb() {
		include_once 'Admin/options-page.php';
	}

	/**
	 * Add a link to the plugin's options page.
	 *
	 * @param array  $links       The plugin action links.
	 * @param string $plugin_file The plugin's main file.
	 * @param array  $plugin_data The plugin data.
	 * @param string $context     The context.
	 *
	 * @return array
	 */
	public function settings_link( $links, $plugin_file, $plugin_data, $context ) {
		if ( ! \current_user_can( 'manage_options' ) ) {
			return;
		}

		array_unshift(
			$links,
			\sprintf( '<a href="%s">%s</a>', \esc_attr( self::get_settings_page_url() ), __( 'Settings', 'wp-plugin-boilerplate' ) )
		);

		return $links;
	}

	/**
	 * Return the plugin's settings page URL.
	 *
	 * @return string
	 */
	protected function get_settings_page_url() {
		$base = \admin_url( 'options-general.php' );

		return \add_query_arg( 'page', 'wp-plugin-boilerplate', $base );
	}

}
