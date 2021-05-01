<?php
/**
 * Markup for Flipper Grid
 * 
 * @package Gridly
 */

defined( 'ABSPATH' ) || exit;

?>

<article class="gridly-flipper">
	<div class="container">
		<div class="front" style="background-image: url( <?php has_post_thumbnail( get_the_ID() ) ? the_post_thumbnail_url( 'full' ) : ''; ?> );">
			<div class="inner">
				<h3><?php echo wp_trim_words( get_the_title(), 3 ); ?></h3>
	<span><?php the_time( 'F jS, Y' ); ?></span>
			</div>
		</div>
		<div class="back">
			<div class="inner">
				<a href="<?php the_permalink(); ?>">Read more</a>
			</div>
		</div>
	</div>
</article>

