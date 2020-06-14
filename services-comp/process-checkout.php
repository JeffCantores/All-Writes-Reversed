<?php
try {
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

          header("Location: ../order-success.php");
    }

  }catch(Exception $e){
    echo $e->getMessage();
  }
?>
