<?php

if (!isset($_SERVER['HTTP_REFERER'])) {
// redirect them to your desired location
    header('location:login.php');

    exit;
}
?>
<?php

if (!isset($_['submit'])) {
    $customerID = $_POST['customerID'];
    $roomID = $_POST['roomID'];
    $checkin = $_POST['check_in'];
    $checkout = $_POST['check_out'];
    $total = $_POST['total_sum'];
    $num_days = $_POST['num_days'];


    define("DBHOST", "161.117.122.252");
    define("DBNAME", "p1_4");
    define("DBUSER", "p1_4");
    define("DBPASS", "5xLMQfLGsc");

    $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);

    $sql = $conn->prepare("insert into booking (customerID,roomID,checkin,checkout,total,numdays) values (?,?,?,?,?,?)");
    $sql->bind_param("iissii", $customerID, $roomID, $checkin, $checkout, $total, $num_days);
    $sql->execute();
    $result = $sql->get_result();
    $sql->close();
    
    echo "Added Successfully";
    echo "<br/>";
    echo("<button onclick=\"location.href='booking.php?id=$roomID'\">Return to Booking.</button>");    
    mysqli_close($conn);
    //header("Location:bookroom.php?id=$roomID");
}
?>