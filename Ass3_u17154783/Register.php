

<?php
$invalid = false;
session_start();
error_reporting(E_ERROR | E_PARSE);
$LnameErr = $nameErr = $idErr = $idExists ="";
$fName = $LName = $IDno = $password = $address=  "";


if($_POST["submit"] || $_POST["newStaff"]){
  if(!preg_match("/^[a-zA-Z]*$/",$_POST["vFName"])){
    $nameErr = "Please only enter letters and whitespaces";
    $invalid = true;
  } else {
    $fName = checkSafe($_POST["vFName"]);
  }
  if (!preg_match("/^[a-zA-Z]*$/", $_POST["vLName"])){
    $LnameErr = "Please only enter letters and whitespaces for your surname";
    $invalid = true;
    //echo?
  } else {
    $LName = checkSafe($_POST["vLName"]);
  }
  if(!preg_match("/^[0-9]*$/",$_POST["IDNum"])){
    $idErr = "Please enter a valid ID number";
    $invalid = true;
  } else {
    $IDno = $_POST["IDNum"];
  }
// merge above and below
  if(empty($_POST["IDNum"]) || strlen($_POST["IDNum"]) < 13) {
    $idErr = "Please Enter a valid ID Number";
    $invalid = true;
  } else {
    $IDno = checkSafe ($_POST["IDNum"]);
  }
  if(empty($_POST["pass1"])){
    $idExists = "Please enter a password";
  } else {
    $password = $_POST["pass1"];
  }
  if(!$invalid) {
    $servername = "localhost";
    $username = "root";
    $passq = "";

    $address = $_POST["addr"];

    $conn = mysqli_connect($servername, $username, $passq,"regMembers");

 if($_POST["submit"]){
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }
    $SQLQuery = "SELECT * from Voters WHERE IDNum = '$IDno'";
    $result = $conn->query($SQLQuery);

    if(mysqli_num_rows($result) > 0) {
      $idExists = "Please note a user with this ID Number already exists";
    } else {
      $conn->query("INSERT INTO `voters`(`FirstName`, `LastName`, `IDNum`, `Password`, `Voted`, `Address`) VALUES ('$fName','$LName','$IDno','$password', 'False','$address')");
    }
  }  else {
    $SQLQuery = "SELECT * from StaffMembers WHERE IDNum = '$IDno'";
    $result = $conn->query($SQLQuery);
    echo "hello new";
    if(mysqli_num_rows($result) > 0) {
      $idExists = "Please note a user with this ID Number already exists";
    } else {
      $conn->query("INSERT INTO `StaffMembers`(`FirstName`, `LastName`, `IDNum`, `Password`) VALUES ('$fName','$LName','$IDno','$password')");

    }
  }
}

}

function checkSafe($input) {
  $input = trim($input);
  $input = stripslashes($input);
  $input = htmlspecialchars($input);
  return $input;
}

 ?>

<html>
<head>
  <form action="<?php echo $_SESSION["PrevPage"];?>" style="float:right">
    <input type="submit" value="Return">
  </form>
  <script>
  function checkPasswords() {
    var p1 = document.getElementById("pass1").value;
    var p2 = document.getElementById("Password2").value;
    if(p1 != p2) {
      document.getElementById("errPass").innerHTML = "Passwords do not match";
      document.getElementById("regBtn").disabled = true;
    } else {
      document.getElementById("errPass").innerHTML = "";
      document.getElementById("regBtn").disabled = false;
    }
  }

  function hideReg() {
    document.getElementById("regBox").visibility = "hidden";
  }
  </script>

  <link rel="stylesheet" type="text/css" href="pageDesign.css">
  <title> Voting System 1.0</title>
  <h1>Voting System 1.0 </h1>
</head>
<body>
 <form class="votingBox" id="addV" method="post" style="float:left" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
   <h3>Register Here </h3>
First name: <input type = "text" name="vFName">
<span class="error">* <?php echo $nameErr;?></span> <br> <br>
Last name: <input type = "text" name="vLName">
<span class="error">* <?php echo $LnameErr;?></span> <br><br>
ID Number: <input type = "text" name = "IDNum">
<span class = "error">* <?php echo $idErr;?></span> <br><br>
Enter Address: <input type="text" name="addr"> <br><br>
Enter Password : <input type = "password" name = "pass1" id = "pass1"> <br> <br>
Re-enter password : <input type = "password" name = "Password2" id = "Password2" onkeyup="checkPasswords()"> <p id = "errPass" style = "color: red;"> </p><br> <br>
<br> <br>
<span class="error"> <?php echo $idExists;?></span> <br>
<input name="submit" type="submit" value="Register Voter " id="regBtn" style="padding:3px">
<input type="submit" name="newStaff" value="Register Staff">
</form>
</body>
</html>
