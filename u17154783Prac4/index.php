<?php
session_start();
error_reporting(E_ERROR | E_PARSE);
 include 'header.php';

if ($_SESSION["ID"] == ""){
  include 'login.php';
  include 'signup.php';
} else {
  include 'ass3.php';
}

    include 'footer.php';  ?>
