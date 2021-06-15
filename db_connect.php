<?php
	//database connection mysqli_connect(server,username,password,databasename)
	$cnct = mysqli_connect('localhost','root','','votesystem');

	if(mysqli_connect_errno($cnct)){
	 	// echo "Failed to connect".mysqli_connect_error();
		include 'db_create.php';
	}
	//echo "connected success";
	//mysqli_close($cnct);
?>