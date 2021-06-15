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
	include 'retrive.php';
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
			<div class="pl-3">
			    <a class="h2 logo-text text-capitalize" href="index.php" style="text-decoration: none;">Idea Sharing & Voting System</a>
			</div>
			<div class="m-4 p-4 bg-white border">
				<h6>Your Previlege is:</h6>
				<?php echo $role; ?>
				<h6>Number of posted ideas by you:</h6>
				<?php echo postCount($user_id,$cnct); ?>
				<span><h6>You votes for - <?php echo voteByUser($user_id,$cnct); ?> - ideas</h6></span>
			</div>
		</div>
	</body>
</html>