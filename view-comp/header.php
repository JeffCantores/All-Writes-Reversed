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

  </head>
  <body>
    <!-- hello-world.php or hello_world.php -->
    <div class="navbar navbar-expand-lg navbar-dark bg-dark header">
      <div class="navbar-brand">
        <img class="logo" href="index.php" src="<?php getLogo() ?>">
      </div>
      <div class="collapse navbar-collapse">
        <ul class="navbar-nav">
          <li class="nav-item <?php if(isActive('index.php')) echo 'active'; ?>" >
            <a class="nav-link" href="index.php"><i class="fas fa-home"></i><strong> HOME</strong></a>
          </li>
          <li class="nav-item <?php if(isActive('view-cart.php')) echo 'active'; ?>" >
            <a class="nav-link" href="view-cart.php"><i class="fas fa-shopping-cart"></i><strong> CART</strong></a>
          </li>
        </ul>
      </div>
      <div class="buttonCont">
        <button class="btn btn-light"><strong>LOG IN</strong></button>
      </div>
    </div>
    <div class="orange-break"></div>
