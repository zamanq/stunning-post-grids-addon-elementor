<?php
/**
 * Handles Elementor dependencies
 * 
 * @package SPGA Elementor
 */

namespace SPGA_Elementor\Setup;

use Elementor\Plugin;
use SPGA_Elementor\Widgets\SPGA_Widget;

defined( 'ABSPATH' ) || exit;

/**
 * Setup class
 */
class Setup {

    /**
	 * Minimum Elementor Version
     * 
	 * @var string Minimum Elementor version required to run the plugin.
	 */
	const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

	/**
	 * Minimum PHP Version
	 *
	 * @var string Minimum PHP version required to run the plugin.
	 */
	const MINIMUM_PHP_VERSION = '7.0';

    /**
     * Register
     */
    public function register() {
        add_action( 'plugins_loaded', array( $this, 'on_plugins_loaded' ) );
    }

    /**
     * On plugins loaded
     */
    public function on_plugins_loaded() {

		// Load plugin's textdomain.
		load_plugin_textdomain( 'spga-elementor' );

		// Check compatibility and then hook in.
        if ( $this->is_compatible() ) {
            add_action( 'elementor/init', array( $this, 'register_widgets' ) );
			add_action( 'elementor/elements/categories_registered', array( $this, 'add_spga_widget_category' ) );
        }
    }

    /**
     * Register widgets
     */
    public function register_widgets() {
		if ( version_compare( ELEMENTOR_VERSION, '3.5.0', '>=' ) ) {
			Plugin::instance()->widgets_manager->register( new SPGA_Widget() );
		} else {
			Plugin::instance()->widgets_manager->register_widget_type( new SPGA_Widget() );
		}
    }

	/**
	 * Add gridly widget category
	 */
	public function add_spga_widget_category( $elements_manager ) {
		$elements_manager->add_category(
			'spga-elementor',
			array(
				'title' => __( 'SPGA Grids', 'spga-elementor' ),
				'icon'  => 'fa fa-plug',
			)
		);
	}

    /**
     * Is compatible
	 * 
	 * @return boolean true|false
     */
    public function is_compatible() {
        // Check if Elementor installed and activated.
        if ( ! did_action( 'elementor/loaded' ) ) {
            add_action( 'admin_notices', array( $this, 'admin_notice_missing_main_plugin' ) );
            return false;
        }

        // Check for required Elementor version.
        if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
            add_action( 'admin_notices', array( $this, 'admin_notice_minimum_elementor_version' ) );
            return false;
        }

        // Check for required PHP version.
        if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
            add_action( 'admin_notices', array( $this, 'admin_notice_minimum_php_version' ) );
            return false;
        }

        return true;
    }

    /**
	 * Admin notice for checking Elementor base plugin
	 */
	public function admin_notice_missing_main_plugin() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '%1$s requires %2$s to be installed and activated.', 'spga-elementor' ),
			'<strong>' . esc_html__( 'Stunning Post Grids Addon for Elementor', 'spga-elementor' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'spga-elementor' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Admin notice for elementor version check
	 */
	public function admin_notice_minimum_elementor_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '%1$s requires %2$s version %3$s or greater.', 'spga-elementor' ),
			'<strong>' . esc_html__( 'Stunning Post Grids Addon for Elementor', 'spga-elementor' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'spga-elementor' ) . '</strong>',
			self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Admin notice for php version check
	 */
	public function admin_notice_minimum_php_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '%1$s requires %2$s version %3$s or greater.', 'spga-elementor' ),
			'<strong>' . esc_html__( 'Stunning Post Grids Addon for Elementor', 'spga-elementor' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'spga-elementor' ) . '</strong>',
			self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}
}