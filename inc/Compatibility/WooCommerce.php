<?php
namespace NexaWP\Compatibility;

defined( 'ABSPATH' ) || exit;

final class WooCommerce {

	public static function init(): void {
		add_action( 'after_setup_theme', [ __CLASS__, 'setup' ] );
	}

	public static function setup(): void {
		add_theme_support( 'woocommerce' );
	}
}

WooCommerce::init();
