<?php 
ob_start();
// authentication check
require_once('auth.php');

//intialize the page_title
$page_title = null;
$page_title = 'Admin-Main';
$admin_id = $_SESSION['admin_id'];

//get data from adminMain.php through the method of post
$couponName = $_POST['couponName'];
$prefix = $_POST['prefix'];

require_once('include/header.php');

//check the data
if(isset($_POST['submit']) & !empty('$couponName')){

	//storing coupon data
	require_once('include/couponDatabase.php');
	$sql = "INSERT INTO coupon (couponName, couponCode) VALUES (:couponName, :couponCode)";
  	//prepare 
	$cmd= $conn->prepare($sql);

	//flag value
	$i = 0;

	//get the coupon code(10,000)
	while ( $i <= 9999) {
		//length of the code(****_****_****_****)
		$length = 16;
		//combination of character and number
	    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';

	    //initialize the string value
	    $couponCode = '';

	    //attach the data of prefix    
	    $couponCode .= $prefix;

	    for ($p = 0; $p < $length; $p++) {
	      //attach the character of - in the coupon code
	      if($p == 1 || $p == 6 || $p == 11){
	        $couponCode .= '-';
	      } else {
	      	//attach the random value of character and number
	        $couponCode .= $characters[mt_rand(0, strlen($characters)-1)];
	      }
	    }

  		//bind Parameter to sql
		$cmd->bindParam(':couponName', $couponName);
		$cmd->bindParam(':couponCode', $couponCode);

		// execute 
		$cmd->execute();
  		$i++;
	}
	
	//close the connection
	$cmd->closeCursor();


	require('adminMain.php');
	echo 'Coupon code stored'; 

} 

ob_flush(); 
?>