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

          $updateUser = 'UPDATE cart SET checkedOut = 1 WHERE user_id ='.$result['user_id'];
          $userUpdate = $db->query($updateUser);

          header("Location: ../checkout-form.php");

          // $affectedrows = $userUpdate->affected_rows;

          // if ($affectedrows != 0) {
          //     header("Location: checkout-form.php");
          // }else {
          //   throw new Exception("Error! The Cart is empty");
          // }
    }

  }catch(Exception $e){
    echo $e->getMessage();
  }
?>
