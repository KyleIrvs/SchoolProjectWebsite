<?php

    if ($_POST["SignUpBtn"]){
      session_start();
      $_SESSION["uName"] = $_POST["uName"];
      $_SESSION["emailAdd"] = $_POST["emailAdd"];
      $_SESSION["cellNo"] = $_POST["cellNo"];
      $_SESSION["uPass1"] = $_POST["uPass1"];
      $_SESSION["uPass2"] = $_POST["uPass2"];
      header("Location:../u17154783/footer.php");
    }
    if($_SESSION["invalidity"] == true) {
      $passErr = $_SESSION["MainError"];
    } else {
      $successReg = $_SESSION["SuccessReg"];
    }

?>

<html>
<link rel="stylesheet" type="text/css" href="stylingPage.css">
<form class='BoxInput' id="SignIn" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <h3>Sign Up</h3>
    Name: <input type ="text" name = "uName"> <br> <br>
    Email Address: <input type="text" name= "emailAdd"><br><br>
    Cell Number: <input type="text" name="cellNo"><br><br>
    Password: <input type="password" name="uPass1"><br><br>
    Re-Enter Password: <input type="password" name="uPass2"><br><br>
    <h3 class="error" style="color:red;"> <?php echo $passErr;?></h3> <br>
    <p class="succ"><?php echo $successReg;?></p> <br>
  <input type ="submit" name="SignUpBtn" value="Sign Up">
</form>
</html>
