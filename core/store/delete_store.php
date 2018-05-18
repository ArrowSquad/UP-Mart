<?php

require_once '../koneksi.php';
require_once '../universal_function.php';

if (isset($_POST['delete_store'])) {
	$query = mysqli_query($koneksi, "DELETE FROM toko WHERE id_toko = '".mysqli_real_escape_string($koneksi, $_POST['delete_store'])."'");
	if ($query) {
	    echo "database : store_deleted";
	}
	else{
	    echo "database : error_deleting_store";
	}
}
else{
	header('Location: ../../index.php');
}

?>