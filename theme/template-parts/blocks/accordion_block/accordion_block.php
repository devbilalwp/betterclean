<?php
/**
 * Accordion Block
 *
 * @package Better_Clean
 */


// Block data.
$block_class_identifier = "block-accordion";

$title = get_sub_field( 'title' );
$items = get_sub_field( 'items' );

?>

<!-- Render Block -->
<section class="content_block <?php echo esc_attr( $block_class_identifier ); ?>">
    <div class="container">
        <?php if( !empty($title) ) : ?>
            <h2 class="title"><?php echo $title; ?></h2>
        <?php endif; ?>

        <?php if( !empty($items) ) : ?>
            <div class="accordion-container">
                <?php foreach($items as $index => $item): ?>
                    <div class="accordion">
                        <?php if( !empty($item['headline']) ) : ?>
                            <h4 class="accordion-headline"><?php echo $item['headline']; ?><span><i class="accordion-icon far fa-arrow-down"></i></span></h4>
                        <?php endif; ?>
                        <?php if( !empty($item['content']) ) : ?>
                            <div class="accordion-content"><?php echo $item['content']; ?></div>
                        <?php endif; ?>
                    </div>
                <?php endforeach;?>
            </div>
        <?php endif; ?>
    </div>
</section>
<!-- ./Render Block -->
