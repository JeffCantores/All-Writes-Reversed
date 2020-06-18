<?php
  if(@ $_SERVER['HTTPS'] != 'on'){
    header('Location: https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
    exit;
  }
  session_start();
  require_once('view-comp/header.php');
  require_once('functions/functions.php');
  require_once('services-comp/process-search.php');

  if(!isset($_SESSION['username'])){
    getUser();
  }
?>
    <div class="content">
    	<?php
        if(isset($_GET['search'])){
          getSearchProduct($_GET['search']);
        } else {
          getProductImages();
        }
      ?>
    </div>

<?php
  require_once('view-comp/footer.php');

  if(isset($_SESSION['login-error'])){ // wrong username or wrong password
    //echo '<script> alert("'.$_SESSION['login-error'].'");</script>';
?>
    <script> $('#loginModal').modal('show');</script>
<?php
    unset($_SESSION['login-error']);
  }
  if(isset($_SESSION['login-first'])){ // click yung cart while not logged in
?>
    <script> $('#loginModal').modal('show');</script>
<?php
    unset($_SESSION['login-first']);
  }
  if(isset($_SESSION['signup-error'])){ // username is not unique
?>
    <script> $('#signupModal').modal('show');</script>
<?php
    unset($_SESSION['signup-error']);
  }
?>
