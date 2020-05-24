<?php
      require_once('view-comp/header.php');
?>



<div class="container">
  <div class="card">
    <div class="card-header">
      <div class="card-title">
        <strong><i>YOUR CART</i></strong>
      </div>
    </div>
    <div class="card-body">

      <div class="cart-items">

      </div>

    </div>
    <div class="card-footer">
      <div class="total-element">
        <span class="total-price"><b> Total:</b> >9999999< </span>
      </div>
      <br><br>
      <div class="buttons">
        <div class="select-all"><input type="checkbox" class="select-all-items" id="select-all" onclick="checkboxFunction()">
					<strong>SELECT ALL</strong>
          <button class="btn btn-dark btn-sm" id="check-out-button" onclick="purchaseFunction()"><strong>CHECKOUT</strong></button>
        </div>
      </div>
    </div>
  </div>
</div>


<?php require_once('view-comp/footer.php') ?>
