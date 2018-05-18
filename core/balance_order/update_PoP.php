<?php

require_once '../koneksi.php';
require_once '../universal_function.php';

?>

	<!-- <form action="" method="post" enctype="multipart/form-data">
		<input type="file" name="PoP" placeholder="Gambar Utama" accept="image/*"><br>
		<input type="text" name="id_pesan_saldo" placeholder="ID Pesan Saldo"><br>
		<input type="submit" name="update_PoP" value="Tambahkan"><br>
	</form> -->

<?php

if (isset($_POST['update_PoP'])) {
	$mime = finfo_file(finfo_open(FILEINFO_MIME_TYPE), $_FILES['PoP']['tmp_name']);
	$mime_explode = explode("/", $mime);
	$target_dir = "../../assets/PoP/";
	$target_file = $target_dir.generateString().".".$mime_explode[1];
	$id_pesan_saldo = mysqli_real_escape_string ($koneksi, $_POST['id_pesan_saldo']);
	if (isFileUploded($_FILES['PoP']['tmp_name']) == "1") {
	    if (move_uploaded_file($_FILES["PoP"]["tmp_name"], $target_file)) {
	    	$image_valid = 1;
			$query = mysqli_query($koneksi, "SELECT url_bukti_pembayaran FROM pesan_saldo WHERE id_pesan_saldo = '$id_pesan_saldo'");
			$row = mysqli_fetch_array($query);
			if ($row['url_bukti_pembayaran'] != "") {
			    chown($row['url_bukti_pembayaran'], 666);
				if (unlink($row['url_bukti_pembayaran'])) {
			    	echo "database : old_image_deleted";
				} 
				else {
			    	echo "database : error_deleting_old_image";
				}
				echo "<br>";
	    	}
	    	if(mime_content_type($target_file) != "image/jpeg" && mime_content_type($target_file) != "image/jpg" && mime_content_type($target_file) != "image/png"){
	    		$image_valid = 0;
	    	}
	    	if ($image_valid == 1) {
		    	$query = mysqli_query($koneksi, "update pesan_saldo set url_bukti_pembayaran = '$target_file' where id_pesan_saldo = '$id_pesan_saldo'") or die(mysqli_error($koneksi));
		    	if ($query) {
					echo "database : PoP_updated";
		    	}
	    	}
	    	else{
	    		unlink($target_file);
				echo "database : file_not_image";
	    	}
	    } 
	    else {
			echo "database : error_upload_file";
	    }
	}
}
else{
	header('Location: ../../index.php');
}

?>