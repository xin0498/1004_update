<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="en">
    <head>
        <title>D'Hotel</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" type="image/icon" href="./img/favicon.ico"/>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <link href="css/forgetpassword.css" rel="stylesheet" />
        <link href="css/main.css" rel="stylesheet" />
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

<!--        <form action="./checklogin.php?action=add" method="post" name="formlogin" onsubmit="return validateLoginForm()" novalidate>-->
        <form action="checklogin.php" method="post" name="formlogin" onsubmit="return validateLoginForm()" novalidate>
            <div class="container">
                <div class="row">
                    <div class="col-md-6" >
                        <h3>Login</h3>
                        <input type="text" id="username" placeholder="Username" name="username" required pattern="(?=.{1,40}$)[a-zA-Z]+(?:[-'\s][a-zA-Z]+)*$">
                        <input type="password" placeholder="Password" name="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,30}$">
                        <button id="btn1" name="submit" type="submit" >Login</button>
                        <p class="a" > <a href="#" onclick="document.getElementById('id01').style.display = 'block'" style="width:auto;">Forget Password</a></p>
                        <noscript>
                        Your Javascript is currently not on, kindly open your JavaScript.<br>
                        If you are unable to turn on the Javascript, please kindly use the link below: <br>
                           <a href="forgetpassword.php">Forget Password</a>
                           <link href="css/noscript.css" rel="stylesheet" />
                      </noscript>
                    </div>
                    <div class="col-md-6">
                        <h3>Haven't Sign Up!</h3>
                        <p>You can click here to sign up!</p>
                        <a href="./registration.php">Become our member!</a>
                    </div>
                </div>
            </div>
        </form>

        <div id="id01" class="modal">
            <span onclick="document.getElementById('id01').style.display = 'none'" class="close" title="Close Modal">&times;</span>
            <form action="checkforgetpassword.php" method="post" name="formforgetpass" class="modal-content" onsubmit="return validateForgetPasswordForm()" novalidate>
                <div class="container">
                    <h1>Forget Password</h1>
                    <p>Please fill in this form to get a new password.</p>
                    <hr>
                    <label for="email"><b>Email</b></label>
                    <input type="text" placeholder="Enter Email" name="email" id="email" required>
                    <p>We send you a email to restart your password. </p>
                    <div class="clearfix">
                        <button type="button" onclick="myFunction()" class="cancelbtn">Cancel</button>
                        <button name="submit" type="submit"  class="sendemailbtn">Send Email</button>
                    </div>
                </div>
            </form>
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

        <script>
            // Get the modal
            var modal = document.getElementById('id01');

            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function (event) 
            {
                if (event.target === modal) {
                    modal.style.display = "none";
                    document.getElementById('email').value="";
                }
            };
           function myFunction() {
            document.getElementById('id01').style.display = 'none';
             document.getElementById('email').value="";
            }
            function init() {
            document.getElementById("email").value = "";
            document.getElementById("username").value = "";
            }
            window.onload = init;
        </script>
    </body>
</html>