<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Better_Clean
 */

$title_bg = get_field( 'title_bg', 'option' );

get_header();
?>

	<section id="primary">
		<main id="main">

			<?php 
				if ( have_posts() ) : ?>

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
								<h2 class="header-headline"><?php echo single_cat_title(); ?></h2>
							</div>
						</div>
					</section>
					<!-- /Render Block -->

					<!-- Render Block -->
					<section class="content_block block-blog>">
						<div class="container">
							<div class = "list-layout">
								<div class="blog-page-container">
									<?php
										// Start the Loop.
										while ( have_posts() ) :
											the_post();
											get_template_part( 'template-parts/content/content', 'excerpt' );

											// End the loop.
										endwhile;

										// Previous/next page navigation.
										betterclean_the_posts_navigation();
									?>
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

				<? else :

						// If no content, include the "No posts found" template.
						get_template_part( 'template-parts/content/content', 'none' );

				endif; 
			?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_footer();
