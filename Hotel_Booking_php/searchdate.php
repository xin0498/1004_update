<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
if (!isset($_SERVER['HTTP_REFERER'])) {
// redirect them to your desired location
    header('location:login.php');

    exit;
}
?>
<html>
    <head>
        <title>D'Hotel</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link rel="shortcut icon" type="image/icon" href="./img/favicon.ico"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <!-- Main CSS Style Sheet-->
        <link href="css/main.css" rel = "stylesheet" /> 
        <!-- Zheng Feng CSS -->
        <!-- Events CSS Style Sheet-->
        <link href="css/events.css" rel = "stylesheet" /> 
        <!-- FAQ CSS Style Sheet-->
        <link href="css/faq.css" rel = "stylesheet" /> 
        <!-- Dining CSS Style Sheet-->
        <link href="css/dining.css" rel = "stylesheet" /> 
        <!-- Font Awesome Icons -->
        <script src='https://kit.fontawesome.com/a076d05399.js'></script> 
        <!-- Own Javascript -->
        <script defer src="js/main.js"></script>
    </head>

    <body>
        <!-- Start of Navigation Bar -->
        <div id="nav-placeholder">
            <script>
                $(function () {
                    $("#nav-placeholder").load("navbaruser.php");
                });
            </script>
        </div>
        <!--end of Navigation bar-->

        <div class="jumbotron text-center">
            <h1>Search Booking Date</h1>
            <a href="customerprofile.php" title="manage">Customer</a> | 
            <a href="booking.php" title="manage">Booking</a> | 
            <a href="bookingsummary.php" title="manage">Booking Summary </a>
        </div>

        <div class="container-fluid text-center">    
            <div class="row content">
                <div class="col-sm-8 text-left">       
                    <form name="search" method="post" action="searchdate.php">
                        <p>Search Booking by Date:
                            <input type="date" name="searchdate" required>
                        </p>
                        <button type="submit" class="btn btn-primary" onclick="myFunction()"> <span>Search </span></button>

                        <?php
                        define("DBHOST", "161.117.122.252");
                        define("DBNAME", "p1_4");
                        define("DBUSER", "p1_4");
                        define("DBPASS", "5xLMQfLGsc");

                        $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
                        ?>

                        <table class="search">
                            <tr>
                                <td>Booking ID</td>
                                <td>Check in Date</td>
                                <td>Check out Date</td>
                                <td>Room Type</td>
                                <td>Status</td>

                                <?php
                                if (!isset($_GET['action'])) {

                                    $search = "%{$_POST['searchdate']}%";
                                    $flag = 0;
                                    $sql = $conn->prepare("select bookingID, checkin, checkout,roomType,status  from booking as b inner join rooms as r on b.roomID=r.roomID where checkin like ?");
                                    $sql->bind_param("s", $search);
                                    $sql->execute();
                                    $result = $sql->get_result();

                                    if (mysqli_num_rows($result) == 0) {
                                        echo "<h1>there are no results</h1>";
                                    }
//                                    $result = mysqli_query($conn, $sql);
//                                    $mycart = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                                    while ($data = mysqli_fetch_assoc($result)) {
                                        ?>
                                    <tr>
                                        <td>
                                            <?php echo $data['bookingID'] ?>
                                        </td>
                                        <td>
                                            <?php echo $data['checkin'] ?>
                                        </td>
                                        <td>
                                            <?php echo $data['checkout'] ?>
                                        </td>
                                        <td>
                                            <?php echo $data['roomType'] ?>
                                        </td>
                                        <td>
                                            <?php echo $data['status'] ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }

                            mysqli_close($conn);
                            ?>
                        </table>
                    </form>
                </div>
            </div>
        </div>

        <!--Footer-->
        <div id="footer-placeholder">
            <script>
                $(function () {
                    $("#footer-placeholder").load("footer.php");
                });
            </script>
        </div>
        <!--end of Footer-->
    </body>
</html>
