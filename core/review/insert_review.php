<?php

require_once '../koneksi.php';
require_once '../universal_function.php';

if (isset($_GET['insert_review'])) {
	$arrayReview = explode(",", mysqli_real_escape_string($koneksi, $_GET['insert_review']));
	if (universalLenghtChecks($arrayReview[0], 1) == "0" && universalLenghtChecks($arrayReview[1], 1) == "1" && emailCheck($arrayReview[2]) == "1" && isNumber($arrayReview[3]) == "1") {
		$query = mysqli_query($koneksi, "insert into ulasan values('', '$arrayReview[0]', '$arrayReview[1]', '".getTodayDate()."' ,'".getTodayTime()."' , '0', '$arrayReview[2]', '$arrayReview[3]')");
		if ($query) {
			echo "database : review_added";
		}
		else{
			echo mysqli_error($koneksi);
			echo "database : review_failed_to_db";
		}
	}
	else{
		echo "stars_length : ".universalLenghtChecks($arrayReview[0], 1)."<br>";
		echo "stars_sanity : ".isNumber($arrayReview[0])."<br>";
		echo "review_length : ".universalLenghtChecks($arrayReview[1], 1)."<br>";
		echo "email_sanity : ".emailCheck($arrayReview[2])."<br>";
		echo "id_sanity : ".isNumber($arrayReview[3])."<br>";
	}

}
else{
	// header('Location: ../../index.php');
}

?>