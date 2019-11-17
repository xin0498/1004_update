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
            <h1>Add Customer</h1>
            <a href="customerprofile.php" title="manage">Customer</a> | 
            <a href="booking.php" title="manage">Booking</a> | 
            <a href="bookingsummary.php" title="manage">Booking Summary </a>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-4">

                    <?php
                    define("DBHOST", "161.117.122.252");
                    define("DBNAME", "p1_4");
                    define("DBUSER", "p1_4");
                    define("DBPASS", "5xLMQfLGsc");
                    $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
                    ?>

                    <form method="POST" name="addcustomer" action="addcustomer.php" enctype="multipart/form-data">
                        <table>
                            <tr>
                                <td>
                                    <p>Name: </p>
                                </td>
                                <td>
                                    <input type="text" name="customerName" pattern="^(?=.{1,40}$)[a-zA-Z]+(?:[-'\s][a-zA-Z]+)*$" required>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Username:</p>
                                </td>
                                <td>
                                    <input type="text" name="username" pattern="^(?=.{1,40}$)[a-zA-Z]+(?:[-'\s][a-zA-Z]+)*$" required>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Password:</p>
                                </td>
                                <td>
                                    <input type="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Confirm Password:</p>
                                </td>
                                <td>
                                    <input type="password" name="confirmPassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Email:</p>
                                </td>
                                <td>
                                    <input type="email" name="email" pattern="^\S+@\S+$" required> 
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Phone No:</p>
                                </td>
                                <td>
                                    <input type="text" name="phoneNo" pattern="[6,8,9][0-9]{7}" title="Please enter phone number as 8-digit numbers only" required>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Role:</p>
                                </td>
                                <td>
                                    <input type="radio" name="role" value="C" required> Customer<br>
                                    <input type="radio" name="role" value="A" required> Admin<br>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Profile Picture:</p>
                                </td>
                                <td>
                                    <input type="file" name="profilePicture" id="profilePicture"  accept=".png,.gif,.jpg,.webp" required> 
                                </td>
                            </tr>
                        </table>
                        <input type="submit" name="submit" value="Upload" class="btn btn-primary" onclick="myFunction()">
                    </form>

                    <?php
                    if (!isset($_GET['action'])) {
                        $cname = $_POST['customerName'];
                        $uname = $_POST['username'];
                        $pword = $_POST['password'];
                        $email = $_POST['email'];
                        $phoneno = $_POST['phoneNo'];
                        $role = $_POST['role'];
//                        $profilepic = $_POST['profilePicture'];

                        if (isset($_POST["submit"]) == "Upload") {

                            $target_Folder = "images/";
                            $target_Path = $target_Folder . basename($_FILES['profilePicture']['name']);
                            $savepath = $target_Path . basename($_FILES['profilePicture']['name']);
                            $file_name = $_FILES['profilePicture']['name'];
                            $pic = "$target_Folder$file_name";

                            $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);

                            if (isset($uname)) {
                                $sql = $conn->prepare("SELECT * FROM customer where username=?");
                                $sql->bind_param("s", $u);
                                $sql->execute();
                                $result = $sql->get_result();
                                //$result = mysqli_query($conn, $sql);
                                $get_rows = mysqli_affected_rows($conn);

                                if ($get_rows > 0) {
                                    echo "USERNAME EXISTS!!";
                                    die();
                                } else {
                                    $sql_insert = $conn->prepare("insert into customer (customerName,username,password,email,phoneNo,role,profilePicture)
							values(?,?,?,?,?,?,?)");
                                    //values('$cname', '$uname', '$pword', '$email', '$phoneno', '$role', '" . $target_Folder . $file_name . "')");
                                    move_uploaded_file($_FILES['profilePicture']['tmp_name'], $target_Path);
                                    $sql_insert->bind_param("ssssiss", $cname, $uname, $pword, $email, $phoneno, $role, $pic);
                                    $sql_insert->execute();
                                    $result = $sql->get_result();
                                    echo "Added Successfully";
                                    $sql_insert->close();
                                    mysqli_close($conn);
                                }
                            }
                        }
                    }
                    
                    ?>

                    <script>
                        function myFunction() {

                            var customerName = document.forms["addcustomer"]["customerName"];
                            var username = document.forms["addcustomer"]["username"];
                            var email = document.forms["addcustomer"]["email"];
                            var regexEmail = /\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/;
                            var password = document.forms["addcustomer"]["password"];
                            var confirmpwd = document.forms["addcustomer"]["confirmPassword"];
                            var phoneNo = document.forms["addcustomer"]["phoneNo"];
                            var role = document.forms["addcustomer"]["role"];
                            var profilepic = document.forms["addcustomer"]["profilePicture"];

                            if (customerName.value === "")
                            {
                                window.alert("Please enter customer name.");

                                return false;
                            }

                            if (username.value === "")
                            {
                                window.alert("Please enter username.");

                                return false;
                            }
                            if (phoneNo.value === "")
                            {
                                window.alert("Please enter phone number.");

                                return false;
                            }
                            if (role.value === "")
                            {
                                window.alert("Please select role.");

                                return false;
                            }
                            if (profilepic.value === "")
                            {
                                window.alert("Please upload profile picture.");

                                return false;
                            }

                            if (email.value === "")
                            {
                                window.alert("Please enter a valid e-mail address.");

                                return false;
                            } else if (regexEmail.test(email.value)) {
                                window.alert("Valid Email");

                            } else {
                                window.alert("Not valid email");
                                return false;
                            }
                            if (password.value === "")

                            {
                                alert("Password must not be empty");
                                return false;
                            } else if (password.value !== confirmpwd.value)
                            {
                                window.alert("Passwords Don't Match");
                                return false;
                            } else
                            {
                                window.alert("Passwords Match");
                                return true;
                            }
                        }
                    </script>
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
