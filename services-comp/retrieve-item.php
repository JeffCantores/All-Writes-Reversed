<?php
	function getItemDetails($itemName){
		try{
			@ $db = new mysqli('127.0.0.1:3306','krimhajefcee', 'incorrect', 'awr_database');
	   		$dbError = mysqli_connect_errno();
		    if($dbError){
		      	throw new Exception("DB CONNECTION ERROR");
		    }else{
		        $selectQuery = 'SELECT * FROM products
							INNER JOIN colors
								ON colors.id = products.color_id
							INNER JOIN prices
								ON prices.id = products.price_id
									WHERE name = "'.$itemName.'"';

		        $resultLogo = $db->query($selectQuery);
		        $dir = $resultLogo->fetch_assoc();

		        echo '<div class="products">';
 							echo '<div class="row">';
								echo '<div class="item-img col-6">';
									echo '<img class="item-view-img" src="'.$dir['img_dir'].'">';
								echo '</div>';

								echo '<div class="col-5">';
									echo '<input class="uneditable" name="name" size="20" type="text" value="'.$dir['name'].'" readonly><br>';
									echo '<input class="uneditable" name="color" size="20" type="text" value="'.$dir['color'].'" readonly><br>';
									echo '<input class="uneditable" name="qty" size="29" min=1 type="number" value="1"><br>';

									$itemPrice = $dir['price'];

									echo '<input class="uneditable" name="color" size="20" type="text" value="PhP '.$itemPrice.'" readonly><br>';
									echo '<br>';
									echo '<button class="add-to-cart">ADD TO CART</button>';
								echo '</div>';
							echo '</div>';
						echo '</div>';
			}
		}catch(Exception $e){
			echo $e->getMessage();
		}
	}
?>
