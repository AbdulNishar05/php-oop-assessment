<?php
session_start();

include ('../database.php');

if (!isset($_SESSION['user']) || (trim($_SESSION['user']) == ''))
{
    header('location:index.php');
}

if (isset($_POST['addParking']))
{
    $area = $_POST['Area'];
    $type = $_POST['vehicleType'];
    $slot = $_POST['parkingslots'];
    $slotcharge = $_POST['slotcharge'];
    $slotperhour = $_POST['slotperhour'];
    $cancel = $_POST['Cancellation'];
    $cutofftime = $_POST['cutofftime'];

    $query = "INSERT INTO addparking (Area,vehicleType,parkingslots,slotcharge,slotperhour,Cancellation,cutofftime)";
    $query .= "VALUES('$area','$type','$slot','$slotcharge','$slotperhour','$cancel','$cutofftime')";

    $res_insert = $conn->query($query);
    if ($res_insert)
    {
        $success = "Record Successfully inserted.";
    }
    else
    {
        $success = "Server Problem, Try Again Later";
    }
    header("Location: AddParkingSlot.php?success=" . $success);
}
include_once ('User.php');

$user = new User();

//fetch user data
$sql = "SELECT * FROM adminlogin WHERE id = '" . $_SESSION['user'] . "'";
$row = $user->details($sql);

?>

<!DOCTYPE html>
<html lang="en">
    <title>Admin | Book Parking Slot</title>
</head>

<body>
				<h3>Add Parking Slot</h3>
				<form method="post" name="addParkingForm" action="<?php echo $_SERVER["PHP_SELF"]; ?>" enctype='multipart/form-data'>
        <div><br>
       Area:<input type="text" name="Area"> 
    </div>
    <div><br>
        Type of  Vehicle:<select name="vehicleType" id="vehicleType">
            <option value="simple">Simple</option>
            <option value="Heavy">Heavy</option>
            </select>
    </div> <br>
    <div>
        No of Parking slot:<input type="number" id="number" name="parkingslots"> 
    </div> <br>
    <div>
        Slot charge:<select name="slotcharge" id="slotcharge">
            <option value="free">free</option>
            <option value="paid">paid</option>
            </select>
    </div><br>
    <div>
    <div>
        Slot charge per hour:<input type="number" id="number" name="slotperhour"> 
    </div> <br>
        
    <div>
        Cancellation charge:<input type="number" id="number" name="Cancellation"> 
    </div> <br>
        <div>
    cut off time:<select name="cutofftime" id="cutofftime">
            <option value="1hr">1 hour</option>
            <option value="2hr">2 hours</option>
            <option value="3hr">3 hours</option>
            <option value="4hr">more than 3 hours</option>
            </select>
        </div>
          <div>
            <button type="submit" class="btn btn-info" id="addParking" name="addParking">Add</button>
				  </div>
				</form>
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


</body>

</html>
