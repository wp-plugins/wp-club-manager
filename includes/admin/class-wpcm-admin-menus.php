<?php
/**
 * Setup menus in WP admin.
 *
 * @author 		ClubPress
 * @category 	Admin
 * @package 	WPClubManager/Admin
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'WPCM_Admin_Menus' ) ) :

class WPCM_Admin_Menus {

	/**
	 * Hook in tabs.
	 */
	public function __construct() {

		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
	}

	/**
	 * Add menu items
	 */
	public function admin_menu() {

		global $menu, $wpclubmanager;

	    $main_page = add_menu_page( __( 'Club Manager', 'wpclubmanager' ), __( 'Club Manager', 'wpclubmanager' ), 'manage_wpclubmanager', 'wpcm-settings' , array( $this, 'settings_page' ), null, '99.6' );

		remove_submenu_page('edit.php?post_type=wpcm_player', 'edit-tags.php?taxonomy=wpcm_season&amp;post_type=wpcm_player');
		remove_submenu_page('edit.php?post_type=wpcm_player', 'edit-tags.php?taxonomy=wpcm_team&amp;post_type=wpcm_player');

		remove_submenu_page('edit.php?post_type=wpcm_staff', 'edit-tags.php?taxonomy=wpcm_season&amp;post_type=wpcm_staff');
		remove_submenu_page('edit.php?post_type=wpcm_staff', 'edit-tags.php?taxonomy=wpcm_team&amp;post_type=wpcm_staff');
	}

	/**
	 * Init the settings page
	 */
	public function settings_page() {
		include_once( 'class-wpcm-admin-settings.php' );
		WPCM_Admin_Settings::output();
	}
}

endif;

return new WPCM_Admin_Menus();