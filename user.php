<?php 
	include 'db_connect.php';
	//$user = $_POST["username"];
	//$email = $_POST["email"];
	//$password = md5($_POST["password"]);

	function registerUser($usr,$email,$password,$cnct){

	$user = "SELECT * FROM user";
	$user_qry = mysqli_query($cnct,$user);
		if(!$user_qry)
		{
		  die('Could not inserting user data: ' . mysql_error());
		}
		$vall = 0;
	  while($row = mysqli_fetch_assoc($user_qry)){
	    $vall = $vall+1;
	  }

	  if($vall == 0){
	  	//if there is no user the first registered user will be an admin
		$insert = "INSERT INTO user(user_name,email,password,role) VALUES('$usr','$email','$password','Admin')";
		}else{
			$insert = "INSERT INTO user(user_name,email,password,role) VALUES('$usr','$email','$password','YET')";
		}
		$insert_qry = mysqli_query($cnct,$insert);
		 if(!$insert_qry)
			  {
			  die('Could not inserting user data: ' . mysql_error());
			  }
	}

	//get user id of user
	function getUserId($user,$email,$password,$cnct){
		$user = "SELECT user_id,role FROM user WHERE user_name = '$user' AND email = '$email' AND password = '$password'";
		$user_qry = mysqli_query($cnct,$user);
		 if(!$user_qry)
		  {
		  die('Could not inserting user data: ' . mysql_error());
		  }
		  $usr_array = mysqli_fetch_array($user_qry);
		  return $usr_array;
	}

	//get user id and role using password and username
	function getUserRole($email,$password,$cnct){
		$user = "SELECT user_id, role FROM user WHERE email = '$email' AND password = '$password'";
		$user_qry = mysqli_query($cnct,$user);
		 if(!$user_qry)
		  {
		  die('Could not inserting user data: ' . mysql_error());
		  }
		  $usr_array = mysqli_fetch_array($user_qry);
		  return $usr_array;
	}

	//set role
	function setRole($cnct,$user_id,$role){
	$insert = "UPDATE user SET role = '$role' WHERE user_id = '$user_id'";
	$insert_qry = mysqli_query($cnct,$insert);
	 if(!$insert_qry)
		  {
		  die('Could not inserting user data: ' . mysql_error());
		  }
	}

	//get user role admin/sub-admin/normal-user
	function getRole($cnct,$user_id){
		$role = "SELECT role FROM user WHERE user_id = '$user_id'";
		$role_qry = mysqli_query($cnct,$role);
		 if(!$role_qry)
		  {
		  die('Could not inserting user data: ' . mysql_error());
		  }
		  $rl_array = mysqli_fetch_array($role_qry);
		  return $rl_array[0];
	 }	
 ?>
