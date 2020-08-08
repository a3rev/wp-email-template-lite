<?php
/**
 * WP Email Template Functions
 *
 * Table Of Contents
 *
 * replace_shortcode_header()
 * replace_shortcode_footer()
 * email_header()
 * email_footer()
 * email_content()
 * apply_email_template_notice()
 * send()
 * rgb_from_hex()
 * hex_darker()
 * hex_lighter()
 * light_or_dark()
 */

namespace A3Rev\EmailTemplate;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Functions
{

	public static function replace_shortcode_header ($template_html='', $email_heading='') {
		global $wp_email_template_general, $wp_email_template_style_header_image, $wp_email_template_style_header;
		$background_pattern_image = 'url('.WP_EMAIL_TEMPLATE_IMAGES_URL.'/pattern.png)';

		$email_container_width = trim( $wp_email_template_general['email_container_width'] );
		if ( $email_container_width < 200 || $email_container_width > 1280 ) {
			$email_container_width = 600;
		}

		$email_body_width = $email_container_width;
		$email_body_width -= 48;

		$header_image_html = '';
		$apply_style_header_image = false;
		$header_image = $wp_email_template_style_header_image['header_image'];
		$header_image_url = $wp_email_template_style_header_image['header_image_url'];
		if ($header_image !== FALSE && trim($header_image) != ''){
			$header_image_html .= '<p style="margin:0px 0 0px 0;">';
			if ( '' != trim( $header_image_url ) ) {
				$header_image_html .= '<a href="'. esc_url( $header_image_url ).'" target="_blank">';
			}
			$header_image_html .= '<img class="header_image" style="max-width:'.$email_container_width.'px;" alt="'.get_bloginfo('name').'" src="'.trim(esc_url( $header_image ) ).'">';
			if ( '' != trim( $header_image_url ) ) {
				$header_image_html .= '</a>';
			}
			$header_image_html .= '</p>';
			$apply_style_header_image = true;
		}

		$outlook_container_border = '';
		if ( isset($wp_email_template_general['outlook_apply_border']) && $wp_email_template_general['outlook_apply_border'] == 'yes') {
			$outlook_container_border = 'border: 1px solid #FFFFFF !important;';
		}

		$content_text_size = 'font-size: 14px !important; line-height:1.4em !important; ';

		$content_text_style = '';
		$content_text_style = 'font-weight:normal !important; font-style:normal !important';

		if ( isset($wp_email_template_general['deactivate_pattern_background']) && $wp_email_template_general['deactivate_pattern_background'] == 'yes') {
			$background_pattern_image= '';
		}

		$external_link = '';

		$background_colour         = str_replace( array( 'background-color:', '!important', ';' ), '', $GLOBALS[WP_EMAIL_TEMPLATE_PREFIX.'admin_interface']->generate_background_color_css( $wp_email_template_general['background_colour'] ) );

		if( $apply_style_header_image ){
			$header_image_margin_bottom    = 20;
			$header_image_alignment        = stripslashes($wp_email_template_style_header_image['header_image_alignment']);
			$header_image_background_color = str_replace( array( 'background-color:', '!important', ';' ), '', $GLOBALS[WP_EMAIL_TEMPLATE_PREFIX.'admin_interface']->generate_background_color_css( $wp_email_template_style_header_image['header_image_background_color'] ) );
			$header_image_padding_top      = stripslashes($wp_email_template_style_header_image['header_image_padding_top']);
			$header_image_padding_bottom   = stripslashes($wp_email_template_style_header_image['header_image_padding_bottom']);
			$header_image_padding_left     = stripslashes($wp_email_template_style_header_image['header_image_padding_left']);
			$header_image_padding_right    = stripslashes($wp_email_template_style_header_image['header_image_padding_right']);
			$header_image_margin_top       = stripslashes($wp_email_template_style_header_image['header_image_margin_top']);
			$header_image_margin_bottom    = stripslashes($wp_email_template_style_header_image['header_image_margin_bottom']);
			$header_image_margin_left      = stripslashes($wp_email_template_style_header_image['header_image_margin_left']);
			$header_image_margin_right     = stripslashes($wp_email_template_style_header_image['header_image_margin_right']);
			$header_image_border_top       = str_replace("border:", "border-top:", $GLOBALS[WP_EMAIL_TEMPLATE_PREFIX.'admin_interface']->generate_border_style_css( $wp_email_template_style_header_image['header_image_border_top'] ));
			$header_image_border_bottom    = str_replace("border:", "border-bottom:", $GLOBALS[WP_EMAIL_TEMPLATE_PREFIX.'admin_interface']->generate_border_style_css( $wp_email_template_style_header_image['header_image_border_bottom'] ));
			$header_image_border_left      = str_replace("border:", "border-left:", $GLOBALS[WP_EMAIL_TEMPLATE_PREFIX.'admin_interface']->generate_border_style_css( $wp_email_template_style_header_image['header_image_border_left'] ));
			$header_image_border_right     = str_replace("border:", "border-right:", $GLOBALS[WP_EMAIL_TEMPLATE_PREFIX.'admin_interface']->generate_border_style_css( $wp_email_template_style_header_image['header_image_border_right'] ));
			$header_image_border_corner    = stripslashes($GLOBALS[WP_EMAIL_TEMPLATE_PREFIX.'admin_interface']->generate_border_corner_css( $wp_email_template_style_header_image['header_image_border_corner'] ));
			$header_image_border           = $header_image_border_top.$header_image_border_bottom.$header_image_border_left.$header_image_border_right.$header_image_border_corner;
		}else{
			$header_image_margin_bottom    = 0;
			$header_image_alignment        = 'none';
			$header_image_background_color = 'transparent';
			$header_image_padding_top      = '0';
			$header_image_padding_bottom   = '0';
			$header_image_padding_left     = '0';
			$header_image_padding_right    = '0';
			$header_image_margin_top       = '0';
			$header_image_margin_bottom    = '0';
			$header_image_margin_left      = '0';
			$header_image_margin_right     = '0';
			$header_image_border_corner    = 'border-radius: 0px !important;-moz-border-radius: 0px !important;-webkit-border-radius: 0px !important;';
			$header_image_border           = 'border-top: 0px solid #ffffff !important;border-bottom: 0px solid #ffffff !important;border-left: 0px solid #ffffff !important;border-right: 0px solid #ffffff !important;'.$header_image_border_corner;
		}

		$show_email_title = '';
		if ( 'no' == $wp_email_template_style_header['show_email_title'] ) {
			$show_email_title = 'display: none !important;';
		}

		$header_font = 'font:bold 26px Arial, sans-serif !important; color: #000000 !important;';
		$h1_font     = 'font:italic 26px Century Gothic, sans-serif !important; color: #000000 !important;';
		$h2_font     = 'font:italic 20px Century Gothic, sans-serif !important; color: #000000 !important;';
		$h3_font     = 'font:italic 18px Century Gothic, sans-serif !important; color: #000000 !important;';
		$h4_font     = 'font:italic 16px Century Gothic, sans-serif !important; color: #000000 !important;';
		$h5_font     = 'font:italic 14px Century Gothic, sans-serif !important; color: #000000 !important;';
		$h6_font     = 'font:italic 12px Century Gothic, sans-serif !important; color: #000000 !important;';
		$footer_font = 'font:normal 11px Arial, sans-serif !important; color: #999999 !important;';


		$header_border_corner  = 'border-radius: 0px !important;';
		$header_border         = 'border: none !important;';

		$content_border_corner = 'border-radius: 0px !important;';
		$content_border        = 'border: none !important;';

		$footer_border_corner  = 'border-radius: 0px !important;';
		$footer_border         = 'border: none !important;';

		$rtl = is_rtl() ? 'rtl' : '';
		$list_header_shortcode = array(
			'blog_name'                     => get_bloginfo('name'),
			'external_link'                 => $external_link,
			'outlook_container_border'      => $outlook_container_border,
			'email_container_width'			=> $email_container_width,

			'text_dir'						=> $rtl,

			'header_image'                  => $header_image_html,
			'header_image_margin_bottom'    => $header_image_margin_bottom,
			'header_image_alignment'        => $header_image_alignment,
			'header_image_background_color' => $header_image_background_color,
			'header_image_padding_top'      => $header_image_padding_top,
			'header_image_padding_bottom'   => $header_image_padding_bottom,
			'header_image_padding_left'     => $header_image_padding_left,
			'header_image_padding_right'    => $header_image_padding_right,

			'header_image_margin_top'       => $header_image_margin_top,
			'header_image_margin_bottom'    => $header_image_margin_bottom,
			'header_image_margin_left'      => $header_image_margin_left,
			'header_image_margin_right'     => $header_image_margin_right,

			'header_image_border'           => $header_image_border,
			'header_image_border_corner'    => $header_image_border_corner,

			'show_email_title'				=> $show_email_title,
			'email_heading'                 => stripslashes($email_heading),
			'base_colour'                   => '#ffffff',

			'header_alignment'              => 'left',
			'header_padding_top'            => 24,
			'header_padding_bottom'         => 24,
			'header_padding_left'           => 24,
			'header_padding_right'          => 24,
			'header_margin_top'             => 0,
			'header_margin_bottom'          => 0,
			'header_margin_left'            => 0,
			'header_margin_right'           => 0,
			'header_border'                 => $header_border,
			'header_border_corner'          => $header_border_corner,

			'header_font'                   => $header_font,
			'h1_font'                       => $h1_font,
			'h2_font'                       => $h2_font,
			'h3_font'                       => $h3_font,
			'h4_font'                       => $h4_font,
			'h5_font'                       => $h5_font,
			'h6_font'                       => $h6_font,


			'background_colour'             => stripslashes( $background_colour ),
			'background_pattern_image'      => $background_pattern_image,
			'content_background_colour'     => '#ffffff',

			'email_body_width'				=> $email_body_width,
			'content_alignment'             => 'left',
			'content_padding_top'           => 24,
			'content_padding_bottom'        => 24,
			'content_padding_left'          => 24,
			'content_padding_right'         => 24,

			'content_margin_top'            => 0,
			'content_margin_bottom'         => 0,
			'content_margin_left'           => 0,
			'content_margin_right'          => 0,

			'content_border'                => $content_border,
			'content_border_corner'			=> $content_border_corner,

			'content_text_colour'           => '#999999',
			'content_link_colour'           => '#1155CC',
			'content_font'                  => 'Verdana, Geneva, sans-serif',
			'content_text_size'             => $content_text_size,
			'content_text_style'            => $content_text_style,

			'footer_font'                   => $footer_font,
			'footer_background_colour'      => '#ffffff',
			'footer_border'                 => $footer_border,
			'footer_border_corner'          => $footer_border_corner,

		);

		foreach ($list_header_shortcode as $shortcode => $value) {
			$template_html = str_replace('<!--'.$shortcode.'-->', $value, $template_html);
			$template_html = str_replace('/*'.$shortcode.'*/', $value, $template_html);
		}

		return $template_html;
	}

