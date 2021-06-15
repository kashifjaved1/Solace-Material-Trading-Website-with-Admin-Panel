<?php 
include('msg_server.php');

if($_SESSION['is_allowed'] == "yes"){

	if (isset($_GET['edit'])) {
		$id = $_GET['edit'];
		$open = true;
		$record = mysqli_query($db, "SELECT * FROM message WHERE id=$id");

		if ($record) {
			$n = mysqli_fetch_array($record);
			$name = $n[1];
			$email = $n[2];
			$subline = $n[3];
			$msg = $n[4];
		}

	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin - Messages</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<?php if (isset($_SESSION['message'])): ?>
		<div class="msg">
			<?php 
				echo $_SESSION['message']; 
				unset($_SESSION['message']);
			?>
		</div>
	<?php endif ?>

<?php $results = mysqli_query($db, "SELECT * FROM message"); ?>
<button class="btn" style="background-color:#4d4d4d; float:right; padding: 5px;"><a style="text-decoration:none; color:white;" href="logout.php">Logout</a></button>
<table>
	<thead>
		<tr>
			<th>Name</th>
			<th>Email</th>
			<th>Subject Line</th>
			<th colspan="2">Actions</th>
		</tr>
	</thead>
	
	<?php while ($row = mysqli_fetch_array($results)) { ?>
		<tr>
			<td><?php echo $row[1]; ?></td>
			<td><?php echo $row[2]; ?></td>
			<td><?php echo $row[3]; ?></td>
			<td>
				<a href="msg.php?edit=<?php echo $row['id']; ?>" class="edit_btn" >Open</a>
			</td>
			<td>
				<a href="msg_server.php?del=<?php echo $row['id']; ?>" class="del_btn">Delete</a>
			</td>
		</tr>
	<?php } ?>
</table>
	


<form>

	<input type="hidden" name="id" value="<?php echo $id; ?>">
	
	<div class="input-group">
		<label>Name</label>
		<input value="<?php
		if($open == true){
			echo $name;
		}
		else{
			echo "";
		}
		?>" readonly>
	</div>
	<div class="input-group">
		<label>Email</label>
		<input value="<?php
		if($open == true){
			echo $email;
		}
		else{
			echo "";
		}
		?>" readonly>
	</div>
	<div class="input-group">
		<label>Subject Line</label>
		<input value="<?php
		if($open == true){
			echo $subline;
		}
		else{
			echo "";
		}
		?>" readonly>
	</div>
	<div class="input-group">
		<label>Message</label>
		<input value="<?php
		if($open == true){
			echo $msg;
		}
		else{
			echo "";
		}
		?>" readonly>
	</div><br>
	<div class="input-group">
	</div>
</form>
</body>
</html>

<?php } 
else{
	header('location: index.php');
}