<?php
/**
 * Theme <-> Pro compatibility helper
 *
 * Provides a safe action hook and helper for detecting the Pro plugin.
 *
 * @package NexaWP
 */

namespace NexaWP\Compatibility;

defined( 'ABSPATH' ) || exit;

final class Pro {

    public static function init(): void {
        // Register a listener point for the pro plugin. Plugin can hook into
        // this action: add_action( 'nexawp_pro_loaded', [ PluginClass::class, 'setup_theme_integration' ] );
        // No action here: we only provide helpers and a simple flag when action fires.
    }

    public static function register(): void {
        if ( ! defined( 'NEXAWP_PRO_ACTIVE' ) ) {
            define( 'NEXAWP_PRO_ACTIVE', true );
        }
    }

    public static function is_active(): bool {
        return defined( 'NEXAWP_PRO_ACTIVE' ) && NEXAWP_PRO_ACTIVE === true;
    }
}

// Hook into the action so when theme fires 'nexawp_pro_loaded' we set a constant.
add_action( 'nexawp_pro_loaded', [ Pro::class, 'register' ] );

// Allow manual check via NexaWP\Compatibility\Pro::is_active();
