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

function checkoutForm(){

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

        $selectUserAddress = 'SELECT * FROM adress WHERE user_id ='.$userID['userId'];

      } catch (Exception $e) {
          $e->getMessage();
      }
}

function getCCdetails(){

  try {
    @ $db = new mysqli('127.0.0.1:3306','krimhajefcee', 'incorrect', 'awr_database');
      $dbError = mysqli_connect_errno();
      if($dbError){
          throw new Exception("DB CONNECTION ERROR");
      }else{

}

 ?>
