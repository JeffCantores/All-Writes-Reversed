<?php
  require_once('exception/file-not-found-exception.php');
?>

<?php
  define('DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT']);

  function addToCart($qty,$price, $productName){
    try {
      @ $db = new mysqli('127.0.0.1:3306','krimhajefcee', 'incorrect', 'awr_database');
	   		$dbError = mysqli_connect_errno();
		    if($dbError){
		      	throw new Exception("DB CONNECTION ERROR");
		    }else{
          $selectProdID = 'SELECT products.id as prodID FROM products WHERE name = "'.$productName.'"';
          $resultProdID = $db->query($selectProdID);
          $prodID = $resultProdID->fetch_assoc();
          if($prodID){
            $selectUserID = 'SELECT users.id as userID FROM users WHERE username = "'.$_SESSION['username'].'"';
            $resultUserID = $db->query($selectUserID);
            $userID = $resultUserID->fetch_assoc();
            if($userID){
             $selectProdID;
             $cart_item = 'SELECT * from cart WHERE product_id = '.$prodID['prodID'].'AND checkedOut = 0';
             $resultCartItems = $db->query($cart_item);
             $count = $resultCartItems->num_rows;
             if ($count>0) {
                 $_SESSION['addtocart'] = 'Item already in your cart!';
                throw new Exception("Item already in Cart");

             }else {
                $false = 0;
                $insertToCart = 'INSERT INTO cart (qty, price, product_id, user_id, checkedOut) VALUES (?,?,?,?,?)';
                $stmt = $db->prepare($insertToCart);
                $stmt->bind_param('iiiii', $qty, $price, $prodID['prodID'], $userID['userID'], $false);
                $stmt->execute();
                if(!$stmt){
                  throw new Exception("EXCEPTION INSERT");
                  //$_SESSION['addtocart'] = 'FALSE';
                } else {
                  $_SESSION['addtocart'] = 'Successfully added in your cart!';

                  $stmt->close();

                  // log functions go here
                  saveAddToCart();
                }
            }
          } else {
            throw new Exception("EXCEPTION USERID");
          }
        } else {
          throw new Exception("EXCEPTION PRODID");
        }
      }
      $db->close();
    } catch (Exception $e) {
      echo $e->getMessage();
    }

  }


  function saveAddToCart(){
      $loginUsername = $_SESSION['username']; //fetch username code here
      $prodName = $_POST['name'];
      $prodPrice = $_POST['price'];
      $prodQty = $_POST['qty'];

      echo "<br/>".DOCUMENT_ROOT;


      $date = date('H:i, jS F Y');
      $outputString = $date."\t"
      .$_SERVER['REMOTE_ADDR']."\t"
      .$loginUsername."\tbought (Product Name: "
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
?>
