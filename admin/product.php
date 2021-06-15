<?php 

include('server.php');

if($_SESSION['is_allowed'] == "yes"){

	if (isset($_GET['edit'])) {
		$id = $_GET['edit'];
		$update = true;
		$record = mysqli_query($db, "SELECT * FROM products WHERE id=$id");

		if ($record) {
			$n = mysqli_fetch_array($record);
			$name = $n[1];
			$des = $n[2];
		}

	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin - Products</title>
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

<?php $results = mysqli_query($db, "SELECT * FROM products"); ?>
<button class="btn" style="background-color:#4d4d4d; float:right; margin-right: 1%; margin-top: 1%"><a style="text-decoration:none; color:white;" href="logout.php">Logout</a></button>
<button class="btn" style="background-color:#4d4d4d; float:right; margin-right: 10px; margin-top: 1%"><a style="text-decoration:none; color:white;" href="msg.php">Messages</a></button>
<br><br>
<center><h2 style="color: #333333">New Product</h2></center>
<form method="post" action="server.php" enctype="multipart/form-data">

	<input type="hidden" name="id" value="<?php echo $id; ?>">

	<div class="input-group">
		<label style="color: #333333">Product Name</label>
		<input type="text" name="name" value="<?php echo $name; ?>">
	</div>
	<div class="input-group">
		<label style="color: #333333">Product Description</label>
		<input type="text" name="des" value="<?php 
		if($update == true){
			echo $des;
		}
		else{
			echo "";
		}?>">
	</div>
	<?php
	//if($update != true){?>
	<div class="input-group">
		<label style="color:#333333">Product Image</label>
		<input type="file" name="fileToUpload" id="fileToUpload">
	</div>
	<?php //} ?>
	<div class="input-group">

		<?php if ($update == true): ?>
			<button class="btn" type="submit" name="update" style="background: #556B2F;" >update</button>
		<?php else: ?>
			<button class="btn" type="submit" name="submit" >Save</button>
		<?php endif ?>
	</div>
</form>

<table>
	<thead>
		<tr>
			<th style="color: #333333">Name</th>
			<th style="color: #333333">Description</th>
			<th style="color: #333333">Image</th>
			<th style="color: #333333">Edit</th>
			<th style="color: #333333">Delete</th>
		</tr>
	</thead>
	
	<?php while ($row = mysqli_fetch_array($results)) { ?>
		<tr>
			<td><?php echo $row[1]; ?></td>
			<td><?php echo $row[2]; ?></td>
			<td><?php echo $row[3]; ?></td>
			<td>
				<a href="product.php?edit=<?php echo $row['id']; ?>" class="edit_btn" >Edit</a>
			</td>
			<td>
				<a href="server.php?del=<?php echo $row['id']; ?>" class="del_btn">Delete</a>
			</td>
		</tr>
	<?php } ?>
</table>
	
</body>
</html>

<?php }
else{
	header('location: index.php');
}