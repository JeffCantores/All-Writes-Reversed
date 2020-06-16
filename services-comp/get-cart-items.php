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
            $selectCartProducts = 'SELECT qty, price as cartPrice, product_id FROM cart WHERE user_Id = "'.$currentID['user_id'].'" and checkedOut = 0' ;
            $resultCartProducts = $db->query($selectCartProducts);
            $cartCnt = $resultCartProducts->num_rows;
            if($cartCnt > 0){
              echo '<div class="cart-body"><div class="formcontainer">';
              $totalCart = 0;
              for($ite=0; $ite < $cartCnt; $ite++){
                $cartProducts = $resultCartProducts->fetch_assoc();

                $selectProducts =
                'SELECT img_dir, name, colors.color, prices.price
                  FROM products
                    INNER JOIN colors
      								ON colors.id = products.color_id
                    INNER JOIN prices
                      ON prices.id = products.price_id
                  WHERE products.id = "'.$cartProducts['product_id'].'"';
                $resultProduct = $db->query($selectProducts);
                $productsCnt = $resultProduct->num_rows;
                $products = $resultProduct->fetch_assoc();

                $productName = strtolower(str_replace(' ', '-', $products['name']));

                $productPrice = $products['price'];

                ?>
                  <script>
                    sessionStorage.setItem("price", <?php echo $productPrice; ?>);
                  </script>
                <?php
                // <input type="checkbox" id="'.$productName.'" name="order" class="custom-control-input" value="'.$productName.'">
                echo
                '<form method="POST"><div class="row">
                <div class="custom-control custom-checkbox col-7">
                  <img class="cart-item-img" src = "'.$products['img_dir'].'" style="height: 145px; width: 155px;">
                </div>

                <div class="details">
                    <input class="uneditable" name="name" size="20" type="text" value="'.$products['name'].'" readonly><br>
                    <input class="uneditable" name="color" size="20" type="text" value="'.$products['color'].'" readonly><br>
                    <input class="qty uneditable" name="qty" size="29" type="number" value="'.$cartProducts['qty'].'" min=1 >
                    <br>
                    <input class="price uneditable" name="price" size="20" type="text" value="'.$cartProducts['cartPrice'].'" readonly><br>
                    <button class="btn btn-dark btn-sm" formaction="services-comp/update-item.php">UPDATE</button>
                    <button class="btn btn-dark btn-sm" formaction="services-comp/remove-item.php">REMOVE</button>
                </div></div></form><br><br>';

                $totalCart += $cartProducts['cartPrice'];
              }

              echo
              '</div>
                <div class = "cartTotal">
                  <h6 class="totalCart">Total: PhP '.$totalCart.'</h6>
                </div>
              </div>
              <div class="card-footer">
                <a href="checkout-form.php">
                  <button class="btn btn-secondary" >CHECK OUT</button>
                </a>
              </div>';
            } else {
              echo
              '<div class="cart-body"></div>
              <div class="card-footer">
                <a href="checkout-form.php">
                  <button class="btn btn-secondary" disabled>CHECK OUT</button>
                </a>
              </div>';
            }
          }
        }
    } catch (Exception $e) {
      echo $e->getMessage();
    }

  }
?>
