<?php
/**
 * Helper functions
 *
 * @package NexaWP
 */

namespace NexaWP\Core;

defined( 'ABSPATH' ) || exit;

final class Helpers {

	public static function esc_attr( string $value ): string {
		return esc_attr( $value );
	}

	public static function esc_html( string $value ): string {
		return esc_html( $value );
	}

	public static function get_css_var( string $var, string $fallback = '' ): string {
		return sprintf( 'var(--%s, %s)', esc_attr( $var ), esc_attr( $fallback ) );
	}
}
