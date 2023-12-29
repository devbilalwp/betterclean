<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default. Please note that
 * this is the WordPress construct of pages: specifically, posts with a post
 * type of `page`.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Better_Clean
 */

get_header();
?>

	<main id="blocks-page" class="blocks-page">
		<?php 
            if ( have_rows( 'content_blocks' ) ) :
                // Init block order variable.
                $i = 0;

                // Loop through content blocks.
                while ( have_rows( 'content_blocks' ) ) :
                    the_row();

                    // Increment block order counter (used in the content block).
                    $i++;
                    $block_unique_id = 'post_' . get_the_ID() . '_content_block_' . $i;

                    // Find and include content block.
                    $file = 'template-parts/blocks/' . get_row_layout() . '/' . get_row_layout() . '.php';
                    if ( file_exists( get_stylesheet_directory() . '/' . $file ) ) {
                        include locate_template( $file, false, false );
                    } else {
                        echo '';
                    }

                endwhile;
            else :
                echo '';
            endif;
		?>
	</main>

<?php
get_footer();
