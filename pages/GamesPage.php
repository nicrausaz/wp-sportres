<?php

class GamesPage extends Page
{
   public function register(): void
   {
      add_submenu_page(
         "sportres_settings_page",
         $this->fullname,
         $this->fullname,                        
         'manage_options',
         PREFIX . $this->slug,
         function () {
            $this->markup();
         }
      );
   }

   public function settings(): void {
      register_setting(
         $this->slug . SETTINGS_POSTFIX,
         $this->slug . SETTINGS_POSTFIX,
         "" // callback
      );
   
      add_settings_section(
         $this->slug . SECTION_POSTFIX,
         "Configure",
         "", // Callback or empty string
         $this->fullname
      );
   
      add_settings_field(
         'test',                   // Field ID
         __('test', 'nbgames'),  // Title
         'maxpaginate_input_markup',            // Callback to display the field
         $this->fullname,                // Page
         $this->slug . SECTION_POSTFIX,                      // Section
      );
   }

   public function markup(): void
   {
   ?>
      <div class="wrap">
         <h1><?= esc_html(get_admin_page_title()); ?></h1>
         <form action="options.php" method="POST">
            <?php
            settings_fields('games_settings_page');
            do_settings_sections($this->fullname);
            submit_button();
            ?>
         </form>
      </div>
   <?php
   }
}
