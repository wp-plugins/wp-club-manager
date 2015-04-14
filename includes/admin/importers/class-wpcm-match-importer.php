<?php
/**
 * Club importer - import matches into WP Club Manager.
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
	class WPCM_Match_Importer extends WPCM_Importer {

		/**
		 * __construct function.
		 */
		public function __construct() {
			$this->import_page = 'wpclubmanager_match_csv';
			$this->import_label = __( 'Import Matches', 'wpclubmanager' );
			$this->columns = array(
				'post_date' => __( 'Date', 'wpclubmanager' ),
				'post_time' => __( 'Kickoff', 'wpclubmanager' ),
				'wpcm_home_club' => __( 'Home Club', 'wpclubmanager' ),
				'wpcm_away_club' => __( 'Away Club', 'wpclubmanager' ),
				'wpcm_result' => __( 'Result', 'wpclubmanager' ),
				//'wpcm_home_goals' => __( 'Home Score', 'wpclubmanager' ),
				//'wpcm_away_goals' => __( 'Away Score', 'wpclubmanager' ),
				'wpcm_comp' => __( 'Competition', 'wpclubmanager' ),
				'wpcm_season' => __( 'Season', 'wpclubmanager' ),
				'wpcm_team' => __( 'Team', 'wpclubmanager' ),
				'wpcm_venue' => __( 'Venue', 'wpclubmanager' ),
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

			$date_format = 'yyyy/mm/dd';
			
			foreach ( $rows as $row ):

				$row = array_filter( $row );

				if ( empty( $row ) ) continue;

				$meta = array();

				foreach ( $columns as $index => $key ):
					$meta[ $key ] = wpcm_array_value( $row, $index );
				endforeach;
				
				$home_club = wpcm_array_value( $meta, 'wpcm_home_club' );
				$away_club = wpcm_array_value( $meta, 'wpcm_away_club' );

				$home_object = get_page_by_title( $home_club, OBJECT, 'wpcm_club' );
				if ( $home_object ):
					$home_id = $home_object->ID;
				else:
					$home_id = wp_insert_post( array( 'post_type' => 'wpcm_club', 'post_status' => 'publish', 'post_title' => $home_club ) );

					update_post_meta( $home_id, '_wpcm_import', 1 );
				endif;

				$away_object = get_page_by_title( $away_club, OBJECT, 'wpcm_club' );
				if ( $away_object ):
					$away_id = $away_object->ID;
				else:
					$away_id = wp_insert_post( array( 'post_type' => 'wpcm_club', 'post_status' => 'publish', 'post_title' => $away_club ) );

					update_post_meta( $away_id, '_wpcm_import', 1 );
				endif;

				// Format date
				$date = wpcm_array_value( $meta, 'post_date' );
				$time = wpcm_array_value( $meta, 'post_time' );
				$date = str_replace( '/', '-', trim( $date ) );
				$date_array = explode( '-', $date );
				$date = substr( str_pad( wpcm_array_value( $date_array, 0, '0000' ), 4, '0', STR_PAD_LEFT ), 0, 4 ) . '-' .
						substr( str_pad( wpcm_array_value( $date_array, 1, '00' ), 2, '0', STR_PAD_LEFT ), 0, 2 ) . '-' .
						substr( str_pad( wpcm_array_value( $date_array, 2, '00' ), 2, '0', STR_PAD_LEFT ), 0, 2 );

				$date .= ' ' . trim( $time );

				$args = array( 'post_type' => 'wpcm_match', 'post_status' => 'publish', 'post_date' => $date );

				$id = wp_insert_post( $args );

				// Flag as import
				update_post_meta( $id, '_wpcm_import', 1 );

				// // Update date of birth
				update_post_meta( $id, 'wpcm_home_club', $home_id );

				// // Update date of birth
				update_post_meta( $id, 'wpcm_away_club', $away_id );

				$result = wpcm_array_value( $meta, 'wpcm_result' );
				if( $result ) :
					$scores = explode( '-', wpcm_array_value( $meta, 'wpcm_result' ) );
					$home_goals = trim($scores[0]);
					$away_goals = trim($scores[1]);
					$goals = array( 'total' => array( 'home' => $home_goals, 'away' => $away_goals) );

					var_dump($goals);

					if( $home_goals >= '0' ):
						update_post_meta( $id, 'wpcm_home_goals', $home_goals );
					endif;

					if( $away_goals >= '0' ):
						update_post_meta( $id, 'wpcm_away_goals', $away_goals );
					endif;

					if( $home_goals >= '0' && $away_goals >= '0' ) :
						update_post_meta( $id, 'wpcm_goals', serialize( $goals ) );
						update_post_meta( $id, 'wpcm_played', 1 );
					endif;

				endif;

				// Update competitions
				$comps = wpcm_array_value( $meta, 'wpcm_comp' );
				wp_set_object_terms( $id, $comps, 'wpcm_comp', false );

				// Update seasons
				$seasons = wpcm_array_value( $meta, 'wpcm_season' );
				wp_set_object_terms( $id, $seasons, 'wpcm_season', false );

				// Update teams
				$teams = wpcm_array_value( $meta, 'wpcm_team' );
				wp_set_object_terms( $id, $teams, 'wpcm_team', false );
				if( $teams ) :
					$team_terms = explode( ',', $teams );
					foreach ( $team_terms as $team_term ) :
						$term = get_term_by( 'name', $team_term, 'wpcm_team' );
						$team_term_array[] = $term->term_id;
					endforeach;
					$team_ids = implode( ',', $team_term_array );
				endif;
				update_post_meta( $id, 'wpcm_team', $team_ids );

				// Update competitions
				$venues = wpcm_array_value( $meta, 'wpcm_venue' );
				wp_set_object_terms( $id, $venues, 'wpcm_venue', false );

				$this->imported++;

			endforeach;

			// Show Result
			echo '<div class="updated settings-error below-h2"><p>
				'.sprintf( __( 'Import complete - imported <strong>%s</strong> matches and skipped <strong>%s</strong>.', 'wpclubmanager' ), $this->imported, $this->skipped ).'
			</p></div>';

			$this->import_end();
		}

		/**
		 * Performs post-import cleanup of files and the cache
		 */
		public function import_end() {
			echo '<p>' . __( 'All done!', 'wpclubmanager' ) . ' <a href="' . admin_url('edit.php?post_type=wpcm_match') . '">' . __( 'View Matches', 'wpclubmanager' ) . '</a></p>';

			do_action( 'import_end' );
		}

		/**
		 * header function.
		 */
		public function header() {
			echo '<h2>' . __( 'Import Matches', 'wpclubmanager' ) . '</h2>';	
		}

		/**
		 * greet function.
		 */
		public function greet() {
			echo '<div class="narrow">';
			echo '<p>' . __( 'Choose a .csv file to upload, then click "Upload file and import".', 'wpclubmanager' ).'</p>';
			echo '<p>' . sprintf( __( 'Matches need to be defined with columns in a specific order (9 columns). <a href="%s">Click here to download a sample</a>.', 'wpclubmanager' ), plugin_dir_url( WPCM_PLUGIN_FILE ) . 'dummy-data/match-sample.csv' ) . '</p>';
			wp_import_upload_form( 'admin.php?import=wpclubmanager_match_csv&step=1' );
			echo '</div>';
		}
	}
}