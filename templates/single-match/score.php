<?php
/**
 * Single Player Bio
 *
 * @author 		ClubPress
 * @package 	WPClubManager/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $wpclubmanager, $post;

$sport = get_option( 'wpcm_sport' );
$home_goals = get_post_meta( $post->ID, 'wpcm_home_goals', true );
$away_goals = get_post_meta( $post->ID, 'wpcm_away_goals', true );
$played = get_post_meta( $post->ID, 'wpcm_played', true );
$gaa_goals_home = get_post_meta( $post->ID, 'wpcm_home_gaa_goals', true );
$gaa_points_home = get_post_meta( $post->ID, 'wpcm_home_gaa_points', true );
$gaa_goals_away = get_post_meta( $post->ID, 'wpcm_away_gaa_goals', true );
$gaa_points_away = get_post_meta( $post->ID, 'wpcm_away_gaa_points', true ); ?>

<div class="wpcm-match-score">

	<?php if ( $played ) {

		if ( $sport == 'gaelic' ) {
			echo $gaa_goals_home;
			echo '-';
			echo $gaa_points_home;
		} else {
			echo $home_goals;
		}

	} ?>

	<span class="wpcm-match-score-delimiter"><?php echo get_option( 'wpcm_match_goals_delimiter' ); ?></span>

	<?php if ( $played ) {

		if ( $sport == 'gaelic' ) {
			echo $gaa_goals_away;
			echo '-';
			echo $gaa_points_away;
		} else {
			echo $away_goals;
		}

	} ?>

</div>