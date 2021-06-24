<?php
/**
 * Plugin Name:       Stunning Post Grids Addon for Elementor
 * Description:       Prettify your Blog and Custom Post Types with the Stunning Post Grids Addon for Elementor plugin. Let the others wonder while you beautify yours posts instantly.
 * Version:           1.0.1
 * Author:            Quamruzzaman
 * Author URI:        https://profiles.wordpress.org/zamanq/
 * Contributors:      zamanq
 * Requires at least: 5.6
 * Tested up to:      5.7.2
 * Tags:              content
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       spga-elementor
 *
 * @package SPGA Elementor
 */

defined( 'ABSPATH' ) || exit;

// Plugin specific constants.
define( 'SPGA_EL_LICENSE', 'free' );
define( 'SPGA_EL_VERSION', '1.0.1' );
define( 'SPGA_EL_DIR_URL', plugin_dir_url( __FILE__ ) );
define( 'SPGA_EL_DIR_PATH', plugin_dir_path( __FILE__ ) );

// Require autoload.
if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) :
	require_once dirname( __FILE__ ) . '/vendor/autoload.php';
endif;

// Initialize classes.
if ( class_exists( 'SPGA_Elementor\\Init' ) ) :
	SPGA_Elementor\Init::register_services();
endif;

// Handles stuff at plugin activation.
register_activation_hook( __FILE__, 'spga_elementor_activated' );

/**
 * Activation callback
 *
 * @return void
 */
function spga_elementor_activated() {
	$installed_time = get_option( 'spga_el_installed_at' );

	if ( ! $installed_time ) {
		update_option( 'spga_el_installed_at', time() );
	}

	update_option( 'spga_el_version', SPGA_EL_VERSION );
	update_option( 'spga_el_license', SPGA_EL_LICENSE );
}
