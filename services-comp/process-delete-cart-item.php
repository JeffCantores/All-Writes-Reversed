<?php
  require_once('../exception/file-not-found-exception.php');
?>

<?php
  define('DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT']);

  function removeCartItem($prodName, $prodPrice, $prodQty){
    try {
      @ $db = new mysqli('127.0.0.1:3306','krimhajefcee', 'incorrect', 'awr_database');
      $dbError = mysqli_connect_errno();
      if($dbError){
          throw new Exception("DB CONNECTION ERROR");
      }else{
        $selectCartItem = 'SELECT * FROM cart';
        $selectCartItem = 'SELECT products.id as prodID FROM products WHERE name = "'.$prodName.'"';
        $result = $db->query($selectCartItem);
        $cItem = $result->fetch_assoc();

        $selectUserID = 'SELECT users.id as userID FROM users WHERE username = "'.$_SESSION['username'].'"';
        $resultUserID = $db->query($selectUserID);
        $userID = $resultUserID->fetch_assoc();


        $deleteCartItem = 'DELETE FROM cart WHERE product_id = '.$cItem['prodID'].' AND user_id = '.$userID['userID'];
        $result = $db->query($deleteCartItem);

        saveRemovedCartItem($prodName, $prodQty, $prodPrice);
        //getRemovedCartItem();

        $_SESSION['removed'] = 'Item Removed from Cart!';
      }
      $db->close();
    } catch	(Exception $e){
      echo $e->getMessage();
    }
  }

  function saveRemovedCartItem($itemName, $itemQty, $newPrice){
      $loginUsername = $_SESSION['username']; //fetch username code here

      echo "<br/>".DOCUMENT_ROOT;

      $date = date('H:i, jS F Y');
      $outputString = $date."\t"
      .$_SERVER['REMOTE_ADDR']."\t"
      .$loginUsername."\tremoved order (Product Name: "
      .$itemName."\tqty: "
      .$itemQty."\tprice: PHP "
      .$newPrice.")\n";

      $file = @ fopen(DOCUMENT_ROOT.'/WEBPROG-FINALS/resource/user-logs.txt', 'ab'); //writing

      if (!$file) {
        echo "<p><strong>Your update could not be processed at this time.
            Please try again later.</strong></p>";
      }else{

          flock($file, LOCK_EX);
          fwrite($file, $outputString, strlen($outputString));
          flock($file, LOCK_UN);
          fclose($file);
      }
    }

  function getRemovedCartItem(){
    try{
      $file = @ fopen(DOCUMENT_ROOT.'/WEBPROG-FINALS/resource/user-logs.txt', 'rb'); // reading
      if (!$file) {
        throw new FileNotFoundException('Your update could not be processed at this time.
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
