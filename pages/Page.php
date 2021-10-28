<?php

abstract class Page {
   protected string $fullname;
   protected string $slug;
   protected $sections;

   public function __construct(string $fullname, string $slug) {
      $this->slug = $slug;
      $this->fullname = $fullname;
   }

   abstract public function register() : void;
   abstract public function settings(): void;
   abstract public function markup(): void;

   protected function addMenuPage(): void {
      
   }

}