<?php
/**
 * Handles stuff during plugin uninstallation
 * 
 * @package Gridly
 */

defined( 'WP_UNINSTALL_PLUGIN' ) || exit;

$options = array(
    'gridly_installed_at',
    'gridly_version',
    'gridly_license',
);

foreach ( $options as $option ) {
    delete_option( $option );
}