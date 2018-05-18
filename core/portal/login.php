<?php

session_start();
require_once '../koneksi.php';
require_once '../universal_function.php';

if (isset($_POST['login'])) {
	$arrayLogin = explode(",", $_POST['login']);
	$pass0 = md5(sha1($arrayLogin[1]));

	$result = mysqli_query($koneksi, "SELECT * FROM pengguna WHERE email = '$arrayLogin[0]'");

	if (mysqli_num_rows($result) > 0) {
		$row = mysqli_fetch_array($result);
		if ($row['password'] == $pass0) {
			$_SESSION["user"] = $row;
		}
		else{
	    	echo "database : wrong_password";
		}
	} else {
	    echo "database : no_user";
	}

}
else{
	header('Location: ../../index.php');
}
?>