<?php
  session_start();

  $_SESSION['checkoutprocess'] = "SET";
  echo 'process cart';
  header('Location: ../checkout-form.php');
?>
