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

class WP_ET_Send_WP_Emails_General_Settings extends WP_Email_Tempate_Admin_UI
{
	
	/**
	 * @var string
	 */
	private $parent_tab = 'generate';
	
	/**
	 * @var array
	 */
	private $subtab_data;
	
	/**
	 * @var string
	 * You must change to correct option name that you are working
	 */
	public $option_name = 'wp_et_send_wp_emails_general';
	
	/**
	 * @var string
	 * You must change to correct form key that you are working
	 */
	public $form_key = 'wp_et_send_wp_emails_general';
	
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
				'success_message'	=> __( 'Sending Settings successfully saved.', 'wp-email-template' ),
				'error_message'		=> __( 'Error: Sending Settings can not save.', 'wp-email-template' ),
				'reset_message'		=> __( 'Sending Settings successfully reseted.', 'wp-email-template' ),
			);
		
		add_action( $this->plugin_name . '-' . $this->form_key . '_settings_end', array( $this, 'include_script' ) );
			
		add_action( $this->plugin_name . '_set_default_settings' , array( $this, 'set_default_settings' ) );
		
		add_action( $this->plugin_name . '-' . $this->form_key . '_settings_init' , array( $this, 'after_save_settings' ) );
		
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
	/* after_save_settings()
	/* Process when clean on deletion option is un selected */
	/*-----------------------------------------------------------------------------------*/
	public function after_save_settings() {
		global $wp_email_template_admin_interface;
		
		if ( isset( $_POST['bt_save_settings'] ) && ! isset( $_POST[$this->option_name]['email_delivery_provider'] ) ) {
			$settings_array = get_option( $this->option_name, array() );
			$settings_array['email_delivery_provider'] = 'smtp';
			update_option( $this->option_name, $settings_array );
		}
		if ( isset( $_POST['wp-email-template-send-test-email-now'] ) ) {
			$wp_email_template_test_send_email = trim( $_POST['wp_email_template_test_send_email'] );
			update_option( 'wp_email_template_test_send_email', $wp_email_template_test_send_email );
			if ( '' != trim( $wp_email_template_test_send_email ) ) {

				// Send a test email here
				global $wp_et_send_wp_emails;
				$sent_result = $wp_et_send_wp_emails->send_a_test_email( $wp_email_template_test_send_email  );
				if ( $sent_result ) {
					echo $wp_email_template_admin_interface->get_success_message( __( 'Test Email successfully sent', 'wp-email-template' ) );
				} else {
					echo $wp_email_template_admin_interface->get_error_message( __( 'Error: Test Email can not send', 'wp-email-template' ) . '<br /><a href="#TB_inline?width=600&height=550&inlineId=test_error_container" class="thickbox" >' . __( 'View Detailed Debug', 'wp-email-template' ) . '</a>' );
				}
			} else {
				echo $wp_email_template_admin_interface->get_error_message( __( 'The email address for test need to enter', 'wp-email-template' ) );
			}
		}
		
		
		// Check the ports are openned by server for some smtp delivery
		$settings_array = get_option( 'wp_et_send_wp_emails_general', array() );
		if ( $settings_array['email_sending_option'] == 'provider' ) {
			$errno = '';
			$errstr = '';
			$timeout = 3;
			switch( $settings_array['email_delivery_provider'] ) :
				case 'mandrill':
					global $wp_et_send_wp_emails;
					$wp_et_mandrill_provider_configuration = get_option( 'wp_et_mandrill_provider_configuration', array() );
					if ( $wp_et_mandrill_provider_configuration['mandrill_connect_type'] == 'smtp' ) {

						// Check connect to smtp server
						$check_connect =  @fsockopen( 'smtp.mandrillapp.com' , $wp_et_mandrill_provider_configuration['smtp_port'], $errno, $errstr, $timeout);
						if ( ! $check_connect ) {
							$error_message = sprintf( __( 'Error - <strong>%s</strong> : Could not connect to SMTP host <strong>%s</strong>.', 'wp-email-template' ), __( 'Mandrill', 'wp-email-template' ), 'smtp.mandrillapp.com' );
							$error_message .= '<ul>';
							$error_message .= sprintf( __( '- Port <strong>%s</strong> is blocked on your server by firewall. If it is contact your Hosting support and ask them to', 'wp-email-template' ), $wp_et_mandrill_provider_configuration['smtp_port'] );
							$error_message .= '<li>';
							$error_message .= sprintf( __( '1. Open the Port <strong>%s</strong>', 'wp-email-template' ), $wp_et_mandrill_provider_configuration['smtp_port'] );
							$error_message .= '</li>';
							$error_message .= '<li>';
							$error_message .= __( '2. Ensure that it can be listened to from the outside.', 'wp-email-template' );
							$error_message .= '</li>';
							$error_message .= '</ul>';
							echo $wp_email_template_admin_interface->get_error_message( $error_message );
						}

						// check api key
						$api_key_valid = $wp_et_send_wp_emails->check_mandrill_api_key( trim( $wp_et_mandrill_provider_configuration['smtp_password'] ) );
						if ( $api_key_valid ) {
							update_option( 'wp_et_mandrill_api_key_valid', 1 );
						} else {
							delete_option( 'wp_et_mandrill_api_key_valid');
							echo $wp_email_template_admin_interface->get_error_message(  __( "Your Mandrill API key is invalid", 'wp-email-template' ) );
						}
					} else {
						// check api key
						$api_key_valid = $wp_et_send_wp_emails->check_mandrill_api_key( trim( $wp_et_mandrill_provider_configuration['api_key'] ) );
						if ( $api_key_valid ) {
							update_option( 'wp_et_mandrill_api_key_valid', 1 );
						} else {
							delete_option( 'wp_et_mandrill_api_key_valid');
							echo $wp_email_template_admin_interface->get_error_message(  __( "Your Mandrill API key is invalid", 'wp-email-template' ) );
						}
					}
				break;
				case 'sparkpost':
					$wp_et_sparkpost_provider_configuration = get_option( 'wp_et_sparkpost_provider_configuration', array() );
					if ( $wp_et_sparkpost_provider_configuration['connect_type'] == 'smtp' ) {
						delete_option( 'wp_et_sparkpost_sent_email_error' );

						// Check connect to smtp server
						$check_connect =  @fsockopen( 'smtp.sparkpostmail.com', (int) $wp_et_sparkpost_provider_configuration['smtp_port'], $errno, $errstr, $timeout);
						if ( ! $check_connect ) {
							$error_message = sprintf( __( 'Error - <strong>%s</strong> : Could not connect to SMTP host <strong>%s</strong>.', 'wp-email-template' ), __( 'SparkPost', 'wp-email-template' ), 'smtp.sparkpostmail.com' );
							$error_message .= '<ul>';
							$error_message .= sprintf( __( '- Port <strong>%s</strong> is blocked on your server by firewall. If it is contact your Hosting support and ask them to', 'wp-email-template' ), $wp_et_sparkpost_provider_configuration['smtp_port'] );
							$error_message .= '<li>';
							$error_message .= sprintf( __( '1. Open the Port <strong>%s</strong>', 'wp-email-template' ), $wp_et_sparkpost_provider_configuration['smtp_port'] );
							$error_message .= '</li>';
							$error_message .= '<li>';
							$error_message .= __( '2. Ensure that it can be listened to from the outside.', 'wp-email-template' );
							$error_message .= '</li>';
							$error_message .= '</ul>';
							echo $wp_email_template_admin_interface->get_error_message( $error_message );
						}
					}
				break;
				case 'gmail-smtp':
					$wp_et_gmail_smtp_provider_configuration = get_option( 'wp_et_gmail_smtp_provider_configuration', array() );
					$smtp_port = 465;
					if ( isset( $wp_et_gmail_smtp_provider_configuration['smtp_port'] ) ) {
						$smtp_port = (int) $wp_et_gmail_smtp_provider_configuration['smtp_port'];
					}
					// Check connect to smtp server
					$check_connect =  @fsockopen( 'smtp.gmail.com' , $smtp_port, $errno, $errstr, $timeout);
					if ( ! $check_connect ) {
						$error_message = sprintf( __( 'Error - <strong>%s</strong> : Could not connect to SMTP host <strong>%s</strong>.', 'wp-email-template' ), __( 'Gmail', 'wp-email-template' ), 'smtp.gmail.com' );
						$error_message .= '<ul>';
						$error_message .= sprintf( __( '- Port <strong>%s</strong> is blocked on your server by firewall. If it is contact your Hosting support and ask them to', 'wp-email-template' ), $smtp_port );
						$error_message .= '<li>';
						$error_message .= sprintf( __( '1. Open the Port <strong>%s</strong>', 'wp-email-template' ), $smtp_port );
						$error_message .= '</li>';
						$error_message .= '<li>';
						$error_message .= __( '2. Ensure that it can be listened to from the outside.', 'wp-email-template' );
						$error_message .= '</li>';
						$error_message .= '</ul>';
						echo $wp_email_template_admin_interface->get_error_message( $error_message );
					}
				break;
				default:
					$wp_et_smtp_provider_configuration = get_option( 'wp_et_smtp_provider_configuration', array() );
					// Check connect to smtp server
					$check_connect =  @fsockopen( $wp_et_smtp_provider_configuration['smtp_host'] , $wp_et_smtp_provider_configuration['smtp_port'], $errno, $errstr, $timeout);
					if ( ! $check_connect ) {
						$error_message = sprintf( __( 'Error - <strong>%s</strong> : Could not connect to SMTP host <strong>%s</strong>. The causes can from:', 'wp-email-template' ), __( 'SMTP', 'wp-email-template' ), $wp_et_smtp_provider_configuration['smtp_host'] );
						$error_message .= '<ul>';
						$error_message .= '<li>';
						$error_message .= sprintf( __( '- Sure your SMTP host <strong>%s</strong> is Correct', 'wp-email-template' ), $wp_et_smtp_provider_configuration['smtp_host'] );
						$error_message .= '</li>';
						$error_message .= '<li>';
						$error_message .= sprintf( __( '- Port <strong>%s</strong> is blocked on your server by firewall. First check the Port Number is Correct. If it is contact your Hosting support and ask them to', 'wp-email-template' ), $wp_et_smtp_provider_configuration['smtp_port'] );
						$error_message .= '<ul>';
						$error_message .= '<li>';
						$error_message .= sprintf( __( '1. Open the Port <strong>%s</strong>', 'wp-email-template' ), $wp_et_smtp_provider_configuration['smtp_port'] );
						$error_message .= '</li>';
						$error_message .= '<li>';
						$error_message .= __( '2. Ensure that it can be listened to from the outside.', 'wp-email-template' );
						$error_message .= '</li>';
						$error_message .= '</ul>';
						$error_message .= '</li>';
						$error_message .= '</ul>';
						echo $wp_email_template_admin_interface->get_error_message( $error_message );
					}
				break;
			endswitch;
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
			'label'				=> __( 'Sending Settings', 'wp-email-template' ),
			'callback_function'	=> 'wp_et_send_wp_emails_general_settings_form',
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

		if ( is_admin() ) {
			global $email_delivery_provider;
			if ( isset( $_POST['wp_et_send_wp_emails_general'] ) )  {
				$email_delivery_provider = $_POST['wp_et_send_wp_emails_general']['email_delivery_provider'];
			} else {
				$wp_et_send_wp_emails_general = get_option( 'wp_et_send_wp_emails_general', array( 'email_delivery_provider' => 'smtp' ) );
				$email_delivery_provider = $wp_et_send_wp_emails_general['email_delivery_provider'];
			}
		}

  		// Define settings			
     	$this->form_fields = array(
		
			array(
            	'name' 		=> __( 'Configure WordPress Email Sending', 'wp-email-template' ),
				'desc'		=> __( 'Email Spammers have made successful email delivery a very complicated and specialized function. WordPress by default will use your web hosts local mail server to send all WordPress and plugin generated emails. Generally emails sent from a web host local mail server have poor delivery rates because they have no reputation. Use the settings below to improve your delivery rate by configuring a custom sending provider.', 'wp-email-template' ),
                'type' 		=> 'heading',
                'id'		=> 'configure_sending_provider_box',
                'is_box'	=> true,
           	),
			array(  
				'name' 		=> __( 'Via Web Host', 'wp-email-template' ),
				'id' 		=> 'email_sending_option',
				'type' 		=> 'onoff_radio',
				'default' 	=> 'local',
				'onoff_options' => array(
					array(
						'val' 				=> 'local',
						'text' 				=> __( "WordPress Default email send option uses your web host's local mail server to send emails.", 'wp-email-template' ) ,
						'checked_label'		=> __( 'ON', 'wp-email-template' ) ,
						'unchecked_label' 	=> __( 'OFF', 'wp-email-template' ) ,
					),
					
				),			
			),
			
			array(
				'class'		=> 'select_email_delivery_local_container',
                'type' 		=> 'heading',
           	),
			array(  
				'name' 		=> __( 'GoDaddy Hosting', 'wp-email-template' ),
				'desc'		=> __( 'Turn ON if Hosting with GoDaddy and it auto sets the smtp host to <strong>relay-hosting.secureserver.net</strong>', 'wp-email-template' ),
				'id' 		=> 'is_godaddy_hosting',
				'type' 		=> 'onoff_checkbox',
				'default' 	=> 'no',
				'checked_value'		=> 'yes',
				'unchecked_value'	=> 'no',
				'checked_label'		=> __( 'ON', 'wp-email-template' ),
				'unchecked_label' 	=> __( 'OFF', 'wp-email-template' ),
			),
			
			array(
                'type' 		=> 'heading',
           	),
			array(  
				'name' 		=> __( 'Via Provider', 'wp-email-template' ),
				'class'		=> 'email_sending_option_provider',
				'id' 		=> 'email_sending_option',
				'type' 		=> 'onoff_radio',
				'default' 	=> 'local',
				'onoff_options' => array(
					array(
						'val' 				=> 'provider',
						'text' 				=> '',
						'checked_label'		=> __( 'ON', 'wp-email-template' ) ,
						'unchecked_label' 	=> __( 'OFF', 'wp-email-template' ) ,
					),

				),
			),

			// SMTP Configuration
			array(
            	'name' 		=> __( 'SMTP Activation', 'wp-email-template' ),
				'class'		=> 'select_email_delivery_provider_container',
                'type' 		=> 'heading',
                'id'		=> 'smtp_activation_box',
                'is_box'	=> true,
                'is_active'	=> ( ! empty( $email_delivery_provider ) && 'smtp' == $email_delivery_provider ) ? true : false,
           	),
			array(  
				'name' 		=> __( 'SMTP Provider', 'wp-email-template' ),
				'id' 		=> 'email_delivery_provider',
				'class'		=> 'email_delivery_provider',
				'type' 		=> 'onoff_radio',
				'default' 	=> 'smtp',
				'onoff_options' => array(
					array(
						'val' 				=> 'smtp',
						'text' 				=> '',
						'checked_label'		=> __( 'ON', 'wp-email-template' ) ,
						'unchecked_label' 	=> __( 'OFF', 'wp-email-template' ) ,
					),
				),
			),
			array(
            	'name' 		=> __( 'SMTP Configuration', 'wp-email-template' ),
            	'class'		=> 'smtp_configuration_container',
                'type' 		=> 'heading',
           	),
			array(  
				'name' 		=> __( 'Host', 'wp-email-template' ),
				'id' 		=> 'wp_et_smtp_provider_configuration[smtp_host]',
				'type' 		=> 'text',
				'default'	=> '',
				'separate_option'	=> true,
			),
			array(  
				'name' 		=> __( 'Port', 'wp-email-template' ),
				'id' 		=> 'wp_et_smtp_provider_configuration[smtp_port]',
				'style'		=> 'width:100px;',	
				'type' 		=> 'text',
				'default'	=> '25',
				'separate_option'	=> true,
			),
			array(  
				'name' 		=> __( 'Encryption', 'wp-email-template' ),
				'id' 		=> 'wp_et_smtp_provider_configuration[smtp_encrypt_type]',
				'type' 		=> 'onoff_radio',
				'default' 	=> 'none',
				'separate_option'	=> true,
				'onoff_options' => array(
					array(
						'val' 				=> 'none',
						'text' 				=> __( 'No encryption', 'wp-email-template' ),
						'checked_label'		=> __( 'ON', 'wp-email-template' ) ,
						'unchecked_label' 	=> __( 'OFF', 'wp-email-template' ) ,
					),
					array(
						'val' 				=> 'ssl',
						'text' 				=> __( 'Use SSL encryption (supported on port 465)', 'wp-email-template' ),
						'checked_label'		=> __( 'ON', 'wp-email-template' ) ,
						'unchecked_label' 	=> __( 'OFF', 'wp-email-template' ) ,
					),
					array(
						'val' 				=> 'tls',
						'text' 				=> __( 'Use TLS encryption.', 'wp-email-template' ),
						'checked_label'		=> __( 'ON', 'wp-email-template' ) ,
						'unchecked_label' 	=> __( 'OFF', 'wp-email-template' ) ,
					),
				),			
			),
			array(  
				'name' 		=> __( 'Enable Authentication', 'wp-email-template' ),
				'class'		=> 'enable_smtp_authentication',
				'id' 		=> 'wp_et_smtp_provider_configuration[enable_smtp_authentication]',
				'type' 		=> 'onoff_checkbox',
				'default' 	=> 'yes',
				'checked_value'		=> 'yes',
				'unchecked_value'	=> 'no',
				'checked_label'		=> __( 'ON', 'wp-email-template' ),
				'unchecked_label' 	=> __( 'OFF', 'wp-email-template' ),
				'separate_option'	=> true,
			),
			
			array(
				'class'		=> 'smtp_authentication_container',
                'type' 		=> 'heading',
           	),
			array(  
				'name' 		=> __( 'SMTP Username', 'wp-email-template' ),
				'id' 		=> 'wp_et_smtp_provider_configuration[smtp_username]',
				'type' 		=> 'text',
				'default'	=> '',
				'separate_option'	=> true,
			),
			array(  
				'name' 		=> __( 'SMTP Password', 'wp-email-template' ),
				'id' 		=> 'wp_et_smtp_provider_configuration[smtp_password]',
				'type' 		=> 'password',
				'default'	=> '',
				'separate_option'	=> true,
			),


			// Gmail SMTP Configuration
			array(
            	'name' 		=> __( 'Gmail SMTP Activation', 'wp-email-template' ),
				'class'		=> 'select_email_delivery_provider_container',
                'type' 		=> 'heading',
                'id'		=> 'gmail_smtp_activation_box',
                'is_box'	=> true,
                'is_active'	=> ( ! empty( $email_delivery_provider ) && 'gmail-smtp' == $email_delivery_provider ) ? true : false,
           	),
			array(  
				'name' 		=> __( 'Gmail SMTP Provider', 'wp-email-template' ),
				'id' 		=> 'email_delivery_provider',
				'class'		=> 'email_delivery_provider',
				'type' 		=> 'onoff_radio',
				'default' 	=> 'smtp',
				'onoff_options' => array(
					array(
						'val' 				=> 'gmail-smtp',
						'text' 				=> __( 'Gmail limit is 500 emails per day.', 'wp-email-template' ),
						'checked_label'		=> __( 'ON', 'wp-email-template' ) ,
						'unchecked_label' 	=> __( 'OFF', 'wp-email-template' ) ,
					),

				),
			),
			array(
            	'name' 		=> __( 'Gmail SMTP Credentials', 'wp-email-template' ),
				'desc'		=> sprintf( __( 'Due to the 500 email a day sending limit recommend that you open a dedicated Gmail account for this purpose. As an extra security measure we also recommend that you set up a <a href="%s" target="_blank">Google Application Specific Password</a> and use it instead of your Gmail account password.', 'wp-email-template' ), 'https://accounts.google.com/b/0/IssuedAuthSubTokens?hide_authsub=1' ),
                'class'		=> 'gmail_smtp_configuration_container',
                'type' 		=> 'heading',
           	),
			array(  
				'name' 		=> __( 'Port', 'wp-email-template' ),
				'id' 		=> 'wp_et_gmail_smtp_provider_configuration[smtp_port]',
				'type' 		=> 'select',
				'css'		=> 'width: 180px;',
				'default'	=> 465,
				'options'	=> array(
					587 => '587 TLS(Encryption)',
					465 => '465 SSL',
				),
				'separate_option'	=> true,
			),
			array(  
				'name' 		=> __( 'Gmail Username', 'wp-email-template' ),
				'id' 		=> 'wp_et_gmail_smtp_provider_configuration[smtp_username]',
				'type' 		=> 'text',
				'default'	=> '',
				'separate_option'	=> true,
			),
			array(  
				'name' 		=> __( 'Gmail Password', 'wp-email-template' ),
				'id' 		=> 'wp_et_gmail_smtp_provider_configuration[smtp_password]',
				'type' 		=> 'password',
				'default'	=> '',
				'separate_option'	=> true,
			),

			// G Suite SMPT Configuration
			array(
            	'name' 		=> __( 'G SUITE SMTP PREMIUM', 'wp-email-template' ),
				'class'		=> 'select_email_delivery_provider_container',
                'type' 		=> 'heading',
                'id'		=> 'gmail_suite_smtp_activation_box',
                'is_box'	=> true,
                'desc'		=> '<img class="rwd_image_maps" src="'.WP_EMAIL_TEMPLATE_IMAGES_URL.'/premium-g-suite-smtp.png" usemap="#gSuiteSMTPMap" style="width: auto; max-width: 100%;" border="0" />
<map name="gSuiteSMTPMap" id="gSuiteSMTPMap">
	<area shape="rect" coords="260,205,810,280" href="'.$this->pro_plugin_page_url.'" target="_blank" />
</map>',
           	),


			// Mandrill Configuration
			array(
            	'name' 		=> __( 'Mandrill Activation', 'wp-email-template' ),
				'class'		=> 'select_email_delivery_provider_container',
                'type' 		=> 'heading',
                'id'		=> 'mandrill_activation_box',
                'is_box'	=> true,
                'is_active'	=> ( ! empty( $email_delivery_provider ) && 'mandrill' == $email_delivery_provider ) ? true : false,
           	),
			array(
				'name' 		=> __( 'Mandrill Provider', 'wp-email-template' ),
				'id' 		=> 'email_delivery_provider',
				'class'		=> 'email_delivery_provider',
				'type' 		=> 'onoff_radio',
				'default' 	=> 'smtp',
				'onoff_options' => array(
					array(
						'val' 				=> 'mandrill',
						'text' 				=> __( 'Mandrill is a Paying MailChimp account add-on', 'wp-email-template' ),
						'checked_label'		=> __( 'ON', 'wp-email-template' ) ,
						'unchecked_label' 	=> __( 'OFF', 'wp-email-template' ) ,
					),

				),
			),
			array(
            	'name' 		=> __( 'Mandrill Credentials', 'wp-email-template' ),
				'desc'		=> sprintf( __( 'Login to your <a href="%s" target="_blank">MailChimp account</a> and get the Mandrill add-on. Then generate the API Key or SMTP creds and enter those here.', 'wp-email-template' ), 'https://login.mailchimp.com/' ),
                'type' 		=> 'heading',
                'class'		=> 'mandrill_configuration_container',
           	),
			array(  
				'name' 		=> __( 'Connect Type', 'wp-email-template' ),
				'class'		=> 'mandrill_connect_type',
				'id' 		=> 'wp_et_mandrill_provider_configuration[mandrill_connect_type]',
				'type' 		=> 'switcher_checkbox',
				'default'	=> 'api',
				'checked_value'		=> 'api',
				'unchecked_value'	=> 'smtp',
				'checked_label'		=> __( 'API', 'wp-email-template' ),
				'unchecked_label' 	=> __( 'SMTP', 'wp-email-template' ),
				'separate_option'	=> true,
			),
			
			array(
				'class'		=> 'mandrill_api_connect_container',
                'type' 		=> 'heading',
           	),
			array(  
				'name' 		=> __( 'Mandrill API', 'wp-email-template' ),
				'id' 		=> 'wp_et_mandrill_provider_configuration[api_key]',
				'type' 		=> 'text',
				'default'	=> '',
				'placeholder'	=> __( 'enter API key', 'wp-email-template' ),
				'separate_option'	=> true,
			),
			array(  
				'name' 		=> __( 'Track Opens', 'wp-email-template' ),
				'id' 		=> 'wp_et_mandrill_provider_configuration[enable_track_opens]',
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
				'id' 		=> 'wp_et_mandrill_provider_configuration[enable_track_clicks]',
				'type' 		=> 'onoff_checkbox',
				'default' 	=> '1',
				'checked_value'		=> '1',
				'unchecked_value'	=> '0',
				'checked_label'		=> __( 'ON', 'wp-email-template' ),
				'unchecked_label' 	=> __( 'OFF', 'wp-email-template' ),
				'separate_option'	=> true,
			),
			
			array(
				'class'		=> 'mandrill_smtp_connect_container',
                'type' 		=> 'heading',
           	),
			array(  
				'name' 		=> __( 'Host', 'wp-email-template' ),
				'id' 		=> 'wp_et_mandrill_provider_configuration[smtp_host]',
				'type' 		=> 'text',
				'default'	=> 'smtp.mandrillapp.com',
				'placeholder'	=> 'smtp.mandrillapp.com',
				'custom_attributes' => array( 'readonly' => 'readonly' ),
				'separate_option'	=> true,
			),
			array(  
				'name' 		=> __( 'Port', 'wp-email-template' ),
				'id' 		=> 'wp_et_mandrill_provider_configuration[smtp_port]',
				'type' 		=> 'select',
				'css'		=> 'width: 180px;',
				'default'	=> 587,
				'options'	=> array(
					25   => '25 TLS(Encryption)',
					587  => '587 TLS(Encryption)',
					2525 => '2525 TLS(Encryption)',
					465  => '465 SSL',
				),
				'separate_option'	=> true,
			),
			array(  
				'name' 		=> __( 'SMTP Username', 'wp-email-template' ),
				'id' 		=> 'wp_et_mandrill_provider_configuration[smtp_username]',
				'type' 		=> 'text',
				'default'	=> '',
				'separate_option'	=> true,
			),
			array(  
				'name' 		=> __( 'SMTP Password', 'wp-email-template' ),
				'id' 		=> 'wp_et_mandrill_provider_configuration[smtp_password]',
				'type' 		=> 'password',
				'default'	=> '',
				'placeholder'	=> __( 'any valid API key', 'wp-email-template' ),
				'separate_option'	=> true,
			),
		);

		include_once( $this->admin_plugin_dir() . '/settings/send-wp-emails/sparkpost-settings.php' );
		global $wp_et_send_wp_emails_sparkpost_settings;
		$this->form_fields = array_merge( $this->form_fields, $wp_et_send_wp_emails_sparkpost_settings->form_fields );

		$this->form_fields = array_merge( $this->form_fields, array(
			array(
            	'name' 		=> __( 'Send a Test Email', 'wp-email-template' ),
				'class'		=> 'send_a_test_email_container',
				'desc'		=> __( "Test delivery. Type a valid email address that you have access to and click Send Now. If the message successfully sends but you do not receive it - check your Spam folder.", 'wp-email-template' ),
                'type' 		=> 'heading',
                'id'		=> 'send_a_test_email_box',
                'is_box'	=> true,
           	),
			array(  
				'name' 		=> __( 'Send To', 'wp-email-template' ),
				'id' 		=> 'wp_email_template_test_send_email',
				'desc'		=> '</span><input type="submit" class="button button-primary" name="wp-email-template-send-test-email-now" value="'. __('Send Now', 'wp-email-template' ).'" /><span>',
				'type' 		=> 'text',
				'separate_option'	=> true,
				'default'	=> '',
				'placeholder'	=> __( 'test@example.com', 'wp-email-template' ),
			),
        ) );

		$this->form_fields = apply_filters( $this->option_name . '_settings_fields', $this->form_fields );
	}

	public function include_script() {
		wp_enqueue_script( 'jquery-rwd-image-maps' );

		global $wp_et_send_wp_emails_sparkpost_settings;
		$wp_et_send_wp_emails_sparkpost_settings->include_script();
	?>
<script>
(function($) {
$(document).ready(function() {
	if ( $("input.email_sending_option_provider:checked").val() == 'provider') {
		$(".select_email_delivery_local_container").css( {'visibility': 'hidden', 'height' : '0px', 'overflow' : 'hidden', 'margin-bottom' : '0px'} );
	} else {
		$(".select_email_delivery_provider_container").css( {'visibility': 'hidden', 'height' : '0px', 'overflow' : 'hidden', 'margin-bottom' : '0px'} );
	}

	// SMTP Configuration
	if ( $("input.enable_smtp_authentication:checked").val() != 'yes') {
		$(".smtp_authentication_container").css( {'visibility': 'hidden', 'height' : '0px', 'overflow' : 'hidden', 'margin-bottom' : '0px'} );
	}
	$(document).on( "a3rev-ui-onoff_checkbox-switch", '.enable_smtp_authentication', function( event, value, status ) {
		$(".smtp_authentication_container").attr('style','display:none;');
		if ( status == 'true') {
			$(".smtp_authentication_container").slideDown();
		}
	});

	// Mandrill Configuration
	if ( $("input.mandrill_connect_type:checked").val() == 'api') {
		$(".mandrill_smtp_connect_container").css( {'visibility': 'hidden', 'height' : '0px', 'overflow' : 'hidden', 'margin-bottom' : '0px'} );
	} else {
		$(".mandrill_api_connect_container").css( {'visibility': 'hidden', 'height' : '0px', 'overflow' : 'hidden', 'margin-bottom' : '0px'} );
	}
	$(document).on( "a3rev-ui-onoff_checkbox-switch", '.mandrill_connect_type', function( event, value, status ) {
		$(".mandrill_api_connect_container").attr('style','display:none;');
		$(".mandrill_smtp_connect_container").attr('style','display:none;');
		if ( status == 'true' ) {
			$(".mandrill_api_connect_container").slideDown();
		} else {
			$(".mandrill_smtp_connect_container").slideDown();
		}
	});


	$(document).on( "a3rev-ui-onoff_radio-switch", '.email_sending_option_provider', function( event, value, status ) {
		$(".select_email_delivery_provider_container").attr('style','display:none;');
		$(".select_email_delivery_local_container").attr('style','display:none;');
		if ( value == 'provider') {
			$(".select_email_delivery_provider_container").slideDown();
		} else {
			$(".select_email_delivery_local_container").slideDown();
		}
	});

	// Provider Selector
	if ( $("input.email_delivery_provider:checked").val() == 'mandrill' ) {
		$(".smtp_configuration_container").css( {'visibility': 'hidden', 'height' : '0px', 'overflow' : 'hidden', 'margin-bottom' : '0px'} );
		$(".smtp_authentication_container").css( {'visibility': 'hidden', 'height' : '0px', 'overflow' : 'hidden', 'margin-bottom' : '0px'} );
		$(".gmail_smtp_configuration_container").css( {'visibility': 'hidden', 'height' : '0px', 'overflow' : 'hidden', 'margin-bottom' : '0px'} );
		$(".sparkpost_configuration_container").css( {'visibility': 'hidden', 'height' : '0px', 'overflow' : 'hidden', 'margin-bottom' : '0px'} );
		$(".sparkpost_smtp_connect_container").css( {'visibility': 'hidden', 'height' : '0px', 'overflow' : 'hidden', 'margin-bottom' : '0px'} );
		$(".sparkpost_api_connect_container").css( {'visibility': 'hidden', 'height' : '0px', 'overflow' : 'hidden', 'margin-bottom' : '0px'} );
	} else if ( $("input.email_delivery_provider:checked").val() == 'sparkpost' ) {
		$(".smtp_configuration_container").css( {'visibility': 'hidden', 'height' : '0px', 'overflow' : 'hidden', 'margin-bottom' : '0px'} );
		$(".smtp_authentication_container").css( {'visibility': 'hidden', 'height' : '0px', 'overflow' : 'hidden', 'margin-bottom' : '0px'} );
		$(".gmail_smtp_configuration_container").css( {'visibility': 'hidden', 'height' : '0px', 'overflow' : 'hidden', 'margin-bottom' : '0px'} );
		$(".mandrill_configuration_container").css( {'visibility': 'hidden', 'height' : '0px', 'overflow' : 'hidden', 'margin-bottom' : '0px'} );
		$(".mandrill_smtp_connect_container").css( {'visibility': 'hidden', 'height' : '0px', 'overflow' : 'hidden', 'margin-bottom' : '0px'} );
		$(".mandrill_api_connect_container").css( {'visibility': 'hidden', 'height' : '0px', 'overflow' : 'hidden', 'margin-bottom' : '0px'} );
	} else if ( $("input.email_delivery_provider:checked").val() == 'gmail-smtp' ) {
		$(".smtp_configuration_container").css( {'visibility': 'hidden', 'height' : '0px', 'overflow' : 'hidden', 'margin-bottom' : '0px'} );
		$(".smtp_authentication_container").css( {'visibility': 'hidden', 'height' : '0px', 'overflow' : 'hidden', 'margin-bottom' : '0px'} );
		$(".mandrill_configuration_container").css( {'visibility': 'hidden', 'height' : '0px', 'overflow' : 'hidden', 'margin-bottom' : '0px'} );
		$(".mandrill_smtp_connect_container").css( {'visibility': 'hidden', 'height' : '0px', 'overflow' : 'hidden', 'margin-bottom' : '0px'} );
		$(".mandrill_api_connect_container").css( {'visibility': 'hidden', 'height' : '0px', 'overflow' : 'hidden', 'margin-bottom' : '0px'} );
		$(".sparkpost_configuration_container").css( {'visibility': 'hidden', 'height' : '0px', 'overflow' : 'hidden', 'margin-bottom' : '0px'} );
		$(".sparkpost_smtp_connect_container").css( {'visibility': 'hidden', 'height' : '0px', 'overflow' : 'hidden', 'margin-bottom' : '0px'} );
		$(".sparkpost_api_connect_container").css( {'visibility': 'hidden', 'height' : '0px', 'overflow' : 'hidden', 'margin-bottom' : '0px'} );
	} else {
		$(".gmail_smtp_configuration_container").css( {'visibility': 'hidden', 'height' : '0px', 'overflow' : 'hidden', 'margin-bottom' : '0px'} );
		$(".mandrill_configuration_container").css( {'visibility': 'hidden', 'height' : '0px', 'overflow' : 'hidden', 'margin-bottom' : '0px'} );
		$(".mandrill_smtp_connect_container").css( {'visibility': 'hidden', 'height' : '0px', 'overflow' : 'hidden', 'margin-bottom' : '0px'} );
		$(".mandrill_api_connect_container").css( {'visibility': 'hidden', 'height' : '0px', 'overflow' : 'hidden', 'margin-bottom' : '0px'} );
		$(".sparkpost_configuration_container").css( {'visibility': 'hidden', 'height' : '0px', 'overflow' : 'hidden', 'margin-bottom' : '0px'} );
		$(".sparkpost_smtp_connect_container").css( {'visibility': 'hidden', 'height' : '0px', 'overflow' : 'hidden', 'margin-bottom' : '0px'} );
		$(".sparkpost_api_connect_container").css( {'visibility': 'hidden', 'height' : '0px', 'overflow' : 'hidden', 'margin-bottom' : '0px'} );
	}

	$(document).on( "a3rev-ui-onoff_radio-switch", '.email_delivery_provider', function( event, value, status ) {
		$(".smtp_configuration_container").attr('style','display:none;');
		$(".smtp_authentication_container").attr('style','display:none;');
		$(".gmail_smtp_configuration_container").attr('style','display:none;');
		$(".mandrill_configuration_container").attr('style','display:none;');
		$(".mandrill_api_connect_container").attr('style','display:none;');
		$(".mandrill_smtp_connect_container").attr('style','display:none;');
		$(".sparkpost_configuration_container").attr('style','display:none;');
		$(".sparkpost_api_connect_container").attr('style','display:none;');
		$(".sparkpost_smtp_connect_container").attr('style','display:none;');
		if ( value == 'mandrill' && status == 'true' ) {
			$(".mandrill_configuration_container").slideDown();
			if ( $("input.mandrill_connect_type:checked").val() == 'api') {
				$(".mandrill_api_connect_container").slideDown();
			} else {
				$(".mandrill_smtp_connect_container").slideDown();
			}
		} else if ( value == 'sparkpost' && status == 'true' ) {
			$(".sparkpost_configuration_container").slideDown();
			if ( $("input.sparkpost_connect_type:checked").val() == 'api') {
				$(".sparkpost_api_connect_container").slideDown();
			} else {
				$(".sparkpost_smtp_connect_container").slideDown();
			}
		} else if ( value == 'gmail-smtp' && status == 'true' ) {
			$(".gmail_smtp_configuration_container").slideDown();
		} else if ( value == 'smtp' && status == 'true' ) {
			$(".smtp_configuration_container").slideDown();
			if ( $("input.enable_smtp_authentication:checked").val() == 'yes') {
				$(".smtp_authentication_container").slideDown();
			}
		}
	});
});
})(jQuery);
</script>
    <?php
	}
}

global $wp_et_send_wp_emails_general_settings;
$wp_et_send_wp_emails_general_settings = new WP_ET_Send_WP_Emails_General_Settings();

/**
 * wp_et_send_wp_emails_general_settings_form()
 * Define the callback function to show subtab content
 */
function wp_et_send_wp_emails_general_settings_form() {
	global $wp_et_send_wp_emails_general_settings;
	$wp_et_send_wp_emails_general_settings->settings_form();
}

?>