<?php
// Load file koneksi.php
include "koneksi.php";

var_dump($_POST);

$nama = $_POST['nama'];
$id_siswa = $_POST['id_siswa'];
$nohop = $_POST['nohp'];
$id_pesan = $_POST['id_pesan']; 
// $tam= implode(",", $nama);
 
for ($i=0; $i < sizeof($id_siswa) ; $i++) {
	echo "hello";
	//header("location:https://api.whatsapp.com/send?phone=$nohop&text=$id_pesan");
}

?>
