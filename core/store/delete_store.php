<?php

require_once '../koneksi.php';

if (isset($_POST['delete_store'])) {
	$query = mysqli_query($koneksi, "SELECT profil_url FROM toko WHERE id_toko = '".mysqli_real_escape_string($koneksi, $_POST['delete_store'])."'");
	$row = mysqli_fetch_array($query);
	$query = mysqli_query($koneksi, "DELETE FROM toko WHERE id_toko = '".mysqli_real_escape_string($koneksi, $_POST['delete_store'])."'");
	if ($query) {
	    echo "database : store_deleted<br>";
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
	    echo "database : error_deleting_store";
	}
}
else{
	header('Location: ../../index.php');
}

?>