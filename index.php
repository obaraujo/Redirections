<?php
include("./core/index.php");

$data = $conn->query("SELECT `original_link`, `id` FROM `links` WHERE `link_id` LIKE '" . $_REQUEST['id'] . "'")->fetch_row();

if ($data) {
  $sql = "INSERT INTO `clicks` (`id`, `date`, `link_id`) VALUES (NULL, NOW(), '" . $data[1] . "'); ";
  $result = $conn->query($sql);

  header("Location: " . $data[0], true, $status);
  die();
} else {
  header("Location: https://stagon.in", true, $status);
  die();
}
