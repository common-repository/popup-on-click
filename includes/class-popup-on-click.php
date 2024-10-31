<?php

/**
 * @package    Popup_On_Click
 * @subpackage Popup_On_Click/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 * @package    Popup_On_Click
 * @subpackage Popup_On_Click/includes
 * @author     Yaroslav Grebnov <grebnov@gmail.com>
 */
class Popup_On_Click {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 * @access   protected
	 * @var      Popup_On_Click_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 * @access   protected
	 * @var      string    $popup_on_click    The string used to uniquely identify this plugin.
	 */
	protected $popup_on_click;

	/**
	 * The current version of the plugin.
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 */
	public function __construct() {

		$this->plugin_name = 'popup-on-click';
		$this->version = '1.0.0';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Popup_On_Click_Loader. Orchestrates the hooks of the plugin.
	 * - Popup_On_Click_i18n. Defines internationalization functionality.
	 * - Popup_On_Click_Admin. Defines all hooks for the admin area.
	 * - Popup_On_Click_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-popup-on-click-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-popup-on-click-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-popup-on-click-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-popup-on-click-public.php';

		$this->loader = new Popup_On_Click_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Popup_On_Click_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Popup_On_Click_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Popup_On_Click_Admin( $this->get_plugin_name(), $this->get_version() );

		// Add Settings menu item for the plugin
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'add_options_page' );
		 
		// Add Settings link to the plugin
		$plugin_basename = plugin_basename( plugin_dir_path( __DIR__ ) . $this->plugin_name . '.php' );
		$this->loader->add_filter( 'plugin_action_links_' . $plugin_basename, $plugin_admin, 'add_action_links' );

		// Register Settings
		$this->loader->add_action( 'admin_init', $plugin_admin, 'register_setting' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Popup_On_Click_Public( $this->get_plugin_name(), $this->get_version() );

		//Load the latest jQuery version
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'load_latest_jquery', PHP_INT_MAX );
		//Enable Bootstrap js and css
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enable_bootstrap' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
		//Register used by plugin shortcodes
		$this->loader->add_action( 'init', $plugin_public, 'register_shortcodes' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 * @return    Popup_On_Click_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}
}