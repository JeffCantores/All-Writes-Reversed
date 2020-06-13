<?php
require_once('view-comp/header.php');
require_once('functions/functions.php')
?>

<div class="content py-5">
<div class="container">
  <div class="card">
    <div class="card-header text-center">
      <h1 class="text-uppercase font-weight-bold">Confirm Checkout</h1>
    </div>
    <div class="card-body bg-dark px-5">

      <?php
        define('FIELDS', array(
          'pID' => 'cart.product_id',
          'pName' => 'products.name',
          'pColor' => 'products.color_id',
          'pPrice' => 'products.price_id',
          'pQuantity' => 'cart.qty',
          'pPhoto' => 'img_dir'
        ));

        // $paymentMethod = $POST['paymentMethod'];
        // $cardNo = $POST['cardNo'];
        // $expDate = $POST['expDate'];
        // $cvv = $POST['cvv'];
        // $houseNo = $POST['houseNo'];
        // $streetName = $POST['streetName'];
        // $barangay = $POST['barangay'];
        // $city = $POST['city'];

        //
        // try {
        //   if (!$houseNo || !$streetName || !$barangay || !$city) {
        //     throw new Exception('You have not entered shipping details. Please go back and try again.', 1);
        //   }

          try {
            @ $db = new mysqli('127.0.0.1:3306','krimhajefcee', 'incorrect', 'awr_database');
              $dbError = mysqli_connect_errno();
              if($dbError){
                  throw new Exception("DB CONNECTION ERROR");
              }else{

          //get the user id from the user db
                $selectUserID = 'SELECT users.id as userID FROM users WHERE username = "'.$_SESSION['username'].'"';
                $resultUserID = $db->query($selectUserID);
                $userID = $resultUserID->fetch_assoc();
                $cnt = $resultUserID->num_rows;

          //get address details
                $selectUserAddress = 'SELECT house_number, street, brgy, city FROM address WHERE user_id ='.$userID['userID'];
                $resultUserAddress = $db->query($selectUserAddress);
                $userAddress = $resultUserAddress->fetch_assoc();

          //insert cc details
                $queryCC = 'INSERT INTO cc_details (cc_number, cc_exp, cc_ccv, user_id) VALUES (?, ?, ?, ?)';
                $stmtCC = $db->prepare($queryCC);
                $stmtCC->bind_param("sssi", $cardNo, $expdate, $cvv, $userID['userID']);
                $stmtCC->execute();
                $affectedRowsCC = $stmtCC->affected_rows;

          //fetch cart Items
            $selectCartProducts = 'SELECT qty, price as cartPrice, product_id FROM cart WHERE user_Id = "'.$userID['userID'].'"';
            $resultCartProducts = $db->query($selectCartProducts);
            $cartCnt = $resultCartProducts->num_rows;



          /////////////////////////////////////////
          echo '
          <div class="row">
                <div class="col-sm-3 col-md-6 col-lg-6 mh-100 overflow" >
                  <h2 class="text-white font-weight-bold">Items</h2>

                    ';

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
                    for($ite2 = 0; $ite2 < $productsCnt; $ite2++){
                        echo ' <div class="row">

                            <div class="col-6 float-left p-2">
                              <img class="img-fluid rounded-lg" src="images/shirt.png">
                            </div>


                            <div class="col float-center pt-4 pl-3">
                              <!-- Information ng item - NAME-->
                              <div class="row">
                                <div class="col my-2">
                                  <h7 class="font-weight-bold text-white">Name :</h7>
                                  <span class="text-white px-1 rounded-lg">'.$productName['name'].'</span>

                                </div>
                              </div>
                              <!-- Information ng item - COLOR-->
                              <div class="row">
                                <div class="col my-2">
                                  <h7 class="font-weight-bold text-white">Color :</h7>
                                  <span class="text-white px-1 rounded-lg">Light Gray</span>
                                </div>
                              </div>
                              <!-- Information ng item - PRICE-->
                              <div class="row">
                                <div class="col my-2">
                                  <h7 class="font-weight-bold text-white">Price :</h7>
                                  <span class="text-white px-1 rounded-lg">'.$productPrice['price'].'</span>
                                </div>
                              </div>
                              <!-- Information ng item - QUANTITY-->
                              <div class="row">
                                <div class="col my-2">
                                  <h7 class="font-weight-bold text-white">Quantity :</h7>
                                  <span class=" text-white px-1 rounded-lg">10</span>
                                </div>
                              </div>
                            </div>
                          </div>';

                          }}


                          echo'
                          </div>
                                  <div class="col-sm-9 col-md-6 col-lg-6">
                                    <h2 class="text-white font-weight-bold text-center">Payment Method</h2>
                                    <div class="row d-flex justify-content-center">
                                        <div class="col-7 bg-light text-dark  text-center rounded-lg p-1 mt-3 mb-4">Cash on delivery</div>
                                    </div>
                                    <h2 class="text-white font-weight-bold text-center">Shipping Address</h2>
                                    <div class="row d-flex justify-content-center">
                                        <div class="col-4 bg-light text-dark text-center rounded-lg mx-1 mt-3 p-1">'.$userAddress['house_number'].'</div>
                                        <div class="col-4 bg-light text-dark text-center rounded-lg mx-1 mt-3 p-1">'.$userAddress['street'].'</div>
                                        <div class="col-4 text-white text-center rounded-lg mx-1">Street No.</div>
                                        <div class="col-4 text-white text-center rounded-lg mx-1">Street Name</div>
                                        <div class="col-4 bg-light text-dark text-center rounded-lg mx-1 mt-3 p-1">'.$userAddress['brgy'].'</div>
                                        <div class="col-4 bg-light text-dark text-center rounded-lg mx-1 mt-3 p-1">'.$userAddress['city'].'</div>
                                        <div class="col-4 text-white text-center rounded-lg mx-1">Barangay</div>
                                        <div class="col-4 text-white text-center rounded-lg mx-1">City</div>
                                    </div>
                                    <div class="row d-flex justify-content-center">
                                        <div class="col-4 bg-light text-dark  text-center rounded-lg p-1 mt-3">Sample Amount</div>
                                    </div>
                                    <div class="row d-flex justify-content-center">
                                      <h7 class="text-white text-center">Total Amount</h7>
                                    </div>

                                  </div>
                                </div>
                                ';
          /////////////////////////////////////////
          // In the address section it is from the data from check out form which can be the auto fill provided by the function autoFillAddressInfo() or the input of the user
          // but in this code, it's just the address from the sign up which is not good.


        // } catch (Exception $e) {
        //   echo $e->getMessage();
        // }
      }}catch (Exception $e) {
          echo $e->getMessage();
        }
      ?>

    </div>
    <div class="card-footer d-flex justify-content-around">
      <a class="btn btn-dark text-uppercase" href="checkout-form.php">Go Back</a>
      <a class="btn btn-dark text-uppercase" href="#">Confirm</a>
    </div>
  </div>
</div>
</div>


<?php
require_once('view-comp/footer.php');
?>
