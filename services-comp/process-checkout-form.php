<?php
  session_start();
  try {
    @ $db = new mysqli('127.0.0.1:3306','krimhajefcee', 'incorrect', 'awr_database');
    $dbError = mysqli_connect_errno();
    if($dbError){
        throw new Exception("DB CONNECTION ERROR");
    }else{
      if(isset($_POST['modeofpayment'])){
        $paymentMethod = $_POST['modeofpayment'];

        $selectUserID = 'SELECT user_id as userID FROM currentuser';
        $resultUserID = $db->query($selectUserID);
        $userID = $resultUserID->fetch_assoc();
        if(isset($_POST['houseNo']) && isset($_POST['streetName']) && isset($_POST['barangay']) && isset($_POST['city'])){
          $updateItem = 'UPDATE address SET house_number = "'.$_POST['houseNo'].'", street = "'.$_POST['streetName']
            .'", brgy = "'.$_POST['barangay'].'", city = "'.$_POST['city'].'" WHERE user_id = '.$userID['userID'];
          $result = $db->query($updateItem);
        }

        switch($paymentMethod){
          case 'cod':
            $_SESSION['paymentMethod'] = $paymentMethod;
            break;
          case 'cc':
            $_SESSION['paymentMethod'] = $paymentMethod;
            $_SESSION['ccno'] = $_POST['cardNo'];
            $_SESSION['expdate'] = $_POST['expdate'];
            $_SESSION['cvv'] = $_POST['cvv'];
            break;
          default:
            break;
        }
        header('Location: ../confirm-checkout.php');
      }
    }
  } catch (Exception $e) {
      $e->getMessage();
  }
?>
