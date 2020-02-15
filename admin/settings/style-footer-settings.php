<?php
/* "Copyright 2012 A3 Revolution Web Design" This software is distributed under the terms of GNU GENERAL PUBLIC LICENSE Version 3, 29 June 2007 */

namespace A3Rev\EmailTemplate\FrameWork\Settings {

use A3Rev\EmailTemplate\FrameWork;

// File Security Check
if ( ! defined( 'ABSPATH' ) ) exit;

/*-----------------------------------------------------------------------------------
WP Email Template Style Settings

TABLE OF CONTENTS

- var parent_tab
- var subtab_data
- var option_name
- var form_key
- var position
- var form_fields
- var form_messages

- __construct()
- subtab_init()
- set_default_settings()
- get_settings()
- subtab_data()
- add_subtab()
- settings_form()
- init_form_fields()

-----------------------------------------------------------------------------------*/

class Style_Footer extends FrameWork\Admin_UI
{

	/**
	 * @var string
	 */
	private $parent_tab = 'footer';

	/**
	 * @var array
	 */
	private $subtab_data;

	/**
	 * @var string
	 * You must change to correct option name that you are working
	 */
	public $option_name = 'wp_email_template_style_footer';

	/**
	 * @var string
	 * You must change to correct form key that you are working
	 */
	public $form_key = 'wp_email_template_style_footer';

	/**
	 * @var string
	 * You can change the order show of this sub tab in list sub tabs
	 */
	private $position = 1;

	/**
	 * @var array
	 */
	public $form_fields = array();

	/**
	 * @var array
	 */
	public $form_messages = array();

	/*-----------------------------------------------------------------------------------*/
	/* __construct() */
	/* Settings Constructor */
	/*-----------------------------------------------------------------------------------*/
	public function __construct() {
		add_action( 'plugins_loaded', array( $this, 'init_form_fields' ), 1 );
		//$this->subtab_init();

		$this->form_messages = array(
				'success_message'	=> __( 'WP Email Template Style successfully saved.', 'wp-email-template' ),
				'error_message'		=> __( 'Error: WP Email Template Style  can not save.', 'wp-email-template' ),
				'reset_message'		=> __( 'WP Email Template Style  successfully reseted.', 'wp-email-template' ),
			);

		add_action( $this->plugin_name . '-' . $this->form_key . '_settings_end', array( $this, 'include_script' ) );

		add_action( $this->plugin_name . '_set_default_settings' , array( $this, 'set_default_settings' ) );

		add_action( $this->plugin_name . '-' . $this->form_key . '_settings_init' , array( $this, 'reset_default_settings' ) );

		add_action( $this->plugin_name . '_get_all_settings' , array( $this, 'get_settings' ) );
	}

	/*-----------------------------------------------------------------------------------*/
	/* subtab_init()
	/* Sub Tab Init */
	/*-----------------------------------------------------------------------------------*/
	public function subtab_init() {

		add_filter( $this->plugin_name . '-' . $this->parent_tab . '_settings_subtabs_array', array( $this, 'add_subtab' ), $this->position );

	}

	/*-----------------------------------------------------------------------------------*/
	/* set_default_settings()
	/* Set default settings with function called from Admin Interface */
	/*-----------------------------------------------------------------------------------*/
	public function set_default_settings() {
		global ${$this->plugin_prefix.'admin_interface'};

		${$this->plugin_prefix.'admin_interface'}->reset_settings( $this->form_fields, $this->option_name, false );
	}

	/*-----------------------------------------------------------------------------------*/
	/* reset_default_settings()
	/* Reset default settings with function called from Admin Interface */
	/*-----------------------------------------------------------------------------------*/
	public function reset_default_settings() {
		global ${$this->plugin_prefix.'admin_interface'};

		${$this->plugin_prefix.'admin_interface'}->reset_settings( $this->form_fields, $this->option_name, true, true );
	}

	/*-----------------------------------------------------------------------------------*/
	/* get_settings()
	/* Get settings with function called from Admin Interface */
	/*-----------------------------------------------------------------------------------*/
	public function get_settings() {
		global ${$this->plugin_prefix.'admin_interface'};

		${$this->plugin_prefix.'admin_interface'}->get_settings( $this->form_fields, $this->option_name );
	}

