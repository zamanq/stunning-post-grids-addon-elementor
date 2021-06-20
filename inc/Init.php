<?php
/**
 * Handles initialization of classes
 *
 * @package Gridly
 */

namespace Gridly;

defined( 'ABSPATH' ) || exit;

/**
 * Init class
 */
final class Init {

	/**
	 * Get services
	 *
	 * @return array full list of classes
	 */
	public static function get_services() {
		return array(
			Setup\Setup::class,
			Setup\Enqueue::class,
		);
	}

	/**
	 * Register services
	 */
	public static function register_services() {
		foreach ( self::get_services() as $class ) {
			$service = self::instantiate( $class );
			if ( method_exists( $service, 'register' ) ) {
				$service->register();
			}
		}
	}

	/**
	 * Initialize the class
	 *
	 * @param class   class from the service array.
	 *
	 * @return class instance of the class
	 */
	private static function instantiate( string $class ) {
		return new $class();
	}
}
