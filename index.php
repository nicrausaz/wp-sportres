<?php
/*
  Plugin Name: Sport Results
  Description: Manage & display your sport team's results
  Author: Nicolas Crausaz
  Version: 1.0.0
  Author URI: https://crausaz.click
  Plugin URI: http://wordpress.org/plugins/sportres/
 */

// Requires
include_once dirname(__FILE__) . "/defaults.php";
include_once dirname(__FILE__) . "/SettingField.php";
include_once dirname(__FILE__) . "/pages/Page.php";
include_once dirname(__FILE__) . "/pages/SettingsPage.php";
include_once dirname(__FILE__) . "/pages/GamesPage.php";

// PAGES
$st_page = new SettingsPage('Sport Results', 'settings_page');
$gm_page = new GamesPage('Games', 'games_page');

$pages = array(
   $st_page,
   $gm_page
);

/* Hooks */
// Menu
add_action(HK_SETTING_MENU, function () use ($pages) {
   foreach ($pages as $page) {
      $page->register();
   }
});

$settings_page_fields = array(
   new SettingField('max_paginate', 'Number of games to display', function () {
      $value = get_option('max_paginate') ?: '';
      ?>
         <input class="regular-text" type="text" name="max_paginate" value="<?php echo esc_attr($value); ?>">
      <?php
   })
);

// Register sections 
add_action(HK_SECTIONS, function () use ($st_page, $settings_page_fields) {
   $st_page->settings($settings_page_fields);
});


/* BLOCKS */
add_action('init', function () {
   wp_register_script('sportres-block-game-js', get_template_directory_uri() . '/assets/js/gutenberg/sportres-block-game.js');

   register_block_type('sportres/gameblock', [
      'editor_script' => 'sportres-block-game-js',
   ]);
});

/* SHORTCODES */
function shortcode_game()
{
   return "This is the game shortcode";
}

add_shortcode('game', 'shortcode_game');
