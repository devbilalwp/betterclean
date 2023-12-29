<?php
/**
 * Template part for displaying the footer content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Better_Clean
 */

$footer_logo = get_field( 'footer_logo', 'option' );
$footer_content = get_field( 'footer_content', 'option' );
$apple_store_link = get_field( 'apple_store_link', 'option' );
$apple_store_logo = get_field( 'apple_store_logo', 'option' );
$googleplay_link = get_field( 'googleplay_link', 'option' );
$google_play_logo = get_field( 'google_play_logo', 'option' );
$copyright = get_field( 'copyright', 'option' );

$facebook = get_field( 'facebook', 'option' );
$twitter = get_field( 'twitter', 'option' );
$youtube = get_field( 'youtube', 'option' );
$instagram = get_field( 'instagram', 'option' );

$recents = get_posts([
    'posts_per_page' => 6,
    'orderby' => 'post_date',
    'order' => 'DESC',
    'post_type' => 'post',
    'post_status' => 'publish'
]);
?>

<footer id="colophon">

	<div class="container">
		<div class="footer-sidebar">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php
				if ( $footer_logo ) :
					echo wp_get_attachment_image( $footer_logo['id'], 'full', "", ["class" => "footer-logo"] );
				else:
					?>
					<h2><?php bloginfo( 'name' ); ?></h2>
					<?php
				endif;
			?></a>

			<?php if( !empty($footer_content) ) : ?>
                <p><?php echo $footer_content; ?></p>
            <?php endif; ?>

			<?php if( !empty($apple_store_link) ) : ?>
                <a href="<?php echo esc_url( $apple_store_link ); ?>" class="store-link" target="_blank" rel="noopener" aria-label="Apple Store"><?php
					if ( $apple_store_logo ) :
						echo wp_get_attachment_image( $apple_store_logo['id'], 'full', "", ["class" => "apple-store-logo"] );
					else:
						?>
						<p>Apple Store</p>
						<?php
					endif;
				?></a>
            <?php endif; ?>

			<?php if( !empty($googleplay_link) ) : ?>
                <a href="<?php echo esc_url( $googleplay_link ); ?>" class="store-link" target="_blank" rel="noopener" aria-label="Google Play"><?php
					if ( $google_play_logo ) :
						echo wp_get_attachment_image( $google_play_logo['id'], 'full', "", ["class" => "gogole-play-logo"] );
					else:
						?>
						<p>Google Play</p>
						<?php
					endif;
				?></a>
            <?php endif; ?>

			<div class="socials">
				<?php if( !empty($facebook) ) : ?>
					<a href="<?php echo esc_url( $facebook ); ?>" class="social-link" target="_blank" rel="noopener" aria-label="Follow on Facebook">
						<i class="fab fa-facebook-f"></i>
					</a>
				<?php endif; ?>
				<?php if( !empty($twitter) ) : ?>
					<a href="<?php echo esc_url( $twitter ); ?>" class="social-link" target="_blank" rel="noopener" aria-label="Follow on Twitter">
						<i class="fab fa-twitter"></i>
					</a>
				<?php endif; ?>
				<?php if( !empty($youtube) ) : ?>
					<a href="<?php echo esc_url( $youtube ); ?>" class="social-link" target="_blank" rel="noopener" aria-label="Follow on YouTube">
						<i class="fab fa-youtube"></i>
					</a>
				<?php endif; ?>
				<?php if( !empty($instagram) ) : ?>
					<a href="<?php echo esc_url( $instagram ); ?>" class="social-link" target="_blank" rel="noopener" aria-label="Follow on Instagram">
						<i class="fab fa-instagram"></i>
					</a>
				<?php endif; ?>
			</div>
		</div>

		<div class="footer-navigations">
			<?php if ( has_nav_menu( 'menu-2' ) ) : ?>
				<nav aria-label="<?php esc_attr_e( 'Footer Menu 1', 'betterclean' ); ?>">
					<?php
					echo '<h4 class="footer-title">' . wp_get_nav_menu_name( 'menu-2' ) . '</h4>';
					wp_nav_menu(
						array(
							'theme_location' => 'menu-2',
							'menu_class'     => 'footer-menu',
							'depth'          => 1,
						)
					);
					?>
				</nav>
			<?php endif; ?>
			<?php if ( has_nav_menu( 'menu-3' ) ) : ?>
				<nav aria-label="<?php esc_attr_e( 'Footer Menu 2', 'betterclean' ); ?>">
					<?php
					echo '<h4 class="footer-title">' . wp_get_nav_menu_name( 'menu-3' ) . '</h4>';
					wp_nav_menu(
						array(
							'theme_location' => 'menu-3',
							'menu_class'     => 'footer-menu',
							'depth'          => 1,
						)
					);
					?>
				</nav>
			<?php endif; ?>
			<?php if ( has_nav_menu( 'menu-4' ) ) : ?>
				<nav aria-label="<?php esc_attr_e( 'Footer Menu 3', 'betterclean' ); ?>">
					<?php
					echo '<h4 class="footer-title">' . wp_get_nav_menu_name( 'menu-4' ) . '</h4>';
					wp_nav_menu(
						array(
							'theme_location' => 'menu-4',
							'menu_class'     => 'footer-menu',
							'depth'          => 1,
						)
					);
					?>
				</nav>
			<?php endif; ?>
		</div>

		<div class="footer-articles">
			<h4 class="footer-title">Articles</h4>

			<?php foreach($recents as $index => $article): ?>
				<a class="post-link" href="<?php echo get_the_permalink($article->ID); ?>" target="_self"><?php echo get_the_title($article->ID); ?></a>
			<?php endforeach;?>
			<?php wp_reset_postdata(); ?>					
		</div>
	</div>

</footer><!-- #colophon -->
