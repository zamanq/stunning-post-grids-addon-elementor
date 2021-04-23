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

        $gridly_layout  = isset( $settings['gridly_post_layout'] ) ? sanitize_text_field( $settings['gridly_post_layout'] ) : 'grid';
        $gridly_columns = isset( $settings['gridly_post_column_width'] ) ? absint( $settings['gridly_post_column_width'] ) : 200;

        $data_masonry = array(
            'itemSelector'    => '.gridly-single-item',
            'columnWidth'     => $gridly_columns,
            'percentPosition' => true
        );

    ?>
    <div class="gridly-wrapper">
        <div class="gridly-row" <?php echo 'masonry' === $gridly_layout ? 'data-masonry=' . json_encode( $data_masonry ) : ''; ?>>

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

    <?php if ( Plugin::instance()->editor->is_edit_mode() ) { ?>
        <script type="text/javascript">
            var elem = document.querySelector('.gridly-row');
            new Masonry( elem, {
            // options
            itemSelector: '.gridly-single-item',
            columnWidth: <?php echo $gridly_columns; ?>,
            percentPosition: true
            });
        </script>
   <?php }
    }
}