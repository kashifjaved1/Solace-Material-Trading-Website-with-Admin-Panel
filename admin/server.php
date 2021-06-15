<?php 

session_start();


	$db = mysqli_connect('localhost', 'root', '', 'admin');
	// initialize variables
	$name = "";
	$address = "";
	$id = 0;
	$update = false;


	if(isset($_POST['lgn'])){
		if((($_POST['name'] == "admin") && ($_POST['pass'] == "cvZBryT08GncL7TR5OpQnMv34EDSa1"))){
			$_SESSION['is_allowed'] = "yes";
			header('location: product.php');
		}
		else{
			header('location: index.php');
		}
	}



	if (isset($_POST['submit'])) {
		/////////////////////////////////////// image upload //////////////////////////////////////

		$target_dir = "uploaded/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
		echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
		//$uploadOk = 1;
		//$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

		// Check if image file is a actual image or fake image
		// if(isset($_POST["submit"])) {
		// $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		// if($check !== false) {
		// 	echo "File is an image - " . $check["mime"] . ".";
		// 	$uploadOk = 1;
		// } else {
		// 	echo "File is not an image.";
		// 	$uploadOk = 0;
		// }
		// }

		// // Check if file already exists
		// if (file_exists($target_file)) {
		// echo "Sorry, file already exists.";
		// $uploadOk = 0;
		// }

		// // Check file size
		// if ($_FILES["fileToUpload"]["size"] > 500000) {
		// echo "Sorry, your file is too large.";
		// $uploadOk = 0;
		// }

		// // Allow certain file formats
		// if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		// && $imageFileType != "gif" ) {
		// echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		// $uploadOk = 0;
		// }

		// Check if $uploadOk is set to 0 by an error
		// if ($uploadOk == 0) {
		// echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		// } else {
		// if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
		// 	echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
		// } else {
		// 	echo "Sorry, there was an error uploading your file.";
		// }
		// }

		/////////////////////////////////////// image upload //////////////////////////////////////
		
		$name = $_POST['name'];
		$des = $_POST['des'];
		$path = $target_file;
		echo $path;
		mysqli_query($db, "INSERT INTO products (name, des, path) VALUES ('$name', '$des', '$path')"); 
		$_SESSION['message'] = "Product Added Successfully.";
		header('location: product.php');
	}


	if (isset($_POST['update'])) {

		$target_dir = "uploaded/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
		echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";

		$id = $_POST['id'];
		$name = $_POST['name'];
		$des = $_POST['des'];
		$path = $target_file;

		mysqli_query($db, "UPDATE products SET name='$name', des='$des', path='$path' WHERE id=$id");
		$_SESSION['message'] = "Product Updated Successfully."; 
		header('location: product.php');
	}

if (isset($_GET['del'])) {
	$id = $_GET['del'];
	mysqli_query($db, "DELETE FROM products WHERE id=$id");
	$_SESSION['message'] = "Product Deleted Successfully."; 
	header('location: product.php');
}


	$results = mysqli_query($db, "SELECT * FROM products");


?>