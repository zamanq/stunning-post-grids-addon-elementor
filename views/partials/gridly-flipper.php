<?php
/**
 * Markup for Flipper Grid
 * 
 * @package Gridly
 */

defined( 'ABSPATH' ) || exit;

// Extract each setting into variables.
$show_title    = isset( $settings['gridly_post_title_toggle'] ) ? sanitize_text_field( $settings['gridly_post_title_toggle'] ) : 'yes';
$show_image    = isset( $settings['gridly_post_image_toggle'] ) ? sanitize_text_field( $settings['gridly_post_image_toggle'] ) : 'yes';
$title_length  = isset( $settings['gridly_post_title_length'] ) ? absint( $settings['gridly_post_title_length'] ) : 3;
$readmore_text = isset( $settings['gridly_post_readmore'] ) ? sanitize_text_field( $settings['gridly_post_readmore'] ) : __( 'Read More', 'gridly' );
?>

<article class="gridly-flipper">
	<div class="container">
		<div class="front" style="background-image: url( <?php has_post_thumbnail( get_the_ID() ) && 'yes' === $show_image ? the_post_thumbnail_url( 'full' ) : ''; ?> );">
			<div class="inner">
				<?php if ( 'yes' === $show_title ) : ?>
					<h3><?php echo wp_trim_words( get_the_title(), $title_length ); ?></h3>
				<?php endif; ?>
				<span><?php the_time( 'F jS, Y' ); ?></span>
			</div>
		</div>
		<div class="back">
			<div class="inner">
				<a href="<?php the_permalink(); ?>"><?php echo esc_html( $readmore_text ); ?></a>
			</div>
		</div>
	</div>
</article>