	/**
	 * subtab_data()
	 * Get SubTab Data
	 * =============================================
	 * array (
	 *		'name'				=> 'my_subtab_name'				: (required) Enter your subtab name that you want to set for this subtab
	 *		'label'				=> 'My SubTab Name'				: (required) Enter the subtab label
	 * 		'callback_function'	=> 'my_callback_function'		: (required) The callback function is called to show content of this subtab
	 * )
	 *
	 */
	public function subtab_data() {

		$subtab_data = array(
			'name'				=> 'style-footer',
			'label'				=> __( 'Footer', 'wp-email-template' ),
			'callback_function'	=> 'wp_email_template_style_footer_settings_form',
		);

		if ( $this->subtab_data ) return $this->subtab_data;
		return $this->subtab_data = $subtab_data;

	}

	/*-----------------------------------------------------------------------------------*/
	/* add_subtab() */
	/* Add Subtab to Admin Init
	/*-----------------------------------------------------------------------------------*/
	public function add_subtab( $subtabs_array ) {

		if ( ! is_array( $subtabs_array ) ) $subtabs_array = array();
		$subtabs_array[] = $this->subtab_data();

		return $subtabs_array;
	}

	/*-----------------------------------------------------------------------------------*/
	/* settings_form() */
	/* Call the form from Admin Interface
	/*-----------------------------------------------------------------------------------*/
	public function settings_form() {
		global ${$this->plugin_prefix.'admin_interface'};

		$output = '';
		$output .= ${$this->plugin_prefix.'admin_interface'}->admin_forms( $this->form_fields, $this->form_key, $this->option_name, $this->form_messages );

		return $output;
	}

	/*-----------------------------------------------------------------------------------*/
	/* init_form_fields() */
	/* Init all fields of this form */
	/*-----------------------------------------------------------------------------------*/
	public function init_form_fields() {
		$preview_wp_email_template = '';
		if ( is_admin() && in_array (basename($_SERVER['PHP_SELF']), array('admin.php') ) && isset( $_GET['page'] ) && sanitize_key( $_GET['page'] ) == 'wp_email_template' ) {
			$preview_wp_email_template = wp_create_nonce("preview_wp_email_template");
		}

  		// Define settings
     	$this->form_fields = apply_filters( $this->option_name . '_settings_fields', array(

			array(
            	'name' 		=> '',
				'desc'		=> __( 'For a live preview of changes save them and then', 'wp-email-template' ) . ' <a href="' . admin_url( 'admin-ajax.php', 'relative' ) . '?action=preview_wp_email_template&security='.$preview_wp_email_template.'" target="_blank">' . __( 'Click here to preview your email template.', 'wp-email-template' ) . '</a>',
                'type' 		=> 'heading',
                'id'		=> 'live_preview_box',
           	),

			array(
            	'name' 		=> __( 'Email Footer Content', 'wp-email-template' ),
                'type' 		=> 'heading',
                'id'		=> 'email_footer_content_box',
                'is_box'	=> true,
           	),
			array(
				'name' 		=> __( 'Footer Message', 'wp-email-template' ),
				'desc' 		=> __( "Use the WordPress Editor to create your email template footer content.", 'wp-email-template' ),
				'id' 		=> 'wp_email_template_email_footer',
				'type' 		=> 'wp_editor',
				'separate_option'	=> true,
				'textarea_rows'	=> 15,
				'default'	=> get_bloginfo('name') . ' Email Template powered by <a style="color:#1686e0" href="http://www.a3rev.com/" target="_blank" title="A3 Revolution">A3 Revolution</a> software team.',
				'free_version'		=> true,
			),

			array(
				'name' 		=> __( 'EMAIL FOOTER CONTAINER PREMIUM STYLE OPTIONS', 'wp-email-template' ),
				'type' 		=> 'heading',
				'id'		=> 'email_footer_premium_box',
				'is_box'	=> true,
				'alway_open'=> true,
				'desc'		=> '<img class="rwd_image_maps" src="'.WP_EMAIL_TEMPLATE_IMAGES_URL.'/premium-email-footer.png" usemap="#emailFooterContainerMap" style="width: auto; max-width: 100%;" border="0" />
<map name="emailFooterContainerMap" id="emailFooterContainerMap">
	<area shape="rect" coords="260,200,800,270" href="'.$this->pro_plugin_page_url.'" target="_blank" />
</map>',
			),

        ));
	}

	public function include_script() {
		wp_enqueue_script( 'jquery-rwd-image-maps' );
	}
}

}

// global code
namespace {

/**
 * wp_email_template_style_footer_settings_form()
 * Define the callback function to show subtab content
 */
function wp_email_template_style_footer_settings_form() {
	global $wp_email_template_style_footer_settings;
	$wp_email_template_style_footer_settings->settings_form();
}

}
