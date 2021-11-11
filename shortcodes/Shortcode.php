<?php

class ShortCode {
   private string $name;

   function __construct(string $name, $callback) {
      $this->name = $name;
      add_shortcode($this->name, $callback);
   }
}