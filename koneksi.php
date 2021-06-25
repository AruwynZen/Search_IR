<?php 
    $host = "localhost";
	$user = "root";
	$pass = "";
	$db = "dbstbi-data";
	$koneksi = mysqli_connect($host,$user,$pass,$db);
    $konek = mysqli_connect($host,$user,$pass) or die (mysql_error());
    $conn = mysqli_select_db($konek, $db) or die (mysql_error());

	if(!$koneksi) {
		die("Koneksi dengan database gagal: ".mysql_connect_error());
	}
 ?>
