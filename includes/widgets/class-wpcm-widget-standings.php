<?php
/**
 * Standings Widget
 *
 * @author 		ClubPress
 * @category 	Widgets
 * @package 	WPClubManager/Widgets
 * @version 	1.3.0
 * @extends 	WPCM_Widget
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class WPCM_Standings_Widget extends WPCM_Widget {

	/**
	 * constructor
	 *
	 * @access public
	 * @return void
	 */
	public function __construct() {

		/* Widget variable settings. */
		$this->widget_cssclass 	= 'wpcm-widget widget-standings';
		$this->widget_description 	= __( 'Display your clubs league standings.', 'wpclubmanager' );
		$this->widget_idbase 		= 'wpcm-standings-widget';
		$this->widget_name 		= __( 'WPCM Standings', 'wpclubmanager' );
		$this->settings     			= array(
			'title'  => array(
				'type'  		=> 'text',
				'std'   		=> __( 'Standings', 'wpclubmanager' ),
				'label' 		=> __( 'Title', 'wpclubmanager' )
			),
			'limit' => array(
				'type'  => 'number',
				'step'  => 1,
				'min'   => 1,
				'max'   => '',
				'std'   => 7,
				'label' => __( 'Limit', 'wpclubmanager' )
			),
			'comp' => array(
				'type'  => 'tax_select',
				'taxonomy'   => 'wpcm_comp',
				'std'   => 'All',
				'label' => __( 'Competition', 'wpclubmanager' ),
			),
			'season' => array(
				'type'  => 'tax_select',
				'taxonomy'   => 'wpcm_season',
				'std'   => 'All',
				'label' => __( 'Season', 'wpclubmanager' ),
			),
			'orderby'  => array(
				'type'  => 'text',
				'std'   => __( 'pts', 'wpclubmanager' ),
				'label' => __( 'Orderby', 'wpclubmanager' )
			),
			'order'  => array(
				'type'  => 'text',
				'std'   => __( 'DESC', 'wpclubmanager' ),
				'label' => __( 'Order', 'wpclubmanager' )
			),
			'display_options' => array(
				'type'  => 'section_heading',
				'label' => __( 'Display Options', 'wpclubmanager' ),
				'std'   => '',
			),
			'thumb' => array(
				'type'  => 'checkbox',
				'std'   => 0,
				'label' => __( 'Show club badge', 'wpclubmanager' )
			),
			'linkclub' => array(
				'type'  => 'checkbox',
				'std'   => 0,
				'label' => __( 'Link to club pages', 'wpclubmanager' )
			),
			'stats'  => array(
				'type'  => 'text',
				'std'   => 'p,w,d,l,f,a,gd,pts',
				'label' => __( 'Statistics', 'wpclubmanager' )
			),
			'link_options' => array(
				'type'  => 'section_heading',
				'label' => __( 'Link Options', 'wpclubmanager' ),
				'std'   => '',
			),
			'linktext'  => array(
				'type'  => 'text',
				'std'   => __( 'View all standings', 'wpclubmanager' ),
				'label' => __( 'Link text', 'wpclubmanager' )
			),
			'linkpage' => array(
				'type'  => 'pages_select',
				'label' => __( 'Link page', 'wpclubmanager' ),
				'std'   => 'None',
			),
		);
		parent::__construct();
	}

	/**
	 * widget function.
	 *
	 * @see WP_Widget
	 * @access public
	 * @param array $args
	 * @param array $instance
	 * @return void
	 */
	function widget( $args, $instance ) {

		$this->widget_start( $args, $instance );

		$options_string = '';
		
		foreach( $instance as $key => $value ) {

			$options_string .= ' ' . $key . '="' . $value . '"';
		}

		echo '<div class="clearfix">';

		echo do_shortcode('[wpcm_standings' . $options_string . ' type="widget"]');

		echo '</div>';

		$this->widget_end( $args );
	}
}