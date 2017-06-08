<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$wp_email_template_settings = get_option( 'wp_email_template_settings' );

$wp_email_template_general = array(
	'header_image'					=> get_option('wp_email_template_header_image', '' ),
	'background_colour'				=> $wp_email_template_settings['background_colour'],
	'deactivate_pattern_background'	=> $wp_email_template_settings['deactivate_pattern_background'],
	'apply_for_woo_emails'			=> $wp_email_template_settings['apply_for_woo_emails'],
	'show_plugin_url'				=> $wp_email_template_settings['show_plugin_url'],
);
update_option( 'wp_email_template_general', $wp_email_template_general );

$wp_email_template_style = array(
	'base_colour'					=> $wp_email_template_settings['base_colour'],
	'header_font'					=> array(
			'size'		=> $wp_email_template_settings['header_text_size'],
			'face'		=> $wp_email_template_settings['header_font'],
			'style'		=> $wp_email_template_settings['header_text_style'],
			'color'		=> $wp_email_template_settings['header_text_colour'],
		),
	'content_background_colour'		=> $wp_email_template_settings['content_background_colour'],
	'content_font'					=> array(
			'size'		=> $wp_email_template_settings['content_text_size'],
			'face'		=> $wp_email_template_settings['content_font'],
			'style'		=> $wp_email_template_settings['content_text_style'],
			'color'		=> $wp_email_template_settings['content_text_colour'],
		),
	'content_link_colour'			=> $wp_email_template_settings['content_link_colour'],
	'email_footer'					=> $wp_email_template_settings['email_footer'],
);
update_option( 'wp_email_template_style', $wp_email_template_style );

$wp_email_template_social_media = array(
	'email_facebook'				=> $wp_email_template_settings['email_facebook'],
	'email_twitter'					=> $wp_email_template_settings['email_twitter'],
	'email_linkedIn'				=> $wp_email_template_settings['email_linkedIn'],
	'email_pinterest'				=> $wp_email_template_settings['email_pinterest'],
	'email_googleplus'				=> $wp_email_template_settings['email_googleplus'],
	'facebook_icon'					=> WP_EMAIL_TEMPLATE_IMAGES_URL.'/icon_facebook.png',
	'twitter_icon'					=> WP_EMAIL_TEMPLATE_IMAGES_URL.'/icon_twitter.png',
	'linkedIn_icon'					=> WP_EMAIL_TEMPLATE_IMAGES_URL.'/icon_linkedin.png',
	'pinterest_icon'				=> WP_EMAIL_TEMPLATE_IMAGES_URL.'/icon_pinterest.png',
	'googleplus_icon'				=> WP_EMAIL_TEMPLATE_IMAGES_URL.'/icon_googleplus.png',
);
update_option( 'wp_email_template_social_media', $wp_email_template_social_media );