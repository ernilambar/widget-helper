# Widget Helper

Simple helper library which helps to create WordPress widgets in fast and east way.

## Requirements

* WordPress 5.1+.
* PHP 5.6+.
* [Composer](https://getcomposer.org/) for managing PHP dependencies.

## Installation

First, you'll need to open your command line tool and change directories to your theme folder.

```bash
cd path/to/wp-content/themes/<your-theme-name>
```

Then, use Composer to install the package.

```bash
composer require ernilambar/widget-helper
```

Assuming you're not already including the Composer autoload file for your theme and are shipping this as part of your theme package, you'll want something like the following bit of code in your theme's `functions.php` to autoload this package (and any others).

The Composer autoload file will automatically load up the package for you and make its code available for you to use.

```php
if ( file_exists( get_parent_theme_file_path( 'vendor/autoload.php' ) ) ) {
  require_once( get_parent_theme_file_path( 'vendor/autoload.php' ) );
}
```

Package comes with the JS and CSS needed for the widgets fields. You can enqueue assets like given in the example below.

## Usage

You can create your new widget with extending the helper class.

```php
use Nilambar\WidgetHelper\Helper;

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
      'title'   => array(
        'label' => esc_html__( 'Title:', 'textdomain' ),
        'type'  => 'text',
        'class' => 'widefat',
      ),
      'message' => array(
        'label' => esc_html__( 'Message:', 'textdomain' ),
        'type'  => 'textarea',
        'class' => 'widefat',
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
    $values = $this->get_field_values( $instance );

    $values['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

    echo $args['before_widget'];

    if ( ! empty( $values['title'] ) ) {
      echo $args['before_title'] . esc_html( $values['title'] ) . $args['after_title'];
    }

    echo wp_kses_post( $values['message'] );

    echo $args['after_widget'];
  }

}

function theme_slug_custom_widgets_init() {
  register_widget( 'Theme_Hello_World' );
}

add_action( 'widgets_init', 'theme_slug_custom_widgets_init' );
```

### Available fields

* Text
* URL
* Email
* Number
* Checkbox
* Radio
* Radio Image
* Color
* Select
* Dropdown Pages
* Dropdown Taxonomies
* Image
* Textarea
* Heading
* Message
* Separator

## Copyright and License

This project is licensed under the [MIT](http://opensource.org/licenses/MIT).

2020 &copy; [Nilambar Sharma](https://www.nilambar.net).
