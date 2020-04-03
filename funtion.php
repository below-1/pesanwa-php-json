<?php
	$kon = mysqli_connect("wa_db","wael","wael","wa_db");

	function query($query){
		global $kon;
		$result = mysqli_query($kon,$query);
		$rows = [];
		while ( $row = mysqli_fetch_assoc($result)) {
			$rows[] = $row;
		}
		return $rows;
	}

	function tambah($data){
		global $kon;
		$pesan= $data['pesan'];
		 $sql = mysqli_query($kon,"update siswa set id_pesan='$pesan' where id_siswa ");
		 if ($sql > 0) {
		 	$coba= mysqli_query($kon,"update siswa set id_pesan=replace(id_pesan,'zzz',nama) where id_siswa");
		 }
		 return mysqli_affected_rows($kon);
	}

	function upload(){
		$namaFile = $_FILES['gambar']['name'];
		$ukuranFile = $_FILES['gambar']['size'];
		$error = $_FILES['gambar']['error'];
		$tipe = $_FILES['gambar']['tmp_name'];

		//cek apa tidak ada gambar yang di upload 
		if (($error === 4)) {
			echo "<script>
					alert ('pilih gambar terlebih dahulu');
					</script>";
		return false;
		}
		//cek gambar atau bukan 
		$ekstensi = ['jpg','jpeg','png'];
		$eks = explode('.', $namaFile);
		$eks = strtolower(end($eks));
		if (!in_array($eks, $ekstensi)) {
			echo "<script>
					alert ('bukan gambar');
					</script>";
			return false;
		}

		//cek ukuran gambar 
		if ($ukuranFile >1000000) {
			echo "<script>
					alert ('ukuran terlalu besar');
					</script>";
		}
		//lolos cek generete nama baru 
	//	$namabaru = uniqid();
		//var_dump($namabaru);die;
	//	$namabaru .= '.';
	//	$namabaru .= $eks;
		move_uploaded_file($tipe, 'img/'.$namaFile);
		//var_dump($namabaru);die;
		return $namaFile;

	}

	function hapus($nim){
		global $kon;
		$sql =mysqli_query($kon,"DELETE FROM mahasiswa where nim=$nim");
		return mysqli_affected_rows($kon);
	}

	function ubah($data){
		global $kon;
		$nim = $data['nim'];
		$nama = $data['nama'];
		$jk = $data['jk'];
		$alamat = $data['alamat'];
		$sql =mysqli_query ($kon,"UPDATE mahasiswa SET nama='$nama',jk='$jk',alamat='$alamat' WHERE nim=$nim");
		 return mysqli_affected_rows($kon);
	}

	function cari ($keyword){
		$query = "SELECT * from siswa INNER JOIN pesan on siswa.id_pesan = pesan.id_pesan  WHERE 
			siswa.nama LIKE '%$keyword%' or 
			siswa.asalsekolah LIKE '%$keyword%' 
			";
	return query($query);
	}
?>