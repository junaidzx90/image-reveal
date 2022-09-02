<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.fiverr.com/junaidzx90
 * @since      1.0.0
 *
 * @package    Image_Reveal
 * @subpackage Image_Reveal/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Image_Reveal
 * @subpackage Image_Reveal/admin
 * @author     Developer Junayed <admin@easeare.com>
 */
class Image_Reveal_Admin {

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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/image-reveal-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		if(isset($_GET['page']) && $_GET['page'] === 'imgreveal-add-new'){
			wp_enqueue_media(  );
		}
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/image-reveal-admin.js', array( 'jquery' ), $this->version, false );

	}

	function admin_menu_pages(){
		add_menu_page( "Image Reveal", "Image Reveal", "manage_options", "image-reveal", [$this, "image_reveal_callback"], "dashicons-format-gallery", 45 );
		add_submenu_page( "image-reveal", "Add new", "Add new", "manage_options", "imgreveal-add-new", [$this, "add_new_image_reveal"], null );
	}

	function image_reveal_callback(){
		if(isset($_GET['page']) && $_GET['page'] === 'image-reveal' && isset($_GET['action']) && $_GET['action'] === 'edit' && isset($_GET['id'])){
			echo '<h3>Edit Raveal</h3><hr>';
			require_once plugin_dir_path( __FILE__ )."partials/add-new-image-reveal.php";
		}else{
			$reveal = new Image_Reveal_Table();
			?>
			<div class="wrap" id="reveal-table">
				<h3 class="heading3">Image Reveal</h3>
				<hr>
				<form action="" method="post">
				<?php $reveal->prepare_items(); ?>
				<?php $reveal->display(); ?>
				</form>
			</div>
			<?php
		}
	}

	function add_new_image_reveal(){
		echo '<h3>New Raveal</h3><hr>';
		require_once plugin_dir_path( __FILE__ )."partials/add-new-image-reveal.php";
	}
}
