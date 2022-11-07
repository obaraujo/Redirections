<?php
$information_complete = array_key_exists('original_link', $_POST) && array_key_exists('description', $_POST);

if ($information_complete) {
  include("../core/index.php");

  $chars = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "U", "V", "W", "X", "Y", "Z", "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "u", "v", "w", "x", "y", "z", "0", "1", "2", "3", "4", "5", "6", "7", "8", "9"];

  $last_id_used = $conn->query("SELECT `link_id` FROM `links`  ORDER BY `links`.`id` DESC")->fetch_row();

  $link_id = [];
  $date =  date('Y-m-d H:i:s', time());
  $original_link = filter_var($_POST['original_link'], FILTER_SANITIZE_URL);
  $description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);

  if ($last_id_used) {
    $chars_link = str_split($last_id_used[0]);
    $length_chars = count($chars);
    for ($i = 0; $i < count($chars_link); $i++) {
      $char = $chars_link[$i];
      if ($char === $chars[$length_chars - 1]) {
        $link_id[$i] = $chars[0];
        if ($i === count($chars_link) - 1) {
          $link_id[$i + 1] = $chars[0];
        }
      } else {
        $posisiton_char = array_search($char, $chars);
        if ($posisiton_char + 1 < $length_chars) {
          $link_id[$i] = $chars[$posisiton_char + 1];
          for ($ind = $i + 1; $ind < count($chars_link); $ind++) {
            $link_id[$ind] = $chars_link[$ind];
          }
          break;
        } else {
          $link_id[$i + 1] = $chars[0];
        }
      }
    }

    $link_id = implode("", $link_id);
  } else {
    $link_id = $chars[0] . $chars[0] . $chars[0] . $chars[0];
  }

  $sql = "INSERT INTO `links` (`link_id`, `created_at`, `original_link`, `description`) VALUES ('$link_id', NOW(), '$original_link', '$description'); ";
  $result = $conn->query($sql);

  if ($result) {
    echo json_encode(['msg' => "Sucesso!", 'data' => ['link_id' => $link_id]]);
  }

  die();
}

header('HTTP/1.1 500 Internal Server Booboo');
header('Content-Type: application/json; charset=UTF-8');
die(json_encode(array('message' => 'Não foi possível salvar o link')));
