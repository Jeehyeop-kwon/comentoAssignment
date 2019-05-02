<?php
ob_start();

//get data from adminMain.php through the method of post
$admin_email = $_POST['admin_email'];
$password = $_POST['password'];	

require_once ('include/localDatabase.php');

//sql
$sql = "SELECT * FROM comentoAdmin WHERE admin_email = :admin_email;";

//prepare sql
$cmd = $conn->prepare($sql);
//bind Parameter
$cmd->bindParam(':admin_email', $admin_email);
//execute
$cmd->execute();
//fetch the data
$admin = $cmd->fetch();

//varify the password
if($admin != null && password_verify($password, $admin['password'])){
	
	echo 'Logged in Successfully';
	session_start(); // access the existing session
	$_SESSION['admin_id'] = $admin['admin_id'];
   
   //if the password is varified, go to adminMain.php
    header('location: adminMain.php');
 
} else {
	//if the password is varified, go to login-admin.php
	header('location: login-admin.php');
 
}
//disconnect the database
$conn = null;	
ob_flush();
?>


