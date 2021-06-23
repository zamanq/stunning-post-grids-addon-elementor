<?php
/**
 * Handles rendering the templates
 * 
 * @package SPGA Elementor
 */

namespace SPGA_Elementor\Traits;

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

        $spga_layout   = isset( $settings['spga_post_layout'] ) ? sanitize_text_field( $settings['spga_post_layout'] ) : 'grid';
        $show_pagination = isset( $settings['spga_post_pagination_toggle'] ) ? sanitize_text_field( $settings['spga_post_pagination_toggle'] ) : 'yes';

    ?>
    
    <section class="spga-wrapper">
        <div class="<?php echo 'smartcard' === $spga_layout ? 'smart-card-wrapper' : 'spga-grids'; ?>">
            <?php
                if ( $the_query->have_posts() ) :
                    while ( $the_query->have_posts() ) :
                        $the_query->the_post();
                        require SPGA_EL_DIR_PATH . 'views/partials/spga-' . $spga_layout . '.php';
                    endwhile;
                endif;
                wp_reset_postdata();
            ?>
        </div>
        <?php if ( 'yes' === $show_pagination ) : ?>
            <div class="spga-pagination-wrapper">
                <?php Helpers::display_pagination( $the_query->max_num_pages ); ?>
            </div>
        <?php endif; ?>
    </section>
   <?php
   }
}