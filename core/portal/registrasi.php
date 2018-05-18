<?php

require_once '../koneksi.php';
require_once '../universal_function.php';

if (isset($_POST['registrasi'])) {
	$arrayDataUser = explode(",", $_POST['registrasi']);
	$pass0 = md5(sha1($arrayDataUser[3]));
	$pass1 = md5(sha1($arrayDataUser[4]));
	if (emailCheck($arrayDataUser[0]) == "1" && nameLengthCheck($arrayDataUser[1]) == "1" && phoneLengthCheck($arrayDataUser[2]) == "1" && phoneSanityCheck($arrayDataUser[2]) == "1" && passwordCheck($arrayDataUser[3], $arrayDataUser[4]) == "1") {
		$query = mysqli_query($koneksi, "insert into pengguna values ('$arrayDataUser[0]', '$arrayDataUser[1]', '$arrayDataUser[2]' ,'$pass0' ,'')");
		if ($query) {
			echo "database : pengguna_added";
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
		echo "phone_sanity : ".phoneSanityCheck($arrayDataUser[2])."<br>";
		echo "password : ".passwordCheck($pass0, $pass1)."<br>";

		return "0";
	}
}
else{
	header('Location: ../../index.php');
}

?>