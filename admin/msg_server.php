<?php 
	session_start();

	
	$db = mysqli_connect('localhost', 'root', '', 'admin');

	$open = false;


if (isset($_GET['del'])) {
	$id = $_GET['del'];
	mysqli_query($db, "DELETE FROM message WHERE id=$id");
	$_SESSION['message'] = "Message Deleted Successfully."; 
	header('location: msg.php');
}


	$results = mysqli_query($db, "SELECT * FROM message");


?>