<?php
/**
 * Header Block
 *
 * @package Better_Clean
 */


// Block data.
$block_class_identifier = "block-header";
$color = get_sub_field( 'color' );
$background = get_sub_field( 'image' );
$headline = get_sub_field( 'headline' );

?>

<!-- Render Block -->
<?= $color ? '' : '<div class="top-border"><div class="border-start"></div><div class="border-center"></div><div class="border-end"></div></div>'; ?>
<section class="content_block <?php echo esc_attr( $block_class_identifier ); ?> <?= $color ? 'dark' : ''; ?>">
    <?php if ( ! empty( $background ) ) : ?>
        <div class="header-background">
            <?php echo wp_get_attachment_image( $background['id'], 'full', "", ["class" => "header-image"] ); ?>
        </div>
    <?php endif; ?>

    <div class="container">
        <div class="header-content">
            <?php custom_breadcrumb(); ?>
            <?php if( !empty($headline) ) : ?>
                <h2 class="header-headline"><?php echo $headline; ?></h2>
            <?php endif; ?>
        </div>
    </div>
</section>
<!-- /Render Block -->