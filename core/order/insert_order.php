<?php

require_once '../koneksi.php';
require_once '../universal_function.php';

if (isset($_POST['insert_order'])) {
	$arrayOrder = explode(",", mysqli_real_escape_string($koneksi, $_POST['insert_order']));
	if (emailCheck($arrayOrder[3]) == "1" && isNumber($arrayOrder[4]) == "1") {
		$query = mysqli_query($koneksi, "insert into pesanan values('', '".getTodayDate()."' ,'".getTodayTime()."' , '0', '$arrayOrder[0]', '$arrayOrder[1]', '$arrayOrder[2]', '$arrayOrder[3]', '$arrayOrder[4]')");
		if ($query) {
			echo "database : order_added";
		}
		else{
			echo mysqli_error($koneksi);
			echo "database : order_failed_to_db";
		}
	}
	else{
		echo "buyer_sanity : ".emailCheck($arrayOrder[3])."<br>";
		echo "product_sanity : ".isNumber($arrayOrder[4])."<br>";
	}

}
else{
	header('Location: ../../index.php');
}

?>