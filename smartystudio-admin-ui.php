<?php
/**
 * Plugin Name: SmartyStudio - WP Admin UI
 * Plugin URI: https://www.smartystudio.net
 * Author: SMARTY STUDIO (https://www.smartystudio.net)
 * Author URI: https://www.smartystudio.net
 * Description: WordPress Admin UI is a super clean, gray and yellow colored admin panel theme with the ability to change the colors.
 * Version: 1.0
 * License: GNU General Public License v2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 * Tags: admin-ui, admin-panel, wp-admin, wp-admin-ui, admin-dashboard, custom-admin, custom-admin-ui
 */

/**
 * Theme classes
 */
require_once('lib/classes/smartystudio-primary-color-settings-class.php');
require_once('lib/classes/smartystudio-secondary-color-settings-class.php');

/**
 * Theme functions
 */
require_once('lib/functions/smartystudio-admin-settings-functions.php');


if (!function_exists('smartystudio_admin_ui_primary_color')) {
	/**
	 * @return void
	 */
	function smartystudio_admin_ui_primary_color() {
		$smartystudio_primary_color = '#1d2327';
		
		if (get_option('smartystudio_primary_color') != '') {
			$smartystudio_primary_color = get_option('smartystudio_primary_color');
		} else {
			$smartystudio_primary_color;
		}

		return $smartystudio_primary_color;
	}
}

if (!function_exists('smartystudio_admin_ui_secondary_color')) {
	/**
	 * @return void
	 */
	function smartystudio_admin_ui_secondary_color() {
		$smartystudio_secondary_color = '#feba15';
		
		if (get_option('smartystudio_secondary_color') != '') {
			$smartystudio_secondary_color = get_option('smartystudio_secondary_color');
		} else {
			$smartystudio_secondary_color;
		}

		return $smartystudio_secondary_color;
	}
}

if (!function_exists('smartystudio_login_style')) {
	/**
	 * @return void
	 */
	function smartystudio_login_style() {
		wp_enqueue_style('smartystudio-login-style', plugins_url() . '/smartystudio-admin-ui/src/assets/css/smartystudio-login.css');

		$login_css = 'body, html { background: ' . smartystudio_admin_ui_primary_color() . '; }';

		wp_add_inline_style('smartystudio-login-style', $login_css);
	}

	add_action('login_enqueue_scripts', 'smartystudio_login_style');
}

if (!function_exists('smartystudio_admin_bar_style')) {
	/**
	 * @return void
	 */
	function smartystudio_admin_bar_style() {
		wp_enqueue_style('smartystudio-admin-bar-style', plugins_url() . '/smartystudio-admin-ui/src/assets/css/smartystudio-admin-bar.css');

		$admin_bar_css  = '#wpadminbar { background: ' . smartystudio_admin_ui_primary_color() . '; }';
		$admin_bar_css .= '#wpadminbar .menupop .ab-sub-wrapper, #wpadminbar .shortlink-input { background: ' . smartystudio_admin_ui_primary_color() . '; }';

		wp_add_inline_style('smartystudio-admin-bar-style', $admin_bar_css);
	}

	add_action('admin_enqueue_scripts', 'smartystudio_admin_bar_style');
}

