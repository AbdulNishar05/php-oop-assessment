<?php
session_start();

include ('../database.php');

if (!isset($_SESSION['user']) || (trim($_SESSION['user']) == ''))
{
    header('location:index.php');
}

if (isset($_POST['confirmBooking']))
{
    $CArea = $_POST['confirmArea'];
    $CTVehicle = $_POST['confirmTVehicle'];
    $CSType = $_POST['confirmSType'];
    $CDate = $_POST['confirmDate'];
    $CSTime = $_POST['confirmSTime'];
    $CCTime = $_POST['confirmCTime'];
    $CPid = $_POST['confirmPid'];
    $CPAmt = $_POST['confirmPAmt'];
    $CCAmt = $_POST['confirmCancAmt'];
    $CSlot = $_POST['bookingNoSlot'];
    $CRegDate = date('d-m-Y');
    $cid = $_SESSION['CUST_ID'];

    $sql = $conn->query("INSERT INTO booking (date,cid,status,area,vehicle_type,slot_type,st_time,cut_time,slot_no,amt,amt_status,pid,regdate) VALUES ('$CDate','$cid','Booked','$CArea','$CTVehicle','$CSType','$CSTime','$CCTime','$CSlot','$CPAmt','','$CPid','$CRegDate')");
    if ($sql)
    {
        $success = "Slot Successfully booked.";
    }
    else
    {
        $success = "Server Problem, Try Again Later";
    }
    header("Location: Wallet.php?success=" . $success);

}
include_once ('User.php');

$user = new User();

$sqlw1 = "SELECT * FROM customerDetails WHERE id = '" . $_SESSION['user'] . "'";
$rowws = $user->details($sqlw1);

?>

<!DOCTYPE html>
<html lang="en">
    <title>Customer | Book Parking Slot</title>
</head>

<body>
		<h3 align="center">Booking</h3>
		<div class="row">
		<div class="col-md-12 text-center">
             <form method="post" name="bookingForm" action="<?php echo $_SERVER["PHP_SELF"]; ?>" enctype='multipart/form-data'>
              
               <div align="center">
				   Area:<select  id="bookingArea" name="bookingArea" required>
                        <option value="">Select Area</option>
							<?php
$sql = $conn->query("SELECT  Area,id FROM addparking");
while ($res = $sql->fetch_assoc())
{
?>
								<option data-id="<?php echo $res['id']; ?>" value="<?php echo $res['Area']; ?>"><?php echo $res['Area']; ?></option>
							<?php
}
?>
                        </select>
               </div><br>             
                 <div align="center">
                    Type of vehicle:<select id="bookingType" name="bookingType" required>
                        <option value="">Select type of vehicle</option>
                         <option value="simple">Simple</option>
                        <option value="heavy">Heavy</option>
                         </select>
                                   
                </div><br>
				  					
                <div align="center">
                     Date <input type="date" id="bookingDate" name="bookingDate" required>
                </div><br>
                                 
			    <div align="center">              
                Start time  <input type="time" id="bookingStartTime" name="bookingStartTime" required>
                </div><br>
                                 
                 <div align="center">
                                    
                     Cut of time :<select id="bookingTime" name="bookingTime" required>
                          <option value="">Select Cut Off Time</option>
                        </select>
                                
                </div><br>

                       
                <div align="center">
					<input type="hidden" name="bookingParkId" id="bookingParkId">
                    <button type="submit" class="btn btn-info" id="searchBooking" name="searchBooking">Search</button>
                </div><br>
                                  
            </form>
			</div>
			</div>
               
		<div class="row">
			<div class="col-md-12 text-center">
				<hr>
				<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype='multipart/form-data' name="confirmBookingForm">
				<?php
if (isset($_POST['searchBooking']))
{
    $Area = $_POST['bookingArea'];
    $TypeVehicle = $_POST['bookingType'];
    $Date = $_POST['bookingDate'];
    $STime = $_POST['bookingStartTime'];
    $CTime = $_POST['bookingTime'];
    $Pid = $_POST['bookingParkId'];

    $parking_sql = $conn->query("SELECT * FROM addparking WHERE id='$Pid'");
    $parking_res = $parking_sql->fetch_assoc();

    $slottype = $parking_res['slotcharge'];
    $slotperamt = $parking_res['slotperhour'];
    $slotcancamt = $parking_res['Cancellation'];

    echo "<input type='hidden' name='confirmArea' value=" . $_POST['bookingArea'] . "><input type='hidden' name='confirmTVehicle' value=" . $_POST['bookingType'] . "><input type='hidden' name='confirmSType' value=" . $slottype . "><input type='hidden' name='confirmDate' value=" . $_POST['bookingDate'] . "><input type='hidden' name='confirmSTime' value=" . $_POST['bookingStartTime'] . "><input type='hidden' name='confirmCTime' value=" . $_POST['bookingTime'] . "><input type='hidden' name='confirmPid' value=" . $_POST['bookingParkId'] . "><input type='hidden' name='confirmPAmt' value=" . $slotperamt . "><input type='hidden' name='confirmCancAmt' value=" . $slotcancamt . ">";

    echo "<p>Area : " . $_POST['bookingArea'] . " | Type of Vehicle : " . $_POST['bookingType'] . " | Date : " . $_POST['bookingDate'] . " | Start Time : " . $_POST['bookingStartTime'] . " </p>";

    $pslot = $parking_res['parkingslots'];

    $time = $STime + $CTime;

    for ($i = 1;$i <= $pslot;$i++)
    {
        $book_chk_sql = $conn->query("SELECT * FROM booking WHERE date='$Date' AND st_time BETWEEN '$STime' AND '$time' AND pid='$Pid' AND slot_no='$i' AND status='Booked'");
?>
							<div class="alert alert-<?php if ($book_chk_sql->num_rows > 0)
        {
            echo 'success';
        }
        else
        {
            echo 'dark';
        } ?> col-md-2 float-left ml-4" role="alert"><input type="radio" name="bookingNoSlot" value="<?php echo $i; ?>" <?php if ($book_chk_sql->num_rows > 0)
        {
            echo "disabled";
        } ?>> Slot <?php echo $i; ?></div>
						<?php
    }

    echo "<button type='submit' class='btn btn-info' name='confirmBooking'>Book Now</button>";
}
?>
			   	</form>
			</div>
		</div>
        </div>
   </div>

   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
   
   <script>   
	$('#bookingArea').change(function() {

	var bookingAreaId = $(this).find(':selected').attr('data-id');

	$.ajax({
	        type:"POST",
	        url : "ajaxCall.php",
	        data : "bookingAreaId="+bookingAreaId,
	        success : function(response) {
	            $("#bookingTime").html(response);
		    $("#bookingParkId").val(bookingAreaId);
	        }
	    });
	});


	$('#bookingType').change(function()
	{
		var Area = $("select#bookingArea").val();
		var Type = $("select#bookingType").val();

        $.ajax({
                type:"POST",
                url : "ajaxCall.php",
                data : "ChkData1="+Area+"&ChkData2="+Type,
                success : function(response) {
			if(response == '') {
			alert('Parking Slot not available this area and vehicle type. Choose different.'); }
                }
            });
        });

   </script>

</body>

</html>
