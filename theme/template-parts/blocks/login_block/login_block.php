<?php
/**
 * Login Block
 *
 * @package Better_Clean
 */


// Block data.
$block_class_identifier = "block-login";

$background = get_sub_field( 'background' );
$image = get_sub_field( 'image' );
$headline = get_sub_field( 'headline' );
$content = get_sub_field( 'content' );

?>

<!-- Render Block -->
<section class="content_block <?php echo esc_attr( $block_class_identifier ); ?>">
    <?php if ( ! empty( $background ) ) : ?>
        <div class="login-background">
            <?php echo wp_get_attachment_image( $background['id'], 'full', "", ["class" => "login-bg"] ); ?>
        </div>
    <?php endif; ?>

    <div class="container">
        <div class="login-content">
            <div class ="login-header">
                <?php if ( ! empty( $image ) ) : ?>
                    <div class="login-image">
                        <?php echo wp_get_attachment_image( $image['id'], 'full', "", ["class" => "login-image"] ); ?>
                    </div>
                <?php endif; ?>
                <?php if( !empty($headline) ) : ?>
                    <h2 class="login-headline"><?php echo $headline; ?></h2>
                <?php endif; ?>
            </div>
            <div class = "login-body">
                <?php if( !empty($content) ) : ?>
                    <div class="login-desc"><?php echo $content; ?></div>
                <?php endif; ?>
                <?php echo do_shortcode('[custom_log_in]'); ?>
                <div class="forgot-password-link">
                    <?php echo '<a href="' . wp_lostpassword_url() . '">' . __('Forgot Password?') . '</a>'; ?>
                </div>
            </div>
            <div class = "login-footer">
                <p>New?</p>
                <a class="login-signup" href="wp_registration_url()" target="_self" role="link" aria-label="Read article">Sign Up <span>
                    <svg class="svg-inline--fa fa-arrow-right fa-w-14" aria-hidden="true" focusable="false" data-prefix="far" data-icon="arrow-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="">
                        <path fill="currentColor" d="M218.101 38.101L198.302 57.9c-4.686 4.686-4.686 12.284 0 16.971L353.432 230H12c-6.627 0-12 5.373-12 12v28c0 6.627 5.373 12 12 12h341.432l-155.13 155.13c-4.686 4.686-4.686 12.284 0 16.971l19.799 19.799c4.686 4.686 12.284 4.686 16.971 0l209.414-209.414c4.686-4.686 4.686-12.284 0-16.971L235.071 38.101c-4.686-4.687-12.284-4.687-16.97 0z"></path>
                    </svg>
                </span>
                </a>
            </div>
        </div>
    </div>
</section>
<!-- ./Render Block -->
