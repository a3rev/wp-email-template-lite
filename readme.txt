=== WP Email Template  ===
Contributors: a3rev, nguyencongtuan
Tags: wordpress email template, wordpress email, email, email template, contact, contact forms,  wp e-commerce email, woocommerce email, contact form 7, e-commerce email, comment forms, comments, forms
Requires at least: 6.0
Tested up to: 6.6
Stable tag: 2.8.3
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl-3.0.html

Add a beautiful HTML Template to all WordPress and plugin generated emails. Send email options - SMTP, Gmail, Mandrill, SparkPost, GoDaddy Hosting supported.

== Description ==

WP Email Template 2 things - beautifully

1. Applies a responsive, customizable, optimized HTML email template to every email sent from your WordPress site including plugin generated emails.

2. Gets your beautiful / professional emails delivered. Easily Configure advanced email sending providers with any of these supported providers

* SMTP via your server
* Gmail SMTP
* Mandrill (API or SMTP)
* SparkPost (HTTP API or SMTP API)

= EMAIL TEMPLATE =

The plugin applies a HTML template to email sent from your WordPress site. The Template is optimized to show your HTML emails perfectly in the10 most popular email browsers.

* Apple iOS Devices
* MS Outlook
* Hotmail
* Apple Mail
* Yahoo! Mail
* Google Gmail
* Android Devices
* Windows Live Desktop
* Mozilla Thunderbird

= TEMPLATE EDIT OPTIONS =

* Option to Turn the Template ON | OFF. OFF to just use the plugin use to set up wp email sender without using the template (see below).
* Dynamic Template Width - admin can edit the 600px default width of the Template.
* Template Background colour selector
* Background Pattern ON | OFF setting.
* Upload and position Email Template Header image
* Header Image container background, border, and padding settings.
* Footer - add email template custom footer content via the WordPress editor.
* Follow us on - add links to social media site where users can follow you.
* Many more dynamic style options available in the Pro version.


= EMAIL SENDING OPTIONS =

The biggest issue users have are:

* Email Spammers make successful email delivery a very complicated and specialized function.
* WordPress by default uses your web hosts local mail server to send all WordPress and plugin generated emails.
* Emails sent from a web host local mail server have poor delivery rates because they have very little or no reputation.
* Configuring any type of email delivery provider will improve email delivery rates.

Every different Email Provider requires another plugin to configure. For example here are just a few of the available choices.

