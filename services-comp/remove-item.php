<?php
  session_start();
  require_once('../functions/functions.php');
  if(isset($_POST['name'])){
    removeCartItem($_POST['name']);
    header('Location: ../view-cart.php');
  }
?>
