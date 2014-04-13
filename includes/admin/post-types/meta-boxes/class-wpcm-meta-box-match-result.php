<?php
/**
 * Match Result
 *
 * Displays the match result box.
 *
 * @author 		ClubPress
 * @category 	Admin
 * @package 	WPClubManager/Admin/Meta Boxes
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class WPCM_Meta_Box_Match_Result {

	/**
	 * Output the metabox
	 */
	public static function output( $post ) {

		wp_nonce_field( 'wpclubmanager_save_data', 'wpclubmanager_meta_nonce' );

		$post_id = $post->ID;

		$played = get_post_meta( $post_id, 'wpcm_played', true );
		
		$friendly = get_post_meta( $post_id, 'wpcm_friendly', true );

		$goals = array_merge( array( 'total' => array( 'home' => 0, 'away' => 0	) ), (array)unserialize( get_post_meta( $post_id, 'wpcm_goals', true ) ) ); ?>

		<p>
			<label class="selectit">
				<input type="checkbox" name="wpcm_played" id="wpcm_played" value="1" <?php checked( true, $played ); ?> />
				<?php _e( 'Result', 'wpclubmanager' ); ?>
			</label>
		</p>
		<table id="results-table">
			<thead>
				<tr>
					<td>&nbsp;</td>
					<th><?php _ex( 'Home', 'team', 'wpclubmanager' ); ?></th>
					<th><?php _ex( 'Away', 'team', 'wpclubmanager' ); ?></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<th align="right"><?php _e( 'Score', 'wpclubmanager' ); ?></th>
					<td><input type="text" name="wpcm_goals[total][home]" id="wpcm_goals_total_home" value="<?php echo (int)$goals['total']['home']; ?>" size="3" /></td>
					<td><input type="text" name="wpcm_goals[total][away]" id="wpcm_goals_total_away" value="<?php echo (int)$goals['total']['away']; ?>" size="3" /></td>
				</tr>
			</tbody>
		</table>
		<p>
			<label class="selectit">
				<input type="checkbox" name="wpcm_friendly" id="wpcm_friendly" value="1" <?php checked( true, $friendly ); ?> />
				<?php _e( 'Friendly', 'wpclubmanager' ); ?>
			</label>
		</p>
	<?php }

	/**
	 * Save meta box data
	 */
	public static function save( $post_id, $post ) {

		if(isset($_POST['wpcm_played'])){
			$played = $_POST['wpcm_played'];
		} else {
			$played = null;
		}
		if(isset($_POST['wpcm_friendly'])){
			$friendly = $_POST['wpcm_friendly'];
		} else {
			$friendly = null;
		}
		
		$goals = $_POST['wpcm_goals'];

		update_post_meta( $post_id, 'wpcm_played', $played );
		update_post_meta( $post_id, 'wpcm_goals', serialize( $goals ) );
		update_post_meta( $post_id, 'wpcm_home_goals', $goals['total']['home'] );
		update_post_meta( $post_id, 'wpcm_away_goals', $goals['total']['away'] );
	}
}