<?php

define("DBHOST", "161.117.122.252");
define("DBNAME", "p1_4");
define("DBUSER", "p1_4");
define("DBPASS", "5xLMQfLGsc");
                
$conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
$cidToUpdate = $_POST["bookingID"];
$roomName = $_POST["roomName"];
$sql = "update booking as b inner join rooms as r on b.roomID=r.roomID set r.roomName ='$roomName' where bookingID='$cidToUpdate'";
$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
echo "$sql";
echo "<br/>";
echo "$result";
//header("Location:booking.php");
?>