* Send Email via SMTP - [WP SMTP Mail](http://http://wordpress.org/plugins/wp-mail-smtp/), [WP SMPT](http://wordpress.org/plugins/wp-smtp/), [Easy WP SMTP](http://wordpress.org/plugins/easy-wp-smtp/)
* Send Email via Gmail SMTP - [SendPress Lite](http://wordpress.org/plugins/sendpress/) and any SMTP plugin if you know what you are doing.
* Send Email via Mandrill - [wpMandrill](http://wordpress.org/plugins/wpmandrill/)
* Send Email via SparkPost - [SparkPost](https://wordpress.org/plugins/sparkpost/)
* Send via WordPress default 'local mail server' if using GoDaddy Hosting - Auto Config WordPress default Email Sending - [SendPress Lite](http://wordpress.org/plugins/sendpress/)

At a3rev we want users to be able to

1. Create a Beautiful / Professional HTML Email template.
2. Auto apply that template to all emails sent from WordPress and installed plugins.
3. Easily configure a sending provider to get those emails delivered.
4. Do it all with one plugin, quickly and easily.

That is why we have added the Email Sending Provider Configuration Options so you can do all of that with just one plugin - WP Email Template.

= EMAIL FROM PLUGINS =

WP Email Template will not work with any plugin that:

1. Applies it's own HTML Email Template (WP Email Template is still applied but the 2 together will look bad).
2. Send it's emails via the php() function. WP Email Template is applied to all mail that goes through wp_mail()

Some of the better known plugins of the 1,000's of plugins that WP Email Template works beautifully with.

* Gravity Forms - see the screen shots - looks sensational with the default Gravity style.
* Contact Form 7 - see the screenshots
* Formidable Forms - both Lite and Pro Versions of that plugin
* WooCommerce - Version 2.3.9 and backward compatible to version 2.1.0. By default the plugin ignores WooCommerce email output - but you can choose to apply your WordPress Email Template to all Woocomerce emails to give you consistent branding across your entire site.
* WP e-Commerce - applies the template to every store generated email to customers and admins
* WP Mail SMPT - WP Email Template does not interfere with the way any WordPress or any plugin handles email output - it just applies the template to any output content.
* BackupBuddy - I love it when even my admin emails are branded - see the screenshots
* Wordfence - Branded security emails - nice.

= PREMIUM VERSION =

For those who want more advanced features there is a Premium version. View addition features at [WP EMAIL TEMPLATE PREMIUM](http://a3rev.com/shop/wp-email-template/)

= CONTRIBUTE =

When you download WP Email Template, you join our the a3rev Software community. Regardless of if you are a WordPress beginner or experienced developer if you are interested in contributing to the future development of this plugin head over to the WP Email Template public [GitHub Repository](https://github.com/a3rev/wp-email-template-lite) to find out how you can contribute.

Want to add a new language to WP Email Template! You can contribute via [translate.wordpress.org](https://translate.wordpress.org/projects/wp-plugins/wp-email-template)


== Installation ==

= Minimum Requirements =

* PHP version 7.4 or greater is recommended
* MySQL version 5.6 or greater is recommended

= Automatic installation =

Automatic installation is the easiest option as WordPress handles the file transfers itself and you don't even need to leave your web browser. To do an automatic install of WP Email Template, log in to your WordPress admin panel, navigate to the Plugins menu and click Add New.

In the search field type "WP Email Template" and click Search Plugins. Once you have found our plugin you can install it by simply clicking Install Now. After clicking that link you will be asked if you are sure you want to install the plugin. Click yes and WordPress will automatically complete the installation.

= Manual installation =

The manual installation method involves down loading our plugin and uploading it to your web server via your favorite FTP application.

1. Download the plugin file to your computer and unzip it
2. Using an FTP program, or your hosting control panel, upload the unzipped plugin folder to your WordPress installations wp-content/plugins/ directory.
3. Activate the plugin from the Plugins menu within the WordPress admin.


== Screenshots ==

1. WordPress blog comment notifications with the WP Email Template
2. Gravity Form email output with the WP Email Template
3. Contact Form 7 email output with the WP Email Template
4. WP e-Commerce Purchase Report with WP Email Template
5. WP Email Template applies to all email notifications generated from installed plugins to customers and admins e.g. BackupBuddy

== Usage ==

1. Install and activate the plugin

2. Go to WP Email menu on your wp-admin dashboard.

3. Go to the Template sub menu and add your template styling

4. Go to the Send WP Mail sub menu and configure your preferred email sending provider.

5. Enjoy.


== Changelog ==

= 2.8.3 - 2024/07/13 =
* This release has various tweaks for compatibility with WordPress 6.6 and WooCommerce 8.9.3.
* Tweak - Tested for compatibility with WordPress 6.6
* Tweak - Tested for compatibility with WooCommerce 8.9.3

= 2.8.2 - 2023/11/23 =
* This maintenance release has plugin framework updates for compatibility with PHP 8.1 onwards, plus compatibility with WordPress 6.4.1 and WooCommerce 8.2
* Tweak - Test for compatibility with WooCommerce 8.2.0
* Tweak - Test for compatibility with WordPress 6.4.1
* Framework - Set parameter number of preg_match function from null to 0 for compatibility with PHP 8.1 onwards
* Framework - Validate empty before call trim for option value

= 2.8.1 - 2023/10/30 =
* This maintenance release has a Tweak for compatibility with WordPress 6.4
* Tweak - Tested for compatibility with WordPress 6.4
* Tweak - Replace STYLESHEETPATH with get_stylesheet_directory() for work compatibility with WordPress 6.4

= 2.8.0 - 2023/04/25 =
* This release has compatibility with WordPress 6.2.0, WooCommerce 7.6.0 plus declared compatibility with WooCommerce HPOS.
* Tweak - Test for compatibility with WordPress 6.2
* Tweak - Test for compatibility with WooCommerce 7.6.0
* Tweak - Test and declare plugin compatibility with WooCommerce HPOS Custom Tables.

= 2.7.0 - 2023/01/03 =
* This feature release removes the fontawesome lib and replaces icons with SVGs plus adds Default Topography option to font controls and has compatibility with WooCommerce 7.2
* Feature - Convert icon from font awesome to SVG
* Feature - Update styling for new SVG icons
* Tweak - Test for compatibility with WooCommerce 7.2
* Plugin Framework - Update typography control from plugin framework to add support for Default value
* Plugin Framework - Default value will get fonts set in the theme.
* Plugin Framework - Change generate typography style for change on typography control
* Plugin Framework - Remove fontawesome lib

= 2.6.4 - 2022/11/21 =
* This maintenance release has 1 bug fix and compatibility with WooCommerce 7.1
* Tweak - Check for compatibility with WooCommerce version 7.1 
* Fix - Show the panel settings page if have combine of premium and free options on same page.

= 2.6.3 - 2022/11/01 =
* This maintenance release has a security vulnerability patch, plus compatibility with WordPress major version 6.1.0 and WooCommerce version 7.0
* Tweak - Test for compatibility with WordPress 6.1
* Tweak - Test for compatibility with WooCommerce 7.0
* Security - This release has a patch for a security vulnerability

= 2.6.2 - 2022/03/12 =
This security release follows a full security audit with code refactoring, security hardening including additional escaping and sanitizing and a bug fix from the last update.
* Security - Escape all $-variable 
* Security - Sanitize all $_REQUEST, $_GET, $_POST 
* Security - Apply wp_unslash before sanitize
* Fix - Show the Test Email Send Now button that was hiddend in version 2.6.1 

= 2.6.1 - 2022/03/07 =
* This maintenance release has tweaks for border display in Outlook emails plus various code security hardening tweaks.
* Performance – Call update_google_map_api_key when settings form is submitted instead of instance of Admin_UI
* Performance – Call update_google_font_api_key when settings form is submitted instead of instance of Fonts_Face
* Tweak - Filter on generate_border_style_css for compatibility with border display in Outlook
* Tweak - Filter on generate_border_corner_css for compatibility with border corner display in Outlook
* Tweak – Nonce check for when settings form is submitted from plugin framework
* Tweak – Capabilities manage_options check for when settings form is submitted from plugin framework
* Security – Patch for SQL injection attack vulnerability
* Security – Apply wp_kses_post for $-variables that include html before output
* Security – Validate $is_open variable
* Security – Move check nonce and capabilities from before to inside functions
* Security – Define new esc_attribute_array_e function to escape attribute array late for echo
* Security – Escape $default_color late for echo
* Security – Put $-variable additional with html include into wp_kses_post
* Security – Turn off display_errors to prevent malformed JSON from API for when WP_DEBUG is set to off OR WP_DEBUG_DISPLAY is set to off
* Framework – Allow filters output of CSS are generated from plugin framework
* Framework – Upgrade Plugin Framework to version 2.6.0

= 2.6.0 - 2022/01/21 =
* This release has a new Google Fonts API Validation feature plus compatibility with WordPress major version 5.9
* Feature - Add Ajax Validate button for Google Fonts API, for quick and easy Validation of API key.
* Dev - Add dynamic help text to Google Font API field
* Tweak - Test for compatibility with WordPress 5.9
* Framework - Update a3rev Plugin Framework to version 2.5.0

= 2.5.5 - 2021/11/20 =
* This maintenance release has check for compatibility with PHP version 8.x and WooCommerce 5.9
* Tweak - Test for compatibility with PHP 8.x
* Tweak - Test for compatibility with WooCommerce 5.9

= 2.5.4 - 2021/07/22 =
* This maintenance release has code tweaks for compatibility with WordPress Major version 5.8, WooCommerce version 5.5.1 and some Security Hardening.
* Tweak - Test for compatibility with WordPress 5.8
* Tweak - Test for compatibility with WooCommerce 5.5.1
* Security - Add more variable, options and html escaping

= 2.5.3 - 2021/04/13 =
* This maintenance release fixes a bug with sending via Mandrill API & SparkPost API
* Fix - Defined wp_mail function for Mandrill out from namespace for it override default wp_mail function
* Fix - Defined wp_mail function for SparkPost out from namespace for it override default wp_mail function

= 2.5.2 - 2021/03/19 =
* This maintenance release updates 23 deprecated jQuery functions for compatibility with the latest version of jQuery in WordPress 5.7
* Tweak - Update JavaScript on plugin framework for compatibility with latest version of jQuery and resolve PHP warning event shorthand is deprecated.
* Tweak - Replace deprecated .change( handler ) with .on( 'change', handler )
* Tweak - Replace deprecated .change() with .trigger('change')
* Tweak - Replace deprecated .focus( handler ) with .on( 'focus', handler )
* Tweak - Replace deprecated .focus() with .trigger('focus')
* Tweak - Replace deprecated .click( handler ) with .on( 'click', handler )
* Tweak - Replace deprecated .click() with .trigger('click')
* Tweak - Replace deprecated .select( handler ) with .on( 'select', handler )
* Tweak - Replace deprecated .select() with .trigger('select')
* Tweak - Replace deprecated .blur( handler ) with .on( 'blur', handler )
* Tweak - Replace deprecated .blur() with .trigger('blur')
* Tweak - Replace deprecated .resize( handler ) with .on( 'resize', handler )
* Tweak - Replace deprecated .submit( handler ) with .on( 'submit', handler )
* Tweak - Replace deprecated .scroll( handler ) with .on( 'scroll', handler )
* Tweak - Replace deprecated .mousedown( handler ) with .on( 'mousedown', handler )
* Tweak - Replace deprecated .mouseover( handler ) with .on( 'mouseover', handler )
* Tweak - Replace deprecated .mouseout( handler ) with .on( 'mouseout', handler )
* Tweak - Replace deprecated .keydown( handler ) with .on( 'keydown', handler )
* Tweak - Replace deprecated .attr('disabled', 'disabled') with .prop('disabled', true)
* Tweak - Replace deprecated .removeAttr('disabled') with .prop('disabled', false)
* Tweak - Replace deprecated .attr('selected', 'selected') with .prop('selected', true)
* Tweak - Replace deprecated .removeAttr('selected') with .prop('selected', false)
* Tweak - Replace deprecated .attr('checked', 'checked') with .prop('checked', true)
* Tweak - Replace deprecated .removeAttr('checked') with .prop('checked', false)

= 2.5.1 - 2021/03/09 =
* This maintenance release is for compatibility with WordPress 5.7
* Tweak - Test for compatibility with WordPress 5.7

= 2.5.0 - 2021/01/13 =
* This feature release adds full template compatibility with the Post SMTP plugin, the template will be auto applied to all emails sent via PostSMTP 
* Feature - You can now use the popular POST SMTP plugin as your sending plugin and auto apply WP Email Template to outgoing emails.
* Feature - Check if PostSMTP is used with SMTP and PostSMTP mailer type then always set Content Type to HTML for email Template
* Tweak - Test for compatibility with WooCommerce 4.9.0

= 2.4.9 - 2020/12/30 =
* This is an important maintenance release that updates our scripts for compatibility with the latest version of jQuery released in WordPress 5.6
* Tweak - Update JavaScript on plugin framework for work compatibility with latest version of jQuery
* Fix - Replace .bind( event, handler ) by .on( event, handler ) for compatibility with latest version of jQuery
* Fix - Replace :eq() Selector by .eq() for compatibility with latest version of jQuery
* Fix - Replace .error() by .on( “error” ) for compatibility with latest version of jQuery
* Fix - Replace :first Selector by .first() for compatibility with latest version of jQuery
* Fix - Replace :gt(0) Selector by .slice(1) for compatibility with latest version of jQuery
* Fix - Remove jQuery.browser for compatibility with latest version of jQuery
* Fix - Replace jQuery.isArray() by Array.isArray() for compatibility with latest version of jQuery
* Fix - Replace jQuery.isFunction(x) by typeof x === “function” for compatibility with latest version of jQuery
* Fix - Replace jQuery.isNumeric(x) by typeof x === “number” for compatibility with latest version of jQuery
* Fix - Replace jQuery.now() by Date.now() for compatibility with latest version of jQuery
* Fix - Replace jQuery.parseJSON() by JSON.parse() for compatibility with latest version of jQuery
* Fix - Remove jQuery.support for compatibility with latest version of jQuery
* Fix - Replace jQuery.trim(x) by x.trim() for compatibility with latest version of jQuery
* Fix - Replace jQuery.type(x) by typeof x for compatibility with latest version of jQuery
* Fix - Replace .load( handler ) by .on( “load”, handler ) for compatibility with latest version of jQuery
* Fix - Replace .size() by .length for compatibility with latest version of jQuery
* Fix - Replace .unbind( event ) by .off( event ) for compatibility with latest version of jQuery
* Fix - Replace .unload( handler ) by .on( “unload”, handler ) for compatibility with latest version of jQuery

= 2.4.8 - 2020/12/10 =
* Tweak - Test for compatibility with WooCommerce 4.8.0

= 2.4.7 - 2020/12/09 =
* This maintenance release has tweaks and a fix for compatibility with WordPress major version 5.6, PHP 7.4.8 and Gutenberg 9.4
* Tweak - Test for compatibility with PHP 7.4.8
* Tweak - Test for compatibility with WordPress 5.6
* Tweak - Test for compatibility with Gutenberg 9.4
* Tweak - Test for compatibility with WooCommerce 4.7.1

= 2.4.6 - 2020/11/16 =
* This maintenance release has compatibility checks with WordPress 5.3.3 and 1 PHPMailer/ Exception bug fix.
* Tweak - Test for compatibility with WordPress 5.5.3 
* Fix - Include PHPMailer/Exception from WP to test email function for return error if get any issue when use on SMTP connect

= 2.4.5 - 2020/10/29 =
* This maintenance release has a PHP CLI patch plus compatibility with WooCommerce 4.7.0
* Tweak - Use PHP_URL_HOST instead of $_SERVER for default wp_mail from variable 
* Tweak - Test for compatibility with WooCommerce 4.7.0
* Fix - Change in default wp_mail from variable tweak fixes Undefined index: SERVER_NAME notice when running PHP CLI

= 2.4.4 - 2020/09/15 =
* This maintenance release adds template compatibility with the Post SMTP plugin when it is used to configure the email sender, plus compatibility with WordPress 5.5.1 and WooCommerce 4.4.1 
* Tweak - Make Template compatibility with Send Test email feature of Post SMTP plugin when it is used to set the email sender
* Tweak - Make Send Test email feature compatible with Post SMTP plugin when it is used to set the email sender
* Tweak - Test for compatibility with WordPress 5.5.1
* Tweak - Test for compatibility with WooCommerce 4.4.1
* Fix - Update plugin framework script, remove jQuery.browser is deprecated to resolve conflict with jQuery Migrate Helper plugin

= 2.4.3 - 2020/08/08 =
* This maintenance release is for compatibility with WordPress major version 5.5 and WooCommerce 4.3.1.
* Tweak - Test for compatibility with WordPress 5.5
* Tweak - Test for compatibility with WooCommerce 4.3.1
* Tweak - Call phpmailer via namespace PHPMailer\PHPMailer\PHPMailer for compatibility with PHPMailer version 6.x in WordPress 5.5

= 2.4.2 - 2020/04/01 =
* This maintenance release is for compatibility with WordPress 5.4, WooCommerce 4.0.1 and PHP 7.4
* Tweak - Test for compatibility with WordPress 5.4
* Tweak - Test for compatibility with WooCommerce 4.0.1
* Fix - Update global ${$this- to $GLOBALS[$this to resolve 7.0+ PHP warnings
* Fix - Update global ${$option to $GLOBALS[$option to resolve 7.0+ PHP warnings
* Fix - Update less PHP lib that use square brackets [] instead of curly braces {} for Array, depreciated in PHP 7.4
* Fix - Validate to not use get_magic_quotes_gpc function that are depreciated in PHP 7.4

= 2.4.1 - 2020/02/15 =
* This maintenance release includes the completion of conversion to PHP composer, a fix for smpt api custom header, a security upgrade for a dependency script and compatibility with WordPress 5.3.2 and WooCommerce 3.9.2
* Tweak - Plugin Framework fully refactored to Composer for cleaner code and faster PHP code on admin panels
* Tweak - Update plugin for compatibility with new version of plugin Framework
* Tweak - Test for compatibility with WordPress 5.3.2
* Tweak - Test for compatibility with WooCommerce 3.9.2
* Fix - Check and don't override From Email and From Name if custom from headers information is passed via smtp api
* Credit - Thanks to @akkon for advice about the custom reader over ride in smtp api issue
* Security - Update symfony/phpunit-bridge script to 3.4.26 to resolve a vulnerability in the script

= 2.4.0 - 2019/12/16 =
* This feature release is a major refactor of the plugins PHP to Composer PHP Dependency Manager, a Sparkpost bug fix and compatibility with WordPress 5.3.1 and WooCommerce 3.8.1
* Feature - Plugin fully refactored to Composer for cleaner and faster PHP code
* Tweak - Test for compatibility with WordPress 5.3.1
* Tweak - Test for compatibility with WooCommerce 3.8.1
* Fix - Validate fields for Sparkpost API

= 2.3.3 - 2019/10/29 =
* This maintenance update has a tweak for Gravity Forms table display in emails and a fix for template header image alignment
* Tweak - Add a container for Gravity Forms all_fields table to apply font styles to the table. 
* Fix - Template header image horizontal alignment option

= 2.3.2 - 2019/10/28 =
* This maintenance update fixes Cloudflare minify blocking header and footer content from being loaded in emails. 
* Fix - Header and Footer content being blocked by Cloudflare minification. Replace wp_remote_get to add header and footer content in Preview and email with include part template to resolve the issue.

= 2.3.1 - 2019/10/21 =
* This maintenance update is further tweaks in security hardening of the plugins code. 
* Tweak - Check CURL is enabled on server to use API connection type for Mandrill or SparkPost as site email sender. 
* Tweak - Show text warning to webmaster on Mandrill and SparkPost admin panels to advise that CURL is not on their server and that they will have to use SMTP connect type for those.
* Tweak - Update Simple HTML Dom lib to latest version 1.9.1
* Tweak - Remove the hard coded PHP error_reporting display errors false from compile sass to css

= 2.3.0 - 2019/10/19 =
* This upgrade follows a full security review of the plugins code. Harden code in line with industry best practices, plus a fix for a HTML bug in release version 2.2.11.
* Dev - Replace file_get_contents with HTTP API wp_remote_get
* Dev - Ensure that all inputs are sanitized and all outputs are escaped.
* Dev - Replace CURL with HTTP API wp_remote_get on get email footer and email header files
* Fix - Use case-insensitive to check text/plain content type. Resolves HTML on email content bug that appeared on version 2.4.9

= 2.2.11 - 2019/10/17 =
* This is a security upgrade – please run it now as it closes a possible HTML injection vulnerability
* Security - Check if original email is text/plain content type then sanitised the message before put into email template and convert to HTML. This fixed for security issue on HTML injection
* Tweak - Test for compatibility with WordPress 5.2.3
* Tweak - Test for compatibility with WooCommerce 3.7.1

= 2.2.10 - 2019/06/29 =
* This is a maintenance upgrade to fix a potentially fatal error conflict with sites running PHP 7.3 plus compatibility with WordPress v 5.2.2 and a security tweak.
* Tweak - Third Party Sender authorization credentials encryption
* Fix - PHP warning continue targeting switch is equivalent to break for compatibility on PHP 7.3

= 2.2.9 - 2019/05/20 =
* This maintenance update fixes an issue with email notifications not showing email contents on servers that run PHP 7.3.0. 
* Fix - Email Content not showing in email notifications. Update Simple Html Dom lib to version 1.8 for compatibility with PHP 7.3

= 2.2.8 - 2019/04/26 =
* This maintenance update has tweaks for compatibility with WordPress 5.2.0 and WooCommerce 3.6.0 major new versions whilst maintaining backward compatibility
* Tweak - Test for compatibility with WordPress 5.2.0
* Tweak - Test for compatibility with WooCommerce 3.6.2
* Tweak - Support for backward compatibility with WooCommerce v 3.5

= 2.2.7 - 2018/12/31 =
* This maintenance update is for compatibility with WordPress 5.0.2, WooCommerce 3.5.3 and PHP 7.3. It also includes performance updates to the plugin framework.
* Tweak - Test for compatibility with WordPress 5.0.2 and WordPress 4.9.9
* Tweak - Test for compatibility with WooCommerce 3.5.3
* Tweak - Create new structure for future development of Gutenberg Blocks
* Framework - Performance improvement.  Replace wp_remote_fopen  with file_get_contents for get web fonts
* Framework - Performance improvement. Define new variable `is_load_google_fonts` if admin does not require to load google fonts
* Credit - Props to Derek for alerting us to the framework google fonts performance issue
* Framework - Register style name for dynamic style of plugin for use with Gutenberg block
* Framework - Update Modal script and style to version 4.1.1
* Framework - Update a3rev Plugin Framework to version 2.1.0
* Framework - Test and update for compatibility with PHP 7.3

= 2.2.6 - 2018/06/22 =
* This Maintenance update fixes a validation bug, a plugin framework issue, increases max file size limit and compatibility with WooCommerce 3.4.3
* Tweak - Increase value of MAX_FILE_SIZE from 600KB to 2MB so that it supports email content to that size.
* Credit – Thanks to Parkour3 for reporting the MAX_FILE_SIZE issue
* Tweak - Test for compatibility with WooCommerce 3.4.3
* Tweak - Update plugin admin page sidebar Place card links for support and more plugins
* Framework - Framework Global Box open and close settings options  
* Framework - Update a3rev Plugin Framework to version 2.0.5
* Fix - Validate if result of get HTML DOM is false then return

= 2.2.5 - 2018/05/26 =
* This maintenance update is for compatibility with WordPress 4.9.6 and WooCommerce 3.4.0 and the new GDPR compliance requirements for users in the EU 
* Tweak - Test for compatibility with WooCommerce 3.4.0
* Tweak - Test for compatibility with WordPress 4.9.6
* Tweak - Check for any issues with GDPR compliance. None Found

= 2.2.4 - 2018/05/10 =
* This Maintenance update fixes a bug on Multisite Network activation issue plus compatibility with WordPress 4.9.5 and WooCommerce 3.3.5
* Fix - hook require_once( ABSPATH . wp-includes/pluggable.php ) to 'muplugins_loaded' tag from fix conflict with Mandrill 4 years ago. Resolves issue that cannot access plugin settings menu if plugin is Network Activated 
* Tweak - Test for compatibility with WordPress 4.9.5
* Tweak - Test for compatibility with WooCommerce 3.3.5

= 2.2.3 - 2018/03/27 =
* Maintenance Update. 2 code tweaks to rectify email alignment and text decoration in some browsers.  
* Tweak - Remove min-width of body of email template and set max-width for table content from 96% to 100% so that it does not have space on left when view email content on mobile
* Tweak - Support default style for some html tag on email content, for example b, i, center, ... tags
* Framework - Update plugin framework to new version 2.0.3

= 2.2.2 - 2018/02/13 =
* Maintenance Update. Under the bonnet tweaks to keep your plugin running smoothly and is the foundation for new features to be developed this year 
* Framework - Update a3rev Plugin Framework to version 2.0.2
* Framework - Add Framework version for all style and script files
* Tweak - Update for full compatibility with a3rev Dashboard plugin
* Tweak - Test for compatibility with WordPress 4.9.4

= 2.2.1 - 2017/10/14 =
* Tweak - Tested for compatibility with WooCommerce 3.2.1
* Tweak - Tested for compatibility with WordPress 4.8.2
* Tweak - Added support for the new WC 'tested up to' feature to show this plugin has been tested compatible with WC updates

= 2.2.0 - 2017/06/08 =
* Feature - Launched WP Email Template public Repository
* Tweak - Tested for compatibility with WordPress major version 4.8.0
* Tweak - Tested for full compatibility with WooCommerce version 3.0.8
* Tweak - Include bootstrap modal script into plugin framework
* Tweak - Update a3rev plugin framework to latest version

= 2.1.4 - 2017/05/03 =
* Tweak - Update  email_header.html template file for compatibility with WooCommerce version 3.0.5
* Tweak - Update  email_footer.html template file for compatibility with WooCommerce version 3.0.5
* Tweak - Full compatibility with WooCommerce version 3.0.5
* Tweak - Tested for full compatibility with WordPress version 4.7.4

= 2.1.3 - 2017/04/19 =
* Tweak - Change class name of Simple Html Dom lib to avoid conflict with any other lib with same class name
* Fix - Check if Simple Html Dom lib exists from another plugin, if so use the lib from there to resolve redeclare file_get_html()fatal Error
* Credit - Thanks to Premium customers Greg Cole, Todd Wilson and Free users @rnzo and @manish9034 for reporting the Simple HTML Lib conflict on their sites

= 2.1.2 - 2017/04/14 =
* Tweak - Include new Simple Html Dom lib
* Tweak - Just get content inside body tag of message if message contain html, body tags. 
* Tweak - Full compatibility with WooCommerce version 3.0.3 with backward compatibility to WC version 2.6.0
* Tweak - Tested for full compatibility with WordPress version 4.7.3
* Credit - Thanks to Per Söderman for reporting the issue with content that contains html and body tags

= 2.1.1 - 2017/03/16 =
* Tweak - Update Mandrill lib for compatibility with PHP 7.0
* Tweak - Change global $$variable to global ${$variable} for compatibility with PHP 7.0
* Tweak - Update a3 Revolution to a3rev Software on plugins description
* Tweak - Added Settings link to plugins description on plugins menu
* Tweak - Tested for full compatibility with WordPress version 4.7.3
* Tweak - Tested for full compatibility with WooCommerce version 2.6.14
* Credit - Thanks to Henry Walker, @krishaamer and others for reporting the PHP 7.0 compatibility issues

= 2.1.0 - 2016/10/25 =
* Feature - Added upload custom social media icons options
* Feature - Added ON | OFF switch for Email Title option
* Tweak - Add new Port option for 'Gmail SMTP' sender option
* Tweak - Add new Port option for 'Mandrill SMTP' sender option
* Tweak - Define new 'Ajax Multi Submit' control type with Progress Bar showing and Statistic for plugin framework
* Tweak - Define new 'Ajax Submit' control type with Progress Bar showing for plugin framework
* Tweak - Update plugin framework styles and scripts support for new 'Ajax Submit' and 'Ajax Multi Submit' control type
* Tweak - Removed Premium Options Green boxes and replaced with Email Template super hero images
* Tweak - Removed the ‘Advanced Features Settings Box’ option from the Global Framework options box
* Tweak - Updated the Mandrill sender option box text to reflect the change from Free service to MailChimp paid account service
* Tweak - Added G Suite (Google Apps) Premium feature option box to Send WP Emails menu
* Tweak - Tested for full compatibility with WooCommerce version 2.6.6
* Fix - Check and show correct status of port connect
* Fix - Show error when test email can't sent

= 2.0.6 - 2016/09/28 =
* Fix - Preview email template showing blank page after domain text tweak on version 2.2.1
* Fix - Headers already sent warning. Delete trailing spaces at bottom of php file
* Credit - Thanks to Premium version user Paul diCecco for the blank email preview bug report
* Credit - Thanks to Free version user Bloke for the for the Headers already sent bug report

= 2.0.5 - 2016/09/26 =
* Tweak - Update text domain for full support of translation with new name for translate file is 'wp-email-template.po'
* Tweak - Tested for full compatibility with WordPress version 4.6.1
* Tweak - Tested for full compatibility with WooCommerce version 2.6.4
* Fix - Sparkpost sender support for attachments. Was throwing an error when email with attachment was sent

= 2.0.4 - 2016/07/09 =
* Tweak - Update select type of plugin framework for support group options
* Tweak - Tested for full compatibility with WooCommerce version 2.6.2

= 2.0.3 - 2016/06/30 =
* Tweak - Tested for full compatibility with WooCommerce major version 2.6.0
* Tweak - Tested for full compatibility with WooCommerce version 2.6.1
* Tweak - Tested for full compatibility with WordPress version 4.5.3

= 2.0.2 - 2016/06/10 =
* Tweak - Tested for full compatibility with WordPress version 4.5.2
* Fix - Remove all credit URL's from changelog

= 2.0.1 - 2016/06/08 =
* Tweak - Update 'email_header.html' template file.
* Tweak - Update 'email_footer.html' template file
* Tweak - Tested for full compatibility with WordPress version 4.5.2
* Fix - Dynamic font style applying to email content on Outlook
* Fix - Dynamic font style applying to email footer on Outlook
* Fix - Check if attachments is empty then remove it from argument before send via SparkPort API so don't show bad response error message about invalid data format/type
* Credit - Thanks to Thanks to Alejandro Bernuy for reporting the Outlook font issue

= 2.0.0 - 2016/05/17 =
* Feature - Added 'Line Height' option into Typography control of plugin framework
* Feature - Change all Background color to Background control with ON | OFF on plugin settings
* Tweak - Update plugin framework style for support 'Line Height' option of Typography control
* Tweak - Update Typography Preview script for apply 'Line Height' value to Preview box
* Tweak - Update the generate_font_css() function with new 'Line Height' option
* Tweak - Replace all hard code for line-height inside custom style of email template by new dynamic 'Line Height' value
* Tweak - Update 'email_header.html' template file.
* Tweak - Update 'email_footer.html' template file.
* Dev - If you have customized the email_header or email_footer file you will need to get the updated templates and add customization
* Credit - Thanks to Christophe, Martin Weiss for the Font Line Height feature suggestion a3rev.com/forums/topic/line-height/

= 1.9.2 - 2016/05/05 =
* Fix - Configure correct SparkPost HTTP API format for when email is sent with an attachment

= 1.9.1 - 2016/05/03 = 
* Tweak - Make separate warning for check port is blocked from server or connect to SMTP host is failure. Apply for SMTP, Google SMTP, Mandrill SMTP, SparkPost SMTP
* Tweak - Tested for full compatibility with Gravity Forms version 1.9.18
* Fix - change encoding character from 'iso-8859-1' to 'UTF-8' for fix SparkPost HTTP API can send

= 1.9.0 - 2016/04/27 =
* Feature - Added new email sending provider - SparkPost
* Feature - SparkPost HTTP API connection option
* Feature - SparkPost SMTP API connection option
* Feature - Option to use SparkPost email template instead of the WP HTML email template
* Feature - If a SparkPost HTML email template is set then the WP Email HTML template is auto disabled
* Feature - Option to turn ON | OFF tracking email opens. Results show on the SparkPost account admin dashboard
* Feature - Option to switch ON | OFF tracking clicks on links in emails. Results show on the SparkPost account admin dashboard

= 1.8.3 - 2016/04/07 =
* Tweak - Parse new 'email_body_width' parameter to email template to apply Body width to parent table inside the content to solve the issue of Gravity Forms Table not showing right box margin in Outlook 2013 and 2016.
* Tweak - Parse new 'email_footer_width' parameter to email template to apply Footer width to parent table inside the footer.
* Tweak - Update 'email_header.html' template file. Note! if you have custom template for this file from your theme, please get new template and custom it so that this template has the fix for Table inside the content will show correct on Outlook 2013 and 2016
* Tweak - Update 'email_footer.html' template file. Note! if you have custom template for this file from your theme, please get new template and custom it so that this template has the fix for Table inside the content will show correct on Outlook 2013 and 2016
* Credit - Thanks to Greg Cole and Felicity Heinrich for reporting this Gravity Forms / Outlook 2013, 2016 issue reported here a3rev.com/forums/topic/outlook-content-padding/

= 1.8.2 - 2016/04/06 =
* Tweak - Register fontawesome in plugin framework with style name is 'font-awesome-styles'
* Tweak - Update plugin framework to latest version
* Tweak - Tested for full compatibility with WordPress major version 4.5
* Tweak - Tested for full compatibility with WooCommerce version 2.5.5

= 1.8.1 - 2016/02/23 =
* Tweak - Parse Email From Name into wp_specialchars_decode() to decode all HTML entities
* Tweak - Add filter to 'wp_mail_from' to change the default From Email address 'wordpress@domain.com' to admin email address when emails are sending. Don't parse any From Email address
* Tweak - Add filter to 'wp_mail_from_name' to change the default From Name 'WordPress' to Site Title when emails are sending. Don't parse any From Name
* Tweak - Parse Email Subject into wp_specialchars_decode() to decode all HTML entities
* Tweak - Tested for full compatibility with WordPress version 4.4.2
* Fix - Always set 'text/html' of content type for Preview Email so that it does not show HTML code when sending test email when Apply Template is switched OFF on General Settings
* Credit - Thanks to Charlotte Batson charlottesogn.com for notifying and working with us to resolve all of the issues in this upgrade - great work Charlotte

= 1.8.0 - 2016/02/02 =
* Feature - Define new 'Background Color' type on plugin framework with ON | OFF switch to disable background or enable it
* Feature - Define new function - hextorgb() - for convert hex color to rgb color on plugin framework
* Feature - Define new function - generate_background_color_css() - for export background style code on plugin framework that is used to make custom style
* Feature - Apply 'Background Color' type for background options from plugin settings
* Feature - Define new 'strip_methods' argument for Uploader type, allow strip http/https or no
* Tweak - Update core style and script of plugin framework for support Background Color type
* Tweak - Get new background color style for email content
* Tweak - Move all upgrade function code to /includes/updates/ path
* Tweak - Tested for full compatibility with WooCommerce version 2.5.2
* Update - Make upgrade function for convert old data to new data when upgrade to new version 1.9.0
* Fix - Update all images in email content for don't strip http/https with set 'false' for 'strip_methods'

= 1.7.0 - 2016/01/08 =
* Feature - Add new 'Image Link URL' option for adding a link to header image, default is no link
* Tweak - Tested for full compatibility with WordPress version 4.4.1
* Tweak - Updated required WordPress version to 4.1
* Fix - Validated the BCC and CC fields for Mandrill API to solve issue if those fields are empty then email is not sent by Mandrill

= 1.6.0 - 2015/12/08 =
* Feature - Change media uploader to New UI of WordPress media uploader with WordPress Backbone and Underscore
* Tweak - Update the uploader script to save the Attachment ID and work with New Uploader
* Tweak - Tested for full compatibility with WooCommerce version 2.4.11
* Tweak - Tested for full compatibility with WordPress major version 4.4

= 1.5.0 - 2015/09/14 =
* Feature - Added 'WP Email Content Type' setting box with HTML and Multipart option. Multipart supports plain text fallback for email clients set to plain text instead of HTML.
* Feature - Hook into 'phpmailer_init' action tag for make new Plain text version from original email content when content Type Multipart option is selected
* Feature - Separate 'Send Email Test' feature with another button to send email instead of use 'Save Changes' button of settings panel
* Fixed - Fix Border corner Round work on Image Container, Header Title Container , Content Container and Footer Container of email template
* Credit - Thanks to Christopher for the Plain Text support [feature suggestion](https://a3rev.com/forums/topic/plain-text-version/)
* Credit - Thanks to Micah for the Send Now button [feature suggestion](https://a3rev.com/forums/topic/send-wp-emails-send-a-test-email/)
* Credit - Thanks to NineSixOne for alerting us to the [border corner round bug](https://a3rev.com/forums/topic/rounded-corner-doesnt-work/)

= 1.4.2 - 2015/08/21 =
* Tweak - include new CSSMin lib from https://github.com/tubalmartin/YUI-CSS-compressor-PHP-port into plugin framework instead of old CSSMin lib from http://code.google.com/p/cssmin/ , to avoid conflict with plugins or themes that have CSSMin lib
* Tweak - make __construct() function for 'Compile_Less_Sass' class instead of using a method with the same name as the class for compatibility on WP 4.3 and is deprecated on PHP4
* Tweak - change class name from 'lessc' to 'a3_lessc' so that it does not conflict with plugins or themes that have another Lessc lib
* Tweak - Plugin Framework DB query optimization. Refactored settings_get_option call for dynamic style elements, example typography, border, border_styles, border_corner, box_shadow
* Tweak - Tested for full compatibility with WooCommerce Version 2.4.5
* Tweak - Tested for full compatibility with WordPress major version 4.3.0
* Fix - Update the plugin framework for setup correct default settings on first installed
* Fix - Update the plugin framework for reset to correct default settings when hit on 'Reset Settings' button on each settings tab

= 1.4.1 - 2015/06/21 =
* Fix - Delete trailing space on the top of style-footer-settings.php file when upgrading to version 1.4.0

= 1.4.0 - 2015/06/20 =
* Feature - Plugin framework Mobile First focus upgrade
* Feature - Massive improvement in admin UI and UX in PC, tablet and mobile browsers
* Feature - Introducing opening and closing Setting Boxes on admin panels.
* Feature - Added Plugin Framework Customization settings. Control how the admin panel settings show when editing.
* Feature - New interface has allowed us to do away with the 4 Tab menus on the admin panel
* Feature - Includes a script to automatically combine removed tab settings into Tabs main table when upgrading
* Feature - Added Option to set Google Fonts API key to directly access latest fonts and font updates from Google 
* Feature - Added full support for Right to Left RTL layout on plugins admin dashboard. 
* Feature - Added a 260px wide images to the right sidebar for support forum link, Documentation links.
* Tweak - Send WP Emails now just 1 menu page - combined the STMP, Gmail and Mandrill tabs in the main page
* Tweak - Template menu - moved Fonts tab settings to the Content tab in its own Settings Box
* Tweak - Moved Clean up on Deletion setting to the new Plugin Framework Global Settings Box
* Tweak - Updated some admin panel Description and Help text
* Tweak - Tested for full compatibility with WooCommerce Version 2.3.11
* Fix - Check 'request_filesystem_credentials' function, if it does not exists then require the core php lib file from WP where it is defined

= 1.3.6 - 2015/06/03 =
* Tweak - Tested for full compatibility with WooCommerce Version 2.3.10
* Tweak - Security Hardening. Removed all php file_put_contents functions in the plugin framework and replace with the WP_Filesystem API
* Tweak - Security Hardening. Removed all php file_get_contents functions in the plugin framework and replace with the WP_Filesystem API
* Fix - Update dynamic stylesheet url in uploads folder to the format <code>//domain.com/</code> so it's always is correct when loaded as http or https

= 1.3.5 - 2015/05/27 =
* Tweak - called <code>add_filter( 'frm_encode_subject')</code> to disable encoding subject title from Formidable Forms plugin
* Fix - correct the path of custom template for email_header.html and email_footer.html when checking to get custom template
* Credit - Thanks to Brian Childers for reporting the Formidable Forms conflict and the access to his site to find and fix the issue.

= 1.3.4 - 2015/05/20 =
* Fix - Don't change email content type if the Apply Template setting is switched to OFF

= 1.3.3 - 2015/05/14 =
* Tweak - Created new admin panel Tab [ Exclude Emails ] with new Pro Version feature exclude template by subject title settings
* Tweak - Moved the exclude template from emails by shortcode settings to the new Exclude Emails tab
* Tweak - Updated the plugins docs with new features
* Tweak - Updated the plugins a3rev product page with new features
* Tweak - Tested and Tweaked for full compatibility with WordPress Version 4.2.2
* Fix - Apply to WooCommerce emails OFF setting. Template was being applied to WooCommerce emails when option was switched OFF.

= 1.3.2 - 2015/04/21 =
* Tweak - Tested and Tweaked for full compatibility with WordPress Version 4.2.0
* Tweak - Tested and Tweaked for full compatibility with WooCommerce Version 2.3.8
* Tweak - Update style of plugin framework. Removed the [data-icon] selector to prevent conflict with other plugins that have font awesome icons

= 1.3.1 - 2015/04/02 =
* Fix - Removed <code><!--email_container_width--></code> on header image. Was causing code to show instead of the image on some email clients

= 1.3.0 - 2015/03/25 =
* Feature - Added Option to turn the Template ON | OFF. Can now just use the plugin use to set up wp email sender without using the template.
* Feature - Added Dynamic Template Width - admin can edit the 600px default width of the Template.
* Fix - Bug that email was not being sent when user did a Password recover when Mandrill API is set as the email sender.

= 1.2.2 - 2015/03/19 =
* Tweak - Tested and Tweaked for full compatibility with WooCommerce Version 2.3.7
* Tweak - Tested and Tweaked for full compatibility with WordPress Version 4.1.1

= 1.2.1 - 2015/02/14 =
* Tweak - Changed WP_CONTENT_DIR to WP_PLUGIN_DIR. When an admin sets a custom WordPress file structure then it can get the correct path of plugin
* Fix - Internal container padding not being applied in Outlook 2013 / 2010 / 2007
* Fix - Social share icon alignment in Safari Browser and iOS Safari.
* Credit - Thanks to Christopher for bringing the Outlook padding issue to our attention on the a3rev support forum

= 1.2.0 - 2015/02/05 =
* Feature - Massive upgrade the dynamic Email Template creator and Email Client render - 60+ hours dev work.
* Feature - Setting broken up on admin panel to clearly define the 4 container structure of the template.
* Feature - Old [Style] tab is gone replaced by 5 new tabs [Header Image] [Email Title] [Body] [Footer] [Fonts]
* Feature - [Header Image] added image vertical alignment in Header image container.
* Feature - [Header Image] added Header image container border external margin dynamic settings
* Feature - [Header Image] added Header image container border internal padding dynamic settings
* Feature - [Header Image] added Header image container Border style dynamic settings
* Feature - [Header Image] added Header image container Border corner settings
* Feature - Added ON | OFF setting for template background pattern
* Feature - Added Outlook Boxed Border ON | OFF setting
* Tweak - Audit, test and tweak for 100% compatibility with WordPress Version 4.1
* Tweak - Default template style on first install - all 4 Containers have white background.
* Tweak - Default template style on first install - Email Title font changed to Arial #999999 Bold and 26px.
* Tweak - Default template style on first install - Email Content font changed to Arial #999999 Normal and 14px.
* Tweak - Added links to new a3 Lazy Load and a3 Portfolio plugins on wordpress.org to the Yellow sidebar
* Fix - Padding on social share icons in Outlook.

= 1.1.4 - 2014/09/13 =
* Tweak - Tested 100% compatible with WooCommerce 2.2.2
* Fix - Changed <code>__DIR__</code> to <code>dirname( __FILE__ )</code> for Sass script so that on some server <code>__DIR__</code> is not defined

= 1.1.3 - 2014/09/05 =
* Feature - Convert all back end CSS to Sass.
* Tweak - Updated google font face in plugin framework.
* Tweak - Tested 100% compatible with WooCommerce Version 2.2
* Tweak - Tested 100% compatible with WordPress Version 4.0

= 1.1.2.4 - 2014/06/30 =
* Feature - Mandrill API -Convert email list from BCC field to email TO field to allow multiple recipients because Mandrill API only supports send to a single email address in BCC field. Important! On Mandrill Sending Options uncheck 'Expose the list of recipients when sending to multiple addresses' and BCC recipients cannot see or reply to the other emails in the TO field of the email.
* Fix - Mandrill API - Auto Convert email CC field to Email TO field so that CC address can receive email. Mandrill API only supports 1 CC email address.
* Fix - Mandrill API - Detect and remove 2 special characters "<" and ">" used for Email TO field for example detect and convert <name@domain.com> to name@domain.com

= 1.1.2.3 - 2014/06/27 =
* Tweak - Add filter for the 'From' Email address meta that is set in SMTP or Gmail SMTP sender. This allows 3 party plugins to change the default 'From' Email address to another email, example noreply@domain.com

= 1.1.2.2 - 2014/06/19 =
* Tweak - Updated chosen js script to latest version 1.0.1 on the a3rev Plugin Framework
* Tweak - Added support for placeholder feature for input, email , password , text area types
* Tweak - Checked and updated for full compatibility with WooCommerce version 2.1.11

= 1.1.2.1 - 2014/05/25 =
* Tweak - Changed add_filter( 'gettext', array( $this, 'change_button_text' ), null, 2 ); to add_filter( 'gettext', array( $this, 'change_button_text' ), null, 3 );
* Tweak - Update change_button_text() function from ( $original == 'Insert into Post' ) to ( is_admin() && $original === 'Insert into Post' )
* Tweak - Checked and updated for full compatibility with WordPress version 3.9.1
* Tweak - Checked and updated for full compatibility with WooCommerce version 2.1.9
* Tweak - Checked and updated for full compatibility with WP e-Commerce version 3.8.14.1
* Tweak - Converted the plugin to the new a3rev Free Evaluation Trail License feature.
* Fix - Code tweaks to fix a3 Plugins Framework conflict with WP e-Commerce tax rates.

= 1.1.2 - 2014-02-19 =
* Feature - Added WordPress Email sending settings and configurations.
* Feature - Added auto config for GoDaddy Hosting when using default via web host as the Email Sending Options
* Feature - Added activate and configure send mail via SMTP option.
* Feature - Added activate and auto configure send mail by Gmail option.
* Feature - Added activate and configure send mail by Mandrill option. Connect via Mandrill API Key or SMTP.
* Feature - Added Send Test Email function.
* Feature - Added detailed Connection Error DEBUGGING.
* Tweak - Moved plugin dashboard from the WordPress Settings menu to its own WP Email sidebar menu.
* Tweak - Added 2 sub menus. Template | Send WP Emails, each with admin settings broken up into tabs.

= 1.1.1.1 - 2014/02/12 =
* Tweak - Added remove_all_filters('mce_external_plugins'); before call to wp_editor to remove extension scripts from other plugins.
* Tweak - Updated Framework help text font for consistency.
* Fix - Conflict with wpMandrill plugin. Rewrote emplate preview URL security require_once( ABSPATH . 'wp-includes/pluggable.php' ); with sanitiser that does not call wp_mail.
* Credit - Thanks to Jeremy Summers Tangy Tangerine CA for alerting us about the wpMandrill conflict and access to find and fix.

= 1.1.1 - 2014/01/27 =
* Tweak - Upgraded for 100% compatibility with soon to be released WooCommerce Version 2.1 with backward compatibility to Version 2.0
* Tweak - Added all required code so plugin can work with WooCommerce Version 2.1 refactored code.
* Tweak - Tested for compatibility with WordPress version 3.8.1
* Tweak - Added description text to the top of each Pro Version yellow border section
* Tweak - Minor update to some admin panel text.
* Tweak - Full WP_DEBUG ran, all uncaught exceptions, errors, warnings, notices and php strict standard notices fixed.

= 1.1.0 - 2013/12/21 =
* Feature - a3rev Plugin Framework admin interface upgraded to 100% Compatibility with WordPress v3.8.0 with backward compatibility.
* Feature - a3rev framework 100% mobile and tablet responsive, portrait and landscape viewing.
* Tweak - Upgraded dashboard switches and sliders to Vector based display that shows when WordPress version 3.8.0 is activated.
* Tweak - Upgraded all plugin .jpg icons and images to Vector based display for full compatibility with new WordPress version.
* Tweak - Yellow sidebar on Pro Version Menus does not show in Mobile screens to optimize admin panel screen space.
* Tweak - Tested 100% compatible with WP 3.8.0
* Fix - Upgraded array_textareas type for Padding, Margin settings on the a3rev plugin framework

= 1.0.9 - 2013/10/10 =
* Feature - Admin panel intuitive app interface feature. Show slider to set corner radius when select Round, hide when select Square on Border Corner Style Switch. (Pro Version Feature)
* Tweak - a3rev logo image now resizes to the size of the yellow sidebar in tablets and mobiles.
* Fix - Intuitive Radio Switch settings not saving. Input with disabled attribute could not parse when form is submitted, replace disabled with custom attribute: checkbox-disabled
* Fix - App interface Radio switches not working properly on Android platform, replace removeProp() with removeAttr() function script

= 1.0.8 - 2013/10/04 =
* Feature - Upgraded the plugin to the newly developed a3rev admin panel app interface.
* Feature - New admin UI features check boxes replaced by switches.
* Feature - Replaced colour picker with new WordPress 3.6.0 colour picker.
* Feature - Added choice of 350 Google fonts to the existing 17 websafe fonts in all new single row font editor. (Pro Version feature)
* Feature - New Font Editor has instant preview feature. (Pro Version feature)
* Feature - Upload Custom Social Media icons feature added.(Pro Version feature)
* Feature - Added House keeping function. On deletion set if you want the plugin to 'Clean Up After Itself' leaving not trace it was ever installed.
* Tweak - Admin Panel now has 3 tabs with setting broken up into - General, Style and Social Media.
* Tweak - Compatibility with WordPress 3.6.0 done when released. Checked again with WP 3.6.1
* Tweak - Ran full WP_DEBUG All Uncaught exceptions errors and warnings fixed.
* Fix - Plugins admin script and style not loading in Firefox with SSL on admin. Stripped http// and https// protocols so browser will use the protocol that the page was loaded with.

= 1.0.7 - 2013/06/13 =
* Tweak - Added PHP Public Static to functions in Class. Done so that Public Static warnings don't show in DE_BUG mode.

= 1.0.6 - 2013/06/11 =
* Tweak - Updated support URL to the plugins wordpress.org support forum
* Fix - Email template header image not showing in outbound email template and preview. Header image was uploading and showing correctly in the admin panel under upload input but not showing in template applied to outbound emails and preview.

= 1.0.5 - 2013/04/16 =
* Feature - Added when install and activate plugin link redirects to WP Email Template admin panel instead of the wp-plugins dashboard
* Fix - Yahoo Mail does not support p tag - space between paragraphs. Coded in line CSS fix to auto add space between paragraphs for Yahoo Mail.
* Fix - Yahoo Mail auto removes body tag and hence would not show the background colour. Coded in-line CSS fix to force Yahoo Mail to show background colour.
* Fix - Updated all JavaScript functions so that the plugin is compatible with jQuery Version1.9 and backwards to version 1.6. WordPress still uses jQuery version 1.8.3. In themes that use Google js Library instead of the WordPress jQuery then there was trouble because Google uses the latest jQuery version 1.9. There are a number of functions in jQuery Version 1.9 that have been depreciated and hence this was causing errors with the jQuery function in the plugin.

= 1.0.4 - 2013/04/01 =
* Feature - Upgraded plugins admin to use Chosen script for dropdowns and options.
* Tweak - Replaced add template header image via URL with image uploader.
* Tweak - Added option to set Text link colour in email body. Previously this was auto set to be the same as the header background colour - but caused problems with links not visible when header background and email body background both use the same colour. ( PRO version only)
* Tweak - Update the plugins wiki docs to show new admin style, image upload feature and colour link text colour options.
* Fix - Max wide layout issues with template display in iPhone 5.
* Fix - Bug for users who have https: (SSL) on their sites wp-admin but have http on sites front end. This was causing the email template preview to show a -1 instead of the Template because wp-admin with SSL applied only allows https:, but the url of admin-ajax.php?action=preview_wp_email_template is http: and it is denied hence was returning the ajax -1 error. Fixed by writing a filter to recognize when https is configured on wp-admin and parsing correctly. If you do not have this configuration nothing changes for you, if you do have https on your wp-admin (or install it in the future) and http on the front end then Email Template Preview action now automatically detects that and works as it should.

= 1.0.3 - 2013/03/05 =
* Feature - (PRO Version feature) - Added the ability to deactivate the Email Template background pattern. (much requested feature).
* Tweak - Updated all plugin code to be 100% compatible with new WooCommerce V2.0 with backwards compatibility.

= 1.0.2.1 - 2013/02/16 =
* Tweak - Added a Settings link to the plugins wp-admin plugins dashboard listing and updated the Support URL
* Tweak - Updated Support URL on the wordpress.org description
* Localization - German Translation by Marko Geisler added to langauge folder

= 1.0.2 - 2013/01/11 =
* Fix - WP Email Template apply to WooCommerce Email template when user had selected do not apply for that option.
* Credit - Thank you to Roger Amstell for reporting and helping us to locate and fix these bugs.

= 1.0.1 - 2013/01/09 =
* Tweak - Updated Support and Pro Version link URL's on wordpress.org description, plugins and plugins dashboard. Links were returning 404 errors since the launch of the all new a3rev.com mobile responsive site as the base e-commerce permalinks is changed.
* Fix - When user server does not support  file_get_contents function changes made to the template were not applying to the WooCommerce Email template. We had added a get file from get_stylesheet_directory_uri constant as a work around but had missed the () at the end of the function so it wasn't working

= 1.0.0 - 2012/09/03 =
* First Release.


== Upgrade Notice ==

= 2.8.3 =
This release has various tweaks for compatibility with WordPress 6.6 and WooCommerce 8.9.3

= 2.8.2 =
This maintenance release has plugin framework updates for compatibility with PHP 8.1 onwards, plus compatibility with WordPress 6.4.1 and WooCommerce 8.2

= 2.8.1 =
This maintenance release has a Tweak for compatibility with WordPress 6.4

= 2.8.0 =
This release has compatibility with WordPress 6.2.0, WooCommerce 7.6.0 plus declared compatibility with WooCommerce HPOS.

= 2.7.0 =
This feature release removes the fontawesome lib and replaces icons with SVGs plus adds Default Topography option to font controls and has compatibility with WooCommerce 7.2.

= 2.6.4 =
This maintenance release has 1 bug fix and compatibility with WooCommerce 7.1

= 2.6.3 =
This maintenance release has a security vulnerability patch, plus compatibility with WordPress major version 6.1.0 and WooCommerce version 7.0

= 2.6.2=
This security release follows a full security audit with code refactoring, security hardening including additional escaping and sanitizing and a bug fix from the last update.

= 2.6.1 =
This maintenance release has tweaks for border display in Outlook emails plus various code security hardening tweaks.

= 2.6.0 = 
This release has a new Google Fonts API Validation feature plus compatibility with WordPress major version 5.9

= 2.5.5 =
This maintenance release has check for compatibility with PHP version 8.x and WooCommerce 5.9

= 2.5.4 =
This maintenance release has code tweaks for compatibility with WordPress Major version 5.8, WooCommerce version 5.5.1 and some Security Hardening.

= 2.5.3 =
This maintenance release fixes a bug with sending via Mandrill API & SparkPost API

= 2.5.2 =
This maintenance release updates 23 deprecated jQuery functions for compatibility with the latest version of jQuery in WordPress 5.7

= 2.5.1 =
This maintenance release is for compatibility with WordPress 5.7

= 2.5.0 =
This feature release adds full template compatibility with the Post SMTP plugin, the template will be auto applied to all emails sent via PostSMTP

= 2.4.9 =
This is an important maintenance release that updates our scripts for compatibility with the latest version of jQuery released in WordPress 5.6

= 2.4.8 =
* This maintenance release is for compatibility with WooCommerce 4.8.0

= 2.4.7 =
This maintenance release has tweaks for compatibility with WordPress major version 5.6 and PHP version 7.4

= 2.4.6 =
This maintenance release has compatibility checks with WordPress 5.3.3 and 1 PHPMailer/ Exception bug fix.

= 2.4.5 =
This maintenance release has a PHP CLI patch plus compatibility with WooCommerce 4.7.0

= 2.4.4 =
This maintenance release adds template compatibility with the Post SMTP plugin when it is used to configure the email sender, plus compatibility with WordPress 5.5.1 and WooCommerce 4.4.1

= 2.4.3 =
This maintenance release is for compatibility with WordPress major version 5.5 and WooCommerce 4.3.1.

= 2.4.2 =
This maintenance release is for compatibility with WordPress 5.4, WooCommerce 4.0.1 and PHP 7.4

= 2.4.1 =
This maintenance release includes the completion of conversion to PHP composer, a fix for smpt api custom header, a security upgrade for a dependency script and compatibility with WordPress 5.3.2 and WooCommerce 3.9.2

= 2.4.0 =
This feature release is a major refactor of the plugins PHP to Composer PHP Dependency Manager, a Sparkpost bug fix and compatibility with WordPress 5.3.1 and WooCommerce 3.8.1

= 2.3.3 =
This maintenance update has a tweak for Gravity Forms table display in emails and a fix for template header image alignment

= 2.3.2 =
This maintenance update fixes Cloudflare minify blocking header and footer content from being loaded in emails.

= 2.3.1 =
This maintenance update is further tweaks in security hardening of the plugins code.

= 2.3.0 =
This upgrade follows a full security review of the plugins code. Harden code in line with industry best practices, plus a fix for a HTML bug in release version 2.2.11

= 2.2.11 =
This is a security upgrade - please run it now as it closes a possible HTML injection vulnerability

= 2.2.10 =
This is a maintenance upgrade to fix a potentially fatal error conflict with sites running PHP 7.3 plus compatibility with WordPress v 5.2.2 and a security tweak

= 2.2.9 =
This maintenance update fixes an issue with email notifications not showing email contents on servers that run PHP 7.3.0.

= 2.2.8 =
This maintenance update has tweaks for compatibility with WordPress 5.2.0 and WooCommerce 3.6.0 major new versions whilst maintaining backward compatibility

= 2.2.7 =
This maintenance update is for compatibility with WordPress 5.0.2, WooCommerce 3.5.3 and PHP 7.3. It also includes performance updates to the plugin framework.

= 2.2.6 =
Maintenance update fixes a validation bug, a plugin framework issue, increases max file size limit and compatibility with WooCommerce 3.4.3

= 2.2.5 =
Maintenance Update. Compatibility with WooCommerce 3.4.0, WordPress 4.9.6 and the new GDPR compliance requirements for users in the EU

= 2.2.4 =
Maintenance update.  Bug fix for Multisite Network activation issue plus compatibility with WordPress 4.9.5 and WooCommerce 3.3.5

= 2.2.3 =
Maintenance Update. 2 code tweaks to rectify email alignment and text decoration in some browsers.

= 2.2.2 =
Maintenance Update. This version updates the Plugin Framework to v 2.0.2, adds full compatibility with a3rev dashboard and WordPress v 4.9.4

= 2.2.1 =
Maintenance Update. Various tweaks for compatibility with WooCommerce version 3.2.1 and WordPress 4.8.2

= 2.2.0 =
Feature Update. 2 code tweaks for compatibility with WordPress major version 4.8.0 and WooCommerce version 3.0.8 and launch of the plugins public Github repo

= 2.1.4 =
Maintenance Update. 2 code tweaks for compatibility with WooCommerce 3.0.5 and WordPress 4.7.4

= 2.1.3 =
Maintenance Update. 1 Tweak and 1 Bug Fix for Simple HTML Dom lib introduced in version 2.3.2 and causing fatal error on some sites

= 2.1.2 =
Maintenance Update. 2 code tweaks for full compatibility with WordPress 4.7.3 and WooCommerce 3.0.3 with backward to WC 2.6.0

= 2.1.1 =
Maintenance Update. 3 code tweaks for compatibility with PHP 7.0 - plus tweaks for compatibility with WordPress v 4.7.3 and WooCommerce 2.6.14

= 2.1.0 =
Feature Upgrade. Added 2 new features, 5 code tweaks plus 2 bug fixes and full compatibility with WooCommerce version 2.6.6

= 2.0.6 =
Maintenance Update. 2 bug fixes. Blank email template preview and headers already sent warning

= 2.0.5 =
Maintenance Update. 1 Sparkpost sender bug fix and 1 translations text domain update for full compatibility with WordPress 4.6.1 and WooCommerce 2.6.4

= 2.0.4 =
Maintenance Update. 1 tweak for full compatibility with WooCommerce Version 2.6.2

= 2.0.3 =
Maintenance Update. Tweak and tested for full compatibility with WooCommerce version 2.6.1 and WordPress version 4.5.3

= 2.0.2 =
Maintenance Update. 1 bug fix with full compatibility with WordPress version 4.5.2

= 2.0.1 =
Maintenance Update. 2 tweaks and 3 bug fixes for content and footer fonts in Outlook and attachments error with Sparkpost API and full compatibility with WordPress v 4.5.2

= 2.0.0 =
Feature Upgrade. Added support for Font Line Height and Background Colours ON | OFF option

= 1.9.2 =
Maintenance Update. 1 bug fix for emails with attachment when email sender SparkPost HTTP API is configured as the sender

= 1.9.1 =
Maintenance Update. 1 Bug Fix for SparkPost HTTP API connect plus 1 tweak and full compatibility with Gravity Forms current version 1.9.18

= 1.9.0 =
Feature Upgrade. 7 new features to add full support for email sending provider SparkPost.

= 1.8.3 =
Maintenance Update. 4 Code Tweaks to fix a display issue with email template applied to Gravity Forms in Outlook 2013 and 2016

= 1.8.2 =
Maintenance Update. 2 Teaks for full compatibility with upcoming WordPress major version 4.5.0 and WooCommerce version 2.5.5

= 1.8.1 =
Maintenance Update. 4 substantial code tweaks and 1 bug fix plus full compatibility with WordPress version 4.4.2

= 1.8.0 =
Feature Upgrade with 5 new features, 2 code tweaks and 1 bug fix for full compatibility with WooCommerce v2.5.2

= 1.7.0 =
Feature Upgrade. New link header image option plus a Mandrill API bug fix and full compatibility with WordPress version 4.4.1

= 1.6.0 =
Feature Upgrade. 1 new features plus tweaks for full compatibility with WordPress Major Version 4.4 and WooCommerce version 2.4.11

= 1.5.0 =
New Features Upgrade. 3 new features and 1 border corner round bug fix.

= 1.4.2 =
Major Maintenance Upgrade. 6 Code Tweaks plus 2 bug fixes for full compatibility with WordPress v 4.3.0 and WooCommerce v 2.4.5

= 1.4.1 =
Important Maintenance Upgrade. 1 bug fix when upgradig to version 1.4.0

= 1.4.0 =
Major Feature Upgrade. Massive admin panel UI and UX upgrade. Includes 6 new features, 4 Tweaks and 1 bug fix plus full compatibility with WooCommerce Version 2.3.11

= 1.3.6 =
Important Maintenance Upgrade. 2 x major a3rev Plugin Framework Security Hardening Tweaks plus 1 https bug fix and full compatibility with WooCommerce Version 2.3.10

= 1.3.5 =
Maintenance Upgrade. Tweak for full compatibility with Formidable Forms plugin plus 1 custom template bug fix.

= 1.3.4 =
Maintenance Upgrade. 1 new bug fix for when Apply Template setting is switched OFF

= 1.3.3 =
Maintenance Upgrade. Various Tweaks on the plugins admin panel for new Pro version Template features and Tweaked for full compatibility with WordPress 4.2.2 includin 1 bug fix

= 1.3.2 =
Maintenance upgrade. Code tweaks for full compatibility with WordPress 4.2.0 and WooCommerce 2.3.8

= 1.3.1 =
Maintenance update - important header image display Bug fix.

= 1.3.0 =
Major new features release. Upgrade now for 2 new Features plus 1 Bug fix.

= 1.2.2 =
Upgrade now for full compatibility with WooCommerce Version 2.3.7 and WordPress version 4.1.1

= 1.2.1 =
Upgrade now for 1 Outlook internal padding display bug fix and a social share icon alignment in safari bug fix

= 1.2.0 =
Massive upgrade - 60+ hours dev work. Includes 8 new dynamic style settings, 3 default style tweaks, 1 bug fix and full compatibility with WordPress 4.1.0

= 1.1.4 =
Upgrade now for 1 Sass bug fix and full compatibility with WooCommerce v2.2.2

= 1.1.3 =
Upgrade now for full compatibility with WordPress 4.0 and WooCommerce 2.2

= 1.1.2.4 =
Upgrade you plugin now for 1 new Mandrill API BCC sender feature (send to multiple BCC addresses) and 2 bug fixes.

= 1.1.2.3 =
Upgrade now for a code tweak for Send method SMTP and Gmail SMTP

= 1.1.2.2 =
Update now for 2 important framework code tweaks to keep you plugin in tip top running order.

= 1.1.2.1 =
Update now full compatibility with WordPress version 3.9.1, WooCommerce version 2.1.9 and WP e-Commerce version 3.8.14.1

= 1.1.2 =
Major plugin upgrade - Easily configure and manage your WordPress email sending provider with the Send WP Emails features. 7 New features and 2 Tweaks.

= 1.1.1.1=
Upgrade now for wpMandrill conflict bug fix plus 2 Framework Tweaks.

= 1.1.1 =
Upgrade now for full compatibility with WooCommerce Version 2.1 and WordPress version 3.8.1. Includes full backward compatibly with WooCommerce versions 2.0 to 2.0.20.

= 1.1.0 =
Upgrade now for full a3rev Plugin Framework compatibility with WordPress version 3.8.0 and backwards. New admin interface full mobile and tablet responsive display.

= 1.0.9 =
Upgrade now for another admin panel intuitive app interface feature plus a Radio switch bug fix and Android platform bug fix

= 1.0.8 =
Upgrade you plugin now for the all new a3rev admin panel app type interface and the loads of new features the new interface allows us to implement.

= 1.0.7 =
Fix for PHP Public Static warnings in DE_BUG mode.

= 1.0.6 =
Major header image bug fix. Please update now.

= 1.0.5 =
Fix for paragraph spacing and background colour display in Yahoo Mail.