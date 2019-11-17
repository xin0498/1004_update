<?php

// Constants for accessing our DB: 
define("DBHOST", "161.117.122.252");
define("DBNAME", "p1_4");
define("DBUSER", "p1_4");
define("DBPASS", "5xLMQfLGsc"); 
$email = $errorMsg = "";
$success = true;


if(empty($_POST["email"]))
{
    $errorMsg .= "Email is required.<br>";
    $success = false;
}
else
{
    $email = sanitize_input($_POST["email"]);
    //To check if the email address is well formed 
    if(!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        $errorMsg .= "Invalid email format.";
        $success = false;
    }
}
function sanitize_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

//Create connection
$conn = new mysqli(DBHOST,DBUSER,DBPASS,DBNAME);

//Check connection 
if($conn->connect_error)
{
    $errorMsg = "Connection failed: " .$conn->connect_error;
    $success = false;
}
else
{
    $sql = "SELECT * FROM users WHERE ";
    $sql .= "email = '$email'"; 
    
    //Execute the query 
    $result = $conn->query($sql);
    if($result->num_rows > 0)
    {
        //Note that email field is unique, so should only have 
        //one row in the result set. 
        $row = $result->fetch_assoc();
        $email=$row["email"];
       
        $_SESSION['email'] =$email;
     
//        echo"<h2>Login Successfully</h2>";
//        echo"<p>Welcome Back,$fname <br>" ;
//        
//        echo"<form action ='index.php'>";
//        echo "<input type='submit' value='Return to home'>";
//        echo"</form>";
    }
else
{
    echo "<h2>Opps!</h2>";
    echo "<h4>The following input errors were detected:</h4>";
    echo "<p>". $errorMsg ."</p>";
}
    $result->free_result();
}
$conn->close();
?>
<body>
  <div class="container">
<p><?php
         
            //checks if login session variable exist? If it does, display logout
		if (isset($_SESSION['email'])!= "")
		{
                       echo"<p>We will send you an email shortly to $email</p>";
        
                        echo"<form action ='index.php'>";
                        echo "<input type='submit' value='Return to home'>";
                        echo"</form>";
		}
		else
		{
                    
                      $errorMsg = "Email not found or password doesn't match....";
                     echo"<h2>Oops!</h2>";
                    echo"<h3>The following errors were detected: </h3>";
                     echo"<p>$errorMsg</p>" ;
                        $success = false;
                    
                  
		}
		?></p>
 </div>
</body>

