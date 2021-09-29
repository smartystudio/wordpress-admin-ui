<?php

/**
 * Primary color setting class
 *
 * @author Smarty Studio (https://www.smartystudio.net)
 */

class smartystudio_primary_color_settings {

    public function __construct() {
        add_filter('admin_init', array(&$this , 'smartystudio_register_fields'));
    }

    public function smartystudio_register_fields() {
        register_setting('general', 'smartystudio_primary_color', 'esc_attr');
        add_settings_field('smartystudio_primary_color', '<label for=\'smartystudio_primary_color\'>' . __('Admin UI :: Primary Color', 'smartystudio_primary_color') . '</label>', array(&$this, 'smartystudio_fields_html'), 'general');
    }

    public function smartystudio_fields_html() {
        $value = get_option('smartystudio_primary_color', ''); ?>

        <input type='text' id='smartystudio_primary_color' name='smartystudio_primary_color' value='<?php echo $value; ?>' data-default-color='#1d2327'>
        
        <script>
            jQuery(document).ready(function($) {
              	$('#smartystudio_primary_color').wpColorPicker();
            });
        </script><?php
    }
}