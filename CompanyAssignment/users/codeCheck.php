<?php ob_start();

// authentication check
require_once('auth.php');

//intialize the page_title
$page_title = null;
$page_title = 'User Coupon check';

//get the form data from main.php through the method of post
$email = $_POST['email'];
$couponCode = $_POST['couponCode'];

//the data of couponUsage
$couponUsage = 'No';

require_once('include/header.php');

// connect the database
require_once('include/couponDatabase.php');
  
  //sql
  $sql = "SELECT couponCode FROM coupon where couponCode = :couponCode and couponUsage = :couponUsage;"; 
  
  //prepare sql
  $cmd= $conn->prepare($sql);

  //bind Parameters
  $cmd->bindParam(':couponCode', $couponCode);
  $cmd->bindParam(':couponUsage', $couponUsage);

  // execute 
  $cmd->execute();

  //fetch the data
  $statement = $cmd->fetch(); 

  //if there is no data in database, the coupon has been used and go to main.php
  if($statement == false){
    echo 'Your coupon has been used<br>';
    echo 'Try other coupon<br>';
    echo '<a href="main.php">Click to Main</a>';
    $cmd->closeCursor(); 
    exit();

  } else {

    //if there is the data, the column of couponUsage in the database updated to 'Yes'
    //and this code creates the current date and store it in the database

    $couponUsage = 'Yes';
    $currentDate = "";
    $usedDateOfCode = getdate();
    $currentDate .= $usedDateOfCode['year']."-".$usedDateOfCode['mon']."-".$usedDateOfCode['mday'];


    $sql = "UPDATE coupon SET couponUsage = :couponUsage, usedUser = :usedUser, usedDateOfCode = :usedDateOfCode  where couponCode = :couponCode;";    

    $cmd= $conn->prepare($sql);
    $cmd->bindParam(':couponUsage', $couponUsage);
    $cmd->bindParam(':usedUser', $email);
    $cmd->bindParam(':usedDateOfCode', $currentDate);
    $cmd->bindParam(':couponCode', $couponCode);
    $cmd->execute(); 
    $cmd->closeCursor(); 
    echo "Thank you!!<br>";
    echo '<a href="main.php">Click to Main</a>';

  }

  $cmd->closeCursor(); 

?>

<?php require_once('include/footer.php'); ?>


