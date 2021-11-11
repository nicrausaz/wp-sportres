<?php

class Query {

   private static $instance;
   private static $mgr;
   private static $table_name;

   private function __construct() {
      global $table_prefix, $wpdb;
      self::$mgr = $wpdb;
      self::$table_name = $table_prefix . GAMES_TABLE;
   }

   public static function run () : Query {
      if (is_null(self::$instance)) {
         self::$instance = new self();
      }
      return self::$instance;
   }

   public static function getAllGames() : array {
      $table = self::$table_name;
      return self::$mgr->get_results("SELECT * FROM $table");
   }

   public static function insertGame($data) {

      if (self::validateGame($data)) {
         self::$mgr->insert(self::$table_name, array(
            'team_1' => $data['new_team1'],
            'team_2' => $data['new_team2'],
            'score_team_1' => $data['new_score_team1'],
            'score_team_2' => $data['new_score_team2']
        ));
      }
      return null;
   }
   
   public static function getGameById($id) : object {
      if (empty($id)) return null;
      $table = self::$table_name;
      
      return self::$mgr->get_results("SELECT * FROM $table WHERE id = $id")[0];
   }

   private static function validateGame($data) : bool {
      // TODO: better validation
      return isset($data['new_team1']) && isset($data['new_team2']) && isset($data['new_score_team1']) && isset($data['new_score_team2']);
   }
}