<?php
/**
 * Admin View: Notice - Template Check
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<div id="message" class="updated wpclubmanager-message wpcm-connect">
	<p><?php _e( '<strong>Your theme has bundled outdated copies of WP Club Manager template files.</strong> If you notice an issue on your site, this could be the reason. Please contact your theme developer for further assistance. You can review the System Status report for full details or <a href="https://wpclubmanager.com/docs/" target="_blank">learn more about WP Club Manager Template Structure here</a>.', 'wpclubmanager' ); ?></p>
	<p class="submit"><a class="button-primary" href="<?php echo esc_url( admin_url( 'admin.php?page=wpcm-status' ) ); ?>"><?php _e( 'System Status', 'wpclubmanager' ); ?></a> <a class="skip button-primary" href="<?php echo esc_url( wp_nonce_url( add_query_arg( 'wpcm-hide-notice', 'template_files' ), 'wpclubmanager_hide_notices_nonce', '_wpcm_notice_nonce' ) ); ?>"><?php _e( 'Hide this notice', 'wpclubmanager' ); ?></a></p>
</div>
