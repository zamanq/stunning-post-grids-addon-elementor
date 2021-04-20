<?php
/**
 * Handles admin related functionalities
 * 
 * @package Gridly
 */

namespace Gridly\Admin;

defined( 'ABSPATH' ) || exit;

/**
 * Dashborad class
 */
class Dashboard {

    /**
     * Register
     */
    public function register() {
        add_action( 'admin_menu', array( $this, 'add_admin_menu' ) );
		//add_action( 'admin_init', array( $this, 'register_settings' ) );
		//add_action( 'rest_api_init', array( $this, 'register_settings' ) );
    }

    /**
     * Add admin menu
     */
    public function add_admin_menu() {
        $page_title  = __( 'Gridly', 'gridly' );
		$menu_title  = __( 'Gridly', 'gridly' );
		$capability  = 'manage_options';
		$menu_slug   = 'gridly';
		$callback    = array( $this, 'markup' );

		add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $callback );
    }

    /**
     * Markup
     */
    public function markup() {
        echo '<div id="gridly-dashboard"></div>';
    }
}