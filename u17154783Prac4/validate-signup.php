<?php
$MainError = "";
$_SESSION["MainError"] = $_SESSION["SuccessReg"] = "";
$_SESSION["invalidity"] = false;
$invalid = false;
$emailPatt = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i";
session_start();
if (!preg_match("/^[a-zA-Z]*$/", $_SESSION["uName"])){
    $mainError = "Please only enter letters and whitespaces for your name";
    $invalid = true;
    } else {
      $uName = checkSafe($_SESSION["uName"]);
    }

if(!preg_match($emailPatt, $_SESSION["emailAdd"])){
  $mainError = "Please enter a valid email address";
  $invalid = true;
} else {
  $emailAd = checksafe($_SESSION["emailAdd"]);
}

if(!preg_match("/^[0-9]*$/", $_SESSION["cellNo"]) || strlen($_SESSION["cellNo"]) != 10){
  $mainError = "Cell number is invalid";
  $invalid = true;
} else {
  $cellNum = $_SESSION["cellNo"];
}

if(empty($_SESSION["uPass1"])){
  $mainError = "Please enter a password";
  $invalid = true;
  } else {
if($_SESSION["uPass1"] != $_SESSION["uPass2"]){
  $mainError = "Please make sure the passwords match";
  $invalid = true;
} else {
  if(!preg_match('/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W])\S*$/', $_SESSION["uPass1"])){
    $mainError = "Password must have at least 8 digits, 1 uppercase character, 1 lowercase character and a special character";
    $invalid = true;
  } else {
  $pasB = checkSafe($_SESSION["uPass1"]);
  $upassword = sha1($pasB);
}
}
}
if (!$invalid) {
$servername = "wheatley.cs.up.ac.za";
$username = "u17154783";
$password = "WilsonPrince98";
$conn = mysqli_connect($servername, $username, $password,"u17154783_COS216_UserInfo");
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  } else {
    $SQLQuery1 = "SELECT * from allInfo WHERE email = '$emailAd'";
    $SQLQuery2 = "SELECT * from allInfo where cellnumber = '$cellNum'";
    $result1 = $conn->query($SQLQuery1);
    $result2 = $conn->query($SQLQuery2);

    if(mysqli_num_rows($result1) > 0) {
      $_SESSION["MainError"]  = "Please note a user with this email already exists";
      header("Location:../u17154783/index.php");

    } else {
      if(mysqli_num_rows($result2) > 0) {
      $_SESSION["MainError"] = "Please note a user with this cell number already exists";
      header("Location:../u17154783/index.php");

    } else {
      $conn->query("INSERT INTO allInfo(`name`, `email`, `cellnumber`, `password`) VALUES ('$uName','$emailAd','$cellNum','$upassword')");
      $MainError = "";
      header("Location:../u17154783/index.php");

    }
  }
}
// set main error to whatever error is returned from sessin[error]
} else {
  $_SESSION["MainError"] = $mainError;
  $_SESSION["invalidity"] = true;
  header("Location:../u17154783/index.php");
}

function checkSafe($input) {
$input = trim($input);
$input = stripslashes($input);
$input = htmlspecialchars($input);
return $input;
}
