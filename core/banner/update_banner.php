<?php

require_once '../koneksi.php';
require_once '../universal_function.php';
error_reporting(0);

?>

	<!-- <form action="" method="post" enctype="multipart/form-data">
		<input type="file" name="banner" placeholder="Gambar Utama" accept="image/*"><br>
		<input type="text" name="id_banner" placeholder="id banner"><br>
		<input type="text" name="kategori" placeholder="kategori banner"><br>
		<input type="submit" name="update_PoP" value="Tambahkan"><br>
	</form> -->

<?php

if (isset($_POST['update_PoP'])) {
	$mime = finfo_file(finfo_open(FILEINFO_MIME_TYPE), $_FILES['banner']['tmp_name']);
	$mime_explode = explode("/", $mime);
	$target_dir = "../../assets/banner/";
	$target_file = $target_dir.generateString().".".$mime_explode[1];
	$id_banner = mysqli_real_escape_string ($koneksi, $_POST['id_banner']);
	$kategori = mysqli_real_escape_string ($koneksi, $_POST['kategori']);
	if (isFileUploded($_FILES['banner']['tmp_name']) == "1" && isNumber($id_banner) == "1" && universalLenghtChecks($kategori, 1) == "0") {
	    if (move_uploaded_file($_FILES["banner"]["tmp_name"], $target_file)) {
	    	$image_valid = 1;
			$query = mysqli_query($koneksi, "SELECT url_banner FROM banner WHERE id_banner = '$id_banner'");
			$row = mysqli_fetch_array($query);
			if ($row['url_banner'] != "") {
			    chown($row['url_banner'], 666);
				if (unlink($row['url_banner'])) {
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
		    	$query = mysqli_query($koneksi, "update banner set url_banner = '$target_file', kategori = '$kategori' where id_banner = '$id_banner'") or die(mysqli_error($koneksi));
		    	if ($query) {
					echo "database : banner_addedd";
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
	else{
		echo "file_uploaded : ".isFileUploded($_FILES['banner']['tmp_name'])."<br>";
		echo "id_sanity : ".isNumber($id_banner)."<br>";
		echo "kategori_lenght: ".universalLenghtChecks($kategori, 1)."<br>";
	}
}
else{
	header('Location: ../../index.php');
}

?>