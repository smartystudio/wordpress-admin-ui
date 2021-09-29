<?php

/**
 * Secondary color setting class
 *
 * @author Smarty Studio (https://www.smartystudio.net)
 */

class smartystudio_secondary_color_settings {

    public function __construct() {
        add_filter('admin_init', array(&$this , 'smartystudio_register_fields'));
    }

    public function smartystudio_register_fields() {
        register_setting('general', 'smartystudio_secondary_color', 'esc_attr');
        add_settings_field('smartystudio_secondary_color', '<label for=\'smartystudio_secondary_color\'>' . __('Admin UI :: Secondary Color' , 'smartystudio_secondary_color') . '</label>', array(&$this, 'smartystudio_fields_html'), 'general');
    }
	
    public function smartystudio_fields_html() {
        $value = get_option('smartystudio_secondary_color', ''); ?>

        <input type='text' id='smartystudio_secondary_color' name='smartystudio_secondary_color' value='<?php echo $value; ?>' data-default-color='#feba15'>
        
		<script>
            jQuery(document).ready(function($) {
              	$('#smartystudio_secondary_color').wpColorPicker();
            });
        </script><?php
    }
}