<?php 
	include 'db_connect.php';
	session_start();
	$user_id = $_SESSION['user_id'];
	$role = $_SESSION['role'];
	$value = $_GET['val'];
	$u_id = $_GET['user'];

	if($value == 'USER'){
		$updt = "UPDATE user SET role = 'Sub Admin' WHERE user_id = '$u_id'";
		$updt_qry = mysqli_query($cnct,$updt);
		if(! $updt_qry)
		{
		  die('Could not update data: ' . mysql_error());
		}
		echo "Sub Admin";
	}else if($value == 'Sub Admin'){
		$updt = "UPDATE user SET role = 'USER' WHERE user_id = '$u_id'";
		$updt_qry = mysqli_query($cnct,$updt);
		if(! $updt_qry)
		{
		  die('Could not update data: ' . mysql_error());
		}
		echo "USER";
	}
?>
