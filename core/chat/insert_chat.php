<?php

require_once '../koneksi.php';
require_once '../universal_function.php';

if (isset($_POST['insert_chat'])) {
	$arrayChat = explode(",", mysqli_real_escape_string($koneksi, $_POST['insert_chat']));
	if (universalLenghtChecks($arrayChat[0], 0) == "1" && emailCheck($arrayChat[1]) == "1" && emailCheck($arrayChat[2]) == "1") {
		$query = mysqli_query($koneksi, "insert into percakapan values('', '$arrayChat[0]', '".getTodayDate()."' ,'".getTodayTime()."' ,'$arrayChat[1]' ,'$arrayChat[2]')");
		if ($query) {
			echo "database : chat_added";
		}
		else{
			echo mysqli_error($koneksi);
			echo "database : chat_failed_to_db";
		}
	}
	else{
		echo "chat_length : ".universalLenghtChecks($arrayChat[0], 0)."<br>";
		echo "sender_sanity : ".emailCheck($arrayChat[1])."<br>";
		echo "receiver_sanity : ".emailCheck($arrayChat[2])."<br>";
	}

}
else{
	// header('Location: ../../index.php');
}

?>