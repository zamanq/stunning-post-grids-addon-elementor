<?php
/**
 * Provides useful helper methods
 * 
 * @package Gridly
 */

namespace Gridly\Traits;

defined( 'ABSPATH' ) || exit;

/**
 * Helpers trait
 */
trait Helpers {

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
        $users = get_users(
            array(
                'who'                 => 'authors',
                'has_published_posts' => true,
                'fields'              => array(
                    'ID',
                    'display_name',
                ),
            )
        );

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
            'current'   => max( 1, get_query_var('paged') ),
            'total'     => $total_pages,
            'prev_text' => '&#8592;',
            'next_text' => '&#8594;',
        );
        echo '<div class="gridly-pagination">' . paginate_links( $pagination_args ) . '</div>';
    }
}