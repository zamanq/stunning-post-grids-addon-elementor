<?php
/**
 * Markup for Gridly Smart Card
 * 
 * @package Gridly
 */

defined( 'ABSPATH' ) || exit;

// Extract each setting into variables.
$show_title     = isset( $settings['gridly_post_title_toggle'] ) ? sanitize_text_field( $settings['gridly_post_title_toggle'] ) : 'yes';
$show_image     = isset( $settings['gridly_post_image_toggle'] ) ? sanitize_text_field( $settings['gridly_post_image_toggle'] ) : 'yes';
$show_excerpt   = isset( $settings['gridly_post_excerpt_toggle'] ) ? sanitize_text_field( $settings['gridly_post_excerpt_toggle'] ) : 'yes';
$excerpt_length = isset( $settings['gridly_post_excerpt_length'] ) ? absint( $settings['gridly_post_excerpt_length'] ) : 20;

?>

<article class="gridly-smart-card" style="background-image: url( <?php 'yes' === $show_image && has_post_thumbnail( get_the_ID() ) ? the_post_thumbnail_url( 'full' ) : ''; ?> );">
    <div class="content">
        <?php if ( 'yes' === $show_title ) : ?>
            <h2 class="title"><?php the_title(); ?></h2>
        <?php endif; ?>

        <?php if ( 'yes' === $show_excerpt ) : ?>
            <p class="copy"><?php echo wp_trim_words( get_the_excerpt(), $excerpt_length ); ?></p>
        <?php endif; ?>
        <a href="<?php the_permalink(); ?>">Read More</a>
    </div>
</article>