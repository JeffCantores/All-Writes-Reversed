<?php 
	function getLogo(){
		try{
			@ $db = new mysqli('127.0.0.1:3306','IamJaycee18', '1234567890', 'awr_database');
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

	function getProductImages(){
		try{
			@ $db = new mysqli('127.0.0.1:3306','IamJaycee18', '1234567890', 'awr_database');
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
	   				

	   				$selectProducts = 'SELECT img_dir from products WHERE category_id ='.$category['id'].';';
	   				$resultProducts = $db->query($selectProducts);
	   				$resultProductsCount = $resultProducts->num_rows;

					for($ctr2 = 0; $ctr2 < $resultProductsCount; $ctr2++){
						$product  =$resultProducts->fetch_assoc();
						echo '<div class="row display-item">';
						echo '<a href="item.php"> ';
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