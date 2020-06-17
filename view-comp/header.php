<?php
  function isActive($page) {
    return strpos($_SERVER['REQUEST_URI'], $page);
  }
  require_once('functions/functions.php');
?>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
      integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
      crossorigin="anonymous">
      <script src="https://kit.fontawesome.com/e4cf9541ab.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="css/view_cart.css">
    <script type="text/javascript" src="js/view-cart.js"></script>
    <script type="text/javascript" src="js/checkout-form.js"></script>
    <script type="text/javascript" src="js/view-item-price.js"></script>


  </head>
  <body>

    <!-- hello-world.php or hello_world.php -->
    <div class="navbar navbar-expand-lg navbar-dark bg-dark header">
      <div class="navbar-brand">
        <a href="index.php">
          <img class="logo" src="<?php getLogo() ?>" alt="LOGO">
        </a>
      </div>
      <div class="collapse navbar-collapse">
        <ul class="navbar-nav">
          <li class="nav-item <?php if(isActive('index.php')) echo 'active'; ?>" >
            <a class="nav-link" href="index.php"><i class="fas fa-home"></i><strong> HOME</strong></a>
          </li>
          <li class="nav-item <?php if(isActive('view-cart.php')) echo 'active'; ?>" >
            <a class="nav-link" href="view-cart.php"><i class="fas fa-shopping-cart"></i><strong> CART</strong></a>
          </li>&emsp;
          <input class="searchbar" type="text" name="" value="">
        </ul>
      </div>
      <?php getUsernameAndButton();?>
    </div>
    <div class="orange-break"></div>

    <div class="modal fade" id="loginModal" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content" >

          <div class="modal-header ">
            <h4 class="modal-title">LOG IN</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <div class="modal-body">

            <?php
              if(isset($_SESSION['login-error'])){
                echo '<div class="alert alert-danger" role="alert">
                        <center>'.$_SESSION['login-error'].'
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button></center>
                      </div>';
              }
            ?>

            <div class="containerlogo">
              <img class="loginlogo" src="<?php getLogo() ?>" alt="LOGO"><br>
            </div>

            <form action="login.php" method="POST">
              <div class="form-group login-form">
                <label for="username">Username: </label><br>
                <input class="credentials" type="text" id="username" name="username" placeholder="Username" required><br>
                <label for="password">Password: </label><br>
                <input class="credentials" type="password" id="password" name="password" placeholder="Password" required><br>
              </div>
              <div class="form-group login-form">
                <input type="submit" class="btn btn-secondary loginButton" id="login_button" name="login_button" value="LOG IN">
              </div>
            </form>
            <div class="signup">
                <button onclick="signup();" class="signuplink" data-toggle="modal" data-target="#signupModal" style="color:orange; border:none; background:none;">No Account Yet? Sign Up Now!</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="signupModal" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content" >

          <div class="modal-header">
            <h4 class="modal-title">SIGN UP</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <div class="modal-body">

            <?php
              if(isset($_SESSION['signup-error'])){
                echo '<div class="alert alert-danger" role="alert">
                        <center>'.$_SESSION['signup-error'].'
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button></center>
                      </div>';
              }
            ?>

            <form action="register.php" method="post">
              <div class="form-group login-form">
                <div class="containers">
                  <label class="labels" for="fname">First Name</label>
                  <label class="labels" for="mname">Middle Name</label><br>

                  <input class="textbox" type="text" size="15" name="fname" id="fname" placeholder="First Name" pattern="^[^\s]+(\s+[^\s]+)*$" title="Must not start or end with a space." required>
                  <input class="textbox" type="text" size="15" name="mname" id="mname" placeholder="Middle Name" pattern="^[^\s]+(\s+[^\s]+)*$" title="Must not start or end with a space." ><br>

                  <label class="labels" for="lname">Last Name</label>
                  <label class="labels" for="suffix">Suffix</label><br>

                  <input class="textbox" type="text" size="15" name="lname" id="lname" placeholder="Last Name" pattern="^[^\s]+(\s+[^\s]+)*$" title="Must not start or end with a space." required>
                  <input class="textbox" type="text" size="15" name="suffix" id="suffix" placeholder="Suffix" pattern="^[^\s]+(\s+[^\s]+)*$" title="Must not start or end with a space."><br>
                </div>

                <label class="labels" for="uname">Username</label><br>
                <input class="textbox" type="text" size="39" name="uname" id="uname" placeholder="Username" pattern="^[^\s]+(\s+[^\s]+)*$" title="Must not start or end with a space." required><br>
                <label class="labels" for="pword">Password</label><br>
                <input class="textbox" type="password" size="39" name="pword" id="pword" placeholder="Password"
                  pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$"
                  title="Must not start with space and must contain atleast 1 Uppercase, 1 Lowercase, and 1 Numeric Character."required><br>
                <label class="labels" for="email">Email</label><br>
                <input class="textbox" type="text" size="39" name="email" id="email" placeholder="Email"
                pattern="^[\w._%+-]+@[\w.-]+\.[a-z]{2,3}$" title="Invalid Email Format" required><br>

                <div class="containers">
                  <label class="labels" for="houseno">House No.</label>
                  <label class="labels" for="street">Street</label><br>

                  <input class="textbox" type="text" size="15" name="houseno" id="houseno" placeholder="House No." pattern="^[^\s]+(\s+[^\s]+)*$" title="Must not start or end with a space." required>
                  <input class="textbox" type="text" size="15" name="street" id="street" placeholder="Street" pattern="^[^\s]+(\s+[^\s]+)*$" title="Must not start or end with a space." required><br>

                  <label class="labels" for="brgy">Brgy.</label>
                  <label class="labels" for="city">City</label><br>

                  <input class="textbox" type="text" size="15" name="brgy" id="brgy" placeholder="Brgy." pattern="^[^\s]+(\s+[^\s]+)*$" title="Must not start or end with a space." required>
                  <input class="textbox" type="text" size="15" name="city" id="city" placeholder="City" pattern="^[^\s]+(\s+[^\s]+)*$" title="Must not start or end with a space." required><br>
                </div>
              </div>
              <div class="form-group login-form">
                <input class="btn btn-secondary loginButton" type="submit" id="signup_button" name="signup_button" value="SIGN UP">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
