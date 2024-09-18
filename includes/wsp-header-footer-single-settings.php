<?php
if (!defined('ABSPATH')) {
    exit;
}

function wsp_add_custom_meta_boxes() {
  $post_types = get_post_types();
  foreach ($post_types as $post_type) {
    add_meta_box(
        'wsp_header_code_meta',   
        'Header Code',            
        'wsp_header_code_meta_box_callback',  
        $post_type,               
        'normal',                 
        'high'                    
    );
    
    add_meta_box(
        'wsp_footer_code_meta',   
        'Footer Code',            
        'wsp_footer_code_meta_box_callback',  
        $post_type,               
        'normal',                 
        'high'                    
    );
  }
}

add_action('add_meta_boxes', 'wsp_add_custom_meta_boxes');

function wsp_header_code_meta_box_callback($post) {
  wp_nonce_field('wsp_save_meta_box_data', 'wsp_meta_box_nonce');
  $header_code = get_post_meta($post->ID, '_wsp_header_code', true);
  echo '<textarea style="width:100%;" rows="6" name="wsp_header_code">' . esc_textarea($header_code) . '</textarea>';
}

function wsp_footer_code_meta_box_callback($post) {
  wp_nonce_field('wsp_save_meta_box_data', 'wsp_meta_box_nonce');
  $footer_code = get_post_meta($post->ID, '_wsp_footer_code', true);
  echo '<textarea style="width:100%;" rows="6" name="wsp_footer_code">' . esc_textarea($footer_code) . '</textarea>';
}

function wsp_save_meta_box_data($post_id) {
  if (!isset($_POST['wsp_meta_box_nonce'])) {
    return;
  }
  if (!wp_verify_nonce($_POST['wsp_meta_box_nonce'], 'wsp_save_meta_box_data')) {
    return;
  }
  if (!current_user_can('edit_post', $post_id)) {
    return;
  }
  $allowed_html = array(
    'script' => array(),
    'style' => array(),
  );
  if (isset($_POST['wsp_header_code'])) {
    $sanitized_header_code = wp_kses($_POST['wsp_header_code'], $allowed_html);
    update_post_meta($post_id, '_wsp_header_code', $sanitized_header_code);
  }
  if (isset($_POST['wsp_footer_code'])) {
    $sanitized_footer_code = wp_kses($_POST['wsp_footer_code'], $allowed_html);
    update_post_meta($post_id, '_wsp_footer_code', $sanitized_footer_code);
  }
}

add_action('save_post', 'wsp_save_meta_box_data');