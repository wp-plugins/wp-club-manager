<?php
/**
 * Post Types Admin
 *
 * @author 		ClubPress
 * @category 	Admin
 * @package 	WPClubManager/Admin
 * @version     1.3.1
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'WPCM_Admin_Post_Types' ) ) :

class WPCM_Admin_Post_Types {

	/**
	 * Constructor
	 */
	public function __construct() {

		add_action( 'admin_init', array( $this, 'include_post_type_handlers' ) );

		// Bulk / quick edit
		add_action( 'bulk_edit_custom_box', array( $this, 'bulk_edit' ), 10, 2 );
		add_action( 'quick_edit_custom_box',  array( $this, 'quick_edit' ), 10, 2 );
		add_action( 'save_post', array( $this, 'bulk_and_quick_edit_save_post' ), 10, 2 );

		include_once( 'post-types/class-wpcm-admin-meta-boxes.php' );
	}

	/**
	 * Conditonally load classes and functions only needed when viewing a post type.
	 */
	public function include_post_type_handlers() {
		
		//include( 'post-types/class-wpcm-admin-meta-boxes.php' );
		include( 'post-types/class-wpcm-admin-cpt-club.php' );
		include( 'post-types/class-wpcm-admin-cpt-match.php' );
		include( 'post-types/class-wpcm-admin-cpt-player.php' );
		include( 'post-types/class-wpcm-admin-cpt-sponsor.php' );
		include( 'post-types/class-wpcm-admin-cpt-staff.php' );
	}

	/**
	 * Custom bulk edit - form
	 *
	 * @param mixed $column_name
	 * @param mixed $post_type
	 */
	public function bulk_edit( $column_name, $post_type ) {

		if ( 'wpcm_match' != $post_type ) {
			return;
		}

		if ( did_action( 'bulk_edit_custom_box' ) !== 1 ) return;

		$teams = get_terms( 'wpcm_team', array(
			'hide_empty' => false,
		) );

		include( WPCM()->plugin_path() . '/includes/admin/views/html-bulk-edit-match.php' );
	}

	/**
	 * Custom quick edit - form
	 *
	 * @param mixed $column_name
	 * @param mixed $post_type
	 */
	public function quick_edit( $column_name, $post_type ) {

		if ( 'wpcm_match' != $post_type ) {
			return;
		}

		if ( did_action( 'quick_edit_custom_box' ) !== 1 ) return;

		$teams = get_terms( 'wpcm_team', array(
			'hide_empty' => false,
		) );

		include( WPCM()->plugin_path() . '/includes/admin/views/html-quick-edit-match.php' );
	}

	/**
	 * Quick and bulk edit saving
	 *
	 * @param int $post_id
	 * @param WP_Post $post
	 * @return int
	 */
	public function bulk_and_quick_edit_save_post( $post_id, $post ) {

		// If this is an autosave, our form has not been submitted, so we don't want to do anything.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return $post_id;
		}

		// Don't save revisions and autosaves
		if ( wp_is_post_revision( $post_id ) || wp_is_post_autosave( $post_id ) ) {
			return $post_id;
		}

		// Check post type is match
		if ( 'wpcm_match' != $post->post_type ) {
			return $post_id;
		}

		// Check user permission
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		}

		// Check nonces
		if ( ! isset( $_REQUEST['wpclubmanager_quick_edit_nonce'] ) && ! isset( $_REQUEST['wpclubmanager_bulk_edit_nonce'] ) ) {
			return $post_id;
		}
		if ( isset( $_REQUEST['wpclubmanager_quick_edit_nonce'] ) && ! wp_verify_nonce( $_REQUEST['wpclubmanager_quick_edit_nonce'], 'wpclubmanager_quick_edit_nonce' ) ) {
			return $post_id;
		}
		if ( isset( $_REQUEST['wpclubmanager_bulk_edit_nonce'] ) && ! wp_verify_nonce( $_REQUEST['wpclubmanager_bulk_edit_nonce'], 'wpclubmanager_bulk_edit_nonce' ) ) {
			return $post_id;
		}

		// Get the match and save
		$match = get_post( $post );

		if ( ! empty( $_REQUEST['wpclubmanager_quick_edit'] ) ) {
			$this->quick_edit_save( $post_id, $match );
		} else {
			$this->bulk_edit_save( $post_id, $match );
		}

		return $post_id;
	}

	/**
	 * Quick edit
	 *
	 * @param integer $post_id
	 * @param $match
	 */
	private function quick_edit_save( $post_id, $match ) {
		global $wpdb;

		// Save fields
		if ( ! empty( $_REQUEST['wpcm_team'] ) ) {
			wp_set_object_terms( $post_id, wpcm_clean( $_REQUEST['wpcm_team'] ), 'wpcm_team' );
		}

		do_action( 'wpclubmanager_match_quick_edit_save', $match );
	}

	/**
	 * Bulk edit
	 * @param integer $post_id
	 * @param $match
	 */
	public function bulk_edit_save( $post_id, $match ) {

		if ( ! empty( $_REQUEST['wpcm_team'] ) ) {
			$teams = '_no_team' == $_REQUEST['wpcm_team'] ? '' : wpcm_clean( $_REQUEST['wpcm_team'] );

			wp_set_object_terms( $post_id, $teams, 'wpcm_team' );
		}

		do_action( 'wpclubmanager_match_bulk_edit_save', $match );
	}
}

endif;

return new WPCM_Admin_Post_Types();