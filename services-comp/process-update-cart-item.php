<?php
  require_once('../exception/file-not-found-exception.php');
?>

<?php
  define('DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT']);

  function updateCartItem($prodName, $prodPrice, $prodQty){
    try {
			@ $db = new mysqli('127.0.0.1:3306','krimhajefcee', 'incorrect', 'awr_database');
				$dbError = mysqli_connect_errno();
				if($dbError){
						throw new Exception("DB CONNECTION ERROR");
				}else{
          $itemName = $prodName;
          $itemPrice = $prodPrice;
          $itemQty = $prodQty;

					// $selectCartItem = 'SELECT * FROM cart';
					$selectCartItem = 'SELECT products.id as prodID, prices.price
          FROM products
            INNER JOIN prices
              ON prices.id = products.price_id
                WHERE name = "'.$itemName.'"';

					$result = $db->query($selectCartItem);
					$cItem = $result->fetch_assoc();

          $selectUserID = "SELECT user_id FROM currentuser";
          $resultUserID = $db->query($selectUserID);
          $cUserID = $resultUserID->fetch_assoc();


          $selectDetails = 'SELECT qty FROM cart WHERE cart.product_id ='.$cItem['prodID'];
          $resultQty = $db->query($selectDetails);
          $cQty = $resultQty->fetch_assoc();

          $ogPrice = $itemPrice/$cQty['qty'];

          $newPrice = $ogPrice*$itemQty;

          // echo $cQty['qty'];
          // code experiment (update statement)
          $updateItem = "UPDATE cart SET qty = ".$itemQty.", price =" .$newPrice. " WHERE cart.product_id = ".$cItem['prodID'];
					$result = $db->query($updateItem);
          $_SESSION['updated'] = 'Cart Item Updated!';

          saveUpdateCartItem($itemName, $itemQty, $newPrice);
          //getUpdateCartItem();
				}
        $db->close();
			} catch	(Exception $e){
				echo $e->getMessage();
			}
		}

    function saveUpdateCartItem($itemName, $itemQty, $newPrice){
        $loginUsername = $_SESSION['username']; //fetch username code here

        echo "<br/>".DOCUMENT_ROOT;

        $date = date('H:i, jS F Y');
        $outputString = $date."\t"
        .$_SERVER['REMOTE_ADDR']."\t"
        .$loginUsername."\tupdated order (productName: "
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

      function getUpdateCartItem(){

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
