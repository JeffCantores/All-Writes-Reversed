<?php
function getSearchProduct($searchWord){
  try {
    @ $db = new mysqli('127.0.0.1:3306','krimhajefcee', 'incorrect', 'awr_database');
    $dbError = mysqli_connect_errno();
    if($dbError){
        throw new Exception("DB CONNECTION ERROR");
    }else{
      echo '<h6> You searched : '.$searchWord.'</h6>';

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

      for($ite = 0; $ite < $count; $ite++){
        $item = $stmt->fetch();

        echo $img_dir.'<br>';

        //similar sa pag set ng items from getProductImages()
        //get name, replace space with - , change to lower case
        //see functions.php - line 108 for implementation of display
      }
    }
  } catch (Exception $e){
    echo $e->getMessage();
  }
}
?>
