<?php

require_once '../koneksi.php';
require_once '../universal_function.php';
error_reporting(0);

?>

	<!-- <form action="" method="post" enctype="multipart/form-data">
		<input type="file" name="banner" placeholder="Gambar Utama" accept="image/*"><br>
		<input type="text" name="kategori" placeholder="kategori banner"><br>
		<input type="submit" name="update_PoP" value="Tambahkan"><br>
	</form> -->

<?php

if (isset($_POST['update_PoP'])) {
	$mime = finfo_file(finfo_open(FILEINFO_MIME_TYPE), $_FILES['banner']['tmp_name']);
	$mime_explode = explode("/", $mime);
	$target_dir = "../../assets/banner/";
	$target_file = $target_dir.generateString().".".$mime_explode[1];
	$kategori = mysqli_real_escape_string ($koneksi, $_POST['kategori']);
	if (isFileUploded($_FILES['banner']['tmp_name']) == "1" && universalLenghtChecks($kategori, 1) == "0") {
	    if (move_uploaded_file($_FILES["banner"]["tmp_name"], $target_file)) {
	    	$image_valid = 1;
	    	if(mime_content_type($target_file) != "image/jpeg" && mime_content_type($target_file) != "image/jpg" && mime_content_type($target_file) != "image/png"){
	    		$image_valid = 0;
	    	}
	    	if ($image_valid == 1) {
		    	$query = mysqli_query($koneksi, "insert into banner values('', '$target_file', '$kategori')") or die(mysqli_error($koneksi));
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
		echo "kategori_lenght: ".universalLenghtChecks($kategori, 1)."<br>";
	}
}
else{
	header('Location: ../../index.php');
}

?>