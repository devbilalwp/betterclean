<?php
/**
 * CTA Block
 *
 * @package Better_Clean
 */


// Block data.
$block_class_identifier = "block-cta";

$background = get_sub_field( 'image' );
$headline = get_sub_field( 'headline' );
$content = get_sub_field( 'content' );
$button = get_sub_field( 'button' );

?>

<!-- Render Block -->
<section class="content_block <?php echo esc_attr( $block_class_identifier ); ?>">
    <?php if ( ! empty( $background ) ) : ?>
        <div class="cta-background">
            <?php echo wp_get_attachment_image( $background['id'], 'full', "", ["class" => "hero-image"] ); ?>
        </div>
    <?php endif; ?>

    <div class="container">
        <div class="cta-content">
            <?php if( !empty($headline) ) : ?>
                <h2 class="cta-headline"><?php echo $headline; ?></h2>
            <?php endif; ?>

            <?php if( !empty($content) ) : ?>
                <div class="cta-body"><?php echo $content; ?></div>
            <?php endif; ?>

            <?php if ( ! empty( $button ) ) : ?>
				<a class="button" href='<?php echo esc_url( $button[ 'url' ] ); ?>' target="<?php echo esc_attr( $button[ 'target' ] ); ?>"><?php echo esc_html( $button[ 'title' ] ); ?></a>
			<?php endif; ?>
        </div>
    </div>
</section>
<!-- ./Render Block -->
