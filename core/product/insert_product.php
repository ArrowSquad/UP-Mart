<?php

require_once '../koneksi.php';
require_once '../universal_function.php';
error_reporting(0);

?>

	<!-- <form action="" method="post" enctype="multipart/form-data">
		<input type="file" name="picture" placeholder="Gambar Utama" accept="image/*"><br>
		<input type="text" name="nama" placeholder="Nama Barang"><br>
		<input type="text" name="deskripsi" placeholder="Deskripsi Barang"><br>
		<input type="text" name="harga" placeholder="Harga Barang"><br>
		<input type="text" name="stok" placeholder="Stok Barang"><br>
		<input type="text" name="kategori" placeholder="kategori Barang"><br>
		<input type="text" name="id_toko" placeholder="ID TOko"><br>
		<input type="submit" name="insert_product" value="Tambahkan"><br>
	</form> -->

<?php

if (isset($_POST['insert_product'])) {
	$nama = mysqli_real_escape_string ($koneksi, $_POST['nama']);
	$mime = finfo_file(finfo_open(FILEINFO_MIME_TYPE), $_FILES['picture']['tmp_name']);
	$mime_explode = explode("/", $mime);
	$deskripsi = mysqli_real_escape_string ($koneksi, $_POST['deskripsi']);
	$harga = mysqli_real_escape_string ($koneksi, $_POST['harga']);
	$stok = mysqli_real_escape_string ($koneksi, $_POST['stok']);
	$kategori = mysqli_real_escape_string ($koneksi, $_POST['kategori']);
	$terjual = 0;
	$id_toko = mysqli_real_escape_string ($koneksi, $_POST['id_toko']);
	$target_dir = "../../assets/product/";
	$target_file = $target_dir.generateString().".".$mime_explode[1];

	if (universalLenghtChecks($nama, 4) == "1" && isFileUploded($_FILES['picture']['tmp_name']) == "1" && universalLenghtChecks($deskripsi, 10) == "1" && isNumber($harga) == "1" && isNumber($stok) == "1" && isNumber($kategori) == "1" && isNumber($terjual) == "1" && isNumber($id_toko) == "1") {
	    if (move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
	    	$image_valid = 1;
	    	if(mime_content_type($target_file) != "image/jpeg" && mime_content_type($target_file) != "image/jpg" && mime_content_type($target_file) != "image/png"){
	    		$image_valid = 0;
	    	}
	    	if ($image_valid == 1) {
		    	$query = mysqli_query($koneksi, "insert into barang values('', '$nama', '$target_file', '$deskripsi', '$harga', '$stok', '$kategori', '$terjual', '$id_toko')") or die(mysqli_error($koneksi));
		    	if ($query) {
					echo "database : product_added";
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
		echo "file_uploaded : ".isFileUploded($_FILES['picture']['tmp_name'])."<br>";
		echo "name_length : ".universalLenghtChecks($deskripsi, 4)."<br>";
		echo "deskripsi_lenght : ".universalLenghtChecks($deskripsi, 10)."<br>";
		echo "harga_sanity : ".isNumber($harga)."<br>";
		echo "stok_sanity : ".isNumber($stok)."<br>";
		echo "kategori_lenght : ".isNumber($kategori)."<br>";
		echo "terjual_sanity : ".isNumber($terjual)."<br>";
		echo "id_toko_sanity : ".isNumber($id_toko)."<br>";

		return "0";
	}
}
else{
	header('Location: ../../index.php');
}

?>