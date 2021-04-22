<?php
/**
 * Markup for Gridly Post Types Layout
 * 
 * @package Gridly
 */

defined( 'ABSPATH' ) || exit;

// Extract each setting into variables.
$show_title     = $settings['gridly_post_title_toggle'];
$show_image     = $settings['gridly_post_image_toggle'];
$show_excerpt   = $settings['gridly_post_excerpt_toggle'];
$excerpt_length = absint( $settings['gridly_post_excerpt_length'] );

?>

<div class="gridly-single-item">

    <?php if ( 'yes' === $show_image ) : ?>
        <a href="<?php the_permalink(); ?>">
            <img class="gridly-single-item-img" src="<?php the_post_thumbnail_url( 'thumbnail' ); ?>" alt="<?php the_title(); ?>" />
        </a>
    <?php endif; ?>

    <?php if ( 'yes' === $show_title ) : ?>
        <h3><?php the_title(); ?></h3>
    <?php endif; ?>

    <?php if ( 'yes' === $show_excerpt ) : ?>
        <p><?php echo wp_trim_words( get_the_excerpt(), $excerpt_length ); ?></p>
    <?php endif; ?>

</div>