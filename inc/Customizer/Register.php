<?php
/**
 * Customizer bootstrap
 *
 * @package NexaWP
 */

namespace NexaWP\Customizer;

defined( 'ABSPATH' ) || exit;

final class Register {

	public static function init(): void {
		add_action( 'customize_register', [ __CLASS__, 'register' ] );
	}

	public static function register( \WP_Customize_Manager $wp_customize ): void {

		// Register main panel(s)
		$wp_customize->add_panel(
			'nexawp_layout_panel',
			[
				'title'       => __( 'Layout', 'nexawp' ),
				'description' => __( 'Global layout settings for NexaWP.', 'nexawp' ),
				'priority'    => 30,
			]
		);

		// Load customizer parts and initialize them immediately so they
		// register settings during this customize_register invocation.
		$parts = [
			'Layout.php',
			'Typography.php',
			'Colors.php',
			'Header.php',
			'Footer.php',
			'Blog.php',
		];

		foreach ( $parts as $part ) {
			$path = __DIR__ . '/' . $part;
			if ( is_readable( $path ) ) {
				require_once $path;
				$class = __NAMESPACE__ . '\\' . pathinfo( $part, PATHINFO_FILENAME );
				if ( class_exists( $class ) && method_exists( $class, 'init' ) ) {
					$class::init( $wp_customize );
				}
			}
		}

		// Site Identity: logo width control
		$wp_customize->add_setting( 'nexawp_logo_width', [
			'default'           => 200,
			'sanitize_callback' => 'absint',
			'transport'         => 'refresh',
		] );

		$wp_customize->add_control( 'nexawp_logo_width', [
			'label'       => __( 'Logo Width (px)', 'nexawp' ),
			'section'     => 'title_tagline',
			'type'        => 'number',
			'input_attrs' => [ 'min' => 40, 'max' => 600, 'step' => 1 ],
		] );
	}
}

Register::init();

