<?php
session_start();

include('../database.php');

if (!isset($_SESSION['user']) ||(trim ($_SESSION['user']) == '')){
	header('location:index.php');
}
include_once('User.php');

$user = new User();

$sqlw1 = "SELECT * FROM customerDetails WHERE id = '".$_SESSION['user']."'";
$rowws = $user->details($sqlw1);


if(isset($_GET['wid']))
{
        $wid = $_POST['wid'];
        $amt = $_POST['walletAmt'];
	$sid = $_SESSION['CUST_ID'];

	$res_parking = $conn->query("SELECT * FROM customerDetails where id='$sid' ");
        $row12 = $res_parking->fetch_assoc();

	$w = $row12['wallet'];
	$balance = $w-$amt;
	$et_time = date("h:i");

	$wallet_update = "UPDATE customerDetails SET wallet='$balance' WHERE id='$sid'";
	$conn->query($wallet_update);

	$sql = "UPDATE booking SET status='OUT',et_time='$et_time' WHERE id='$wid'";
        $result = $conn->query($sql);

        if ($result) {
                $msg = "Vehicle Out successfully.";
        }
        else
        {
                $msg = "Vehicle Not Out. Try Again Later.";
        }
        header("Location: Vehicleout.php?success=$msg");
}

?>

<!DOCTYPE html>
<html lang="en">
    <title>Customer | Book Parking Slot</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/bootstrap-theme.min.css">
</head>

<body>
  			   	  <h3>Vehicle In List</h3>
	                          <table class="table">
	                                <thead>
	                                    <tr>
	                                      <th >#</th>
					      				 <th >Date</th>
	                                      <th >Area</th>
	                                      <th >Vehicle Type</th>
	                                      <th >Slot Type</th>
					     				  <th >In</th>
					      				  <th >Out</th>
					     				  <th >Status</th>
	                                      <th >Action</th>
	                                    </tr>
	                                  </thead>
	                                  <tbody>
	                                   <?php
	                                        $res_parking = $conn->query("SELECT * FROM booking WHERE status!='Cancelled'");
	                                        while($row = $res_parking->fetch_assoc()) {
	                                        ?>
	                                        <tr>
	                                         <td><?php echo $row["id"]; ?></td>
						 <td><?php echo $row["date"]; ?></td>
	                                         <td><?php echo $row["area"]; ?></td>
	                                         <td><?php echo $row["vehicle_type"]; ?></td>
	                                         <td><?php echo $row["slot_type"]; ?></td>
						 <td><?php echo $row["st_time"]; ?></td>
						 <td><?php echo $row["et_time"]; ?></td>
						 <td><?php echo $row["status"]; ?></td>
	                                         <td><?php if($row['status'] != "OUT"){ ?>  <button type="button" class="btn btn-info" data-toggle="modal" data-target="#addMoney<?php echo $row['id']; ?>">Out</button> <?php } ?> </td>
	                                        </tr>

						 
	                                         <div class="modal fade" id="addMoney<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	                                          <div class="modal-dialog" role="document">
	                                            <div class="modal-content">
	                                              <div class="modal-header">
	                                                <h5 class="modal-title" id="exampleModalLabel">Vehicle Out</h5>
	                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                                                  <span aria-hidden="true">&times;</span>
	                                                </button>
	                                              </div>
	                                             <form action="Vehicleout.php?wid=<?php echo $row['id']; ?>" method="post" name="addMoneyToWalletForm" enctype="multipart/form-data">
	                                              <div class="modal-body">
	                                                  <div class="form-group">
	                                                    <label for="recipient-name" class="col-form-label">Deduct amount(Rs.) :</label>
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


