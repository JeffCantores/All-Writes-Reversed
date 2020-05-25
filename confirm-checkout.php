<?php
require_once('view-comp/header.php');
require_once('functions/functions.php')
?>

<div class="container h-100">
  <div class="card">
    <div class="card-header text-center">
      <h1 class="text-uppercase font-weight-bold">Confirm Checkout</h1>
    </div>
    <div class="card-body bg-dark px-5">

        <!-- hindi ko alam bakit hindi gumagana overflow ni bootstrap sa part na 'to -->
          <div class="row">
            <div class="col-sm-3 col-md-6 col-lg-6 mh-100 overflow" >
              <h2 class="text-white font-weight-bold">Items</h2>

              <!-- Loop this part for every item para di lahat hard coded-->
                      <div class="row">

                        <div class="col-6 float-left p-2">
                          <img class="img-fluid rounded-lg" src="images/shirt.png">
                        </div>


                        <div class="col float-center pt-4 pl-3">
                          <!-- Information ng item - NAME-->
                          <div class="row">
                            <div class="col my-2">
                              <h7 class="font-weight-bold text-white">Name :</h7>
                              <span class="text-white px-1 rounded-lg">T-shirt</span>

                            </div>
                          </div>
                          <!-- Information ng item - COLOR-->
                          <div class="row">
                            <div class="col my-2">
                              <h7 class="font-weight-bold text-white">Color :</h7>
                              <span class="text-white px-1 rounded-lg">Light Gray</span>
                            </div>
                          </div>
                          <!-- Information ng item - PRICE-->
                          <div class="row">
                            <div class="col my-2">
                              <h7 class="font-weight-bold text-white">Price :</h7>
                              <span class="text-white px-1 rounded-lg">Php 1,000,000.00</span>
                            </div>
                          </div>
                          <!-- Information ng item - QUANTITY-->
                          <div class="row">
                            <div class="col my-2">
                              <h7 class="font-weight-bold text-white">Quantity :</h7>
                              <span class=" text-white px-1 rounded-lg">10</span>
                            </div>
                          </div>
                        </div>
                      </div>

              <!--^^^^^^^^^^^^^^^^^^^^^^^ FOR TESTING PURPOSES ONLY ^^^^^^^^^^^^^^^^^^^^^^^^^^^^ -->



            </div>
            <div class="col-sm-9 col-md-6 col-lg-6">
              <h2 class="text-white font-weight-bold text-center">Payment Method</h2>
              <div class="row d-flex justify-content-center">
                  <div class="col-7 bg-light text-dark  text-center rounded-lg p-1 mt-3 mb-4">Cash on delivery</div>
              </div>
              <h2 class="text-white font-weight-bold text-center">Shipping Address</h2>
              <div class="row d-flex justify-content-center">
                  <div class="col-4 bg-light text-dark text-center rounded-lg mx-1 mt-3 p-1">No.</div>
                  <div class="col-4 bg-light text-dark text-center rounded-lg mx-1 mt-3 p-1">Street</div>
                  <div class="col-4 text-white text-center rounded-lg mx-1">Street No.</div>
                  <div class="col-4 text-white text-center rounded-lg mx-1">Street Name</div>
                  <div class="col-4 bg-light text-dark text-center rounded-lg mx-1 mt-3 p-1">Barangay</div>
                  <div class="col-4 bg-light text-dark text-center rounded-lg mx-1 mt-3 p-1">City</div>
                  <div class="col-4 text-white text-center rounded-lg mx-1">Barangay</div>
                  <div class="col-4 text-white text-center rounded-lg mx-1">City</div>
              </div>
              <div class="row d-flex justify-content-center">
                  <div class="col-4 bg-light text-dark  text-center rounded-lg p-1 mt-3">Sample Amount</div>
              </div>
              <div class="row d-flex justify-content-center">
                <h7 class="text-white text-center">Total Amount</h7>
              </div>

            </div>
          </div>




    </div>
    <div class="card-footer d-flex justify-content-around">
      <a class="btn btn-dark text-uppercase" href="checkout-form.php">Go Back</a>
      <a class="btn btn-dark text-uppercase" href="#">Confirm</a>
    </div>
  </div>
</div>


<?php
require_once('view-comp/footer.php');
?>
