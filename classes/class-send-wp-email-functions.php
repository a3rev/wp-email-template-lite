<?php
/**
 * WP Email Template Send WP Emails Functions
 *
 * Table Of Contents
 *
 * get_email_delivery_provider()
 * send_a_test_email()
 */

namespace A3Rev\EmailTemplate;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Send_Wp_Emails_Functions
{
	public $get_email_delivery_provider = 'smtp';

	public function __construct() {
		$wp_et_send_wp_emails_general = get_option( 'wp_et_send_wp_emails_general', array() );

		$get_email_delivery_provider = isset( $wp_et_send_wp_emails_general['email_delivery_provider'] ) ? $wp_et_send_wp_emails_general['email_delivery_provider'] : '';

		// Check if allow custom email wordpress delivery
		if ( isset( $wp_et_send_wp_emails_general['email_sending_option'] ) && $wp_et_send_wp_emails_general['email_sending_option'] == 'provider' ) {

			// Update Email Wordpress to Email Delivery Provider
			switch( $get_email_delivery_provider ) :
				case 'mandrill':
					$this->mandrill_init();
				break;
				case 'sparkpost':
					$this->sparkpost_init();
				break;
				case 'gmail-smtp':
					$this->gmail_smtp_init();
				break;
				default:
					$this->smtp_init();
				break;
			endswitch;

		} elseif ( isset( $wp_et_send_wp_emails_general['is_godaddy_hosting'] ) && $wp_et_send_wp_emails_general['is_godaddy_hosting'] == 'yes' ) {

			// Update SMTP Host to relay-hosting.secureserver.net if it's GoDaddy Hosting
			$this->godaddy_init();

		}
	}

	public function call_smtp_class() {
		global $wp_et_smtp_class;
		$wp_et_smtp_class = new \A3Rev\EmailTemplate\SMTP_Class();
	}

	public function godaddy_init() {

		$this->call_smtp_class();
		global $wp_et_smtp_class;

		$wp_et_smtp_class->smtp_host 					= 'relay-hosting.secureserver.net';

		add_action( 'phpmailer_init', array( $wp_et_smtp_class, 'godaddy_phpmailer_init' ), 1001 );	
	}

	public function smtp_init() {
		$this->call_smtp_class();
		global $wp_et_smtp_class;

		$wp_et_smtp_provider_configuration = get_option( 'wp_et_smtp_provider_configuration', array() );

		$wp_et_smtp_class->smtp_host 					= esc_attr( trim( $wp_et_smtp_provider_configuration['smtp_host'] ) );
		$wp_et_smtp_class->smtp_port 					= esc_attr( trim( $wp_et_smtp_provider_configuration['smtp_port'] ) );
		$wp_et_smtp_class->smtp_encrypt_type 			= esc_attr( trim( $wp_et_smtp_provider_configuration['smtp_encrypt_type'] ) );
		$wp_et_smtp_class->enable_smtp_authentication 	= esc_attr( trim( $wp_et_smtp_provider_configuration['enable_smtp_authentication'] ) );
		$wp_et_smtp_class->smtp_username 				= esc_attr( trim( $wp_et_smtp_provider_configuration['smtp_username'] ) );
		$wp_et_smtp_class->smtp_password 				= esc_attr( trim( $wp_et_smtp_provider_configuration['smtp_password'] ) );

		add_action( 'phpmailer_init', array( $wp_et_smtp_class, 'phpmailer_init' ), 1001 );	
	}

