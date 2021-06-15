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
	include 'db_connect.php';
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
	<body class="container bg-light">
			<nav class="navbar navbar-blue">
					<div class="navbar-header">
			       <a class="text-capitalize logo-text" href="index.php"><h1>Idea Sharing & Voting System</h1></a>
			   </div>
			</nav><hr>

		<!--
		<div class="container-fluid">
			<form class="" enctype="multipart/form-data" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
				
					<label for="sel1">Select User:</label>
				    <select class="form-control" name="value" id="sel1">
				      <option></option>
				      <option>Name</option>
				      <option>Country</option>
				      <option>Age</option>
				      <option>12</option> 
				      <option>2333</option>   
				    </select>
				    <input type="submit" name="but" class="btn btn-outline-dark" value="Remove">
				    <input type="submit" name="register" value="Continue">
			</form>
		</div>
		-->

		<div class="bg-white p-5 border">
			<div class="mt-2">
		 		<h6>Newly Registered Users</h6>
			</div>
		 	<hr>
			<?php 
				$slct_usr = "SELECT * FROM user";
				$usr_qry = mysqli_query($cnct,$slct_usr);
				if(!$usr_qry)
				{
				  die('Could not get usr: ' . mysql_error());
				}
			    while($row = mysqli_fetch_assoc($usr_qry)):
				    $usr_id = "{$row['user_id']}";
				    $usr_name = "{$row['user_name']}";
				    $usr_email = "{$row['email']}";
				    $usr_pswd = "{$row['password']}";
				    $usr_role = "{$row['role']}";

					if($usr_role == "YET"): ?>

			<div class="">
			 	<span class=""><strong><?php echo $usr_name; ?></strong></span>
			 	<span class="">
			 		<input type="button" class="btn btn-outline-dark" id="rmv<?php echo $usr_id; ?>" onclick="approve(this.value,'rmv<?php echo $usr_id; ?>','<?php echo $usr_id; ?>')" value="Remove">
			 		<input type="button" class="btn btn-outline-dark" id="aprv<?php echo $usr_id; ?>" onclick="approve(this.value,'aprv<?php echo $usr_id; ?>','<?php echo $usr_id; ?>')" value="Approve">
			 	</span>
			</div>

			<?php endif ?>
			<?php endwhile ?>
			<hr>
			<div class="">
			 	<h6>Manage User Privilege</h6>
			</div>
			<hr>

			<?php 
				$slct_usr = "SELECT * FROM user";
				$usr_qry = mysqli_query($cnct,$slct_usr);
				if(!$usr_qry)
				{
				  die('Could not get usr: ' . mysql_error());
				}

				while($row = mysqli_fetch_assoc($usr_qry)):
				    $usr_id = "{$row['user_id']}";
				    $usr_name = "{$row['user_name']}";
				    $usr_email = "{$row['email']}";
				    $usr_pswd = "{$row['password']}";
				    $usr_role = "{$row['role']}";

				if($usr_role == "USER" || $usr_role == "Sub Admin"): 
			?>
			<div class="">
			 	<span class=""><strong><?php echo $usr_name; ?></strong></span>
			 	<span class="">
			 		<input type="button" class="btn btn-outline-dark" id="R<?php echo $usr_id; ?>" onclick="changeRole(this.value,'R<?php echo $usr_id; ?>','<?php echo $usr_id; ?>')" value="<?php echo $usr_role;?>">
			 	</span>
			</div>
			<?php endif ?>
			<?php endwhile ?>
		<hr>
		</div>


		<script type="text/javascript">
			function approve(vl,id,ussr){
				var userr = ussr;
				alert(userr);
				var xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function(){
					if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
						document.getElementById(id).value = xmlhttp.responseText;
					}
				};
				xmlhttp.open("GET" , "user_approval.php?val="+vl+"&user="+userr, true);
				xmlhttp.send();
			}

			//to chage user role
			function changeRole(vl,id,ussr){
				var userr = ussr;
				//alert(id);
				var xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function(){
					if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
				//document.getElementById(id).value = "hello";
						document.getElementById(id).value = xmlhttp.responseText;
					}
				};
				xmlhttp.open("GET" , "role_upgrade.php?val="+vl+"&user="+userr, true);
				xmlhttp.send();
			}
		</script>
	</body>
</html>