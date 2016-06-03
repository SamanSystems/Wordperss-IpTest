<?php
/*
Plugin Name: Real server Ip detector
Plugin URI : http://wp-master.ir
Author: wp-master.ir
Author URI: http://wp-master.ir
Version: 0.1
url:http://wp-master.ir
Description: this plugin use www.zarinpal.com ip test page to show real ip to site admin(uses in payment gateways)
Text Domain: rsi
*/

/*
* No script kiddies please!
*/
defined('ABSPATH') or die('No script kiddies please!');


/*
* load plugin language
*/
add_action('plugins_loaded', '_rsi_lang');
function _rsi_lang()
{
    load_plugin_textdomain('rsi', false, dirname(plugin_basename(__FILE__)).DIRECTORY_SEPARATOR);
}

/*
* Hook menu
*/
add_action('admin_menu', '_rsi_menu');
function _rsi_menu()
{
    add_options_page(__('Real Ip detector settings', 'rsi'), __('Real Ip detector', 'rsi'), 'manage_options', 'rsi', 'rsi_menu');
}

function rsi_menu()
{
    $content = file_get_contents('http://www.zarinpal.com/labs/TestIP');
    preg_match('/(\d+)\.(\d+)\.(\d+)\.(\d+)/', $content, $matches);
    $msg = __('Your Server IP is:', 'rsi');
    echo '<pre>'.$msg.' <b>'.$matches[0].'</b></pre>';
}