	public function gmail_smtp_init() {
		$this->call_smtp_class();
		global $wp_et_smtp_class;

		$wp_et_gmail_smtp_provider_configuration = get_option( 'wp_et_gmail_smtp_provider_configuration', array() );
		$smtp_port = 465;
		if ( isset( $wp_et_gmail_smtp_provider_configuration['smtp_port'] ) ) {
			$smtp_port = (int) $wp_et_gmail_smtp_provider_configuration['smtp_port'];
		}

		$smtp_encrypt_type = 'ssl';
		if ( 465 != $smtp_port ) {
			$smtp_encrypt_type = 'tls';
		}

		$wp_et_smtp_class->smtp_host 					= 'smtp.gmail.com';
		$wp_et_smtp_class->smtp_port 					= $smtp_port;
		$wp_et_smtp_class->smtp_encrypt_type 			= $smtp_encrypt_type;
		$wp_et_smtp_class->enable_smtp_authentication 	= 'yes';
		$wp_et_smtp_class->smtp_username 				= esc_attr( trim( $wp_et_gmail_smtp_provider_configuration['smtp_username'] ) );
		$wp_et_smtp_class->smtp_password 				= esc_attr( trim( $wp_et_gmail_smtp_provider_configuration['smtp_password'] ) );

		add_action( 'phpmailer_init', array( $wp_et_smtp_class, 'phpmailer_init' ), 1001 );	
	}

	public function mandrill_init() {

		$wp_et_mandrill_provider_configuration = get_option( 'wp_et_mandrill_provider_configuration', array() );

		if ( $wp_et_mandrill_provider_configuration['mandrill_connect_type'] == 'smtp' ) {
			add_action( 'admin_notices', array( $this, 'mandrill_api_key_invalid' ) );

			$this->call_smtp_class();
			global $wp_et_smtp_class;

			$smtp_port = 587;
			if ( isset( $wp_et_mandrill_provider_configuration['smtp_port'] ) ) {
				$smtp_port = (int) $wp_et_mandrill_provider_configuration['smtp_port'];
			}

			$smtp_encrypt_type = 'tls';
			if ( 465 == $smtp_port ) {
				$smtp_encrypt_type = 'ssl';
			}

			$wp_et_smtp_class->smtp_host 					= 'smtp.mandrillapp.com';
			$wp_et_smtp_class->smtp_port 					= $smtp_port;
			$wp_et_smtp_class->smtp_encrypt_type 			= $smtp_encrypt_type;
			$wp_et_smtp_class->enable_smtp_authentication 	= 'yes';
			$wp_et_smtp_class->smtp_username 				= esc_attr( trim( $wp_et_mandrill_provider_configuration['smtp_username'] ) );
			$wp_et_smtp_class->smtp_password 				= esc_attr( trim( $wp_et_mandrill_provider_configuration['smtp_password'] ) );

			add_action( 'phpmailer_init', array( $wp_et_smtp_class, 'phpmailer_init' ), 1001 );

		} else {

			// Check if curl is enabled
			if ( ! function_exists( 'curl_init' ) ) {
				add_action( 'admin_notices', array( $this, 'check_curl_is_enabled' ) );
			} elseif( function_exists('wp_mail') ) {
				add_action( 'admin_notices', array( $this, 'wp_mail_declared' ) );
			} else {
				add_action( 'admin_notices', array( $this, 'mandrill_api_key_invalid' ) );

				// Check if Mandrill API Key don't have invalid message then define wp_mail function before w_mail of wp-includes/pluggable.php
				if ( get_option( 'wp_et_mandrill_api_key_valid', 0 ) == 1 ) {
					function wp_mail( $to, $subject, $message, $headers = '', $attachments = array() ) {
						global $wp_et_send_wp_emails;
						return $wp_et_send_wp_emails->mandrill_send_email( $to, $subject, $message, $headers, $attachments );
					}
				}
			}
		}
	}

