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
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  	<head>
		<link rel="shortcut icon" href="icon-search.PNG" type="text/img">
		<meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">
		<link rel="stylesheet" href="bootstrap-4.1.3/css/bootstrap.css">
		<link rel="stylesheet" href="css/style.css">
		<script type="text/javascript" src="jquery/jquery.js"></script>
		<script type="text/javascript" src="bootstrap-4.1.3/js/bootstrap.js"></script>
		</script>
		<title>Posts Page</title>
	</head>
	<body class="bg-light">
		<div class="container position-relative">
			<nav class="navbar navbar-expand-md navbar-light bg-light border-bottom sticky-top position-fixed mb-5" style="top: 0">
				<a class="text-capitalize logo-text" href="index.php"><h3>Idea Sharing & Voting System</h3></a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarResponsive"> 
					<ul class="navbar-nav ml-auto">
						<?php
							if($role == 'Admin'){
								echo '<li class="nav-item active"><a class="text-info" href="manage_user.php">Manage User</a></li>';}
						?>
						<li class="nav-item active font-weight-bold">
							<a class="nav-link" href="manage_account.php">Edit profile</a>
						</li>
						<li class="nav-item font-weight-bold">
							<a class="nav-link" href="status.php">Status</a>
						</li>
						<li class="">
							<?php 	
								if($role == 'Admin' || $role == 'Sub Admin'){
									echo '<a class="nav-link text-capitalise" href="post_approve.php">Approve Posts</a>';
								} 
							?></li>
						<li class="font-weight-bold">
							<a class="nav-link text-capitalise" href="submit_idea.php">Submit Idea</a>
						</li>
						<li class="nav-item font-weight-bold">
							<a class="nav-link" href="logout.php">Log-out</a>
						</li>
					</ul>
				</div>	
			</nav>

			<?php
				include 'retrive.php';
				$post_idd = "SELECT * FROM idea WHERE approved = 'YES'";
				$p_id_qry = mysqli_query($cnct,$post_idd);
				if(!$p_id_qry)
				{
				  die('Could not get post: ' . mysql_error());
				}
				$p_id_ary = array();
				while($rrow = mysqli_fetch_assoc($p_id_qry)){
					$p_id_ary[] = "{$rrow['post_id']}";
				 }
				$ary_indx = 0;
				//to sort the array in reverse order inorder to get new posts
				rsort($p_id_ary);
				while ($ary_indx < count($p_id_ary)) :

				    $idea_id = $p_id_ary[$ary_indx];
				    $idea = getPost($idea_id,$cnct)[0];
				    $idea_by = getPost($idea_id,$cnct)[1];
				    $user = getUser($cnct,$idea_by);
				    $votes = countVote($cnct,$idea_id);
				    $vote = getMatch($cnct,$idea_id,$user_id);
				    //echo $votes;
			?>

			<div class="m-2 ml-sm-5 mr-sm-5 mt-5" align="center" style="padding-top: 35px;">

				<div class="p-2 p-sm-5 ml-sm-5 mr-sm-5 bg-white border" align="left">
					<div class="">
						<strong>Posted by: <?php echo $user; ?> </strong>
					</div><hr>
					<div class="container-fluid">
						<p class="" style="white-space: pre-line;"><?php echo $idea; ?></p>
					</div>
					<hr>
					<div class="">
						Votes <span class="badge-pill badge-primary" id="V<?php echo $idea_id; ?>1" name="<?php echo $idea_id; ?>"><?php
						echo $votes; ?></span>
						<span class="container-fluid">
					 		<input type="button" class="btn btn-outline-dark" id="V<?php echo $idea_id; ?>" onclick="approve(this.value,'V<?php echo $idea_id; ?>','<?php echo $idea_id; ?>')" value="<?php
					 		if($idea_by != $user_id){
					 			if($vote == 1){
									echo 'Unvote';
								}else{
									echo 'Vote';
								}
								}else{
									echo 'Unable';
								}
								 ?>">
				 		</span>
					</div>
				</div>
			</div>
			<?php
				$ary_indx = $ary_indx + 1;
				endwhile;
			?>
		</div>
		<footer class="bg-white">
			<div>&copy;2021, All Rights Reserved.</div>
		</footer>

		<script type="text/javascript">
				function approve(vl,id,ideaa){
				var idd = ideaa;
				//alert(passs);
				var xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function(){
					if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
						document.getElementById(id).value = xmlhttp.responseText;
						//to async vote number
					    getVote(id,ideaa);
					}
				};
				xmlhttp.open("GET" , "vote.php?val="+vl+"&idea="+idd, true);
				xmlhttp.send();
			}

				function getVote(id,ideaa){
				var idd = ideaa;
				var xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function(){
					if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
					document.getElementById(id+"1").innerHTML = xmlhttp.responseText;
					}
				};
				xmlhttp.open("GET" , "vote_count.php?&idea="+idd, true);
				xmlhttp.send();
			}
		</script>
	</body>
</html>
