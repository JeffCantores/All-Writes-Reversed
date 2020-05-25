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

  </head>
  <body onload="ready()">
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

    <div class="modal fade" id="myModal" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content" >

          <div class="modal-header ">
            <h4 class="modal-title">LOG IN</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <div class="modal-body">
            <div class="containerlogo">
              <img class="loginlogo" src="<?php getLogo() ?>" alt="LOGO"><br>
            </div>

            <div class="form-group login-form">
              <label for="username">Username: </label><br>
              <input class="credentials" type="text" id="username" name="username" placeholder="Username" required><br>
              <label for="password">Password: </label><br>
              <input class="credentials" type="password" id="password" name="password" placeholder="Password" required><br>
            </div>

            <div class="form-group login-form">
              <button class="btn btn-secondary loginButton" type="button" id="login_button" name="login_button" >LOG IN </button>
            </div>

            <div class="signup">
                <a class="signuplink" href="signup.php">No Account Yet? Sign Up Now!</a>
            </div>
          </div>

        </div>
      </div>
    </div>
