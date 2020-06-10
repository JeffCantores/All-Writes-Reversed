<?php
session_start();
require_once('view-comp/header.php');
require_once('functions/functions.php');
require_once('services-comp/process-checkout-form.php');

?>

<div class="content py-5">
<div class="container">
  <div class="card">
    <div class="card-header text-center">
      <h1 class="text-uppercase font-weight-bold">Checkout Form</h1>
    </div>
    <div class="border card-body bg-dark">
          <div class="col-sm-9 col-md-6 col-lg-12">
            <!-- Lahat ng checkout information dito kukunin sa form kaso di gumagana submit button unless lagyan ko href :/ -->
            <form class="border" action="confirm-checkout.php" method="post">

              <!-- Payment Method Section -->
              <h2 class="border px-5 py-2 text-white font-weight-bold">Payment Method</h2>
                <div class="pt-2 mb-2">
                  <div class="container">


                    <div class="col-6 form-check text-white text-center">
                      <div class="dropdown">
                        <button class="btn btn-light dropdown-toggle col-6 mb-3" type="button" data-toggle="dropdown">Mode of Payment
                        <span class="caret"></span></button>
                        <ul class="dropdown-menu col-6">
                          <li class="mb-1 text-center"><button class="btn btn-dark col-11" onclick="closeSesame()">Cash On Delivery</button></li>
                          <li class="mb-1 text-center"><button class="btn btn-dark col-11" onclick="openSesame()">Credit Card</button></li>
                        </ul>
                      </div>
                    </div>


                  <!-- DAPAT NASA PROCESS CHECKOUT FORM TO -->
                  <div id="creditCardInfo" class="text-center form-group col-12  py-3" style="display:none;">
                      <div class="container-fluid text-white">
                        <div class="row d-flex justify-content-center">
                          <label class="p-2 ml-auto col-4 text-right float-left" for="cardNo">Credit Number</label>
                          <input type="text" class="form-control col-4 float-left mr-auto"
                          id="credit-number" pattern="\d{4}-?\d{4}-?\d{4}-?\d{4}" placeholder="xxxx-xxxx-xxxx-xxxx" required>
                        </div>

                        <div class="row d-flex justify-content-center">
                          <label class="p-2 ml-auto col-4 text-right float-left" for="exp">Expiry Date</label>
                          <input type="text" class="form-control col-4 float-left mr-auto"
                          id="expiry-date" pattern="^((0[1-9])|(1[0-2]))[\/\.\-]*((0[0-9])|(1[1-9]))$" placeholder="MM/YY" required>
                        </div>

                        <div class="row d-flex justify-content-center">
                          <label class="p-2 ml-auto col-4 text-right float-left" for="cvv">CVV</label>
                          <input pattern="\d{3}" type="text" class="form-control col-4 float-left mr-auto"
                          id="cvv" placeholder="Card Verification Value" required>
                        </div>

                      <p class="p-2 col-9 text-right">**For Credit Card Only**</p>
                    </div>
                  </div>
                </div>

                <!-- Shipping address section -->
              <h2 class="border px-5 py-2 text-white font-weight-bold">Shipping Address</h2>
                  <div class="container-fluid col-12 text-white">
                    <!-- Labels ng text areas -->
                    <div class="row">
                      <label class="p-2 col-2 text-center mx-auto" for="houseNo">House Number</label>
                      <label class="p-2 col-3 text-center mx-auto" for="streetName">Street Name</label>
                      <label class="p-2 col-4 text-center mx-auto" for="barangay">Barangay</label>
                      <label class="p-2 col-2 text-center mx-auto" for="city">City</label>
                    </div>
                    <!-- Dito kukunin yung address ni user -->
                    <?php getAddressInfo(); ?>
                  </div>

              </div>
            </div>
      <div class="card-footer d-flex justify-content-around text-white">
        <a class="btn btn-light text-uppercase" href="index.php">Cancel</a>
        <button class="btn btn-light text-uppercase" type="submit">Submit</button>
      </div>
      </form>
  </div>
</div>
</div>
<?php
require_once('view-comp/footer.php');
?>
