<?php
/**
 * Blog Block
 *
 * @package Better_Clean
 */


// Block data.
$block_class_identifier = "block-blog";

$title = get_sub_field( 'title' );
$articles = get_sub_field( 'articles' );
$recent_article_number = get_sub_field( 'recent_article_number' );
$articles_to_show = get_sub_field( 'articles_to_show' );
$blog_page = get_sub_field( 'blog_page' );

if ($articles == 'show_all') {
	$posts = get_posts([
		'posts_per_page'     => -1,
		'orderby' => 'post_date',
        'order' => 'DESC',
        'post_type' => 'post',
        'post_status' => 'publish'
	]);
} elseif ($articles == 'latest_posts') {
	$posts = get_posts([
		'posts_per_page' => $recent_article_number,
        'offset' => 0,
        'orderby' => 'post_date',
        'order' => 'DESC',
        'post_type' => 'post',
        'post_status' => 'publish'
	]);
} else {
	$posts = get_posts([
		'posts_per_page'     => -1,
		'post_type'      => 'post',
		'orderby' => 'post_date',
        'order' => 'DESC',
		'post__in'        => $articles_to_show,
	]);
}
?>

<!-- Render Block -->
<section class="content_block <?php echo esc_attr( $block_class_identifier ); ?>">

    <div class="container">
        <?php if( !empty($title) ) : ?>
            <h2 class="title"><?php echo $title; ?></h2>
        <?php endif; ?>

        <?php if( !empty($posts) ) : ?>
            <?php if( !empty($blog_page) ) : ?>
                <div class = "list-layout">
            <?php endif; ?>
                    <div class="<?= $blog_page ? 'blog-page-container' : 'blog-container'; ?>">
                        <?php foreach($posts as $index => $post): ?>
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
                                    <?php if (!empty($blog_page)) : ?>
                                        <div class="post-top">
                                            <div class="post-date"><?php echo get_the_date('F d, Y', $post->ID); ?></div>
                                            <span>|</span>
                                            <div class="post-autor"><?php $author_id = get_post_field('post_author', $post->ID); echo get_the_author_meta('display_name', $author_id); ?></div>
                                        </div>
                                        <div class="post-title"><?php echo get_the_title($post->ID); ?></div>
                                        <div class="post-description"><?php $post_content = get_the_excerpt($post->ID); echo wp_trim_words($post_content, 40, '...'); ?></div>
                                        <a class="post-readmore" href="<?php echo get_the_permalink($post->ID); ?>" target="_self" role="link" aria-label="Read article">Read article <span><i class="far fa-arrow-right"></i></span></a>
                                    <?php else : ?>
                                        <div class="post-date"><?php echo get_the_date('F d, Y', $post->ID); ?></div>
                                        <div class="post-title"><?php echo get_the_title($post->ID); ?></div>
                                        <a class="post-readmore" href="<?php echo get_the_permalink($post->ID); ?>" target="_self" role="link" aria-label="Read article">Read article <span><i class="far fa-arrow-right"></i></span></a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach;?>
                        <?php wp_reset_postdata(); ?>
                    </div>
                    <?php if( !empty($blog_page) ) : ?>
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
                    <?php endif; ?>
            <?php if( !empty($blog_page) ) : ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>

</section>
<!-- ./Render Block -->
