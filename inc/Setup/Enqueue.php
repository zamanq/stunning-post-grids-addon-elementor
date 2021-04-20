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
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );
    }

	/**
	 * Enqueue scripts
	 */
	public function enqueue_frontend_scripts() {
		wp_enqueue_style( 'gridly-styles', GRIDLY_DIR_URL . '/assets/css/styles.css', null, GRIDLY_VERSION, 'all' );
	}

    /**
	 * Enqueue admin scripts
	 */
	public function enqueue_admin_scripts() {
		wp_enqueue_style( 'gridly-admin', GRIDLY_DIR_URL . '/assets/css/dashboard.css', array( 'wp-components' ), GRIDLY_VERSION, 'all' );

		if ( ! isset( $_GET['page'] ) || 'gridly' !== $_GET['page'] ) {
			return;
		}
		wp_enqueue_script( 'gridly-admin', GRIDLY_DIR_URL . '/assets/js/dashboard.js', array( 'wp-api', 'wp-i18n', 'wp-components', 'wp-element' ), GRIDLY_VERSION, true );

		wp_localize_script( 'gridly-admin', 'gridly', array(
			'ajax_url' => admin_url( 'admin-ajax.php' ),
			'nonce' => wp_create_nonce(),
		) );
	}
}