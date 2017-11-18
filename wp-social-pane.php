<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://example.com
 * @since             1.0.0
 * @package           Wp_Social_Pane
 *
 * @wordpress-plugin
 * Plugin Name:       WP Social Pane
 * Plugin URI:        http://example.com
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Tang ZhenYu
 * Author URI:        http://example.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp-social-pane
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'PLUGIN_NAME_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wp-social-pane-activator.php
 */
function activate_wp_social_pane() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-social-pane-activator.php';
	Wp_Social_Pane_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wp-social-pane-deactivator.php
 */
function deactivate_wp_social_pane() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-social-pane-deactivator.php';
	Wp_Social_Pane_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wp_social_pane' );
register_deactivation_hook( __FILE__, 'deactivate_wp_social_pane' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wp-social-pane.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wp_social_pane() {

	$plugin = new Wp_Social_Pane();
	$plugin->run();

}
run_wp_social_pane();
