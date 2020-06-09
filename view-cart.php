<?php
      session_start();
      if(@ $_SERVER['HTTPS'] == 'on'){
        header('Location: http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
        exit;
      }
      if(!isset($_SESSION['username'])){
        $_SESSION['login-first'] = "To be able to view the cart, please Log In first!";
        header("Location: index.php?openmodal=true");

      }
      require_once('view-comp/header.php');
      require_once('services-comp/retrieve-item.php');
      require_once('model/product-class.php');
      require_once('services-comp/get-cart-items.php');
      require_once('functions/functions.php');


      if ( isset($_GET['openmodal']) && $_GET['openmodal'] !== 'true' ){
          showModal();
        }
?>
<center>
  <div class="cart-container">
    <div class="cart">
      <div class="cart-header">
        <h4>YOUR CART</h4>
      </div>

      <hr class="style">

      <div class="cart-body">
        <?php
          getCartItems();
        ?>
      </div>

      <hr class="style">

      <div class="cart-footer">
        asasdasdasd
        <br>
      </div>

    </div>
  </div>
</center>
<?php require_once('view-comp/footer.php') ?>
