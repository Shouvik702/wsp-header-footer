<?php
/**
 * WSP Header Footer
 *
 * Plugin Name: WSP Header Footer
 * Plugin URI:  https://youtu.be/TkLB-D4b2eA
 * Description: Inject custom code into the header or footer globally or on specific pages and posts in wordpress.
 * Version:     1.0.0
 * Author:      WebStylePress
 * Author URI:  https://www.webstylepress.com
 * License:     GPLv2 or later
 * License URI: http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * Requires at least: 4.9
 * Requires PHP: 5.2.4
 *
 */

if (!defined('ABSPATH')) {
  exit;
}

include(plugin_dir_path(__FILE__) . 'includes/wsp-header-footer-settings.php');
include(plugin_dir_path(__FILE__) . 'includes/wsp-header-footer-display.php');

include(plugin_dir_path(__FILE__) . 'includes/wsp-header-footer-single-settings.php');
include(plugin_dir_path(__FILE__) . 'includes/wsp-header-footer-single-display.php');