<?php
/**
 * Example
 *
 * @package WidgetHelper
 */

use Nilambar\WidgetHelper\Helper;
use Nilambar\WidgetHelper\Assets;

/**
 * Load widget assets.
 *
 * @since 1.0.0
 */
function theme_slug_load_widget_assets() {
	Assets::load_assets();
}

add_action( 'admin_enqueue_scripts', 'theme_slug_load_widget_assets' );

/**
 * Widget class.
 *
 * @since 1.0.0
 */
class Theme_Hello_World extends Helper {
	/**
	 * Constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		$args['id']    = 'theme-hello-world';
		$args['label'] = esc_html__( 'Hello World Widget', 'textdomain' );

		$args['widget'] = array(
			'classname'   => 'theme_hello_world',
			'description' => esc_html__( 'Hello world widget', 'textdomain' ),
		);

		$args['fields'] = array(
			'sample_title'   => array(
				'label' => esc_html__( 'Title:', 'textdomain' ),
				'type'  => 'text',
				'class' => 'widefat',
			),
			'sample_message' => array(
				'label' => esc_html__( 'Message:', 'textdomain' ),
				'type'  => 'textarea',
				'class' => 'widefat',
			),
			'sample_image'   => array(
				'label' => esc_html__( 'Image:', 'textdomain' ),
				'type'  => 'image',
			),
			'sample_color'   => array(
				'label'   => esc_html__( 'Color:', 'textdomain' ),
				'type'    => 'color',
				'default' => '#DDDDDD',
			),
		);

		parent::create_widget( $args );
	}

	/**
	 * Echo the widget content.
	 *
	 * @since 1.0.0
	 *
	 * @param array $args     Display arguments.
	 * @param array $instance Instance of the widget.
	 */
	public function widget( $args, $instance ) {
		// Fetch widget values.
		$values = $this->get_field_values( $instance );

		$values['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		echo $args['before_widget']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

		if ( ! empty( $values['title'] ) ) {
			echo $args['before_title'] . esc_html( $values['title'] ) . $args['after_title']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}

		// Display logic will be here.

		echo $args['after_widget']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

}

/**
 * Register widget.
 *
 * @since 1.0.0
 */
function theme_slug_custom_widgets_init() {
	register_widget( 'Theme_Hello_World' );
}

add_action( 'widgets_init', 'theme_slug_custom_widgets_init' );
