<?php
/**
 * Admin functions for the staff post type
 *
 * @author 		ClubPress
 * @category 	Admin
 * @package 	WPClubManager/Admin/Post Types
 * @version     1.3.2
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'WPCM_Admin_CPT' ) ) {
	include( 'class-wc-admin-cpt.php' );
}

if ( ! class_exists( 'WPCM_Admin_CPT_Staff' ) ) :

class WPCM_Admin_CPT_Staff extends WPCM_Admin_CPT {

	/**
	 * Constructor
	 */
	public function __construct() {

		$this->type = 'wpcm_staff';

		// Post title fields
		add_filter( 'enter_title_here', array( $this, 'enter_title_here' ), 1, 2 );
		add_filter( 'gettext', array( $this, 'text_replace' ), 10, 4 );
		add_filter( 'admin_post_thumbnail_html', array( $this, 'custom_admin_post_thumbnail_html' ) );
		add_filter( 'media_view_strings', array( $this, 'media_view_strings' ), 10, 2 );

		add_filter( 'manage_edit-wpcm_staff_columns', array( $this, 'custom_edit_columns' ) );
		add_action( 'manage_wpcm_staff_posts_custom_column', array( $this, 'custom_columns' ) );
		add_filter( 'request', array( $this, 'custom_column_orderby' ) );

		add_action( 'restrict_manage_posts', array( $this, 'request_filter_dropdowns' ) );

		// Call WC_Admin_CPT constructor
		parent::__construct();
	}

	/**
	 * Check if we're editing or adding a match
	 * @return boolean
	 */
	private function is_editing_product() {
		if ( ! empty( $_GET['post_type'] ) && 'wpcm_staff' == $_GET['post_type'] ) {
			return true;
		}
		if ( ! empty( $_GET['post'] ) && 'wpcm_staff' == get_post_type( $_GET['post'] ) ) {
			return true;
		}
		if ( ! empty( $_REQUEST['post_id'] ) && 'wpcm_staff' == get_post_type( $_REQUEST['post_id'] ) ) {
			return true;
		}
		return false;
	}

	/**
	 * Change title boxes in admin.
	 * @param  string $text
	 * @param  object $post
	 * @return string
	 */
	public function enter_title_here( $text, $post ) {

		if ( $post->post_type == 'wpcm_staff' )
			return __( 'Enter staff name', 'wpclubmanager' );

		return $text;
	}

	// text replace
	public function text_replace( $string = '' ) {

		if ( 'Scheduled for: <b>%1$s</b>' == $string && $this->is_editing_product() ) {
			$string = __( 'Joins on: <b>%1$s</b>', 'wpclubmanager' );
		} elseif ( 'Published on: <b>%1$s</b>' == $string && $this->is_editing_product() ) {
			$string = __( 'Joined on: <b>%1$s</b>', 'wpclubmanager' );
		} elseif ( 'Publish <b>immediately</b>' == $string && $this->is_editing_product() ) {
			$string = __( 'Joined on: <b>%1$s</b>', 'wpclubmanager' );
		}

		return $string;
	}

	public function custom_admin_post_thumbnail_html( $content ) {
	    global $current_screen;
	 
	    if( 'wpcm_staff' == $current_screen->post_type ) {

	        $content = str_replace( __( 'Set featured image' ), __( 'Set staff image', 'wpclubmanager' ), $content);
	    	$content = str_replace( __( 'Remove featured image' ), __( 'Remove staff image', 'wpclubmanager' ), $content );
	    }

	        return $content;
	}

	/**
	 * Change "Featured Image" to "Staff Image" throughout media modals.
	 * @param  array  $strings Array of strings to translate.
	 * @param  object $post
	 * @return array
	 */
	public function media_view_strings( $strings = array(), $post = null ) {

		if ( is_object( $post ) ) {
			if ( 'wpcm_staff' == $post->post_type ) {
				$strings['setFeaturedImageTitle'] = __( 'Set staff image', 'wpclubmanager' );
				$strings['setFeaturedImage']      = __( 'Set staff image', 'wpclubmanager' );
			}
		}

		return $strings;
	}

	// edit columns
	public function custom_edit_columns($columns) {

		$columns = array(
			'cb' => '<input type="checkbox" />',
			'title' => __( 'Name' ),
			'jobs' => __( 'Job Title', 'wpclubmanager' ),
			'team' => __( 'Team', 'wpclubmanager' )
		);

		return $columns;	
	}

	// custom columns
	public function custom_columns($column) {

		global $post, $typenow;

		$post_id = $post->ID;

		if ( $typenow == 'wpcm_staff' ) {
			switch ($column) {
			case 'jobs':
				the_terms($post_id, 'wpcm_jobs');
				break;
			case 'team':
				the_terms($post_id, 'wpcm_team');
				break;
			}
		}
	}

	// column sorting rules
	public function custom_column_orderby( $vars ) {

		global $pagenow;

		if ( $pagenow == 'edit.php' && $vars['post_type'] == 'wpcm_staff' && isset( $vars['orderby'] )):
			if ( in_array( $vars['orderby'], array( 'jobs' ) ) ):
				$vars = array_merge( $vars, array(
					'meta_key' => 'wpcm_' . $vars['orderby'],
					'orderby' => 'meta_value'
				) );
			endif;
		endif;

		return $vars;
	}

	// taxonomy filter dropdowns
	public function request_filter_dropdowns() {

		global $typenow, $wp_query;
		
		if ( $typenow == 'wpcm_staff' ) {
			// jobs dropdown
			$selected = isset( $_REQUEST['wpcm_jobs'] ) ? $_REQUEST['wpcm_jobs'] : null;
			$args = array(
				'show_option_all' =>  sprintf( __( 'Show all %s', 'wpclubmanager' ), __( 'jobs', 'wpclubmanager' ) ),
				'taxonomy' => 'wpcm_jobs',
				'name' => 'wpcm_jobs',
				'selected' => $selected
			);
			wpcm_dropdown_taxonomies($args);
			echo PHP_EOL;
			// team dropdown
			$selected = isset( $_REQUEST['wpcm_team'] ) ? $_REQUEST['wpcm_team'] : null;
			$args = array(
				'show_option_all' =>  sprintf( __( 'Show all %s', 'wpclubmanager' ), __( 'teams', 'wpclubmanager' ) ),
				'taxonomy' => 'wpcm_team',
				'name' => 'wpcm_team',
				'selected' => $selected
			);
			wpcm_dropdown_taxonomies($args);
			echo PHP_EOL;
		}
	}
}

endif;

return new  WPCM_Admin_CPT_Staff();