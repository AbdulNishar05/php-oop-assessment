<?php
session_start();

include('../database.php');

if (!isset($_SESSION['user']) ||(trim ($_SESSION['user']) == '')){
	header('location:index.php');
}
include_once('User.php');

$user = new User();

$sql = "SELECT * FROM customerDetails WHERE id = '".$_SESSION['user']."'";
$row = $user->details($sql);


if(isset($_GET['wid']))
{
        $wid = $_POST['wid'];
        $amt = $_POST['walletAmt'];
	$sid = $_SESSION['user'];

	$sql = "UPDATE booking SET amt_status='PAID' WHERE id='$wid'";
        $result = $conn->query($sql);

        if ($result) {
                $msg = "Amount paid successfully.";
        }
        else
        {
                $msg = "Amount not paid. Try Again Later.";
        }
        header("Location: Wallet.php?success=$msg");
}

?>

<!DOCTYPE html>
<html lang="en">
    <title>Customer | Book Parking Slot</title>
</head>

<body>

  			   	  <h3>View Booking</h3>
	                          <table class="table">
	                                <thead>
	                                    <tr>
	                                      <th >#</th>
					     				 <th >Date</th>
	                                      <th >Area</th>
	                                      <th >Vehicle Type</th>
	                                      <th >Slot Type</th>
					     				 <th >Status</th>
					      					<th >Amt</th>
	                                      <th >Action</th>
	                                    </tr>
	                                  </thead>
	                                  <tbody>
	                                   <?php
	                                        $res_parking = $conn->query("SELECT * FROM booking");
	                                        while($row = $res_parking->fetch_assoc()) {
	                                        ?>
	                                        <tr>
	                                         <td><?php echo $row["id"]; ?></td>
											 <td><?php echo $row["date"]; ?></td>
	                                         <td><?php echo $row["area"]; ?></td>
	                                         <td><?php echo $row["vehicle_type"]; ?></td>
	                                         <td><?php echo $row["slot_type"]; ?></td>
						 						<td><?php echo $row["status"]; ?></td>
						 					<td><?php echo $row["cut_time"] * $row["amt"]; ?></td>
	                                         <td><?php if($row['amt_status'] == ""){ if($row['slot_type'] == "paid"){ ?> <button type="button" class="btn btn-info" data-toggle="modal" data-target="#addMoney<?php echo $row['id']; ?>">Pay Now</button> <?php }}else{ echo "<b class='text-danger'>PAID</b>"; } ?> </td>
	                                        </tr>

						  
	                                         <div class="modal fade" id="addMoney<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	                                          <div class="modal-dialog" role="document">
	                                            <div class="modal-content">
	                                              <div class="modal-header">
	                                                <h5 class="modal-title" id="exampleModalLabel">Offline Payment</h5>
	                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                                                  <span aria-hidden="true">&times;</span>
	                                                </button>
	                                              </div>
	                                             <form action="Wallet.php?wid=<?php echo $row['id']; ?>" method="post" name="addMoneyToWalletForm" enctype="multipart/form-data">
	                                              <div class="modal-body">
	                                                  <div class="form-group">
	                                                    <label for="recipient-name" class="col-form-label">Paid amount(Rs.) :</label>
	                                                    <input type="text" class="form-control" id="walletAmt" name="walletAmt" required value="<?php echo $row['cut_time'] * $row['amt']; ?>" readonly>
	                                                    <input type="hidden" name="wid" value="<?php echo $row['id']; ?>">
	                                                  </div>
	                                              </div>
	                                              <div class="modal-footer">
	                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	                                                <button type="submit" class="btn btn-primary" name="addMoneyToWallet">Confirm</button>
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


