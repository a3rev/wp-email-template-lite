<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$wp_et_send_wp_emails_general = get_option( 'wp_et_send_wp_emails_general', array() );
if ( isset( $wp_et_send_wp_emails_general['enable_configure_email_sending_provider'] ) && 'yes' != $wp_et_send_wp_emails_general['enable_configure_email_sending_provider'] ) {
	$wp_et_send_wp_emails_general['email_sending_option'] = 'local';

	update_option('wp_et_send_wp_emails_general', $wp_et_send_wp_emails_general);
}