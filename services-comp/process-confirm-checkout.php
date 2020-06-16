
<?php


  function fetchItems(){
    try {
      @ $db = new mysqli('127.0.0.1:3306','krimhajefcee', 'incorrect', 'awr_database');
        $dbError = mysqli_connect_errno();
        if($dbError){
            throw new Exception("DB CONNECTION ERROR");
        }else{
          //GET ITEMS
          $totalCart = 0;
          $selectCurrentUserID = 'SELECT user_id from currentuser';
          $resultCurrentUserID = $db->query($selectCurrentUserID);
          $currentID = $resultCurrentUserID->fetch_assoc();
          $cnt = $resultCurrentUserID->num_rows;

          if($cnt > 0){
            $selectCartProducts = 'SELECT qty, price as cartPrice, product_id FROM cart WHERE user_Id = "'.$currentID['user_id'].'" and checkedOut = 0' ;
            $resultCartProducts = $db->query($selectCartProducts);
            $cartCnt = $resultCartProducts->num_rows;
            if($cartCnt > 0){
              echo '<div class="itemsCheckout">';
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
                '<div class="row">
                  <div class="custom-control custom-checkbox col-7">
                    <img class="cart-item-img" src = "'.$products['img_dir'].'" style="height: 145px; width: 155px;">
                  </div>

                  <div class="details">
                      <input class="uneditable" name="name" size="20" type="text" value="'.$products['name'].'" readonly><br>
                      <input class="uneditable" name="color" size="20" type="text" value="'.$products['color'].'" readonly><br>
                      <input class="qty uneditable" name="qty" size="29" type="number" value="'.$cartProducts['qty'].'" min=1 readonly>
                      <br>
                      <input class="price uneditable" name="price" size="20" type="text" value="'.$cartProducts['cartPrice'].'" readonly><br>
                  </div>
                </div><hr>';

                $totalCart += $cartProducts['cartPrice'];
              }
              echo '</div>';
              echo '
                <div class="totalCheckout">
                  <h6 class="checkoutTotal">Total: PhP '.$totalCart.'.00</h6>
                </div>
              ';

            }
          }
        }
    } catch (Exception $e) {
      echo $e-getMessage();
    }
  }

  function fetchDetails(){
    try {
      @ $db = new mysqli('127.0.0.1:3306','krimhajefcee', 'incorrect', 'awr_database');
        $dbError = mysqli_connect_errno();
        if($dbError){
            throw new Exception("DB CONNECTION ERROR");
        }else{
          if($_SESSION['paymentMethod'] == 'cod'){
            echo '<h3 class="mt-2 mb-3">Cash on Delivery</h3><hr class="style">';
          } else {
            echo '<h3 class="mt-2 mb-3">Credit Card</h3>';
            echo '<h5>CC Number: <input class="uneditable" value="'.$_SESSION['ccno'].'" readonly></h5>';
            echo '<h5>Expiry Date: <input class="uneditable" value="'.$_SESSION['expdate'].'"readonly></h5>';
            echo '<h5>CVV: &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input class="uneditable" value="'.$_SESSION['cvv'].'"readonly></h5><hr class="style">';
          }

          $selectID = 'SELECT user_id FROM currentuser';
          $resultUserID = $db->query($selectID);
          $userID = $resultUserID->fetch_assoc();
          $currentUserCnt = $resultUserID->num_rows;

          if($currentUserCnt>0){
          $selectAddress = 'SELECT house_number, street, brgy, city FROM address WHERE user_id = '.$userID['user_id'];
          $resultAddress = $db->query($selectAddress);
          $userAddress = $resultAddress->fetch_assoc();
          echo '<h3 class="mt-2 mb-3">Shipping Address</h3>';
          echo '<h5>House no: &nbsp&nbsp&nbsp&nbsp<input class="uneditable" value="'.$userAddress['house_number'].'"readonly><br>';
          echo '<h5>Street: &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input class="uneditable" value="'.$userAddress['street'].'"readonly><br>';
          echo '<h5>Barangay: &nbsp&nbsp&nbsp&nbsp<input class="uneditable" value="'.$userAddress['brgy'].'"readonly><br>';
          echo '<h5>City: &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input class="uneditable" value="'.$userAddress['city'].'"readonly><br>';

          }
        }
    } catch (Exception $e) {
      echo $e-getMessage();
    }
  }

// LOGS FUNCTION - JEP (Aayusin ko pa to once ma-complete yung function na ginagawa niyo. Hehehez~)

function logConfirmCheckout(){
    $loginUsername = $_SESSION['username']; //fetch username code here

    echo "<br/>".DOCUMENT_ROOT;


    $date = date('H:i, jS F Y');
    $outputString = $date."\t"
    .$_SERVER['REMOTE_ADDR']."\t"
    .$loginUsername."\tchecked out order (total price: PHP "
    .$totalCart.")\n";

    $file = @ fopen(DOCUMENT_ROOT.'/WEBPROG-FINALS/resource/user-logs.txt', 'ab'); //writing

    if (!$file) {
      echo "<p><strong>Your order could not be processed at this time.
          Please try again later.</strong></p>";
    }else{

        flock($file, LOCK_EX);
        fwrite($file, $outputString, strlen($outputString));
        flock($file, LOCK_UN);

        fclose($file);
    }
  }

  function readLog(){

    try{
      $file = @ fopen(DOCUMENT_ROOT.'/WEBPROG-FINALS/resource/user-logs.txt', 'rb'); // reading

        if (!$file) {
          throw new FileNotFoundException('Your order could not be processed at this time.
              Please try again later.', 1);
        }else{
          while (!feof($file)){
            $order = fgets($file, 999);
            echo $order.'<br>';
          };

          fclose($file);
        }
      }catch(FileNotFoundException $fnfe){
        echo $fnfe->getMessage();
      }
    }


 ?>
