<?php
/* "Copyright 2012 A3 Revolution Web Design" This software is distributed under the terms of GNU GENERAL PUBLIC LICENSE Version 3, 29 June 2007 */
// File Security Check
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<?php
/*-----------------------------------------------------------------------------------
WP Email Teplate General Settings

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

class WP_Email_Template_General_Settings extends WP_Email_Tempate_Admin_UI
{

	/**
	 * @var string
	 */
	private $parent_tab = 'general';

	/**
	 * @var array
	 */
	private $subtab_data;

	/**
	 * @var string
	 * You must change to correct option name that you are working
	 */
	public $option_name = 'wp_email_template_general';

	/**
	 * @var string
	 * You must change to correct form key that you are working
	 */
	public $form_key = 'wp_email_template_general';

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
				'success_message'	=> __( 'General Settings successfully saved.', 'wp-email-template' ),
				'error_message'		=> __( 'Error: General Settings can not save.', 'wp-email-template' ),
				'reset_message'		=> __( 'General Settings successfully reseted.', 'wp-email-template' ),
			);

		add_action( $this->plugin_name . '-' . $this->form_key . '_settings_end', array( $this, 'include_script' ) );

		add_action( $this->plugin_name . '_set_default_settings' , array( $this, 'set_default_settings' ) );

		add_action( $this->plugin_name . '-' . $this->form_key . '_settings_init' , array( $this, 'clean_on_deletion' ) );

		add_action( $this->plugin_name . '_get_all_settings' , array( $this, 'get_settings' ) );
	}

	/*-----------------------------------------------------------------------------------*/
	/* subtab_init() */
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
		global $wp_email_template_admin_interface;

		$wp_email_template_admin_interface->reset_settings( $this->form_fields, $this->option_name, false );
	}

	/*-----------------------------------------------------------------------------------*/
	/* clean_on_deletion()
	/* Process when clean on deletion option is un selected */
	/*-----------------------------------------------------------------------------------*/
	public function clean_on_deletion() {
		if ( ( isset( $_POST['bt_save_settings'] ) || isset( $_POST['bt_reset_settings'] ) ) && get_option( $this->plugin_name . '_clean_on_deletion' ) == 0  )  {
			$uninstallable_plugins = (array) get_option('uninstall_plugins');
			unset($uninstallable_plugins[ $this->plugin_path ]);
			update_option('uninstall_plugins', $uninstallable_plugins);
		}
	}

	/*-----------------------------------------------------------------------------------*/
	/* get_settings()
	/* Get settings with function called from Admin Interface */
	/*-----------------------------------------------------------------------------------*/
	public function get_settings() {
		global $wp_email_template_admin_interface;

		$wp_email_template_admin_interface->get_settings( $this->form_fields, $this->option_name );
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
			'name'				=> 'general',
			'label'				=> __( 'General', 'wp-email-template' ),
			'callback_function'	=> 'wp_email_template_general_settings_form',
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
		global $wp_email_template_admin_interface;

		$output = '';
		$output .= $wp_email_template_admin_interface->admin_forms( $this->form_fields, $this->form_key, $this->option_name, $this->form_messages );

		return $output;
	}

	/*-----------------------------------------------------------------------------------*/
	/* init_form_fields() */
	/* Init all fields of this form */
	/*-----------------------------------------------------------------------------------*/
	public function init_form_fields() {
		$preview_wp_email_template = '';
		if ( is_admin() && in_array (basename($_SERVER['PHP_SELF']), array('admin.php') ) && isset( $_GET['page'] ) && $_GET['page'] == 'wp_email_template' ) {
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
            	'name' 		=> __( 'Plugin Framework Global Settings', 'wp-email-template' ),
            	'id'		=> 'plugin_framework_global_box',
                'type' 		=> 'heading',
                'first_open'=> true,
                'is_box'	=> true,
           	),
           	array(
           		'name'		=> __( 'Customize Admin Setting Box Display', 'wp-email-template' ),
           		'desc'		=> __( 'By default each admin panel will open with all Setting Boxes in the CLOSED position.', 'wp-email-template' ),
                'type' 		=> 'heading',
           	),
           	array(
				'type' 		=> 'onoff_toggle_box',
			),
			array(
           		'name'		=> __( 'Google Fonts', 'wp-email-template' ),
           		'desc'		=> __( 'By Default Google Fonts are pulled from a static JSON file in this plugin. This file is updated but does not have the latest font releases from Google.', 'wp-email-template' ),
                'type' 		=> 'heading',
           	),
           	array(
                'type' 		=> 'google_api_key',
           	),
           	array(
            	'name' 		=> __( 'House Keeping', 'wp-email-template' ),
                'type' 		=> 'heading',
            ),
			array(
				'name' 		=> __( 'Clean up on Deletion', 'wp-email-template' ),
				'desc' 		=> __( 'On deletion (not deactivate) the plugin will completely remove all tables and data it created, leaving no trace it was ever here.', 'wp-email-template' ),
				'id' 		=> $this->plugin_name . '_clean_on_deletion',
				'type' 		=> 'onoff_checkbox',
				'default'	=> '0',
				'separate_option'	=> true,
				'free_version'		=> true,
				'checked_value'		=> '1',
				'unchecked_value'	=> '0',
				'checked_label'		=> __( 'ON', 'wp-email-template' ),
				'unchecked_label' 	=> __( 'OFF', 'wp-email-template' ),
			),

           	array(
            	'name' 		=> __( 'WP Email Template Activation', 'wp-email-template' ),
                'type' 		=> 'heading',
                'id'		=> 'wp_email_template_activation_box',
                'is_box'	=> true,
           	),
			array(
				'name' 		=> __( 'Apply Template', 'wp-email-template' ),
				'desc' 		=> __( 'ON will apply templates to all emails are sent via wp_mail() function of WordPress.', 'wp-email-template' ),
				'id' 		=> 'apply_template_all_emails',
				'class'		=> 'apply_template_all_emails',
				'type' 		=> 'onoff_checkbox',
				'default' 	=> 'yes',
				'free_version'		=> true,
				'checked_value'		=> 'yes',
				'unchecked_value'	=> 'no',
				'checked_label'		=> __( 'ON', 'wp-email-template' ),
				'unchecked_label' 	=> __( 'OFF', 'wp-email-template' ),
			),

			array(
            	'name' 		=> __( 'WP Email Content Type', 'wp-email-template' ),
                'type' 		=> 'heading',
                'class'		=> 'show_template_container',
                'id'		=> 'wp_email_content_type_box',
                'is_box'	=> true,
           	),
			array(
				'name' 		=> __( 'Email Content Type', 'wp-email-template' ),
				'id' 		=> 'email_content_type',
				'type' 		=> 'select',
				'default'	=> 'multipart',
				'options'	=> array(
						'html'      => __( 'HTML', 'wp-email-template' ),
						'multipart' => __( 'Multipart', 'wp-email-template' ),
					),
				'free_version'		=> true,
			),

			array(
            	'name' 		=> __( 'Template Width', 'wp-email-template' ),
                'type' 		=> 'heading',
                'class'		=> 'show_template_container',
                'id'		=> 'template_width_box',
                'is_box'	=> true,
           	),
			array(
				'name' 		=> __( 'Width', 'wp-email-template' ),
				'desc' 		=> 'px.' . __( 'The industry default and recommended width for email templates is 600px.', 'wp-email-template' ),
				'id' 		=> 'email_container_width',
				'type' 		=> 'text',
				'css'		=> 'width: 60px;',
				'default'	=> '600',
				'free_version'		=> true
			),
			array(
            	'name' 		=> __( 'Template Background', 'wp-email-template' ),
                'type' 		=> 'heading',
                'class'		=> 'show_template_container',
                'id'		=> 'template_bg_box',
                'is_box'	=> true,
           	),
			array(
				'name' 		=> __( 'Background colour', 'wp-email-template' ),
				'desc' 		=> __( "Email template background colour.", 'wp-email-template' ),
				'id' 		=> 'background_colour',
				'type' 		=> 'bg_color',
				'default'	=> array( 'enable' => 1, 'color' => '#D7D8B0' ),
				'free_version'		=> true
			),
			array(
				'name' 		=> __( 'Background Pattern', 'wp-email-template' ),
				'id' 		=> 'deactivate_pattern_background',
				'type' 		=> 'onoff_checkbox',
				'default' 	=> 'no',
				'free_version'		=> true,
				'checked_value'		=> 'no',
				'unchecked_value'	=> 'yes',
				'checked_label'		=> __( 'ON', 'wp-email-template' ),
				'unchecked_label' 	=> __( 'OFF', 'wp-email-template' ),
			),

			array(
            	'name' 		=> __( 'Outlook 2007 / 2010 / 2013 Box Border', 'wp-email-template' ),
                'type' 		=> 'heading',
                'class'		=> 'show_template_container',
                'id'		=> 'outlook_border_box',
                'is_box'	=> true,
           	),
			array(
				'name' 		=> __( 'Box Border', 'wp-email-template' ),
				'desc' 		=> __( 'ON will show a white box border around email Template in Outlook. Outlook does not support border colour, size or type. Any Border style created with the dynamic settings will not show in Outlook.', 'wp-email-template' ),
				'id' 		=> 'outlook_apply_border',
				'type' 		=> 'onoff_checkbox',
				'default' 	=> 'yes',
				'free_version'		=> true,
				'checked_value'		=> 'yes',
				'unchecked_value'	=> 'no',
				'checked_label'		=> __( 'ON', 'wp-email-template' ),
				'unchecked_label' 	=> __( 'OFF', 'wp-email-template' ),
			),

			array(
            	'name' 		=> __( 'WooCommerce Configuration', 'wp-email-template' ),
                'type' 		=> 'heading',
                'class'		=> 'show_template_container',
                'id'		=> 'wc_configuration_box',
                'is_box'	=> true,
           	),
			array(
				'name' 		=> __( 'Apply to WooCommerce emails', 'wp-email-template' ),
				'desc' 		=> __( 'If WooCommerce is installed, select YES to apply this template to all WooCommerce emails.', 'wp-email-template' ),
				'id' 		=> 'apply_for_woo_emails',
				'type' 		=> 'onoff_checkbox',
				'default' 	=> '',
				'free_version'		=> true,
				'checked_value'		=> 'yes',
				'unchecked_value'	=> '',
				'checked_label'		=> __( 'YES', 'wp-email-template' ),
				'unchecked_label' 	=> __( 'NO', 'wp-email-template' ),
			),

			array(
            	'name' 		=> __( 'Help Notes', 'wp-email-template' ),
                'type' 		=> 'heading',
                'id'		=> 'font_help_notes_box',
                'class'		=> 'show_template_container',
                'is_box'	=> true,
           	),
           	array(
            	'name' 		=> __( 'Email Font Render', 'wp-email-template' ),
				'desc'		=> __( "<strong>Important!</strong> The a3rev dynamic font editors give you the choice of 16 Default or Web safe fonts plus 364 Google fonts. The 16 Web safe fonts work in all email clients but be aware that Google fonts don't. Google fonts are fetched by &lt;link&gt; from Google. Gmail and Microsoft Outlook remove all &lt;link&gt; tags and hence default to one of the Web safe fonts. Interestingly iOS, Android Gmail and Windows mobile don't and Google fonts show beautifully. Go figure the weird and wonderful world of HTML email template design.", 'wp-email-template' ),
                'type' 		=> 'heading',
           	),

        ));
	}

	public function include_script() {
	?>
<script>
(function($) {
$(document).ready(function() {
	if ( $("input.psad_explanation:checked").val() == 'yes') {
		$(".psad_explanation_message").show();
	} else {
		$(".psad_explanation_message").hide();
	}

	if ( $("input.apply_template_all_emails:checked").val() != 'yes') {
		$(".show_template_container").css( {'visibility': 'hidden', 'height' : '0px', 'overflow' : 'hidden', 'margin-bottom' : '0px'} );
	}

	$(document).on( "a3rev-ui-onoff_checkbox-switch", '.psad_explanation', function( event, value, status ) {
		if ( status == 'true' ) {
			$(".psad_explanation_message").slideDown();
		} else {
			$(".psad_explanation_message").slideUp();
		}
	});

	$(document).on( "a3rev-ui-onoff_checkbox-switch", '.apply_template_all_emails', function( event, value, status ) {
		$(".show_template_container").attr('style','display:none;');
		if ( status == 'true' ) {
			$(".show_template_container").slideDown();
		} else {
			$(".show_template_container").slideUp();
		}
	});

});
})(jQuery);
</script>
    <?php
	}
}

global $wp_email_template_general_settings;
$wp_email_template_general_settings = new WP_Email_Template_General_Settings();

/**
 * wp_email_template_general_settings_form()
 * Define the callback function to show subtab content
 */
function wp_email_template_general_settings_form() {
	global $wp_email_template_general_settings;
	$wp_email_template_general_settings->settings_form();
}

?>