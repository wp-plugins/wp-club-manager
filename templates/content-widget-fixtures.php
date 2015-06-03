<?php
/**
 * Fixtures Widget
 *
 * @author 		Clubpress
 * @package 	WPClubManager/Templates
 * @version     1.2.17
 */

global $post;

$postid = get_the_ID();

$home_club = get_post_meta( $postid, 'wpcm_home_club', true );
$away_club = get_post_meta( $postid, 'wpcm_away_club', true );
$comps = get_the_terms( $postid, 'wpcm_comp' );
$comp_status = get_post_meta( $postid, 'wpcm_comp_status', true );
$seasons = get_the_terms( $postid, 'wpcm_season' );
$teams = get_the_terms( $postid, 'wpcm_team' );
			
echo '<li class="fixture">';

	echo '<div class="fixture-meta">';

		if ( $show_team && is_array( $teams ) ):
			echo '<div class="team">';
			foreach ( $teams as $team ):
				echo '<span>' . $team->name . '</span>';
			endforeach;
			echo '</div>';
		endif;
		if ( $show_comp && is_array( $comps ) ):
			echo '<div class="competition">';
			foreach ( $comps as $comp ):
				echo '<span>' . $comp->name . '&nbsp;' . $comp_status . '</span>';
			endforeach;
			echo '</div>';
		endif;

	echo '</div>';

	echo '<a href="' . get_post_permalink( $postid, false, true ) . '">';

		echo '<div class="clubs">';
			echo '<h4 class="home-clubs">';
				echo '<div class="home-logo">' . get_the_post_thumbnail( $home_club, 'crest-medium', array( 'title' => get_the_title( $home_club ) ) ) . '</div>';
				echo get_the_title( $home_club );
			echo '</h4>';
			echo '<h4 class="away-clubs">';
				echo '<div class="away-logo">' . get_the_post_thumbnail( $away_club, 'crest-medium', array( 'title' => get_the_title( $away_club ) ) ) . '</div>';
				echo get_the_title( $away_club );
			echo '</h4>';
		echo '</div>';
	echo '</a>';

	echo '<div class="wpcm-date">';
		echo '<div class="kickoff">';
			if ( $show_date ) {
				echo the_time('j M Y');
			}
			if ( $show_time ) {
				echo ' - ';
				echo the_time('g:i a');
			}
		echo '</div>';			
	echo '</div>';

echo '</li>';