<?php
/**
 * Media Block
 *
 * @package Better_Clean
 */


// Block data.
$block_class_identifier = "block-media";

$title = get_sub_field( 'title' );
$media_type = get_sub_field( 'media_type' );

?>

<!-- Render Block -->
<section class="content_block <?php echo esc_attr( $block_class_identifier ); ?>">

    <div class="container">
        <?php if( !empty($title) ) : ?>
            <h2 class="title"><?php echo $title; ?></h2>
        <?php endif; ?>
        
        <div class="media-content">
            <?php if ( 'image' === $media_type ) : $image = get_sub_field( 'image' ); ?>
                <?php if ( ! empty( $image ) ) : echo wp_get_attachment_image( $image['id'], 'full', "", ["class" => "media-image"] ); endif; ?>
            <?php else :
                $video = get_sub_field('video');
                preg_match( '/src="(.+?)"/', $video, $matches );
                $src  = $matches[1];
                $type = 'other';
                if ( false !== strpos( $src, 'youtube' ) ) {
                    $type      = 'youtube';
                    $video_id  = get_youtube_id_from_url( $video );
                    $thumbnail = get_youtube_thumbnail_from_id( $video_id );
                } elseif ( false !== strpos( $src, 'vimeo' ) ) {
                    $type      = 'vimeo';
                    $video_id  = get_vimeo_id_from_url( $video );
                    $thumbnail = get_vimeo_thumbnail_from_id( $video_id );
                }
            ?>

                <div class="video-container">
                    <?php if ( 'youtube' === $type ) : ?>
                        <img class='thumbnail-background' src='<?php echo $thumbnail; ?>' alt="thumbnail" />
                        <iframe class="background-video" title="video" src="https://www.youtube.com/embed/?<?php echo $video_id; ?>&modestbranding=1&autohide=1&controls=0&rel=0&loop=1&enablejsapi=1&disablekb=1&playlist=<?php echo $video_id; ?>" frameborder="0" allow="accelerometer; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
                    <?php elseif ( 'vimeo' === $type ) : ?>
                        <img class='thumbnail-background' src='<?php echo $thumbnail; ?>' alt="thumbnail" />
                        <iframe class="background-video" title="video" src="https://player.vimeo.com/video/<?php echo $video_id; ?>?loop=1&controls=0" frameborder="0" allow="accelerometer; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
                    <?php else : ?>
                        <iframe class="background-video" title="video" src="<?php echo $src; ?>" frameborder="0" allow="accelerometer; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
                    <?php endif; ?>
                </div>

            <?php endif; ?>
        </div>
    </div>
</section>
<!-- ./Render Block -->