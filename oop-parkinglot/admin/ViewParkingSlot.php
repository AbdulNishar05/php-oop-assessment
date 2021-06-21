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
    <title>Admin | Book Parking Slot</title>
</head>

<body>

			 <h3>View Parking Slot</h3>
			  <table class="table">
				<thead>
				    <tr>
				      <th>Area</th>
				      <th>Type of Vehicle</th>
				      <th>No. of Parking Slot</th>
				      <th>Slot Type</th>
				      <th>Charge /hr</th>
				      <th>Cancelation Charge</th>
				    </tr>
				  </thead>
				  <tbody>
					<?php
$res_parking = $conn->query("SELECT * FROM addparking");
while ($row = $res_parking->fetch_assoc())
{
?>
					 <tr>
                  <td><?=$row['Area']; ?></td>
                  <td><?=$row['vehicleType']; ?></td>
                  <td><?=$row['parkingslots']; ?></td>
                  <td><?=$row['slotcharge']; ?></td>
                  <td><?=$row['slotperhour']; ?></td>
                  <td><?=$row['Cancellation']; ?></td>

                  </tr>

					<?php
}
?>
				</tbody>
			  </table>
			</div>
		</div>
	</div>
   </div>


   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


</body>

</html>
