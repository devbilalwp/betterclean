<?php
/**
 * General Block
 *
 * @package Better_Clean
 */


// Block data.
$block_class_identifier = "block-general";

$background = get_sub_field( 'background' );
$type = get_sub_field( 'type' );
$position = get_sub_field( 'position' );
$title = get_sub_field( 'title' );
$items = get_sub_field( 'items' );
$total_rows = count($items);
switch ($total_rows) {
    case 1:
        $class = 'col-12';
        break;
    case 2:
        $class = 'col-6';
        break;
    case 3:
        $class = 'col-4';
        break;
    default:
        $class = 'col-3';
}
?>

<!-- Render Block -->
<section class="content_block <?php echo esc_attr( $block_class_identifier ); ?> <?php echo strtolower(get_the_title()); ?> <?= $background ? 'dark' : ''; ?>">

    <div class="container">
        <?php if( !empty($title) ) : ?>
            <h2 class="title"><?php echo $title; ?></h2>
        <?php endif; ?>

        <?php if( !empty($items) ) : ?>
            <div class="content-container <?php echo $class . ' ' . $position; ?>">
                <?php foreach($items as $item): ?>
                    <div class="item <?= $type ? 'icon' : ''; ?>">
                        <?php 
                            if ( ! empty( $item['media'] ) ) : echo wp_get_attachment_image( $item['media']['id'], 'full', "", ["class" => "item-media"] ); endif;
                            if ( ! empty( $item['headline'] ) ) : echo '<h4 class="item-headline">' . $item['headline'] . '</h4>'; endif;
                            if ( ! empty( $item['content'] ) ) : echo '<div class="item-content">' . $item['content'] . '</div>'; endif;
                        ?>
                    </div>
                <?php endforeach;?>
            </div>
        <?php endif; ?>
    </div>

</section>
<!-- ./Render Block -->
