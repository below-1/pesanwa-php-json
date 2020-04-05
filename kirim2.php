<?php
// Load file koneksi.php
include "koneksi.php";

$data = json_decode(file_get_contents("php://input"), true);
foreach ($data as $key => $value) {

  $nohp = $value['nohp'];
  $id_pesan = $value['id_pesan'];

  $ch = curl_init("https://api.whatsapp.com/send?phone=$nohp");

  // $ch = curl_init("https://hacker-news.firebaseio.com/v0/item/121003.json?print=pretty");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HEADER, 0);

  $result = curl_exec($ch);
  $info = curl_getinfo($ch);

  curl_close($ch);

  header('Content-Type: application/json');
  echo json_encode($result);
}
?>
