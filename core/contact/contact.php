<?php

require_once '../koneksi.php';
require_once '../universal_function.php';

if (isset($_POST['contact'])) {
	$arrayContact = explode(",", mysqli_real_escape_string($koneksi, $_POST['contact']));
	if (phoneLengthCheck($arrayContact[0]) == "1" && isNumber($arrayContact[0]) == "1" && emailCheck($arrayContact[1]) == "1" && isNumber($arrayContact[2]) == "1" && universalLenghtChecks($arrayContact[3], 4) == "1" && universalLenghtChecks($arrayContact[4], 4) == "1" && universalLenghtChecks($arrayContact[5], 4) == "1") {
		$query = mysqli_query($koneksi, "select id from kontak");
		if (mysqli_num_rows($query) == 0) {
			$query = mysqli_query($koneksi, "insert into kontak values('', '$arrayContact[0]', '$arrayContact[1]', '$arrayContact[2]', '$arrayContact[3]', '$arrayContact[4]', '$arrayContact[5]')");
		}
		else{
			$query = mysqli_query($koneksi, "update kontak set hp = '$arrayContact[0]', email = '$arrayContact[1]', fax = '$arrayContact[2]', fb = '$arrayContact[3]', google = '$arrayContact[4]', twitter = '$arrayContact[5]'");
		}
		if ($query) {
			echo "database : contact_added";
		}
		else{
			echo mysqli_error($koneksi);
			echo "database : contact_failed_to_db";
		}
	}
	else{
		echo "phone_lenght : ".phoneLengthCheck($arrayContact[0])."<br>";
		echo "phone_sanity : ".isNumber($arrayContact[0])."<br>";
		echo "email_sanity : ".emailCheck($arrayContact[1])."<br>";
		echo "fax_sanity : ".isNumber($arrayContact[2])."<br>";
		echo "fb_sanity : ".universalLenghtChecks($arrayContact[3], 4)."<br>";
		echo "google_sanity : ".universalLenghtChecks($arrayContact[4], 4)."<br>";
		echo "twitter_sanity : ".universalLenghtChecks($arrayContact[5], 4)."<br>";
	}

}
else{
	// header('Location: ../../index.php');
}

?>