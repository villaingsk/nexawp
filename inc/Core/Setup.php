<?php
/**
 * Theme setup
 *
 * @package NexaWP
 */

namespace NexaWP\Core;

defined( 'ABSPATH' ) || exit;

final class Setup {

	public static function init(): void {
		add_action( 'after_setup_theme', [ __CLASS__, 'theme_support' ] );
		add_action( 'after_setup_theme', [ __CLASS__, 'register_menus' ] );
		add_action( 'widgets_init', [ __CLASS__, 'register_sidebars' ] );
		add_action( 'init', [ __CLASS__, 'register_post_meta' ] );
	}

	public static function theme_support(): void {
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );

		// Site identity/logo
		add_theme_support( 'custom-logo', [
			'height'      => 80,
			'width'       => 300,
			'flex-height' => true,
			'flex-width'  => true,
		] );

		// Allow header & background controls in Customizer
		add_theme_support( 'custom-header', [
			'default-image' => '',
			'width'         => 1200,
			'height'        => 280,
			'flex-width'    => true,
			'flex-height'   => true,
		] );

		add_theme_support( 'custom-background' );
		add_theme_support( 'html5', [
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		] );

		add_theme_support( 'editor-styles' );
		add_theme_support( 'align-wide' );
		add_theme_support( 'responsive-embeds' );

		// Improve Customizer experience for widgets
		add_theme_support( 'customize-selective-refresh-widgets' );

		// WooCommerce compatibility
		add_theme_support( 'woocommerce' );
	}

	/**
	 * Register post meta used by block editor (page sidebar layout).
	 */
	public static function register_post_meta(): void {
		register_post_meta( 'page', 'nexawp_page_sidebar_layout', [
			'show_in_rest' => true,
			'single'       => true,
			'type'         => 'string',
			'default'      => 'none',
			'sanitize_callback' => function( $v ) {
				return in_array( $v, [ 'none', 'left', 'right' ], true ) ? $v : 'none';
			},
		] );
	}

	/**
	 * Register theme sidebars (footer widget areas).
	 */
	public static function register_sidebars(): void {
		// Primary sidebar for blog/pages
		register_sidebar([
			'name' => __( 'Primary Sidebar', 'nexawp' ),
			'id' => 'sidebar-1',
			'description' => __( 'Main sidebar for blog and pages', 'nexawp' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="widget-title">',
			'after_title' => '</h4>',
		]);

		$base_id = 'nexawp-footer-';
		for ( $i = 1; $i <= 6; $i++ ) {
			register_sidebar(
				[
					'name'          => sprintf( __( 'Footer %d', 'nexawp' ), $i ),
					'id'            => $base_id . $i,
					'description'   => __( 'Footer widget area', 'nexawp' ),
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => '<h4 class="widget-title">',
					'after_title'   => '</h4>',
				]
			);
		}
	}

	public static function register_menus(): void {
		register_nav_menus( [
			'primary' => __( 'Primary Menu', 'nexawp' ),
			'above'   => __( 'Above Header Menu', 'nexawp' ),
			'below'   => __( 'Below Header Menu', 'nexawp' ),
			'footer'  => __( 'Footer Menu', 'nexawp' ),
		] );
	}
}

Setup::init();
