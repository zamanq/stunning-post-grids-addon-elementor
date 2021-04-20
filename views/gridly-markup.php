<?php
/**
 * Markup for Gridly Post Types Layout
 * 
 * @package Gridly
 */

defined( 'ABSPATH' ) || exit;

?>

<div class="gridly-single-item">
    <a href="<?php the_permalink(); ?>">
        <img class="gridly-single-item-img" src="<?php the_post_thumbnail_url( 'thumbnail' ); ?>" alt="<?php the_title(); ?>" />
    </a>
</div>