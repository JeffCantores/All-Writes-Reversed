<?php
  session_start();
  require_once('services-comp/process-add-to-cart.php');
  //sign up function
  if(isset($_POST['name']) && isset($_POST['color']) && isset($_POST['qty']) && isset($_POST['price'])){
    //call log-in function
    $prodName = $_POST['name'];
    $prodPrice = $_POST['price'];
    $prodQty = $_POST['qty'];
    addToCart($prodQty, $prodPrice, $prodName);

    $productName = strtolower(str_replace(' ', '-', $prodName));
  //  header("Location: ".$productName.".php");
  }
?>
