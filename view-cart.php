<?php
      require_once('view-comp/header.php');
?>


<br>
<div class="container">
  <div class="view-cart-items">
    <div class="title">
        <strong><i>YOUR CART</i></strong>
    </div>

    <div class="body">
      <div class="cart-items">
            (ITEMS FOR CHECKOUT GOES HERE)
      </div>
    </div>

    <br>
    <div class="fixed-bottom footer">
        <span class="total-price"><b> Total:</b> >9999999< </span>
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
<br>


<?php require_once('view-comp/footer.php') ?>
