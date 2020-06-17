<?php
  require_once('../exception/file-not-found-exception.php');
  require_once('process-confirm-checkout.php');
?>

<?php
session_start();
try {
    define('DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT']);

  @ $db = new mysqli('127.0.0.1:3306','krimhajefcee', 'incorrect', 'awr_database');
    $dbError = mysqli_connect_errno();
    if($dbError){
        throw new Exception("DB CONNECTION ERROR");
    }else{
          $selectCurrentUserID = 'SELECT * FROM currentuser';
          $cUserId = $db->query($selectCurrentUserID);
          $result = $cUserId->fetch_assoc();

          $true = 1;
          $updateUser = 'UPDATE cart SET checkedOut = '.$true.' WHERE user_id ='.$result['user_id'];
          $userUpdate = $db->query($updateUser);

          logConfirmCheckout();

          header("Location: ../order-success.php");
    }
    $db->close();
  }catch(Exception $e){
    echo $e->getMessage();
  }
?>
