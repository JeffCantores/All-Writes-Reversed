<?php
  session_start();
  if(@ $_SERVER['HTTPS'] == 'on'){
    header('Location: http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
    exit;
  }
  require_once('view-comp/header.php');
?>

<div class="success-container">
  <div class="success-card">
    <div class="card-header">
      <center><h3><b>ORDER SUCCESSFUL</b></h3></center>
    </div>
    <div class="card-body">
      <center><h3 class="message">THANK YOU FOR SHOPPING WITH US!</h3></center>
      <center><h3 class="message">COME BACK AND SHOP WITH US AGAIN!</h3></center>
      <center><h3 class="message">OLRAYTS!</h3></center>
    </div>
    <div class="card-footer">
      <a href="index.php">
        <button type="button" name="button">GO HOME</button>
      </a>
    </div>

  </div>
</div>


<?php require_once('view-comp/footer.php') ?>
