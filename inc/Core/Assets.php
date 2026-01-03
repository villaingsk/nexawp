<?php
/**
 * Assets loader
 *
 * @package NexaWP
 */

namespace NexaWP\Core;

defined( 'ABSPATH' ) || exit;

final class Assets {

	public static function init(): void {
		add_action( 'wp_enqueue_scripts', [ __CLASS__, 'enqueue_frontend' ] );
		add_action( 'enqueue_block_editor_assets', [ __CLASS__, 'enqueue_editor' ] );
	}

	public static function enqueue_frontend(): void {
		$theme_version = wp_get_theme()->get( 'Version' );

		// Base styles
		wp_enqueue_style(
			'nexawp-base',
			get_template_directory_uri() . '/assets/css/base.css',
			[],
			$theme_version
		);

		wp_enqueue_style(
			'nexawp-layout',
			get_template_directory_uri() . '/assets/css/layout.css',
			[ 'nexawp-base' ],
			$theme_version
		);

		wp_enqueue_style(
			'nexawp-typography',
			get_template_directory_uri() . '/assets/css/typography.css',
			[ 'nexawp-base' ],
			$theme_version
		);

		wp_enqueue_style(
			'nexawp-blocks',
			get_template_directory_uri() . '/assets/css/blocks.css',
			[ 'nexawp-base' ],
			$theme_version
		);

		// Customizer CSS variables (SINGLE inline style)
		wp_add_inline_style(
			'nexawp-base',
			self::get_customizer_css()
		);

		// Navigation JS
		wp_enqueue_script(
			'nexawp-navigation',
			get_template_directory_uri() . '/assets/js/navigation.js',
			[],
			$theme_version,
			true
		);

		// Back to top script (lightweight, no jQuery)
		wp_enqueue_script(
			'nexawp-back-to-top',
			get_template_directory_uri() . '/assets/js/back-to-top.js',
			[],
			$theme_version,
			true
		);
	}

	public static function enqueue_editor(): void {
		$theme_version = wp_get_theme()->get( 'Version' );

		wp_enqueue_style(
			'nexawp-editor',
			get_template_directory_uri() . '/assets/css/blocks.css',
			[],
			$theme_version
		);

		// Editor script for page sidebar setting (block editor sidebar panel)
		wp_enqueue_script(
			'nexawp-editor-settings',
			get_template_directory_uri() . '/assets/js/editor-page-sidebar.js',
			[ 'wp-plugins', 'wp-edit-post', 'wp-element', 'wp-data', 'wp-components' ],
			$theme_version,
			true
		);
	}

	/**
	 * Generate CSS variables from Customizer
	 */
	private static function get_customizer_css(): string {
	$vars = [];

	// Container
	$vars[] = sprintf(
		'--nexawp-container-width:%dpx',
		absint( get_theme_mod( 'nexawp_container_width', 1200 ) )
	);

	$vars[] = sprintf(
		'--nexawp-container-padding:%dpx',
		absint( get_theme_mod( 'nexawp_container_padding', 24 ) )
	);

	// Typography
	$vars[] = sprintf(
		'--nexawp-font-body:%s',
		esc_attr(
			get_theme_mod(
				'nexawp_body_font_family',
				'system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif'
			)
		)
	);

	$vars[] = sprintf(
		'--nexawp-font-size-base:%dpx',
		absint( get_theme_mod( 'nexawp_body_font_size', 16 ) )
	);

	// Colors
	$vars[] = sprintf(
		'--nexawp-color-text:%s',
		esc_attr( get_theme_mod( 'nexawp_color_text', '#222222' ) )
	);

	$vars[] = sprintf(
		'--nexawp-color-bg:%s',
		esc_attr( get_theme_mod( 'nexawp_color_background', '#ffffff' ) )
	);

	$vars[] = sprintf(
		'--nexawp-color-link:%s',
		esc_attr( get_theme_mod( 'nexawp_color_link', '#0066cc' ) )
	);

	$vars[] = sprintf(
		'--nexawp-color-link-hover:%s',
		esc_attr( get_theme_mod( 'nexawp_color_link_hover', '#004999' ) )
	);

	// Logo
	$vars[] = sprintf(
		'--nexawp-logo-width:%dpx',
		absint( get_theme_mod( 'nexawp_logo_width', 200 ) )
	);

	// Header primary
	$vars[] = sprintf(
		'--nexawp-header-primary-bg:%s',
		esc_attr( get_theme_mod( 'nexawp_header_primary_bg', '#ffffff' ) )
	);

	$vars[] = sprintf(
		'--nexawp-header-primary-border-color:%s',
		esc_attr( get_theme_mod( 'nexawp_header_primary_border_color', '#e6e6e6' ) )
	);

	$vars[] = sprintf(
		'--nexawp-header-primary-border-width:%dpx',
		absint( get_theme_mod( 'nexawp_header_primary_border_width', 1 ) )
	);

	$vars[] = sprintf(
		'--nexawp-header-primary-padding-inline:%dpx',
		absint( get_theme_mod( 'nexawp_header_primary_padding_inline', 24 ) )
	);

	// Above header
	$vars[] = sprintf(
		'--nexawp-header-above-bg:%s',
		esc_attr( get_theme_mod( 'nexawp_header_above_bg', '#ffffff' ) )
	);

	$vars[] = sprintf(
		'--nexawp-header-above-border-color:%s',
		esc_attr( get_theme_mod( 'nexawp_header_above_border_color', '#e6e6e6' ) )
	);

	$vars[] = sprintf(
		'--nexawp-header-above-border-width:%dpx',
		absint( get_theme_mod( 'nexawp_header_above_border_width', 1 ) )
	);

	$vars[] = sprintf(
		'--nexawp-header-above-padding-inline:%dpx',
		absint( get_theme_mod( 'nexawp_header_above_padding_inline', 24 ) )
	);

	// Below header
	$vars[] = sprintf(
		'--nexawp-header-below-bg:%s',
		esc_attr( get_theme_mod( 'nexawp_header_below_bg', '#ffffff' ) )
	);

	$vars[] = sprintf(
		'--nexawp-header-below-border-color:%s',
		esc_attr( get_theme_mod( 'nexawp_header_below_border_color', '#e6e6e6' ) )
	);

	$vars[] = sprintf(
		'--nexawp-header-below-border-width:%dpx',
		absint( get_theme_mod( 'nexawp_header_below_border_width', 1 ) )
	);

	$vars[] = sprintf(
		'--nexawp-header-below-padding-inline:%dpx',
		absint( get_theme_mod( 'nexawp_header_below_padding_inline', 24 ) )
	);

	// Footer
	$vars[] = sprintf(
		'--nexawp-footer-bg:%s',
		esc_attr( get_theme_mod( 'nexawp_footer_bg', '#ffffff' ) )
	);

	$vars[] = sprintf(
		'--nexawp-footer-border-color:%s',
		esc_attr( get_theme_mod( 'nexawp_footer_border_color', '#e6e6e6' ) )
	);

	$vars[] = sprintf(
		'--nexawp-footer-border-width:%dpx',
		absint( get_theme_mod( 'nexawp_footer_border_width', 1 ) )
	);

	// 🔑 EXTENSION POINT FOR PRO MODULES (Spacing, Backgrounds, dll)
	$vars = apply_filters( 'nexawp_customizer_css_vars', $vars );

		return ':root{' . implode( ';', $vars ) . '}';
		}

	}

	Assets::init();
