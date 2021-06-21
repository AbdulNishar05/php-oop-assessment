<?php
include ('../database.php');

if (isset($_POST['bookingAreaId']))
{
    $bookingAreaId = $_POST['bookingAreaId'];
    $sql = $conn->query("SELECT * FROM addparking WHERE id='$bookingAreaId'");
    $row = $sql->fetch_assoc();
    $cutoff = $row['cutofftime'];

    echo "<option>Select Available Time</option>";
    for ($i = 1;$i <= $cutoff;$i++)
    {
        echo "<option value=" . $i . ">" . $i . " hrs</option>";
    }
}

if (isset($_POST['ChkData1']) && isset($_POST['ChkData2']))
{
    $Area = $_POST['ChkData1'];
    $Type = $_POST['ChkData2'];
    $sql = $conn->query("SELECT * FROM addparking WHERE Area='$Area' AND vehicleType='$Type'");

    if ($sql->num_rows > 0)
    {
        echo "success";
    }
}

?>
