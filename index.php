<?php
  if(@ $_SERVER['HTTPS'] != 'on'){
    header('Location: https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
    exit;
  }
  session_start();
  require_once('view-comp/header.php');
  require_once('functions/functions.php');

  if(isset($_SESSION['login-error'])){
    echo '<script> alert("'.$_SESSION['login-error'].'");</script>';
    unset($_SESSION['login-error']);
  }
  if(isset($_SESSION['login-first'])){
    echo '<script> alert("'.$_SESSION['login-first'].'");</script>';
    unset($_SESSION['login-first']);
  }
  if(isset($_SESSION['signup-error'])){
    echo '<script> alert("'.$_SESSION['signup-error'].'");</script>';
    unset($_SESSION['signup-error']);
  }
  if(!isset($_SESSION['username'])){
    getUser();
  }
?>
    <div class="content">
    	<?php  getProductImages(); ?>
    </div>

<?php require_once('view-comp/footer.php'); ?>
