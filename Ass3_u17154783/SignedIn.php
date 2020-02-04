
<html>

<?php
  session_start();
  $IDno = $_SESSION["ID"];
  error_reporting(E_ERROR | E_PARSE);
  $servername = "localhost";
  $username = "root";
  $passq = "";
  $conn = mysqli_connect($servername, $username, $passq,"regMembers");

  if (!$conn) {
    echo "Unsuccesful";
  } else {
    $SQLQuery = "SELECT * from Voters WHERE IDNum = '$IDno'";
    $result = $conn->query($SQLQuery);
    $result = $result->fetch_assoc();
    $userName = "Hello there " . $result["FirstName"] . " " . $result["LastName"];

    if($result["Voted"]) {
      $votedRes = "You have voted, you may not voted again";
    } else {
      $votedRes = "You have not voted, would you like to vote now?";
    }
  }
  if($_POST["updateAdd"]){

    $newAdd = $_POST["newAddr"];
    $conn->query("UPDATE `voters` SET Address = '$newAdd' WHERE IDNum = '$IDno'");
  }



if($_POST["chooseVote"]){
  $checkVote = $conn->query("SELECT * FROM voters WHERE IDNum = '$IDno'");
  $checkVote = $checkVote->fetch_assoc();
   if($checkVote["Voted"] == 0){
     $memName = $_POST["offName"];
     $conn->query("UPDATE `voters` SET Voted = '1' WHERE IDNum = '$IDno'");
     $conn->query("UPDATE `offmembers` SET `TotalVotes`= TotalVotes + 1 WHERE MemberName = '$memName'");
   } else {
     $vErr = "I'm sorry but you cannot vote again";
   }
}

?>

<head>
  <title> Welcome </title>
<link rel="stylesheet" type="text/css" href="pageDesign.css">
<script>
//insert script
</script>
<div class ="votingBox">
<h1> <?php echo $userName?></h1>
</div>
<form class="votingBox" action="SignOut.php">
  <input type="submit" value="Sign Out">
</form>


</head>
<body>
  <form class="votingBox" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    Update Address:
    <input type="text" name="newAddr">
    <input type="submit" name="updateAdd" value="Update Address">
  </form>
  <form class="votingBox" id="voteBox" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    Select Someone to vote for: <br>
    <?php
    $loop = mysqli_query($conn, "SELECT * FROM offmembers")
   or die (mysqli_error($conn));

   while ($row = mysqli_fetch_array($loop))
    {
      $memberName = $row["MemberName"];
      $tVotes = $row["TotalVotes"];
      echo "<input type='radio'" .  "name= 'offName'" .  " value=" . $memberName .  ">" .$memberName. "<br><br>";
   }
    ?>
    <span class="error"> <?php echo $vErr;?></span> <br><br>
<input type="submit" name="chooseVote" value="Finalise Vote">

  </form>

</body>



</html>