	public static function replace_shortcode_footer ($template_html='') {
		global $wp_email_template_general, $wp_email_template_social_media, $wp_email_template_email_footer;

		$email_footer_width = trim( $wp_email_template_general['email_container_width'] );
		if ( $email_footer_width < 200 || $email_footer_width > 1280 ) {
			$email_footer_width = 600;
		}

		$email_footer_width -= 48;

		$background_pattern_image = 'url('.WP_EMAIL_TEMPLATE_IMAGES_URL.'/pattern.png)';

		$facebook_html = '';
		if (isset($wp_email_template_social_media['email_facebook']) && trim(esc_url($wp_email_template_social_media['email_facebook'])) != '')
			$facebook_html = '<a style="padding:0 2px;" href="'.trim( esc_url($wp_email_template_social_media['email_facebook']) ).'" target="_blank" title="'.__('Facebook', 'wp-email-template' ).'"><img align="top" border="0" src="' . ( ( trim( $wp_email_template_social_media['facebook_icon'] ) != '' ) ? trim( esc_url( $wp_email_template_social_media['facebook_icon'] ) ) : WP_EMAIL_TEMPLATE_IMAGES_URL.'/icon_facebook.png' ) . '" alt="'.__('Facebook', 'wp-email-template' ).'" /></a>&nbsp;';

		$twitter_html = '';
		if (isset($wp_email_template_social_media['email_twitter']) && trim(esc_url($wp_email_template_social_media['email_twitter'])) != '')
			$twitter_html = '<a style="padding:0 2px;" href="'.trim( esc_url($wp_email_template_social_media['email_twitter']) ).'" target="_blank" title="'.__('Twitter', 'wp-email-template' ).'"><img align="top" border="0" src="' . ( ( trim( $wp_email_template_social_media['twitter_icon'] ) != '' ) ? trim( esc_url( $wp_email_template_social_media['twitter_icon'] ) ) : WP_EMAIL_TEMPLATE_IMAGES_URL.'/icon_twitter.png' ) . '" alt="'.__('Twitter', 'wp-email-template' ).'" /></a>&nbsp;';

		$linkedIn_html = '';
		if (isset($wp_email_template_social_media['email_linkedIn']) && trim(esc_url($wp_email_template_social_media['email_linkedIn'])) != '')
			$linkedIn_html = '<a style="padding:0 2px;" href="'.trim( esc_url($wp_email_template_social_media['email_linkedIn']) ).'" target="_blank" title="'.__('LinkedIn', 'wp-email-template' ).'"><img align="top" border="0" src="' . ( ( trim( $wp_email_template_social_media['linkedIn_icon'] ) != '' ) ? trim( esc_url( $wp_email_template_social_media['linkedIn_icon'] ) ) : WP_EMAIL_TEMPLATE_IMAGES_URL.'/icon_linkedin.png' ) . '" alt="'.__('LinkedIn', 'wp-email-template' ).'" /></a>&nbsp;';

		$pinterest_html = '';
		if (isset($wp_email_template_social_media['email_pinterest']) && trim(esc_url($wp_email_template_social_media['email_pinterest'])) != '')
			$pinterest_html = '<a style="padding:0 2px;" href="'.trim( esc_url($wp_email_template_social_media['email_pinterest']) ).'" target="_blank" title="'.__('Pinterest', 'wp-email-template' ).'"><img align="top" border="0" src="' . ( ( trim( $wp_email_template_social_media['pinterest_icon'] ) != '' ) ? trim( esc_url( $wp_email_template_social_media['pinterest_icon'] ) ) : WP_EMAIL_TEMPLATE_IMAGES_URL.'/icon_pinterest.png' ) . '" alt="'.__('Pinterest', 'wp-email-template' ).'" /></a>&nbsp;';

		$googleplus_html = '';
		if (isset($wp_email_template_social_media['email_googleplus']) && trim(esc_url($wp_email_template_social_media['email_googleplus'])) != '')
			$googleplus_html = '<a style="padding:0 2px;" href="'.trim( esc_url($wp_email_template_social_media['email_googleplus']) ).'" target="_blank" title="'.__('Google+', 'wp-email-template' ).'"><img align="top" border="0" src="' . ( ( trim( $wp_email_template_social_media['googleplus_icon'] ) != '' ) ? trim( esc_url( $wp_email_template_social_media['googleplus_icon'] ) ) : WP_EMAIL_TEMPLATE_IMAGES_URL.'/icon_googleplus.png' ) . '" alt="'.__('Google+', 'wp-email-template' ).'" /></a>&nbsp;';

		$follow_text = '';
		if (trim($facebook_html) != '' || trim($twitter_html) != '' || trim($linkedIn_html) != '' || trim($pinterest_html) != '' || trim($googleplus_html) != '')
			$follow_text = __('Follow us on', 'wp-email-template' );

		if ( isset($wp_email_template_general['deactivate_pattern_background']) && $wp_email_template_general['deactivate_pattern_background'] == 'yes') {
			$background_pattern_image= '';
		}

		$background_colour         = str_replace( array( 'background-color:', '!important', ';' ), '', $GLOBALS[WP_EMAIL_TEMPLATE_PREFIX.'admin_interface']->generate_background_color_css( $wp_email_template_general['background_colour'] ) );

		$footer_font = 'font:normal 11px Arial, sans-serif !important; color: #999999 !important;';

		$footer_border_corner = 'border-radius: 0px !important;';
		$footer_border	= 'border: none !important;';


		$list_footer_shortcode = array(
			'email_footer_width' 		   => $email_footer_width,
			'email_footer'                 => wpautop(wptexturize(stripslashes($wp_email_template_email_footer))),
			'follow_text'                  => $follow_text,
			'email_facebook'               => $facebook_html,
			'email_twitter'                => $twitter_html,
			'email_linkedIn'               => $linkedIn_html,
			'email_pinterest'              => $pinterest_html,
			'email_googleplus'             => $googleplus_html,

			'background_colour'            => stripslashes($background_colour),
			'background_pattern_image'     => $background_pattern_image,
			'footer_font'                  => $footer_font ,
			'footer_background_colour'     => '#ffffff',
			'footer_padding_top'           => 24,
			'footer_padding_bottom'        => 24,
			'footer_padding_left'          => 24,
			'footer_padding_right'         => 24,
			'footer_margin_top'            => 0,
			'footer_margin_bottom'         => 0,
			'footer_margin_left'           => 0,
			'footer_margin_right'          => 0,
			'footer_border'                => $footer_border,
			'footer_border_corner'         => $footer_border_corner,
		);

		foreach ($list_footer_shortcode as $shortcode => $value) {
			$template_html = str_replace('<!--'.$shortcode.'-->', $value, $template_html);
			$template_html = str_replace('/*'.$shortcode.'*/', $value, $template_html);
		}

		return $template_html;
	}

