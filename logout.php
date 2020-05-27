<?php
  session_start();
  try {
    @ $db = new mysqli('127.0.0.1:3306','krimhajefcee', 'incorrect', 'awr_database');
      $dbError = mysqli_connect_errno();
      if($dbError){
          throw new Exception("DB CONNECTION ERROR");
      }else{
        $selectID = 'SELECT * FROM currentuser';
        $result = $db->query($selectID);
        $cuser = $result->fetch_assoc();

        $deleteCurrentUser = 'DELETE FROM currentuser WHERE currentuser.id = '.$cuser['id'];
        $result = $db->query($deleteCurrentUser);

      //  unset($_SESSION['username']);
        session_destroy();

        header('Refresh:0; url="index.php"');
      }
  } catch (Exception $e) {
      $e->getMessage();
  }
?>
