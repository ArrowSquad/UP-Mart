<?php

require_once '../koneksi.php';
require_once '../universal_function.php';

?>

	<!-- <form action="" method="post">
		<input type="text" name="id_pesan_saldo" placeholder="ID Pesan Saldo"><br>
		<input type="text" name="status" placeholder="status"><br>
		<input type="submit" name="update_order_balance_status" value="Tambahkan"><br>
	</form> -->

<?php

if (isset($_POST['update_order_balance_status'])) {
	$id_pesan_saldo = mysqli_real_escape_string ($koneksi, $_POST['id_pesan_saldo']);
	$status = mysqli_real_escape_string ($koneksi, $_POST['status']);
	if (isNumber($id_pesan_saldo) == "1" && isNumber($status) == "1" && universalLenghtChecks($status, 1) == "0") {
		$query = mysqli_query($koneksi, "update pesan_saldo set status_pesanan = '$status' where id_pesan_saldo = '$id_pesan_saldo'");
		if ($query) {
			echo "database : order_balance_status_updated";
		}
		else{
			echo "database : error_occured";
		}
	}
	else{
		echo "id_pesan_saldo : ".isNumber($id_pesan_saldo)."<br>";
		echo "status_sanity : ".isNumber($status)."<br>";
		echo "status_length : ".universalLenghtChecks($status, 1)."<br>";
	}
}
else{
	header('Location: ../../index.php');
}

?>