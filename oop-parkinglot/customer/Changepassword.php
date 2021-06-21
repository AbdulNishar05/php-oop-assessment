<?php
session_start();

include ('../database.php');

if (!isset($_SESSION['user']) || (trim($_SESSION['user']) == ''))
{
    header('location:index.php');
}
include_once ('User.php');

$user = new User();

$sqlw1 = "SELECT * FROM customerDetails WHERE id = '" . $_SESSION['user'] . "'";
$rowws = $user->details($sqlw1);

if (isset($_POST['custPassUpdate']))
{
    $newPass = $_POST['custNewPass'];
    $conPass = $_POST['custConPass'];

    if ($newPass == $conPass)
    {
        $sid = $_SESSION['CUST_ID'];
        $sql = "UPDATE customerDetails SET password='$conPass' WHERE id='$sid'";
        $result = $conn->query($sql);
        if ($result)
        {
            $msg = "Password updated successfully.";
        }
        else
        {
            $msg = "Password not updated, try again later.";
        }

    }
    else
    {
        $msg = "Confirm Password Mismatch, Reenter Correct New Password.";
    }

}
?>

<!DOCTYPE html>
<html lang="en">
    <title>Admin | Book Parking Slot</title>
</head>

<body>
	                <h2>Change Password</h2>
	                <form method="post" name="custChanPassForm" id="custChanPassForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
	                  <div class="form-group">
	                    <label>New Password</label>
	                    <input type="password"  placeholder="Enter New Password" id="custNewPass" name="custNewPass" required max-length="8">
	                  </div>
	                  <div class="form-group">
	                    <label>Confirm Password</label>
	                    <input type="password"   placeholder="Enter Confirm Password" id="custConPass" name="custConPass" required max-length="8">
	                  </div>
	                  <button type="submit" class="btn btn-primary" name="custPassUpdate" id="custPassUpdate">Update</button>
		         </form>
			</div>
                </div>
        </div>
   </div>

   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</body>

</html>
