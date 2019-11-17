<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>D'Hotel</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>-->
        <link href="css/main.css" rel="stylesheet" />
        <link href="css/registration.css" rel="stylesheet" />
        <!-- Own CSS Style Sheet-->
        <script src='https://kit.fontawesome.com/a076d05399.js'></script>
        <!-- Font Awesome Icons -->
        <script defer src="js/main.js"></script>
        <!-- Own Javascript -->
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

        <form action="" method="post" id="formregister" name="formregister" onsubmit="return validateForm()">
            <div class="container-registration text-center">
                <h1>Registration</h1>
                <p>Please fill in this form to create an account.</p>
                <hr>
                <p>Name:
                    <input type="text" name="customerName" placeholder="Enter Name" required pattern="^(?=.{1,40}$)[a-zA-Z]+(?:[-'\s][a-zA-Z]+)*$"> </p>
                <p>Username:
                    <input type="text" name="username" placeholder="Enter a Username" required pattern="^(?=.{1,40}$)[a-zA-Z]+(?:[-'\s][a-zA-Z]+)*$"> </p>
                <p>Password:
                    <input type="password" name="password" placeholder="Enter a Password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,30}"> </p>
                <p>Email:
                    <input type="email" name="email" placeholder="Enter email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"> </p>
                <p>Phone No:
                    <input type="text" name="phoneNo" placeholder="Enter Phone Number" required pattern="[6,8,9][0-9]{7}"> </p>
                <input type="hidden" name="role" value="C"> 
                <p>Profile Picture:
                    <input type="file" name="profilePicture" id="profilePict" required accept=".png,.gif,.jpg,.webp"> </p>
                <hr>
                <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>

                <input type="submit" name="submit" class="registerbtn-registration">Register</input>
                <br/>
                
                <?php
                if (isset($_POST['submit'])) {
                    $cname = $_POST['customerName'];
                    $uname = $_POST['username'];
                    $pword = $_POST['password'];
                    $email = $_POST['email'];
                    $phoneno = $_POST['phoneNo'];
                    $profilepic = $_POST['profilePicture'];
                    $role = $_POST['role'];

                    define("DBHOST", "161.117.122.252");
                    define("DBNAME", "p1_4");
                    define("DBUSER", "p1_4");
                    define("DBPASS", "5xLMQfLGsc");

                    $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);

                    if (isset($uname)) {
                        $sql = $conn->prepare("SELECT * FROM customer where username=? ");
                        $sql->bind_param("s", $uname);
                        $sql->execute();

                        $result = $sql->get_result();
//                        $result = mysqli_query($conn, $sql);
                        $get_rows = mysqli_affected_rows($conn);

                        if ($get_rows > 0) {
                            echo "USERNAME EXISTS!!";
                            die();
                        } else {
                            $EncryptPassword = md5($pword);
                            $sql_insert = $conn->prepare("insert into customer (customerName,username,password,email,phoneNo,role,profilePicture)
						values(?,?,?,?,?,?,?)");

                            $sql_insert->bind_param("ssssiss", $cname, $uname, $EncryptPassword, $email, $phoneno, $role, $profilepic);
                            //echo "$sql_insert";
                            $result = $sql->get_result();
                            echo "$result";
                            $sql_insert->execute();
                            echo "Added Successfully";
//fetching result would go here, but will be covered later
                            $sql_insert->close();
                            mysqli_close($conn);
                        }
                    }
                }
                mysqli_close($conn);
                ?>

            </div>

            <div class="container-registration signin-registration">
                <p>Already have an account? <a href="./login.php">Sign in</a>.</p>
            </div>
        </form>
        <script>
              function init() {
              document.getElementById("formregister").reset();
            }
            window.onload = init;
            </script>
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