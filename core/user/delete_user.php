<?php

require_once '../koneksi.php';
require_once '../universal_function.php';

if (isset($_GET['delete_user'])) {
	$query = mysqli_query($koneksi, "DELETE FROM pengguna WHERE email = '".mysqli_real_escape_string($koneksi, $_GET['delete_user'])."'");
	if ($query) {
	    echo "database : user_deleted";
	}
	else{
	    echo "database : error_deleting_user";
	}
}
else{
	header('Location: ../../index.php');
}

?>