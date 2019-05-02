
<?php
ob_start();

//get data from login.php through the method of post
$user_email = $_POST['user_email'];
$password = $_POST['password'];

require_once ('include/localDatabase.php');
//sql
$sql = "SELECT * FROM comentoUser WHERE user_email = :user_email;";

//prepare sql
$cmd = $conn->prepare($sql);
//bind Parameter`
$cmd->bindParam(':user_email', $user_email);
//execute
$cmd->execute();
//fetch the data
$user = $cmd->fetch();

//varify the password
if($user != null && password_verify($password, $user['password'])){
	
	echo 'Logged in Successfully';
	session_start(); // access the existing session
	$_SESSION['user_id'] = $user['user_id'];

   //if the password is varified, go to Main.php
    header('location: main.php');
 
} else {
	//if the password is varified, go to login.php
	header('location: login.php');
 
}
//disconnect the database
$conn = null;	
ob_flush();
?>


