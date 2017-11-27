<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Wp_Social_Pane
 * @subpackage Wp_Social_Pane/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wp_Social_Pane
 * @subpackage Wp_Social_Pane/admin
 * @author     Tang ZhenYu <tang.zhenyu@toptal.com>
 */
class Wp_Social_Pane_Admin {

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
		 * defined in Wp_Social_Pane_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Social_Pane_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wp-social-pane-admin.css', array(), $this->version, 'all' );
		wp_enqueue_style( 'wp-color-picker' );
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function admin_enqueue_scripts() {

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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wp-social-pane-admin.js', array( 'jquery', 'wp-color-picker', 'jquery-ui-sortable' ), $this->version, false );
		
		// enqeue font awesome
		

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		
	}

	/**
	 * Add Option page to the admin area.
	 *
	 * @since    1.0.0
	 */
	public function add_plugin_admin_menu() {
		add_options_page( 'Social Pane Setting', 'Social Pane', 'manage_options', $this->plugin_name . '-options', array($this, 'display_plugin_setup_page'));
	}

	/**
	 * Add settings action link to the plugins page.
	 *
	 * @since    1.0.0
	 */

	public function add_action_links( $links ) {
		/*
		 *  Documentation : https://codex.wordpress.org/Plugin_API/Filter_Reference/plugin_action_links_(plugin_file_name)
		 */

		$settings_link = array(
			'<a href="' . admin_url( 'options-general.php?page=' . $this->plugin_name ) . '">' . __('Settings', $this->plugin_name) . '</a>',
		);
		return array_merge(  $settings_link, $links );
	}

	/**
	 * Register Settings Page
	 * 
	 * @since		1.0.0
	 */
	public function register_option_page() {
		register_setting(
			$this->plugin_name . '_options',
			$this->plugin_name . '_options',
			array( $this, 'settings_sanitize' )
		);

		add_settings_section(
			$this->plugin_name . '-display-options', // section
			apply_filters( $this->plugin_name . '-display-section-title', __( '', $this->plugin_name ) ),
			array( $this, 'display_options_section' ),
			$this->plugin_name . '-options'
		);

		add_settings_field(
			'display-section',
			apply_filters( $this->plugin_name . '-display-section', __( 'Show on', $this->plugin_name ) ),
			array( $this, 'display_section_option_field' ),
			$this->plugin_name . '-options',
			$this->plugin_name . '-display-options'
		);

		add_settings_field(
			'social-buttons',
			apply_filters( $this->plugin_name . '-social-buttons', __( 'Show Social Buttons', $this->plugin_name ) ),
			array( $this, 'social_buttons_option_field' ),
			$this->plugin_name . '-options',
			$this->plugin_name . '-display-options'
		);

		add_settings_field(
			'display-size',
			apply_filters( $this->plugin_name . '-display-size', __( 'Button Size', $this->plugin_name ) ),
			array( $this, 'display_size_option_field' ),
			$this->plugin_name . '-options',
			$this->plugin_name . '-display-options'
		);

		add_settings_field(
			'display-color',
			apply_filters( $this->plugin_name . '-display-color', __( 'Display Color', $this->plugin_name ) ),
			array( $this, 'display_color_option_field' ),
			$this->plugin_name . '-options',
			$this->plugin_name . '-display-options'
		);

		add_settings_field(
			'display-order',
			apply_filters( $this->plugin_name . '-display-order', __( 'Display Order', $this->plugin_name ) ),
			array( $this, 'display_order_option_field' ),
			$this->plugin_name . '-options',
			$this->plugin_name . '-display-options'
		);

		add_settings_field(
			'display-where',
			apply_filters( $this->plugin_name . '-display-where', __( 'Display', $this->plugin_name ) ),
			array( $this, 'display_where_option_field' ),
			$this->plugin_name . '-options',
			$this->plugin_name . '-display-options'
		);
	}

