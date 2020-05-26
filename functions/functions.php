<?php
	function getLogo(){
		try{
			@ $db = new mysqli('127.0.0.1:3306','krimhajefcee', 'incorrect', 'awr_database');
	   		$dbError = mysqli_connect_errno();
		    if($dbError){
		      	throw new Exception("DB CONNECTION ERROR");
		    }else{
		        $selectLogo = 'SELECT logo_dir FROM logo WHERE id = 2';
		        $resultLogo = $db->query($selectLogo);
		        $dir = $resultLogo->fetch_assoc();

			}
		}catch(Exception $e){
			echo $e->getMessage();
		}
		echo $dir['logo_dir'];
	}

	function getSocMedLogo(){
		try{
			@ $db = new mysqli('127.0.0.1:3306','krimhajefcee', 'incorrect', 'awr_database');
	   		$dbError = mysqli_connect_errno();
		    if($dbError){
		      	throw new Exception("DB CONNECTION ERROR");
		    }else{
					echo '<div class=socmedcontainer">';
					for($ite = 3; $ite<=4;$ite++){
						$selectLogo = 'SELECT logo_dir FROM logo WHERE id = '.$ite;
		        $resultLogo = $db->query($selectLogo);
		        $dir = $resultLogo->fetch_assoc();

						if($ite ==3) {
							echo '<a href="https://www.facebook.com/AllWritesReversed?_rdc=1&_rdr">';
								echo'<img class="fblogo" src="'.$dir['logo_dir'].'">';
							echo '</a>';
						} else {
							echo '<a href="https://www.instagram.com/allwritesreversed_clothing/">';
								echo'<img class="iglogo" src="'.$dir['logo_dir'].'">';
							echo '</a>';
						}

					}
					echo '</div>';
			}
		}catch(Exception $e){
			echo $e->getMessage();
		}
	}

	function getUsernameAndButton(){
		try{
			@ $db = new mysqli('127.0.0.1:3306','krimhajefcee', 'incorrect', 'awr_database');
				$dbError = mysqli_connect_errno();
				if($dbError){
						throw new Exception("DB CONNECTION ERROR");
				}else{

					if(!isset($_SESSION['username'])){
						echo '<h6 class="username">Please Log In!</h6>';
						//echo '<a href="login.php">';
						echo '<button class="log btn btn-light" data-toggle="modal" data-target="#myModal"><strong>LOG IN</strong></button>';
					} else {
						echo '<h6 class="username">@'.$_SESSION['username'].'</h6>';
						echo '<form class="" action="logout.php" method="post">
										<input class="log btn btn-light" type="submit" value="LOG OUT">
									</form>';
					}
				}
			}catch (Exception $e){
				echo $e->getMessage();
			}
	}

	function getProductImages(){
		try{
			@ $db = new mysqli('127.0.0.1:3306','krimhajefcee', 'incorrect', 'awr_database');
	   		$dbError = mysqli_connect_errno();
	   		if($dbError){
	   			throw new Exception("DB CONNECTION ERROR");
	   		} else {
	   			$selectCategories = 'SELECT * from categories';
	   			$resultCategories = $db->query($selectCategories);

	   			$resultCategoriesCount = $resultCategories->num_rows;

	   			for($ctr = 0; $ctr < $resultCategoriesCount; $ctr++){
	   				$category = $resultCategories->fetch_assoc();
	   				echo '<br>';
	   				echo '<h3 class="category">'.$category['category'].'</h3>';


	   				$selectProducts = 'SELECT img_dir, name from products WHERE category_id ='.$category['id'].';';
	   				$resultProducts = $db->query($selectProducts);
	   				$resultProductsCount = $resultProducts->num_rows;


						for($ctr2 = 0; $ctr2 < $resultProductsCount; $ctr2++){
							$product  =$resultProducts->fetch_assoc();
							$productName = strtolower(str_replace(' ', '-', $product['name']));

							//echo $productName.'.php';
							echo '<div class="row display-item">';
							echo '<a href="'.$productName.'.php"> ';
							echo '<img class="item" src = "'.$product['img_dir'].'">';
							echo '</a> ';
							echo '</div>';
						}
	   			}
	   		}
		} catch (Exception $e){
			echo $e->getMessage();
		}
	}

?>
