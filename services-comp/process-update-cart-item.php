<?php
  require_once('../exception/file-not-found-exception.php');
?>

<?php
  function updateCartItem($prodName, $prodQty, $prodPrice){
    try {
			@ $db = new mysqli('127.0.0.1:3306','krimhajefcee', 'incorrect', 'awr_database');
				$dbError = mysqli_connect_errno();
				if($dbError){
						throw new Exception("DB CONNECTION ERROR");
				}else{
          $itemName = $prodName;
          $itemPrice = $prodPrice;
          $itemQty = $prodQty;

					$selectCartItem = 'SELECT * FROM cart';
					$selectCartItem = 'SELECT products.id as prodID FROM products WHERE name = "'.$itemName.'"';
					$result = $db->query($selectCartItem);
					$cItem = $result->fetch_assoc();

          // code experiment (update statement)
          $updateItem = "UPDATE cart SET qty = '".$itemQty."', price = '".$itemPrice."' WHERE cart.product_id = ".$cItem['prodID']."'";
					$result = $db->query($updateItem);

          saveUpdateCartItem($itemName, $itemQty, $itemPrice);
          getUpdateCartItem();
				}
			} catch	(Exception $e){
				echo $e->getMessage();
			}
		}

    function saveUpdateCartItem($itemName, $itemQty, $itemPrice){
        $loginUsername = $_SESSION['username']; //fetch username code here
        $prodName = $itemName;
        $prodPrice = $itemPrice;
        $prodQty = $itemQty;

        echo "<br/>".DOCUMENT_ROOT;


        $date = date('H:i, jS F Y');
        $outputString = $date."\t"
        .$_SERVER['REMOTE_ADDR']."\t"
        .$loginUsername."\tupdated (productName: "
        .$prodName."\tqty: "
        .$prodQty."\tprice: PHP "
        .$prodPrice.")\n";

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
