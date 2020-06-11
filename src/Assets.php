<?php
/**
 * Assets
 *
 * @author    Nilambar Sharma <nilambar@outlook.com>
 * @copyright 2020 Nilambar Sharma
 *
 * @package WidgetHelper
 */

namespace Nilambar\WidgetHelper;

/**
 * Assets class.
 *
 * @since 1.0.0
 */
class Assets {

	/**
	 * An instances.
	 *
	 * @static
	 * @access private
	 * @since 1.0.1
	 * @var array
	 */
	private static $instance = null;

	/**
	 * Load assets.
	 *
	 * @since 1.0.0
	 *
	 * @param string $type Type.
	 */
	public static function load_assets( $type = 'parent-theme' ) {
		self::get_instance()->load_all_assets( $type );
	}

	/**
	 * Load all assets.
	 *
	 * @since 1.0.0
	 *
	 * @param string $type Type.
	 */
	public function load_all_assets( $type ) {
		$base_url = $this->get_base_url( $type );

		$asset_url = $base_url . '/vendor/ernilambar/widget-helper';

		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'wp-color-picker' );
		wp_enqueue_media();

		wp_enqueue_style( 'widget-helper', $asset_url . '/public/css/widgets.css', array(), '1.0.0' );
		wp_enqueue_script( 'widget-helper', $asset_url . '/public/js/widgets.js', array( 'jquery', 'wp-color-picker' ), '1.0.0', true );
	}

	/**
	 * Get base URL.
	 *
	 * @since 1.0.0
	 *
	 * @param string $type Type.
	 * @return string Base URL.
	 */
	private function get_base_url( $type ) {
		$url = '';

		switch ( $type ) {
			case 'parent-theme':
				$url = get_template_directory_uri();
				break;

			case 'child-theme':
				$url = get_stylesheet_directory_uri();
				break;

			case 'plugin':
				$url = plugins_url();
				break;

			default:
				break;
		}

		return $url;
	}

	/**
	 * Get class instance.
	 *
	 * @since 1.0.0
	 *
	 * @return Assets Class instance.
	 */
	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new Assets();
		}

		return self::$instance;
	}

}
