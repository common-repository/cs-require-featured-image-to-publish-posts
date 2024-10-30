<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://chetansatasiya.com/blog
 * @since      1.0.0
 *
 * @package    Cs_Require_Featured_Image_To_Publish_Posts
 * @subpackage Cs_Require_Featured_Image_To_Publish_Posts/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Cs_Require_Featured_Image_To_Publish_Posts
 * @subpackage Cs_Require_Featured_Image_To_Publish_Posts/includes
 * @author     Chetan Satasiya <chetansatasiya88@gmail.com>
 */
class Cs_Require_Featured_Image_To_Publish_Posts_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'cs-require-featured-image-to-publish-posts',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
