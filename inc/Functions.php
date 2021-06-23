<?php
/**
 * Provids useful utility functions
 * 
 * @package SPGA Elementor
 */

defined( 'ABSPATH' ) || exit;

/**
 * Estimated reading time
 * 
 * @param string $content
 * 
 * @return string $time
 */
function spga_estimated_reading_time( string $content ) {
    $words    = str_word_count( strip_tags( $content ) );
    $minute   = floor( $words / 200 );
    $second   = floor( $words % 200 / ( 200 / 60 ) );
    $estimate = $minute . ' Min' . ( $minute == 1 ? '' : 's' ) . ', ' . $second . ' Sec' . ( $second == 1 ? '' : 's' );
    $output   = $estimate;

    return $output;
}