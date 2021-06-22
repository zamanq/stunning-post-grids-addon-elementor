<?php
/**
 * Handles stuff during plugin uninstallation
 * 
 * @package Gridly Elementor
 */

defined( 'WP_UNINSTALL_PLUGIN' ) || exit;

$options = array(
    'gridly_el_installed_at',
    'gridly_el_version',
    'gridly_el_license',
);

foreach ( $options as $option ) {
    delete_option( $option );
}