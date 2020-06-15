<?php
  require_once('exception/file-not-found-exception.php');
?>

<?php
  session_start();
  ob_start();
  define('DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT']);

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

        saveLogout();
        getLogout();

        session_destroy();



        header('Refresh:0; url="index.php"');
      }
  } catch (Exception $e) {
      $e->getMessage();
  }


  function saveLogout(){
      $loginUsername = $_SESSION['username'];

      echo "<br/>".DOCUMENT_ROOT;

      $date = date('H:i, jS F Y');
      $outputString = $date."\t"
      .$_SERVER['REMOTE_ADDR']."\t"
      .$loginUsername." was logged out\n";

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

    function getLogout(){

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

    ob_end_flush();
?>
