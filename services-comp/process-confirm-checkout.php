<?php
  define('DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT']); // DEFINING THE DOCUMENTATION FOR LOG FILE - JEP (Huwag burahin)

  function fetchDetails($qty,$price, $productName){
    try {
      @ $db = new mysqli('127.0.0.1:3306','krimhajefcee', 'incorrect', 'awr_database');
        $dbError = mysqli_connect_errno();
        if($dbError){
            throw new Exception("DB CONNECTION ERROR");
        }else{
  // Wala pang ginagawa soon
        }
    } catch (Exception $e) {
      echo $e-getMessage();
    }

  }








// LOGS FUNCTION - JEP (Aayusin ko pa to once ma-complete yung function na ginagawa niyo. Hehehez~)

function logConfirmCheckout(){
    $loginUsername = $_SESSION['username']; //fetch username code here
    $prodName = $_POST['name'];
    $prodPrice = $_POST['price'];
    $prodQty = $_POST['qty'];

    echo "<br/>".DOCUMENT_ROOT;


    $date = date('H:i, jS F Y');
    $outputString = $date."\t"
    .$_SERVER['REMOTE_ADDR']."\t"
    .$loginUsername."\tbought (productName: "
    .$prodName."\tqty: "
    .$prodQty."\tprice: PHP "
    .$prodPrice.")\n";

    $file = @ fopen(DOCUMENT_ROOT.'/WEBPROG-FINALS/resource/user-logs.txt', 'ab'); //writing

    if (!$file) {
      echo "<p><strong>Your order could not be processed at this time.
          Please try again later.</strong></p>";
    }else{

        flock($file, LOCK_EX);
        fwrite($file, $outputString, strlen($outputString));
        flock($file, LOCK_UN);

        fclose($file);
    }
  }

  function readLog(){

    try{
      $file = @ fopen(DOCUMENT_ROOT.'/WEBPROG-FINALS/resource/user-logs.txt', 'rb'); // reading

        if (!$file) {
          throw new FileNotFoundException('Your order could not be processed at this time.
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
