<?php
  session_start();
  require_once('services-comp/process-log-in.php');
  //sign up function
  if(isset($_POST['username']) && isset($_POST['password'])){
    //call log-in function
    login();
    header("Location: index.php");
  }

?>
