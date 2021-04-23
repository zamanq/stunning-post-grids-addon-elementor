<?php
/**
 * Markup for Gridly Post Types Layout
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

<div class="gridly-single-item">

    <?php if ( 'yes' === $show_image ) : ?>
        <a href="<?php the_permalink(); ?>">
            <img class="gridly-single-item-img" src="<?php the_post_thumbnail_url( 'medium' ); ?>" alt="<?php the_title(); ?>" />
        </a>
    <?php endif; ?>

    <?php if ( 'yes' === $show_title ) : ?>
        <h3><?php the_title(); ?></h3>
    <?php endif; ?>

    <?php if ( 'yes' === $show_excerpt ) : ?>
        <p><?php echo wp_trim_words( get_the_excerpt(), $excerpt_length ); ?></p>
    <?php endif; ?>

</div>