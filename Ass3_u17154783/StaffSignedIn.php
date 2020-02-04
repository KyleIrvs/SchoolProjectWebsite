<?php
  session_start();
?>

<html>
<head>
  <link rel="stylesheet" type="text/css" href="pageDesign.css">
  <title> Staff Page </title>
</head>

<body>
  <h1> Welcome Staff member </h1>
  <form class="votingBox" action="Register.php">
    <input type="submit" value="Register new">
    <?php $_SESSION["PrevPage"] = "StaffSignedIn.php";?>
  </form>
    <form class="votingBox" action="SignOut.php">
      <input type="submit" value="Sign Out">
    </form>
</body>
</html>
