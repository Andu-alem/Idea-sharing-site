<?php 
	include 'db_connect.php';
	session_start();
		$admin_id = $_SESSION['user_id'];
		$role = $_SESSION['role'];
	$value = $_GET['val'];
	$u_id = $_GET['user'];

	if($value == "Remove"){
		$dlt = "DELETE FROM user WHERE user_id = '$u_id'";
		$dlt_qry = mysqli_query($cnct,$dlt);
		if(! $dlt_qry)
		{
		  die('Could not delete data: ' . mysql_error());
		}
		echo "Removed";

	}elseif ($value == "Approve") {
		$updt = "UPDATE user SET role = 'USER' WHERE user_id = '$u_id'";
		$updt_qry = mysqli_query($cnct,$updt);
		if(! $updt_qry)
		{
		  die('Could not update data: ' . mysql_error());
		}

		$aprv = "INSERT INTO user_approval(approved_by,user_id) VALUES('$admin_id','$u_id')";
		$aprv_qry = mysqli_query($cnct,$aprv);
		if(! $aprv_qry)
		{
		  die('Could not set approval data: ' . mysql_error());
		}

		echo "Approved";

	}
	//echo "hello";
?>