	public static function email_header($email_heading='') {
		global $wp_email_template_style_header;

		$file 	= 'email_header.html';
		if (file_exists(STYLESHEETPATH . '/emails/'. $file)) {
			$header_template_path = STYLESHEETPATH . '/emails/'. $file;
			$header_template_url = get_stylesheet_directory_uri() . '/emails/'. $file;
		} else {
			$header_template_path = WP_EMAIL_TEMPLATE_DIR . '/emails/'. $file;
			$header_template_url = WP_EMAIL_TEMPLATE_URL . '/emails/'. $file;
		}

		ob_start();

		include $header_template_path;

		$template_html = ob_get_clean();

		if ( 'no' == $wp_email_template_style_header['show_email_title'] ) {
			$pattern = '/\<\!\-\-show_email_title_start\-\-\>[\s\S]+?\<\!\-\-show_email_title_end\-\-\>/';
			$template_html = preg_replace( $pattern, '', $template_html );
		}

		$template_html = self::replace_shortcode_header($template_html, $email_heading);

		return $template_html;
	}

	public static function email_footer() {
		$file 	= 'email_footer.html';

		if (file_exists(STYLESHEETPATH . '/emails/'. $file)) {
			$footer_template_path = STYLESHEETPATH . '/emails/'. $file;
			$footer_template_url = get_stylesheet_directory_uri() . '/emails/'. $file;
		} else {
			$footer_template_path = WP_EMAIL_TEMPLATE_DIR . '/emails/'. $file;
			$footer_template_url = WP_EMAIL_TEMPLATE_URL . '/emails/'. $file;
		}

		ob_start();

		include $footer_template_path;

		$template_html = ob_get_clean();

		$template_html = self::replace_shortcode_footer($template_html);

		$h1_font     = 'font:italic 26px Century Gothic, sans-serif !important; color: #000000 !important;';
		$h2_font     = 'font:italic 20px Century Gothic, sans-serif !important; color: #000000 !important;';
		$h3_font     = 'font:italic 18px Century Gothic, sans-serif !important; color: #000000 !important;';
		$h4_font     = 'font:italic 16px Century Gothic, sans-serif !important; color: #000000 !important;';
		$h5_font     = 'font:italic 14px Century Gothic, sans-serif !important; color: #000000 !important;';
		$h6_font     = 'font:italic 12px Century Gothic, sans-serif !important; color: #000000 !important;';

		$template_html = str_replace('<h1>', '<h1 style="margin:0 0 10px;padding:0;'.$h1_font.'">', $template_html);
		$template_html = str_replace('<h2>', '<h2 style="margin:0 0 10px;padding:0;'.$h2_font.'">', $template_html);
		$template_html = str_replace('<h3>', '<h3 style="margin:0 0 10px;padding:0;'.$h3_font.'">', $template_html);
		$template_html = str_replace('<h4>', '<h4 style="margin:0 0 10px;padding:0;'.$h4_font.'">', $template_html);
		$template_html = str_replace('<h5>', '<h5 style="margin:0 0 10px;padding:0;'.$h5_font.'">', $template_html);
		$template_html = str_replace('<h6>', '<h6 style="margin:0 0 10px;padding:0;'.$h6_font.'">', $template_html);
		$template_html = str_replace('<h1 style=""', '<h1 style="margin:0 0 10px;padding:0;'.$h1_font.'"', $template_html);
		$template_html = str_replace('<h2 style=""', '<h2 style="margin:0 0 10px;padding:0;'.$h2_font.'"', $template_html);
		$template_html = str_replace('<h3 style=""', '<h3 style="margin:0 0 10px;padding:0;'.$h3_font.'"', $template_html);
		$template_html = str_replace('<h4 style=""', '<h4 style="margin:0 0 10px;padding:0;'.$h4_font.'"', $template_html);
		$template_html = str_replace('<h5 style=""', '<h5 style="margin:0 0 10px;padding:0;'.$h5_font.'"', $template_html);
		$template_html = str_replace('<h6 style=""', '<h6 style="margin:0 0 10px;padding:0;'.$h6_font.'"', $template_html);
		$template_html = str_replace("<p>", '<p style="margin:0 0 10px;padding:0;">', $template_html);

		return $template_html;
	}

