<?php
/**
 * @package           Popup_On_Click
 *
 * @wordpress-plugin
 * Plugin Name:       Popup on Click
 * Description:       Plugin provides a possibility to display content in a popup window after user clicks on a triggering link
 * Version:           1.0.0
 * Author:            Yaroslav Grebnov
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       popup-on-click
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Defined internationalization, admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-popup-on-click.php';

/**
 * Begins execution of the plugin.
 *
 */
function run_popup_on_click() {

	$plugin = new Popup_On_Click();
	$plugin->run();
}
run_popup_on_click();