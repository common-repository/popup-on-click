=== Popup on Click ===
Contributors: ygrebnov
Donate link: https://www.paypal.me/yaroslavgrebnov
Tags: popup-on-click, popup on click, popup, pop up, pop-up, popup window, fade in popup, modal, bootstrap modal
Requires at least: 4.0
Tested up to: 4.8
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Plugin provides a possibility to display content in a popup window after user clicks on a triggering link.

== Description ==

Plugin provides a possibility to display content in a popup window after user clicks on a triggering link. 

Popup window content is displayed according to the shortcut which should be provided at the plugin settings page `Settings` > `Popup on Click`. For more information on shortcodes please refer to the [Wordpress documentation corresponding section](https://en.support.wordpress.com/shortcodes/).

Popup window is a Bootstrap modal. For more details on Bootstrap modals please refer to the [Bootstrap documentation corresponding section](http://getbootstrap.com/javascript/#modals).

Popup triggering link is created by placing [popup_on_click] shortcode inside a post, a page, or a custom post type. For more information please refer to this plugin `Usage` section.

== Installation ==

For detailed installation instructions, please read the [standard installation procedure for WordPress plugins](http://codex.wordpress.org/Managing_Plugins#Installing_Plugins).

In WordPress:

1. Go to `Plugins` > `Add New` > search for `popup on click`
2. Press `Install Now` for the Popup on Click plugin
3. Press `Activate Plugin`

To install manually instead:

1. Upload the `/popup-on-click/` directory and its contents to `/wp-content/plugins/`.
2. Login to your WordPress installation and activate the plugin through the `Plugins` menu.
3. Configure the plugin at `Settings` > `Popup on Click` page.

== Usage ==

= Plugin configuration =

1. Plugin can be configured at `Settings` > `Popup on Click` page.
2. `Popup content shortcode` field should contain the shortcode for the content which will be displayed in a popup window. This value should be a valid registered shortcode. Examples: `[gallery]`, `[gallery title="My gallery"]`, `[gallery]something[/gallery]`. For more information on shortcodes please refer to the [Wordpress documentation corresponding section](https://en.support.wordpress.com/shortcodes/).
Please note that submitting a nested shortcode (like `[[gallery]]`) will result in `[gallery]` string being displayed inside a popup.
3. 'Popup title' field can contain the popup title, or can be left empty. Please enter only plain text into this field.
4. Tick the `Enable Bootstrap js file loading` checkbox if the Bootstrap js file is not loaded by your theme or any other plugin.
Loading this file more than one time is also not good, so leave this checkbox empty if the file is loaded by the theme or any other plugin.
5. Tick the `Enable popup animation` checkbox to enable the popup animated (fade in effect) appearence on the screen.

= Popup triggering link = 

1. Popup triggering link is created by placing `[popup_on_click]`<triggering element>`[/popup_on_click]` inside a post, a page, or a custom post type.
There may be more than one triggering link (even with different triggering elements) at the same post, page, or custom post type.
2. Text, image (<img />), or button (<button></button>) can be a `triggering element` inside the popup triggering link.
So, the triggering link can look like:
* `[popup_on_click]Click here[/popup_on_click]`,
* `[popup_on_click]<button>Click here</button>[/popup_on_click]`,
* `[popup_on_click]<img src="my_image_src" />[/popup_on_click]`.
3. Popup triggering link cannot be placed inside another popup, if the latter is also a Bootstrap modal. This restriction is imposed by Bootstrap. For more details please refer to the [Bootstrap documentation corresponding section](http://getbootstrap.com/javascript/#modals).

== Troubleshooting ==

= Nothing happens after I click on the popup triggering link =

Most likely, the Bootstrap js file is not loaded at your page. Please check the `Enable Bootstrap js file loading` checkbox at `Settings` > `Popup on Click` page.

= My popup appears and immidiately disappeares after I click on the triggering link =

Most likely, the Bootstrap js file is loaded more than once at your page (by this plugin and by your theme or some other plugin). Please uncheck the `Enable Bootstrap js file loading` checkbox at `Settings` > `Popup on Click` page.

= Only an image is loaded after I click on a triggering link with an <img /> as a triggering element =

It is likely, that an <a></a> tag is wrapping your <img /> one. Please check you post (page or custom post type) `Text` tab and make sure that there is only <img /> tag between `[popup_on_click]` and `[/popup_on_click]`. Like here: `[popup_on_click]<img src="my_image_src" />[/popup_on_click]`. 

== Changelog ==

= 1.0.0 =

* Initial release