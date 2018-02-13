<?php
/**
 * WP Email Template Uninstall
 *
 * Uninstalling deletes options, tables, and pages.
 *
 */
if( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) 
	exit();

$plugin_key = 'wp_email_template';

// Delete Google Font
delete_option( $plugin_key . '_google_api_key' . '_enable' );
delete_transient( $plugin_key . '_google_api_key' . '_status' );
delete_option( $plugin_key . '_google_font_list' );

if ( get_option( $plugin_key . '_clean_on_deletion' ) == 1 ) {
	delete_option( $plugin_key . '_google_api_key' );
	delete_option( $plugin_key . '_toggle_box_open' );
	delete_option( $plugin_key . '-custom-boxes' );

	delete_metadata( 'user', 0,  $plugin_key . '-' . 'plugin_framework_global_box' . '-' . 'opened', '', true );

    global $wpdb;

    delete_option('wp_email_template_general');
    delete_option('wp_email_template_style');
    delete_option('wp_email_template_style_header_image');
    delete_option('wp_email_template_style_header');
    delete_option('wp_email_template_style_body');
    delete_option('wp_email_template_style_footer');
    delete_option('wp_email_template_style_fonts');
    delete_option('wp_email_template_social_media');
    delete_option('wp_email_template_email_footer');

    delete_option('wp_et_send_wp_emails_general');
    delete_option('wp_et_smtp_provider_configuration');
    delete_option('wp_et_gmail_smtp_provider_configuration');
    delete_option('wp_et_mandrill_provider_configuration');
    delete_option('wp_email_template_test_send_email');

    delete_option($plugin_key . '_clean_on_deletion');

}