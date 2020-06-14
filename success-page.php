<?php
      session_start();
      if(@ $_SERVER['HTTPS'] == 'on'){
        header('Location: http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
        exit;
      }
			require_once('view-comp/header.php');
?>

<?php
  require_once('view-comp/footer.php');
?>
