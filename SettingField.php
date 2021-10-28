<?php

class SettingField {
   private string $id;
   private string $title;
   private $callback;

   public function __construct(string $id, string $title, $callback) {
      $this->id = $id;
      $this->title = $title;
      $this->callback = $callback;
   }

   function id (): string {
      return $this->id;
   }

   function title (): string {
      return $this->title;
   }

   function callback () {
      return $this->callback;
   }
}