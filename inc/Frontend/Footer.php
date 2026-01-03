<?php
/**
 * Footer rendering
 *
 * @package NexaWP
 */

namespace NexaWP\Frontend;

defined( 'ABSPATH' ) || exit;

final class Footer {

	public static function render(): void {

		// Allow plugin Pro (Disable Elements, dll)
		if ( ! apply_filters( 'nexawp_show_footer', true ) ) {
			return;
		}

		$enable_widgets = (bool) get_theme_mod( 'nexawp_footer_widgets_enable', 1 );
		$columns        = absint( get_theme_mod( 'nexawp_footer_widgets_columns', 4 ) );

		?>
		<footer class="nexawp-footer" role="contentinfo">
			<?php if ( $enable_widgets ) : ?>
				<div class="nexawp-footer-widgets nexawp-footer-columns-<?php echo esc_attr( $columns ); ?>" role="region" aria-label="<?php esc_attr_e( 'Footer widgets', 'nexawp' ); ?>">
					<div class="nexawp-container">
						<?php
						for ( $i = 1; $i <= $columns; $i++ ) {
							$sidebar_id = 'nexawp-footer-' . $i;
							if ( is_active_sidebar( $sidebar_id ) ) {
								?>
								<div class="nexawp-footer-widget" role="region" aria-label="<?php echo esc_attr( sprintf( __( 'Footer %d', 'nexawp' ), $i ) ); ?>">
									<?php dynamic_sidebar( $sidebar_id ); ?>
								</div>
								<?php
							} else {
								// Empty placeholder for consistent columns
								?><div class="nexawp-footer-widget empty" aria-hidden="true"></div><?php
							}
						}
						?>
					</div>
				</div>
			<?php endif; ?>

			<div class="nexawp-container nexawp-footer-inner">
				<?php self::footer_menu(); ?>
				<?php self::site_info(); ?>
			</div>

			<?php if ( get_theme_mod( 'nexawp_back_to_top', 1 ) ) : ?>
				<button class="nexawp-back-to-top" aria-label="<?php esc_attr_e( 'Back to top', 'nexawp' ); ?>">↑</button>
			<?php endif; ?>
		</footer>
		<?php
	}

	private static function footer_menu(): void {
		if ( ! has_nav_menu( 'footer' ) ) {
			return;
		}

		wp_nav_menu(
			[
				'theme_location' => 'footer',
				'menu_class'     => 'nexawp-footer-menu',
				'container'      => false,
				'depth'          => 1,
			]
		);
	}

	private static function site_info(): void {
		?>
		<div class="nexawp-site-info">
			<?php
			printf(
				/* translators: %s: site name */
				esc_html__( '© %s. All rights reserved.', 'nexawp' ),
				esc_html( get_bloginfo( 'name' ) )
			);
			?>
		</div>
		<?php
	}
}
