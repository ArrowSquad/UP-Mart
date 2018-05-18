<?php

require_once '../koneksi.php';
require_once '../universal_function.php';

if (isset($_POST['update_balance'])) {
	$arrayUser = explode(",", mysqli_real_escape_string($koneksi, $_POST['update_balance']));
	if (emailCheck($arrayUser[0]) == "1" && isNumber($arrayUser[1]) == "1") {
		$query = mysqli_query($koneksi, "update pengguna set jumlah_saldo = '$arrayUser[1]' where email = '$arrayUser[0]'");
		if ($query) {
			echo "database : balance_updated";
		}
		else{
			echo mysqli_error($koneksi);
			echo "database : balance_faile_to_update";
		}
	}
	else{
		echo "email_sanity : ".emailCheck($arrayUser[0])."<br>";
		echo "balance_sanity : ".isNumber($arrayUser[1])."<br>";
	}

}
else{
	header('Location: ../../index.php');
}

?>