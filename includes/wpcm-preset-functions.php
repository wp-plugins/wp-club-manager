<?php
/**
 * Preset Functions
 *
 * @author 		ClubPress
 * @category 	Core
 * @package 	WPClubManager/Functions
 * @version     1.3.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Sports presets
 *
 * Get an array of sport options and settings.
 * @return array
 */
function wpcm_get_sport_presets() {
	return apply_filters( 'wpcm_sports', array(
		'baseball' => array(
			'name' => __( 'Baseball', 'wpclubmanager' ),
			'terms' => array(
				// Positions
				'wpcm_position' => array(
					array(
						'name' => '',
						'slug' => '',
					),
				),
			),
			'stats_labels' => array(
				'ab' => '<a title="' . __('At Bats', 'wpclubmanager'). '">' . __('AB', 'wpclubmanager') . '</a>',
				'h' => '<a title="' . __('Hits', 'wpclubmanager'). '">' . __('H', 'wpclubmanager') . '</a>',
				'r' => '<a title="' . __('Runs', 'wpclubmanager'). '">' . __('R', 'wpclubmanager') . '</a>',
				'er' => '<a title="' . __('Earned Runs', 'wpclubmanager'). '">' . __('ER', 'wpclubmanager') . '</a>',
				'hr' => '<a title="' . __('Home Runs', 'wpclubmanager'). '">' . __('HR', 'wpclubmanager') . '</a>',
				'2b' => '<a title="' . __('Doubles', 'wpclubmanager'). '">' . __('2B', 'wpclubmanager') . '</a>',
				'3b' => '<a title="' . __('Triples', 'wpclubmanager'). '">' . __('3B', 'wpclubmanager') . '</a>',
				'rbi' => '<a title="' . __('Runs Batted In', 'wpclubmanager'). '">' . __('RBI', 'wpclubmanager') . '</a>',
				'bb' => '<a title="' . __('Bases on Bulk', 'wpclubmanager'). '">' . __('BB', 'wpclubmanager') . '</a>',
				'so' => '<a title="' . __('Strike Outs', 'wpclubmanager'). '">' . __('SO', 'wpclubmanager') . '</a>',
				'sb' => '<a title="' . __('Stolen Bases', 'wpclubmanager'). '">' . __('SB', 'wpclubmanager') . '</a>',
				'cs' => '<a title="' . __('Caught Stealing', 'wpclubmanager'). '">' . __('CS', 'wpclubmanager') . '</a>',
				'tc' => '<a title="' . __('Total Chances', 'wpclubmanager'). '">' . __('TC', 'wpclubmanager') . '</a>',
				'po' => '<a title="' . __('Putouts', 'wpclubmanager'). '">' . __('PO', 'wpclubmanager') . '</a>',
				'a' => '<a title="' . __('Assists', 'wpclubmanager'). '">' . __('A', 'wpclubmanager') . '</a>',
				'e' => '<a title="' . __('Errors', 'wpclubmanager'). '">' . __('E', 'wpclubmanager') . '</a>',
				'dp' => '<a title="' . __('Double Plays', 'wpclubmanager'). '">' . __('DP', 'wpclubmanager') . '</a>',
				'rating' => '<a title="' . __('Rating', 'wpclubmanager'). '">' . __('RAT', 'wpclubmanager'),
				'mvp' => '<a title="' . __('Player of Match', 'wpclubmanager'). '">' . __('POM', 'wpclubmanager') . '</a>',
			),
		),
		'basketball' => array(
			'name' => __( 'Basketball', 'wpclubmanager' ),
			'terms' => array(
				// Positions
				'wpcm_position' => array(
					array(
						'name' => 'Point Guard',
						'slug' => 'pointguard',
					),
					array(
						'name' => 'Shooting Guard',
						'slug' => 'shootingguard',
					),
					array(
						'name' => 'Small Forward',
						'slug' => 'smallforward',
					),
					array(
						'name' => 'Power Forward',
						'slug' => 'powerforward',
					),
					array(
						'name' => 'Center',
						'slug' => 'center',
					),
				),
			),
			'stats_labels' => array(
				'min' => '<a title="' . __('Minutes', 'wpclubmanager'). '">' . __('MIN', 'wpclubmanager') . '</a>',
				'fgm' => '<a title="' . __('Field Goals Made', 'wpclubmanager'). '">' . __('FGM', 'wpclubmanager') . '</a>',
				'fga' => '<a title="' . __('Field Goals Attempted', 'wpclubmanager'). '">' . __('FGA', 'wpclubmanager') . '</a>',
				'3pm' => '<a title="' . __('3 Points Made', 'wpclubmanager'). '">' . __('3PM', 'wpclubmanager') . '</a>',
				'3pa' => '<a title="' . __('3 Ponits Attempted', 'wpclubmanager'). '">' . __('3PA', 'wpclubmanager') . '</a>',
				'ftm' => '<a title="' . __('Free Throws Made', 'wpclubmanager'). '">' . __('FTM', 'wpclubmanager') . '</a>',
				'fta' => '<a title="' . __('Free Throws Attempted', 'wpclubmanager'). '">' . __('FTA', 'wpclubmanager') . '</a>',
				'or' => '<a title="' . __('Offensive Rebounds', 'wpclubmanager'). '">' . __('OR', 'wpclubmanager') . '</a>',
				'dr' => '<a title="' . __('Defensive Rebounds', 'wpclubmanager'). '">' . __('DR', 'wpclubmanager') . '</a>',
				'reb' => '<a title="' . __('Rebounds', 'wpclubmanager'). '">' . __('REB', 'wpclubmanager') . '</a>',
				'ast' => '<a title="' . __('Assists', 'wpclubmanager'). '">' . __('AST', 'wpclubmanager') . '</a>',
				'blk' => '<a title="' . __('Blocks', 'wpclubmanager'). '">' . __('BLK', 'wpclubmanager') . '</a>',
				'stl' => '<a title="' . __('Steals', 'wpclubmanager'). '">' . __('STL', 'wpclubmanager') . '</a>',
				'pf' => '<a title="' . __('Personal Fouls', 'wpclubmanager'). '">' . __('PF', 'wpclubmanager') . '</a>',
				'to' => '<a title="' . __('Turnovers', 'wpclubmanager'). '">' . __('TO', 'wpclubmanager') . '</a>',
				'pts' => '<a title="' . __('Points', 'wpclubmanager'). '">' . __('PTS', 'wpclubmanager') . '</a>',
				'rating' => '<a title="' . __('Rating', 'wpclubmanager'). '">' . __('RAT', 'wpclubmanager'),
				'mvp' => '<a title="' . __('Player of Match', 'wpclubmanager'). '">' . __('POM', 'wpclubmanager') . '</a>',
			),
		),
		'floorball' => array(
			'name' => __( 'Floorball', 'wpclubmanager' ),
			'terms' => array(
				// Positions
				'wpcm_position' => array(
					array(
						'name' => 'Goalkeeper',
						'slug' => 'goalkeeper',
					),
					array(
						'name' => 'Defender',
						'slug' => 'defender',
					),
					array(
						'name' => 'Forward',
						'slug' => 'forward',
					),
				),
			),
			'stats_labels' => array(
				'g' => '<a title="' . __('Goals', 'wpclubmanager'). '">' . __('G', 'wpclubmanager') . '</a>',
				'a' => '<a title="' . __('Assists', 'wpclubmanager'). '">' . __('A', 'wpclubmanager') . '</a>',
				'plusminus' => '<a title="' . __('Plus/Minus Rating', 'wpclubmanager'). '">' . __('+/-', 'wpclubmanager') . '</a>',
				'sog' => '<a title="' . __('Shots on Goal', 'wpclubmanager'). '">' . __('SOG', 'wpclubmanager') . '</a>',
				'pim' => '<a title="' . __('Penalty Minutes', 'wpclubmanager'). '">' . __('PIM', 'wpclubmanager') . '</a>',
				'redcards' => '<a title="' . __('Red Cards', 'wpclubmanager'). '">' . __('RC', 'wpclubmanager') . '</a>',
				'sav' => '<a title="' . __('Saves', 'wpclubmanager'). '">' . __('SAV', 'wpclubmanager') . '</a>',
				'ga' => '<a title="' . __('Goals Against', 'wpclubmanager'). '">' . __('GA', 'wpclubmanager') . '</a>',
				'rating' => '<a title="' . __('Rating', 'wpclubmanager'). '">' . __('RAT', 'wpclubmanager'),
				'mvp' => '<a title="' . __('Player of Match', 'wpclubmanager'). '">' . __('POM', 'wpclubmanager') . '</a>',
			),
		),
		'football' => array(
			'name' => __( 'American Football', 'wpclubmanager' ),
			'terms' => array(
				// Positions
				'wpcm_position' => array(
					array(
						'name' => 'Quarterback',
						'slug' => 'quarterback',
					),
					array(
						'name' => 'Running Back',
						'slug' => 'runningback',
					),
					array(
						'name' => 'Wide Receiver',
						'slug' => 'widereceiver',
					),
					array(
						'name' => 'Tight End',
						'slug' => 'tightend',
					),
					array(
						'name' => 'Defensive Lineman',
						'slug' => 'defensivelineman',
					),
					array(
						'name' => 'Linebacker',
						'slug' => 'linebacker',
					),
					array(
						'name' => 'Defensive Back',
						'slug' => 'defensiveback',
					),
					array(
						'name' => 'Kickoff Kicker',
						'slug' => 'kickoffkicker',
					),
					array(
						'name' => 'Kick Returner',
						'slug' => 'kickreturner',
					),
					array(
						'name' => 'Punter',
						'slug' => 'punter',
					),
					array(
						'name' => 'Punt Returner',
						'slug' => 'puntreturner',
					),
					array(
						'name' => 'Field Goal Kicker',
						'slug' => 'fieldgoalkicker',
					),
				),
			),
			'stats_labels' => array(
				'pa_cmp' => '<a title="' . __('Pass Completions', 'wpclubmanager'). '">' . __('CMP', 'wpclubmanager') . '</a>',
				'pa_yds' => '<a title="' . __('Passing Yards', 'wpclubmanager'). '">' . __('YDS', 'wpclubmanager') . '</a>',
				'sc_pass' => '<a title="' . __('Passing Touchdowns', 'wpclubmanager'). '">' . __('PASS', 'wpclubmanager') . '</a>',
				'pa_int' => '<a title="' . __('Passing Interceptions', 'wpclubmanager'). '">' . __('INT', 'wpclubmanager') . '</a>',
				'ru_yds' => '<a title="' . __('Rushing Yards', 'wpclubmanager'). '">' . __('YDS', 'wpclubmanager') . '</a>',
				'sc_rush' => '<a title="' . __('Rushing Touchdowns', 'wpclubmanager'). '">' . __('RUSH', 'wpclubmanager') . '</a>',
				're_rec' => '<a title="' . __('Receptions', 'wpclubmanager'). '">' . __('REC', 'wpclubmanager') . '</a>',
				're_yds' => '<a title="' . __('Receiving Yards', 'wpclubmanager'). '">' . __('YDS', 'wpclubmanager') . '</a>',
				'sc_rec' => '<a title="' . __('Receiving Touchdowns', 'wpclubmanager'). '">' . __('REC', 'wpclubmanager') . '</a>',
				'de_total' => '<a title="' . __('Total Tackles', 'wpclubmanager'). '">' . __('TOTAL', 'wpclubmanager') . '</a>',
				'de_sack' => '<a title="' . __('Sacks', 'wpclubmanager'). '">' . __('SACK', 'wpclubmanager') . '</a>',
				'de_ff' => '<a title="' . __('Fumbles', 'wpclubmanager'). '">' . __('FF', 'wpclubmanager') . '</a>',
				'de_int' => '<a title="' . __('Interceptions', 'wpclubmanager'). '">' . __('INT', 'wpclubmanager') . '</a>',
				'de_kb' => '<a title="' . __('Blocked Kicks', 'wpclubmanager'). '">' . __('KB', 'wpclubmanager') . '</a>',
				'sc_td' => '<a title="' . __('Touchdowns', 'wpclubmanager'). '">' . __('TD', 'wpclubmanager') . '</a>',
				'sc_2pt' => '<a title="' . __('2 Point Conversions', 'wpclubmanager'). '">' . __('2PT', 'wpclubmanager') . '</a>',
				'sc_fg' => '<a title="' . __('Field Goals', 'wpclubmanager'). '">' . __('FG', 'wpclubmanager') . '</a>',
				'sc_pat' => '<a title="' . __('Extra Points', 'wpclubmanager'). '">' . __('PAT', 'wpclubmanager') . '</a>',
				'sc_pts' => '<a title="' . __('Total Points', 'wpclubmanager'). '">' . __('PTS', 'wpclubmanager') . '</a>',
				'rating' => '<a title="' . __('Rating', 'wpclubmanager'). '">' . __('RAT', 'wpclubmanager'),
				'mvp' => '<a title="' . __('Player of Match', 'wpclubmanager'). '">' . __('POM', 'wpclubmanager') . '</a>',
			),
		),
		'footy' => array(
			'name' => __( 'Australian Rules Football', 'wpclubmanager' ),
			'terms' => array(
				// Positions
				'wpcm_position' => array(
					array(
						'name' => 'Full Back',
						'slug' => 'full-back',
					),
					array(
						'name' => 'Back Pocket',
						'slug' => 'back-pocket',
					),
					array(
						'name' => 'Centre Half-Back',
						'slug' => 'centre-half-back',
					),
					array(
						'name' => 'Half-Back Flank',
						'slug' => 'half-back-flank',
					),
					array(
						'name' => 'Centre Half-Forward',
						'slug' => 'centre-half-forward',
					),
					array(
						'name' => 'Half-Forward Flank',
						'slug' => 'half-forward-flank',
					),
					array(
						'name' => 'Full Forward',
						'slug' => 'full-forward',
					),
					array(
						'name' => 'Forward Pocket',
						'slug' => 'forward-pocket',
					),
					array(
						'name' => 'Follower',
						'slug' => 'follower',
					),
					array(
						'name' => 'Inside Midfield',
						'slug' => 'inside-midfield',
					),
					array(
						'name' => 'Outside Midfield',
						'slug' => 'outside-midfield',
					),
				),
			),
			'stats_labels' => array(
				'k' => '<a title="' . __('Kicks', 'wpclubmanager'). '">' . __('K', 'wpclubmanager') . '</a>',
				'hb' => '<a title="' . __('Handballs', 'wpclubmanager'). '">' . __('HB', 'wpclubmanager') . '</a>',
				'd' => '<a title="' . __('Disposals', 'wpclubmanager'). '">' . __('D', 'wpclubmanager') . '</a>',
				'cp' => '<a title="' . __('Contested Possesion', 'wpclubmanager'). '">' . __('CP', 'wpclubmanager') . '</a>',
				'm' => '<a title="' . __('Marks', 'wpclubmanager'). '">' . __('M', 'wpclubmanager') . '</a>',
				'cm' => '<a title="' . __('Contested Marks', 'wpclubmanager'). '">' . __('CM', 'wpclubmanager') . '</a>',
				'ff' => '<a title="' . __('Frees For', 'wpclubmanager'). '">' . __('FF', 'wpclubmanager') . '</a>',
				'fa' => '<a title="' . __('Frees Against', 'wpclubmanager'). '">' . __('FA', 'wpclubmanager') . '</a>',
				'clg' => '<a title="' . __('Clangers', 'wpclubmanager'). '">' . __('C', 'wpclubmanager') . '</a>',
				'tkl' => '<a title="' . __('Tackles', 'wpclubmanager'). '">' . __('T', 'wpclubmanager') . '</a>',
				'i50' => '<a title="' . __('Inside 50s', 'wpclubmanager'). '">' . __('I50', 'wpclubmanager') . '</a>',
				'r50' => '<a title="' . __('Rebound 50s', 'wpclubmanager'). '">' . __('R50', 'wpclubmanager') . '</a>',
				'1pct' => '<a title="' . __('One-Percenters', 'wpclubmanager'). '">' . __('1PCT', 'wpclubmanager') . '</a>',
				'ho' => '<a title="' . __('Hit-Outs', 'wpclubmanager'). '">' . __('HO', 'wpclubmanager') . '</a>',
				'g' => '<a title="' . __('Goals', 'wpclubmanager'). '">' . __('G', 'wpclubmanager') . '</a>',
				'b' => '<a title="' . __('Behinds', 'wpclubmanager'). '">' . __('B', 'wpclubmanager') . '</a>',
				'yellowpcmards' => '<a title="' . __('Yellow Cards', 'wpclubmanager'). '">' . __('YC', 'wpclubmanager') . '</a>',
				'redcards' => '<a title="' . __('Red Cards', 'wpclubmanager'). '">' . __('RC', 'wpclubmanager') . '</a>',
				'rating' => '<a title="' . __('Rating', 'wpclubmanager'). '">' . __('RAT', 'wpclubmanager'),
				'mvp' => '<a title="' . __('Player of Match', 'wpclubmanager'). '">' . __('POM', 'wpclubmanager') . '</a>',
			),
		),
		'gaelic' => array(
			'name' => __( 'Gaelic Football / Hurling', 'wpclubmanager' ),
			'terms' => array(
				// Positions
				'wpcm_position' => array(
					array(
						'name' => 'Goalkeeper',
						'slug' => 'goalkeeper',
					),
					array(
						'name' => 'Defender',
						'slug' => 'defender',
					),
					array(
						'name' => 'Midfielder',
						'slug' => 'midfielder',
					),
					array(
						'name' => 'Forward',
						'slug' => 'forward',
					),
				),
			),
			'stats_labels' => array(
				'g' => '<a title="' . __('Goals', 'wpclubmanager'). '">' . __('G', 'wpclubmanager') . '</a>',
				'pts' => '<a title="' . __('Points', 'wpclubmanager'). '">' . __('P', 'wpclubmanager') . '</a>',
				'gff' => '<a title="' . __('Goals from Frees', 'wpclubmanager'). '">' . __('GFF', 'wpclubmanager') . '</a>',
				'sog' => '<a title="' . __('Points from Frees', 'wpclubmanager'). '">' . __('PFF', 'wpclubmanager') . '</a>',
				'yellowcards' => '<a title="' . __('Yellow Cards', 'wpclubmanager'). '">' . __('YC', 'wpclubmanager') . '</a>',
				'blackcards' => '<a title="' . __('Black Cards', 'wpclubmanager'). '">' . __('BC', 'wpclubmanager') . '</a>',
				'redcards' => '<a title="' . __('Red Cards', 'wpclubmanager'). '">' . __('RC', 'wpclubmanager') . '</a>',
				'rating' => '<a title="' . __('Rating', 'wpclubmanager'). '">' . __('RAT', 'wpclubmanager'),
				'mvp' => '<a title="' . __('Player of Match', 'wpclubmanager'). '">' . __('POM', 'wpclubmanager') . '</a>',
			),
		),
		'handball' => array(
			'name' => __( 'Handball', 'wpclubmanager' ),
			'terms' => array(
				// Positions
				'wpcm_position' => array(
					array(
						'name' => 'Goalkeeper',
						'slug' => 'goalkeeper',
					),
					array(
						'name' => 'Left Wing',
						'slug' => 'left-wing',
					),
					array(
						'name' => 'Left Back',
						'slug' => 'left-back',
					),
					array(
						'name' => 'Center',
						'slug' => 'center',
					),
					array(
						'name' => 'Right Wing',
						'slug' => 'right-wing',
					),
					array(
						'name' => 'Right Back',
						'slug' => 'right-back',
					),
					array(
						'name' => 'Pivot',
						'slug' => 'pivot',
					),
				),
			),
			'stats_labels' => array(
				'goals' => '<a title="' . __('Goals', 'wpclubmanager'). '">' . __('GLS', 'wpclubmanager') . '</a>',
				'2min' => '<a title="' . __('2 Minute Suspension', 'wpclubmanager'). '">' . __('2MIN', 'wpclubmanager') . '</a>',
				'yellowcards' => '<a title="' . __('Yellow Cards', 'wpclubmanager'). '">' . __('YC', 'wpclubmanager') . '</a>',
				'redcards' => '<a title="' . __('Red Cards', 'wpclubmanager'). '">' . __('RC', 'wpclubmanager') . '</a>',
				'rating' => '<a title="' . __('Rating', 'wpclubmanager'). '">' . __('RAT', 'wpclubmanager'),
				'mvp' => '<a title="' . __('Player of Match', 'wpclubmanager'). '">' . __('POM', 'wpclubmanager') . '</a>',
			),
		),
		'hockey_field' => array(
			'name' => __( 'Field Hockey', 'wpclubmanager' ),
			'terms' => array(
				// Positions
				'wpcm_position' => array(
					array(
						'name' => 'Goalie',
						'slug' => 'goalie',
					),
					array(
						'name' => 'Defence',
						'slug' => 'defence',
					),
					array(
						'name' => 'Midfield',
						'slug' => 'midfield',
					),
					array(
						'name' => 'Forward',
						'slug' => 'forward',
					),
				),
			),
			'stats_labels' => array(
				'gls' => '<a title="' . __('Goals', 'wpclubmanager'). '">' . __('G', 'wpclubmanager') . '</a>',
				'ass' => '<a title="' . __('Assists', 'wpclubmanager'). '">' . __('A', 'wpclubmanager') . '</a>',
				'sho' => '<a title="' . __('Shots', 'wpclubmanager'). '">' . __('SH', 'wpclubmanager') . '</a>',
				'sog' => '<a title="' . __('Shots on Goal', 'wpclubmanager'). '">' . __('SOG', 'wpclubmanager') . '</a>',
				'sav' => '<a title="' . __('Saves', 'wpclubmanager'). '">' . __('SAV', 'wpclubmanager') . '</a>',
				'greencards' => '<a title="' . __('Green Cards', 'wpclubmanager'). '">' . __('GC', 'wpclubmanager') . '</a>',
				'yellowcards' => '<a title="' . __('Yellow Cards', 'wpclubmanager'). '">' . __('YC', 'wpclubmanager') . '</a>',
				'redcards' => '<a title="' . __('Red Cards', 'wpclubmanager'). '">' . __('RC', 'wpclubmanager') . '</a>',
				'rating' => '<a title="' . __('Rating', 'wpclubmanager'). '">' . __('RAT', 'wpclubmanager'),
				'mvp' => '<a title="' . __('Player of Match', 'wpclubmanager'). '">' . __('POM', 'wpclubmanager') . '</a>',
			),
		),
		'hockey' => array(
			'name' => __( 'Ice Hockey', 'wpclubmanager' ),
			'terms' => array(
				// Positions
				'wpcm_position' => array(
					array(
						'name' => 'Goalie',
						'slug' => 'goalie',
					),
					array(
						'name' => 'Defense',
						'slug' => 'defense',
					),
					array(
						'name' => 'Center',
						'slug' => 'center',
					),
					array(
						'name' => 'Right Wing',
						'slug' => 'right-wing',
					),
					array(
						'name' => 'Left Wing',
						'slug' => 'left-wing',
					),
				),
			),
			'stats_labels' => array(
				'g' => '<a title="' . __('Goals', 'wpclubmanager'). '">' . __('G', 'wpclubmanager') . '</a>',
				'a' => '<a title="' . __('Assists', 'wpclubmanager'). '">' . __('A', 'wpclubmanager') . '</a>',
				'plusminus' => '<a title="' . __('Plus/Minus Rating', 'wpclubmanager'). '">' . __('+/-', 'wpclubmanager') . '</a>',
				'sog' => '<a title="' . __('Shots on Goal', 'wpclubmanager'). '">' . __('SOG', 'wpclubmanager') . '</a>',
				'ms' => '<a title="' . __('Missed Shots', 'wpclubmanager'). '">' . __('MS', 'wpclubmanager') . '</a>',
				'bs' => '<a title="' . __('Blocked Shots', 'wpclubmanager'). '">' . __('BS', 'wpclubmanager') . '</a>',
				'pim' => '<a title="' . __('Penalty Minutes', 'wpclubmanager'). '">' . __('PIM', 'wpclubmanager') . '</a>',
				'ht' => '<a title="' . __('Hits', 'wpclubmanager'). '">' . __('HT', 'wpclubmanager') . '</a>',
				'fw' => '<a title="' . __('Faceoffs Won', 'wpclubmanager'). '">' . __('FW', 'wpclubmanager') . '</a>',
				'fl' => '<a title="' . __('Faceoffs Lost', 'wpclubmanager'). '">' . __('FL', 'wpclubmanager') . '</a>',
				'sav' => '<a title="' . __('Saves', 'wpclubmanager'). '">' . __('SAV', 'wpclubmanager') . '</a>',
				'rating' => '<a title="' . __('Rating', 'wpclubmanager'). '">' . __('RAT', 'wpclubmanager'),
				'mvp' => '<a title="' . __('Player of Match', 'wpclubmanager'). '">' . __('POM', 'wpclubmanager') . '</a>',
			),
		),
		'netball' => array(
			'name' => __( 'Netball', 'wpclubmanager' ),
			'terms' => array(
				// Positions
				'wpcm_position' => array(
					array(
						'name' => 'Goal Shooter',
						'slug' => 'goal-shooter',
					),
					array(
						'name' => 'Goal Attack',
						'slug' => 'goal-attack',
					),
					array(
						'name' => 'Wing Attack',
						'slug' => 'wing-attack',
					),
					array(
						'name' => 'Centre',
						'slug' => 'centre',
					),
					array(
						'name' => 'Wing Defence',
						'slug' => 'wing-defence',
					),
					array(
						'name' => 'Goal Defence',
						'slug' => 'goal-defence',
					),
					array(
						'name' => 'Goal Keeper',
						'slug' => 'goal-keeper',
					),
				),
			),
			'stats_labels' => array(
				'g' => '<a title="' . __('Goals', 'wpclubmanager'). '">' . __('GLS', 'wpclubmanager') . '</a>',
				'gatt' => '<a title="' . __('Goal Attempts', 'wpclubmanager'). '">' . __('ATT', 'wpclubmanager') . '</a>',
				'gass' => '<a title="' . __('Goal Assists', 'wpclubmanager'). '">' . __('AST', 'wpclubmanager') . '</a>',
				'rbs' => '<a title="' . __('Rebounds', 'wpclubmanager'). '">' . __('REB', 'wpclubmanager') . '</a>',
				'cpr' => '<a title="' . __('Centre Pass Receives', 'wpclubmanager'). '">' . __('CPR', 'wpclubmanager') . '</a>',
				'int' => '<a title="' . __('Interceptions', 'wpclubmanager'). '">' . __('INT', 'wpclubmanager') . '</a>',
				'def' => '<a title="' . __('Deflections', 'wpclubmanager'). '">' . __('DEF', 'wpclubmanager') . '</a>',
				'pen' => '<a title="' . __('Penaties', 'wpclubmanager'). '">' . __('PEN', 'wpclubmanager') . '</a>',
				'to' => '<a title="' . __('Turnovers', 'wpclubmanager'). '">' . __('TO', 'wpclubmanager') . '</a>',
				'rating' => '<a title="' . __('Rating', 'wpclubmanager'). '">' . __('RAT', 'wpclubmanager'),
				'mvp' => '<a title="' . __('Player of Match', 'wpclubmanager'). '">' . __('POM', 'wpclubmanager') . '</a>',
			),
		),
		'rugby' => array(
			'name' => __( 'Rugby', 'wpclubmanager' ),
			'terms' => array(
				// Positions
				'wpcm_position' => array(
					array(
						'name' => 'Scrum Half',
						'slug' => 'scrum-half',
					),
					array(
						'name' => 'Fly Half',
						'slug' => 'fly-half',
					),
					array(
						'name' => 'Centre',
						'slug' => 'centre',
					),
					array(
						'name' => 'Winger',
						'slug' => 'winger',
					),
					array(
						'name' => 'Full Back',
						'slug' => 'full-back',
					),
					array(
						'name' => 'Prop',
						'slug' => 'prop',
					),
					array(
						'name' => 'Hooker',
						'slug' => 'hooker',
					),
					array(
						'name' => 'Lock',
						'slug' => 'lock',
					),
					array(
						'name' => 'Flanker',
						'slug' => 'flanker',
					),
					array(
						'name' => 'No. 8',
						'slug' => 'no-8',
					),
				),
			),
			'stats_labels' => array(
				't' => '<a title="' . __('Tries', 'wpclubmanager'). '">' . __('TRI', 'wpclubmanager') . '</a>',
				'c' => '<a title="' . __('Conversions', 'wpclubmanager'). '">' . __('CON', 'wpclubmanager') . '</a>',
				'p' => '<a title="' . __('Penalties', 'wpclubmanager'). '">' . __('PEN', 'wpclubmanager') . '</a>',
				'dg' => '<a title="' . __('Drop Goals', 'wpclubmanager'). '">' . __('DG', 'wpclubmanager') . '</a>',
				'yellowcards' => '<a title="' . __('Yellow Cards', 'wpclubmanager'). '">' . __('YC', 'wpclubmanager') . '</a>',
				'redcards' => '<a title="' . __('Red Cards', 'wpclubmanager'). '">' . __('RC', 'wpclubmanager') . '</a>',
				'rating' => '<a title="' . __('Rating', 'wpclubmanager'). '">' . __('RAT', 'wpclubmanager') . '</a>',
				'mvp' => '<a title="' . __('Player of Match', 'wpclubmanager'). '">' . __('POM', 'wpclubmanager') . '</a>',
			),
		),
		'soccer' => array(
			'name' => __( 'Football (Soccer)', 'wpclubmanager' ),
			'terms' => array(
				// Positions
				'wpcm_position' => array(
					array(
						'name' => 'Goalkeeper',
						'slug' => 'goalkeeper',
					),
					array(
						'name' => 'Defender',
						'slug' => 'defender',
					),
					array(
						'name' => 'Midfielder',
						'slug' => 'midfielder',
					),
					array(
						'name' => 'Forward',
						'slug' => 'forward',
					),
				),
			),
			'stats_labels' => array(
				'goals' => '<a title="' . __('Goals', 'wpclubmanager'). '">' . __('GLS', 'wpclubmanager') . '</a>',
				'assists' => '<a title="' . __('Assists', 'wpclubmanager'). '">' . __('AST', 'wpclubmanager') . '</a>',
				'penalties' => '<a title="' . __('Penalty Goals', 'wpclubmanager'). '">' . __('PENS', 'wpclubmanager') . '</a>',
				'og' => '<a title="' . __('Own Goals', 'wpclubmanager'). '">' . __('OG', 'wpclubmanager') . '</a>',
				'cs' => '<a title="' . __('Clean Sheets', 'wpclubmanager'). '">' . __('CS', 'wpclubmanager') . '</a>',
				'yellowcards' => '<a title="' . __('Yellow Cards', 'wpclubmanager'). '">' . __('YC', 'wpclubmanager') . '</a>',
				'redcards' => '<a title="' . __('Red Cards', 'wpclubmanager'). '">' . __('RC', 'wpclubmanager') . '</a>',
				'rating' => '<a title="' . __('Rating', 'wpclubmanager'). '">' . __('RAT', 'wpclubmanager'),
				'mvp' => '<a title="' . __('Player of Match', 'wpclubmanager'). '">' . __('POM', 'wpclubmanager') . '</a>',
			),
		),
		'volleyball' => array(
			'name' => __( 'Volleyball', 'wpclubmanager' ),
			'terms' => array(
				// Positions
				'wpcm_position' => array(
					array(
						'name' => 'Outside Hitter',
						'slug' => 'outside-hitter',
					),
					array(
						'name' => 'Middle Blocker',
						'slug' => 'middle-blocker',
					),
					array(
						'name' => 'Setter',
						'slug' => 'setter',
					),
					array(
						'name' => 'Opposite',
						'slug' => 'opposite',
					),
					array(
						'name' => 'Defensive Specialist',
						'slug' => 'defensive-specialist',
					),
					array(
						'name' => 'Libero',
						'slug' => 'libero',
					),
				),
			),
			'stats_labels' => array(
				'ace' => '<a title="' . __('Aces', 'wpclubmanager'). '">' . __('ACE', 'wpclubmanager') . '</a>',
				'kill' => '<a title="' . __('Kills', 'wpclubmanager'). '">' . __('KILL', 'wpclubmanager') . '</a>',
				'blk' => '<a title="' . __('Blocks', 'wpclubmanager'). '">' . __('BLK', 'wpclubmanager') . '</a>',
				'bass' => '<a title="' . __('Block Assists', 'wpclubmanager'). '">' . __('BA', 'wpclubmanager') . '</a>',
				'sass' => '<a title="' . __('Setting Assists', 'wpclubmanager'). '">' . __('SA', 'wpclubmanager') . '</a>',
				'dig' => '<a title="' . __('Digs', 'wpclubmanager'). '">' . __('DIG', 'wpclubmanager') . '</a>',
				'rating' => '<a title="' . __('Rating', 'wpclubmanager'). '">' . __('RAT', 'wpclubmanager'),
				'mvp' => '<a title="' . __('Player of Match', 'wpclubmanager'). '">' . __('POM', 'wpclubmanager') . '</a>',
			),
		),
	));
}

function wpcm_get_sport_options() {
	$sports = wpcm_get_sport_presets();
	$options = array();
	foreach ( $sports as $slug => $data ):
		$options[ $slug ] = $data['name'];
	endforeach;
	return $options;
}

function wpcm_get_sports_stats_labels() {
	$sport = get_option('wpcm_sport');

	$data = wpcm_get_sport_presets();

	$wpcm_player_stats_labels = $data[$sport]['stats_labels'];

	return $wpcm_player_stats_labels;
}