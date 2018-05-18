<?php

require_once '../koneksi.php';

if (isset($_GET['delete_banner'])) {
	$query = mysqli_query($koneksi, "SELECT url_banner FROM banner WHERE id_banner = '".mysqli_real_escape_string($koneksi, $_GET['delete_banner'])."'");
	$row = mysqli_fetch_array($query);
	$query = mysqli_query($koneksi, "DELETE FROM banner WHERE id_banner = '".mysqli_real_escape_string($koneksi, $_GET['delete_banner'])."'");
	if ($query) {
	    echo "database : banner_deleted<br>";
	    if ($row['url_banner'] != "") {
		    chown($row['url_banner'], 666);
			if (unlink($row['url_banner'])) {
		    	echo "database : image_deleted";
			} 
			else {
		    	echo "database : error_deleting_image";
			}
	    }
	}
	else{
	    echo "database : error_deleting_product";
	}
}
else{
	// header('Location: ../../index.php');
}

?>