<?php
if (!defined('ABSPATH')) {
    exit;
}

function wsp_inject_single_header_code() {
  if (is_single() || is_page()) {
    global $post;
    $header_code = get_post_meta($post->ID, '_wsp_header_code', true);
    if (!empty($header_code)) {
      echo $header_code;
    }
  }
}

add_action('wp_head', 'wsp_inject_single_header_code');

function wsp_inject_single_footer_code(){
  if (is_single() || is_page()){
    global $post;
    $footer_code = get_post_meta($post->ID, '_wsp_footer_code', true);
    if (!empty($footer_code)) {
      echo $footer_code;
    }
  }
}

add_action('wp_footer', 'wsp_inject_single_footer_code');