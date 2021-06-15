<?php 
	include 'db_connect.php';
	session_start();
	$admin_id = $_SESSION['user_id'];
	$role = $_SESSION['role'];
	$value = $_GET['val'];
	$pst_id = $_GET['idea'];

	if($value == "Disapprove"){
	    appr($cnct,$pst_id,$admin_id,"NO");
		$updt = "UPDATE idea SET approved = 'NO' WHERE post_id = '$pst_id'";
		$updt_qry = mysqli_query($cnct,$updt);
		if(! $updt_qry)
		{
		  die('Could not update data: ' . mysql_error());
		}
		echo "Disapproved";

	}elseif ($value == "Approve") {
	    appr($cnct,$pst_id,$admin_id,"YES");
		$updt = "UPDATE idea SET approved = 'YES' WHERE post_id = '$pst_id'";
		$updt_qry = mysqli_query($cnct,$updt);
		if(! $updt_qry)
		{
		  die('Could not update data: ' . mysql_error());
		}

		echo "Approved";

	}

	//to insert data who approve/disapprove idea/post
	function appr($cnct,$p_id,$ad_id,$val){
		$aprv = "INSERT INTO post_approval(post_id,user_id,approval) VALUES('$p_id','$ad_id','$val')";
		$aprv_qry = mysqli_query($cnct,$aprv);
		if(! $aprv_qry)
		{
		  die('Could not set approval data: user_id is:'.$p_id. mysql_error());
		}
	}
?>
