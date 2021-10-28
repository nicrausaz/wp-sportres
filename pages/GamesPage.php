<?php

class GamesPage extends Page
{
   public function register(): void
   {
      parent::addSubMenuPage("sportres_settings_page");
   }

   public function settings(array $fields): void {
      parent::addSetting();
      parent::addSettingSection("Configure");
   
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
         <form action="" method="POST">
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
