<?php

require_once '../koneksi.php';
require_once '../universal_function.php';

if (isset($_POST['update_user'])) {
	$email = ucwords(mysqli_real_escape_string ($koneksi, $_POST['title']));
	$mime = finfo_file(finfo_open(FILEINFO_MIME_TYPE), $_FILES['profil']['tmp_name']);
	$mime_explode = explode("/", $mime);
	$nama = mysqli_real_escape_string ($koneksi, $_POST['nama']);
	$hp = mysqli_real_escape_string ($koneksi, $_POST['hp']);
	$password = mysqli_real_escape_string ($koneksi, md5(sha1($_POST['password'])));
	$alamat = mysqli_real_escape_string ($koneksi, $_POST['alamat']);
	$target_dir = "../../assets/user/";
	$target_file = $target_dir.generateString().".".$mime_explode[1];

	if (emailCheck($arrayDataUser[0]) == "1" && nameLengthCheck($arrayDataUser[1]) == "1" && phoneLengthCheck($arrayDataUser[2]) == "1" && phoneSanityCheck($arrayDataUser[2]) == "1" && passwordCheck($arrayDataUser[3], $arrayDataUser[4]) == "1") {
	    if (move_uploaded_file($_FILES["profil"]["tmp_name"], $target_file)) {
	    	$image_valid = 1;
	    	if(mime_content_type($target_file) != "image/jpeg" && mime_content_type($target_file) != "image/jpg" && mime_content_type($target_file) != "image/png"){
	    		$image_valid = 0;
	    	}
	    	if ($image_valid == 1) {
		    	$query = mysqli_query($koneksi, "update pengguna set profil_url = '$target_file', nama_lengkap = '$nama', no_handphone = '$hp', password = '$password', alamat = '$alamat' where email = '$email'") or die(mysqli_error($koneksi));
		    	if ($query) {
					echo "database : user_updated";
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
		echo "email : ".emailCheck($arrayDataUser[0])."<br>";
		echo "name_length : ".nameLengthCheck($arrayDataUser[1])."<br>";
		echo "name_sanity : ".nameSanityCheck($arrayDataUser[1])."<br>";
		echo "phone_length : ".phoneLengthCheck($arrayDataUser[2])."<br>";
		echo "phone_sanity : ".phoneSanityCheck($arrayDataUser[2])."<br>";
		echo "password : ".passwordCheck($pass0, $pass1)."<br>";

		return "0";
	}
}
else{
	header('Location: ../../index.php');
}

?>