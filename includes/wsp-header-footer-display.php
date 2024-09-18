<?php
if (!defined('ABSPATH')) {
    exit;
}

function wsp_inject_header_code() {
  $header_code = get_option('wsp_header_code');
  if (!empty($header_code)){
    echo $header_code;
  }

}
add_action('wp_head', 'wsp_inject_header_code');

function wsp_inject_footer_code(){
  $footer_code = get_option('wsp_footer_code');
  if (!empty($footer_code)) {
    echo $footer_code;
  }
}

add_action('wp_footer', 'wsp_inject_footer_code');