	/**
	 * Settings - Validates saved options
	 *
	 * @since 		1.0.0
	 * @param 		array 		$input 			array of submitted plugin options
	 * @return 		array 								array of validated plugin options
	 */
	public function settings_sanitize( $input ) {
		// Initialize the new array that will hold the sanitize values
		$new_input = array();

		if(isset($input)) {
			// Loop through the input and sanitize each of the values
			foreach ( $input as $key => $val ) {

				if(in_array($key, array('post-type', 'social-option', 'social-btn-color', 'display-order'))) { // dont sanitize array
					$new_input[ $key ] = $val;
				} else {
					$new_input[ $key ] = sanitize_text_field( $val );
				}
			}
		}

		return $new_input;
	}

	/**
	 * Render the settings page for this plugin.
	 *
	 * @since    1.0.0
	 */
	public function display_plugin_setup_page() {
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/wp-social-pane-admin-display.php';
	}

	/**
	 * Render Display Section Option Section
	 * 
	 * @since		1.0.0
	 */
	public function display_options_section() {
		echo 'Option Section';
	}

	/**
	 * Render Display Section Option field
	 * 
	 * @since		1.0.0
	 */
	public function display_section_option_field() {

		$options 	= get_option( $this->plugin_name . '_options', $this->getDefaultOption() );
		$option 	= array();

		if ( ! empty( $options['post-type'] ) ) {
			$option = $options['post-type'];
		}

		$args = array(
		   'public'   => true
		);
		$post_types = get_post_types( $args, 'names' );

		foreach ( $post_types as $post_type ) {
			if($post_type != 'attachment') {

				$checked = in_array($post_type, $option) ? 'checked="checked"' : ''; ?>
				<p>
					<input type="checkbox" id="<?php echo $this->plugin_name; ?>_options[post-type]" name="<?php echo $this->plugin_name; ?>_options[post-type][]" value="<?php echo esc_attr( $post_type ); ?>" <?php echo $checked; ?> />
		   		<?php echo $post_type; ?>			
		   	</p>
			<?php }
				
		}
	}
	
	/**
	 * Render Social Buttons Choice Option field
	 * 
	 * @since		1.0.0
	 */
	public function social_buttons_option_field() {

		$options 	= get_option( $this->plugin_name . '_options', $this->getDefaultOption() );
		$option 	= array();
		
		if ( ! empty( $options['social-option'] ) ) {
			$option = $options['social-option'];
		}

		$social_options = array(
			'facebook' 	=> 'fa-facebook-official',
			'twitter' 	=> 'fa-twitter',
			'google' 		=> 'fa-google-plus-official',
			'pinterest' => 'fa-pinterest',
			'linkedin' 	=> 'fa-linkedin-square',
			'whatsapp' 	=> 'fa-whatsapp'
		);

		foreach ( $social_options as $key => $social_icon ) {
			$checked = in_array($key, $option) ? 'checked="checked"' : ''; ?>
			<span class="social-option-item">
				<input type="checkbox" id="<?php echo $this->plugin_name; ?>_options[social-option]" name="<?php echo $this->plugin_name; ?>_options[social-option][]" value="<?php echo esc_attr( $key ); ?>" <?php echo $checked; ?> />
				<i class="fa fa-2x <?php echo $social_icon; ?>"></i>
			</span>
		<?php }
	}
	
	/**
	 * Render Display Social Button Size Option field
	 * 
	 * @since		1.0.0
	 */
	public function display_size_option_field() {
		$options 	= get_option( $this->plugin_name . '_options', $this->getDefaultOption() );
		
		if ( ! empty( $options['display_size'] ) ) {
			$option = $options['display_size'];
		}

		$display_sizes = array(
			'16' 	=> 'Small',
			'24' 	=> 'Medium',
			'32' 	=> 'Large'
		); ?>
		<select id="<?php echo $this->plugin_name; ?>_options[display_size]" name="<?php echo $this->plugin_name; ?>_options[display_size]">
		<?php	foreach ( $display_sizes as $key => $where ) {
			$checked = ($key == $option) ? 'selected="selected"' : ''; ?>
			<span>
				<option value="<?php echo esc_attr( $key ); ?>" <?php echo $checked; ?> />
					<?php echo $where; ?>
				</option>
			</span>
		<?php } ?>
		</select>
	<?php	}
	
