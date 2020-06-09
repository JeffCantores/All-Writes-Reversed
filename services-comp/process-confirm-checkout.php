<?php

function fetchDetails($qty,$price, $productName){
  try {
    @ $db = new mysqli('127.0.0.1:3306','krimhajefcee', 'incorrect', 'awr_database');
      $dbError = mysqli_connect_errno();
      if($dbError){
          throw new Exception("DB CONNECTION ERROR");
      }else{
// Wala pang ginagawa soon
      }
  } catch (Exception $e) {
    echo $e-getMessage();
  }

}
 ?>
