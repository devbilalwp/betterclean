<?php
/**
 * Info Block
 *
 * @package Better_Clean
 */


// Block data.
$block_class_identifier = "block-info";

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
<section class="content_block <?php echo esc_attr( $block_class_identifier ); ?>">

    <div class="container">
        <?php if( !empty($items) ) : ?>
            <div class="content-container <?php echo $class; ?>">
                <?php foreach($items as $item): ?>
                    <div class="item">
                        <?php 
                            if ( ! empty( $item['subtitle'] ) ) : echo '<div class="item-subtext">' . $item['subtitle'] . '</div>'; endif;
                            if ( ! empty( $item['number'] ) ) : echo '<h4 class="item-number">' . $item['number'] . '</h4>'; endif;
                            if ( ! empty( $item['unit'] ) ) : echo '<div class="item-subtext">' . $item['unit'] . '</div>'; endif;
                        ?>
                    </div>
                <?php endforeach;?>
            </div>
        <?php endif; ?>
    </div>

</section>
<!-- ./Render Block -->
