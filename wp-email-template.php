<?php
/*
Plugin Name: WP Email Template LITE
Plugin URI: http://a3rev.com/shop/wp-email-template/
Description: This plugin automatically adds a professional, responsive, customizable, email browser optimized HTML template for all WordPress and WordPress plugin generated emails that are sent from your site to customers and admins. Works with any WordPress plugin including the e-commerce plugins WooCommerce and WP e-Commerce.
Version: 2.2.5
Requires at least: 4.5
Tested up to: 4.9.6
Author: a3rev Software
Author URI: https://a3rev.com/
Text Domain: wp-email-template
Domain Path: /languages
WC requires at least: 2.0.0
WC tested up to: 3.4.0
License: This software is under commercial license and copyright to A3 Revolution Software Development team

	WP Email Template plugin
	Copyright© 2011 A3 Revolution Software Development team

	A3 Revolution Software Development team
	admin@a3rev.com
	PO Box 1170
	Gympie 4570
	QLD Australia
*/
?>
<?php
define('WP_EMAIL_TEMPLATE_FILE_PATH', dirname(__FILE__));
define('WP_EMAIL_TEMPLATE_DIR_NAME', basename(WP_EMAIL_TEMPLATE_FILE_PATH));
define('WP_EMAIL_TEMPLATE_FOLDER', dirname(plugin_basename(__FILE__)));
define('WP_EMAIL_TEMPLATE_URL', untrailingslashit(plugins_url('/', __FILE__)));
define('WP_EMAIL_TEMPLATE_DIR', WP_PLUGIN_DIR . '/' . WP_EMAIL_TEMPLATE_FOLDER);
define('WP_EMAIL_TEMPLATE_NAME', plugin_basename(__FILE__));
define('WP_EMAIL_TEMPLATE_IMAGES_URL', WP_EMAIL_TEMPLATE_URL . '/assets/images');
define('WP_EMAIL_TEMPLATE_JS_URL', WP_EMAIL_TEMPLATE_URL . '/assets/js');
define('WP_EMAIL_TEMPLATE_CSS_URL', WP_EMAIL_TEMPLATE_URL . '/assets/css');
if (!defined("WP_EMAIL_TEMPLATE_AUTHOR_URI")) define("WP_EMAIL_TEMPLATE_AUTHOR_URI", "https://a3rev.com/shop/wp-email-template/");
if (!defined("WP_EMAIL_TEMPLATE_DOCS_URI")) define("WP_EMAIL_TEMPLATE_DOCS_URI", "http://docs.a3rev.com/user-guides/plugins-extensions/wordpress/wp-email-template/");

define( 'WP_EMAIL_TEMPLATE_KEY', 'wp_email_template' );
define( 'WP_EMAIL_TEMPLATE_VERSION', '2.2.5' );

/**
 * Load Localisation files.
 *
 * Note: the first-loaded translation file overrides any following ones if the same translation is present.
 *
 * Locales found in:
 * 		- WP_LANG_DIR/wp-email-template/wp-email-template-LOCALE.mo
 * 		- WP_LANG_DIR/plugins/wp-email-template-LOCALE.mo
 * 	 	- /wp-content/plugins/wp-email-template/languages/wp-email-template-LOCALE.mo (which if not found falls back to)
 */
function wp_email_template_plugin_textdomain() {
	$locale = apply_filters( 'plugin_locale', get_locale(), 'wp-email-template' );

	load_textdomain( 'wp-email-template', WP_LANG_DIR . '/wp-email-template/wp-email-template-' . $locale . '.mo' );
	load_plugin_textdomain( 'wp-email-template', false, WP_EMAIL_TEMPLATE_FOLDER . '/languages/' );
}

include ('admin/admin-ui.php');
include ('admin/admin-interface.php');

include ('admin/admin-pages/admin-email-template-page.php');
include ('admin/admin-pages/send-wp-emails-page.php');

include ('admin/admin-init.php');

include ('classes/class-send-wp-email-functions.php');
include ('classes/class-email-functions.php');
include ('classes/class-email-hook.php');
include ('classes/class-email-exclude-subject-data.php');
include ('admin/email-init.php');

/**
 * Call when the plugin is activated
 */
register_activation_hook(__FILE__, 'wp_email_template_install');

?>