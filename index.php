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
include_once dirname(__FILE__) . "./init.php";
include_once dirname(__FILE__) . "./Query.php";

// PAGES
$st_page = new SettingsPage('Sport Results', 'settings_page');
$gm_page = new GamesPage('Games', 'games_page');

$pages = array($st_page, $gm_page);

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

$settings_games_page = array(
   new SettingField('games', '', function () {

      global $table_prefix, $wpdb;
      $table_name = $table_prefix . "sportres_games";

      $all_games = Query::getAllGames();

      if (isset($_POST)) {
         Query::insertGame($_POST);
      }
      ?>
      <table class="game_table">
         <thead>
            <th>ID</th>
            <th>Team 1</th>
            <th>Score team 1</th>
            <th>Score team 2</th>
            <th>Team 2</th>
         </thead>
         <tbody>

         <?php foreach($all_games as $game) { ?>
            <tr>
               <td><?= $game->id ?></td>
               <td><?= $game->team_1 ?></td>
               <td><?= $game->score_team_1 ?></td>
               <td><?= $game->score_team_2 ?></td>
               <td><?= $game->team_2 ?></td>
            </tr>
         <?php } ?>
            <tr>
               <td>Add new game</td>
               <td><input type="text" name="new_team1" placeholder="Team 1" /></td>
               <td><input type="text" name="new_score_team1" placeholder="Team 1 score" /></td>
               <td><input type="text" name="new_score_team2" placeholder="Team 2 score" /></td>
               <td><input type="text" name="new_team2" placeholder="Team 2" /></td>
            </tr>
         </tbody>
      </table>
      <?php
   })
);

// Register sections 
add_action(HK_SECTIONS, function () use ($st_page, $settings_page_fields) {
   $st_page->settings($settings_page_fields);
});

add_action(HK_SECTIONS, function () use ($gm_page, $settings_games_page) {
   $gm_page->settings($settings_games_page);
});


/* BLOCKS */
add_action(HK_BLOCK, function () {
   wp_register_script('sportres-block-game-js', get_template_directory_uri() . '/assets/js/gutenberg/sportres-block-game.js');

   register_block_type('sportres/gameblock', [
      'editor_script' => 'sportres-block-game-js',
   ]);
});

/* SHORTCODES */
function shortcode_game() {
   return "This is the game shortcode content";
}

add_shortcode('game', 'shortcode_game');
