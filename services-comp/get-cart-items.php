<?php
  function getCartItems(){
    try {
      @ $db = new mysqli('127.0.0.1:3306','krimhajefcee', 'incorrect', 'awr_database');
        $dbError = mysqli_connect_errno();
        if($dbError){
            throw new Exception("DB CONNECTION ERROR");
        }else{
          $selectCurrentUserID = 'SELECT user_id from currentuser';
          $resultCurrentUserID = $db->query($selectCurrentUserID);
          $currentID = $resultCurrentUserID->fetch_assoc();
          $cnt = $resultCurrentUserID->num_rows;

          if($cnt > 0){
            $selectCartProducts = 'SELECT qty, price, product_id FROM cart WHERE user_Id = "'.$currentID['user_id'].'"';
            $resultCartProducts = $db->query($selectCartProducts);
            $cartCnt = $resultCartProducts->num_rows;

            for($ite=0; $ite < $cartCnt; $ite++){
              $cartProducts = $resultCartProducts->fetch_assoc();

              $selectProducts =
              'SELECT img_dir, name, colors.color
                FROM products
                  INNER JOIN colors
    								ON colors.id = products.color_id
                WHERE products.id = "'.$cartProducts['product_id'].'"';
              $resultProduct = $db->query($selectProducts);
              $productsCnt = $resultProduct->num_rows;
              $products = $resultProduct->fetch_assoc();

              $productName = strtolower(str_replace(' ', '-', $products['name']));

              // display here yung sa cart mismo
              // please update - create ng
              //Inayos ko siya ng kaunti - Jep
              echo
              '<div class="row" >

              <div class="custom-control custom-radio col-3">
                <input type="radio" id="'.$productName.'" name="order" class="custom-control-input" value="'.$productName.'">
                <label class="custom-control-label" for="customRadio1"><img class="cart-item-img" src = "'.$products['img_dir'].'" style="height: 135px; width: 145px;"></label>
              </div>

                <div class="details">
                  <input class="uneditable" name="name" size="20" type="text" value="'.$products['name'].'" readonly><br>
                  <input class="uneditable" name="color" size="20" type="text" value="'.$products['color'].'" readonly><br>
                  <input onchange="" id="qty" class="uneditable" name="qty" size="29" type="number" value="'.$cartProducts['qty'].'" min=1 ><br>

                  <input id="price" class="uneditable" name="price" size="20" type="text" value="'.$cartProducts['price'].'" readonly><br>
                  <button class="btn btn-outline-light btn-sm">UPDATE</button>
                  <button class="btn btn-outline-light btn-sm">REMOVE</button>
                </div>
              </div>
              <br>';
            }

          }
        }
    } catch (Exception $e) {
      echo $e->getMessage();
    }

  }
?>