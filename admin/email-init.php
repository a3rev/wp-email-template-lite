<?php

function wp_email_template_install(){
	update_option('a3rev_wp_email_template_version', '2.3.6');
	update_option('a3rev_wp_email_template_lite_version', WP_EMAIL_TEMPLATE_VERSION );

	global $wp_email_template_exclude_subject_data;
	$wp_email_template_exclude_subject_data->install_database();

	// Remove house keeping option of another version
	delete_option( $wp_email_template_admin_init->plugin_name . '_clean_on_deletion' );

	global $wp_email_template_admin_init;
	delete_metadata( 'user', 0, $wp_email_template_admin_init->plugin_name . '-' . 'plugin_framework_global_box' . '-' . 'opened', '', true );

	update_option('a3rev_wp_email_just_installed', true);
}

/**
 * Load languages file
 */
function wp_email_template_init() {
	if ( get_option('a3rev_wp_email_just_installed') ) {
		delete_option('a3rev_wp_email_just_installed');

		// Set Settings Default from Admin Init
		global $wp_email_template_admin_init;
		$wp_email_template_admin_init->set_default_settings();
	}

	wp_email_template_plugin_textdomain();
}

// Add language
add_action('init', 'wp_email_template_init');

// Add custom style to dashboard
add_action( 'admin_enqueue_scripts', array( 'WP_Email_Template_Hook_Filter', 'a3_wp_admin' ) );

// Add extra link on left of Deactivate link on Plugin manager page
add_action('plugin_action_links_'.WP_EMAIL_TEMPLATE_NAME, array('WP_Email_Template_Hook_Filter', 'settings_plugin_links') );

// Add admin sidebar menu css
add_action( 'admin_enqueue_scripts', array( 'WP_Email_Template_Hook_Filter', 'admin_sidebar_menu_css' ) );

// Add text on right of Visit the plugin on Plugin manager page
add_filter( 'plugin_row_meta', array('WP_Email_Template_Hook_Filter', 'plugin_extra_links'), 10, 2 );


// Need to call Admin Init to show Admin UI
global $wp_email_template_admin_init;
$wp_email_template_admin_init->init();

// Add upgrade notice to Dashboard pages
add_filter( $wp_email_template_admin_init->plugin_name . '_plugin_extension_boxes', array( 'WP_Email_Template_Hook_Filter', 'plugin_extension_box' ) );

add_action('wp_ajax_preview_wp_email_template', array('WP_Email_Template_Hook_Filter', 'preview_wp_email_template') );
add_action('wp_ajax_nopriv_preview_wp_email_template', array('WP_Email_Template_Hook_Filter', 'preview_wp_email_template') );

// Compatibility with Formidable plugin with disable the encoding subject title
add_filter( 'frm_encode_subject', array( 'WP_Email_Template_Hook_Filter', 'disable_formidable_encode_subject_title' ), 10, 2 );

// Add marker at start of email template header from woocommerce
add_action('woocommerce_email_header', array('WP_Email_Template_Hook_Filter', 'woo_email_header_marker_start'), 1 );

// Add marker at end of email template header from woocommerce
add_action('woocommerce_email_header', array('WP_Email_Template_Hook_Filter', 'woo_email_header_marker_end'), 100 );

// Add marker at start of email template footer from woocommerce
add_action('woocommerce_email_footer', array('WP_Email_Template_Hook_Filter', 'woo_email_footer_marker_start'), 1 );

// Add marker at end of email template footer from woocommerce
add_action('woocommerce_email_footer', array('WP_Email_Template_Hook_Filter', 'woo_email_footer_marker_end'), 100 );

// Apply the email template to wp_mail of wordpress
add_filter('wp_mail_content_type', array('WP_Email_Template_Hook_Filter', 'set_content_type'), 20);
add_filter('wp_mail', array('WP_Email_Template_Hook_Filter', 'change_wp_mail'), 20);

