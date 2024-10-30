<?php
/**
 * Plugin Name: cool contact
 * Plugin URI: http://www.abdulibrahim.com/cool-contact-wordpress-plugin
 * Description: contact us plugin to offer users a way to contact you
 * Version: 2.5
 * Author: Abdul Ibrahim
 * Author URI: http://www.abdulibrahim.com/
 * License: GPL2
 * started to work on it at 30-4-2014
 */
 
 load_plugin_textdomain( 'ai-cool-contact', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

define('AB_INSERTJS', plugin_dir_url(__FILE__).'js');
define('AB_INSERTCSS', plugin_dir_url(__FILE__).'css');
/// vlidate.js
//

wp_enqueue_script( 
    'validate_js', 
    AB_INSERTJS . '/jquery.validate.min.js', 
    array( 'jquery' ) 
);
wp_enqueue_script('jquery-ui-dialog', array( 'jquery' ));
///////// styles
wp_enqueue_style('cool_site_css',  AB_INSERTCSS.'/site.css');
wp_enqueue_style('cool_admin_css',  AB_INSERTCSS.'/admin.css');
wp_enqueue_style('cool_jquery_ui_css',  AB_INSERTCSS.'/jquery-ui-1.10.4.custom.min.css');

add_shortcode('cool_contact', 'get_form');

function get_form(){
  include('form.php');  
    
}
add_action('admin_menu', 'contact_admin_actions');
function contact_admin_actions() {
    add_menu_page("cool contact", "cool contact", 'manage_options', "cool-contact", "cool_contact", plugins_url( 'images/admin_icon_32.png', __FILE__ ), '35.5824571');
    //add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
}
 

function cool_contact() {
    
    include('contact_admin.php');
    
}
#########################
# 16/6/ 2014
# update options upon activation
########################

register_activation_hook(__FILE__, 'ai_contact_activate');
function ai_contact_activate() {
global $current_user;
get_currentuserinfo();
$user_email = $current_user->user_email; // used for activation setting
// from email to the domain
$fromemail = get_webmaster_email(); // from functions.php
add_option('toemail', $user_email);
add_option('fromemail', $fromemail);// get feom domain
add_option('requirename', 1);
add_option('used_name', 1);
add_option('require_email', 1);
add_option('used_email', 1);
add_option('used_subject', 1);
add_option('email_subject', 'This message sent to you from your site'); // the email subject to be sent
add_option('ip_address', 1);
add_option('required_symbol', '*');

}
#########################
#11-5-2014
#et the get_webmaster_email from site url
########################
function get_webmaster_email()
    {
    $url = get_option('siteurl');
    // Remove protocol from $url
    $url = str_replace("http://", "", $url);
    $url = str_replace("https://", "", $url);
    $url = str_replace("www.", "", $url);

    // Remove page and directory references
    if(stristr($url, "/"))
        $url = substr($url, 0, strpos($url, "/"));
   
    $webmaster_email = 'webmaster@'. $url;
    $default_from_email = $webmaster_email;
    return $default_from_email;
    }


#########################
# ajax handler 25/6/2014
########################
//         this will be sent to the admin-ajax.php hidden field on the form           this function process data
//add_action(       'wp_ajax_ab_contact_action',                                           'ab_contact_action_callback' );    
add_action( 'wp_ajax_ab_contact_action', 'ab_contact_action_callback' );
add_action( 'wp_ajax_nopriv_ab_contact_action', 'ab_contact_action_callback' );
include 'process.php';


