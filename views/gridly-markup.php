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

<article class="card">
    <div class="card__info-hover">
        <div class="card__clock-info">
            <svg class="card__clock"  viewBox="0 0 24 24"><path d="M12,20A7,7 0 0,1 5,13A7,7 0 0,1 12,6A7,7 0 0,1 19,13A7,7 0 0,1 12,20M19.03,7.39L20.45,5.97C20,5.46 19.55,5 19.04,4.56L17.62,6C16.07,4.74 14.12,4 12,4A9,9 0 0,0 3,13A9,9 0 0,0 12,22C17,22 21,17.97 21,13C21,10.88 20.26,8.93 19.03,7.39M11,14H13V8H11M15,1H9V3H15V1Z" />
            </svg><span class="card__time">5 min</span>
        </div>
    </div>

    <?php if ( 'yes' === $show_image ) : ?>
        <div class="card__img" style="background-image:url('<?php the_post_thumbnail_url( 'medium' ); ?>')"></div>
        <a href="<?php the_permalink(); ?>" class="card_link">
            <div class="card__img--hover" style="background-image:url('<?php the_post_thumbnail_url( 'full' ); ?>')"></div>
        </a>
    <?php endif; ?>

    <div class="card__info">
        <span class="card__category"> Travel</span>
        <?php if ( 'yes' === $show_title ) : ?>
            <h3 class="card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
        <?php endif; ?>

        <?php if ( 'yes' === $show_excerpt ) : ?>
            <p><?php echo wp_trim_words( get_the_excerpt(), $excerpt_length ); ?></p>
        <?php endif; ?>

        <span class="card__by"><?php _e( 'by ', 'gridly' ); the_author_link(); ?></span>
    </div>
</article>  
  