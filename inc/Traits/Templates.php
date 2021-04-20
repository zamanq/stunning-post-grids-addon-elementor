<?php
/**
 * Handles rendering the templates
 * 
 * @package Gridly
 */

namespace Gridly\Traits;

use WP_Query;

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
        $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;

        $args = array(
            'post_type'           => ! empty( $settings['gridly_post_type'] ) ? sanitize_text_field( $settings['gridly_post_type'] ) : 'post',
            'post_status'         => 'publish',
            'posts_per_page'      => ! empty( $settings['gridly_posts_per_page'] ) ? absint( $settings['gridly_posts_per_page'] ) : 3,
            'orderby'             => ! empty( $settings['gridly_post_orderby'] ) ? sanitize_text_field( $settings['gridly_post_orderby'] ) : 'date',
            'order'               => ! empty( $settings['gridly_post_order'] ) ? sanitize_text_field( $settings['gridly_post_order'] ) : 'desc',
            'ignore_sticky_posts' => 1,
            'paged'               => $paged,
        );

        $args['tax_query'] = [];

        $taxonomies = get_object_taxonomies( $settings['gridly_post_type'], 'objects' );

        foreach ( $taxonomies as $object ) {
            $setting_key = $object->name . '_ids';

            if ( ! empty( $settings[ $setting_key ] ) ) {
                $args['tax_query'][] = array(
                    'taxonomy' => $object->name,
                    'field'    => 'term_id',
                    'terms'    => $settings[ $setting_key ],
                );
            }
        }

        if ( ! empty( $args['tax_query'] ) ) {
            $args['tax_query']['relation'] = 'AND';
        }

        if ( ! empty( $settings['gridly_post_authors'] ) ) {
            $args['author__in'] = absint( $settings['gridly_post_authors'] );
        }

        $the_query = new WP_Query( $args );

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