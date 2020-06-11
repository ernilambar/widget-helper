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

class Assets {

	// Hold the class instance.
	private static $instance = null;

	public static function load_assets( $type = 'parent-theme' ) {
		return self::get_instance()->load_all_assets( $type );
	}

	public static function get_instance() {
		if (self::$instance == null)
		{
			self::$instance = new Assets();
		}

		return self::$instance;
	}

	public function load_all_assets( $type ) {
		$base_url = $this->get_base_url( $type );

		$asset_url = $base_url . '/vendor/ernilambar/widget-helper';

		nspre( $asset_url );

		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'wp-color-picker' );
		wp_enqueue_media();

		wp_enqueue_style( 'widget-helper', $asset_url . '/public/css/widgets.css', array(), '1.0.0' );
		wp_enqueue_script( 'widget-helper', $asset_url . '/public/js/widgets.js', array('jquery', 'wp-color-picker'), '1.0.0' );
	}

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
}
