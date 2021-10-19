<?php
/*
  Plugin Name: Sport Results
  Description: Manage & display your sport team's results
  Author: Nicolas Crausaz
  Version: 1.0.0
 */

/* SHORTCODES */
function shortcode_game()
{
   return "This is the game shortcode";
}

add_shortcode('game', 'shortcode_game');


/* Settings pages */
// Menu
function settings_menu()
{
   // Main page
   $hookname = add_menu_page(
      __('Sport Results', 'sportres'),         // Page title
      'Global',                                // Menu title
      'manage_options',                        // Capabilities
      'sportres_settings_page',                // Slug
      'main_settings_page_markup',         // Display callback
      'dashicons-schedule',                    // Icon
      66                                       // Priority/position. Just after 'Plugins'
   );

   // // Teams
   // add_submenu_page(
   //    'sportres_settings_page',
   //    'Teams',
   //    'Teams',
   //    'manage_options',
   //    'teams',
   //    'main_settings_page_markup'
   // );

   // Games
   add_submenu_page(
      'sportres_settings_page',
      'Games',
      'Games',
      'manage_options',
      'games',
      'games_settings_page_markup'
   );

}
add_action('admin_menu', 'settings_menu');


// Main page
add_action('admin_init', 'main_page_setting');

// Create settings section
function main_page_setting()
{
   register_setting(
      'main_page_setting',     // Settings group.
      'main_page_setting',     // Setting name
      'sanitize_text_field'  // Sanitize callback.
   );

   add_settings_section(
      'main_section',                   // Section ID
      __('Global configuration', 'main'),    // Title
      'section_markup',            // Callback or empty string
      'main_settings_page'              // Page to display the section in.
   );

   add_settings_field(
      'max_paginate',                   // Field ID
      __('Paginate number of games', 'nbgames'),  // Title
      'maxpaginate_input_markup',            // Callback to display the field
      'main_settings_page',                // Page
      'main_section',                      // Section
   );
}


/**
 * Markup callback for the settings page
 */
function main_settings_page_markup()
{
?>
   <div class="wrap">
      <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
      <form action="options.php" method="POST">
         <?php
         settings_fields('main_page_setting');
         do_settings_sections('main_settings_page');
         submit_button();
         ?>
      </form>
   </div>
<?php
}

function section_markup($args)
{
}


function maxpaginate_input_markup($args)
{
   $setting = get_option('main_page_setting');
   $value   = $setting ?: '';
?>
   <input class="regular-text" type="text" name="main_page_setting" value="<?php echo esc_attr($value); ?>">
<?php
}


// Games page
add_action('admin_init', 'games_page_setting');

function games_page_setting () {
   register_setting(
      'games_page_setting',     // Settings group.
      'games_page_setting',     // Setting name
      'sanitize_text_field'  // Sanitize callback.
   );

   add_settings_section(
      'games_section',                   // Section ID
      __('Games edit', 'games'),    // Title
      'section_markup',            // Callback or empty string
      'games_settings_page'              // Page to display the section in.
   );

   add_settings_field(
      'test',                   // Field ID
      __('test', 'nbgames'),  // Title
      'maxpaginate_input_markup',            // Callback to display the field
      'games_settings_page',                // Page
      'games_section',                      // Section
   );
}

function games_settings_page_markup()
{
?>
   <div class="wrap">
      <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
      <form action="options.php" method="POST">
         <?php
         settings_fields('games_settings_page');
         do_settings_sections('games_settings_page');
         submit_button();
         ?>
      </form>
   </div>
<?php
}