<?php
function getSearchProduct($searchWord){
  try {
    @ $db = new mysqli('127.0.0.1:3306','krimhajefcee', 'incorrect', 'awr_database');
    $dbError = mysqli_connect_errno();
    if($dbError){
        throw new Exception("DB CONNECTION ERROR");
    }else{
      echo '<br><h5 class="category"> You searched for: '.$searchWord.'</h5>';

      $selectQuery =
      'SELECT img_dir, name, prices.price as prodPrice from products
        INNER JOIN prices
          ON prices.id = products.price_id
        WHERE name LIKE ?';
      $stmt = $db->prepare($selectQuery);
      $searchWord = '%'.$searchWord.'%';
      $stmt->bind_param('s',$searchWord);
      $stmt->execute();
      $stmt->store_result();

      $stmt->bind_result($img_dir, $name, $prodPrice);

      $count = $stmt->num_rows;

      if($count>0){
        for($ite = 0; $ite < $count; $ite++){
          $item = $stmt->fetch();
          $productName = strtolower(str_replace(' ', '-', $name));
          $prodName = str_replace('AWR ', '', $name);
          echo '<div class="row display-item">';
          echo '<a href="'.$productName.'.php"> ';
          echo '<img class="item" src = "'.$img_dir.'">';
          echo '</a><br>';
          echo '<center><h6 style="color:white;">'.$prodName.'</h6></center>';
          echo '<center><h6 style="color:white;">PhP '.$prodPrice.'.00 </h6></center>';
          echo '</div>';
        }
      } else {
        echo '<br><h5 class="category">Sorry we couldn\'t find what you\'re looking for.</h5>';
        echo '<h5 class="category">Try using a different keyword.</h5>';
      }


    }
  } catch (Exception $e){
    echo $e->getMessage();
  }
}
?>
