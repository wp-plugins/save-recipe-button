<?php

/*
Plugin Name: Save Recipe Button (BigOven)
Plugin URI: http://www.bigoven.com/
Description: Easily add "Save Recipe" and "Make Grocery List" features to your recipes.
Version: 1.0.7.RC
Author: BigOven (c) 2014
Author URI: http://www.bigoven.com/
*/

if(!defined('ABSPATH')) { exit; }

// Plugin constants

if(!defined('BO_INTEGRATION_VERSION')) {
	define('BO_INTEGRATION_VERSION', '1.0.7');
}

if(!defined('BO_INTEGRATION_CACHE_PERIOD')) {
	define('BO_INTEGRATION_CACHE_PERIOD', (24 * HOUR_IN_SECONDS));
}

if(!defined('BO_INTEGRATION_PATH')) {
	define('BO_INTEGRATION_PATH', dirname(__FILE__));
}

// Content
require_once(path_join(BO_INTEGRATION_PATH, 'components/content/content.php'));

// Settings
require_once(path_join(BO_INTEGRATION_PATH, 'components/settings/settings.php'));

// Activation
function bo_integration_activation() {
	flush_rewrite_rules();

	do_action('bo_integration_activation');
}
register_activation_hook(__FILE__, 'bo_integration_activation');

// Deactivation
function bo_integration_deactivation() {
	flush_rewrite_rules();

	do_action('bo_integration_deactivation');
}
register_deactivation_hook(__FILE__, 'bo_integration_deactivation');

// Debugging
function bo_integration_debug() {
	if(defined('BO_INTEGRATION_DEBUG') && 'LOG' === BO_INTEGRATION_DEBUG) {
		foreach(func_get_args() as $arg) {
			if(is_scalar($arg)) {
				error_log($arg);
			} else {
				error_log(print_r($arg, true));
			}
		}
	}
}

// Redirection
function bo_integration_redirect($url, $code = 302) {
	wp_redirect($url, $code);
	exit;
}
