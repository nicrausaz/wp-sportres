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
include_once dirname(__FILE__) . "/pages/Page.php";
include_once dirname(__FILE__) . "/pages/SettingsPage.php";
include_once dirname(__FILE__) . "/pages/GamesPage.php";

// PAGES
$pages = array(
   new SettingsPage('Sport Results', 'settings_page'),
   new GamesPage('Games', 'games_page')
);

/* Hooks */
// Menu
add_action(HK_SETTING_MENU, function () use ($pages) {
   foreach ($pages as $page) {
      $page->register();
   }
});

// Register sections 
add_action(HK_SECTIONS, function () use ($pages) {
   foreach ($pages as $page) {
      $page->settings();
   }
});

// TODO: refactor this
function maxpaginate_input_markup($args)
{
   $setting = get_option('main_page_setting');
   $value   = $setting ?: '';
?>
   <input class="regular-text" type="text" name="main_page_setting" value="<?php echo esc_attr($value); ?>">
<?php
}


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
