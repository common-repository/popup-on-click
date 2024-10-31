<?php

/**
 * The admin-specific functionality of the plugin.
 * @package    Popup_On_Click
 * @subpackage Popup_On_Click/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Popup_On_Click
 * @subpackage Popup_On_Click/admin
 * @author     Yaroslav Grebnov <grebnov@gmail.com>
 */
class Popup_On_Click_Admin {

	/**
	 * The ID of this plugin.
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The options name to be used in this plugin
	 * @access 	private
	 * @var  	string 		$option_name 	Option name of this plugin
	 */
	private $option_name = 'popup_on_click';

	/**
	 * The version of this plugin.
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Add an options page under the Settings submenu.
	 */
	public function add_options_page() {
		$this->plugin_screen_hook_suffix = add_options_page(
			__( 'Popup on Click Settings', 'popup-on-click' ),
			__( 'Popup on Click', 'popup-on-click' ),
			'manage_options',
			$this->plugin_name,
			array( $this, 'display_options_page' )
		);
	}

	/**
	 * Render the options page for plugin
	 */
	public function display_options_page() {
		include_once 'partials/popup-on-click-admin-display.php';
	}
	 
	/**
	* Add settings action link to the plugins page
	*/	 
	public function add_action_links( $links ) {
		$settings_link = array(
			'<a href="' . admin_url( 'options-general.php?page=' . $this->plugin_name ) . '">' . __('Settings', $this->plugin_name) . '</a>',
		);
		return array_merge( $settings_link, $links );
	}
	 
	/**
	 * Register all related settings of this plugin
	 */
	public function register_setting() {
		// Shortcode section
		add_settings_section(
			$this->option_name . '_shortcode',
			__( 'Shortcode', 'popup-on-click' ),
			array( $this, $this->option_name . '_shortcode_cb' ),
			$this->plugin_name
		);

		// Shortcode field
		add_settings_field(
			$this->option_name . '_content_shortcode',
			__( 'Popup content shortcode', 'popup-on-click' ),
			array( $this, $this->option_name . '_content_shortcode_cb' ),
			$this->plugin_name,
			$this->option_name . '_shortcode',
			array( 'label_for' => $this->option_name . '_content_shortcode' )
		);

		// Title section
		add_settings_section(
			$this->option_name . '_title',
			__( 'Title', 'popup-on-click' ),
			array( $this, $this->option_name . '_title_cb' ),
			$this->plugin_name
		);

		// Title field
		add_settings_field(
			$this->option_name . '_popup_title',
			__( 'Popup title', 'popup-on-click' ),
			array( $this, $this->option_name . '_popup_title_cb' ),
			$this->plugin_name,
			$this->option_name . '_title',
			array( 'label_for' => $this->option_name . '_popup_title' )
		);

		// Bootstrap js section
		add_settings_section(
			$this->option_name . '_bootstrap',
			__( 'Bootstrap js file loading', 'popup-on-click' ),
			array( $this, $this->option_name . '_bootstrap_cb' ),
			$this->plugin_name
		);

		// Enable Bootstrap js file loading field
		add_settings_field(
			$this->option_name . '_enable_bootstrap',
			__( 'Enable Bootstrap js file loading', 'popup-on-click' ),
			array( $this, $this->option_name . '_enable_bootstrap_cb' ),
			$this->plugin_name,
			$this->option_name . '_bootstrap',
			array( 'label_for' => $this->option_name . '_enable_bootstrap' )
		);

		// Popup animation
		add_settings_section(
			$this->option_name . '_animation',
			__( 'Animation', 'popup-on-click' ),
			array( $this, $this->option_name . '_animation_cb' ),
			$this->plugin_name
		);

		// Enable popup animation field
		add_settings_field(
			$this->option_name . '_enable_animation',
			__( 'Enable popup animation', 'popup-on-click' ),
			array( $this, $this->option_name . '_enable_animation_cb' ),
			$this->plugin_name,
			$this->option_name . '_animation',
			array( 'label_for' => $this->option_name . '_enable_animation' )
		);

		register_setting( $this->plugin_name, $this->option_name . '_content_shortcode', array( $this, $this->option_name . '_sanitize_content_shortcode' ) );
		register_setting( $this->plugin_name, $this->option_name . '_popup_title', array( $this, $this->option_name . '_sanitize_popup_title' ) );
		register_setting( $this->plugin_name, $this->option_name . '_enable_bootstrap' );
		register_setting( $this->plugin_name, $this->option_name . '_enable_animation' );		
	}

