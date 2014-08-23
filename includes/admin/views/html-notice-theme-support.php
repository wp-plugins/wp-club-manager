<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>
<div id="message" class="error wpclubmanager-message">
	<p><?php _e( '<strong>Your theme does not declare WP Club Manager support</strong> &#8211; if you encounter layout issues please read our integration guide or choose a <a href="https://wpclubmanager.com/themes/">WP Club Manager theme</a> :)', 'wpclubmanager' ); ?></p>
	<p class="submit">
		<a class="button-primary" href="https://wpclubmanager.com/docs/themeing/"><?php _e( 'Theme Integration Guide', 'wpclubmanager' ); ?></a>
		<a class="button-secondary" href="<?php echo add_query_arg( 'hide_wpclubmanager_theme_support_check', 'true' ); ?>"><?php _e( 'Hide this notice', 'wpclubmanager' ); ?></a>
	</p>
</div>