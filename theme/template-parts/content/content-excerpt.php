<?php
/**
 * Template part for displaying post archives and search results
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Better_Clean
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php $post_id = get_the_ID(); ?>
	<div class="post-card">
		<?php 
			if ( has_post_thumbnail($post_id)) :
				$thumbnail = get_the_post_thumbnail($post_id, 'large');
		?>
			<a class="post-link" href="<?php echo get_the_permalink($post_id); ?>" target="_self" role="link" aria-label="<?php echo get_the_title($post_id); ?>">
				<figure class="featured-image">
					<?php echo $thumbnail; ?>
				</figure>
			</a>
        <?php endif; ?>
		<div class="post-body">
			<div class="post-top">
				<div class="post-date"><?php echo get_the_date('F d, Y', $post_id); ?></div>
				<span>|</span>
				<div class="post-autor"><?php $author_id = get_post_field('post_author', $post_id); echo get_the_author_meta('display_name', $author_id); ?></div>
			</div>
			<div class="post-title"><?php echo get_the_title($post_id); ?></div>
			<div class="post-description"><?php $post_content = get_the_excerpt($post_id); echo wp_trim_words($post_content, 40, '...'); ?></div>
			<a class="post-readmore" href="<?php echo get_the_permalink($post_id); ?>" target="_self" role="link" aria-label="Read article">Read article <span><i class="far fa-arrow-right"></i></span></a>
		</div>
	</div>

	<!-- <header class="entry-header">
		<?php
		if ( is_sticky() && is_home() && ! is_paged() ) {
			printf( '%s', esc_html_x( 'Featured', 'post', 'betterclean' ) );
		}
		the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
		?>
	</header> -->
	<!-- .entry-header -->

	<?php //betterclean_post_thumbnail(); ?>

	<div <?php //betterclean_content_class( 'entry-content' ); ?>>
		<?php //the_excerpt(); ?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php //betterclean_entry_footer(); ?>
	</footer><!-- .entry-footer -->

</article><!-- #post-${ID} -->
