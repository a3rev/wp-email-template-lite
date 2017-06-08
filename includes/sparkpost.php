<?php
require 'sparkpost/autoload.php';

use SparkPost\SparkPost;
use GuzzleHttp\Client;
use Ivory\HttpAdapter\CurlHttpAdapter;

class WP_Email_Template_SparkPost_Functions
{
	public function http_api_send_email( $to, $subject, $message, $headers = '', $attachments = array() ) {
		global $wp_et_sparkpost_provider_configuration;

		$api_key               = $wp_et_sparkpost_provider_configuration['api_key'];
		$sparkpost_from_email  = $wp_et_sparkpost_provider_configuration['from_email'];
		$sparkpost_template_id = $wp_et_sparkpost_provider_configuration['template_id'];
		$enable_track_opens    = $wp_et_sparkpost_provider_configuration['enable_track_opens'];
		$enable_track_clicks   = $wp_et_sparkpost_provider_configuration['enable_track_clicks'];
		if ( $enable_track_opens == 1 ) {
			$enable_track_opens = true;
		} else {
			$enable_track_opens = false;
		}
		if ( $enable_track_clicks == 1 ) {
			$enable_track_clicks = true;
		} else {
			$enable_track_clicks = false;
		}

		$original_message = $message;
		$to               = str_replace( '<', '', $to );
		$to               = str_replace( '>', '', $to );
		$bcc_list         = array();
		$cc_list          = array();

		try {
			$sparky = new SparkPost( new CurlHttpAdapter(), [ 'key'=> $api_key ] );

			//don't apply WP Email Template if this have use SparkPost Template
			if ( '' != trim( $sparkpost_template_id ) ) {
				remove_filter('wp_mail', array('WP_Email_Template_Hook_Filter', 'change_wp_mail'), 20);
				if ( function_exists( 'wp_specialchars_decode' ) ) {
					$subject = wp_specialchars_decode( $subject, ENT_QUOTES );
				}
			}

			extract( apply_filters( 'wp_mail', compact( 'to', 'subject', 'message', 'headers', 'attachments' ) ) );
			$html = $message;
			$sparkpost_message = compact( 'html', 'subject', 'from_name', 'from_email', 'to', 'headers', 'attachments' );

			if ( empty( $sparkpost_message['headers'] ) ) {
				unset( $sparkpost_message['headers'] );
				$sparkpost_message['customHeaders'] = array();
			} else {
				if ( !is_array( $sparkpost_message['headers'] ) ) {
					$tempheaders = explode( "\n", str_replace( "\r\n", "\n", $sparkpost_message['headers'] ) );
				} else {
					$tempheaders = $sparkpost_message['headers'];
				}
				unset( $sparkpost_message['headers'] );

				$sparkpost_message['customHeaders'] = array();

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
								$sparkpost_message['from_email']  = $from_email;
								$sparkpost_message['from_name']   = $from_name;
								break;

							case 'content-type':
								if ( strpos( $content, ';' ) !== false ) {
									list( $type, $charset_content ) = explode( ';', $content );
									$content_type = trim( $type );
									if ( false !== stripos( $charset_content, 'charset=' ) ) {
										$charset = trim( str_replace( array( 'charset=', '"' ), '', $charset_content ) );
									} elseif ( false !== stripos( $charset_content, 'boundary=' ) ) {
										$boundary = trim( str_replace( array( 'BOUNDARY=', 'boundary=', '"' ), '', $charset_content ) );
										$charset = '';
									}

								// Avoid setting an empty $content_type.
								} elseif ( '' !== trim( $content ) ) {
									$content_type = trim( $content );
								}
								break;

							case 'bcc':
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
						            $sparkpost_message['customHeaders'][trim( $name )] = trim( $content );
								break;
							default:
								if ( substr($name,0,2) == 'x-' ) {
    						            $sparkpost_message['customHeaders'][trim( $name )] = trim( $content );
								}
								break;
						}
					}
				}
			}

			// Adding a Reply-To header
			if ( !in_array( 'reply-to', array_map( 'strtolower', array_keys($sparkpost_message['customHeaders']) ) ) ) {
				$sparkpost_message['customHeaders']['Reply-To'] = get_option('admin_email');
			}

	        // Checking To: field
			if( !is_array($sparkpost_message['to']) ) $sparkpost_message['to'] = explode(',', $sparkpost_message['to']);

			$processed_to = array();
			foreach ( $sparkpost_message['to'] as $email ) {
				if ( is_array($email) ) {
                	$processed_to[] = array( 'address' => $email );
				} else {
                	$processed_to[] = array( 'address' => array( 'email' => $email ) );
				}
			}

			if ( is_array( $bcc_list ) && count( $bcc_list ) > 0 ) {
				foreach ( $bcc_list as $bcc_email ) {
					$bcc_email = str_replace( '<', '', $bcc_email );
					$bcc_email = str_replace( '>', '', $bcc_email );
					$processed_to[] = array( 'address' => array( 'email' => $bcc_email ) );
				}
			}

			if ( is_array( $cc_list ) && count( $cc_list ) > 0 ) {
				foreach ( $cc_list as $cc_email ) {
					$cc_email = str_replace( '<', '', $cc_email );
					$cc_email = str_replace( '>', '', $cc_email );
					$processed_to[] = array( 'address' => array( 'email' => $cc_email ) );
				}
			}

			// Checking attachments
			if ( isset( $sparkpost_message['attachments'] ) ) {
				$sparkpost_message['attachments'] = self::process_attachments($sparkpost_message['attachments']);
				if ( is_wp_error($sparkpost_message['attachments']) ) {
					unset($sparkpost_message['attachments']);
				} elseif ( ! is_array( $sparkpost_message['attachments'] ) || count( $sparkpost_message['attachments'] < 1 ) ) {	// some plugins return this value malformed.
					unset($sparkpost_message['attachments']);
				}
			}

			unset( $sparkpost_message['to'] );
			$sparkpost_message['recipients'] = $processed_to;

			// Checking From: field
			if ( '' != $sparkpost_from_email ) {
				$sparkpost_message['from_email'] = $sparkpost_from_email;
			}
			if ( empty($sparkpost_message['from_email']) ) $sparkpost_message['from_email'] = get_option('admin_email');
			if ( empty($sparkpost_message['from_name'] ) ) $sparkpost_message['from_name']  = get_option('blogname');

		    // Default values for other parameters
			$sparkpost_message['trackOpens'] = $enable_track_opens;
			$sparkpost_message['trackClicks']= $enable_track_clicks;

            // Letting user to filter/change the sparkpost_message payload
			$sparkpost_message['from_name']	= apply_filters('wp_mail_from_name', wp_specialchars_decode( $sparkpost_message['from_name'], ENT_QUOTES ) );

			$sparkpost_message['from'] = $sparkpost_message['from_name'].' <'.$sparkpost_message['from_email'].'>';

			if ( isset( $sparkpost_message['customHeaders']['Reply-To'] ) ) {
				$sparkpost_message['replyTo'] = $sparkpost_message['customHeaders']['Reply-To'];
			}
			unset( $sparkpost_message['customHeaders'] );
			//unset( $sparkpost_message['customHeaders']['Subject'] );
			//unset( $sparkpost_message['customHeaders']['From'] );
			//unset( $sparkpost_message['customHeaders']['To'] );
			//unset( $sparkpost_message['customHeaders']['Reply-To'] );

			if ( !isset( $content_type ) ) {
				$content_type = 'text/html';
			}

			$content_type = apply_filters( 'wp_mail_content_type', $content_type );

			if ( 'text/html' == $content_type ) {
				$sparkpost_message['text'] = '';
			} else {
				$original_message_plain_text = html_entity_decode(
					trim(strip_tags(preg_replace('/<(head|title|style|script)[^>]*>.*?<\/\\1>/si', '', $original_message))),
					ENT_QUOTES,
					'UTF-8'
				);

				$sparkpost_message['text'] = wordwrap( $original_message_plain_text );
			}

			if ( '' != trim( $sparkpost_template_id ) ) {
				$sparkpost_message['template'] = $sparkpost_template_id;
				$sparkpost_message['substitutionData'] = array(
					'content'   => $original_message,
					'subject'   => $sparkpost_message['subject'],
					'from_name' => $sparkpost_message['from_email'],
				);
				unset( $sparkpost_message['html'] );
				unset( $sparkpost_message['text'] );
			}

			unset( $sparkpost_message['from_name'] );
			unset( $sparkpost_message['from_email'] );

			$results = $sparky->transmission->send( $sparkpost_message );

			delete_option( 'wp_et_sparkpost_sent_email_error' );
			return true;
		} catch ( Exception $e ) {
			update_option( 'wp_et_sparkpost_sent_email_error', $e->getMessage() . '<br />' . $e->getApiMessage() . '. ' . $e->getApiDescription() );
			return false;
		}
	}

	public function process_attachments($attachments = array()) {
		if ( is_array( $attachments ) && count( $attachments ) < 1 ) return array();

        if ( ! is_array( $attachments ) ) {
        	if ( '' == trim( $attachments ) ) {
        		return array();
        	} else {
	        	$attachments = explode( "\n", str_replace( "\r\n", "\n", $attachments ) );
        	}
        }

        $new_attachments = array();
        if ( is_array( $attachments ) && count( $attachments ) > 0 ) {
	        foreach ( $attachments as $attachment ) {
	            try {
	                $new_attachments[] = self::get_attachment_struct($attachment);
	            } catch ( Exception $e ) {
	                return new WP_Error( $e->getMessage() );
	            }
	        }
	    }

        return $new_attachments;
    }

	public function get_attachment_struct($path) {

        $struct = array();

        try {

            if ( !@is_file($path) ) throw new Exception($path.' is not a valid file.');

            $filename = basename($path);
            $mime_type = self::filename_to_type($path);

            $file_buffer  = file_get_contents($path);
            $file_buffer  = base64_encode($file_buffer);

			$struct['type'] = $mime_type;
			$struct['name'] = $filename;
			$struct['data'] = $file_buffer;

        } catch (Exception $e) {
            throw new WP_Error('Error creating the attachment structure: '.$e->getMessage());
        }

        return $struct;
    }

    public function filename_to_type($filename) {
        // In case the path is a URL, strip any query string before getting extension
        $qpos = strpos($filename, '?');
        if (false !== $qpos) {
            $filename = substr($filename, 0, $qpos);
        }
        $pathinfo = self::mb_pathinfo($filename);
        return self::_mime_types($pathinfo['extension']);
    }

    public function mb_pathinfo($path, $options = null) {
        $ret = array('dirname' => '', 'basename' => '', 'extension' => '', 'filename' => '');
        $pathinfo = array();
        if (preg_match('%^(.*?)[\\\\/]*(([^/\\\\]*?)(\.([^\.\\\\/]+?)|))[\\\\/\.]*$%im', $path, $pathinfo)) {
            if (array_key_exists(1, $pathinfo)) {
                $ret['dirname'] = $pathinfo[1];
            }
            if (array_key_exists(2, $pathinfo)) {
                $ret['basename'] = $pathinfo[2];
            }
            if (array_key_exists(5, $pathinfo)) {
                $ret['extension'] = $pathinfo[5];
            }
            if (array_key_exists(3, $pathinfo)) {
                $ret['filename'] = $pathinfo[3];
            }
        }
        switch ($options) {
            case PATHINFO_DIRNAME:
            case 'dirname':
                return $ret['dirname'];
            case PATHINFO_BASENAME:
            case 'basename':
                return $ret['basename'];
            case PATHINFO_EXTENSION:
            case 'extension':
                return $ret['extension'];
            case PATHINFO_FILENAME:
            case 'filename':
                return $ret['filename'];
            default:
                return $ret;
        }
    }

    public function _mime_types($ext = '') {
        $mimes = array(
            'xl'    => 'application/excel',
            'js'    => 'application/javascript',
            'hqx'   => 'application/mac-binhex40',
            'cpt'   => 'application/mac-compactpro',
            'bin'   => 'application/macbinary',
            'doc'   => 'application/msword',
            'word'  => 'application/msword',
            'xlsx'  => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'xltx'  => 'application/vnd.openxmlformats-officedocument.spreadsheetml.template',
            'potx'  => 'application/vnd.openxmlformats-officedocument.presentationml.template',
            'ppsx'  => 'application/vnd.openxmlformats-officedocument.presentationml.slideshow',
            'pptx'  => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
            'sldx'  => 'application/vnd.openxmlformats-officedocument.presentationml.slide',
            'docx'  => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'dotx'  => 'application/vnd.openxmlformats-officedocument.wordprocessingml.template',
            'xlam'  => 'application/vnd.ms-excel.addin.macroEnabled.12',
            'xlsb'  => 'application/vnd.ms-excel.sheet.binary.macroEnabled.12',
            'class' => 'application/octet-stream',
            'dll'   => 'application/octet-stream',
            'dms'   => 'application/octet-stream',
            'exe'   => 'application/octet-stream',
            'lha'   => 'application/octet-stream',
            'lzh'   => 'application/octet-stream',
            'psd'   => 'application/octet-stream',
            'sea'   => 'application/octet-stream',
            'so'    => 'application/octet-stream',
            'oda'   => 'application/oda',
            'pdf'   => 'application/pdf',
            'ai'    => 'application/postscript',
            'eps'   => 'application/postscript',
            'ps'    => 'application/postscript',
            'smi'   => 'application/smil',
            'smil'  => 'application/smil',
            'mif'   => 'application/vnd.mif',
            'xls'   => 'application/vnd.ms-excel',
            'ppt'   => 'application/vnd.ms-powerpoint',
            'wbxml' => 'application/vnd.wap.wbxml',
            'wmlc'  => 'application/vnd.wap.wmlc',
            'dcr'   => 'application/x-director',
            'dir'   => 'application/x-director',
            'dxr'   => 'application/x-director',
            'dvi'   => 'application/x-dvi',
            'gtar'  => 'application/x-gtar',
            'php3'  => 'application/x-httpd-php',
            'php4'  => 'application/x-httpd-php',
            'php'   => 'application/x-httpd-php',
            'phtml' => 'application/x-httpd-php',
            'phps'  => 'application/x-httpd-php-source',
            'swf'   => 'application/x-shockwave-flash',
            'sit'   => 'application/x-stuffit',
            'tar'   => 'application/x-tar',
            'tgz'   => 'application/x-tar',
            'xht'   => 'application/xhtml+xml',
            'xhtml' => 'application/xhtml+xml',
            'zip'   => 'application/zip',
            'mid'   => 'audio/midi',
            'midi'  => 'audio/midi',
            'mp2'   => 'audio/mpeg',
            'mp3'   => 'audio/mpeg',
            'mpga'  => 'audio/mpeg',
            'aif'   => 'audio/x-aiff',
            'aifc'  => 'audio/x-aiff',
            'aiff'  => 'audio/x-aiff',
            'ram'   => 'audio/x-pn-realaudio',
            'rm'    => 'audio/x-pn-realaudio',
            'rpm'   => 'audio/x-pn-realaudio-plugin',
            'ra'    => 'audio/x-realaudio',
            'wav'   => 'audio/x-wav',
            'bmp'   => 'image/bmp',
            'gif'   => 'image/gif',
            'jpeg'  => 'image/jpeg',
            'jpe'   => 'image/jpeg',
            'jpg'   => 'image/jpeg',
            'png'   => 'image/png',
            'tiff'  => 'image/tiff',
            'tif'   => 'image/tiff',
            'eml'   => 'message/rfc822',
            'css'   => 'text/css',
            'html'  => 'text/html',
            'htm'   => 'text/html',
            'shtml' => 'text/html',
            'log'   => 'text/plain',
            'text'  => 'text/plain',
            'txt'   => 'text/plain',
            'rtx'   => 'text/richtext',
            'rtf'   => 'text/rtf',
            'vcf'   => 'text/vcard',
            'vcard' => 'text/vcard',
            'xml'   => 'text/xml',
            'xsl'   => 'text/xml',
            'mpeg'  => 'video/mpeg',
            'mpe'   => 'video/mpeg',
            'mpg'   => 'video/mpeg',
            'mov'   => 'video/quicktime',
            'qt'    => 'video/quicktime',
            'rv'    => 'video/vnd.rn-realvideo',
            'avi'   => 'video/x-msvideo',
            'movie' => 'video/x-sgi-movie'
        );
        if (array_key_exists(strtolower($ext), $mimes)) {
            return $mimes[strtolower($ext)];
        }
        return 'application/octet-stream';
    }

	public function smtp_api_phpmailer_init( $phpmailer ) {
		global $wp_et_sparkpost_provider_configuration;

		$api_key              = $wp_et_sparkpost_provider_configuration['api_key'];
		$smtp_port            = (int) $wp_et_sparkpost_provider_configuration['smtp_port'];
		$sparkpost_from_email = $wp_et_sparkpost_provider_configuration['from_email'];
		$enable_track_opens   = $wp_et_sparkpost_provider_configuration['enable_track_opens'];
		$enable_track_clicks  = $wp_et_sparkpost_provider_configuration['enable_track_clicks'];

		if ( $enable_track_opens == 1 ) {
			$enable_track_opens = true;
		} else {
			$enable_track_opens = false;
		}
		if ( $enable_track_clicks == 1 ) {
			$enable_track_clicks = true;
		} else {
			$enable_track_clicks = false;
		}

		if ( empty($sparkpost_from_email) ) $sparkpost_from_email = get_option('admin_email');

		if ( ! in_array( $smtp_port, array( 587,2525 ) ) ) {
			$smtp_port = 587;
		}

		$x_msys_api = array(
			'options' => array (
				'open_tracking'  => $enable_track_opens,
				'click_tracking' => $enable_track_clicks
			)
		);

		$phpmailer->isSMTP();
		$phpmailer->SMTPSecure = 'TLS';
		$phpmailer->Port = $smtp_port;
		$phpmailer->Host = 'smtp.sparkpostmail.com';
		$phpmailer->SMTPAuth = true;
		$phpmailer->Username = 'SMTP_Injection';
		$phpmailer->Password = $api_key;

		$phpmailer->From     = apply_filters( 'wp_mail_from'     , $sparkpost_from_email );
		$phpmailer->FromName = apply_filters( 'wp_mail_from_name', wp_specialchars_decode( get_option('blogname'), ENT_QUOTES ) );

		$phpmailer->addCustomHeader('X-MSYS-API', json_encode($x_msys_api));

		// Support for other plugin can filter $phpmailer again
		$phpmailer = apply_filters( 'wp_email_template_sparkpost_smtp_phpmailer_custom', $phpmailer );
	}
}
?>