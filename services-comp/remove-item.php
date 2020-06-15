<?php
  session_start();
  require_once('../functions/functions.php');
  if(isset($_POST['name'])){

    $prodPrice = $_POST['price'];
    $prodQty = $_POST['qty'];

    removeCartItem($_POST['name'], $prodPrice, $prodQty);
    header('Location: ../view-cart.php');
  }
?>
