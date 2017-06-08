<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$wp_et_gmail_smtp_provider_configuration = get_option( 'wp_et_gmail_smtp_provider_configuration', array() );

if ( ! isset( $wp_et_gmail_smtp_provider_configuration['smtp_port'] ) ) {
	$wp_et_gmail_smtp_provider_configuration['smtp_port'] = 465;
}

update_option( 'wp_et_gmail_smtp_provider_configuration', $wp_et_gmail_smtp_provider_configuration );