	public function sparkpost_init() {

		$wp_et_sparkpost_provider_configuration = get_option( 'wp_et_sparkpost_provider_configuration', array() );

		if ( $wp_et_sparkpost_provider_configuration['connect_type'] == 'smtp' ) {
			add_action( 'admin_notices', array( $this, 'sparkpost_send_email_error_notice' ) );
			require_once WP_EMAIL_TEMPLATE_DIR . '/includes/sparkpost.php';
			$wp_et_sparkpost_functions = new \WP_Email_Template_SparkPost_Functions();

			add_action( 'phpmailer_init', array( $wp_et_sparkpost_functions, 'smtp_api_phpmailer_init' ), 1001 );

		} else {

			// Check if curl is enabled
			if ( ! function_exists( 'curl_init' ) ) {
				add_action( 'admin_notices', array( $this, 'check_curl_is_enabled' ) );
			} elseif( function_exists('wp_mail') ) {
				add_action( 'admin_notices', array( $this, 'wp_mail_declared' ) );
			} else {
				add_action( 'admin_notices', array( $this, 'sparkpost_send_email_error_notice' ) );

				// Check if Mandrill API Key don't have invalid message then define wp_mail function before w_mail of wp-includes/pluggable.php
				function wp_mail( $to, $subject, $message, $headers = '', $attachments = array() ) {
					require_once WP_EMAIL_TEMPLATE_DIR . '/includes/sparkpost.php';
					$wp_et_sparkpost_functions = new \WP_Email_Template_SparkPost_Functions();
					return $wp_et_sparkpost_functions->http_api_send_email( $to, $subject, $message, $headers, $attachments );
				}
			}
		}
	}

	public function check_curl_is_enabled() {
		echo '<div class="error"><p>'. __( "WP Email Template: CURL is disabled on this server so you can't use API connect type for Mandrill or SparkPost.", 'wp-email-template' ) . '</p></div>';
	}

	public function wp_mail_declared() {
		echo '<div class="error"><p>'. __( "WP Email Template: wp_mail has been declared by another process or plugin, so you won't be able to use another Email Deliver Provider until the problem is solved.", 'wp-email-template' ) . '</p></div>';
	}
	
	public function mandrill_api_key_invalid() {
		if ( in_array (basename($_SERVER['PHP_SELF']), array('admin.php') ) && isset( $_GET['page'] ) && sanitize_key( $_GET['page'] ) == 'send_wp_emails' ) return;
		
		if ( get_option( 'wp_et_mandrill_api_key_valid', 0 ) != 1 ) {
			echo '<div class="error"><p>'. __( "WP Email Template: You are using Invalid API key for Mandrill", 'wp-email-template' ) . '</p></div>';
		}
	}
	
	public function mandrill_send_email_error_notice() {
		if ( get_option( 'wp_et_mandrill_sent_email_error', '' ) != '' ) {
			echo '<div class="error"><p>'. get_option( 'wp_et_mandrill_sent_email_error', '' ) . '</p></div>';
			delete_option( 'wp_et_mandrill_sent_email_error' );
		}
	}
	
	public function set_mandrill_send_email_error( $error_message = '' ) {
		update_option( 'wp_et_mandrill_sent_email_error', $error_message );
	}
	
	public function check_mandrill_api_key( $api_key = '' ) {

		// Check if curl is enabled
		if ( ! function_exists('curl_init') ) {
			return false;
		}

		try {
			require_once WP_EMAIL_TEMPLATE_DIR. '/includes/mandrill/Mandrill.php';
			$mandrill = new \Mandrill( $api_key );
			$result = $mandrill->users->ping();
			if ( $result == 'PONG!' ) 
				return true;
			else
				return false;
		} catch ( Mandrill_Error $e ) {
			return false;
		}
	}
	
