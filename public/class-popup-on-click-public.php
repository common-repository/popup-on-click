<?php

/**
 * The public-facing functionality of the plugin.
 * @package    Popup_On_Click
 * @subpackage Popup_On_Click/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Popup_On_Click
 * @subpackage Popup_On_Click/public
 * @author     Yaroslav Grebnov <grebnov@gmail.com>
 */
class Popup_On_Click_Public {

	/**
	 * The ID of this plugin.
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Load the latest jQuery version
	 */
	public function load_latest_jquery() {

		wp_deregister_script('jquery');
		wp_register_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js', array(), null, false);
		wp_enqueue_script('jquery');

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/popup-on-click-public.js', array( 'jquery' ), $this->version, true );

	}

	/**
	 * Enable Bootstrap js and css, jQuery
	 */
	public function enable_bootstrap() {       
		// Bootstrap js
	    if (get_option('popup_on_click_enable_bootstrap')) {
	    wp_register_script('popup_on_click_bootstrap', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', array( 'jquery' ));
	    wp_enqueue_script('popup_on_click_bootstrap');
		}
		
	    // css
	    wp_register_style('popup_on_click_bootstrap', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css');
	    wp_enqueue_style('popup_on_click_bootstrap');
	}

	/**
	 * Process popup_on_click shortcode
	 *
	 * @param   array	$atts		The attributes from the shortcode
	 *
	 * @uses	get_option, do_shortcode
	 *
	 * @return	mixed	$output		Output of the buffer
	 */
	public function popup_on_click_shortcode($atts = [], $content = null) {
	    $content_shortcode = get_option('popup_on_click_content_shortcode');
	    
	    if (get_option('popup_on_click_enable_animation') == 1) {
	    	$modal_class = "modal fade";
	    }
	    else {
	    	$modal_class = "modal";
	    }
	    
	    $popup_title = get_option('popup_on_click_popup_title');
	    
			 
		$output='<div id="popupOnClick" class="' . esc_html($modal_class) . '" tabindex="-1" role="dialog" aria-labelledby="popupOnClickLabel">
				<div class="modal-dialog" role="document">
    				<div class="modal-content">
			  			<div class="modal-header">
			    			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			    			<h3 class="modal-title" id="popupOnClickLabel">' . esc_html($popup_title) . '</h3>
			  			</div>
			  			<div class="modal-body">';
		$output.= do_shortcode(esc_html($content_shortcode));
		$output.='</div>
			  			<div class="modal-footer">
			  				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			  			</div>
			  		</div>
			  	</div>
			</div>';

		$output.='<a href="#popupOnClick" data-toggle="modal" data-target="#popupOnClick">' . $content . '</a>';

	    return $output;
    	}

	/**
	* Register popup_on_click shortcode
	*/
	 
	public function register_shortcodes() {
		add_shortcode( 'popup_on_click', array( $this, 'popup_on_click_shortcode' ) );
	}

}