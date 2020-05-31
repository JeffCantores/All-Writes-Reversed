<?php
require_once('view-comp/header.php');
require_once('functions/functions.php');

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
                  <div class="row container">

                    <!-- radio button for COD mode of payment -->
                    <div class="col-6 form-check text-white text-center">
                      <input class="form-check-input" type="radio" name="payment-method" id="cod" value="cod" required>
                      <label class="form-check-label" for="cod">
                      Cash On Delivery
                      </label>
                    </div>

                    <!-- Radio button for debit/credit card -->
                    <div class="col-6 form-check text-white">
                        <input class="form-check-input" type="radio" name="payment-method" id="debit-credit-card" value="debit-credit-card" required>
                        <label class="form-check-label" for="debit-credit-card">
                            Debit / Credit Card
                        </label>
                    </div>
                  </div>

                  <!-- Supposedly gagana lang to kapag cash on delivery yung choice ni user -->
                  <div class="pr-5 form-group col-12  py-3">
                    <div class="container-fluid text-white">
                      <label class="p-2 col-8 text-right" for="credit-number">Credit Number</label>
                      <input type="text" class="form-control col-4 float-right"
                      id="credit-number" pattern="\d{4}-?\d{4}-?\d{4}-?\d{4}" placeholder="xxxx-xxxx-xxxx-xxxx" required>

                      <!-- Di ko alam kung anong format ng date for the mean time ito muna lagay ko sa place holder dd/mm/yy -->
                      <label class="p-2 col-8 text-right" for="expiry-date">Expiry Date</label>
                      <input type="text" class="form-control col-4 float-right"
                      id="expiry-date" pattern="^((0[1-9])|(1[0-2]))[\/\.\-]*((0[0-9])|(1[1-9]))$" placeholder="MM/YY" required>

                      <label class="p-2 col-8 text-right" for="cvv">CVV</label>
                      <input pattern="\d{3}" type="text" class="form-control col-4 float-right"
                      id="cvv" placeholder="Card Verification Value" required>
                    </div>
                  </div>
                </div>

                <!-- Shipping address section -->
              <h2 class="border px-5 py-2 text-white font-weight-bold">Shipping Address</h2>
                  <div class="container-fluid col-12 text-white">
                    <!-- Labels ng text areas -->
                    <div class="row">
                      <label class="p-2 col-2 text-center mx-auto" for="credit-number">House Number</label>
                      <label class="p-2 col-3 text-center mx-auto" for="credit-number">Street Name</label>
                      <label class="p-2 col-4 text-center mx-auto" for="credit-number">Barangay</label>
                      <label class="p-2 col-2 text-center mx-auto" for="credit-number">City</label>
                    </div>
                    <!-- Dito kukunin yung address ni user -->
                    <div class="row mb-3">
                      <input type="text" class="form-control col-2 mx-auto text-center" id="credit-number" placeholder="No." required>
                      <input type="text" class="form-control col-3 mx-auto text-center" id="credit-number" placeholder="Street" required>
                      <input type="text" class="form-control col-4 mx-auto text-center" id="credit-number" placeholder="Barangay" required>
                      <input type="text" class="form-control col-2 mx-auto text-center" id="credit-number" placeholder="City" required>
                    </div>
                  </div>

              </div>
            </div>
      <div class="card-footer d-flex justify-content-around text-white">
        <a class="btn btn-dark text-uppercase" href="index.php">Cancel</a>
        <button class="btn btn-dark text-uppercase" type="submit">Submit</button>
      </div>
      </form>
  </div>
</div>
</div>
<?php
require_once('view-comp/footer.php');
?>
