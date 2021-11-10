<?php

if (!defined('ABSPATH')) exit;

register_activation_hook(dirname(__FILE__) . "/index.php", "activate_sportres");
register_deactivation_hook(dirname(__FILE__) . "/index.php", "deactivate_sportres");

// Create the games database table
function activate_sportres() {
   global $table_prefix, $wpdb;
   $table_name = $table_prefix . GAMES_TABLE;
   $charset_collate = $wpdb->get_charset_collate();

   $sql = "CREATE TABLE IF NOT EXISTS $table_name (
      id MEDIUMINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
      team_1 varchar(100) NOT NULL,
      score_team_1 varchar(10) NOT NULL,
      team_2 varchar(100) NOT NULL,
      score_team_2 varchar(10) NOT NULL
   ) $charset_collate;";

   require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

   dbDelta($sql);
}

function deactivate_sportres() { /* No effect */ }