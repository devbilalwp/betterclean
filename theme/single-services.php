<?php
/**
 * The template for displaying all services single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Better_Clean
 */

get_header();

$title_bg = get_field( 'title_bg', 'option' );
$booking = get_field( 'booking' );
?>
<article id="post-<?php the_ID(); ?>">

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
            </div>
        </div>
    </section>
    <!-- /Render Block -->

    <!-- Render Block -->
    <section class="content_block services_block">
        <div class="container">
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
                <div class = "list-layout">
                    <div class="services-post-container">
                        <div class="post-body">
                            <div class="post-title"><?php the_title(); ?></div>
                            <div class="post-description"><?php the_content(); ?></div>
                            <a class="button" href="<?php echo $booking; ?>" target="">Book a Service</a>
                        </div>
                    </div>
                    <div class="services-widget">
                        <h2 class="sw-heading">Our Services</h2>
                        <ul>
                            <?php
                                $args = array(
                                    'post_type' => 'services',
                                    'post_status' => 'publish',
                                    'posts_per_page' => -1,
                                    'orderby' => 'date',
                                    'order' => 'ASC',
                                );
                            
                                $the_query = new WP_Query( $args );
                            
                                if ( $the_query->have_posts() ) {
                                    while ( $the_query->have_posts() ) {
                                        $the_query->the_post();
                                        $active_class = ($post_id === get_the_ID()) ? 'active' : '';
                                         echo '<li class="sw-list '.$active_class.'"><a href="'.get_the_permalink().'">'.get_the_title().'</a></li>';
                                    }
                                } 
                            ?>
                        </ul>
                    </div>
                </div>					
            </div>
        </div>
    </section>
    <!-- /Render Block -->

</article>

<?php
get_footer();
