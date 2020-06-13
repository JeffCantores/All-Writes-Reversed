<?php
session_start();
function autoFillAddressInfo(){

  // Access to db
  try {
    @ $db = new mysqli('127.0.0.1:3306','krimhajefcee', 'incorrect', 'awr_database');
      $dbError = mysqli_connect_errno();
      if($dbError){
          throw new Exception("DB CONNECTION ERROR");
      }else{
        //get username from db, get user adress details
        $selectUserID = 'SELECT users.id as userID FROM users WHERE username = "'.$_SESSION['username'].'"';
        $resultUserID = $db->query($selectUserID);
        $userID = $resultUserID->fetch_assoc();

        $selectUserAddress = 'SELECT house_number, street, brgy, city FROM address WHERE user_id ='.$userID['userID'];
        $resultUserAddress = $db->query($selectUserAddress);
        $userAddress = $resultUserAddress->fetch_assoc();

        //auto fill details in address
        echo
            '<div class="row mb-3">
              <input type="text" class="form-control col-2 mx-auto text-center" id="houseNo" name="houseNo" placeholder="No." value = "'.$userAddress['house_number'].'" required>
              <input type="text" class="form-control col-3 mx-auto text-center" id="streetName" name="streetName" placeholder="Street" value = "'.$userAddress['street'].'" required>
              <input type="text" class="form-control col-4 mx-auto text-center" id="barangay" name="barangay" placeholder="Barangay" value = "'.$userAddress['brgy'].'" required>
              <input type="text" class="form-control col-2 mx-auto text-center" id="city" name="city" placeholder="City" value = "'.$userAddress['city'].'" required>
            </div> ';

      }
    } catch (Exception $e) {
          $e->getMessage();
      }
}

function getGartItemsForCheckout(){
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
          $selectCartProducts = 'SELECT qty, price as cartPrice, product_id FROM cart WHERE user_Id = "'.$currentID['user_id'].'"';
          $resultCartProducts = $db->query($selectCartProducts);
          $cartCnt = $resultCartProducts->num_rows;

          echo '<form action="../checkout-form.php" method="POST">';
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

            // display here yung sa cart mismo
            // please update - create ng
            //Inayos ko siya ng kaunti - Jep
            // Make container scrollable
            // if user clicked the same product, it will just add another quantity in the CART

            echo
            '<form action="services-comp/update-item.php" method="POST">
              <div class="row">
              <div class="custom-control custom-checkbox col-7">
                <input type="checkbox" id="'.$productName.'" name="order" class="custom-control-input" value="'.$productName.'">
                <label class="custom-control-label" for="'.$productName.'"><img class="cart-item-img" src = "'.$products['img_dir'].'" style="height: 145px; width: 155px;"></label>
              </div>

                  <div class="details">

                      <input class="uneditable" name="name" size="20" type="text" value="'.$products['name'].'" readonly><br>
                      <input class="uneditable" name="color" size="20" type="text" value="'.$products['color'].'" readonly><br>
                      <input onchange="computePrice()" id="qty" class="uneditable" name="qty" size="29" type="number" value="'.$cartProducts['qty'].'" min=1 ><br>

                      <input id="price" class="uneditable" name="price" size="20" type="text" value="'.$cartProducts['cartPrice'].'" readonly><br>
                      <button class="btn btn-dark btn-sm" formaction="services-comp/update-item.php">UPDATE</button>
                      <button class="btn btn-dark btn-sm" formaction="services-comp/remove-item.php">REMOVE</button>

                  </div>
                </div>
            </form>
            <br><br>';
          }
          echo '</form>';
        }
      }
  } catch (Exception $e) {
    echo $e->getMessage();
  }

}



//Disregard muna tong function na to, sabog eh
function getCCdetails(){

  $cardNo = $POST['cardNo'];
  $expDate = $POST['expDate'];
  $cvv = $POST['cvv'];

  try {
    if(!$cardNo || !$expDate || !$cvv){
      throw new Exception('Credit Card details are not complete. Please Try Again.');
    }
    @ $db = new mysqli('127.0.0.1:3306','krimhajefcee', 'incorrect', 'awr_database');
      $dbError = mysqli_connect_errno();
      if($dbError){
          throw new Exception("DB CONNECTION ERROR");
      }else{
        //get matching username from db as key then fetch cc details
        $selectUserID = 'SELECT users.id as userID FROM users WHERE username = "'.$_SESSION['username'].'"';
        $resultUserID = $db->query($selectUserID);
        $userID = $resultUserID->fetch_assoc();

        $selectUserCC = 'SELECT cc_number, cc_exp, cc_ccv FROM cc_details WHERE user_id ='.$userID['userID'];
        $resultUserCC = $db->query($selectUserCC);
        $userCC = $resultUserCC->fetch_assoc();
        $resultCnt = $resultUserCC->num_rows;
      }
      //
      if($resultCnt < 1){
        $queryCC = 'INSERT INTO cc_details (cc_number, cc_exp, cc_ccv, user_id) VALUES (?, ?, ?, ?)';
        $stmtCC = $db->prepare($queryCC);
        $stmtCC->bind_param("sssi", $cardNo, $expdate, $cvv, $userID['userID']);
        $stmtCC->execute();
        $affectedRowsCC = $stmtCC->affected_rows;

      }if($affectedRowsCC > 0){
          echo $affectedRowsCC." credit card details inserted into database.";
        }else {
          throw new Exception("Error: The credit card details was not added.");
        }

      $stmt->close();

      }catch (Exception $e){
        echo $e->getMessage();
      }
      //
}




 ?>
