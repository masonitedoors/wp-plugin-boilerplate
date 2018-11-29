<?php
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the dashboard.
 *
 * @package    WP_Plugin_Boilerplate
 */

declare( strict_types = 1 );

namespace Masonite\WP_Plugin_Boilerplate;

/**
 * The core plugin class.
 *
 * This is used to define internationalization, dashboard-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @package    WP_Plugin_Boilerplate
 */
class Plugin {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @var      WP_Plugin_Boilerplate_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @var      string    $pluginname    The string used to uniquely identify this plugin.
	 */
	protected $pluginname = 'wp-plugin-boilerplate';

	/**
	 * The current version of the plugin.
	 *
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version = '1.0.0';

	/**
	 * Defines the path to the plugin's root directory.
	 *
	 * @var      string    $plugin_dir_path    Defines the path to the plugin's root directory.
	 */
	protected $plugin_dir_path;

	/**
	 * Defines the url to the plugin's root directory.
	 *
	 * @var      string    $plugin_dir_url    Defines the url to the plugin's root directory.
	 */
	protected $plugin_dir_url;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 */
	public function __construct() {
		$this->loader = new Loader();
	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the I18n class in order to set the domain and to register the hook
	 * with WordPress.
	 */
	private function set_locale() {
		$plugin_i18n = new I18n();
		$plugin_i18n->set_domain( $this->get_plugin_name() );
		$plugin_i18n->load_plugin_textdomain();
	}

	/**
	 * Define the path to the plugin's root directory.
	 */
	private function define_plugin_dir_path() {
		$this->plugin_dir_path = \plugin_dir_path( dirname( __FILE__ ) );
	}

	/**
	 * Define the url to the plugin's root directory.
	 */
	private function define_plugin_dir_url() {
		$this->plugin_dir_url = \plugin_dir_url( dirname( __FILE__ ) );
	}

	/**
	 * Register all of the hooks related to the dashboard functionality
	 * of the plugin.
	 */
	private function define_admin_hooks() {
		$plugin_admin    = new Admin( $this );
		$plugin_basename = \plugin_basename( dirname( __FILE__, 2 ) ) . '/wp-plugin-boilerplate.php';

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'register_options_page' );
		$this->loader->add_filter( 'plugin_action_links_' . $plugin_basename, $plugin_admin, 'settings_link', 10, 4 );
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 */
	private function define_frontend_hooks() {
		$plugin_frontend = new Frontend( $this );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_frontend, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_frontend, 'enqueue_scripts' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_frontend, 'enqueue_app_assets' );
		$this->loader->add_shortcode( 'wp_plugin_boilerplate', $plugin_frontend, 'shortcode' );
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * Load the dependencies, define the locale, and set the hooks for the Dashboard and
	 * the public-facing side of the site.
	 */
	public function run() {
		$this->set_locale();
		$this->define_plugin_dir_path();
		$this->define_plugin_dir_url();
		$this->define_admin_hooks();
		$this->define_frontend_hooks();
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @return string The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->pluginname;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @return WP_Plugin_Boilerplate_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @return String The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

	/**
	 * Retrieve the path to the plugin's root directory.
	 *
	 * @return String The path to the plugin's root directory.
	 */
	public function get_plugin_dir_path() {
		return $this->plugin_dir_path;
	}

	/**
	 * Retrieve the url to the plugin's root directory.
	 *
	 * @return String The url to the plugin's root directory.
	 */
	public function get_plugin_dir_url() {
		return $this->plugin_dir_url;
	}

}
