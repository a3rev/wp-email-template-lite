<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$wp_email_template_general = get_option( 'wp_email_template_general', array() );

if ( isset( $wp_email_template_general['background_colour'] ) ) {
	$background_colour = $wp_email_template_general['background_colour'];
	$wp_email_template_general['background_colour'] = array( 'enable' => 1, 'color' => $background_colour );
}

update_option( 'wp_email_template_general', $wp_email_template_general );


$wp_email_template_style_header_image = get_option( 'wp_email_template_style_header_image', array() );

if ( isset( $wp_email_template_style_header_image['header_image_background_color'] ) ) {
	$header_image_background_color = $wp_email_template_style_header_image['header_image_background_color'];
	$wp_email_template_style_header_image['header_image_background_color'] = array( 'enable' => 1, 'color' => $header_image_background_color );
}

// Update Image Url with http or https for work on email client
if ( isset( $wp_email_template_style_header_image['header_image'] ) ) {
	if ( stristr( $wp_email_template_style_header_image['header_image'], 'http:' ) === false && stristr( $wp_email_template_style_header_image['header_image'], 'https:' ) === false ) {
		if ( function_exists( 'is_ssl' ) && is_ssl() ) {
			$wp_email_template_style_header_image['header_image'] = 'https:' . $wp_email_template_style_header_image['header_image'];
		} else {
			$wp_email_template_style_header_image['header_image'] = 'http:' . $wp_email_template_style_header_image['header_image'];
		}
	}
}

update_option( 'wp_email_template_style_header_image', $wp_email_template_style_header_image );


$wp_email_template_style_header = get_option( 'wp_email_template_style_header', array() );

if ( isset( $wp_email_template_style_header['base_colour'] ) ) {
	$base_colour = $wp_email_template_style_header['base_colour'];
	$wp_email_template_style_header['base_colour'] = array( 'enable' => 1, 'color' => $base_colour );
}

update_option( 'wp_email_template_style_header', $wp_email_template_style_header );


$wp_email_template_style_body = get_option( 'wp_email_template_style_body', array() );

if ( isset( $wp_email_template_style_body['content_background_colour'] ) ) {
	$content_background_colour = $wp_email_template_style_body['content_background_colour'];
	$wp_email_template_style_body['content_background_colour'] = array( 'enable' => 1, 'color' => $content_background_colour );
}

update_option( 'wp_email_template_style_body', $wp_email_template_style_body );


$wp_email_template_style_footer = get_option( 'wp_email_template_style_footer', array() );

if ( isset( $wp_email_template_style_footer['footer_background_colour'] ) ) {
	$footer_background_colour = $wp_email_template_style_footer['footer_background_colour'];
	$wp_email_template_style_footer['footer_background_colour'] = array( 'enable' => 1, 'color' => $footer_background_colour );
}

update_option( 'wp_email_template_style_footer', $wp_email_template_style_footer );

// Update Image Url with http or https for work on email client
$wp_email_template_social_media = get_option( 'wp_email_template_social_media', array() );

if ( isset( $wp_email_template_social_media['facebook_icon'] ) ) {
	if ( stristr( $wp_email_template_social_media['facebook_icon'], 'http:' ) === false && stristr( $wp_email_template_social_media['facebook_icon'], 'https:' ) === false ) {
		if ( function_exists( 'is_ssl' ) && is_ssl() ) {
			$wp_email_template_social_media['facebook_icon'] = 'https:' . $wp_email_template_social_media['facebook_icon'];
		} else {
			$wp_email_template_social_media['facebook_icon'] = 'http:' . $wp_email_template_social_media['facebook_icon'];
		}
	}
}

if ( isset( $wp_email_template_social_media['twitter_icon'] ) ) {
	if ( stristr( $wp_email_template_social_media['twitter_icon'], 'http:' ) === false && stristr( $wp_email_template_social_media['twitter_icon'], 'https:' ) === false ) {
		if ( function_exists( 'is_ssl' ) && is_ssl() ) {
			$wp_email_template_social_media['twitter_icon'] = 'https:' . $wp_email_template_social_media['twitter_icon'];
		} else {
			$wp_email_template_social_media['twitter_icon'] = 'http:' . $wp_email_template_social_media['twitter_icon'];
		}
	}
}

if ( isset( $wp_email_template_social_media['linkedIn_icon'] ) ) {
	if ( stristr( $wp_email_template_social_media['linkedIn_icon'], 'http:' ) === false && stristr( $wp_email_template_social_media['linkedIn_icon'], 'https:' ) === false ) {
		if ( function_exists( 'is_ssl' ) && is_ssl() ) {
			$wp_email_template_social_media['linkedIn_icon'] = 'https:' . $wp_email_template_social_media['linkedIn_icon'];
		} else {
			$wp_email_template_social_media['linkedIn_icon'] = 'http:' . $wp_email_template_social_media['linkedIn_icon'];
		}
	}
}

if ( isset( $wp_email_template_social_media['pinterest_icon'] ) ) {
	if ( stristr( $wp_email_template_social_media['pinterest_icon'], 'http:' ) === false && stristr( $wp_email_template_social_media['pinterest_icon'], 'https:' ) === false ) {
		if ( function_exists( 'is_ssl' ) && is_ssl() ) {
			$wp_email_template_social_media['pinterest_icon'] = 'https:' . $wp_email_template_social_media['pinterest_icon'];
		} else {
			$wp_email_template_social_media['pinterest_icon'] = 'http:' . $wp_email_template_social_media['pinterest_icon'];
		}
	}
}

if ( isset( $wp_email_template_social_media['googleplus_icon'] ) ) {
	if ( stristr( $wp_email_template_social_media['googleplus_icon'], 'http:' ) === false && stristr( $wp_email_template_social_media['googleplus_icon'], 'https:' ) === false ) {
		if ( function_exists( 'is_ssl' ) && is_ssl() ) {
			$wp_email_template_social_media['googleplus_icon'] = 'https:' . $wp_email_template_social_media['googleplus_icon'];
		} else {
			$wp_email_template_social_media['googleplus_icon'] = 'http:' . $wp_email_template_social_media['googleplus_icon'];
		}
	}
}

update_option( 'wp_email_template_social_media', $wp_email_template_social_media );