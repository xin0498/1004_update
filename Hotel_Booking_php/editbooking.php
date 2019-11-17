<?php

if (!isset($_SERVER['HTTP_REFERER'])) {
// redirect them to your desired location
    header('location:login.php');

    exit;
}
?>
<?php

define("DBHOST", "161.117.122.252");
define("DBNAME", "p1_4");
define("DBUSER", "p1_4");
define("DBPASS", "5xLMQfLGsc");

$conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);

$cidToUpdate = $_POST["cid"];
$newName = $_POST["name"];

if (!empty($newName)) {
    $sql = $conn->prepare("update booking set status = ? where bookingID = ?");
    $sql->bind_param("si", $newName, $cidToUpdate);
    $sql->execute();
    $sql->close();
    echo "Updated Successfully";
    echo("<button onclick=\"location.href='booking.php?id=$cidToUpdate'\">Return to Booking.</button>");
    //header("Location:booking.php?id=$cidToUpdate");
} else {
    echo "status is empty";
    
}

mysqli_close($conn);
?>

