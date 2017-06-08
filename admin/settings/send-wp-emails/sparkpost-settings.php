<?php
/* "Copyright 2012 A3 Revolution Web Design" This software is distributed under the terms of GNU GENERAL PUBLIC LICENSE Version 3, 29 June 2007 */
// File Security Check
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<?php
/*-----------------------------------------------------------------------------------
WP Email Teplate Send WP Emails General Settings

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

class WP_ET_Send_WP_Emails_SparkPost_Settings
{
	/**
	 * @var array
	 */
	public $form_fields = array();

	/**
	 * @var string
	 * You must change to correct form key that you are working
	 */
	public $form_key = 'wp_et_sparkpost_settings';

	/*-----------------------------------------------------------------------------------*/
	/* __construct() */
	/* Settings Constructor */
	/*-----------------------------------------------------------------------------------*/
	public function __construct() {
		$this->init_form_fields();
	}

	/*-----------------------------------------------------------------------------------*/
	/* init_form_fields() */
	/* Init all fields of this form */
	/*-----------------------------------------------------------------------------------*/
	public function init_form_fields() {
		global $email_delivery_provider;

  		// Define settings
     	$this->form_fields = apply_filters( $this->form_key . '_settings_fields', array(

			// SparkPost Configuration
			array(
            	'name' 		=> __( 'SparkPost Activation', 'wp-email-template' ),
				'class'		=> 'select_email_delivery_provider_container',
                'type' 		=> 'heading',
                'id'		=> 'sparkpost_activation_box',
                'is_box'	=> true,
                'is_active'	=> ( ! empty( $email_delivery_provider ) && 'sparkpost' == $email_delivery_provider ) ? true : false,
           	),
			array(
				'name' 		=> __( 'SparkPost Provider', 'wp-email-template' ),
				'id' 		=> 'email_delivery_provider',
				'class'		=> 'email_delivery_provider',
				'type' 		=> 'onoff_radio',
				'default' 	=> 'smtp',
				'onoff_options' => array(
					array(
						'val' 				=> 'sparkpost',
						'text' 				=> __( 'Send up to 500 emails per day for free', 'wp-email-template' ),
						'checked_label'		=> __( 'ON', 'wp-email-template' ) ,
						'unchecked_label' 	=> __( 'OFF', 'wp-email-template' ) ,
					),

				),
			),
			array(
            	'name' 		=> __( 'SparkPost Credentials', 'wp-email-template' ),
				'desc'		=> sprintf( __( 'Send up to 500 emails daily for free <a href="%s" target="_blank">with SparkPost</a>. Register an account and generate the API Key or SMTP creds and enter those here.', 'wp-email-template' ), 'https://app.sparkpost.com/sign-up' ),
                'type' 		=> 'heading',
                'class'		=> 'sparkpost_configuration_container',
           	),
			array(  
				'name' 		=> __( 'Connect Type', 'wp-email-template' ),
				'class'		=> 'sparkpost_connect_type',
				'id' 		=> 'wp_et_sparkpost_provider_configuration[connect_type]',
				'type' 		=> 'switcher_checkbox',
				'default'	=> 'api',
				'checked_value'		=> 'api',
				'unchecked_value'	=> 'smtp',
				'checked_label'		=> __( 'HTTP API', 'wp-email-template' ),
				'unchecked_label' 	=> __( 'SMTP API', 'wp-email-template' ),
				'separate_option'	=> true,
			),
			
			array(
				'class'		=> 'sparkpost_api_connect_container',
                'type' 		=> 'heading',
           	),
			array(  
				'name' 		=> __( 'SparkPost Template', 'wp-email-template' ),
				'id' 		=> 'wp_et_sparkpost_provider_configuration[template_id]',
				'desc'		=> '</span><span style="font-size: 12px;">'
					. '<br />' . __( '- Leave this field blank if you want your custom WP Email HTML Template to be applied to outgoing emails.', 'wp-email-template' )
					. '<br />' . __( "- If you do use a SparkPost Template, WP Email Template will auto detect you have set this and auto won't apply the WP Email HTML template to emails sent from your site.", 'wp-email-template' ),
				'type' 		=> 'text',
				'default'	=> '',
				'placeholder'	=> __( 'enter Template ID', 'wp-email-template' ),
				'separate_option'	=> true,
			),
			array(
				'class'		=> 'sparkpost_smtp_connect_container',
                'type' 		=> 'heading',
           	),
			array(  
				'name' 		=> __( 'Port', 'wp-email-template' ),
				'id' 		=> 'wp_et_sparkpost_provider_configuration[smtp_port]',
				'type' 		=> 'select',
				'css'		=> 'width: 180px;',
				'default'	=> 587,
				'options'	=> array(
					587  => '587 TLS(Encryption)',
					2525 => '2525 TLS(Encryption)',
				),
				'separate_option'	=> true,
			),
			array(  
				'name' 		=> __( 'SparkPost Template', 'wp-email-template' ),
				'id' 		=> 'wp_et_sparkpost_provider_configuration[smtp_template_id]',
				'desc'		=> '</span><span>' . __( 'SparkPost only supports using the SparkPost Template with   HTTP API Connection', 'wp-email-template' ),
				'type' 		=> 'text',
				'default'	=> '',
				'css'		=> 'display: none;',
				'separate_option'	=> true,
			),

			array(
				'class' 	=> 'sparkpost_configuration_container',
                'type' 		=> 'heading',
           	),
           	array(  
				'name' 		=> __( 'SparkPost API', 'wp-email-template' ),
				'id' 		=> 'wp_et_sparkpost_provider_configuration[api_key]',
				'desc'		=> '</span><span style="font-size: 12px;"><br />' . __( 'For SMTP, set up an API key with the <strong>Send via SMTP</strong> permission', 'wp-email-template' )
				. '<br />' . __( 'For HTTP API, set up an API Key with the <strong>Transmissions: Read/Write</strong> permission', 'wp-email-template' )
				. '<br />' . sprintf( __( '<a href="%s" target="_blank">Need help creating a SparkPost API key?</a>', 'wp-email-template' ), 'https://support.sparkpost.com/customer/portal/articles/1933377-create-api-keys' ),
				'type' 		=> 'text',
				'default'	=> '',
				'css'		=> 'width: 400px;',
				'placeholder'	=> __( 'enter API Key', 'wp-email-template' ),
				'separate_option'	=> true,
			),
			array(  
				'name' 		=> __( 'SparkPost From Email', 'wp-email-template' ),
				'id' 		=> 'wp_et_sparkpost_provider_configuration[from_email]',
				'desc'		=> '</span><span style="font-size: 12px;"><br />' . __( '<strong>Important!</strong> Domain must match with one of your verified sending domains. And this from email will override from email from General Settings', 'wp-email-template' ),
				'type' 		=> 'text',
				'default'	=> '',
				'separate_option'	=> true,
			),
			array(  
				'name' 		=> __( 'Track Opens', 'wp-email-template' ),
				'id' 		=> 'wp_et_sparkpost_provider_configuration[enable_track_opens]',
				'type' 		=> 'onoff_checkbox',
				'default' 	=> '1',
				'checked_value'		=> '1',
				'unchecked_value'	=> '0',
				'checked_label'		=> __( 'ON', 'wp-email-template' ),
				'unchecked_label' 	=> __( 'OFF', 'wp-email-template' ),
				'separate_option'	=> true,
			),
			array(  
				'name' 		=> __( 'Track Clicks', 'wp-email-template' ),
				'id' 		=> 'wp_et_sparkpost_provider_configuration[enable_track_clicks]',
				'type' 		=> 'onoff_checkbox',
				'default' 	=> '1',
				'checked_value'		=> '1',
				'unchecked_value'	=> '0',
				'checked_label'		=> __( 'ON', 'wp-email-template' ),
				'unchecked_label' 	=> __( 'OFF', 'wp-email-template' ),
				'separate_option'	=> true,
			),
        ));
	}

	public function include_script() {
	?>
<script>
(function($) {
$(document).ready(function() {

	// SparkPost Configuration
	if ( $("input.sparkpost_connect_type:checked").val() == 'api') {
		$(".sparkpost_smtp_connect_container").css( {'visibility': 'hidden', 'height' : '0px', 'overflow' : 'hidden', 'margin-bottom' : '0px'} );
	} else {
		$(".sparkpost_api_connect_container").css( {'visibility': 'hidden', 'height' : '0px', 'overflow' : 'hidden', 'margin-bottom' : '0px'} );
	}
	$(document).on( "a3rev-ui-onoff_checkbox-switch", '.sparkpost_connect_type', function( event, value, status ) {
		$(".sparkpost_api_connect_container").attr('style','display:none;');
		$(".sparkpost_smtp_connect_container").attr('style','display:none;');
		if ( status == 'true' ) {
			$(".sparkpost_api_connect_container").slideDown();
			$(".sparkpost_smtp_connect_container").slideUp();
		} else {
			$(".sparkpost_api_connect_container").slideUp();
			$(".sparkpost_smtp_connect_container").slideDown();
		}
	});
});
})(jQuery);
</script>
    <?php
	}
}

global $wp_et_send_wp_emails_sparkpost_settings;
$wp_et_send_wp_emails_sparkpost_settings = new WP_ET_Send_WP_Emails_SparkPost_Settings();

?>