<?php
  require_once('exception/file-not-found-exception.php');
?>

<?php

  define('DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT']);

  function signup(){
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $suffix = $_POST['suffix'];
    $uname = $_POST['uname'];
    $pword = hash('md5', $_POST['pword']);
    $email = $_POST['email'];
    $houseno = $_POST['houseno'];
    $street = $_POST['street'];
    $brgy = $_POST['brgy'];
    $city = $_POST['city'];

    try {
      @ $db = new mysqli('127.0.0.1:3306','krimhajefcee', 'incorrect', 'awr_database');
        $dbError = mysqli_connect_errno();
        if($dbError){
            throw new Exception("DB CONNECTION ERROR");
        }else{
          //get username from db then compare to username-input
          $selectUsername = 'SELECT username from users';
          $result = $db->query($selectUsername);
  				$resultCnt = $result->num_rows;

          $unique = True;
          for($ite = 0; $ite < $resultCnt; $ite++){
            $dbUsername = $result->fetch_assoc();
            if($dbUsername['username'] == $uname){
              $unique = False;
              break;
            }
          }

          if(!$unique){
            $_SESSION['signup-error'] = "Username already taken";
          } else {
            //insert into database values
            $insertUserQuery = 'INSERT INTO users (email, password, username, firstname, middlename, lastname, suffix)
              values (?,?,?,?,?,?,?)';
            $stmt = $db->prepare($insertUserQuery);
            $stmt->bind_param("sssssss", $email, $pword, $uname, $fname, $mname, $lname, $suffix);
            $stmt->execute();

            if($stmt){
              //get the id of the newly signed up user
              $selectCurrentUserId = 'SELECT users.id from users WHERE username = "'.$uname.'"';
              $resultCurrentUserId = $db->query($selectCurrentUserId);
              $dbCurrentUserId = $resultCurrentUserId->fetch_assoc();

              $insertAddressQuery = 'INSERT INTO address (house_number, street, brgy, city, user_id)
                values (?,?,?,?,?)';
              $stmnt = $db->prepare($insertAddressQuery);
              $stmnt->bind_param("ssssi", $houseno, $street, $brgy, $city, $dbCurrentUserId['id']);
              $stmnt->execute();

              if($stmnt){
                $insertCurrentUserQuery = 'INSERT INTO currentuser (user_id)
                  values (?)';
                $sttmnt = $db->prepare($insertCurrentUserQuery);
                $sttmnt->bind_param("i", $dbCurrentUserId['id']);
                $sttmnt->execute();

                $_SESSION['username'] = $uname;

                saveLogin($uname);
                getLogin();

                if(!$sttmnt){
                  throw new Exception("insert error");
                }
              } else {
                throw new Exception("insert error");
              }

            } else {
              throw new Exception("insert error");
            }
          }


        }
    } catch (Exception $e) {
        $e->getMessage();
    }

  }


  function saveLogin($uname){

      echo "<br/>".DOCUMENT_ROOT;

      $date = date('H:i, jS F Y');
      $outputString = $date."\t"
      .$_SERVER['REMOTE_ADDR']."\t"
      .$uname." logged in\n";

      $file = @ fopen(DOCUMENT_ROOT.'/WEBPROG-FINALS/resource/user-logs.txt', 'ab'); //writing

      if (!$file) {
        echo "<p><strong>Your login could not be processed at this time.
            Please try again later.</strong></p>";
      }else{

          flock($file, LOCK_EX);
          fwrite($file, $outputString, strlen($outputString));
          flock($file, LOCK_UN);

          fclose($file);
      }
    }

    function getLogin(){

      try{
        $file = @ fopen(DOCUMENT_ROOT.'/WEBPROG-FINALS/resource/user-logs.txt', 'rb'); // reading

          if (!$file) {
            throw new FileNotFoundException('Your login could not be processed at this time.
                Please try again later.', 1);
          }else{
            while (!feof($file)){
              $order = fgets($file, 999);
              echo $order.'<br>';
            };

            fclose($file);
          }
        }catch(FileNotFoundException $fnfe){
          echo $fnfe->getMessage();
        }
      }
?>
