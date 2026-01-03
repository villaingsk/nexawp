<?php
/**
 * Default content template
 *
 * @package NexaWP
 */

defined( 'ABSPATH' ) || exit;

// Meta visibility (can be filtered by Pro plugin)
$meta = apply_filters(
	'nexawp_blog_meta',
	[
		'author'   => true,
		'date'     => true,
		'category' => true,
	]
);
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'nexawp-post' ); ?>>
	<header class="nexawp-entry-header">
		<h2 class="nexawp-entry-title">
			<a href="<?php the_permalink(); ?>">
				<?php the_title(); ?>
			</a>
		</h2>

		<div class="nexawp-entry-meta">
			<span class="nexawp-post-date">
				<?php echo esc_html( get_the_date() ); ?>
			</span>
		</div>
	</header>

	<div class="nexawp-entry-content">
		<?php the_excerpt(); ?>
	</div>
</article>
