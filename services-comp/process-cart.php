<?php
  session_start();

  $_SESSION['checkoutprocess'] = "SET";

  header('Location: ../checkout-form.php');
?>
