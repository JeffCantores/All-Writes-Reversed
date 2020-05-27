<?php
  require_once('view-comp/header.php');
  require_once('functions/functions.php');

  if(isset($_SESSION['login-error'])){
    echo '<script> alert("'.$_SESSION['login-error'].'")</script>';
    unset($_SESSION['login-error']);
  }
  if(isset($_SESSION['signup-error'])){
    echo '<script> alert("'.$_SESSION['signup-error'].'")</script>';
    unset($_SESSION['signup-error']);
  }
?>
    <div class="content">
    	<?php  getProductImages(); ?>
    </div>

<?php require_once('view-comp/footer.php'); ?>
