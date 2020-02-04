<?php
session_start();
error_reporting(E_ERROR | E_PARSE);
if (!$_SESSION["ID"] == "admin") {
  $tableHTML1 = "<h1 class='votingBox' >You are not an admin user, you will not be able to view the info </h1>";
  $tableHTML2 = "";
  $delBtn = "You do not have permission to delete data";
} else {
$servername = "localhost";
$username = "root";
$passq = "";
$conn = mysqli_connect($servername, $username, $passq,"regMembers");
$loop = mysqli_query($conn, "SELECT * FROM voters")
   or die (mysqli_error($conn));
   $tableHTML1 = "<form method='post' style='float:right' action = 'adminPage.php'>
     <input type='submit' value='Return to admin page'>
   </form><br>";
$tableHTML1 = $tableHTML1 . "<h1> All Voters Personal Information</h1> <br> <table class='votingBox' border=3><tr><th>Voter Name</th><th>Voter Surname</th><th>ID Number</th><th>User Password</th><th>Has Voted</th><th>Address</th></tr>";

while ($row = mysqli_fetch_array($loop))
{
  $uFName = $row['FirstName'];
  $uLName = $row['LastName'];
  $uIDNum = $row['IDNum'];
  $uPassword = $row['Password'];
  if ($row['Voted'] == 1){
    $uVoted = "Yes";
  } else {
    $uVoted = "No";
  }
  $uAddress = $row["Address"];
  $tableHTML1 = $tableHTML1 . "<tr><td> $uFName </td><td> $uLName</td><td>$uIDNum</td><td>$uPassword</td><td>$uVoted</td><td>$uAddress</td></tr>";
}
$tableHTML1 = $tableHTML1 . "</table>";
$tableHTML2 = "<h1> All Staff Personal Information</h1> <br> <table class='votingBox' border=3><tr><th>Staff User Name</th><th>Staff User Surname</th><th>ID Number</th><th>Staff User Password</th></tr>";
$loop = mysqli_query($conn, "SELECT * FROM staffmembers")
   or die (mysqli_error($conn));
while ($row = mysqli_fetch_array($loop))
{
  $uFName = $row['FirstName'];
  $uLName = $row['LastName'];
  $uIDNum = $row['IDNum'];
  $uPassword = $row['Password'];
  if(!$uIDNum == "admin"){
  $tableHTML2 = $tableHTML2 . "<tr><td> $uFName </td><td> $uLName</td><td>$uIDNum</td><td>$uPassword</td></tr>";
}
}
$tableHTML2 = $tableHTML2 . "</table><br><br>";
$delBtn = "<h2> If you would like to delete a user, please enter their ID number below and press the button.</h2><br>
<input type='text' name='dUserName'> <br> <br>
<input type='submit' name='DelUser' value='Delete User'>";
if($_POST["DelUser"]){
  if ($_POST["DelUser"] == "admin") {
    $err1 = "Cannot Delete admin user";
  } else {
  $usrName = $_POST["dUserName"];
  $vQuery = "SELECT * FROM voters WHERE IDNum = $usrName";
  $sQuery = "SELECT * FROM staffmembers WHERE IDNum = $usrName";
  $vResult = $conn->query($vQuery);
  $sResult = $conn->query($sQuery);

  if(mysqli_num_rows($vResult) > 0 || mysqli_num_rows($sResult) > 0 ){
    if (mysqli_num_rows($vResult) > 0) {
      $conn->query("DELETE from voters WHERE IDNum = $usrName");
      header("Refresh:0");
    } else {
      $conn->query("DELETE from staffmembers WHERE IDnum = $usrName");
      header("Refresh:0");
    }
  } else {
  $err1 = "No such user exists";
  }
}

}
}

?>
<html>
  <title>All Personal Information</title>
  <form method="post" style="float:right" action = "SignOut.php">
    <input type="submit" value="Sign out and return to home page">
  </form>

  <link rel="stylesheet" type="text/css" href="pageDesign.css">
  <?php echo $tableHTML1;
        echo $tableHTML2;?>
<form class='votingBox' method='post' action='<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>'>
  <?php echo $delBtn. "<br>";
  echo "<h2 style='color:#FF0000'>" . $err1. "</h2>"?>
</form>

</html>
