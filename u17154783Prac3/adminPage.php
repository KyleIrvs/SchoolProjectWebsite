<?php
  session_start();
  error_reporting(E_ERROR | E_PARSE);
  if($_SESSION["ID"] != "admin"){
    echo "<center> <h1>You do not have admin rights</h1></center>";
    header( "refresh:1; url=mainPage.php" );
    exit;
  }
  if($_POST["newOffical"]){
    $newName = $_POST["OffName"];
    if(empty($newName)) {
      $err1 = "Please make sure to enter a valid name <br><br>";
    } else if(!preg_match("/^[a-zA-Z]*$/",$newName)){
      $err1 ="Names of officials can only contain letters of the alphabet<br><br>";
    } else {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $err1 = "";
      $conn = mysqli_connect($servername, $username, $password,"regMembers");
      if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
      } else {
        $SQLQuery = "SELECT * from offmembers WHERE MemberName = '$newName'";
        $result = $conn->query($SQLQuery);
        if(mysqli_num_rows($result) > 0 ){
          $err1 = "Official with this name already exists<br><br>";
        } else {
            $conn->query("INSERT INTO `offmembers`(`MemberName`, `TotalVotes`) VALUES ('$newName','0')");
            $err1="New Official has succesfully been entered<br><br>";
        }
    }
  }
}

  ?>

  <html>
  <h1> Admin Page </h1>
  <head>
    <title>Admin Page</title>
    <link rel="stylesheet" type="text/css" href="pageDesign.css">
  </head>
  <form class="votingBox" action="SignOut.php">
    <input type="submit" value="Sign Out">
  </form>
 <form class="votingBox" action="Register.php">
   <input type="submit" value="Register new">
   <?php $_SESSION["PrevPage"] = "adminPage.php";?>
 </form>
 <form class="votingBox" method="post" action= "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
   Enter new official name: <input type="text" name="OffName"><br><br>
   <span class = "error"><?php echo $err1;?> </span>
   <input type="submit" name="newOffical" value = "Register new official">
 </form>
 <form class="votingBox" action="allPersonal.php">
   <input type="submit" value="View All Info">
 </form>
  </html>
