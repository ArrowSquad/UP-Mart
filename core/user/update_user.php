<?php

require_once '../koneksi.php';
require_once '../universal_function.php';
error_reporting(0);

?>

	<!-- <form action="" method="post" enctype="multipart/form-data">
		<input type="file" name="profil" placeholder="Gambar Utama" accept="image/*"><br>
		<input type="text" name="email" placeholder="email"><br>
		<input type="text" name="nama" placeholder="Nama"><br>
		<input type="text" name="hp" placeholder="no handphone"><br>
		<input type="text" name="password" placeholder="password"><br>
		<input type="text" name="passwordulang" placeholder="password ulang"><br>
		<input type="text" name="alamat" placeholder="alamat"><br>
		<input type="submit" name="update_user" value="Tambahkan"><br>
	</form> -->

<?php

if (isset($_POST['update_user'])) {
	$email = ucwords(mysqli_real_escape_string ($koneksi, $_POST['email']));
	$mime = finfo_file(finfo_open(FILEINFO_MIME_TYPE), $_FILES['profil']['tmp_name']);
	$mime_explode = explode("/", $mime);
	$nama = mysqli_real_escape_string ($koneksi, $_POST['nama']);
	$hp = mysqli_real_escape_string ($koneksi, $_POST['hp']);
	$pass0 = mysqli_real_escape_string ($koneksi, md5(sha1($_POST['password'])));
	$pass1 = mysqli_real_escape_string ($koneksi, md5(sha1($_POST['passwordulang'])));
	$alamat = mysqli_real_escape_string ($koneksi, $_POST['alamat']);
	$target_dir = "../../assets/user/";
	$target_file = $target_dir.generateString().".".$mime_explode[1];

	if (emailCheck($email) == "1" && isFileUploded($_FILES['profil']['tmp_name']) == "1" && nameLengthCheck($nama) == "1" && nameSanityCheck($nama) == "1" && phoneLengthCheck($hp) == "1" && isNumber($hp) == "1" && passwordCheck($pass0, $pass1) == "1" && universalLenghtChecks($alamat, 10) == "1") {
	    if (move_uploaded_file($_FILES["profil"]["tmp_name"], $target_file)) {
	    	$image_valid = 1;
			$query = mysqli_query($koneksi, "SELECT profil_url FROM pengguna WHERE email = '$email'");
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
		    	$query = mysqli_query($koneksi, "update pengguna set profil_url = '$target_file', nama_lengkap = '$nama', no_handphone = '$hp', password = '$pass0', alamat = '$alamat' where email = '$email'") or die(mysqli_error($koneksi));
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
		echo "file_uploaded : ".isFileUploded($_FILES['profil']['tmp_name'])."<br>";
		echo "email : ".emailCheck($email)."<br>";
		echo "name_length : ".nameLengthCheck($nama)."<br>";
		echo "name_sanity : ".nameSanityCheck($nama)."<br>";
		echo "phone_length : ".phoneLengthCheck($hp)."<br>";
		echo "phone_sanity : ".isNumber($hp)."<br>";
		echo "password_match : ".passwordCheck($pass0, $pass1)."<br>";
		echo "alamat_length : ".universalLenghtChecks($alamat, 10)."<br>";
	}
}
else{
	header('Location: ../../index.php');
}

?>