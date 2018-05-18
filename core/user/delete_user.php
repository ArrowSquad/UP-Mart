<?php

require_once '../koneksi.php';

if (isset($_POST['delete_user'])) {
	$query = mysqli_query($koneksi, "SELECT profil_url FROM pengguna WHERE email = '".mysqli_real_escape_string($koneksi, $_POST['delete_user'])."'");
	$row = mysqli_fetch_array($query);
	$query = mysqli_query($koneksi, "DELETE FROM pengguna WHERE email = '".mysqli_real_escape_string($koneksi, $_POST['delete_user'])."'");
	if ($query) {
	    echo "database : user_deleted<br>";
	    if ($row['profil_url'] != "") {
		    chown($row['profil_url'], 666);
			if (unlink($row['profil_url'])) {
		    	echo "database : image_deleted";
			} 
			else {
		    	echo "database : error_deleting_image";
			}
	    }
	}
	else{
	    echo "database : error_deleting_user";
	}
}
else{
	header('Location: ../../index.php');
}

?>