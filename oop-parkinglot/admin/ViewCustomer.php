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

			 <h3>View Customer</h3>
			  <table class="table">
				<thead>
				    <tr>
				      <th >S.No</th>
				      <th >Cust. Name</th>
				      <th >Mob. Number</th>
				      <th >Email</th>
				      <th >Action</th>
				    </tr>
				  </thead>
				  <tbody>
				   <?php
$res_parking = $conn->query("SELECT * FROM customerDetails");
while ($row = $res_parking->fetch_assoc())
{
?>
                                        <tr>
                                         <td><?php echo $row["id"]; ?></td>
                                         <td><?php echo $row["Firstname"] . $row['Lastname']; ?></td>
                                         <td><?php echo $row["MobileNo"]; ?></td>
                                         <td><?php echo $row["Email"]; ?></td>
                                         <td><a class="btn btn-primary" href="Editcustomer.php?id=<?php echo $row['id']; ?>" role="button">Edit</a>
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
