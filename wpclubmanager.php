<?php
/**
 * Plugin Name: WP Club Manager
 * Version: 1.3.4
 * Plugin URI: https://wpclubmanager.com
 * Description: A plugin to help you run a sports club website easily and quickly.
 * Author: Clubpress
 * Author URI: https://wpclubmanager.com
 * Requires at least: 3.8
 * Tested up to: 4.4
 * 
 * Text Domain: wpclubmanager
 * Domain Path: /languages/
 *
 * @package   WPClubManager
 * @category  Core
 * @author    Clubpress <info@wpclubmanager.com>
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'WPClubManager' ) ) :

/**
 * Main WPClubManager Class
 *
 * @class WPClubManager
 */
final class WPClubManager {

	/**
	 * @var string
	 */
	public $version = '1.3.4';

	/**
	 * @var WPClubManager The single instance of the class
	 */
	protected static $_instance = null;

	/**
	 * @var WPCM_Countries $countries
	 */
	public $countries = null;

	/**
	 * @var WPCM_Sports $sports
	 */
	public $sports = null;

	/**
	 * Main WPClubManager Instance
	 *
	 * Ensures only one instance of WPClubManager is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @static
	 * @see WPCM()
	 * @return WPClubManager - Main instance
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Cloning is forbidden.
	 *
	 * @since 1.1.0
	 */
	public function __clone() {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'wpclubmanager' ), '1.1.0' );
	}

	/**
	 * Unserializing instances of this class is forbidden.
	 *
	 * @since 1.1.0
	 */
	public function __wakeup() {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'wpclubmanager' ), '1.1.0' );
	}

	/**
	 * WPClubManager Constructor.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return WPClubManager
	 */
	public function __construct() {

		$this->constants();
		$this->includes();
		$this->init_hooks();

		do_action( 'wpclubmanager_loaded' );
	}

	/**
	 * Hook into actions and filters
	 * @since  2.3
	 */
	private function init_hooks() {

		register_activation_hook( __FILE__, array( 'WPCM_Install', 'install' ) );

		add_action( 'after_setup_theme', array( $this, 'compatibility' ) );
		add_action( 'after_setup_theme', array( $this, 'include_template_functions' ), 11 );
		add_action( 'init', array( $this, 'init' ), 0 );
		add_action( 'init', array( 'WPCM_Shortcodes', 'init' ) );
	}

	/**
	 * Defines constants used by the plugin.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function constants() {

		define( 'WPCM_PLUGIN_FILE', __FILE__ );
		define( 'WPCM_VERSION', $this->version );

		if ( ! defined( 'WPCM_TEMPLATE_PATH' ) ) {
			define( 'WPCM_TEMPLATE_PATH', $this->template_path() );
		}
		if ( !defined( 'WPCM_URL' ) ) {
			define( 'WPCM_URL', plugin_dir_url( __FILE__ ) );
		}
		if ( !defined( 'WPCM_PATH' ) ) {
			define( 'WPCM_PATH', plugin_dir_path( __FILE__ ) );
		}
		if ( !defined( 'WPCM_PLUGIN_BASENAME' ) ) {
			define( 'WPCM_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
		}
		if ( !defined( 'WPCM_BASENAME' ) ) {
			define( 'WPCM_BASENAME', plugin_basename( __FILE__ ) );
		}
	}

	/**
	 * What type of request is this?
	 * string $type ajax, frontend or admin
	 * @return bool
	 */
	private function is_request( $type ) {
		switch ( $type ) {
			case 'admin' :
				return is_admin();
			case 'ajax' :
				return defined( 'DOING_AJAX' );
			case 'frontend' :
				return ( ! is_admin() || defined( 'DOING_AJAX' ) );
		}
	}

	/**
	 * Loads the initial files needed by the plugin.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function includes() {

		include_once( 'includes/class-wpcm-autoloader.php' );
		include_once( 'includes/wpcm-core-functions.php' );
		include_once( 'includes/wpcm-widget-functions.php' );
		include_once( 'includes/class-wpcm-install.php' );

		if ( $this->is_request( 'admin' ) ) {
			include_once( 'includes/admin/class-wpcm-admin.php' );
		}

		if ( $this->is_request( 'ajax' ) ) {
			$this->ajax_includes();
		}

		if ( $this->is_request( 'frontend' ) ) {
			$this->frontend_includes();
		}

		include_once( 'includes/class-wpcm-post-types.php' );
		include_once( 'includes/class-wpcm-countries.php' );
		include_once( 'includes/class-wpcm-license-handler.php' );
	}

	/**
	 * Include required ajax files.
	 *
	 * @access public
	 * @return void
	 */
	public function ajax_includes() {

		include_once( 'includes/class-wpcm-ajax.php' );
	}


	/**
	 * Include required frontend files.
	 *
	 * @access public
	 * @return void
	 */
	public function frontend_includes() {

		include_once( 'includes/wpcm-template-hooks.php' );
		include_once( 'includes/class-wpcm-template-loader.php' );
		include_once( 'includes/class-wpcm-frontend-scripts.php' );
		include_once( 'includes/class-wpcm-shortcodes.php' );
	}


	/**
	 * Function used to Init WPCM Template Functions - This makes them pluggable by plugins and themes.
	 *
	 * @access public
	 * @return void
	 */
	public function include_template_functions() {

		include_once( 'includes/wpcm-template-functions.php' );
	}

	/**
	 * Init WooCommerce when WordPress Initialises.
	 *
	 * @access public
	 * @return void
	 */
	public function init() {

		//Before init action
		do_action( 'before_wpcm_init' );

		// Set up localisation
		$this->load_plugin_textdomain();

		// Load class instances
		$this->countries = new WPCM_Countries();
		$this->sports = new WPCM_Sports();

		// Init action
		do_action( 'wpcm_init' );
	}

	/**
	 * Loads the translation files.
	 *
	 * @since  1.0.3
	 * @access public
	 * @return void
	 */
	public function load_plugin_textdomain() {

		$locale = apply_filters( 'plugin_locale', get_locale(), 'wpclubmanager' );

		// Global + Frontend Locale
		load_textdomain( 'wpclubmanager', WP_LANG_DIR . "/wpclubmanager/wpclubmanager-$locale.mo" );
		load_plugin_textdomain( 'wpclubmanager', false, plugin_basename( dirname( __FILE__ ) . "/languages" ) );
	}

	/**
	 * Add Compatibility for various bits.
	 *
	 * @access public
	 * @return void
	 */
	public function compatibility() {

		// Post thumbnail support
		if ( ! current_theme_supports( 'post-thumbnails', 'wpcm_player' ) ) {
			add_theme_support( 'post-thumbnails' );
			remove_post_type_support( 'post', 'thumbnail' );
			remove_post_type_support( 'page', 'thumbnail' );
		} else {
			add_post_type_support( 'wpcm_player', 'thumbnail' );
		}

		// Add image sizes
		$player_thumbnail = wpcm_get_image_size( 'player_thumbnail' );
		$player_single	= wpcm_get_image_size( 'player_single' );
		$staff_thumbnail = wpcm_get_image_size( 'staff_thumbnail' );
		$staff_single	= wpcm_get_image_size( 'staff_single' );

		add_image_size( 'crest-large',  100, 100, false );
		add_image_size( 'crest-medium',  50, 50, false );
		add_image_size( 'crest-small',  25, 25, false );
		add_image_size( 'player_thumbnail', $player_thumbnail['width'], $player_thumbnail['height'], $player_thumbnail['crop'] );
		add_image_size( 'player_single', $player_single['width'], $player_single['height'], $player_single['crop'] );
		add_image_size( 'staff_thumbnail', $staff_thumbnail['width'], $staff_thumbnail['height'], $staff_thumbnail['crop'] );
		add_image_size( 'staff_single', $staff_single['width'], $staff_single['height'], $staff_single['crop'] );
	}

	/** Helper functions ******************************************************/

	/**
	 * Get the plugin url.
	 *
	 * @return string
	 */
	public function plugin_url() {
		return untrailingslashit( plugins_url( '/', __FILE__ ) );
	}

	/**
	 * Get the plugin path.
	 *
	 * @return string
	 */
	public function plugin_path() {
		return untrailingslashit( plugin_dir_path( __FILE__ ) );
	}

	/**
	 * Get the template path.
	 *
	 * @return string
	 */
	public function template_path() {
		return apply_filters( 'WPCM_TEMPLATE_PATH', 'wpclubmanager/' );
	}

	/**
	 * Get Ajax URL.
	 *
	 * @return string
	 */
	public function ajax_url() {
		return admin_url( 'admin-ajax.php', 'relative' );
	}

}

endif;

/**
 * Returns the main instance of WPCM to prevent the need to use globals.
 *
 * @since  1.0.0
 * @return WPClubManager
 */
function WPCM() {
	return WPClubManager::instance();
}

$GLOBALS['wpclubmanager'] = WPCM();