	public function mandrill_send_email( $to, $subject, $message, $headers = '', $attachments = array(),
							$tags = array(), 
	                        $from_name = '', 
	                        $from_email = '', 
	                        $template_name = '', 
	                        $track_opens = null, 
	                        $track_clicks = null,
	                        $url_strip_qs = false,
	                        $merge = true,
	                        $global_merge_vars = array(),
	                        $merge_vars = array(),
	                        $google_analytics_domains = array(),
	                        $google_analytics_campaign = array(),
	                        $meta_data = array(),
	                        $important = false,
	                        $inline_css = null,
	                        $preserve_recipients=null,
	                        $view_content_link=null,
	                        $tracking_domain=null,
	                        $signing_domain=null,
	                        $return_path_domain=null,
	                        $subaccount=null,
	                        $recipient_metadata=null,
	                        $ip_pool=null,
	                        $send_at=null,
	                        $async=null 
						) {
		global $wp_et_mandrill_provider_configuration;
		
		$to = str_replace( '<', '', $to );
		$to = str_replace( '>', '', $to );
		$bcc_list = array();
		$cc_list = array();
		
		try {
			require_once WP_EMAIL_TEMPLATE_DIR. '/includes/mandrill/Mandrill.php';
			$mandrill = new \Mandrill( $wp_et_mandrill_provider_configuration['api_key'] );
						
			extract( apply_filters( 'wp_mail', compact( 'to', 'subject', 'message', 'headers', 'attachments' ) ) );
			$html = $message;
			$mandrill_message = compact('html', 'subject', 'from_name', 'from_email', 'to', 'headers', 'attachments', 
                                    'url_strip_qs', 
                                    'merge', 
                                    'global_merge_vars', 
                                    'merge_vars',
                                    'google_analytics_domains',
                                    'google_analytics_campaign',
                                    'meta_data',
            						'important',
        							'inline_css',
        							'preserve_recipients',
        							'view_content_link',
        							'tracking_domain',
        							'signing_domain',
        							'return_path_domain',
        							'subaccount',
        							'recipient_metadata',
        							'ip_pool',
        							'send_at',
        							'async'        	
                                    );
			
			if ( empty( $mandrill_message['headers'] ) ) {
				$mandrill_message['headers'] = array();
			} else {
				if ( !is_array( $mandrill_message['headers'] ) ) {
					$tempheaders = explode( "\n", str_replace( "\r\n", "\n", $mandrill_message['headers'] ) );
				} else {
					$tempheaders = $mandrill_message['headers'];
				}
				$mandrill_message['headers'] = array();

				// If it's actually got contents
				if ( !empty( $tempheaders ) ) {
					// Iterate through the raw headers
					foreach ( (array) $tempheaders as $header ) {
						if ( strpos($header, ':') === false ) continue;

						// Explode them out
						list( $name, $content ) = explode( ':', trim( $header ), 2 );

						// Cleanup crew
						$name    = trim( $name    );
						$content = trim( $content );

						switch ( strtolower( $name ) ) {
							case 'from':
								if ( strpos($content, '<' ) !== false ) {
									// So... making my life hard again?
									$from_name = substr( $content, 0, strpos( $content, '<' ) - 1 );
									$from_name = str_replace( '"', '', $from_name );
									$from_name = trim( $from_name );

									$from_email = substr( $content, strpos( $content, '<' ) + 1 );
									$from_email = str_replace( '>', '', $from_email );
									$from_email = trim( $from_email );
								} else {
									$from_name  = '';
									$from_email = trim( $content );
								}
								$mandrill_message['from_email']  = $from_email;
								$mandrill_message['from_name']   = $from_name;						            
								break;
						            
							case 'bcc':
								// TODO: Mandrill's API only accept one BCC address. Other addresses will be silently discarded
								if ( isset( $bcc ) ) {
									$bcc = array_merge( (array) $bcc, explode( ',', $content ) );
								} else {
									$bcc = explode( ',', $content );
								}
								if ( is_array( $bcc ) && count( $bcc ) > 0 ) {
									foreach ( $bcc as $recipient ) {
										if ( '' != trim( $recipient ) ) {
											$bcc_list[] = $recipient;
										}
									}
								}
								break;
							
							case 'cc':
								if ( isset( $cc ) ) {
									$cc = array_merge( (array) $cc, explode( ',', $content ) );
								} else {
									$cc = explode( ',', $content );
								}
								if ( is_array( $cc ) && count( $cc ) > 0 ) {
									foreach ( $cc as $recipient ) {
										if ( '' != trim( $recipient ) ) {
											$cc_list[] = $recipient;
										}
									}
								}
								break;
						            
							case 'reply-to':
						            $mandrill_message['headers'][trim( $name )] = trim( $content );
								break;
							case 'importance':
							case 'x-priority':
							case 'x-msmail-priority':
								if ( !$mandrill_message['important'] ) $mandrill_message['important'] = ( strpos(strtolower($content),'high') !== false ) ? true : false;
								break;
							default:
								if ( substr($name,0,2) == 'x-' ) {
    						            $mandrill_message['headers'][trim( $name )] = trim( $content );
								}
								break;
						}
					}
				}
			}
			
			 // Adding a Reply-To header
			if ( !in_array( 'reply-to', array_map( 'strtolower', array_keys($mandrill_message['headers']) ) ) ) {
				$mandrill_message['headers']['Reply-To'] = get_option('admin_email');
			}

	        // Checking To: field
			if( !is_array($mandrill_message['to']) ) $mandrill_message['to'] = explode(',', $mandrill_message['to']);
                
			$processed_to = array();
			foreach ( $mandrill_message['to'] as $email ) {
				if ( is_array($email) ) {
                	$processed_to[] = $email;
				} else { 
                	$processed_to[] = array( 'email' => $email );
				}
			}
			
			if ( is_array( $bcc_list ) && count( $bcc_list ) > 0 ) {
				foreach ( $bcc_list as $bcc_email ) {
					$bcc_email = str_replace( '<', '', $bcc_email );
					$bcc_email = str_replace( '>', '', $bcc_email );
					$processed_to[] = array( 'email' => $bcc_email, 'type' => 'bcc' );
				}
			}
			
			if ( is_array( $cc_list ) && count( $cc_list ) > 0 ) {
				foreach ( $cc_list as $cc_email ) {
					$cc_email = str_replace( '<', '', $cc_email );
					$cc_email = str_replace( '>', '', $cc_email );
					$processed_to[] = array( 'email' => $cc_email, 'type' => 'cc' );
				}
			}
			
			$mandrill_message['to'] = $processed_to;
	        
	        // Checking From: field
			if ( empty($mandrill_message['from_email']) ) $mandrill_message['from_email'] = get_option('admin_email');
			if ( empty($mandrill_message['from_name'] ) ) $mandrill_message['from_name']  = get_option('blogname');
            
            // Checking tags.
			$mandrill_message['tags']        = $mandrill->findTags($tags);
		    
		    // Checking attachments
			if ( !empty($mandrill_message['attachments']) ) {
				$mandrill_message['attachments'] = $mandrill->processAttachments($mandrill_message['attachments']);
				if ( is_wp_error($mandrill_message['attachments']) ) {
					$this->set_mandrill_send_email_error( 'Invalid attachment.' );
				} elseif ( !is_array($mandrill_message['attachments']) ) {	// some plugins return this value malformed.
					unset($mandrill_message['attachments']);
				}
			}
		    // Default values for other parameters
			$mandrill_message['auto_text']   = true;
			$mandrill_message['track_opens'] = $wp_et_mandrill_provider_configuration['enable_track_opens'];
			$mandrill_message['track_clicks']= $wp_et_mandrill_provider_configuration['enable_track_clicks'];
                
            // Letting user to filter/change the mandrill_message payload
			$mandrill_message['from_email']  = apply_filters('wp_mail_from', $mandrill_message['from_email']);
			$mandrill_message['from_name']	= apply_filters('wp_mail_from_name', wp_specialchars_decode( $mandrill_message['from_name'], ENT_QUOTES ) );
                
			// if user doesn't want to process this email by wp_mandrill, so be it.
			if ( isset($mandrill_message['force_native']) && $mandrill_message['force_native'] ) $this->set_mandrill_send_email_error( 'Manually falling back to native wp_mail()' );
                
            // Setting the tags property correctly to be received by the Mandrill's API
			if ( !is_array($mandrill_message['tags']['user']) )      $mandrill_message['tags']['user']        = array();
			if ( !is_array($mandrill_message['tags']['general']) )   $mandrill_message['tags']['general']     = array();
			if ( !is_array($mandrill_message['tags']['automatic']) ) $mandrill_message['tags']['automatic']   = array();
                
			$mandrill_message['tags'] = array_merge( $mandrill_message['tags']['general'], $mandrill_message['tags']['automatic'], $mandrill_message['tags']['user'] );
			
			$result = $mandrill->messages->send( $mandrill_message );
			
			if ( is_array( $result ) && $result[0]['status'] == 'sent' )
				return true;		
			else
				return false;
		} catch ( Exception $e ) {
			$this->set_mandrill_send_email_error( $e->getMessage() );
			return false;
		}
	}

