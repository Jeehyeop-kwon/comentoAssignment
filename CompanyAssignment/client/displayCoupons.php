<?php 
ob_start();
// authentication check
require_once('auth.php');

//intialize the page_title
$page_title = null;
$page_title = 'Coupons(display)';
$admin_id = $_SESSION['admin_id'];

require_once('include/header.php');
  
  //connect to database 
  require('include/couponDatabase.php'); 
  
  // set up our sql query
  $sql = "SELECT couponName FROM coupon group by couponName;"; 
  
  //prepare 
  $cmd= $conn->prepare($sql);
  
  // execute 
  $cmd->execute(); 
  //use fetchAll to store our results 
  $couponNames = $cmd->fetchAll(); 

  echo '<main class="container">';
  echo '<a href="adminMain.php"> Add New coupon </a>';
  echo '<div class="card">';
  echo '<div class="card-body">';
  echo '<table>
      <thead>
        <th> Name </th>
        <th> Detail </th>
      </thead>
      <tbody>';
  
  //loop through the data and create a new table row for each record 
  
    foreach($couponNames as $couponName) {
      echo '<tr><td>' . $couponName['couponName'] . '</td>';
      echo '<td><a href="detail.php?couponName=' . $couponName['couponName'] .'"> Detail </a></td></tr>';     
    }
    echo '</tbody></table>'; 
    echo '</div></div></main>';


  
 
  //close the db connection 
  
  $cmd->closeCursor(); 

require('include/footer.php'); 

ob_flush(); 

?>



