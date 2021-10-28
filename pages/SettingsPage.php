<?php

class SettingsPage extends Page {
   public function register() : void {
      add_menu_page(
         $this->fullname,
         $this->fullname,                         // Menu title
         'manage_options',
         PREFIX . $this->slug,                        // Capabilities
         function () { $this->markup(); },             // Display callback
         SETTINGS_ICON,                    // Icon
         SETTINGS_POSITION
      );
   }

   public function settings(): void {
      // Register setting group
      register_setting(
         $this->slug . SETTINGS_POSTFIX,
         $this->slug . SETTINGS_POSTFIX,
         "" // callback
      );

      // Register section
      add_settings_section(
         $this->slug . SECTION_POSTFIX,
         "Configure",
         "", // Callback or empty string
         $this->fullname
      );

      // Register fields 
      add_settings_field(
         'max_paginate',                   // Field ID
         __('Paginate number of games', 'nbgames'),  // Title
         'maxpaginate_input_markup',            // Callback to display the field
         $this->fullname,                // Page
         $this->slug . SECTION_POSTFIX,                      // Section
      );
   }

   public function markup(): void {
   ?>
      <div class="wrap">
         <h1><?= esc_html(get_admin_page_title()); ?></h1>
         <form action="options.php" method="POST">
            <?php
            settings_fields('main_page_setting');
            do_settings_sections($this->fullname);
            submit_button();
            ?>
         </form>
      </div>   
   <?php
   }
}