if (!function_exists('smartystudio_admin_theme_style')) {
	/**
	 * @return void
	 */
	function smartystudio_admin_theme_style() {
		wp_enqueue_style('smartystudio-admin-style', plugins_url() . '/smartystudio-admin-ui/src/assets/css/smartystudio-admin.css');

		ob_start();

		$admin_css = "
			a,
			input[type=checkbox]:checked:before,
			.view-switch a.current:before {
				color: " . smartystudio_admin_ui_primary_color() . ";
			}

			a:hover {
				color: " . smartystudio_admin_ui_secondary_color() . ";
			}

			#wpadminbar .quicklinks .ab-sub-wrapper .menupop.hover > a, 
			#wpadminbar .quicklinks .menupop ul li a:focus, 
			#wpadminbar .quicklinks .menupop ul li a:focus strong, 
			#wpadminbar .quicklinks .menupop ul li a:hover, 
			#wpadminbar .quicklinks .menupop ul li a:hover strong, 
			#wpadminbar .quicklinks .menupop.hover ul li a:focus, 
			#wpadminbar .quicklinks .menupop.hover ul li a:hover, 
			#wpadminbar .quicklinks .menupop.hover ul li div[tabindex]:focus, 
			#wpadminbar .quicklinks .menupop.hover ul li div[tabindex]:hover, 
			#wpadminbar li #adminbarsearch.adminbar-focused::before, 
			#wpadminbar li .ab-item:focus .ab-icon::before, 
			#wpadminbar li .ab-item:focus::before, 
			#wpadminbar li a:focus .ab-icon::before, 
			#wpadminbar li.hover .ab-icon::before, 
			#wpadminbar li.hover .ab-item::before, 
			#wpadminbar li:hover #adminbarsearch::before, 
			#wpadminbar li:hover .ab-icon::before, 
			#wpadminbar li:hover .ab-item::before, 
			#wpadminbar.nojs .quicklinks .menupop:hover ul li a:focus, 
			#wpadminbar.nojs .quicklinks .menupop:hover ul li a:hover {
				color: " . smartystudio_admin_ui_secondary_color() . ";
			}

			#adminmenu li a:focus div.wp-menu-image:before,
			#adminmenu li.opensub div.wp-menu-image:before,
			#adminmenu li:hover div.wp-menu-image:before {
				color: " . smartystudio_admin_ui_primary_color() . " !important;
			}

			#adminmenu .wp-has-current-submenu .wp-submenu .wp-submenu-head,
			#adminmenu .wp-menu-arrow,
			#adminmenu .wp-menu-arrow div,
			#adminmenu li.current a.menu-top,
			#adminmenu li.wp-has-current-submenu a.wp-has-current-submenu,
			.folded #adminmenu li.current.menu-top,
			.folded #adminmenu li.wp-has-current-submenu,
			#adminmenu li.menu-top:hover,
			#adminmenu li.opensub>a.menu-top,
			#adminmenu li>a.menu-top:focus {
				background: " . smartystudio_admin_ui_primary_color() . ";
				background: #ffffff;
			}

			#adminmenu .opensub .wp-submenu li.current a,
			#adminmenu .wp-submenu li.current,
			#adminmenu .wp-submenu li.current a,
			#adminmenu .wp-submenu li.current a:focus,
			#adminmenu .wp-submenu li.current a:hover,
			#adminmenu a.wp-has-current-submenu:focus+.wp-submenu li.current a,
			#adminmenu .wp-submenu .wp-submenu-head,
			#adminmenu .current div.wp-menu-image:before,
			#adminmenu .wp-has-current-submenu div.wp-menu-image:before,
			#adminmenu a.current:hover div.wp-menu-image:before,
			#adminmenu a.wp-has-current-submenu:hover div.wp-menu-image:before,
			#adminmenu li.wp-has-current-submenu:hover div.wp-menu-image:before, 
			#adminmenu li:hover div.wp-menu-image:before {
				color: " . smartystudio_admin_ui_primary_color() . ";
			}

			#adminmenu li.wp-has-current-submenu a.wp-has-current-submenu div.wp-menu-name {
				color: " . smartystudio_admin_ui_primary_color() . ";
			}

			.wrap .add-new-h2,
			.wrap .add-new-h2:active {
				background: " . smartystudio_admin_ui_primary_color() . ";
			}

			.wrap .add-new-h2:hover {
				background: " . smartystudio_admin_ui_secondary_color() . ";
			}

			div.updated {
				border-left: 5px solid " . smartystudio_admin_ui_primary_color() . ";
			}

			#adminmenu li a.wp-has-current-submenu .update-plugins,
			#adminmenu li.current a .awaiting-mod {
				background-color: " . smartystudio_admin_ui_primary_color() . ";
			}

			#adminmenu .wp-submenu a:focus, 
			#adminmenu .wp-submenu a:hover, 
			#adminmenu a:hover, 

			#adminmenu li.menu-top > a:focus,
			#adminmenu li.menu-top:hover, 
			#adminmenu li.opensub > a.menu-top, 
			#adminmenu li > a.menu-top:focus,
			
			#wpadminbar li:hover .ab-icon::before, 
			#wpadminbar li:hover .ab-item::before {
				color: " . smartystudio_admin_ui_secondary_color() . ";
			}

			.customize-controls-close:focus, 
			.customize-controls-close:hover, 
			.customize-controls-preview-toggle:focus, 
			.customize-controls-preview-toggle:hover {
				color: " . smartystudio_admin_ui_secondary_color() . ";
				border-top-color: " . smartystudio_admin_ui_secondary_color() . ";
			}

			.customize-panel-back:focus, 
			.customize-panel-back:hover, 
			.customize-section-back:focus, 
			.customize-section-back:hover,
			#customize-controls .control-section .accordion-section-title:focus, 
			#customize-controls .control-section .accordion-section-title:hover, 
			#customize-controls .control-section.open .accordion-section-title, 
			#customize-controls .control-section:hover > .accordion-section-title {
				color: " . smartystudio_admin_ui_secondary_color() . ";
				border-left-color: " . smartystudio_admin_ui_secondary_color() . ";
			}

			#customize-controls .customize-info .customize-help-toggle:focus, 
			#customize-controls .customize-info .customize-help-toggle:hover, 
			#customize-controls .customize-info.open .customize-help-toggle,
			#customize-controls .customize-info.open.active-menu-screen-options .customize-help-toggle:active, 
			#customize-controls .customize-info.open.active-menu-screen-options .customize-help-toggle:focus, 
			#customize-controls .customize-info.open.active-menu-screen-options .customize-help-toggle:hover, 
			.active-menu-screen-options .customize-screen-options-toggle, .customize-screen-options-toggle:active, 
			.customize-screen-options-toggle:focus, .customize-screen-options-toggle:hover,
			#customize-outer-theme-controls .control-section .accordion-section-title:focus::after, 
			#customize-outer-theme-controls .control-section .accordion-section-title:hover::after, 
			#customize-outer-theme-controls .control-section.open .accordion-section-title::after, 
			#customize-outer-theme-controls .control-section:hover > .accordion-section-title::after, 
			#customize-theme-controls .control-section .accordion-section-title:focus::after, 
			#customize-theme-controls .control-section .accordion-section-title:hover::after, 
			#customize-theme-controls .control-section.open .accordion-section-title::after, 
			#customize-theme-controls .control-section:hover > .accordion-section-title::after {
				color: " . smartystudio_admin_ui_secondary_color() . ";
			}

			.wrap .add-new-h2, 
			.wrap .add-new-h2:active, 
			.wrap .page-title-action, 
			.wrap .page-title-action:active {
				border: 1px solid " . smartystudio_admin_ui_primary_color() . ";
				color: " . smartystudio_admin_ui_primary_color() . ";
			}

			.wrap .add-new-h2:hover, .wrap .page-title-action:hover {
				border-color: " . smartystudio_admin_ui_secondary_color() . ";
				color: " . smartystudio_admin_ui_secondary_color() . ";
			}

			.wp-core-ui .button-primary {
				background: " . smartystudio_admin_ui_secondary_color() . ";
				border-color: " . smartystudio_admin_ui_secondary_color() . ";
			}

			.wp-core-ui .button, 
			.wp-core-ui .button-primary,
			.wp-core-ui .button-secondary {
				color: " . smartystudio_admin_ui_primary_color() . ";
				border-color: " . smartystudio_admin_ui_primary_color() . ";
			}

			.wp-core-ui .button-link,
			.wp-core-ui select:hover {
				color: " . smartystudio_admin_ui_primary_color() . ";
			}

			.wp-core-ui .button:hover,
			.wp-core-ui .button-secondary:hover,
			.wp-core-ui .button.hover,
			.wp-core-ui .button:hover,
			.wp-core-ui .button-primary.focus, 
			.wp-core-ui .button-primary.hover, 
			.wp-core-ui .button-primary:focus, 
			.wp-core-ui .button-primary:hover {
				background: " . smartystudio_admin_ui_primary_color() . ";
				border-color: " . smartystudio_admin_ui_primary_color() . ";
				color: " . smartystudio_admin_ui_secondary_color() . ";
			}

			.wp-core-ui .button-primary.focus, 
			.wp-core-ui .button-primary.hover, 
			.wp-core-ui .button-primary:focus, 
			.wp-core-ui .button-primary:hover {
				background: " . smartystudio_admin_ui_primary_color() . ";
			}

			#collapse-button:focus,
			#collapse-button:hover,
			.wp-core-ui .button-link:active, 
			.wp-core-ui .button-link:hover,
			.wp-core-ui .wp-full-overlay .collapse-sidebar:focus, 
			.wp-core-ui .wp-full-overlay .collapse-sidebar:hover {
				color: " . smartystudio_admin_ui_secondary_color() . ";
			}

			.wp-full-overlay .collapse-sidebar:focus .collapse-sidebar-arrow, 
			.wp-full-overlay .collapse-sidebar:hover .collapse-sidebar-arrow {
				box-shadow: 0 0 0 1px " . smartystudio_admin_ui_secondary_color() . ",0 0 2px 1px " . smartystudio_admin_ui_secondary_color() . ";
			}

			.menu-item-handle:hover,
			#available-menu-items .menu-item-handle:hover .item-add, 
			.menu-item-handle:hover .item-edit, 
			.menu-item-handle:hover .item-type {
				color: " . smartystudio_admin_ui_secondary_color() . ";
			}

			.plugin-update-tr.active td, 
			.plugins .active th.check-column,
			.community-events li.event-none,
			.notice-info, 
			.theme-overlay .parent-theme {
				border-left: 4px solid " . smartystudio_admin_ui_secondary_color() . ";
			}

			.health-check-tab.active, .privacy-settings-tab.active {
				box-shadow: inset 0 -3px " . smartystudio_admin_ui_primary_color() . ";
			}

			.health-check-accordion-trigger .badge.blue, 
			.privacy-settings-accordion-trigger .badge.blue {
				border: 1px solid " . smartystudio_admin_ui_secondary_color() . ";
			}

			input[type='checkbox']:focus, 
			input[type='color']:focus, 
			input[type='date']:focus, 
			input[type='datetime-local']:focus, 
			input[type='datetime']:focus, 
			input[type='email']:focus, 
			input[type='month']:focus, 
			input[type='number']:focus, 
			input[type='password']:focus, 
			input[type='radio']:focus, 
			input[type='search']:focus, 
			input[type='tel']:focus, 
			input[type='text']:focus, 
			input[type='time']:focus, 
			input[type='url']:focus, 
			input[type='week']:focus, 
			select:focus, textarea:focus {
				border-color: " . smartystudio_admin_ui_secondary_color() . ";
				box-shadow: 0 0 0 1px " . smartystudio_admin_ui_secondary_color() . ";
			}

			.composer-switch a,
			.composer-switch a:visited,
			.composer-switch a.wpb_switch-to-front-composer,
			.composer-switch a:visited.wpb_switch-to-front-composer,
			.composer-switch .logo-icon {
				background-color: " . smartystudio_admin_ui_primary_color() . " !important;
			}

			.composer-switch .vc-spacer, 
			.composer-switch a.wpb_switch-to-composer:hover, 
			.composer-switch a:visited.wpb_switch-to-composer:hover, 
			.composer-switch a.wpb_switch-to-front-composer:hover, 
			.composer-switch a:visited.wpb_switch-to-front-composer:hover {
				background-color: " . smartystudio_admin_ui_secondary_color() . " !important;
			}
			
			.split-page-title-action a, 
			.split-page-title-action a:active, 
			.split-page-title-action .expander::after {
				color: " . smartystudio_admin_ui_primary_color() . " !important;
			}
			
			.split-page-title-action a:hover, 
			.split-page-title-action a:active {
				background: " . smartystudio_admin_ui_primary_color() . " !important;
				color: " . smartystudio_admin_ui_secondary_color() . " !important;
			}
		";

		wp_add_inline_style('smartystudio-admin-style', $admin_css);

		$admin_css = ob_get_clean();
		return $admin_css;
	}

	add_action('admin_enqueue_scripts', 'smartystudio_admin_theme_style');
}

if (!function_exists('smartystudio_update_admin_footer')) {
	/**
	 * @return void
	 */
	function smartystudio_update_admin_footer() {
		echo '<div style="display:inline-block;"><img src="' . plugins_url() . '/smartystudio-admin-ui/src/assets/images/smartystudio-sm.png" style="position:relative;top:3px;margin-right:10px;">WordPress Admin UI by&nbsp;<a href="https://smartystudio.net" target="_blank">SMARTY STUDIO</a> | Powered by <a href="http://wordpress.org" target="_blank">WordPress</a></div>';
	}

	add_filter('admin_footer_text', 'smartystudio_update_admin_footer');
}

if (!function_exists('smartystudio_admin_bar_style')) {
	/**
	 * Remove default HTML height on the admin bar callback
	 *
	 * @return void
	 */
	function smartystudio_admin_bar_style() {
		if (is_admin_bar_showing()) { ?>
			<style type="text/css" media="screen">
				html { margin-top: 46px !important; }
				* html body { margin-top: 46px !important; }
			</style>
		<?php } 
	}
	
	add_theme_support('admin-bar', array('callback' => 'smartystudio_admin_bar_style'));
}