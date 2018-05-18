<?php

require_once '../koneksi.php';
require_once '../universal_function.php';

if (isset($_POST['insert_order_balance'])) {
	$arrayDataUser = explode(",", mysqli_real_escape_string($koneksi, $_POST['insert_order_balance']));
	if (isNumber($arrayDataUser[0]) == "1" && isNumber($arrayDataUser[1]) == "1" && universalLenghtChecks($arrayDataUser[2], 1) == "1" && isNumber($arrayDataUser[2]) == "1" && emailCheck($arrayDataUser[3]) == "1") {
		$query = mysqli_query($koneksi, "insert into pesan_saldo values ('', '$arrayDataUser[0]', '$arrayDataUser[1]', '','$arrayDataUser[2]', '$arrayDataUser[3]')");
		if ($query) {
			echo "database : balance_order_added";
		}
		else{
			echo "database : primary_violated";
		}
	}
	else{
		echo "ordered_balance_sanity : ".isNumber($arrayDataUser[0])."<br>";
		echo "price_sanity : ".isNumber($arrayDataUser[1])."<br>";
		echo "status_length : ".universalLenghtChecks($arrayDataUser[2], 1)."<br>";
		echo "status_sanity : ".isNumber($arrayDataUser[2])."<br>";
		echo "email_sanity : ".emailCheck($arrayDataUser[3])."<br>";
	}
}
else{
	header('Location: ../../index.php');
}

?>