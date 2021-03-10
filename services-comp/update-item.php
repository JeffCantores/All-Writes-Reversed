<?php
  session_start();
  require_once('process-update-cart-item.php');
  if(isset($_POST['name']) && isset($_POST['qty']) && isset($_POST['price'])){

    $prodName = $_POST['name'];
    $prodPrice = $_POST['price'];
    $prodQty = $_POST['qty'];

    updateCartItem($prodName, $prodPrice, $prodQty);
    header('Location: ../view-cart.php');
  }
?>
