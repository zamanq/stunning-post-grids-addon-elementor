<?php
/**
 * Markup for Flipper Grid
 * 
 * @package SPGA Elementor
 */

defined( 'ABSPATH' ) || exit;

// Extract each setting into variables.
$show_title    = isset( $settings['spga_post_title_toggle'] ) ? sanitize_text_field( $settings['spga_post_title_toggle'] ) : 'yes';
$show_image    = isset( $settings['spga_post_image_toggle'] ) ? sanitize_text_field( $settings['spga_post_image_toggle'] ) : 'yes';
$show_date     = isset( $settings['spga_post_date_toggle'] ) ? sanitize_text_field( $settings['spga_post_date_toggle'] ) : 'yes';
$title_length  = isset( $settings['spga_post_title_length'] ) ? absint( $settings['spga_post_title_length'] ) : 3;
$readmore_text = isset( $settings['spga_post_readmore'] ) ? sanitize_text_field( $settings['spga_post_readmore'] ) : __( 'Read More', 'spga-elementor' );
?>

<article class="spga-flipper">
	<div class="container">
		<div class="front" style="background-image: url( <?php has_post_thumbnail( get_the_ID() ) && 'yes' === $show_image ? the_post_thumbnail_url( 'full' ) : ''; ?> );">
			<div class="inner">
				<?php if ( 'yes' === $show_title ) : ?>
					<h3 class="title"><?php echo wp_trim_words( get_the_title(), $title_length ); ?></h3>
				<?php endif; ?>
				<?php if ( 'yes' === $show_date ) : ?>
					<span class="date"><?php the_time( 'F jS, Y' ); ?></span>
				<?php endif; ?>
			</div>
		</div>
		<div class="back" style="background-image: url( <?php has_post_thumbnail( get_the_ID() ) && 'yes' === $show_image ? the_post_thumbnail_url( 'full' ) : ''; ?> );">
			<div class="inner">
				<a href="<?php the_permalink(); ?>"><?php echo esc_html( $readmore_text ); ?></a>
			</div>
		</div>
	</div>
</article>

