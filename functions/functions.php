
<?php
	define('DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT']);

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
			$db->close();
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
			$db->close();
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
						echo '<button class="log btn btn-light" data-toggle="modal" data-target="#loginModal"><strong>LOG IN</strong></button>';
					} else {
						echo '<h6 class="username">@'.$_SESSION['username'].'</h6>';
						echo '<a href="logout.php">
										<input class="log btn btn-light" type="submit" value="LOG OUT">
									</a>';
					}
				}
				$db->close();
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


	   				$selectProducts =
						'SELECT img_dir, name, prices.price as prodPrice from products
							INNER JOIN prices
								ON prices.id = products.price_id
							WHERE category_id ='.$category['id'].';';
	   				$resultProducts = $db->query($selectProducts);
	   				$resultProductsCount = $resultProducts->num_rows;


						for($ctr2 = 0; $ctr2 < $resultProductsCount; $ctr2++){
							$product  =$resultProducts->fetch_assoc();
							$productNameLink = strtolower(str_replace(' ', '-', $product['name']));
							$productName = str_replace('AWR ', '', $product['name']);

							//echo $productName.'.php';
							echo '<div class="row display-item">';
							echo '<a href="'.$productNameLink.'.php"> ';
							echo '<img class="item" src = "'.$product['img_dir'].'">';
							echo '</a><br>';
							echo '<center><h6 style="color:white; margin-top:10px; margin-bottom:0px;">PhP '.$product['prodPrice'].'.00 </h6></center>';
							echo '<center><h6 style="color:white; word-wrap: break-word; margin-top:0px;">'.$productName.'</h6></center>';
							echo '</div>';
						}
	   			}
	   		}

				$db->close();
		} catch (Exception $e){
			echo $e->getMessage();
		}
	}

	function getUser(){
		try {
			@ $db = new mysqli('127.0.0.1:3306','krimhajefcee', 'incorrect', 'awr_database');
				$dbError = mysqli_connect_errno();
				if($dbError){
						throw new Exception("DB CONNECTION ERROR");
				}else{
					$selectCurrentUser = 'SELECT * FROM currentuser';
					$resultCurrent = $db->query($selectCurrentUser);
					$resultCurrentCnt = $resultCurrent->num_rows;
					if($resultCurrentCnt >=1){
						$currentUserID = $resultCurrent->fetch_assoc();
						$selectCurrentUserID = 'SELECT username FROM users where users.id = "'.$currentUserID['id'].'"';
						$result = $db->query($selectCurrentUserID);
						$resultCnt = $result->num_rows;

						if($resultCnt >= 1){
							$currentUsername = $result->fetch_assoc();
							@ $_SESSION['username'] = $currentUsername['id'];
						} else {
							throw new Exception('ERROR GETTING USERNAME');
						}

					}
				}
				$db->close();
		} catch (Exception $e) {
			echo $e->getMessage();
		}

	}

	function getName(){
		try {
			@ $db = new mysqli('127.0.0.1:3306','krimhajefcee', 'incorrect', 'awr_database');
				$dbError = mysqli_connect_errno();
				if($dbError){
						throw new Exception("DB CONNECTION ERROR");
				}else{
					$selectName = 'SELECT * FROM currentuser';
					$resultName= $db->query($selectName);
					$resultNameCount = $resultName->num_rows;
					if($resultNameCount >=1){
						$resultNameID = $resultName->fetch_assoc();
						$selectFullName = 'SELECT firstname, middlename, lastname, suffix FROM users where users.id = "'.$resultNameID['id'].'"';
						$result = $db->query($selectFullName);
						$resultCnt = $result->num_rows;

						if($resultCnt >= 1){
							$currentUsername = $result->fetch_assoc();
							echo $currentUsername['firstname'].' '.$currentUsername['middlename']
								.' '.$currentUsername['lastname'].' '.$currentUsername['suffix'].'!';

						} else {
							throw new Exception('ERROR GETTING USERNAME');
						}

					}
				}
				$db->close();
		} catch (Exception $e) {
			echo $e->getMessage();
		}

	}



?>
