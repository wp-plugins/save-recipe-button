<div class="wrap">
	<h2><?php _e('Save Recipe Button - Settings'); ?></h2>
    	<p>This plugin lets your readers easily save your recipes to their personal recipe collection.  A link to your recipe is always preserved, keeping them coming back to your site.</p>

	<p><?php printf(__('While this plugin is &copy; BigOven, all your content is your own, and always will be. Read our <a href="%s" target="_blank">Pledge to Food Bloggers</a>.'), 'http://blog.bigoven.com/index.php/our-pledge-to-food-bloggers/'); ?></p>

	<p><?php printf(__('Do you need help? <a href="%s" target="_blank">Click here</a> to learn more about the BigOven plugin for WordPress.'), 'http://wordpress.bigoven.com'); ?></p>

	<form action="options.php" method="post">
		<h3><?php _e('Add a Save Recipe Button to My Recipes'); ?></h3>

		<table class="form-table">
			<tbody>
				<tr>
					<th scope="row"><label for="<?php echo self::_get_setting_id('integration'); ?>"><?php _e('Where to place button'); ?></label></th>
					<td>
						<select id="<?php echo self::_get_setting_id('integration'); ?>" name="<?php echo self::_get_setting_name('integration'); ?>">
							<option <?php selected('', $settings['integration']); ?> value=""><?php _e('None'); ?></option>

							<!--<optgroup label="EasyRecipe">
								<option <?php selected('easyrecipe_after_title', $settings['integration']); ?> value="easyrecipe_after_title"><?php _e('After Title'); ?></option>
								<option <?php selected('easyrecipe_before_instructions', $settings['integration']); ?> value="easyrecipe_before_instructions"><?php _e('Before Instructions'); ?></option>
								<option <?php selected('easyrecipe_after_instructions', $settings['integration']); ?> value="easyrecipe_after_instructions"><?php _e('After Instructions'); ?></option>
							</optgroup>-->

                            <optgroup label="ZipList">
								<option <?php selected('ziplist_after_title', $settings['integration']); ?> value="ziplist_after_title"><?php _e('Ziplist after title'); ?></option>
								<!--<option <?php selected('ziplist_before_instructions', $settings['integration']); ?> value="ziplist_before_instructions"><?php _e('Before Instructions'); ?></option>-->
								<!--<option <?php selected('ziplist_after_instructions', $settings['integration']); ?> value="ziplist_after_instructions"><?php _e('After Instructions'); ?></option>-->
							</optgroup>
                            <!--
                            <optgroup label="hRecipe format">
								<option <?php selected('hrecipe_after_title', $settings['integration']); ?> value="hrecipe_after_title"><?php _e('After Title'); ?></option>
								<option <?php selected('hrecipe_before_instructions', $settings['integration']); ?> value="hrecipe_before_instructions"><?php _e('Before Instructions'); ?></option>
								<option <?php selected('hrecipe_after_instructions', $settings['integration']); ?> value="hrecipe_after_instructions"><?php _e('After Instructions'); ?></option>
							</optgroup>
                            -->


						</select>
						<p class="description"><?php printf(__('Select the recipe format that you\'re currently using. Select "None" to disable integration. <a href="%s">Learn more</a>.'), 'http://wordpress.bigoven.com'); ?></p>
					</td>
				</tr>
                <!--
				<tr>
					<th scope="row"><label for="<?php echo self::_get_setting_id('insert'); ?>"><?php _e('Integration Options'); ?></label></th>
					<td>
						<select id="<?php echo self::_get_setting_id('insert'); ?>" name="<?php echo self::_get_setting_name('insert'); ?>">
							<option <?php selected('grocery', $settings['insert']); ?> value="grocery"><?php _e('Add to Grocery List Only'); ?></option>
							<option <?php selected('save', $settings['insert']); ?> value="save"><?php _e('Save Recipe Only'); ?></option>
							<option <?php selected('grocery-save', $settings['insert']); ?> value="grocery-and-save"><?php _e('Add to Grocery List and Save Recipe'); ?></option>
						</select>
					</td>
				</tr>
                -->
			</tbody>
		</table>
        
        
        <p>Your readers can download the free BigOven mobile app (iPhone, iPad, Android, Windows Phone) to take your recipes with them to the grocery store. (Membership is free.)</p>

        <h3>Got ideas?</h3>
			<?php printf(__('<p>At BigOven, we\'re cooks and software craftsmen building the the ideal food-blogger\'s companion.  We want to help you make a great site and delight your readers with tools that make planning and organizing easier. Got an idea or suggested improvement? <a href="%s" target="_blank">Let us know</a>.</p>'), 'http://www.bigoven.com/site/comments'); ?>

		<p class="submit">
			<?php settings_fields(BO_INTEGRATION_SETTINGS_PAGE); ?>
			<input type="submit" class="button button-primary" value="<?php _e('Save Changes'); ?>" />
		</p>
	</form>
</div>