	public function sparkpost_send_email_error_notice() {
		if ( ! is_admin() ) return;

		$sparkpost_api_error = get_option( 'wp_et_sparkpost_sent_email_error', '' );
		if ( $sparkpost_api_error != '' && ! isset( $_POST['wp-email-template-send-test-email-now'] ) ) {
			update_option( 'wp_et_sparkpost_sent_email_error_debug', $sparkpost_api_error );
			delete_option( 'wp_et_sparkpost_sent_email_error' );
			echo '<div class="error"><p>'. __( "WP Email Template - SparkPost: ", 'wp-email-template' ) . '</p><p>'. $sparkpost_api_error .'</p></div>';
		}
	}
	
	public function send_a_test_email( $to_email ) {
		global $wp_version;
		global $phpmailer;
			
		if ( !is_object( $phpmailer ) || !is_a( $phpmailer, 'PHPMailer' ) ) {
			if ( version_compare( $wp_version, '5.5', '<' ) ) {
				require_once ABSPATH . WPINC . '/class-phpmailer.php';
				require_once ABSPATH . WPINC . '/class-smtp.php';
				$phpmailer = new \PHPMailer( true );
			} else {
				require_once ABSPATH . WPINC . '/PHPMailer/PHPMailer.php';
				require_once ABSPATH . WPINC . '/PHPMailer/SMTP.php';
				$phpmailer = new \PHPMailer\PHPMailer\PHPMailer( true );
			}
		}
		
		// Set SMTPDebug to true
		//$phpmailer->SMTPDebug = true;
		
		$email_heading = __('Email preview', 'wp-email-template' );
				
		$message = Hook_Filter::preview_wp_email_content( $email_heading );
		
		add_filter('wp_mail_content_type', array( $this, 'preview_set_content_type'), 21 );
		$result = wp_mail( $to_email, $email_heading, $message );
		
		echo $this->mandrill_send_email_error_notice();

		$wp_et_send_wp_emails_general = get_option( 'wp_et_send_wp_emails_general', array() );
		$get_email_delivery_provider = $wp_et_send_wp_emails_general['email_delivery_provider'];
		// Check if allow custom email wordpress delivery
		if ( $wp_et_send_wp_emails_general['email_sending_option'] == 'provider' && $get_email_delivery_provider == 'sparkpost' ) {
			$sparkpost_api_error = get_option( 'wp_et_sparkpost_sent_email_error', '' );
			if ( $sparkpost_api_error != '' ) {
				echo '<div class="error"><p>'. __( "WP Email Template - SparkPost: ", 'wp-email-template' ) . '</p><p>'. $sparkpost_api_error .'</p></div>';
			}
		}

		if ( ! $result ) {
			ob_start();
			$phpmailer->Body = '';
			//$phpmailer->MIMEBody = null;
			if ( ! empty( $phpmailer->Password ) ) {
				$phpmailer->Password = '*****************';
			}
			var_dump( $phpmailer );
			$phpmailer_error = ob_get_clean();
			$phpmailer_error = str_replace( 'body {', 'body_replace', $phpmailer_error );
			add_thickbox();
			echo '<div id="test_error_container" style="display:none;"><p><pre>'. esc_html( $phpmailer_error ) . '</pre></p></div>';
		}
		
		// Destroy $phpmailer so it doesn't cause issues later
		unset($phpmailer);
		
		return $result;
	}

	public function preview_set_content_type( $content_type = '' ) {
		$content_type = 'text/html';

		return $content_type;
	}
}
