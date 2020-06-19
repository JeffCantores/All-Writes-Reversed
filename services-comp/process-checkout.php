<?php
  require_once('../exception/file-not-found-exception.php');
  require_once('process-confirm-checkout.php');
?>

<?php
session_start();
try {
    define('DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT']);

  @ $db = new mysqli('127.0.0.1:3306','krimhajefcee', 'incorrect', 'awr_database');
    $dbError = mysqli_connect_errno();
    if($dbError){
        throw new Exception("DB CONNECTION ERROR");
    }else{
      $selectCurrentUserID = 'SELECT * FROM currentuser';
      $cUserId = $db->query($selectCurrentUserID);
      $result = $cUserId->fetch_assoc();

      $selectCartItems = 'SELECT qty, product_id FROM cart where user_id = '.$result['user_id'].' AND checkedOut = 0';
      $cartItems = $db->query($selectCartItems);
      $cartCnt = $cartItems->num_rows;

      for ($count=0; $count < $cartCnt; $count++) {
        $resultItems = $cartItems->fetch_assoc();

        $updateItemStock = 'SELECT stock FROM products WHERE id = '.$resultItems['product_id'].'';
        $resultStock = $db->query($updateItemStock);
        $itemStock = $resultStock->fetch_assoc();

        $stockTaken = $resultItems['qty'];
        $stocks = $itemStock['stock'];

        $newStock = $stocks - $stockTaken;

        $updatedStocks = 'UPDATE products SET stock = "'.$newStock.'" WHERE id = '.$resultItems['product_id'].'';
        $newStocksUpdate =  $db->query($updatedStocks);
      }

      $true = 1;
      $updateUser = 'UPDATE cart SET checkedOut = '.$true.' WHERE user_id ='.$result['user_id'];
      $userUpdate = $db->query($updateUser);

      logConfirmCheckout();
      header("Location: ../order-success.php");
    }
    $db->close();
  }catch(Exception $e){
    echo $e->getMessage();
  }
?>
