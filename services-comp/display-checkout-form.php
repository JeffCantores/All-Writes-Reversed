<?php
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
?>
