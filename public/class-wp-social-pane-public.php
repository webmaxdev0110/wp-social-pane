<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Wp_Social_Pane
 * @subpackage Wp_Social_Pane/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Wp_Social_Pane
 * @subpackage Wp_Social_Pane/public
 * @author     Tang ZhenYu <tang.zhenyu@toptal.com>
 */
class Wp_Social_Pane_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp_Social_Pane_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Social_Pane_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wp-social-pane-public.css', array(), $this->version, 'all' );
		wp_enqueue_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css' );

		$options = get_option( $this->plugin_name . '_options', $this->getDefaultOption() );
		$display_size = $options['display_size'];
		$icon_colors = $options['social-btn-color'];
		$custom_css = "
				.social-pane-section .social-pane-list li a{
					font-size: {$display_size}px;
				}

				.social-pane-section .social-pane-list li a.facebook {
					color: {$icon_colors['facebook']};
				}

				.social-pane-section .social-pane-list li a.twitter {
					color: {$icon_colors['twitter']};
				}

				.social-pane-section .social-pane-list li a.google {
					color: {$icon_colors['google']};
				}

				.social-pane-section .social-pane-list li a.pinterest {
					color: {$icon_colors['pinterest']};
				}

				.social-pane-section .social-pane-list li a.linkedin {
					color: {$icon_colors['linkedin']};
				}

				.social-pane-section .social-pane-list li a.whatsapp {
					color: {$icon_colors['whatsapp']};
				}";

		wp_register_style( 'social-pane-custom-style', false );
		wp_enqueue_style( 'social-pane-custom-style' );
		wp_add_inline_style( 'social-pane-custom-style', $custom_css );		
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp_Social_Pane_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Social_Pane_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wp-social-pane-public.js', array( 'jquery' ), $this->version, false );
	//	wp_enqueue_script( 'whatsapp', plugin_dir_url( __FILE__ ) . 'js/whatsapp.js');
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function render_social_pane($shortcode = false) {
		$options = get_option( $this->plugin_name . '_options', $this->getDefaultOption() );
		
		$post_types = $options['post-type'];
		if ( in_array(get_post_type(), $post_types) && is_singular( $post_types ) && $options ) {
			ob_start();
			include( plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/wp-social-pane-public-display.php' );
			$output = ob_get_contents();
			ob_end_clean();
			return $output;
		}
	}

	/**
	 * Filter title to add social pane
	 *
	 * @since    1.0.0
	 */
	public function render_shortcode() {
		if ( is_singular() && in_the_loop() ) {
			return $this -> render_social_pane(true);
		}
	}

	/**
	 * Filter title to add social pane
	 *
	 * @since    1.0.0
	 */
	public function filter_below_title($title) {
		if ( is_singular() && in_the_loop() ) {
			return $title . $this -> render_social_pane();
		} else {
			return $title;
		}
	}

	/**
	 * Filter content to add social pane
	 *
	 * @since    1.0.0
	 */
	public function filter_after_content($content) {
		if ( is_singular() && in_the_loop() ) {
			return $content . $this -> render_social_pane();
		} else {
			return $content;
		}
	}

	/**
	 * Filter featured image to add social pane
	 *
	 * @since    1.0.0
	 */
	public function filter_inside_image($content) {
		if ( is_singular() && in_the_loop() ) {
			return $content . $this -> render_social_pane();
		} else {
			return $content;
		}
	}

	/**
	 * Show left floated
	 *
	 * @since    1.0.0
	 */
	public function filter_display_left() {
		echo $this -> render_social_pane();
	}

	/**
	 * Get Default Option value
	 * 
	 * @since		1.0.0
	 */
	public function getDefaultOption() {
		return array(
				"post-type" 		=> array ("post", "page"),
				"social-option" => array ("facebook", "twitter", "google", "pinterest", "linkedin", "whatsapp"),
				"display_size" 	=>	"16",
				"social-btn-color"=> array(
					"facebook"	=> "#3b5999",
					"twitter" 	=> "#55acee",
					"google" 		=> "#dd4b39",
					"pinterest" => "#bd081c",
					"linkedin" 	=> "#0077b5",
					"whatsapp" 	=> "#25d366"
				),
				"display-order" => array("facebook", "twitter", "google", "pinterest", "linkedin", "whatsapp"),
				"where_option"  => "below_title"
		);
	}

}