	/**
	 * Render the text for the Shortcode section
	 */
	public function popup_on_click_shortcode_cb() {
		?>
		<p><?php esc_html_e( 'Please enter the shortcode for the content which will be displayed in popup.', 'popup-on-click' ); ?></p>
		<?php
	}

	/**
	 * Render the content shortcode input for this plugin
	 */
	public function popup_on_click_content_shortcode_cb() {
		$content_shortcode = get_option( $this->option_name . '_content_shortcode' );
		?>
		<input type="text" size="100" maxlength="100" name="<?php echo esc_html($this->option_name); ?>_content_shortcode" id="<?php echo esc_html($this->option_name); ?>_content_shortcode" value="<?php echo esc_html($content_shortcode); ?>">
		<?php
	}

	/**
	 * Render the text for the Title section
	 */
	public function popup_on_click_title_cb() {
		?>
		<p><?php esc_html_e( 'Please enter the popup title (optional, can be left blank). Please enter only plain text into this field', 'popup-on-click' ); ?></p>
		<?php
	}

	/**
	 * Render the popup title input for this plugin
	 */
	public function popup_on_click_popup_title_cb() {
		$popup_title = get_option( $this->option_name . '_popup_title' );
		?>
		<input type="text" size="100" maxlength="100" name="<?php echo esc_html($this->option_name); ?>_popup_title" id="<?php echo esc_html($this->option_name); ?>_popup_title" value="<?php echo esc_html($popup_title); ?>">
		<?php
	}

	/**
	 * Render the text for the Bootstrap section
	 */
	public function popup_on_click_bootstrap_cb() {
		?>
		<p><?php esc_html_e( 'Check the box to enable the Bootstrap js file loading.', 'popup-on-click' ); ?></p>
		<?php
	}

	/**
	 * Render the Bootstrap js file loading settings input for this plugin
	 */
	public function popup_on_click_enable_bootstrap_cb() {
		$enable_bootstrap = get_option( $this->option_name . '_enable_bootstrap' );
		?>
		<input type="checkbox" name="<?php echo esc_html($this->option_name); ?>_enable_bootstrap" id="<?php echo esc_html($this->option_name); ?>_enable_bootstrap" value="1" <?php checked(1, $enable_bootstrap, true); ?> />
		<?php
	}

	/**
	 * Render the text for the Animation section
	 */
	public function popup_on_click_animation_cb() {
		?>
		<p><?php esc_html_e( 'Check the box to enable popup animation.', 'popup-on-click' ); ?></p>
		<?php
	}

	/**
	 * Render the enable animation settings input for this plugin
	 */
	public function popup_on_click_enable_animation_cb() {
		$enable_animation = get_option( $this->option_name . '_enable_animation' );
		?>
		<input type="checkbox" name="<?php echo esc_html($this->option_name); ?>_enable_animation" id="<?php echo esc_html($this->option_name); ?>_enable_animation" value="1" <?php checked(1, $enable_animation, true); ?> />
		<?php
	}

	/**
	 * Check if the content shortcode is a valid registered shortcode; if not - display an error notice and sanitize the value before saving to database 
	 *
	 * @param  string $content_shortcode $_POST value
	 * @return string           Sanitized value
	 */
	public function popup_on_click_sanitize_content_shortcode( $content_shortcode ) {
		if (preg_match('/' . get_shortcode_regex() . '/', $content_shortcode)) {
			return $content_shortcode;
		}
		else {
			add_settings_error(
				'popup_on_click_content_shortcode', 
				'not_a_shortcode', 
				__( 'Your Shortcode field entry does not look like a valid registered shortcode. Please submit a correct one', 'popup-on-click')
			);
			return sanitize_text_field($content_shortcode);
		}
	}

	/**
	 * Sanitize the popup title value before being saved to database
	 *
	 * @param  string $popup_title $_POST value
	 * @return string           Sanitized value
	 */
	public function popup_on_click_sanitize_popup_title( $popup_title ) {
		$sanitized_popup_title = sanitize_text_field($popup_title);
		if (esc_html($popup_title) != $sanitized_popup_title) {
			add_settings_error(
				'popup_on_click_popup_title', 
				'invalid_popup_title_input', 
				__( 'Please add only plain text into the Popup title field', 'popup-on-click')
			);
		}
		return $sanitized_popup_title;
	}

}