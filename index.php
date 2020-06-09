<?php
  if(@ $_SERVER['HTTPS'] != 'on'){
    header('Location: https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
    exit;
  }
  session_start();
  require_once('view-comp/header.php');
  require_once('functions/functions.php');

  if(!isset($_SESSION['username'])){
    getUser();
  }
?>
    <div class="content">
    	<?php  getProductImages(); ?>
    </div>

<?php
  require_once('view-comp/footer.php');

  if(isset($_SESSION['login-error'])){
    //echo '<script> alert("'.$_SESSION['login-error'].'");</script>';
?>
    <script> $('#loginModal').modal('show');</script>
<?php
    unset($_SESSION['login-error']);
  }
  if(isset($_SESSION['login-first'])){
?>
    <script> $('#loginModal').modal('show');</script>
<?php
    unset($_SESSION['login-first']);
  }
  if(isset($_SESSION['signup-error'])){
?>
    <script> $('#signupModal').modal('show');</script>
<?php
    unset($_SESSION['signup-error']);
  }
?>
