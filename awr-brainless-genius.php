<?php
      session_start();
      if(@ $_SERVER['HTTPS'] == 'on'){
        header('Location: http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
        exit;
      }
			require_once('view-comp/header.php');
			require_once('services-comp/retrieve-item.php')
?>
	<div class="component">
		<?php getItemDetails("AWR Brainless Genius"); ?>
	</div>

<?php
  require_once('view-comp/footer.php');
?>
