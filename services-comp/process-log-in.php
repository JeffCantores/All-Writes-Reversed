<?php
  function login(){
    $loginUsername = $_POST['username'];
    $loginPassword = $_POST['password'];

    try {
      @ $db = new mysqli('127.0.0.1:3306','krimhajefcee', 'incorrect', 'awr_database');
        $dbError = mysqli_connect_errno();
        if($dbError){
            throw new Exception("DB CONNECTION ERROR");
        }else{
          $selectUser = 'SELECT users.id, username, password FROM users where username = "'.$loginUsername.'"';
          $result = $db->query($selectUser);
  				$resultCnt = $result->num_rows;

          $user = $result->fetch_assoc();

          if(isset($user['username'])){
            $pword = hash('md5', $loginPassword);
            if($user['password'] == $pword){
              $_SESSION['username'] = $user['username'];

              $insertCurrentUserQuery = 'INSERT INTO currentuser (user_id)
                values (?)';
              $sttmnt = $db->prepare($insertCurrentUserQuery);
              $sttmnt->bind_param("i", $user['id']);
              $sttmnt->execute();

            } else {
              $_SESSION['login-error'] = "Incorrect Password.";
            }
          } else {
              $_SESSION['login-error'] = "Username doesn't exist.";
          }
        }
    } catch (Exception $e) {
      $e->getMessage();
    }

  }
?>
