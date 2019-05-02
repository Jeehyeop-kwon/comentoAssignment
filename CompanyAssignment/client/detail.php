<?php 
ob_start();
// authentication check
require_once('auth.php');

//intialize the page_title
$page_title = null;
$page_title = 'Coupons(display)';
$admin_id = $_SESSION['admin_id'];

//get data from displayCoupons.php through the method of get
$couponName = $_GET['couponName'];

require_once('include/header.php');

//require SearchForm
require('include/searchForm.php');
  
//connect to database 
require('include/couponDatabase.php'); 

// set up our sql query

$sql = "SELECT * FROM coupon where couponName = :couponName;"; 

//prepare 
$cmd= $conn->prepare($sql);

//bind Parameter
$cmd->bindParam(':couponName', $couponName);

// execute 
$cmd->execute(); 

//use fetchAll to store our results 
$coupons = $cmd->fetchAll(); 


  echo '<main class="container">';
  echo '<a href="adminMain.php"> Add New coupon </a>';
  echo '<div class="card">';
  echo '<div class="card-body">';
  echo '<table class="table table-bordered">
          <thead>
            <th> couponName </th>
            <th> couponCode </th>
            <th> couponUsage </th>
            <th> User used </th>
            <th> Date used </th>
            <th> </th>
          </thead>
          <tbody>';


  foreach($coupons as $coupon) {
      echo '<tr>
            <td>' . $coupon['couponName'] . '</td>';
      echo '<td>' . $coupon['couponCode'] . '</td>';
      echo '<td>' . $coupon['couponUsage'] . '</td>';
      echo '<td>' . $coupon['usedUser'] . '</td>';
      echo '<td>' . $coupon['usedDateOfCode'] . '</td>';     
  }
    echo '</tr>';   
    echo '</tbody></table>';
    echo '</tbody></table>';
    echo '<a href="displayCoupons.php"> Back to Coupon Group </a>';
    echo '</div></div></main>'; 
 
  //close the db connection 
  $cmd->closeCursor(); 

require('include/footer.php'); 

ob_flush(); 

?>



