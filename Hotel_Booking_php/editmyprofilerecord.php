<?php

session_start();
define("DBHOST", "161.117.122.252");
define("DBNAME", "p1_4");
define("DBUSER", "p1_4");
define("DBPASS", "5xLMQfLGsc");

$conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);

$custid = $_POST["customerID"];
$cname = $_POST['customerName'];
//$uname = $_POST['MM_Username'];
$uname = $_POST['username'];
$pword = $_POST['password'];
$email = $_POST['email'];
$phoneno = $_POST['phoneNo'];
$profilepic = $_POST['profilePicture'];
$u = mysqli_real_escape_string($conn, $u);
$pword = mysqli_real_escape_string($conn, $pword);
$pword = md5($pword);

if (isset($_POST["submit"]) == "Upload") {

    $target_Folder = "images/";
    $target_Path = $target_Folder . basename($_FILES['profilePicture']['name']);
    $savepath = $target_Path . basename($_FILES['profilePicture']['name']);
    $file_name = $_FILES['profilePicture']['name'];
    $profilepic = "$target_Folder$file_name";

    $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
    $sql = $conn->prepare("update customer set customerName=?,username=?,password=?,email=?,phoneNo=?,profilePicture=? where customerID=?");
    $sql->bind_param("ssssisi", $cname, $uname, $pword, $email, $phoneno, $profilepic, $custid);
    $sql->execute();
    $result = $sql->get_result();
    $sql->close();

//mysqli_query($conn, $sql) or die(mysqli_error($conn));
//echo "$sql";
//$result = mysqli_query($conn, $sql);
    echo "$result";
    header("Location:editmyprofile.php?id=$custid");
    mysqli_close($conn);
}
?>