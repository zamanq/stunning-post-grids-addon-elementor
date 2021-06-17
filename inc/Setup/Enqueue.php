<?php
/**
 * Handles registering all styles and scripts
 * 
 * @package Gridly
 */

namespace Gridly\Setup;

defined( 'ABSPATH' ) || exit;

/**
 * Enqueue class
 */
class Enqueue {

    /**
     * Register
     */
    public function register() {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_frontend_scripts' ) );
    }

	/**
	 * Enqueue scripts
	 */
	public function enqueue_frontend_scripts() {
		wp_enqueue_style( 'gridly-styles', GRIDLY_DIR_URL . '/assets/css/styles.css', null, GRIDLY_VERSION, 'all' );
	}
}