<?php
/**
 * Handles registering all styles and scripts
 * 
 * @package SPGA Elementor
 */

namespace SPGA_Elementor\Setup;

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
		wp_enqueue_style( 'spga-elementor-styles', SPGA_EL_DIR_URL . '/assets/css/styles.min.css', null, SPGA_EL_VERSION, 'all' );
	}
}