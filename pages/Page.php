<?php

abstract class Page {
   protected string $fullname;
   protected string $slug;

   public function __construct(string $fullname, string $slug) {
      $this->slug = $slug;
      $this->fullname = $fullname;
   }

   abstract public function register() : void;
   abstract public function settings(array $fields): void;
   abstract public function markup(): void;

   protected function addMenuPage(): void {
      add_menu_page(
         $this->fullname,
         $this->fullname,                         
         'manage_options',
         PREFIX . $this->slug,                        
         function () { $this->markup(); },             
         SETTINGS_ICON,                    
         SETTINGS_POSITION
      );
   }

   protected function addSubMenuPage(string $parent): void {
      add_submenu_page(
         $parent,
         $this->fullname,
         $this->fullname,                        
         'manage_options',
         PREFIX . $this->slug,
         function () {
            $this->markup();
         }
      );
   }

   protected function addSetting(): void {
      register_setting(
         $this->slug . SETTINGS_POSTFIX,
         $this->slug . SETTINGS_POSTFIX,
         "" // callback
      );
   }

   protected function addSettingSection(string $title): void {
      add_settings_section(
         $this->slug . SECTION_POSTFIX,
         $title,
         "", // Callback or empty string
         $this->fullname
      );
   }

   protected function addSettingField(string $id, string $label, $callback): void {
      add_settings_field(
         $id,           
         $label,
         $callback,            // Callback to display the field
         $this->fullname,                // Page
         $this->slug . SECTION_POSTFIX,                      // Section
      );
   }

}