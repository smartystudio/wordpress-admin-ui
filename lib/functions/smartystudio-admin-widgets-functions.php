<?php

/**
 * Admin widgets functions
 *
 * @author Smarty Studio (https://www.smartystudio.net)
 */

if (!function_exists('smartystudio_register_menu')) {
	/**
	 * @return void
	 */
	function smartystudio_register_menu() {
		add_options_page(__('Dashboard Widgets', 'smartystudio'), __('Dashboard Widgets', 'smartystudio'), 'administrator', 'dashboard-widgets', 'smartystudio_dashboard_widgets');
	}

	add_action('admin_menu', 'smartystudio_register_menu');
}

if (!function_exists('smartystudio_dashboard_widgets')) {
	/**
	 * @return void
	 */
	function smartystudio_dashboard_widgets() {

		require_once('html/widget-tmp.php');
	}
}

if (!function_exists('smartystudio_remove_dashboard_widgets')) {
	/**
	 * @return void
	 */
	function smartystudio_remove_dashboard_widgets() {

		global $wp_meta_boxes;

		$smartystudio_show_another_widgets = (get_option('smartystudio_show_another_widgets') == 'checked') ? 'checked' : '';

		if ($smartystudio_show_another_widgets != 'checked') {
			unset($wp_meta_boxes['dashboard']);
		}
	}

	add_action('wp_dashboard_setup', 'smartystudio_remove_dashboard_widgets');
}

if (!function_exists('smartystudio_get_default_data')) {
	/**
	 * @return void
	 */
	function smartystudio_get_default_data() {

		$items = $item = [];

		$item['title'] = __('View Site', 'smartystudio');
		$item['icon'] = 'dashicons-visibility';
		$item['link'] = 'site_url';
		$item['status'] = 'checked';
		$item['administrator'] = 'checked';
		$item['editor'] = 'checked';
		$item['author'] = 'checked';
		$item['contributor'] = 'checked';
		$item['order'] = 0;

		$items[] = $item;

		$item['title'] = __('Profile', 'smartystudio');
		$item['icon'] = 'dashicons-universal-access-alt';
		$item['link'] = 'profile.php';
		$item['status'] = 'checked';
		$item['administrator'] = 'checked';
		$item['editor'] = 'checked';
		$item['author'] = 'checked';
		$item['contributor'] = 'checked';
		$item['order'] = 0;

		$items[] = $item;

		$item['title'] = __('Posts', 'smartystudio');
		$item['icon'] = 'dashicons-admin-post';
		$item['link'] = 'edit.php';
		$item['status'] = 'checked';
		$item['administrator'] = 'checked';
		$item['editor'] = 'checked';
		$item['author'] = 'checked';
		$item['contributor'] = 'checked';
		$item['order'] = 0;

		$items[] = $item;

		$item['title'] = __('Media', 'smartystudio');
		$item['icon'] = 'dashicons-admin-media';
		$item['link'] = 'upload.php';
		$item['status'] = 'checked';
		$item['administrator'] = 'checked';
		$item['editor'] = 'checked';
		$item['author'] = 'checked';
		$item['contributor'] = '';
		$item['order'] = 0;

		$items[] = $item;

		$item['title'] = __('Users', 'smartystudio');
		$item['icon'] = 'dashicons-admin-users';
		$item['link'] = 'users.php';
		$item['status'] = 'checked';
		$item['administrator'] = 'checked';
		$item['editor'] = '';
		$item['author'] = '';
		$item['contributor'] = '';
		$item['order'] = 0;

		$items[] = $item;

		$item['title'] = __('Pages', 'smartystudio');
		$item['icon'] = 'dashicons-admin-page';
		$item['link'] = 'edit.php?post_type=page';
		$item['status'] = 'checked';
		$item['administrator'] = 'checked';
		$item['editor'] = 'checked';
		$item['author'] = '';
		$item['contributor'] = '';
		$item['order'] = 0;
		$items[] = $item;

		$item['title'] = __('Plugins', 'smartystudio');
		$item['icon'] = 'dashicons-admin-plugins';
		$item['link'] = 'plugins.php';
		$item['status'] = 'checked';
		$item['administrator'] = 'checked';
		$item['editor'] = '';
		$item['author'] = '';
		$item['contributor'] = '';
		$item['order'] = 0;

		$items[] = $item;

		$item['title'] = __('Settings', 'smartystudio');
		$item['icon'] = 'dashicons-admin-settings';
		$item['link'] = 'options-general.php';
		$item['status'] = 'checked';
		$item['administrator'] = 'checked';
		$item['editor'] = '';
		$item['author'] = '';
		$item['contributor'] = '';
		$item['order'] = 0;

		$items[] = $item;

		return $items;
	}
}

if (!function_exists('smartystudio_custom_dashboard_widget')) {
	/**
	 * @return void
	 */
	function smartystudio_custom_dashboard_widget() {

		if (is_rtl()) {
			echo '<style>#dashboard-widgets .dashicons { margin-right: 0; margin-left: 40px; }</style>';
		}

		// echo '<h3>' . __('Welcome to your dashboard!', 'smartystudio') . '</h3>';

		global $current_user; 	// Use global

		wp_get_current_user(); 	// Make sure global is set, if not set it.

		$website_url = get_bloginfo('url');
		$admin_url = site_url() . "/wp-admin/";

		$widget_button_class = "main_dashboard_widget_button";

		$data = get_option('dashboard-widgets');

		if (empty($data)) {
			$data = smartystudio_get_default_data();
		}

		foreach ($data as $item) {

			if ($item['status'] != 'checked') continue;

			$userRole = array_values($current_user->roles);

			$role = $userRole[0];

			if (!isset($item[$role]) || ($item[$role] != 'checked')) continue;

			if (strpos($item['link'], 'http') === false) { // not full link
				$link = ($item['link'] != 'site_url') ? $admin_url . $item['link'] : home_url();
			} else {
				$link = $item['link'];
			}

			$iconItem = $item['icon'];
			$iconItem = str_replace('dashicons ', '', $iconItem);
			$iconItem = str_replace('fa ', '', $iconItem);

			if (strpos($iconItem, 'dashicons-') !== false) {
				$icon = '<span class="dashicons ' . $iconItem . '"></span>';
			} else {
				$icon = '<i class="fa ' . $iconItem . '"></i>';
			}

			echo '<div class="' . $widget_button_class . '"><a href="' . $link . '">' . $icon . ' <h3>' . __($item['title']) . '</h3></a></div>';
		}

		echo '</div>';
	}
}

if (!function_exists('smartystudio_add_custom_dashboard_widget')) {
	/**
	 * @return void
	 */
	function smartystudio_add_custom_dashboard_widget() {

		// error_reporting(0);

		wp_add_dashboard_widget('smartystudio_custom_dashboard_widget', __('Dashboard Widgets', 'smartystudio'), 'smartystudio_custom_dashboard_widget', 'rc_mdm_configure_my_rss_box');
	}

	add_action('wp_dashboard_setup', 'smartystudio_add_custom_dashboard_widget');
}

/**
 * Remove default WordPress widgets
 */
remove_action('welcome_panel', 'wp_welcome_panel');
