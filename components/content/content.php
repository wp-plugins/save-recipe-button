<?php

if(!defined('ABSPATH')) { exit; }

class BO_Integration_Components_Content {

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
		} else {
			// Actions that only affect the frontend interface or operation
			add_action('wp_enqueue_scripts', array(__CLASS__, 'enqueue_resources'));
		}

		// Actions that affect both the administrative and frontend interface or operation
	}

	private static function _add_filters() {
		if(is_admin()) {
			// Filters that only affect the administrative interface or operation
		} else {
			// Filters that only affect the frontend interface or operation
			add_filter('the_content', array(__CLASS__, 'insert_buttons'), 1001);
		}

		// Filters that affect both the administrative and frontend interface or operation
		add_filter('bo_integration_ziplist_after_title', array(__CLASS__, 'insert_buttons_ziplist_after_title'), 11, 3);
		add_filter('bo_integration_ziplist_before_instructions', array(__CLASS__, 'insert_buttons_ziplist_before_instructions'), 11, 3);
		add_filter('bo_integration_ziplist_after_instructions', array(__CLASS__, 'insert_buttons_ziplist_after_instructions'), 11, 3);
	}

	#region Scripts & Styles

	public static function enqueue_resources() {
		wp_enqueue_script('bigoven-integration-content', plugins_url('resources/content.js', __FILE__), array('jquery'), BO_INTEGRATION_VERSION, true);
		wp_enqueue_style('bigoven-integration-content', plugins_url('resources/content.css', __FILE__), array(), BO_INTEGRATION_VERSION);
	}

	#endregion Scripts & Styles

	#region Buttons

	public static function insert_buttons($content) {
		$integration        = bo_integration_get_integration();
		$insert_grocery     = bo_integration_insert_button_grocery();
		$insert_save        = bo_integration_insert_button_save();

		if(!empty($integration)) {
			$content = apply_filters("bo_integration_{$integration}", $content, $insert_grocery, $insert_save);
		}

		return $content;
	}

	#endregion Buttons

	#region EasyRecipe

	private static function _get_buttons($insert_grocery, $insert_save) {
		$buttons = array();

        /* text
		if($insert_grocery) {
			$buttons[] = sprintf('<a class="bo-integration-grocery-list" href="#">%s</a>', __('Add to Grocery List'));
		}

		if($insert_save) {
			$buttons[] = sprintf('<a class="bo-integration-save-recipe" href="#">%s</a>', __('Save Recipe'));
		}
        */
        $buttonImg = plugins_url('resources/saverecipe.png', __FILE__);

		if($insert_save) {
			$buttons[] = sprintf('<a class="bo-integration-save-recipe" href="javascript:void(0);"><img src="%s" style="cursor:pointer;" alt="Save Recipe"/>%s</a>', $buttonImg, __('Save Recipe'));
		}
       
        
		return empty($buttons) ? '' : '<div class="bo-integration-buttons">' . implode(' ', $buttons) . '</div>';
	}

	private static function _parse_content($content) {
		if(!function_exists('str_get_html')) {
			require_once('vendor/simple_html_dom.php');
		}

		return str_get_html($content);
	}

	public static function insert_buttons_easyrecipe_after_title($content, $insert_grocery, $insert_save) {
		$buttons = self::_get_buttons($insert_grocery, $insert_save);

		if(!empty($buttons)) {
			$parsed = self::_parse_content($content);
			$titles = $parsed->find('.ERSName');

			foreach($titles as $title) {
				$content = str_replace($title->outerText(), $title->outerText() . $buttons, $content);
			}
		}

		return $content;
	}

	public static function insert_buttons_easyrecipe_before_instructions($content, $insert_grocery, $insert_save) {
		$buttons = self::_get_buttons($insert_grocery, $insert_save);

		if(!empty($buttons)) {
			$parsed = self::_parse_content($content);
			$instructions = $parsed->find('.ERSInstructions');

			foreach($instructions as $instruction) {
				$content = str_replace($instruction->outerText(), $buttons . $instruction->outerText(), $content);
			}
		}

		return $content;
	}

	public static function insert_buttons_easyrecipe_after_instructions($content, $insert_grocery, $insert_save) {
		$buttons = self::_get_buttons($insert_grocery, $insert_save);

		if(!empty($buttons)) {
			$parsed = self::_parse_content($content);
			$instructions = $parsed->find('.ERSInstructions');

			foreach($instructions as $instruction) {
				$content = str_replace($instruction->outerText(), $instruction->outerText() . $buttons, $content);
			}
		}

		return $content;
	}

	#endregion EasyRecipe

    #region ZipList

	public static function insert_buttons_ziplist_after_title($content, $insert_grocery, $insert_save) {
		$buttons = self::_get_buttons($insert_grocery, $insert_save);

		if(!empty($buttons)) {
			$parsed = self::_parse_content($content);
			$titles = $parsed->find('.ziplist-button');

			foreach($titles as $title) {
				//$content = str_replace($title->outerText(), $title->outerText() . $buttons, $content);

                $xbtn = "<a class='bo-save-link' title='Save recipe' href='javascript:void(0);' onclick='doSaveRecipe();' style='padding-left:20px;'>Save</a>";
                $content = str_replace($title->outerText(), $xbtn , $content);

   				

			}
            
            $content = str_replace('<img src="http://asset1.ziplist.com/wk/add_recipe-large.png">', '', $content);
		}

		return $content;
	}

	public static function insert_buttons_ziplist_before_instructions($content, $insert_grocery, $insert_save) {
		$buttons = self::_get_buttons($insert_grocery, $insert_save);

		if(!empty($buttons)) {
			$parsed = self::_parse_content($content);
			$instructions = $parsed->find('#zlrecipe-ingredients');

			foreach($instructions as $instruction) {
				$content = str_replace($instruction->outerText(), $buttons . $instruction->outerText(), $content);
			}
		}

		return $content;
	}

	public static function insert_buttons_ziplist_after_instructions($content, $insert_grocery, $insert_save) {
		$buttons = self::_get_buttons($insert_grocery, $insert_save);

		if(!empty($buttons)) {
			$parsed = self::_parse_content($content);
			$instructions = $parsed->find('#zlrecipe-instructions');

			foreach($instructions as $instruction) {
				$content = str_replace($instruction->outerText(), $instruction->outerText() . $buttons, $content);
			}
		}

		return $content;
	}

	#endregion ZipList

}

BO_Integration_Components_Content::init();
