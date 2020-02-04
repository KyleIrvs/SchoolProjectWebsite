<?php include 'dbconfig.php' ?>

<html>
<link rel="hotbar Icon" type="image/x-icon" src="favicon.ico"/>
<script src="allScript.js"></script>
<link rel="stylesheet" type="text/css" href="stylingPage.css">
<center>
  <img style="width:150px;height:150px;" src="CCsLogo.png" alt="CryptoCurrentlys Logo"/>
  <h1 style="color:#2E2E2E">Practical 4</h1>
</center>

 <ul>
<li><a href="AboutMe.html">About me</a></li>
<li class="dropdown">
  <a href="javascript:void(0)" class="dropbtn">Practicals</a>
  <div class="dropdown-content">
  <!-- Remember to change the next one for wheatley server!-->
  <a href="Practical1.html" >Practical 1</a>
  <a href="Practical2.html">Practical 2</a>
  <a href="Practical3.php">Practical 3</a>
  <a href="#" onclick="onPage()" >Practical 4</a>
  <a href="#" onclick="return show('underCon','homePage');">Practical 5</a>
  </div>
  <script>
  function onPage() {
    window.alert("You are already on practical 4");
  }
  </script>
</li>
</ul>
</html>
