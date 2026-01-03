<?php
/**
 * The sidebar containing the main widget area
 *
 * @package NexaWP
 */

if ( ! function_exists( 'is_active_sidebar' ) || ! is_active_sidebar( 'sidebar-1' ) ) {
    return;
}
?>
<aside id="secondary" class="widget-area" role="complementary" aria-label="<?php esc_attr_e( 'Sidebar', 'nexawp' ); ?>">
    <?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside>
