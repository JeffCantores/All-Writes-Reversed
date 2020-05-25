<?php require_once('view-comp/header.php'); require_once('functions/functions.php') ?>

<div class="component">
  <div class="signupcontainer">
      <div class="card-title">
        <h3>SIGN UP FORM</h3>
      </div>
      <div class="card-body">

        <div class="form-group">
          <div class="containers">
            <label class="labels" for="fname">First Name</label>
            <label class="labels"for="mname">Middle Name</label><br>

            <input class="textbox" type="text" size="15" name="fname" id="fname" placeholder="First Name" required>
            <input class="textbox" type="text" size="15" name="mname" id="mname" placeholder="Middle Name" required><br>

            <label class="labels" for="lname">Last Name</label>
            <label class="labels"for="suffix">Suffix</label><br>

            <input class="textbox" type="text" size="15" name="lname" id="lname" placeholder="Last Name" required>
            <input class="textbox" type="text" size="15" name="suffix" id="suffix" placeholder="Suffix" required><br>
          </div>

          <label class="labels" for="uname">Username</label><br>
          <input class="textbox" type="text" size="39" name="uname" id="uname" placeholder="Username" required><br>
          <label class="labels" for="pword">Password</label><br>
          <input class="textbox" type="password" size="39" name="pword" id="pword" placeholder="Password" required><br>

          <div class="containers">
            <label class="labels" for="houseno">House No.</label>
            <label class="labels"for="street">Street</label><br>

            <input class="textbox" type="text" size="15" name="houseno" id="houseno" placeholder="House No." required>
            <input class="textbox" type="text" size="15" name="street" id="street" placeholder="Street" required><br>

            <label class="labels" for="brgy">Brgy.</label>
            <label class="labels"for="city">City</label><br>

            <input class="textbox" type="text" size="15" name="brgy" id="brgy" placeholder="Brgy." required>
            <input class="textbox" type="text" size="15" name="city" id="city" placeholder="City" required><br>
          </div>
        </div>
        <div class="form-group">
          <button class="btn btn-secondary loginButton" type="button" id="signup_button" name="signup_button" >SIGN UP</button>
        </div>
      </div>
  </div>
</div>

<?php require_once('view-comp/footer.php') ?>
