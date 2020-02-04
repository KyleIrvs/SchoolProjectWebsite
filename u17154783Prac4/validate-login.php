<?php
session_start();
error_reporting(E_ERROR | E_PARSE);
$signEmail = $_SESSION["valEmail"];
$signPass = $_SESSION["valPass"];
$SignPass = sha1($signPass);
$servername = "wheatley.cs.up.ac.za";
$username = "u17154783";
$password = "Password1";

// Create connection
$conn = mysqli_connect($servername, $username, $password,"u17154783_COS216_UserInfo");

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
} else {
  $SQLQuery = "SELECT * from allInfo WHERE email = '$signEmail'";
  $result = $conn->query($SQLQuery);
  $signError = "";
  if(mysqli_num_rows($result) > 0) {
    $result = $result->fetch_assoc();
    if($signEmail == $result["email"] && sha1($result["password"]) == $signPass){
      session_start();
      $_SESSION["ID"] = $signEmail;
    } else {
      $_SESSION["invalid"] = "UPIncorrect";
    }
  } else {
    $_SESSION["invalid"] = "noExists";
  }
  header("Location:wheatley.cs.up.ac.za/u17154783/index.php");
  exit();
}


?>
