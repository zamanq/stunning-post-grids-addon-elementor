<?php
/**
 * Provides useful helper methods
 * 
 * @package SPGA Elementor
 */

namespace SPGA_Elementor\Traits;

use WP_Query;

defined( 'ABSPATH' ) || exit;

/**
 * Helpers trait
 */
trait Helpers {

    /**
     * The query
     * 
     * @param array $settings
     * 
     * @return object $the_query
     */
    public static function the_query( array $settings ) {
        $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;

        $args = array(
            'post_type'           => ! empty( $settings['spga_post_type'] ) ? sanitize_text_field( $settings['spga_post_type'] ) : 'post',
            'post_status'         => 'publish',
            'posts_per_page'      => ! empty( $settings['spga_posts_per_page'] ) ? absint( $settings['spga_posts_per_page'] ) : 3,
            'orderby'             => ! empty( $settings['spga_post_orderby'] ) ? sanitize_text_field( $settings['spga_post_orderby'] ) : 'date',
            'order'               => ! empty( $settings['spga_post_order'] ) ? sanitize_text_field( $settings['spga_post_order'] ) : 'desc',
            'ignore_sticky_posts' => 1,
            'paged'               => $paged,
        );

        $args['tax_query'] = array();

        $taxonomies = get_object_taxonomies( $settings['spga_post_type'], 'objects' );

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

        if ( ! empty( $settings['spga_post_authors'] ) ) {
            $args['author__in'] = absint( $settings['spga_post_authors'] );
        }

        $the_query = new WP_Query( $args );

        return $the_query;
    }

    /**
     * Get all post types
     * 
     * @return array $post_types
     */
    public static function get_all_post_types() {
        $args = array( 
            'public'            => true,
            'show_in_nav_menus' => true
        );

        $output = 'objects';

        $post_types = get_post_types( ( array ) $args, ( string ) $output );
        $post_types = wp_list_pluck( $post_types, 'label', 'name' );
        array_diff_key( $post_types, array( 'elementor_library', 'attachment', 'product' ) );

        return $post_types;
    }

    /**
     * Get authors
     */
    public static function get_authors() {

        $args = array(
            'capability'          => array( 'edit_posts' ),
            'has_published_posts' => true,
            'fields'              => array( 'ID', 'display_name' ),
        );

        // Capability queries newly introduced in WP 5.9.
        if ( version_compare( $GLOBALS['wp_version'], '5.9', '<' ) ) {
            $args['who'] = 'authors';
            unset( $args['capability'] );
        }

        $users = get_users( $args );

        if ( ! empty( $users ) ) {
            $authors = wp_list_pluck( $users, 'display_name', 'ID' );
            return $authors;
        }

        return array();
    }

    /**
     * Order by
     * 
     * @return array $orderby
     */
    public static function get_orderby_filter() {
        $orderby = array(
            'ID'            => 'Post ID',
            'author'        => 'Post Author',
            'title'         => 'Title',
            'date'          => 'Date',
            'modified'      => 'Last Modified Date',
            'parent'        => 'Parent Id',
            'rand'          => 'Random',
            'comment_count' => 'Comment Count',
            'menu_order'    => 'Menu Order',
        );

        return $orderby;
    }

    /**
     * Pagination
     * 
     * @param int $total_pages
     * 
     * @return void
     */
    public static function display_pagination( int $total_pages ) {
        $big = 999999999;
        $pagination_args = array(
            'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format'    => '?paged=%#%',
            'current'   => max( 1, get_query_var( 'paged' ) ),
            'total'     => $total_pages,
            'prev_text' => '&#8592;',
            'next_text' => '&#8594;',
        );
        echo '<div class="spga-pagination">' . paginate_links( $pagination_args ) . '</div>';
    }
}