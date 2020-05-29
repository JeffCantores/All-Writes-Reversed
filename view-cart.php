<?php
      require_once('services-comp/retrieve-item.php');
      require_once('model/product-class.php');
      require_once('view-comp/header.php');
?>

<?php

try {
  @ $db = new mysqli('127.0.0.1:3306','krimhajefcee', 'incorrect', 'awr_database');
    $dbError = mysqli_connect_errno();
    if($dbError){
        throw new Exception("DB CONNECTION ERROR");
    }else{
        $selectQuery = 'SELECT * FROM cart';
        $results = $db->query($selectQuery);
        $result = $results->fetch_all();


                echo "<br>";
                echo "<div class='container jeff >";
                echo "<div class='view-cart-items'>";
                echo "<div class='title'>";
                echo " <strong><i>YOUR CART</i></strong>";
                echo "</div>";

                echo "<div class='body'>";
                  echo "<div class='cart-items'>";

                  // while ($row = $result->fetch_assoc()) {
                  //     // do what you need.
                  // }
                    echo "(ITEMS FOR CHECKOUT GOES HERE)";
                  echo "</div>";
                echo "</div>";

                echo "<br>";
                echo "<div class='fixed-bottom footer'>";
                    echo "<span class='total-price'><b> Total:</b> >9999999< </span>";
                echo "<br><br>";
                echo "<div class='buttons'>";
                echo " <div class='select-all'><input type='checkbox' class='select-all-items' id='select-all' onclick='checkboxFunction()'>";
                    echo "<strong>SELECT ALL</strong>";
                    echo "<button class='btn btn-dark btn-sm' id='check-out-button' onclick='purchaseFunction()'><strong>CHECKOUT</strong></button>";
                echo "</div>";
              echo "</div>";
            echo "</div>";
          echo "</div>";
        echo "</div>";
      echo "<br>";
    }

} catch (\Exception $e) {
  echo $e->getMessage();
}


 ?>

<?php require_once('view-comp/footer.php') ?>
