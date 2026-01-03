<?php
/**
 * NexaWP Theme bootstrap
 *
 * @package NexaWP
 */

defined( 'ABSPATH' ) || exit;

/*
 * Lightweight PSR-4-ish autoloader for the NexaWP namespace.
 * Maps "NexaWP\\" -> "inc/" so classes like NexaWP\\Frontend\\Header
 * are loaded from inc/Frontend/Header.php on demand.
 */
spl_autoload_register( static function ( string $class ): void {
	$prefix = 'NexaWP\\';
	if ( 0 !== strpos( $class, $prefix ) ) {
		return;
	}

	$relative = substr( $class, strlen( $prefix ) );
	$file     = get_template_directory() . '/inc/' . str_replace( "\\\\", '/', $relative ) . '.php';

	if ( is_readable( $file ) ) {
		/** @noinspection PhpIncludeInspection */
		require_once $file;
	}
} );

require_once get_template_directory() . '/inc/Core/Setup.php';
require_once get_template_directory() . '/inc/Core/Assets.php';
require_once get_template_directory() . '/inc/Core/Helpers.php';

require_once get_template_directory() . '/inc/Customizer/Register.php';

// Theme <-> Pro plugin compatibility loader
require_once get_template_directory() . '/inc/Compatibility/Pro.php';

// Detect NexaWP Pro plugin and notify it (safe, non-fatal).
$pro_present = false;
if ( class_exists( 'NexaWP\\Pro\\Plugin' ) || class_exists( 'Nexawp_Pro' ) ) {
	$pro_present = true;
} elseif ( defined( 'WP_PLUGIN_DIR' ) && is_readable( WP_PLUGIN_DIR . '/nexawp-pro/nexawp-pro.php' ) ) {
	$pro_present = true;
}

if ( $pro_present ) {
	/**
	 * Fired when NexaWP Pro plugin is present. Plugin and child code
	 * can hook into this action to run compatibility adjustments.
	 *
	 * Example in plugin: add_action( 'nexawp_pro_loaded', function() { ... } );
	 */
	do_action( 'nexawp_pro_loaded' );
}

// Ensure core frontend classes are available immediately (avoid autoloader edge-cases).
// Loading these explicitly prevents "class not found" errors when templates are included.
require_once get_template_directory() . '/inc/Frontend/Header.php';
require_once get_template_directory() . '/inc/Frontend/Footer.php';
require_once get_template_directory() . '/inc/Frontend/Layout.php';
