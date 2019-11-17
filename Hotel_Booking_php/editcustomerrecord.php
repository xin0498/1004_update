<?php

if (!isset($_SERVER['HTTP_REFERER'])) {
// redirect them to your desired location
    header('location:login.php');

    exit;
}
?>
<?php

session_start();

define("DBHOST", "161.117.122.252");
define("DBNAME", "p1_4");
define("DBUSER", "p1_4");
define("DBPASS", "5xLMQfLGsc");

$conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);

$cidToUpdate = $_POST["cid"];
$newName = $_POST["cName"];
$pword = $_POST['pword'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$role = $_POST['role'];
//$pic = $_POST['profilePicture'];
$pword = mysqli_real_escape_string($conn, $pword);
$pword = md5($pword);

if (isset($_POST["submit"]) == "Upload") {
    $target_Folder = "images/";
    $target_Path = $target_Folder . basename($_FILES['profilePicture']['name']);
    $savepath = $target_Path . basename($_FILES['profilePicture']['name']);
    $file_name = $_FILES['profilePicture']['name'];
    $profilepic = "$target_Folder$file_name";

    $sql = $conn->prepare("update customer set customerName =?, password =?, email =?, phoneNo=?, role = ?, profilePicture=? where customerID=?");
    move_uploaded_file($_FILES['profilePicture']['tmp_name'], $target_Path);
    $sql->bind_param("sssissi", $newName, $pword, $email, $phone, $role, $profilepic, $cidToUpdate);
    $sql->execute();
    $result = $sql->get_result();
    $sql->close();
    //$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    echo "Updated Successfully! ";
    mysqli_close($conn);
    echo "<br/>";
    echo("<button onclick=\"location.href='customerprofile.php?id=$cidToUpdate'\">Return to Customer record.</button>");
    //header("Location:customerprofile.php?id=$cidToUpdate");
}
?>

