<?php
session_start();

include ('../database.php');

if (!isset($_SESSION['user']) || (trim($_SESSION['user']) == ''))
{
    header('location:index.php');
}

if (isset($_GET['wid']))
{
    $sql = "select * from customerDetails";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    $wid = $_GET['wid'];
    $amt = $row['wallet'] + $_POST['walletAmt'];

    $sql = "UPDATE customerDetails SET wallet='$amt' WHERE id='$wid'";
    $result = $conn->query($sql);
    if ($result)
    {
        $msg = "Amount added successfully.";
    }
    else
    {
        $msg = "Amount not added. Try Again Later.";
    }
    header("Location: Wallet.php?success=$msg");
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

			 <h3>Customer Wallet Status</h3>
			  <table class="table">
				<thead>
				    <tr>
				      <th >S.No</th>
				      <th >Cust. Name</th>
				      <th >Mob. Number</th>
				      <th >Email</th>
				      <th >Balance</th>
				      <th >Wallet</th>
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
					        <td><?php echo $row["wallet"]; ?></td>
                  <td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#addMoney<?php echo $row['id']; ?>">Add Money</button></td>
              </tr>

					 <div class="modal fade" id="addMoney<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					  <div class="modal-dialog" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <h5 class="modal-title" id="exampleModalLabel">Add Money to Customer Wallet</h5>
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					          <span aria-hidden="true">&times;</span>
					        </button>
					      </div>
					     <form action="Wallet.php?wid=<?php echo $row['id']; ?>" method="post" name="addMoneyToWalletForm" enctype="multipart/form-data">
					      <div class="modal-body">
					          <div class="form-group">
					            <label for="recipient-name" class="col-form-label">Enter the amount(Rs.) :</label>
					            <input type="text" class="form-control" id="walletAmt" name="walletAmt" required>
						    <input type="hidden" name="wid" value="<?php echo $row['id']; ?>">
					          </div>
					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					        <button type="submit" class="btn btn-primary" name="addMoneyToWallet">Add</button>
					      </div>
					      </form>
					    </div>
					  </div>
					</div>

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
