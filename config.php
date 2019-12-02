<?php
session_start();

/**
 * Configuration for database connection
 *
 */

$host       = "localhost";
$username   = "root";
$password   = "ssEHF3xYZ81SxNL2";
$dbname     = "pokestopdb";
$dsn        = "mysql:host=$host;dbname=$dbname";
$options    = array(
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
);
