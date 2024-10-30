<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://chetansatasiya.com/blog
 * @since      1.0.0
 *
 * @package    Cs_Require_Featured_Image_To_Publish_Posts
 * @subpackage Cs_Require_Featured_Image_To_Publish_Posts/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Cs_Require_Featured_Image_To_Publish_Posts
 * @subpackage Cs_Require_Featured_Image_To_Publish_Posts/admin
 * @author     Chetan Satasiya <chetansatasiya88@gmail.com>
 */
class Cs_Require_Featured_Image_To_Publish_Posts_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Cs_Require_Featured_Image_To_Publish_Posts_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Cs_Require_Featured_Image_To_Publish_Posts_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/cs-require-featured-image-to-publish-posts-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Cs_Require_Featured_Image_To_Publish_Posts_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Cs_Require_Featured_Image_To_Publish_Posts_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/cs-require-featured-image-to-publish-posts-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * @since 1.0.0
	 * @author Chetan Satasiya
	 */
	public function cs_thumbnail_error() {
		// check if the transient is set, and display the error message
		if ( get_transient( "cs_has_post_thumbnail" ) == "no" ) {
			echo "<div id='message' class='error'><p><strong>You must add a Featured Image before publishing this. Don't panic, your post is saved.</strong></p></div>";
			delete_transient( "cs_has_post_thumbnail" );
		}
	}

	/**
	 * @param $post_id
	 * @since 1.0.0
	 * @author Chetan Satasiya
	 */
	public function cs_check_thumbnail( $post_id ) {

		//Check it's not an auto save routine
		if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE )
			return;

		//Perform permission checks! For example:
		if ( !current_user_can('edit_post', $post_id) )
			return;

		// change to any custom post type
		if( get_post_type($post_id) != 'post' )
			return;

		if ( ! has_post_thumbnail( $post_id ) ) {
			// set a transient to show the users an admin message
			set_transient( "cs_has_post_thumbnail", "no" );
			// unhook this function so it doesn't loop infinitely
			remove_action('save_post', 'cs_check_thumbnail');
			// update the post set it to draft
			wp_update_post(array('ID' => $post_id, 'post_status' => 'draft'));

			add_action('save_post', 'cs_check_thumbnail');
		} else {
			delete_transient( "cs_has_post_thumbnail" );
		}
	}

}
