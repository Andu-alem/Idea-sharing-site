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
		       <a class="text-capitalize logo-text" href="index.php"><h2>Idea Sharing & Voting System</h2></a>
		   </div>
		</nav><hr>

		<?php 
			include 'retrive.php';
			$post = "SELECT post_id,post,posted_by FROM idea WHERE approved = 'YET'";
			$p_qry = mysqli_query($cnct,$post);
			if(!$p_qry)
			{
			  die('Could not get post: ' . mysql_error());
			}

			if(mysqli_fetch_assoc($p_qry)==""){
			   echo "<div class='bg-white p-5' align='center'><h2>There is no post waiting for your approval!!!</h2></div>";
			}
			while($row = mysqli_fetch_assoc($p_qry)):
			    $idea = "{$row['post']}";
			    $idea_by = "{$row['posted_by']}";
			    $idea_id = "{$row['post_id']}";
			    $user = getUser($cnct,$idea_by);
			    $votes = countVote($cnct,$idea_id);
			    $vote = getMatch($cnct,$idea_id,$user_id);
		?>

		<div class="row pb-3 pt-3">
			<div class="col-3">
				
			</div>

			<div class="border col-7">
				<div class="">
					<strong>Posted by: <?php echo $user.' andualem'; ?> </strong>
				</div><hr>
				<div class="">
					<p class="" style="white-space: pre-line;"><?php echo $idea; ?></p>
				</div>
				<hr>
				<div class="">
					<input type="button" class="btn btn-outline-dark" id="D<?php echo $idea_id; ?>" onclick="approve(this.value,'D<?php echo $idea_id; ?>','<?php echo $idea_id; ?>')" value="Disapprove">
			 		<input type="button" class="btn btn-outline-dark" id="I<?php echo $idea_id; ?>" onclick="approve(this.value,'I<?php echo $idea_id; ?>','<?php echo $idea_id; ?>')" value="Approve">
				</div>
			</div>

			<div class="col-2">
				
			</div>
		</div>
		<?php endwhile ?>

		<script type="text/javascript">
			function approve(vl,id,ideaa){
				var idd = ideaa;
				//alert(id);
				var xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function(){
					if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
						document.getElementById(id).value = xmlhttp.responseText;
					}
				};
				xmlhttp.open("GET" , "post_approval.php?val="+vl+"&idea="+idd, true);
				xmlhttp.send();
			}
		</script>
	</body>
</html>