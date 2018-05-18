<?php

require_once '../koneksi.php';
require_once '../universal_function.php';

if (isset($_POST['insert_notification'])) {
	$arrayReview = explode(",", mysqli_real_escape_string($koneksi, $_POST['insert_notification']));
	if (universalLenghtChecks($arrayReview[0], 1) == "1" && emailCheck($arrayReview[1]) == "1") {
		$query = mysqli_query($koneksi, "insert into pemberitahuan values('', '$arrayReview[0]', 0, '".getTodayDate()."' ,'".getTodayTime()."', '$arrayReview[1]')");
		if ($query) {
			echo "database : notification_added";
		}
		else{
			echo mysqli_error($koneksi);
			echo "database : notification_failed_to_db";
		}
	}
	else{
		echo "text_length : ".universalLenghtChecks($arrayReview[0], 1)."<br>";
		echo "email_sanity : ".emailCheck($arrayReview[1])."<br>";
	}

}
else{
	header('Location: ../../index.php');
}

?>