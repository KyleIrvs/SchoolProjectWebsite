<?php
error_reporting(E_ERROR | E_PARSE);
if ($_POST["SignInBtn"]){
$signEmail = $_POST["emailAd"];
$SignPass = $_POST["PassSign"];
session_start();
$_SESSION["valEmail"] = $signEmail;
$_SESSION["valPass"] = $SignPass;
header("Location:.../validate-login.php");
exit();
}

if (  $_SESSION["invalid"] == "UPIncorrect") {
  $signError = "Username or password incorrect";
} else {
  if (  $_SESSION["invalid"] = "noExists") {
    $signError = "No such user exists";
  }
}
  ?>

<html>
<form class="box" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <h3>Sign In</h3>
Email Address: <input type ="text" name = "emailAd"> <br> <br>
Password: <input type="password" name="PassSign"> <br> <br>
<p class="error"> <?php echo $signError;?> </p>
<input type ="submit" name="SignInBtn" value="Sign In">


</html>
