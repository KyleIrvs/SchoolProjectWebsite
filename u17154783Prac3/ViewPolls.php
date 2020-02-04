<?php
$servername = "localhost";
$username = "root";
$passq = "";
$conn = mysqli_connect($servername, $username, $passq,"regMembers");

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
} else {
  $loop = mysqli_query($conn, "SELECT * FROM offmembers")
 or die (mysqli_error($conn));
 $tableHTML = "<h1> Current Polls and results </h1>";
 $tableHTML = $tableHTML . "<table class='votingBox' border=2><tr><th>Member Name</th><th>Total Votes</th></tr>";
 while ($row = mysqli_fetch_array($loop))
  {
    $memberName = $row["MemberName"];
    $tVotes = $row["TotalVotes"];
  $tableHTML = $tableHTML . "<tr><td> $memberName </td><td>$tVotes</td></tr>";
 }
 $tableHTML = $tableHTML . "</table>";
$absWinner = $conn->query("SELECT MemberName FROM offmembers WHERE TotalVotes = (SELECT MAX(TotalVotes) FROM offmembers)");
$absWinner = $absWinner->fetch_assoc();
//echo $absWinner;
}

?>

<html>
<head>
<title>View Polls Results</title>
  <link rel="stylesheet" type="text/css" href="pageDesign.css">
  <form method="post" style="float:right" action = "MainPage.php">
    <input type="submit" value="Return to home page">
  </form>


  <?php echo $tableHTML?>
<h2 class = "votingBox"> The current winner is: <?php echo $absWinner["MemberName"];?>!!  </h2>
</head>

<body>

</body>



</html>
