<?php
	require_once('header.php');
	require_once('../auth.php');		
  	require('couponDatabase.php');


    //$couponName = $couponCode = $couponUsage = $usedUser = $usedDateOfCode = "";

 	//check the existance of data
    if(!empty($_POST['search'])){

	    //grab the search term from the user 
	    $user_search = $_POST['search']; 
	    //covert search terms to a list with explode()
	    $search_words = explode(' ', $user_search); 
	    //build the first part of our query 
	    $query = "SELECT * FROM coupon WHERE "; 
	    //initialize the where variable 
	    $where = ""; 
	    //loop through and build the query 
	    foreach($search_words as $word) {
	      $where = $where. "usedUser LIKE '%$word%' OR ";
	    }
	    //remove the last part of query
	    $where = substr($where, 0, strlen($where)-4); 

	    //build the final query
	    $final_sql = $query . $where; 
	  
	    //echo $final_sql; 
	    $cmd = $conn->prepare($final_sql); 

	    //execution of sql
	    $cmd->execute();

	    //fetch all data of sql 
	    $results = $cmd->fetchAll();
	    
	    //initialize the variable
	    $theNumberOfResult = 0;

	    //get the number of result using count function
	    $theNumberOfResult = count($results);

	} else {
		
		//head to the adminMain.php
		header('location: ../adminMain.php');
		$cmd->closeCursor(); 
		exit();
	}

?>

<table class="table table-bordered table-sm">
    <thead class="thead-dark">
      <th> couponName </th>
      <th> couponCode </th>
      <th> couponUsage </th>
      <th> User used </th>
      <th> Date of the code used </th>
    </thead>
    <?php foreach ( $results as $result ) :?>
    <tbody >
      	<tr>
      	  <td><?php echo $result['couponName']; ?></td>
		  <td><?php echo $result['couponCode']; ?></td>
		  <td><?php echo $result['couponUsage']; ?></td>
		  <td><?php echo $result['usedUser']; ?></td>
		  <td><?php echo $result['usedDateOfCode']; ?></td>
		</tr>
	</tbody>
	<?php endforeach; ?>
</table>
<div>
  <a href="../detail.php?couponName=<?php echo $result['couponName'] ?>" class="btn btn-primary bg-success">Previous</a>
</div>
<div>
	<p>Total Number of results : <?php echo $theNumberOfResult; ?></p>
</div>

<?php
  $cmd->closeCursor(); 
  require('footer.php'); 
?>

       