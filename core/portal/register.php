<?php

require_once '../koneksi.php';
require_once '../universal_function.php';

if (isset($_POST['register'])) {
	$arrayDataUser = explode(",", mysqli_real_escape_string($koneksi, $_POST['register']));
	$pass0 = md5(sha1($arrayDataUser[3]));
	$pass1 = md5(sha1($arrayDataUser[4]));
	if (emailCheck($arrayDataUser[0]) == "1" && nameLengthCheck($arrayDataUser[1]) == "1" && phoneLengthCheck($arrayDataUser[2]) == "1" && isNumber($arrayDataUser[2]) == "1" && passwordCheck($arrayDataUser[3], $arrayDataUser[4]) == "1") {
		$query = mysqli_query($koneksi, "insert into pengguna values ('".strtolower($arrayDataUser[0])."', '', '$arrayDataUser[1]', '$arrayDataUser[2]', '$pass0', '', 0, 0)");
		if ($query) {
			echo "database : user_added";
		}
		else{
			echo "database : primary_violated";
		}
	}
	else{
		echo "email : ".emailCheck($arrayDataUser[0])."<br>";
		echo "name_length : ".nameLengthCheck($arrayDataUser[1])."<br>";
		echo "name_sanity : ".nameSanityCheck($arrayDataUser[1])."<br>";
		echo "phone_length : ".phoneLengthCheck($arrayDataUser[2])."<br>";
		echo "phone_sanity : ".isNumber($arrayDataUser[2])."<br>";
		echo "password : ".passwordCheck($pass0, $pass1)."<br>";
	}
}
else{
	header('Location: ../../index.php');
}

?>