<?php
/**
 * Template part for displaying the header content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Better_Clean
 */

$header_bg = get_field( 'main_navigation_logo', 'option' );
?>

<header id="masthead">

	<div>
		<?php
		if ( is_front_page() ) :
			if ( $header_bg ) :
				echo wp_get_attachment_image( $header_bg['id'], 'full', "", ["class" => "header-bg"] );
			else:
				?>
				<h1><?php bloginfo( 'name' ); ?></h1>
				<?php
			endif;
			?>
			<?php
		else :
			?>
			<p><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php
				if ( $header_bg ) :
					echo wp_get_attachment_image( $header_bg['id'], 'full', "", ["class" => "header-bg"] );
				else:
					?>
					<h1><?php bloginfo( 'name' ); ?></h1>
					<?php
				endif;
			?></a></p>
			<?php
		endif;
		?>
	</div>

	<button class="hamburger-open" aria-controls="primary-menu" aria-expanded="false"><span class="sr-only"><?php esc_html_e( 'Primary Menu', 'betterclean' ); ?></span><span class="icon"><i class="far fa-bars"></i></span></button>
	<nav id="site-navigation" aria-label="<?php esc_attr_e( 'Main Navigation', 'betterclean' ); ?>">
		<button class="hamburger-close" aria-controls="primary-menu" aria-expanded="false"><span class="sr-only"><?php esc_html_e( 'Primary Menu', 'betterclean' ); ?></span><span class="icon"><i class="far fa-times"></i></span></button>

		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'menu-1',
				'menu_id'        => 'primary-menu',
				'items_wrap'     => '<ul id="%1$s" class="%2$s" aria-label="submenu">%3$s</ul>',
			)
		);
		?>
	</nav><!-- #site-navigation -->

	<div class="mobile-sticky-header-overlay"></div>

</header><!-- #masthead -->
