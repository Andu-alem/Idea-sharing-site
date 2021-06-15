<?php 
	session_start();

	if(isset($_SESSION['user_id'])){
		$user_id = $_SESSION['user_id'];
		$role = $_SESSION['role'];
		//echo $_SESSION['user_id']."    ".$_SESSION['role']."<br>";
	}else{
		header('location:login.php');
		exit();
	}
	include 'change_account.php';
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  	<head>
		<link rel="shortcut icon" href="icon-search.PNG" type="text/img">
		<meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">
		<link rel="stylesheet" href="bootstrap-4.1.3/css/bootstrap.css">
		<link rel="stylesheet" href="css/style.css">
		<script type="text/javascript" src="angular-1.7.8/angular.js">
		</script>
		<title>Posts Page</title>
	</head>
	<body class="bg-light">
		<div class="container mr-md-5 ml-md-5 pl-md-5 pr-md-5">
			<div class="ml-2">
		        <a class="h2 logo-text text-capitalize" href="index.php" style="text-decoration: none;">Idea Sharing & Voting System</a>
		    </div>
			<div align="center" class="bg-white m-2 p-2 border">
		    	<div class="">
					<h5 class="text-monospace">Change Account Information:</h5>
				</div>
				<form class="form-group mt-5" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" enctype="multipart/form-data">
					<input class="w-50 form-control" type="text" name="username" placeholder="Change Username"><br>
					<label></label>
					<input class="w-50 form-control" type="password" name="newpass" placeholder="Enter New Password"><br>
					<label></label>
					<input class="w-50 form-control" type="password" name="newconf" placeholder="Confirm New Password"><br><br>
					<input type="submit" class="btn btn-outline-secondary" name="change" value="Continue">
				</form>
				<div>
					All right reserved, 2021
				</div>
			</div>
		</div>
	</body>
</html>
