<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1" />
    <title>Custmer | Book Parking Slot</title>
</head>

<body>
    <div class="container">
        <div class="row justify-content-md-center mx-auto p-5">
		<div class="col-md-6">
		<?php
if (isset($_SESSION['message']))
{
?>
				<div class="alert alert-warning alert-dismissible fade show" role="alert">
				  <?php echo $_SESSION['message']; ?>
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </button>
				</div>
			<?php
}
?>
		<h2 align="center">Customer Login</h2>
            	<form method="post" action="login.php" enctype="multipart/form-data">
		  <div align="center">
		  
		  Username: <input type="text"  placeholder="username" id="custloginUsername" name="uname" required>
		  </div>
		  <div align="center" >
		  
		  Password: <input type="password"   placeholder="Password" id="custloginPass" name="upass" required>
		  </div>
		  <div align="center">
		  <button type="submit" class="btn btn-primary" name="login" id="custloginSubmit">Login</button>
		  <a href="Register.php">Sign up</a>
		  <div>
		</form>
		
		 
		</div>
        </div>
    </div>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</body>

</html>
