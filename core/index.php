<?php
$is_localhost = $_SERVER['HTTP_HOST'] === "localhost";

$hostname = $is_localhost ? "localhost" : "mysql";
$username = $is_localhost ? "root" : "u825110536_stagon";
$password = $is_localhost ? "" : ">26QPMeytC0s";
$database =  $is_localhost ? "stagon_redirections" : "u825110536_stagon";

$conn = new mysqli($hostname, $username, $password);

if ($conn->query("CREATE DATABASE $database;") === TRUE) {
  $conn->select_db($database);
  $conn->query(
    "CREATE TABLE IF NOT EXISTS `links` (
      `id` BIGINT(20) NOT NULL AUTO_INCREMENT,
      `link_id` VARCHAR(10) NOT NULL,
      `created_at` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
      `updated_at` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
      `original_link` VARCHAR(255) NOT NULL DEFAULT '',
      `description` VARCHAR(255) NOT NULL DEFAULT '',
      primary key(`id`)
      );"
  );

  $conn->query(
    "CREATE TABLE IF NOT EXISTS `clicks` (
      `id` BIGINT(20) NOT NULL AUTO_INCREMENT,
      `date` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
      `link_id` BIGINT(20) NOT NULL,
      primary key(`id`),
      foreign key(`link_id`) REFERENCES `links`(`id`) ON UPDATE CASCADE ON DELETE CASCADE
      );"
  );
} else {
  $conn->select_db($database);
}
