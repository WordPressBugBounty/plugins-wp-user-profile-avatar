<?php
/**
 * authorbox social info display shortcode
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<!-- Get author detail-->

<div class="author-bio-section">
    <div class="author-flex">
        <div class="author-image"><?php echo wp_kses_post( get_avatar( get_the_author_meta( 'ID' ), 90 ) ); ?></div>  
        <div class="author-info">
            <div class="author-name"><strong> <?php echo esc_attr( get_the_author_meta( 'display_name' ) ); ?> </strong></div>
            <div class="author-bio"><?php echo esc_attr( get_the_author_meta( 'description' ) ); ?></div>
        </div>
    </div>
         
    <!-- Display social link to the author  page-->
    <div class="authorbox-social-icons">
        <?php if ( ! empty( get_the_author_meta( 'facebook' ) ) ) { ?>
            <span> <a href="<?php echo esc_url( get_the_author_meta( 'facebook' ) ); ?>" title="facebook" target="_blank" id="facebook"><i class="fa-brands fa-facebook fa-2x"></i></a></span>
        <?php } ?>

        <?php if ( ! empty( get_the_author_meta( 'skype' ) ) ) { ?>
            <span> <a href="<?php echo esc_url( get_the_author_meta( 'skype' ) ); ?>" title="skype" target="_blank" id="skype"><i class="fa-brands fa-skype fa-2x"></i></a></span>
        <?php } ?>

        <?php if ( ! empty( get_the_author_meta( 'twitter' ) ) ) { ?>
            <span> <a href="<?php echo esc_url( get_the_author_meta( 'twitter' ) ); ?>" title="twitter" target="_blank" id="twitter"><i class="fa-brands fa-twitter-square fa-2x"></i></a></span>
        <?php } ?>

        <?php if ( ! empty( get_the_author_meta( 'youtube' ) ) ) { ?>
            <span><a href="<?php echo esc_url( get_the_author_meta( 'youtube' ) ); ?>" title="youtube" target="_blank" id="youtube"><i class="fa-brands fa-youtube-square fa-2x"></i></a></span>
        <?php } ?>

        <?php if ( ! empty( get_the_author_meta( 'linkedin' ) ) ) { ?>
            <span> <a href="<?php echo esc_url( get_the_author_meta( 'linkedin' ) ); ?>" title="linkedin" target="_blank" id="linkedin"><i class="fa-brands fa-linkedin-square fa-2x"></i></a></span>
        <?php } ?>

        <?php if ( ! empty( get_the_author_meta( 'googleplus' ) ) ) { ?>
            <span> <a href="<?php echo esc_url( get_the_author_meta( 'googleplus' ) ); ?>" title="googleplus" target="_blank" id="googleplus"><i class="fa-brands fa-google-plus-square fa-2x"></i></a></span>
        <?php } ?>

        <?php if ( ! empty( get_the_author_meta( 'pinterest' ) ) ) { ?>
            <span> <a href="<?php echo esc_url( get_the_author_meta( 'pinterest' ) ); ?>" title="pinterest" target="_blank" id="pinterest"><i class="fa-brands fa-pinterest-square fa-2x"></i></a></span>
        <?php } ?>
        <?php if ( ! empty( get_the_author_meta( 'instagram' ) ) ) { ?>
            <span> <a href="<?php echo esc_url( get_the_author_meta( 'instagram' ) ); ?>" title="instagram" target="_blank" id="instagram"><i class="fa-brands fa-instagram fa-2x"></i></a></span>
        <?php } ?>
        <?php if ( ! empty( get_the_author_meta( 'github' ) ) ) { ?>
            <span> <a href="<?php echo esc_url( get_the_author_meta( 'github' ) ); ?>" title="github" target="_blank" id="github"><i class="fa-brands fa-github-square fa-2x"></i></a></span>
                <?php } ?>
    </div>
</div>