	public static function email_content($email_heading='', $message='', $preview_mode=false, $is_text_plain=false) {
		global $wp_email_template_general;
		$html = '';

		// Don't remove email template when it's preview mode
		if ( ! $preview_mode ) {
			// Don't apply WP Email Template if disable this feature
			if ( $wp_email_template_general['apply_template_all_emails'] != 'yes' ) {
				return $message;
			}
		}

		if (stristr($message, '<!--NO_USE_EMAIL_TEMPLATE-->') === false ) {
			$html .= self::email_header($email_heading);
		}

		// Sanitise orignal message if orignal content type of email is text/plain for avoid HTML injection
		if ( $is_text_plain ) {
			$message = htmlentities( $message );
		}

		// Then apply new content type for this email that support HTML from template of plugin
		add_filter( 'wp_mail_content_type', array( '\A3Rev\EmailTemplate\Hook_Filter', 'set_content_type' ), 101 );

		// Just get content from body tag if message include full html structure
		if ( stristr( $message, '<html' ) !== false || stristr( $message, '<body' ) !== false ) {
			if ( ! function_exists( 'str_get_html' ) ) {
				include( WP_EMAIL_TEMPLATE_DIR. '/includes/simple_html_dom.php' );
			}
			$message_dom = str_get_html( $message );
			if ( false === $message_dom ) {
				return $message;
			}
			
			$message = $message_dom->find( 'body', 0 )->innertext;
		}

		$html .= wpautop( make_clickable( $message) );

		if (stristr($message, '<!--NO_USE_EMAIL_TEMPLATE-->') === false ) {
			$html .= self::email_footer();
			$html .= '<!--NO_USE_EMAIL_TEMPLATE-->';
		}

		$h1_font     = 'font:italic 26px Century Gothic, sans-serif !important; color: #000000 !important;';
		$h2_font     = 'font:italic 20px Century Gothic, sans-serif !important; color: #000000 !important;';
		$h3_font     = 'font:italic 18px Century Gothic, sans-serif !important; color: #000000 !important;';
		$h4_font     = 'font:italic 16px Century Gothic, sans-serif !important; color: #000000 !important;';
		$h5_font     = 'font:italic 14px Century Gothic, sans-serif !important; color: #000000 !important;';
		$h6_font     = 'font:italic 12px Century Gothic, sans-serif !important; color: #000000 !important;';

		$html = str_replace('<h1>', '<h1 style="margin:0 0 10px;padding:0;'.$h1_font.'">', $html);
		$html = str_replace('<h2>', '<h2 style="margin:0 0 10px;padding:0;'.$h2_font.'">', $html);
		$html = str_replace('<h3>', '<h3 style="margin:0 0 10px;padding:0;'.$h3_font.'">', $html);
		$html = str_replace('<h4>', '<h4 style="margin:0 0 10px;padding:0;'.$h4_font.'">', $html);
		$html = str_replace('<h5>', '<h5 style="margin:0 0 10px;padding:0;'.$h5_font.'">', $html);
		$html = str_replace('<h6>', '<h6 style="margin:0 0 10px;padding:0;'.$h6_font.'">', $html);
		$html = str_replace('<h1 style=""', '<h1 style="margin:0 0 10px;padding:0;'.$h1_font.'"', $html);
		$html = str_replace('<h2 style=""', '<h2 style="margin:0 0 10px;padding:0;'.$h2_font.'"', $html);
		$html = str_replace('<h3 style=""', '<h3 style="margin:0 0 10px;padding:0;'.$h3_font.'"', $html);
		$html = str_replace('<h4 style=""', '<h4 style="margin:0 0 10px;padding:0;'.$h4_font.'"', $html);
		$html = str_replace('<h5 style=""', '<h5 style="margin:0 0 10px;padding:0;'.$h5_font.'"', $html);
		$html = str_replace('<h6 style=""', '<h6 style="margin:0 0 10px;padding:0;'.$h6_font.'"', $html);
		$html = str_replace("<p>", '<p style="margin:0 0 10px;padding:0;">', $html);

		return $html;
	}

