<?php
/**
 * Handles all ajax operations
 * 
 * @package Gridly
 */

namespace Gridly\Ajax;

defined( 'ABSPATH' ) || exit;

/**
 * Ajax class
 */
class Ajax {

    /**
     * Register
     */
    public function register() {
        //add_action( 'wp_ajax_submit_form_data', array( $this, 'handle_form_data' ) );
    }

    /**
     * Handle form data
     */
    public function handle_form_data() {
        $data1 = isset( $_POST['tmdbApi'] ) ? $_POST['tmdbApi'] : '';
        $data2 = isset( $_POST['amazonApi'] ) ? $_POST['amazonApi'] : '';

        wp_send_json( array( 'status' => 'Success', 'data1' => $data1, 'data2' => $data2 ) );
    }
}