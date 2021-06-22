<?php
/**
 * Plugin Name:       Gridly for Elementor
 * Description:       Prettify your Blog and Custom Post Types. Let the others wonder while you beautify yours posts instantly.
 * Version:           1.0.0
 * Author:            Quamruzzaman
 * Author URI:        https://profiles.wordpress.org/zamanq/
 * Contributors:      zamanq
 * Requires at least: 5.6
 * Tested up to:      5.7.2
 * Tags:              content
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       gridly-elementor
 *
 * @package Gridly Elementor
 */

defined( 'ABSPATH' ) || exit;

// Plugin specific constants.
define( 'GRIDLY_EL_LICENSE', 'free' );
define( 'GRIDLY_EL_VERSION', '1.0.0' );
define( 'GRIDLY_EL_DIR_URL', plugin_dir_url( __FILE__ ) );
define( 'GRIDLY_EL_DIR_PATH', plugin_dir_path( __FILE__ ) );

// Require autoload.
if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) :
	require_once dirname( __FILE__ ) . '/vendor/autoload.php';
endif;

// Initialize classes.
if ( class_exists( 'Gridly_Elementor\\Init' ) ) :
	Gridly_Elementor\Init::register_services();
endif;

// Handles stuff at plugin activation.
register_activation_hook( __FILE__, 'gridly_elementor_activated' );

function gridly_elementor_activated() {
	$installed_time = get_option( 'gridly_el_installed_at' );

	if ( ! $installed_time ) {
		update_option( 'gridly_el_installed_at', time() );
	}

	update_option( 'gridly_el_version', GRIDLY_EL_VERSION );
	update_option( 'gridly_el_license', GRIDLY_EL_LICENSE );
}
