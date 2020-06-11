<?php
  require_once('exception/file-not-found-exception.php');
?>

<?php
  define('DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT']);

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

              saveLogin();
              getLogin();

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

  function saveLogin(){
      $loginUsername = $_POST['username'];

      echo "<br/>".DOCUMENT_ROOT;

      $date = date('H:i, jS F Y');
      $outputString = $date."\t"
      .$_SERVER['REMOTE_ADDR']."\t"
      .$loginUsername."\n";

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
