<html>
<head>
  <title>Voting System 1.0 </title>
  <?php error_reporting(E_ERROR | E_PARSE);?>
  <link rel="stylesheet" type="text/css" href="pageDesign.css">


  <?php
if ($_POST["SignInBtn"]){
  $signID = $_POST["IDNumSign"];
  $SignPass = $_POST["PassSign"];
  $servername = "localhost";
  $username = "root";
  $password = "";

// Create connection
  $conn = mysqli_connect($servername, $username, $password,"regMembers");

// Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  } else {
    $SQLQuery1 = "SELECT * from Voters WHERE IDNum = '$signID'";
    $SQLQuery2 = "SELECT * from StaffMembers Where IDnum= '$signID'";
    $result1 = $conn->query($SQLQuery1);
    $result2 = $conn->query($SQLQuery2);
    $signError = "";
    if(mysqli_num_rows($result1) > 0 || mysqli_num_rows($result2) > 0) {
      $result1 = $result1->fetch_assoc();
      $result2 = $result2->fetch_assoc();
      if($signID == "admin" && $result2["Password"] == $SignPass) {
        session_start();
        $_SESSION["ID"] = $signID;
        header("Location:adminPage.php");
        exit();
      }
      if ($result1["IDNum"] == $signID && $result1["Password"] == $SignPass) {
        //change to other page
        session_start();
        $_SESSION["ID"] = $signID;
        header("Location:SignedIn.php");
        exit();
        $signError = "";
      } else if ($result2["IDNum"] == $signID && $result2["Password"] == $SignPass) {
        session_start();
        $_SESSION["ID"] = $signID;
        header("Location:StaffSignedIn.php");
        exit();
        $signError = "";
      }else {
        $signError= "ID or password does not match";
      }
    } else {
      $signError = "No such user exists";
    }
  }
}
  //check if staff exists and login, create other php page for staff to register etc. find a way to tally votes and do view polls page

  ?>
</head>
<h1>Voting System 1.0</h1>
<body onload="hideReg()">

    <span> </span>
<span>
  <form class="votingBox" id="SignIn" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <h3>Sign In</h3>
  ID Number: <input type ="text" name = "IDNumSign"> <br> <br>
  Password: <input type="password" name="PassSign"> <br> <br>
  <p class="error"> <?php echo $signError;?> </p>
  <input type ="submit" name="SignInBtn" value="Sign In">

</form>
</span>
  <div class="votingBox" id="SelectNew">
  <a href="ViewPolls.php">View Polls</a>
  </div>

</div>

</body>
<?php
$_POST[] = array();
?>

</html>
