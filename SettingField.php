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

   public function id (): string {
      return $this->id;
   }

   public function title (): string {
      return $this->title;
   }

   public function callback () {
      return $this->callback;
   }
}