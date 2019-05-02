<?php 

// authentication check
require_once('auth.php');

//intialize the page_title
$page_title = null;
$page_title = 'User Coupon Usage';
$user_id = $_SESSION['user_id'];

require_once('include/header.php');

// connect the database
require_once('include/couponDatabase.php');

?>

<main class="container" style="width:400px">
   <h1> Coupon Usage </h1>
  	<div class="card" style="width:400px">
      <form method="post" action="codeCheck.php">
        <div class="form-group">
          <label for="email">Your email:</label>
          <input name="email" class="form-control" required type="email" >
        </div>
        <div class="form-group">
          <label for="couponCode">Coupon Code:</label>
          <input name="couponCode" class="form-control" required type="text" >
        </div>
        <div class="btn-group">
          <input name="submit" class="form-control" type="submit" value="Coupon Submit">
        </div>
      </form>      
   	</div>
</main>


<?php require_once('include/footer.php'); ?>


