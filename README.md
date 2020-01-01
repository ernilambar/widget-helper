# Widget Helper

Simple helper library which helps to create widgets in WordPress in fast and east way.

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

You can now use helper class.
