<?php
  define('DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT']); // DEFINING THE DOCUMENTATION FOR LOG FILE - JEP (Huwag burahin)

  function fetchItems(){
    try {
      @ $db = new mysqli('127.0.0.1:3306','krimhajefcee', 'incorrect', 'awr_database');
        $dbError = mysqli_connect_errno();
        if($dbError){
            throw new Exception("DB CONNECTION ERROR");
        }else{
          //GET ITEMS
        }
    } catch (Exception $e) {
      echo $e-getMessage();
    }
  }

  function fetchDetails(){
    try {
      @ $db = new mysqli('127.0.0.1:3306','krimhajefcee', 'incorrect', 'awr_database');
        $dbError = mysqli_connect_errno();
        if($dbError){
            throw new Exception("DB CONNECTION ERROR");
        }else{
          if($_SESSION['paymentMethod'] == 'cod'){
            echo '<h3>Cash on Delivery</h3><hr class="style">';
          } else {
            echo '<h3>Credit Card</h3>';
            echo $_SESSION['ccno'].'<br>';
            echo $_SESSION['expdate'].'<br>';
            echo $_SESSION['cvv'].'<br><hr class="style">';
          }

          $selectID = 'SELECT user_id FROM currentuser';
          $resultUserID = $db->query($selectID);
          $userID = $resultUserID->fetch_assoc();

          $selectAddress = 'SELECT house_number, street, brgy, city FROM address WHERE user_id = '.$userID['user_id'];
          $resultAddress = $db->query($selectAddress);
          $userAddress = $resultAddress->fetch_assoc();

          echo $userAddress['house_number'].'<br>';
          echo $userAddress['street'].'<br>';
          echo $userAddress['brgy'].'<br>';
          echo $userAddress['city'].'<br>';

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
