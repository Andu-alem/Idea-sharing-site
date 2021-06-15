<?php 
	include 'db_connect.php';
	session_start();
	$user_id = $_SESSION['user_id'];
	$role = $_SESSION['role'];
	$value = $_GET['val'];
	$pst_id = $_GET['idea'];

	if($value == "Unvote"){
	   // appr($cnct,$pst_id,$admin_id,"NO");
		/*$slct = "SELECT v_id FROM vote WHERE user_id = '$user_id' AND votes_for = '$pst_id'";
		$slct_qry = mysqli_query($cnct,$slct);
			if(! $slct_qry){
		  die('Could not slct data: ' . mysql_error());
		}
		$slct_rw = mysqli_fetch_array($slct_qry);
		$v_id = $slct_rw[0];
		*/

		$updt = "DELETE FROM vote WHERE user_id = '$user_id' AND votes_for = '$pst_id'";
		$updt_qry = mysqli_query($cnct,$updt);
		if(! $updt_qry)
		{
		  die('Could not delete data: ' . mysql_error());
		}
		echo "Vote";
	}elseif ($value == "Vote") {
		$updt = "INSERT INTO vote(user_id,votes_for) VALUES('$user_id','$pst_id')";
		$updt_qry = mysqli_query($cnct,$updt);
		if(! $updt_qry)
		{
		  die('Could not update data: ' . mysql_error());
		}
		echo "Unvote";	
	}else{
		echo "It's your idea";
	}
?>
