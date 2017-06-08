<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class WP_Email_Template_Exclude_Subject_Data
{
	/**
	 * @var data table name
	 */
	public $table_name = 'a3_exclude_email_subject';

	public function __construct() {
		if ( is_admin() ) {
			// Ajax Update Portfolio Feature Order
			add_action( 'wp_ajax_portfolio_update_feature_order', array( $this, 'portfolio_update_feature_order' ) );
			add_action( 'wp_ajax_nopriv_portfolio_update_feature_order', array( $this, 'portfolio_update_feature_order' ) );
		}
	}

	public function install_database() {
		global $wpdb;
		$collate = '';
		if ( $wpdb->has_cap( 'collation' ) ) {
			if( ! empty($wpdb->charset ) ) $collate .= "DEFAULT CHARACTER SET $wpdb->charset";
			if( ! empty($wpdb->collate ) ) $collate .= " COLLATE $wpdb->collate";
		}

		$table_database = $wpdb->prefix . $this->table_name;
		if($wpdb->get_var("SHOW TABLES LIKE '$table_database'") != $table_database){
			$sql = "CREATE TABLE " . $table_database . " (
					   	  `id` bigint(20) NOT NULL auto_increment,
						  `email_sent_by` varchar(250) NOT NULL,
						  `email_subject` text NOT NULL,
						  PRIMARY KEY  (`id`)
						) $collate ;";

			$wpdb->query($sql);
		}

	}

	public function get_all_exclude_subjects() {
		global $wpdb;

		$exclude_subjects = $wpdb->get_results( "SELECT * FROM " . $wpdb->prefix . $this->table_name . " ORDER BY `id` ASC" );

		return $exclude_subjects;
	}

	public function get_all_exclude_subject_titles( $exclude_subjects=array() ) {
		$exclude_subject_titles = array();
		if ( is_array( $exclude_subjects ) && count( $exclude_subjects ) > 0 ) {
			foreach ( $exclude_subjects as $subject_data ) {
				$exclude_subject_titles[] = trim( $subject_data->email_subject );
			}
		}

		return $exclude_subject_titles;
	}

	public function get_exclude_subject( $id ) {
		global $wpdb;

		$exclude_subject = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM " . $wpdb->prefix . $this->table_name . " WHERE `id` = %d ", $id ) );

		return $exclude_subject;
	}

	public function add_subject( $subject_data = array() ) {
		global $wpdb;
		extract( $subject_data );

		$result = $wpdb->query( $wpdb->prepare( "INSERT INTO " . $wpdb->prefix . $this->table_name . "(`email_sent_by`, `email_subject`) VALUES ( %s, %s )", $email_sent_by, $email_subject ) );

		return $result;
	}

	public function delete_subject( $id ) {
		global $wpdb;
		$result = false;

		$exclude_subject = $this->get_exclude_subject( $id );
		if ( $exclude_subject ) {
			$result = $wpdb->query( $wpdb->prepare( "DELETE FROM " . $wpdb->prefix . $this->table_name . " WHERE `id` = %d ", $id ) );
		}

		return $result;
	}

	public function delete_all_subjects() {
		global $wpdb;

		$result = $wpdb->query( "TRUNCATE " . $wpdb->prefix . $this->table_name );

		return $result;
	}

}

global $wp_email_template_exclude_subject_data;
$wp_email_template_exclude_subject_data = new WP_Email_Template_Exclude_Subject_Data();
