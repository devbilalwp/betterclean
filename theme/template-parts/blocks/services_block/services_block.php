<?php
/**
 * Service Block
 *
 * @package Better_Clean
 */

// Block data.
?>

<?php 

$block_class_identifier = "services_block";

$title = get_sub_field( 'title' );
$number_of_services = get_sub_field( 'number_of_services' );
$services_view = get_sub_field( 'services_view' );

if( !empty($number_of_services) ) :

    $posts = get_posts([
        'posts_per_page' => $number_of_services,
        'post_type' => 'services',
        'post_status' => 'publish',
        'orderby' => 'date', // Order by post publish date
        'order' => 'ASC'   // Order in descending (latest) order
    ]);

else : 

    $posts = get_posts([
        'posts_per_page' => -1,
        'post_type' => 'services',
        'post_status' => 'publish',
        'orderby' => 'date', // Order by post publish date
        'order' => 'ASC'   // Order in descending (latest) order
    ]);

endif; ?>

<?php if ($services_view == 'View Grid') : ?>
    <!-- Render one -->
    <section class="content_block <?php echo esc_attr( $block_class_identifier ); ?> grib-layout">

        <div class="container">
            <?php if( !empty($title) ) : ?>
                <h2 class="title"><?php echo $title; ?></h2>
            <?php endif; ?>

            <?php if( !empty($posts) ) : ?>

                <div class="services-container">

                    <?php foreach($posts as $index => $post): ?>

                        <article id="post-<?php the_ID(); ?>" class="services-post">

                            <a class="post-link" href="<?php echo get_the_permalink($post->ID); ?>" target="_self" role="link" aria-label="<?php echo get_the_title($post->ID); ?>">
                                            

                                <div class="post-card">
                                    <?php if ( has_post_thumbnail($post->ID)) :
                                        $thumbnail = get_the_post_thumbnail($post->ID, 'medium_large');
                                    ?>
                                        
                                        <figure class="featured-image">
                                            <?php echo $thumbnail; ?>
                                        </figure>

                                    <?php endif; ?>
                                    <div class="post-body">
                                        <div class="post-title"><?php echo get_the_title($post->ID); ?></div>
                                    </div>
                                </div>

                            </a>

                        </article><!-- #post-${ID} -->

                    <?php endforeach; ?>

                    <?php wp_reset_postdata(); ?>

                </div>

            <?php endif; ?>
        </div>

    </section>
    <!-- ./Render one -->
<?php elseif ($services_view == 'View Zigzag') : ?>
    <!-- Render two -->
    <section class="content_block <?php echo esc_attr( $block_class_identifier ); ?> left-layout left-right-layout">

        <div class="container">

            <?php if( !empty($posts) ) : ?>

                <div class="services-container">

                    <?php foreach($posts as $index => $post): ?>

                        <article id="post-<?php the_ID(); ?>" class="services-post">

                            <div class="post-card">
                                <?php 
                                    if ( has_post_thumbnail($post->ID)) :
                                        $thumbnail = get_the_post_thumbnail($post->ID, 'medium');
                                ?>
                                    <a class="post-link" href="<?php echo get_the_permalink($post->ID); ?>" target="_self" role="link" aria-label="<?php echo get_the_title($post->ID); ?>">
                                        <figure class="featured-image">
                                            <?php echo $thumbnail; ?>
                                        </figure>
                                    </a>
                                <?php endif; ?>
                                <div class="post-body">
                                    <div class="post-title"><?php echo get_the_title($post->ID); ?></div>
                                    <div class="post-content"><?php echo wp_trim_words( get_the_content($post->ID)); ?></div>
                                    <a class="post-readmore" href="<?php echo get_the_permalink($post->ID); ?>" target="_self" role="link" aria-label="Read article">Read article <span><i class="far fa-arrow-right"></i></span></a>
                                </div>
                            </div>

                        </article><!-- #post-${ID} -->

                    <?php endforeach;?>

                    <?php wp_reset_postdata(); ?>

                </div>

            <?php endif; ?>

        </div>

    </section>
    <!-- ./Render two -->
<?php else : ?>
    <!-- Render three -->
    <section class="content_block <?php echo esc_attr( $block_class_identifier ); ?> left-layout">

        <div class="container">

            <?php if( !empty($posts) ) : ?>

                <div class="services-container">

                    <?php foreach($posts as $index => $post): ?>

                        <article id="post-<?php the_ID(); ?>" class="services-post">

                            <div class="post-card">
                                <?php 
                                    if ( has_post_thumbnail($post->ID)) :
                                        $thumbnail = get_the_post_thumbnail($post->ID, 'medium');
                                ?>
                                    <a class="post-link" href="<?php echo get_the_permalink($post->ID); ?>" target="_self" role="link" aria-label="<?php echo get_the_title($post->ID); ?>">
                                        <figure class="featured-image">
                                            <?php echo $thumbnail; ?>
                                        </figure>
                                    </a>
                                <?php endif; ?>
                                <div class="post-body">
                                    <div class="post-title"><?php echo get_the_title($post->ID); ?></div>
                                    <div class="post-content"><?php echo wp_trim_words( get_the_content($post->ID)); ?></div>
                                    <a class="post-readmore" href="<?php echo get_the_permalink($post->ID); ?>" target="_self" role="link" aria-label="Read article">Read article <span><i class="far fa-arrow-right"></i></span></a>
                                </div>
                            </div>

                        </article><!-- #post-${ID} -->

                    <?php endforeach;?>

                    <?php wp_reset_postdata(); ?>

                </div>

            <?php endif; ?>

        </div>

    </section>
    <!-- ./Render three -->
 <?php endif; ?>