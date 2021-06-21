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
        $wid = $_GET['wid'];
        $amt = $_POST['cancelAmt'];
	$reason = $_POST['reason'];
	$parkCharge = $_POST['parkingcharge'];
	$res_parking = $conn->query("SELECT * FROM customerDetails where id='$sid' ");
        $row12 = $res_parking->fetch_assoc(); 
        $w = $row12['wallet'];
        $balance = $w-+ ($parkCharge-$amt);
        $sql = "UPDATE booking SET status='Cancelled',canc_charge='$amt',canc_reason='$reason' WHERE id='$wid'";
        $result = $conn->query($sql);

	$wallet_update = "UPDATE customerDetails SET wallet='$balance' WHERE id='$sid'";
        $conn->query($wallet_update);

        if ($result) {
                $msg = "Booking Cancelled successfully.";
        }
        else
        {
                $msg = "Booking not Cancel. Try Again Later.";
        }
        header("Location: ViewBooking.php?success=$msg");
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
					     				 <th >Payment Status</th>
	                                      <th >Action</th>
	                                    </tr>
	                                  </thead>
	                                  <tbody>
	                                   <?php
						$todayDate = date('Y-m-d');
	                                        $res_booking = $conn->query("SELECT * FROM booking Where date > $todayDate");
	                                        while($row = $res_booking->fetch_assoc()) {
	                                        ?>
	                                        <tr>
	                                         <td><?php echo $row["id"]; ?></td>
											 <td><?php echo $row["date"]; ?></td>
	                                         <td><?php echo $row["area"]; ?></td>
	                                         <td><?php echo $row["vehicle_type"]; ?></td>
	                                         <td><?php echo $row["slot_type"]; ?></td>
												 <td><?php echo $row["status"]; ?></td>
						 						<td><?php echo $row["amt_status"]; ?></td>
	                                         <td><?php if($row['status'] != "Cancelled"){ ?> <button type="button" class="btn btn-info" data-toggle="modal" data-target="#cancelBooking<?php echo $row['id']; ?>">Booking Cancel</button>  <?php } else { echo "<b class='text-danger'>Cancelled</b>"; } ?> </td>
	                                        </tr>

						<?php
							$pid = $row['pid'];
							$res_parking = $conn->query("SELECT * FROM addparking Where id='$pid'");
		                                        $row_park = $res_parking->fetch_assoc();
						 ?>
                                                 <div class="modal fade" id="cancelBooking<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                  <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                      <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Booking Cancel</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                          <span aria-hidden="true">&times;</span>
                                                        </button>
                                                      </div>
                                                     <form action="ViewBooking.php?wid=<?php echo $row['id']; ?>" method="post" name="bookingCancelForm" enctype="multipart/form-data">
                                                      <div class="modal-body">
                                                          <div class="form-group">
                                                            <label for="recipient-name" class="col-form-label">Cancel Amount (Rs.) :</label>
                                                            <input type="text" class="form-control" id="cancelAmt" name="cancelAmt" required value="<?php echo $row_park['cancel_charge'];  ?>" readonly>
                                                            <input type="hidden" name="wid" value="<?php echo $row['id']; ?>">
							    <input type="hidden" name="parkingcharge" value="<?php echo $row['amt']; ?>">
                                                          </div>
							  <div class="form-group">
                                                            <label for="recipient-name" class="col-form-label">Reason :</label>
                                                            <input type="text" class="form-control" id="reason" name="reason">
                                                          </div>
                                                      </div>
                                                      <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary" name="bookingCancelConfirm">Confirm</button>
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


