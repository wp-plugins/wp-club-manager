<?php
/**
 * Staff importer - import staff into WP Club Manager.
 *
 * @author      ClubPress
 * @category    Admin
 * @package     WPClubManager/Admin/Importers
 * @version     1.2.11
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( class_exists( 'WP_Importer' ) ) {
	class WPCM_Staff_Importer extends WPCM_Importer {

		/**
		 * __construct function.
		 */
		public function __construct() {
			$this->import_page = 'wpclubmanager_staff_csv';
			$this->import_label = __( 'Import Staff', 'wpclubmanager' );
			$this->columns = array(
				'post_title' => __( 'Name', 'wpclubmanager' ),
				'wpcm_jobs' => __( 'Jobs', 'wpclubmanager' ),
				'wpcm_team' => __( 'Teams', 'wpclubmanager' ),
				'wpcm_season' => __( 'Seasons', 'wpclubmanager' ),
				'wpcm_dob' => __( 'Date of Birth', 'wpclubmanager' ),
				'wpcm_natl' => __( 'Nationality', 'wpclubmanager' ),
				'wpcm_email' => __( 'Email', 'wpclubmanager' ),
				'wpcm_phone' => __( 'Phone', 'wpclubmanager' ),
			);
		}

		/**
		 * import function.
		 *
		 * @param mixed $file
		 */
		function import( $array = array(), $columns = array( 'post_title' ) ) {
			$this->imported = $this->skipped = 0;

			if ( ! is_array( $array ) || ! sizeof( $array ) ):
				$this->footer();
				die();
			endif;

			$rows = array_chunk( $array, sizeof( $columns ) );

			foreach ( $rows as $row ):

				$row = array_filter( $row );

				if ( empty( $row ) ) continue;

				$meta = array();

				foreach ( $columns as $index => $key ):
					$meta[ $key ] = wpcm_array_value( $row, $index );
				endforeach;

				$name = wpcm_array_value( $meta, 'post_title' );

				if ( ! $name ):
					$this->skipped++;
					continue;
				endif;

				$args = array( 'post_type' => 'wpcm_staff', 'post_status' => 'publish', 'post_title' => $name );

				$id = wp_insert_post( $args );

				// Flag as import
				update_post_meta( $id, '_wpcm_import', 1 );

				// Update positions
				$jobs = explode( '|', wpcm_array_value( $meta, 'wpcm_jobs' ) );
				wp_set_object_terms( $id, $jobs, 'wpcm_jobs', false );

				// Update teams
				$teams = explode( '|', wpcm_array_value( $meta, 'wpcm_team' ) );
				wp_set_object_terms( $id, $teams, 'wpcm_team', false );

				// Update seasons
				$seasons = explode( '|', wpcm_array_value( $meta, 'wpcm_season' ) );
				wp_set_object_terms( $id, $seasons, 'wpcm_season', false );

				// Update date of birth
				update_post_meta( $id, 'wpcm_dob', wpcm_array_value( $meta, 'wpcm_dob' ) );

				// Update nationality
				$natl = trim( strtolower( wpcm_array_value( $meta, 'wpcm_natl' ) ) );
				if ( $natl == '*' ) $natl = '';
				update_post_meta( $id, 'wpcm_natl', $natl );

				// Update email
				update_post_meta( $id, '_wpcm_staff_email', wpcm_array_value( $meta, 'wpcm_email' ) );

				// Update phone
				update_post_meta( $id, '_wpcm_staff_phone', wpcm_array_value( $meta, 'wpcm_phone' ) );

				$this->imported++;

			endforeach;

			// Show Result
			echo '<div class="updated settings-error below-h2"><p>
				'.sprintf( __( 'Import complete - imported <strong>%s</strong> staff and skipped <strong>%s</strong>.', 'wpclubmanager' ), $this->imported, $this->skipped ).'
			</p></div>';

			$this->import_end();
		}

		/**
		 * Performs post-import cleanup of files and the cache
		 */
		public function import_end() {
			echo '<p>' . __( 'All done!', 'wpclubmanager' ) . ' <a href="' . admin_url('edit.php?post_type=wpcm_staff') . '">' . __( 'View Staff', 'wpclubmanager' ) . '</a></p>';

			do_action( 'import_end' );
		}

		/**
		 * header function.
		 */
		public function header() {
			echo '<h2>' . __( 'Import Staff', 'wpclubmanager' ) . '</h2>';	
		}

		/**
		 * greet function.
		 */
		public function greet() {
			echo '<div class="narrow">';
			echo '<p>' . __( 'Choose a .csv file to upload, then click "Upload file and import".', 'wpclubmanager' ).'</p>';
			echo '<p>' . sprintf( __( 'Staff need to be defined with columns in a specific order (8 columns). <a href="%s">Click here to download a sample</a>.', 'wpclubmanager' ), plugin_dir_url( WPCM_PLUGIN_FILE ) . 'dummy-data/staff-sample.csv' ) . '</p>';
			wp_import_upload_form( 'admin.php?import=wpclubmanager_staff_csv&step=1' );
			echo '</div>';
		}
	}
}