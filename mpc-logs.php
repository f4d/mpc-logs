<?php
/**
 * the main plugin file
 *
 * @package MPC Logs
 * @since 0.1
 */
 
/*
Plugin Name: MPC Logs
Description: Control Panel with helpful links to various logs.
Version: 1.0
*/
class Mpc_Logs {

/** the class constructor   */
	public function __construct() {
		if ( is_admin() ){ 
			add_action( 'admin_menu', array( $this, 'plugin_menu' ) );
			add_action( 'admin_init',  array( $this, 'plugin_admin_init' ) );
		}
	}

	public function plugin_menu() {
		//add_options_page( $page_title, $menu_title, $capability, $menu_slug, $function);
		add_options_page( 'Mpc Logs', 'Mpc Logs', 'manage_options', 'mpc-logs', array( $this, 'plugin_options' ) );
	}	
	public function plugin_options() {
		if ( !current_user_can( 'manage_options' ) )  {
			wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
		} 
		$str = '<div class="wrap">';
    $str .= do_settings_sections('mpc-logs'); 
    $str .= '</div>';
		return $str;
	}	
	public function plugin_admin_init(){
		//add_settings_section ( string $id, string $title, callable $callback, string $page )
		add_settings_section('plugin_main', 'Main Settings', array($this,'plugin_section_text'), 'mpc-logs');
	}
	public function plugin_section_text() {
		$str = '<h3>Useful Links</h3>';
		$str .= '<ul>';
		$str .= '<li><a target="_blank" href="/wp-admin/admin.php?page=gf_entries&id=68">Phone Numbers</a></li>';
		$str .= '<li><a target="_blank" href="https://www.twilio.com/user/account/messaging/logs">Twilio</a></li>';
		$str .= '<li><a target="_blank" href=" /wp-content/uploads/gravity_forms/logs/gravity-forms-salesforce.txt">Gravity Forms/SalesForce</a></li>';
		$str .= '<li><a target="_blank" href="/wp-content/uploads/gravity_forms/logs/gravityformsuserregistration.txt">Gravity Forms User Registration</a></li>';
		$str .= '<li>For Heroku logs, use toolbelt, and type: <b>heroku logs</b></li>';

		$str .= '</ul>';
		echo $str;
	}
}

$mpc_logs = new Mpc_Logs();