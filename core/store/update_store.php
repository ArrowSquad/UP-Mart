<?php

require_once '../koneksi.php';
require_once '../universal_function.php';

if (isset($_POST['update_user'])) {
	$id_toko = mysqli_real_escape_string ($koneksi, $_POST['id_toko']);
	$nama = mysqli_real_escape_string ($koneksi, $_POST['nama']);
	$mime = finfo_file(finfo_open(FILEINFO_MIME_TYPE), $_FILES['profil']['tmp_name']);
	$mime_explode = explode("/", $mime);
	$alamat = mysqli_real_escape_string ($koneksi, $_POST['alamat']));
	$status = mysqli_real_escape_string ($koneksi, $_POST['status']);
	$email = ucwords(mysqli_real_escape_string ($koneksi, $_POST['email']));
	$target_dir = "../../assets/store/";
	$target_file = $target_dir.generateString().".".$mime_explode[1];

	if (emailCheck($arrayDataUser[0]) == "1" && nameLengthCheck($arrayDataUser[1]) == "1" && phoneLengthCheck($arrayDataUser[2]) == "1" && phoneSanityCheck($arrayDataUser[2]) == "1" && passwordCheck($arrayDataUser[3], $arrayDataUser[4]) == "1") {
	    if (move_uploaded_file($_FILES["profil"]["tmp_name"], $target_file)) {
	    	$image_valid = 1;
	    	if(mime_content_type($target_file) != "image/jpeg" && mime_content_type($target_file) != "image/jpg" && mime_content_type($target_file) != "image/png"){
	    		$image_valid = 0;
	    	}
	    	if ($image_valid == 1) {
		    	$query = mysqli_query($koneksi, "update toko set nama = '$nama', profil_url = '$target_file',alamat = '$alamat', status ='$status' where id_toko = '$id_toko'") or die(mysqli_error($koneksi));
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
		echo "name_length : ".nameLengthCheck($arrayDataUser[0])."<br>";
		echo "name_sanity : ".nameSanityCheck($arrayDataUser[0])."<br>";
		echo "email_sanity : ".emailCheck($arrayDataUser[2])."<br>";

		return "0";
	}
}
else{
	header('Location: ../../index.php');
}

?>