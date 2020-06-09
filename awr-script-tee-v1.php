<?php
      session_start();
      if(@ $_SERVER['HTTPS'] == 'on'){
        header('Location: http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
        exit;
      }
      
			require_once('view-comp/header.php');
			require_once('services-comp/retrieve-item.php')
?>
<?php
	// if(isset($_SESISON['addtocart'])){
	// 	<div class="alert alert-success">
	//
	// 	</div>
	// }
?>

	<div class="component">
		<div class="view-item">
			<?php getItemDetails("AWR Script Tee V1"); ?>
		</div>
	</div>

<?php require_once('view-comp/footer.php') ?>

<!-- PUSH TEST -->
