<?php
/**
 * Markup for SPGA Smart Card
 * 
 * @package SPGA Elementor
 */

defined( 'ABSPATH' ) || exit;

// Extract each setting into variables.
$show_title     = isset( $settings['spga_post_title_toggle'] ) ? sanitize_text_field( $settings['spga_post_title_toggle'] ) : 'yes';
$show_image     = isset( $settings['spga_post_image_toggle'] ) ? sanitize_text_field( $settings['spga_post_image_toggle'] ) : 'yes';
$show_excerpt   = isset( $settings['spga_post_excerpt_toggle'] ) ? sanitize_text_field( $settings['spga_post_excerpt_toggle'] ) : 'yes';
$title_length   = isset( $settings['spga_post_title_length'] ) ? absint( $settings['spga_post_title_length'] ) : 3;
$excerpt_length = isset( $settings['spga_post_excerpt_length'] ) ? absint( $settings['spga_post_excerpt_length'] ) : 20;
$readmore_text  = isset( $settings['spga_post_readmore'] ) ? sanitize_text_field( $settings['spga_post_readmore'] ) : __( 'Read More', 'spga-elementor' );
?>

<article class="spga-smart-card" style="background-image: url( <?php 'yes' === $show_image && has_post_thumbnail( get_the_ID() ) ? the_post_thumbnail_url( 'full' ) : ''; ?> );">
    <div class="content">
        <?php if ( 'yes' === $show_title ) : ?>
            <h2 class="title"><?php echo wp_trim_words( get_the_title(), $title_length ); ?></h2>
        <?php endif; ?>

        <?php if ( 'yes' === $show_excerpt ) : ?>
            <p class="copy"><?php echo wp_trim_words( get_the_excerpt(), $excerpt_length ); ?></p>
        <?php endif; ?>
        <a href="<?php the_permalink(); ?>"><?php echo esc_html( $readmore_text ); ?></a>
    </div>
</article>