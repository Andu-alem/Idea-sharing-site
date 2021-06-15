<?php
	include 'db_connect.php';
	//session_start();
	$user = $_SESSION['user_id'];
	$role = $_SESSION['role'];
	$post = $_POST['idea'];

	$insert = "INSERT INTO idea(post,posted_by,approved) VALUES('$post','$user','YET')";
	$ins_qry = mysqli_query($cnct,$insert);
	if(!$ins_qry)
	{
		die('Could not insert this post: ' . mysql_error());
	}
	header('location:index.php');
	//echo "INSERTED SUCCESSFULLY";
?>
