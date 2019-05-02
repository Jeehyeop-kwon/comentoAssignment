<?php 

// authentication check
require_once('auth.php');

//intialize the page_title
$page_title = null;
$page_title = 'Admin-Main';

//store Session data
$admin_id = $_SESSION['admin_id'];

require_once('include/header.php');

?>

<main class="container">

  <div class="card mt-5">
    <div class="card-body">
      <h4 class="card-title">Coupon Generator</h4>

      <form class="" method="post" action="couponCode-generator.php">
        <input type="text" name="couponName" placeholder="CouponName" required><br>
        <input type="text" name="prefix" placeholder="prefix-3digit"  maxlength="3" required><br>
        <input type="submit" name="submit" value="submit">
      </form>

      <a href="displayCoupons.php" class="card-link"> Total Coupons </a>
  
    </div>
  </div>  
</main>


<?php
  
  require('include/footer.php'); 

?>



