<?php
/**
 * Handles rendering the templates
 * 
 * @package Gridly
 */

namespace Gridly\Traits;

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

    ?>
    <div class="gridly-wrapper">
        <div class="gridly-row">

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

        <?php Helpers::display_pagination( $the_query->max_num_pages ); ?>

    </div>

    <?php }
}