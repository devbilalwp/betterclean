<?php
/**
 * Template part for displaying single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Better_Clean
 */

$title_bg = get_field( 'title_bg', 'option' );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<!-- Render Block -->
	<div class="top-border"><div class="border-start"></div><div class="border-center"></div><div class="border-end"></div></div>
		<section class="content_block block-header">
			<div class="header-background">
				<?php
					if ( $title_bg ) :
						echo wp_get_attachment_image( $title_bg['id'], 'full', "", ["class" => "header-image"] );
					endif;
				?>
			</div>
			<div class="container">
				<div class="header-content">
					<?php custom_breadcrumb(); ?>
					<h2 class="header-headline"><?php echo get_the_title($post_id); ?></h2>
					<?php $post_id = get_the_ID(); ?>
					<div class="post-top">
						<div class="post-date"><?php echo get_the_date('F d, Y', $post_id); ?></div>
						<span>|</span>
						<div class="post-autor"><?php $author_id = get_post_field('post_author', $post_id); echo get_the_author_meta('display_name', $author_id); ?></div>
					</div>
				</div>
			</div>
		</section>
		<!-- /Render Block -->

		<!-- Render Block -->
		<section class="content_block block-blog>">
			<div class="container">
				<div class = "list-layout">
					<div class="blog-page-container">
						<?php $post_id = get_the_ID(); ?>
						<div class="post-card">
							<?php 
								if ( has_post_thumbnail($post_id)) :
									$thumbnail = get_the_post_thumbnail($post_id, 'large');
							?>
								<figure class="featured-image">
									<?php echo $thumbnail; ?>
								</figure>
							<?php endif; ?>
							<div class="post-body">
								<div class="post-description"><?php the_content(); ?></div>	
							</div>
						</div>
					</div>
					<?php 
						if (class_exists('Better_Sidebar_Widget')) {
							$better_sidebar_widget = new Better_Sidebar_Widget(); 
							$widget_args = array(
								'before_widget' => '<div class="better-widget">',
								'after_widget' => '</div>',     
							);
							// Display the widget
							$better_sidebar_widget->widget($widget_args, array());
						}
					?>
				</div>
			</div>
		</section>
		<!-- /Render Block -->

	<header class="entry-header">
		<?php //the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<?php if ( ! is_page() ) : ?>
			<div class="entry-meta">
				<?php //betterclean_entry_meta(); ?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php //betterclean_post_thumbnail(); ?>

	<div <?php betterclean_content_class( 'entry-content' ); ?>>
		<?php
		// the_content(
		// 	sprintf(
		// 		wp_kses(
		// 			/* translators: %s: Name of current post. Only visible to screen readers. */
		// 			__( 'Continue reading<span class="sr-only"> "%s"</span>', 'betterclean' ),
		// 			array(
		// 				'span' => array(
		// 					'class' => array(),
		// 				),
		// 			)
		// 		),
		// 		get_the_title()
		// 	)
		// );

		// wp_link_pages(
		// 	array(
		// 		'before' => '<div>' . __( 'Pages:', 'betterclean' ),
		// 		'after'  => '</div>',
		// 	)
		// );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php //betterclean_entry_footer(); ?>
	</footer><!-- .entry-footer -->

</article><!-- #post-${ID} -->
