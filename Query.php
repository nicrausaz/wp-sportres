<?php

class Query {
   static function getAllGames() {
      global $table_prefix, $wpdb;
      $table_name = $table_prefix . GAMES_TABLE;

      return $wpdb->get_results("SELECT * FROM $table_name");
   }

   static function insertGame($data) {
      global $table_prefix, $wpdb;
      $table_name = $table_prefix . GAMES_TABLE;

      if (Query::validateGame($data)) {
         $wpdb->insert($table_name, array(
            'team_1' => $data['new_team1'],
            'team_2' => $data['new_team2'],
            'score_team_1' => $data['new_score_team1'],
            'score_team_2' => $data['new_score_team2']
        ));
      }
      return null;
   }

   private static function validateGame($data) {
      // TODO: better validation
      return isset($data['new_team1']) && isset($data['new_team2']) && isset($data['new_score_team1']) && isset($data['new_score_team2']);
   }

}