<?php
/**
 * Handles stuff during plugin uninstallation
 * 
 * @package SPGA Elementor
 */

defined( 'WP_UNINSTALL_PLUGIN' ) || exit;

$options = array(
    'spga_el_installed_at',
    'spga_el_version',
    'spga_el_license',
);

foreach ( $options as $option ) {
    delete_option( $option );
}