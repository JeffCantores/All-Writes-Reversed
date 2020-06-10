<!-- ginagawa pa lang wala pang laman -->
<?php


  // $modeOfPayment = $_POST['modeOfPayment'];
  // $cardNo = $POST['cardNo'];
  // $expDate = $POST['expDate'];
  // $cvv = $POST['cvv'];
  // $houseNo = $POST['houseNo'];
  // $stName = $POST['stName'];
  // $brgy = $POST['brgy'];
  // $city = $POST['city'];

function getAddressInfo(){

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

        //auto fill details
        echo
            '<div class="row mb-3">
              <input type="text" class="form-control col-2 mx-auto text-center" id="houseNo" placeholder="No." value = "'.$userAddress['house_number'].'" required>
              <input type="text" class="form-control col-3 mx-auto text-center" id="streetName" placeholder="Street" value = "'.$userAddress['street'].'" required>
              <input type="text" class="form-control col-4 mx-auto text-center" id="barangay" placeholder="Barangay" value = "'.$userAddress['brgy'].'" required>
              <input type="text" class="form-control col-2 mx-auto text-center" id="city" placeholder="City" value = "'.$userAddress['city'].'" required>
            </div> ';

      }
    } catch (Exception $e) {
          $e->getMessage();
      }
}

function getCCdetails(){
  //
  // $cardNo = $POST['cardNo'];
  // $expDate = $POST['expDate'];
  // $cvv = $POST['cvv'];

  try {
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

        if($resultCnt > 0){
          //if result count is greater than 0 means it is not empty therefore the details of credit cards must be auto-filled
          echo
          '   <div id="creditCardInfo" class="text-center form-group col-12  py-3" style="display:none;">
                <div class="container-fluid text-white">
                <div class="row d-flex justify-content-center">
                  <label class="p-2 ml-auto col-4 text-right float-left" for="cardNo">Credit Number</label>
                  <input type="text" class="form-control col-4 float-left mr-auto"
                  id="credit-number" pattern="\d{4}-?\d{4}-?\d{4}-?\d{4}" placeholder="xxxx-xxxx-xxxx-xxxx" value = "'.$userCC['cc_number'].'" required>
                </div>

                <div class="row d-flex justify-content-center">
                  <label class="p-2 ml-auto col-4 text-right float-left" for="exp">Expiry Date</label>
                  <input type="text" class="form-control col-4 float-left mr-auto"
                  id="expiry-date" pattern="^((0[1-9])|(1[0-2]))[\/\.\-]*((0[0-9])|(1[1-9]))$" placeholder="MM/YY" value = "'.$userCC['ccExp'].'" required>
                </div>

                <div class="row d-flex justify-content-center">
                  <label class="p-2 ml-auto col-4 text-right float-left" for="cvv">CVV</label>
                  <input pattern="\d{3}" type="text" class="form-control col-4 float-left mr-auto"
                  id="cvv" placeholder="Card Verification Value" value = "'.$userCC['cc_ccv'].'" required>
                </div>

              <p class="p-2 col-9 text-right">**For Credit Card Only**</p>
            </div>
            </div>
          ';

        }else {
          echo
          'Walang LAMAN!';
        }
    }catch (Exception $e) {
          $e->getMessage();
      }

}


 ?>
