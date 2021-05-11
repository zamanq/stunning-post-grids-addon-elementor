<?php
/**
 * Markup for Gridly App Cards
 * 
 * @package Gridly
 */

defined( 'ABSPATH' ) || exit;

// Extract each setting into variables.
$show_title   = isset( $settings['gridly_post_title_toggle'] ) ? sanitize_text_field( $settings['gridly_post_title_toggle'] ) : 'yes';
$show_image   = isset( $settings['gridly_post_image_toggle'] ) ? sanitize_text_field( $settings['gridly_post_image_toggle'] ) : 'yes';
$title_length = isset( $settings['gridly_post_title_length'] ) ? absint( $settings['gridly_post_title_length'] ) : 3;
?>

<article class="gridly-app-card">
    <div class="card-image">
    <?php if ( has_post_thumbnail( get_the_ID() ) && 'yes' === $show_image ) : ?>
        <a href="<?php the_permalink(); ?>"><img src="<?php the_post_thumbnail_url( 'full' ); ?>" /></a>
    <?php endif; ?>
    </div>
    <?php if ( 'yes' === $show_title ) : ?>
        <div class="card-title">
            <h3><a href="<?php the_permalink(); ?>"><?php echo wp_trim_words( get_the_title(), $title_length ); ?></a></h3>
        </div>
    <?php endif; ?>
</article>