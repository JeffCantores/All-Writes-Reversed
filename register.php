<?php
  session_start();
  ob_start();
  require_once('services-comp/process-sign-up.php');
  //sign up function
  if(isset($_POST['fname']) && isset($_POST['mname']) && isset($_POST['lname']) && isset($_POST['suffix']) &&
      isset($_POST['uname']) && isset($_POST['pword']) && isset($_POST['houseno']) && isset($_POST['street']) && isset($_POST['brgy']) && isset($_POST['city'])){
    //call sign-up function
    signup();
    header("Location: index.php");
  }
  ob_end_flush();
?>