	public static function apply_email_template_notice($message='') {
		$message_html = '';
		if ( trim($message) != '') {
			$message_html = '<div style="position:fixed; width: 79%; margin:0 10%; top: 10px; padding:5px 10px; border:1px solid #E6DB55; background:#FFFFE0; font-size:15px; line-height:20px;">'.$message.'</div>';
		}

		return $message_html;
	}

	public static function send($to, $subject, $message, $headers = "Content-Type: text/html\r\n", $attachments = "") {
		ob_start();

		wp_mail( $to, $subject, $message, $headers, $attachments );

		ob_end_clean();
	}

	/**
	 * Hex darker/lighter/contrast functions for colours
	 **/
	public static function rgb_from_hex( $color ) {
		$color = str_replace( '#', '', $color );
		// Convert shorthand colors to full format, e.g. "FFF" -> "FFFFFF"
		$color = preg_replace( '~^(.)(.)(.)$~', '$1$1$2$2$3$3', $color );

		$rgb['R'] = hexdec( $color[0].$color[1] );
		$rgb['G'] = hexdec( $color[2].$color[3] );
		$rgb['B'] = hexdec( $color[4].$color[5] );
		return $rgb;
	}

	public static function hex_darker( $color, $factor = 30 ) {
		$base = self::rgb_from_hex( $color );
		$color = '#';

		foreach ($base as $k => $v) :
	        $amount = $v / 100;
	        $amount = round($amount * $factor);
	        $new_decimal = $v - $amount;

	        $new_hex_component = dechex($new_decimal);
	        if(strlen($new_hex_component) < 2) :
	        	$new_hex_component = "0".$new_hex_component;
	        endif;
	        $color .= $new_hex_component;
		endforeach;

		return $color;
	}