// Filter to change the default email address wordpress@domain.com and default from name 'WordPress' for Default Provider
add_filter('wp_mail_from', array('WP_Email_Template_Hook_Filter', 'change_default_wp_mail_from'), 1);
add_filter('wp_mail_from_name', array('WP_Email_Template_Hook_Filter', 'change_default_wp_mail_from_name'), 1);

// For multipart messages
add_action( 'phpmailer_init', array( 'WP_Email_Template_Hook_Filter', 'handle_multipart' ) );

// Check upgrade functions
add_action('init', 'a3rev_wp_email_template_lite_upgrade_plugin');
function a3rev_wp_email_template_lite_upgrade_plugin () {

	if(version_compare(get_option('a3rev_wp_email_template_version'), '1.0.4') === -1){
		update_option('a3rev_wp_email_template_version', '1.0.4');

		$wp_email_template_settings = get_option('wp_email_template_settings');
		if (isset($wp_email_template_settings['header_image'])) {
			update_option('wp_email_template_header_image', $wp_email_template_settings['header_image']);
		}
	}

	//Upgrade to version 1.0.8
	if ( version_compare( get_option( 'a3rev_wp_email_template_version'), '1.0.8' ) === -1 ) {
		update_option( 'a3rev_wp_email_template_version', '1.0.8' );

		include( WP_EMAIL_TEMPLATE_DIR. '/includes/updates/wp-email-update-1.0.8.php' );
	}

	//Upgrade to version 1.1.0
	if ( version_compare( get_option( 'a3rev_wp_email_template_lite_version'), '1.1.0' ) === -1 ) {
		update_option( 'a3rev_wp_email_template_lite_version', '1.1.0' );

		$wp_email_template_style = get_option( 'wp_email_template_style' );
		if ( isset( $wp_email_template_style['email_footer'] ) )
			update_option( 'wp_email_template_email_footer', $wp_email_template_style['email_footer'] );
	}

	if ( version_compare( get_option( 'a3rev_wp_email_template_lite_version'), '1.2.0' ) === -1 ) {
		update_option( 'a3rev_wp_email_template_lite_version', '1.2.0' );

		include( WP_EMAIL_TEMPLATE_DIR. '/includes/updates/wp-email-update-1.2.0.php' );

		global $wp_email_template_admin_init;
		$wp_email_template_admin_init->set_default_settings();
	}

	if ( version_compare( get_option( 'a3rev_wp_email_template_lite_version'), '1.3.3' ) === -1 ) {
		update_option( 'a3rev_wp_email_template_lite_version', '1.3.3' );

		include( WP_EMAIL_TEMPLATE_DIR. '/includes/updates/wp-email-update-1.3.3.php' );

		global $wp_email_template_admin_init;
		$wp_email_template_admin_init->set_default_settings();
	}

	if ( version_compare( get_option( 'a3rev_wp_email_template_lite_version'), '1.4.0' ) === -1 ) {
		update_option( 'a3rev_wp_email_template_lite_version', '1.4.0' );

		include( WP_EMAIL_TEMPLATE_DIR. '/includes/updates/wp-email-update-1.4.0.php' );
	}

	if ( version_compare( get_option( 'a3rev_wp_email_template_lite_version'), '1.8.0' ) === -1 ) {
		update_option( 'a3rev_wp_email_template_lite_version', '1.8.0' );

		include( WP_EMAIL_TEMPLATE_DIR. '/includes/updates/wp-email-update-1.8.0.php' );
	}

	if ( version_compare( get_option( 'a3rev_wp_email_template_lite_version'), '2.1.0' ) === -1 ) {
		update_option( 'a3rev_wp_email_template_lite_version', '2.1.0' );

		include( WP_EMAIL_TEMPLATE_DIR. '/includes/updates/wp-email-update-2.1.0.php' );
	}

	update_option('a3rev_wp_email_template_version', '2.3.6');
	update_option('a3rev_wp_email_template_lite_version', WP_EMAIL_TEMPLATE_VERSION );
}

?>