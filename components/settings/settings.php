<?php

if(!defined('ABSPATH')) { exit; }

// Settings name
if(!defined('BO_INTEGRATION_SETTINGS_NAME')) {
	define('BO_INTEGRATION_SETTINGS_NAME', 'bo-integration');
}

// Settings page slug
if(!defined('BO_INTEGRATION_SETTINGS_PAGE')) {
	define('BO_INTEGRATION_SETTINGS_PAGE', 'bo-integration-settings');
}

class BO_Integration_Components_Settings {

	/**
	 * Initialize this component by setting up appropriate actions and filters,
	 * as well as adding shortcodes as necessary and performing any default
	 * tasks that are needed on site load.
	 */
	public static function init() {
		self::_add_actions();
		self::_add_filters();
	}

	private static function _add_actions() {
		if(is_admin()) {
			// Actions that only affect the administrative interface or operation
			add_action('admin_init', array(__CLASS__, 'register_setting'));
			add_action('admin_menu', array(__CLASS__, 'add_settings_page'));
		} else {
			// Actions that only affect the frontend interface or operation
		}

		// Actions that affect both the administrative and frontend interface or operation
	}

	private static function _add_filters() {
		if(is_admin()) {
			// Filters that only affect the administrative interface or operation
		} else {
			// Filters that only affect the frontend interface or operation
		}

		// Filters that affect both the administrative and frontend interface or operation
		add_filter('bo_integration_pre_get_settings', array(__CLASS__, 'pre_get_settings'));
	}

	#region Administrative Interface

	public static function add_settings_page() {
		$settings = add_options_page(__('Save Recipe'), __('Save Recipe'), 'manage_options', BO_INTEGRATION_SETTINGS_PAGE, array(__CLASS__, 'display_settings_page'));
	}

	public static function display_settings_page() {
		$settings = self::_get_settings();

		$support_url = 'http://support.bigoven.com/hc/en-us/articles/202384255';

		include('views/settings.php');
	}

	#endregion Administrative Interface

	#region Settings Fields

	private static function _get_setting_id($name) {
		return BO_INTEGRATION_SETTINGS_NAME . '-' . $name;
	}

	private static function _get_setting_name($name) {
		return BO_INTEGRATION_SETTINGS_NAME . '[' . $name . ']';
	}

	#endregion Settings Fields

	#region Settings

	public static function get_setting($settings_key, $default = null) {
		$settings = self::_get_settings();

		return isset($settings[$settings_key]) ? $settings[$settings_key] : $default;
	}

	public static function pre_get_settings($settings) {
		$settings = is_array($settings) ? $settings : array();

		return shortcode_atts(self::_get_settings_defaults(), $settings);
	}

	public static function register_setting() {
		register_setting(BO_INTEGRATION_SETTINGS_PAGE, BO_INTEGRATION_SETTINGS_NAME, array(__CLASS__, 'sanitize_settings'));
	}

	public static function sanitize_settings($settings) {
		wp_cache_delete(BO_INTEGRATION_SETTINGS_NAME);

		return shortcode_atts(self::_get_settings_defaults(), $settings);
	}

	private static function _get_settings() {
		$settings = apply_filters('bo_integration_pre_get_settings', get_option(BO_INTEGRATION_SETTINGS_NAME, self::_get_settings_defaults()));

		wp_cache_set(BO_INTEGRATION_SETTINGS_NAME, $settings, null, BO_INTEGRATION_CACHE_PERIOD);

		return $settings;
	}

	private static function _get_settings_defaults() {
		return apply_filters('bo_integration_pre_get_settings_defaults', array(
			// Buttons
			'integration' => 'ziplist_after_title',

			// Buttons
			'insert' => 'grocery-save',
		));
	}

	private static function _set_settings($settings) {
		$settings = apply_filters('bo_integration_pre_set_settings', $settings);

		update_option(BO_INTEGRATION_SETTINGS_NAME, $settings);

		return $settings;
	}

	#endregion Settings
}

require_once('lib/template-tags.php');

BO_Integration_Components_Settings::init();