	public static function hex_lighter( $color, $factor = 30 ) {
		$base = self::rgb_from_hex( $color );
		$color = '#';

	    foreach ($base as $k => $v) :
	        $amount = 255 - $v;
	        $amount = $amount / 100;
	        $amount = round($amount * $factor);
	        $new_decimal = $v + $amount;

	        $new_hex_component = dechex($new_decimal);
	        if(strlen($new_hex_component) < 2) :
	        	$new_hex_component = "0".$new_hex_component;
	        endif;
	        $color .= $new_hex_component;
	   	endforeach;

	   	return $color;
	}

	/**
	 * Detect if we should use a light or dark colour on a background colour
	 **/
	public static function light_or_dark( $color, $dark = '#000000', $light = '#FFFFFF' ) {
	    //return ( hexdec( $color ) > 0xffffff / 2 ) ? $dark : $light;
	    $hex = str_replace( '#', '', $color );

		$c_r = hexdec( substr( $hex, 0, 2 ) );
		$c_g = hexdec( substr( $hex, 2, 2 ) );
		$c_b = hexdec( substr( $hex, 4, 2 ) );
		$brightness = ( ( $c_r * 299 ) + ( $c_g * 587 ) + ( $c_b * 114 ) ) / 1000;

		return $brightness > 155 ? $dark : $light;
	}

}
