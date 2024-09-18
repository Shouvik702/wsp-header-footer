<?php
if (!defined('ABSPATH')) {
  exit;
}

function wsp_header_footer_add_admin_menu() {
  add_menu_page(
    'WSP Header Footer Settings',
    'WSP Header Footer',
    'manage_options',
    'wsp-header-footer-settings',
    'wsp_header_footer_settings_page',
    'dashicons-editor-code'
  );
}

add_action('admin_menu', 'wsp_header_footer_add_admin_menu');

function wsp_header_footer_settings_init() {
  register_setting('wsp_header_footer_settings', 'wsp_header_code', [
    'sanitize_callback' => 'wsp_sanitize_code'
  ]);
  register_setting('wsp_header_footer_settings', 'wsp_footer_code', [
    'sanitize_callback' => 'wsp_sanitize_code'
  ]);
}
add_action('admin_init', 'wsp_header_footer_settings_init');

function wsp_header_footer_settings_page() {
?>
<div class="wrap">
  <h1>WSP Header Footer Settings</h1>
  <form action="options.php" method="post">
    <?php 
    settings_fields('wsp_header_footer_settings');
    do_settings_sections('wsp_header_footer_settings');
    ?>
    <h2>Header Code</h2>
    <textarea name="wsp_header_code" rows="10" cols="70" class="large-text code"><?php echo esc_textarea(get_option('wsp_header_code')); ?></textarea>

    <h2>Footer Code</h2>
    <textarea name="wsp_footer_code" rows="10" cols="70" class="large-text code"><?php echo esc_textarea(get_option('wsp_footer_code')); ?></textarea>

    <p class="description">
      Note: Make sure to use style or script starting and closing tags along with the code.
    </p>
    <?php submit_button('Save Code'); ?>
  </form>
</div>
<?php
}

function wsp_sanitize_code($code) {
  $allowed_html = array(
    'script' => array(),
    'style' => array()
  );
  return wp_kses($code, $allowed_html);
}