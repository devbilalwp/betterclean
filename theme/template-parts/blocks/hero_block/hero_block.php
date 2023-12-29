<?php
/**
 * Hero Block
 *
 * @package Better_Clean
 */


// Block data.
$block_class_identifier = "block-hero";

$background = get_sub_field( 'image' );
$headline = get_sub_field( 'headline' );
$content = get_sub_field( 'content' );

?>

<!-- Render Block -->
<section class="content_block <?php echo esc_attr( $block_class_identifier ); ?>">
    <?php if ( ! empty( $background ) ) : ?>
        <div class="hero-background">
            <?php echo wp_get_attachment_image( $background['id'], 'full', "", ["class" => "hero-image"] ); ?>
        </div>
    <?php endif; ?>

    <div class="container">
        <div class="hero-content">
            <?php if( !empty($headline) ) : ?>
                <h2 class="hero-headline"><?php echo $headline; ?></h2>
            <?php endif; ?>

            <?php if( !empty($content) ) : ?>
                <div class="hero-body"><?php echo $content; ?></div>
            <?php endif; ?>

            <div class="form-container">
                <div class="group-row">
                    <input type="text" class="form-input" id="name" name="name" placeholder="Name">
                    <input type="tel" class="form-input" id="phone" name="phone" placeholder="Phone">
                </div>
                <div class="group-row">
                    <input type="email" class="form-input" id="email" name="email" placeholder="Email">
                    <input type="submit" class="button" value="Let’s go!">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ./Render Block -->
