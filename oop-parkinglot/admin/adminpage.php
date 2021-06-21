<?php
session_start();

include ('../database.php');

if (!isset($_SESSION['user']) || (trim($_SESSION['user']) == ''))
{
    header('location:index.php');
}

include_once ('User.php');

$user = new User();

$sql = "SELECT * FROM adminlogin WHERE id = '" . $_SESSION['user'] . "'";
$row = $user->details($sql);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin | Book Parking Slot</title>
</head>

<body>
	
    <div class="container-fluid border-bottom mb-3">
        <div class="row justify-content-md-center p-3">
            
            <div class="col">
              <h2 align="center">ADMIN</h2>
            </div>

          
            <div  align="center">
                                 
                    <a class="btn btn-info" href="AddParkingSlot.php">Add Parking Slot</a>
                  
                    <a class="btn btn-info" href="ViewParkingSlot.php">View Parking Slots</a>
                  
                    <a class="btn btn-info" href="ViewCustomer.php">View Customer</a>
                 
                    <a class="btn btn-info" href="Wallet.php">Wallet</a>
                  
            </div><br>
            <center>
            <a class="btn btn-info" href="../index.php">logout</a>
    </center>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</body>

</html>
