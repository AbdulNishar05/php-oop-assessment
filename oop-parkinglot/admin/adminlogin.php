<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin | Book Parking Slot</title>
</head>

<body>
    
		 <?php
if (isset($_SESSION['message']))
{
?>
										
         <?php echo $_SESSION['message']; ?>
                                                 
        </div>
          <?php
    unset($_SESSION['message']);
}
?>

		<h2 align="center">Admin</h2>
            	<form method="post" action="login.php">
		  <div align="center" >
		   
      Username: <input type="text"  placeholder="username" id="adminloginEmail" name="uname" required>
		  </div>
		  <div align="center">
		   
      Password  <input type="password"   placeholder="Password" id="adminloginPass" name="upass" required>
		  </div><br>
		  <div align="center">
		  <button type="submit" class="btn btn-primary" name="login" id="adminloginSubmit">Submit</button>
		</form>
		</div>
        </div>
    </div>
    
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</body>

</html>
