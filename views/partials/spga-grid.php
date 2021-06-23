<?php
/**
 * Markup for SPGA Grid
 * 
 * @package SPGA Elementor
 */

defined( 'ABSPATH' ) || exit;

// Extract each setting into variables.
$post_type      = isset( $settings['spga_post_type'] ) ? sanitize_text_field( $settings['spga_post_type'] ) : 'post';
$show_title     = isset( $settings['spga_post_title_toggle'] ) ? sanitize_text_field( $settings['spga_post_title_toggle'] ) : 'yes';
$show_author    = isset( $settings['spga_post_author_toggle'] ) ? sanitize_text_field( $settings['spga_post_author_toggle'] ) : 'yes';
$show_taxonomy  = isset( $settings['spga_post_taxonomy_toggle'] ) ? sanitize_text_field( $settings['spga_post_taxonomy_toggle'] ) : 'yes';
$show_image     = isset( $settings['spga_post_image_toggle'] ) ? sanitize_text_field( $settings['spga_post_image_toggle'] ) : 'yes';
$show_excerpt   = isset( $settings['spga_post_excerpt_toggle'] ) ? sanitize_text_field( $settings['spga_post_excerpt_toggle'] ) : 'yes';
$title_length   = isset( $settings['spga_post_title_length'] ) ? absint( $settings['spga_post_title_length'] ) : 3;
$excerpt_length = isset( $settings['spga_post_excerpt_length'] ) ? absint( $settings['spga_post_excerpt_length'] ) : 20;

$taxonomies     = get_object_taxonomies( $post_type, 'names' );
$taxonomy       = ! empty( $taxonomies ) ? $taxonomies[0] : 'category';
?>

<article class="grid">
    <div class="grid-info-hover">
        <div class="grid-clock-info">
            <svg class="grid-clock"  viewBox="0 0 24 24"><path d="M12,20A7,7 0 0,1 5,13A7,7 0 0,1 12,6A7,7 0 0,1 19,13A7,7 0 0,1 12,20M19.03,7.39L20.45,5.97C20,5.46 19.55,5 19.04,4.56L17.62,6C16.07,4.74 14.12,4 12,4A9,9 0 0,0 3,13A9,9 0 0,0 12,22C17,22 21,17.97 21,13C21,10.88 20.26,8.93 19.03,7.39M11,14H13V8H11M15,1H9V3H15V1Z" />
            </svg><span class="grid-time"><?php echo spga_estimated_reading_time( get_the_content() ); ?></span>
        </div>
    </div>

    <?php if ( 'yes' === $show_image && has_post_thumbnail( get_the_ID() ) ) : ?>
        <div class="grid-img" style="background-image:url('<?php the_post_thumbnail_url( 'full' ); ?>')"></div>
        <a href="<?php the_permalink(); ?>" class="grid_link">
            <div class="grid-img-hover" style="background-image:url('<?php the_post_thumbnail_url( 'full' ); ?>')"></div>
        </a>
    <?php endif; ?>

    <div class="grid-info">
        <?php if ( 'yes' === $show_taxonomy ) : ?>
            <span class="grid-category"><?php the_terms( get_the_ID(), $taxonomy, '', ', ' ) ?></span>
        <?php endif; ?>
        <?php if ( 'yes' === $show_title ) : ?>
            <h3 class="grid-title"><a href="<?php the_permalink(); ?>"><?php echo wp_trim_words( get_the_title(), $title_length ); ?></a></h3>
        <?php endif; ?>

        <?php if ( 'yes' === $show_excerpt ) : ?>
            <p class="grid-excerpt"><?php echo wp_trim_words( get_the_excerpt(), $excerpt_length ); ?></p>
        <?php endif; ?>
        <?php if ( 'yes' === $show_author ) : ?>
            <span class="grid-by"><?php _e( 'by ', 'spga-elementor' ); the_author_link(); ?></span>
        <?php endif; ?>
    </div>
</article>
  