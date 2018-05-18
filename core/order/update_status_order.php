<?php

require_once '../koneksi.php';
require_once '../universal_function.php';

if (isset($_POST['update_status_order'])) {
	$arrayOrder = explode(",", mysqli_real_escape_string($koneksi, $_POST['update_status_order']));
	if (isNumber($arrayOrder[0]) == "1") {
		$query = mysqli_query($koneksi, "update pesanan set status = '$arrayOrder[1]' where id_pesanan = '$arrayOrder[0]'");
		if ($query) {
			echo "database : order_updated";
		}
		else{
			echo mysqli_error($koneksi);
			echo "database : order_failed_to_update";
		}
	}
	else{
		echo "order_id_sanity : ".isNumber($arrayOrder[0])."<br>";
	}

}
else{
	header('Location: ../../index.php');
}

?>