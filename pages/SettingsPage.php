<?php

class SettingsPage extends Page {
   public function register() : void {
      parent::addMenuPage();
   }

   public function settings(array $fields): void {
      parent::addSetting();
      parent::addSettingSection("Configure");

      foreach ($fields as $f) {
         parent::addSettingField($f->id(), $f->title(), $f->callback());
      }
   }

   public function markup(): void {
   ?>
      <div class="wrap">
         <h1><?= esc_html(get_admin_page_title()); ?></h1>
         <form action="" method="POST">
            <?php
            settings_fields('max_paginate'); // Loop on every field
            do_settings_sections($this->fullname);
            submit_button();
            ?>
         </form>
      </div>   
   <?php
   }
}