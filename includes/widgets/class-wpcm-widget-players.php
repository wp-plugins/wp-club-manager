<?php
/**
 * Players Widget
 *
 * @author 		ClubPress
 * @category 	Widgets
 * @package 	WPClubManager/Widgets
 * @version 	1.3.3
 * @extends 	WP_Widget
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class WPCM_Players_Widget extends WPCM_Widget {	

	/**
	 * constructor
	 *
	 * @access public
	 * @return void
	 */
	public function __construct() {

		/* Widget variable settings. */
		$this->widget_cssclass = 'wpcm-widget widget-players';
		$this->widget_description = __( 'Display a table of players details.', 'wpclubmanager' );
		$this->widget_idbase = 'wpcm-players-widget';
		$this->widget_name = __( 'WPCM Players', 'wpclubmanager' );
		$this->settings           = array();

		/* Widget settings. */
		$widget_ops = array( 'classname' => $this->widget_cssclass, 'description' => $this->widget_description );

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

		extract( $args );

		$title  = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );	
		$options_string = '';
		
		foreach( $instance as $key => $value ) {
			
			if ( $value != -1 )
				$options_string .= ' ' . $key . '="' . $value . '"';
		}

		echo $before_widget;

		if ( $title )
			echo $before_title . $title . $after_title;

		echo '<div class="clearfix">';

		echo do_shortcode('[wpcm_players' . $options_string . ']');

		echo '</div>';

		echo $after_widget;
	}

	/**
	 * update function.
	 *
	 * @see WP_Widget->update
	 * @access public
	 * @param array $new_instance
	 * @param array $old_instance
	 * @return array
	 */
	function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;
		
		foreach( $new_instance as $key => $value ) {
			
			if ( is_array( $value ) )
				$value = implode(',', $value);
			
			$instance[$key] = strip_tags( $value );
		}
			
		return $instance;
	}
		
	/**
	 * form function.
	 *
	 * @see WP_Widget->form
	 * @access public
	 * @param array $instance
	 * @return void
	 */
	function form( $instance ) {
		
		$defaults = array(
			'limit' => 10,
			'season' => null,
			'team' => null,
			'position' => null,
			'orderby' => 'number',
			'order' => 'ASC',
			'linktext' => __( 'View all players', 'wpclubmanager' ),
			'linkpage' => null,
			'stats' => 'flag,number,name,position,age',
			'title' => __( 'Players', 'wpclubmanager' )
		);

		$sport = get_option('wpcm_sport');

		$data = wpcm_get_sport_presets();
		$wpcm_player_stats_labels = $data[$sport]['stats_labels'];

		$player_stats_labels = array_merge( array( 'appearances' => __( 'Appearances', 'wpclubmanager' ), 'subs' => __( 'Sub Appearances', 'wpclubmanager' ) ), $wpcm_player_stats_labels );
		$stats_labels = array_merge(
			array(
				'thumb' => __( 'Image', 'wpclubmanager' ),
				'flag' => __( 'Flag', 'wpclubmanager' ),
				'number' => __( 'Number', 'wpclubmanager' ),
				'name' => __( 'Name', 'wpclubmanager' ),
				'position' => __( 'Position', 'wpclubmanager' ),
				'age' => __( 'Age', 'wpclubmanager' ),
				'height' => __( 'Height', 'wpclubmanager' ),
				'weight' => __( 'Weight', 'wpclubmanager' ),
				'team' => __( 'Team', 'wpclubmanager' ),
				'season' => __( 'Season', 'wpclubmanager' ),
				'dob' => __( 'Date of Birth', 'wpclubmanager' ),
				'hometown' => __( 'Hometown', 'wpclubmanager' ),
				'joined' => __( 'Joined', 'wpclubmanager' )
			),
			$player_stats_labels
		);

		$instance = wp_parse_args( (array) $instance, $defaults );
		$stats = explode( ',', $instance['stats'] );
		?>
		
		<?php $field = 'title'; ?>
		<p>
			<label for="<?php echo $this->get_field_id( $field ); ?>"><?php _e('Title', 'wpclubmanager') ?>:</label>
			<input class="widefat" id="<?php echo $this->get_field_id( $field ); ?>" name="<?php echo $this->get_field_name( $field ); ?>" value="<?php echo $instance[$field]; ?>" type="text" />
		</p>
		
		<?php $field = 'limit'; ?>
		<p>
			<label for="<?php echo $this->get_field_id( $field ); ?>"><?php _e('Limit', 'wpclubmanager') ?>:</label>
			<input id="<?php echo $this->get_field_id( $field ); ?>" name="<?php echo $this->get_field_name( $field ); ?>" value="<?php echo $instance[$field]; ?>" type="number" size="3" />
		</p>
		
		<?php $field = 'season'; ?>
		<p>
			<label for="<?php echo $this->get_field_id( $field ); ?>"><?php _e('Season', 'wpclubmanager') ?>:</label>
			<?php
			wp_dropdown_categories(array(
				'show_option_none' => __( 'All' ),
				'hide_empty' => 0,
				'orderby' => 'title',
				'taxonomy' => 'wpcm_season',
				'selected' => $instance[$field],
				'name' => $this->get_field_name( $field ),
				'id' => $this->get_field_id( $field )
			));
			?>
		</p>
		
		<?php $field = 'team'; ?>
		<p>
			<label for="<?php echo $this->get_field_id( $field ); ?>"><?php _e('Team', 'wpclubmanager') ?>:</label>
			<?php
			wp_dropdown_categories(array(
				'show_option_none' => __( 'All' ),
				'hide_empty' => 0,
				'orderby' => 'title',
				'taxonomy' => 'wpcm_team',
				'selected' => $instance[$field],
				'name' => $this->get_field_name( $field ),
				'id' => $this->get_field_id( $field )
			));
			?>
		</p>
		
		<?php $field = 'position'; ?>
		<p>
			<label for="<?php echo $this->get_field_id( $field ); ?>"><?php _e('Position', 'wpclubmanager') ?>:</label>
			<?php
			wp_dropdown_categories(array(
				'show_option_none' => __( 'All' ),
				'hide_empty' => 0,
				'orderby' => 'title',
				'taxonomy' => 'wpcm_position',
				'selected' => $instance[$field],
				'name' => $this->get_field_name( $field ),
				'id' => $this->get_field_id( $field )
			));
			?>
		</p>
				
		<?php $field = 'orderby'; ?>
		<p>
			<label for="<?php echo $this->get_field_id( $field ); ?>"><?php _e('Order by', 'wpclubmanager') ?>:</label>
			<select id="<?php echo $this->get_field_id( $field ); ?>" name="<?php echo $this->get_field_name( $field ); ?>">
				<option id="number" value="number"<?php if ( $instance[$field] == 'number' ) echo ' selected'; ?>><?php _e( 'Number', 'wpclubmanager' ); ?></option>
				<option id="menu_order" value="menu_order"<?php if ( $instance[$field] == 'menu_order' ) echo ' selected'; ?>><?php _e( 'Page order' ); ?></option>
				<?php foreach ( $player_stats_labels as $key => $val ) { ?>

					<option id="<?php echo $key; ?>" value="<?php echo $key; ?>"<?php if ( $instance[$field] == $key ) echo ' selected'; ?>><?php echo $val; ?></option>

				<?php } ?>
			</select>
		</p>
			
		<?php $field = 'order'; ?>
		<p>
			<label for="<?php echo $this->get_field_id( $field ); ?>"><?php _e('Order', 'wpclubmanager') ?>:</label>
			<?php
			$wpcm_order_options = array(
				'ASC' => __( 'Lowest to highest', 'wpclubmanager' ),
				'DESC' => __( 'Highest to lowest', 'wpclubmanager' )
			);
			?>
			<select id="<?php echo $this->get_field_id( $field ); ?>" name="<?php echo $this->get_field_name( $field ); ?>">
				<?php foreach ( $wpcm_order_options as $key => $val ) { ?>

					<option id="<?php echo $key; ?>" value="<?php echo $key; ?>"<?php if ( $instance[$field] == $key ) echo ' selected'; ?>><?php echo $val; ?></option>

				<?php } ?>
			</select>
		</p>
			
		<?php $field = 'stats'; ?>
		<p>
			<label><?php _e( 'Statistics', 'wpclubmanager' ); ?></label>
			<table>
				<tr>
					<?php $count = 0;
					foreach ( $stats_labels as $key => $value ) {
						
						$count++;
						if ( $count > 2 ) {
							$count = 1;
							echo '</tr><tr>';
						}
					?>
					<td>
						<label class="selectit" for="<?php echo $this->get_field_id( $field ); ?>-<?php echo $key; ?>">
							<input type="checkbox" id="<?php echo $this->get_field_id( $field ); ?>-<?php echo $key; ?>" name="<?php echo $this->get_field_name( $field ); ?>[]" value="<?php echo $key; ?>" <?php checked( in_array( $key, $stats ) ); ?> />
							<?php echo $value; ?>
						</label>
					</td>
				<?php } ?>
				</tr>
			</table>
		</p>
			
		<?php $field = 'linktext'; ?>
		<p>
			<label for="<?php echo $this->get_field_id( $field ); ?>"><?php _e('Link text', 'wpclubmanager') ?>:</label>
			<input class="widefat" id="<?php echo $this->get_field_id( $field ); ?>" name="<?php echo $this->get_field_name( $field ); ?>" value="<?php echo $instance[$field]; ?>" type="text" />
		</p>
			
		<?php $field = 'linkpage'; ?>
		<p>
			<label for="<?php echo $this->get_field_id( $field ); ?>"><?php _e('Link page', 'wpclubmanager') ?>:</label>
			<?php
			wp_dropdown_pages( array(
				'show_option_none' => __( 'None' ),
				'selected' => $instance[$field],
				'name' => $this->get_field_name( $field ),
				'id' => $this->get_field_id( $field )
			) );
			?>
		</p>

	<?php
	}
}