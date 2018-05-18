<?php

require_once '../koneksi.php';
require_once '../universal_function.php';
error_reporting(0);

?>

	<!-- <form action="" method="post" enctype="multipart/form-data">
		<input type="file" name="profil" placeholder="Gambar Utama" accept="image/*"><br>
		<input type="text" name="id_toko" placeholder="id_toko"><br>
		<input type="text" name="email" placeholder="email"><br>
		<input type="text" name="nama" placeholder="Nama"><br>
		<input type="text" name="alamat" placeholder="alamat"><br>
		<input type="text" name="status" placeholder="status"><br>
		<input type="submit" name="update_user" value="Tambahkan"><br>
	</form> -->

<?php

if (isset($_POST['update_user'])) {
	$id_toko = mysqli_real_escape_string ($koneksi, $_POST['id_toko']);
	$email = ucwords(mysqli_real_escape_string ($koneksi, $_POST['email']));
	$nama = mysqli_real_escape_string ($koneksi, $_POST['nama']);
	$mime = finfo_file(finfo_open(FILEINFO_MIME_TYPE), $_FILES['profil']['tmp_name']);
	$mime_explode = explode("/", $mime);
	$alamat = mysqli_real_escape_string ($koneksi, $_POST['alamat']);
	$status = mysqli_real_escape_string ($koneksi, $_POST['status']);
	$target_dir = "../../assets/store/";
	$target_file = $target_dir.generateString().".".$mime_explode[1];

	if (isNumber($id_toko) == "1" && emailCheck($email) == "1" && isFileUploded($_FILES['profil']['tmp_name']) == "1" && nameLengthCheck($nama) == "1" && universalLenghtChecks($alamat, 10) == "1") {
	    if (move_uploaded_file($_FILES["profil"]["tmp_name"], $target_file)) {
	    	$image_valid = 1;
			$query = mysqli_query($koneksi, "SELECT profil_url FROM toko WHERE id_toko = '$id_toko'");
			$row = mysqli_fetch_array($query);
			if ($row['profil_url'] != "") {
			    chown($row['profil_url'], 666);
				if (unlink($row['profil_url'])) {
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
		    	$query = mysqli_query($koneksi, "update toko set nama = '$nama', profil_url = '$target_file', alamat = '$alamat', status ='$status' where id_toko = '$id_toko'") or die(mysqli_error($koneksi));
		    	if ($query) {
					echo "database : store_updated";
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
		echo "file_uploaded : ".isFileUploded($_FILES['profil']['tmp_name'])."<br>";
		echo "id_toko_sanity : ".isNumber($id_toko)."<br>";
		echo "email_sanity : ".emailCheck($email)."<br>";
		echo "name_length : ".nameLengthCheck($nama)."<br>";
		echo "alamat_lenght : ".universalLenghtChecks($alamat, 10)."<br>";
		echo "status_lenght : ".universalLenghtChecks($alamat, 4)."<br>";

		return "0";
	}
}
else{
	header('Location: ../../index.php');
}

?>