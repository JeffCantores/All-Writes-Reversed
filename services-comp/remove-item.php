<?php
  session_start();
  ob_start();
  require_once('process-delete-cart-item.php');
  if(isset($_POST['name'])){

    $prodPrice = $_POST['price'];
    $prodQty = $_POST['qty'];

    removeCartItem($_POST['name'], $prodPrice, $prodQty);
    header('Location: ../view-cart.php');
  }
  ob_end_flush();
?>
