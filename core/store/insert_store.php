<?php

require_once '../koneksi.php';
require_once '../universal_function.php';

if (isset($_POST['insert_store'])) {
	$arrayDataUser = explode(",", mysqli_real_escape_string($koneksi, $_POST['insert_store']));
	if (nameLengthCheck($arrayDataUser[0]) == "1" || nameSanityCheck($arrayDataUser[0]) == "1" || emailCheck($arrayDataUser[2]) == "1") {
		$query = mysqli_query($koneksi, "insert into toko values ('', '$arrayDataUser[0]', '', '$arrayDataUser[1]', 'aktif', '$arrayDataUser[2]')");
		if ($query) {
			echo "database : store_added";
		}
		else{
			echo mysqli_error($koneksi);;
			echo "database : primary_violated";
		}
	}
	else{
		echo "name_length : ".nameLengthCheck($arrayDataUser[0])."<br>";
		echo "name_sanity : ".nameSanityCheck($arrayDataUser[0])."<br>";
		echo "email_sanity : ".emailCheck($arrayDataUser[2])."<br>";

		return "0";
	}
}
else{
	header('Location: ../../index.php');
}

?>