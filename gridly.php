<?php
/**
 * Plugin Name:       Gridly
 * Plugin URI:        https://www.xoxodev.com/gridly
 * Description:       Gridly for Elementor. Prettify your Blog and Custom Post Types. Let the others wonder while you beautify yours posts instantly.
 * Version:           1.0.0
 * Author:            XoXo Dev
 * Author URI:        https://www.xoxodev.com/
 * Text Domain:       gridly
 * Requires at least: 5.6
 * Tested up to:      5.7.1
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 *
 * @package Gridly
 */

defined( 'ABSPATH' ) || exit;

// Plugin specific constants.
define( 'GRIDLY_LICENSE', 'free' );
define( 'GRIDLY_VERSION', '1.0.0' );
define( 'GRIDLY_DIR_URL', plugin_dir_url( __FILE__ ) );
define( 'GRIDLY_DIR_PATH', plugin_dir_path( __FILE__ ) );

// Require autoload.
if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) :
	require_once dirname( __FILE__ ) . '/vendor/autoload.php';
endif;

// Initialize classes.
if ( class_exists( 'Gridly\\Init' ) ) :
	Gridly\Init::register_services();
endif;

// Handles stuff at plugin activation.
register_activation_hook( __FILE__, 'gridly_activated' );

function gridly_activated() {
	$installed_time = get_option( 'gridly_installed_at' );

	if ( ! $installed_time ) {
		update_option( 'gridly_installed_at', time() );
	}

	update_option( 'gridly_version', GRIDLY_VERSION );
	update_option( 'gridly_license', GRIDLY_LICENSE );
}