	/**
	 * Render Display Social Button Color Option field
	 * 
	 * @since		1.0.0
	 */
	public function display_color_option_field() {
		$options 	= get_option( $this->plugin_name . '_options', $this->getDefaultOption() );
		$option 	= array();
		
		if ( ! empty( $options['social-btn-color'] ) ) {
			$option = $options['social-btn-color'];
		}

		$social_icons = array(
			'facebook' 	=> 'fa-facebook-official',
			'twitter' 	=> 'fa-twitter',
			'google' 		=> 'fa-google-plus-official',
			'pinterest' => 'fa-pinterest',
			'linkedin' 	=> 'fa-linkedin-square',
			'whatsapp' 	=> 'fa-whatsapp'
		);

		$social_options = array(
			'facebook' 	=> '#3b5999',
			'twitter' 	=> '#55acee',
			'google' 		=> '#dd4b39',
			'pinterest' => '#bd081c',
			'linkedin' 	=> '#0077B5',
			'whatsapp' 	=> '#25D366'
		);

		foreach ( $social_options as $key => $social_icon ) { 
			if ( isset($option[$key]) && $option[$key] != '') {
				$social_icon = $option[$key];
			} ?>
			<p>
				<input type="text" class="social-color-picker" id="<?php echo $this->plugin_name; ?>_options[social-btn-color]" name="<?php echo $this->plugin_name; ?>_options[social-btn-color][<?php echo $key; ?>]" value="<?php echo esc_attr( $social_icon ); ?>" data-default="<?php echo esc_attr( $social_options[$key] ); ?>" />
				<i class="fa fa-2x <?php echo $social_icons[$key]; ?>" style="color:<?php echo $social_icon; ?>"></i>
			</p>
		<?php } ?>
		<input type="button" class="button button-default" value="Reset" id="<?php echo $this->plugin_name; ?>_reset" />
	<?php }
	
	/**
	 * Render Display Social Button Order Option field
	 * 
	 * @since		1.0.0
	 */
	public function display_order_option_field() {
		$options 	= get_option( $this->plugin_name . '_options', $this->getDefaultOption() );
		$option 	= array();

		$social_icons = array(
			'facebook' 	=> 'fa-facebook-official',
			'twitter' 	=> 'fa-twitter',
			'google' 		=> 'fa-google-plus-official',
			'pinterest' => 'fa-pinterest',
			'linkedin' 	=> 'fa-linkedin-square',
			'whatsapp' 	=> 'fa-whatsapp'
		);

		if ( ! empty( $options['display-order'] ) ) {
			$option = $options['display-order'];
		} else {
			$option = array('facebook', 'twitter', 'google', 'pinterest', 'linkedin', 'whatsapp');
		}?>
		
		<ul id="display-order-sortable">
		<?php foreach ( $option as $social_icon ) { ?>
			<li>
				<input type="hidden" id="<?php echo $this->plugin_name; ?>_options[display-order]" name="<?php echo $this->plugin_name; ?>_options[display-order][]" value="<?php echo esc_attr( $social_icon ); ?>" />
				<i class="fa fa-2x <?php echo $social_icons[$social_icon]; ?>"></i>
			</li>
		<?php } ?>
		</ul>
		<div class="clear"></div>
		<p>Drag the icons to change order.</p>
	<?php }
	
	/**
	 * Render Display Social Button Placement Option field
	 * 
	 * @since		1.0.0
	 */
	public function display_where_option_field() {
		$options 	= get_option( $this->plugin_name . '_options', $this->getDefaultOption() );
		
		if ( ! empty( $options['where_option'] ) ) {
			$option = $options['where_option'];
		}

		$where_options = array(
			'below_title' 						=> 'Below the post title',
			'float_left' 						=> 'Floating on the left',
			'after_content' 				=> 'After the post content',
			'inside_feature_image' 	=> 'Inside the featured image'
		); ?>
		<select id="<?php echo $this->plugin_name; ?>_options[where_option]" name="<?php echo $this->plugin_name; ?>_options[where_option]">
		<?php	foreach ( $where_options as $key => $where ) {
			$checked = ($key == $option) ? 'selected="selected"' : ''; ?>
			<span>
				<option value="<?php echo esc_attr( $key ); ?>" <?php echo $checked; ?> />
					<?php echo $where; ?>
				</option>
			</span>
		<?php } ?>
		</select>
	<?php	}

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
