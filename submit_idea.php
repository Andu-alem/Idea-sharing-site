<?php 
session_start();

if(isset($_SESSION['user_id'])){
	//$user_id = $_SESSION['user_id'];
	//$role = $_SESSION['role'];
	//echo $_SESSION['user_id']."    ".$_SESSION['role']."<br>";
}else{
	header('location:login.php');
	exit();
}
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
	    <link rel="shortcut icon" href="icon-search.PNG" type="text/img">
	    <meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">
	    <link rel="stylesheet" href="bootstrap-4.1.3/css/bootstrap.css">
	    <link rel="stylesheet" href="css/style.css">
	    </script>
		<title>Posts Page</title>
	</head>
	<body class="bg-light container">
		<div class="pl-md-5 pr-md-5">
			<div class="m-sm-2 pl-sm-3">
			    <a class="h2 logo-text text-capitalize" href="index.php" style="text-decoration: none;">Idea Sharing & Voting System</a>
			</div>
			<hr>
			<?php 
			if(isset($_POST['register'])&&$_POST['idea']!=""){
				include 'submit.php';
			}
			 ?>

			<div class="p-1 p-sm-2 ml-sm-5 mr-sm-5 bg-white" align="center">
				<form class="form-group ml-md-5 mr-md-5" enctype="multipart/form-data" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
					<label class="text-monospace h4">Write your ideas below:</label>
					<textarea class="form-control m-md-5 p-2" name="idea" rows="10"></textarea>
					<input type="submit" name="register" class="btn btn-outline-secondary btn-md mt-2" value="Post">
				</form>
			</div>
		</div>
	</body>
</html>