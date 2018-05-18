<?php

require_once '../koneksi.php';

if (isset($_POST['delete_product'])) {
	$query = mysqli_query($koneksi, "SELECT url_gambar FROM barang WHERE id_barang = '".mysqli_real_escape_string($koneksi, $_POST['delete_product'])."'");
	$row = mysqli_fetch_array($query);
	$query = mysqli_query($koneksi, "DELETE FROM barang WHERE id_barang = '".mysqli_real_escape_string($koneksi, $_POST['delete_product'])."'");
	if ($query) {
	    echo "database : product_deleted<br>";
	    if ($row['url_gambar'] != "") {
		    chown($row['url_gambar'], 666);
			if (unlink($row['url_gambar'])) {
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
	header('Location: ../../index.php');
}

?>