<?php
/**
 * Handles rendering the templates
 * 
 * @package Gridly
 */

namespace Gridly\Traits;

use Elementor\Plugin;

defined( 'ABSPATH' ) || exit;

/**
 * Templates trait
 */
trait Templates {

    /**
     * Render
     * 
     * @param array $settings
     * 
     * @return string $html
     */
    public static function render( array $settings ) {
        
        $the_query = Helpers::the_query( $settings );

        $gridly_layout   = isset( $settings['gridly_post_layout'] ) ? sanitize_text_field( $settings['gridly_post_layout'] ) : 'grid';
        $show_pagination = isset( $settings['gridly_post_pagination_toggle'] ) ? sanitize_text_field( $settings['gridly_post_pagination_toggle'] ) : 'yes';

    ?>
    
    <section class="gridly-wrapper">
        <div class="gridly-grids">
            <?php
                if ( $the_query->have_posts() ) :
                    while ( $the_query->have_posts() ) :
                        $the_query->the_post();
                        require GRIDLY_DIR_PATH . 'views/gridly-markup.php';
                    endwhile;
                endif;
                wp_reset_postdata();
            ?>
        </div>
        <?php if ( 'yes' === $show_pagination ) : ?>
            <div class="gridly-pagination-wrapper">
                <?php Helpers::display_pagination( $the_query->max_num_pages ); ?>
            </div>
        <?php endif; ?>
    </section>
   <?php
   }
}