<?php 

global $post;

$postid = get_the_ID();
$sport = get_option( 'wpcm_sport' );
$home_club = get_post_meta( $postid, 'wpcm_home_club', true );
$away_club = get_post_meta( $postid, 'wpcm_away_club', true );
$home_goals = get_post_meta( $postid, 'wpcm_home_goals', true );
$away_goals = get_post_meta( $postid, 'wpcm_away_goals', true );
if( $sport == 'gaelic' ) {
	$home_gaa_goals = get_post_meta( $postid, 'wpcm_home_gaa_goals', true );
	$home_gaa_points = get_post_meta( $postid, 'wpcm_home_gaa_points', true );
	$away_gaa_goals = get_post_meta( $postid, 'wpcm_away_gaa_goals', true );
	$away_gaa_points = get_post_meta( $postid, 'wpcm_away_gaa_points', true );
}
$played = get_post_meta( $postid, 'wpcm_played', true );
$comps = get_the_terms( $postid, 'wpcm_comp' );
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
				echo '<span>' . $comp->name . '</span>';
			endforeach;
			echo '</div>';
		endif;

	echo '</div>';

	echo '<a href="' . get_permalink( $postid ) . '">';
		echo '<div class="clubs">';
			echo '<h4 class="home-clubs">';
				echo '<div class="home-logo">' . get_the_post_thumbnail( $home_club, 'crest-medium', array( 'title' => get_the_title( $home_club ) ) ) . '</div>';
				echo get_the_title( $home_club );
				if( $sport == 'gaelic' ):
					echo '<div class="score">' . ( $played ? $home_gaa_goals . '-' . $home_gaa_points : '' ) . '</div>';
				else:
					echo '<div class="score">' . ( $played ? $home_goals : '' ) . '</div>';
				endif;
			echo '</h4>';
			echo '<h4 class="away-clubs">';
				echo '<div class="away-logo">' . get_the_post_thumbnail( $away_club, 'crest-medium', array( 'title' => get_the_title( $away_club ) ) ) . '</div>';
				echo get_the_title( $away_club );
				if( $sport == 'gaelic' ):
					echo '<div class="score">' . ( $played ? $away_gaa_goals . '-' . $away_gaa_points : '' ) . '</div>';
				else:
					echo '<div class="score">' . ( $played ? $away_goals : '' ) . '</div>';
				endif;
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