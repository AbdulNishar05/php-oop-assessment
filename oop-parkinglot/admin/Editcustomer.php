<?php
session_start();

include ('../database.php');

if (!isset($_SESSION['user']) || (trim($_SESSION['user']) == ''))
{
    header('location:index.php');
}
include_once ('User.php');

$get_id = $_GET['id'];
$get_data = $conn->query("SELECT * FROM customerDetails WHERE id='$get_id'");
$row = $get_data->fetch_assoc();

if (isset($_POST['custregUpdate']))
{
    $firstname = $_POST['Firstname'];
    $lastname = $_POST['Lastname'];
    $email = $_POST['Email'];
    $mobileno = $_POST['MobileNo'];
    $vehicleno = $_POST['VehicleNo'];
    $password = $_POST['password'];
    $get_id = $_GET['id'];

    $query = "UPDATE customerDetails SET ";
    $query .= "Firstname='$firstname',Email='$email',MobileNo='$mobileno',VehicleNo='$vehicleno', password='$password'  WHERE id='$get_id'";

    $result = $conn->query($sql);
    if ($result)
    {
        $msg = "Record successfully updated.";
    }
    else
    {
        $msg = "Record not updated.";
    }

    header("Location: ViewCustomer.php");
}
$user = new User();

$sqlw1 = "SELECT * FROM adminlogin WHERE id = '" . $_SESSION['user'] . "'";
$rows = $user->details($sqlw1);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin | Book Parking Slot</title>
</head>

<body>
                <h2>Customer Update</h2>
		 <form name="custregForm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
                    <div >
                    First Name:<input type="text" name="Firstname" required value="<?php echo $row['Firstname']; ?>">
                    </div>
                    <div>
                    Last Name: <input type="text"  name="Lastname"  required value="<?php echo $row['Lastname']; ?>">
                    </div>
                  </div>
                  <div >
                     Email: <input type="email"  name="Email"  required value="<?php echo $row['Email']; ?>" readonly>
                    </div>
                    
                    <div>
                     Mobile No: <input type="number"  name="MobileNo"  required value="<?php echo $row['MobileNo']; ?>" readonly>
                    </div>
                  </div>
                  <div >
                      VehicleNo:<input type="text"   name="VehicleNo"  required value="<?php echo $row['VehicleNo']; ?>" readonly>
                    </div>
                    <div>
                      password:<input type="text"   name="password"  required value="<?php echo $row['password']; ?>" readonly>
                    </div > 
                  <input type="hidden" name="custregid" value="<?php echo $row['id']; ?>">
                  <button type="submit" class="btn btn-primary" name="custregUpdate">Update</button>
                </form>


	   </div>
        </div>
    </div>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</body>
</html>
