<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
} ?>

<div class="wrap wpclubmanager-extensions">
	<h2>
		<?php _e( 'WP Club Manager Extensions', 'wpclubmanager' ); ?>
		<a href="https://wpclubmanager.com/extensions/" class="add-new-h2"><?php _e( 'Browse all extensions', 'wpclubmanager' ); ?></a>
		<a href="https://wpclubmanager.com/themes/" class="add-new-h2"><?php _e( 'Browse themes', 'wpclubmanager' ); ?></a>
	</h2>

	<p><?php _e( 'These add-ons extend the functionality of WP Club Manager.', 'wpclubmanager' ); ?></p>

	<div class="">

		<?php if ( $extensions ) : 

			$extensions = $extensions->featured; ?>

			<ul class="extensions">

				<?php foreach ( $extensions as $extension ) {

					echo '<li class="extension">';
					echo '<a href="' . $extension->link . '">';
					echo '<img src="' . $extension->image . '"/>';
					echo '</a>';
					echo '<h3>' . $extension->title . '</h3>';
					echo '<p>' . $extension->excerpt . '</p>';
					echo '<a href="' . $extension->link . '" class="button right">Find out more</a>';
					echo '</li>';
				
				} ?>

			</ul>

		<?php else : ?>
			<p><?php printf( __( 'Our catalog of WP Club Manager Extensions can be found on wpclubmanager.com here: <a href="%s">WP Club Manager Extensions Catalog</a>', 'wpclubmanager' ), 'https://wpclubmanager.com/extensions/' ); ?></p>
		<?php endif; ?>

	</div>

</div>