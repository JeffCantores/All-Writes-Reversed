<?php
  session_start();
  if(@ $_SERVER['HTTPS'] != 'on'){
    header('Location: https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
    exit;
  }
  require_once('view-comp/header.php');
  require_once('functions/functions.php');
  require_once('services-comp/process-confirm-checkout.php');
?>

<div class="card-content py-3">
<div class="card-container">
  <div class="card">
    <div class="card-header text-center">
      <h1 class="text-uppercase font-weight-bold">Confirm Checkout</h1>
    </div>
    <div class="card-body bg-dark">
      <div class="row">
        <div class="checkoutItems">
          <?php
            fetchItems();
          ?>
        </div>
        <div class="checkoutDetails">
          <?php
            fetchDetails();
          ?>
        </div>

      </div>


    </div>
    <div class="card-footer d-flex justify-content-around">
      <a class="btn btn-dark text-uppercase" href="checkout-form.php">Go Back</a>
      <a class="btn btn-dark text-uppercase" href="#">Confirm</a>
    </div>
  </div>
</div>
</div>


<?php
require_once('view-comp/footer.php');
?>
