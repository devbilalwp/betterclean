<?php
/**
 * Price Block
 *
 * @package Better_Clean
 */


// Block data.
$block_class_identifier = "block-price";

$title = get_sub_field( 'title' );
$items = get_sub_field( 'items' );

?>

<!-- Render Block -->
<section class="content_block <?php echo esc_attr( $block_class_identifier ); ?>">
    <div class="container">
        <?php if( !empty($title) ) : ?>
            <p class="price-title"><?php echo $title; ?></p>
        <?php endif; ?>

        <?php if( !empty($items) ) : ?>
            <div class="price-container">
                <?php foreach($items as $index => $item): ?>
                    <div class="price-box">
                        <?php if( !empty($item['headline']) ) : ?>
                            <h4 class="headline"><?php echo $item['headline']; ?></h4>
                        <?php endif; ?>
                        <?php if( !empty($item['price']) ) : ?>
                            <h3 class="price"><?php echo $item['price']; ?></h3>
                        <?php endif; ?>
                        <?php if( !empty($item['time']) ) : ?>
                            <h6 class="time"><?php echo $item['time']; ?></h6>
                        <?php endif; ?>
                        <?php if( !empty($item['content']) ) : ?>
                            <div class="content"><?php echo $item['content']; ?></div>
                        <?php endif; ?>
                        <?php if( !empty($item['button']) ) : ?>
                            <a class="button" href="<?php echo $item['button']; ?>" target="">Get Started!</a>
                        <?php endif; ?>
                    </div>
                <?php endforeach;?>
            </div>
        <?php endif; ?>
    </div>
</section>
<!-- ./Render Block -->
