<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @package    WP_Plugin_Boilerplate
 */

declare( strict_types = 1 );

namespace Masonite\WP_Plugin_Boilerplate;

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the dashboard-specific stylesheet and JavaScript.
 *
 * @package    WP_Plugin_Boilerplate
 */
class Frontend {

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
	 * Register the stylesheets for the public-facing side of the site.
	 */
	public function enqueue_styles() {
		\wp_enqueue_style(
			$this->plugin->get_plugin_name(),
			\plugin_dir_url( dirname( __FILE__ ) ) . 'dist/styles/frontend.css',
			[],
			$this->plugin->get_version(),
			'all'
		);
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 */
	public function enqueue_scripts() {
		\wp_enqueue_script(
			$this->plugin->get_plugin_name(),
			\plugin_dir_url( dirname( __FILE__ ) ) . 'dist/scripts/frontend.js',
			[],
			$this->plugin->get_version(),
			'all'
		);
	}

	/**
	 * Register the react app assets for the public-facing side of the site.
	 */
	public function enqueue_app_assets() {
		if ( ! class_exists( 'Masonite\WP_Plugin_Boilerplate\App' ) ) {
			return;
		}

		global $post;

		if ( \has_shortcode( $post->post_content, 'wp_plugin_boilerplate' ) ) {
			$app = new App( $this->plugin );
			$app->enqueue_assets(
				$this->plugin->get_plugin_dir_path() . 'app',
				[
					'base_url' => $this->plugin->get_plugin_dir_url() . 'app',
				]
			);
		}
	}

	/**
	 * The main shortcode for the public-facing side of the site.
	 *
	 * [wp_plugin_boilerplate]
	 *
	 * @return string
	 */
	public function shortcode() {
		return '<div id="root"></div>';
	}

}
