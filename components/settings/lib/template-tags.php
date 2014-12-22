<?php

if(!defined('ABSPATH')) { exit; }

function bo_integration_get_integration() {
	return apply_filters(__FUNCTION__, BO_Integration_Components_Settings::get_setting('integration'));
}

function bo_integration_insert_button_grocery() {
	return apply_filters(__FUNCTION__, false !== strpos(BO_Integration_Components_Settings::get_setting('insert'), 'grocery'));
}

function bo_integration_insert_button_save() {
	return apply_filters(__FUNCTION__, false !== strpos(BO_Integration_Components_Settings::get_setting('insert'), 'save'));
}
