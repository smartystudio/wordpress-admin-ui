<?php

/**
 * Admin settings functions
 *
 * @author Smarty Studio (https://www.smartystudio.net)
 */

if (!function_exists('smartystudio_enqueue_color_picker')) {
	function smartystudio_enqueue_color_picker($hook_suffix) {
		wp_enqueue_style('wp-color-picker' );
		wp_enqueue_script('smartystudio-script-handle', plugins_url('/smartystudio-admin-ui/src/assets/js/smartystudio-colorpicker.js', __FILE__ ), array('wp-color-picker'), false, true);
	}

	add_action('admin_enqueue_scripts', 'smartystudio_enqueue_color_picker');
}

$smartystudio_primary_color_settings = new smartystudio_primary_color_settings();
$smartystudio_secondary_color_settings = new smartystudio_secondary_color_settings();