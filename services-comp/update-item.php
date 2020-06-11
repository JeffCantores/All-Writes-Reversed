<?php
  session_start();
  require_once('process-update-cart-item.php');
  if(isset($_POST['name'])){
    updateCartItem($_POST['name'], $_POST['qty'], $_POST['price']);
    header('Location: ../view-cart.php');
  }
?>
