<?php
      session_start();
      if(!isset($_SESSION['username'])){
        $_SESSION['login-first'] = "Please Log In First!";
        header("Location: index.php?openmodal=1");
      }
      require_once('services-comp/retrieve-item.php');
      require_once('model/product-class.php');
      require_once('services-comp/get-cart-items.php');
      require_once('view-comp/header.php');
?>

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
        asasdasdasd<br>
      </div>

    </div>
  </div>

<?php require_once('view-comp/footer.php') ?>
