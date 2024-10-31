<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 * @package    Popup_On_Click
 * @subpackage Popup_On_Click/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 * @package    Popup_On_Click
 * @subpackage Popup_On_Click/includes
 * @author     Yaroslav Grebnov <grebnov@gmail.com>
 */
class Popup_On_Click_i18n {


	/**
	 * Load the plugin text domain for translation.
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'popup-on-click',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}
	
}