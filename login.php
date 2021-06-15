<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		 <link rel="shortcut icon" href="icon-search.PNG" type="text/img">
	    <meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">
	    <link rel="stylesheet" href="bootstrap-4.1.3/css/bootstrap.css">
	    <link rel="stylesheet" href="css/style.css">
	    <script type="text/javascript" src="jquery/jquery.js"></script> 
         <script type="text/javascript" src="bootstrap-4.1.3/js/bootstrap.js"></script>
		<title>log in page</title>
	</head>
	<body class="bg-light">

		<?php
			if((isset($_POST["login"]))&&($_POST["email"]!="")&&($_POST["password"]!="")){
				include 'user.php';
				$password = md5($_POST["password"]);
				$email = $_POST["email"];
				$user_id = getUserRole($email,$password,$cnct)[0];
				$user_role = getUserRole($email,$password,$cnct)[1];

				if($user_id != "" || $user_id != NULL){
					session_start();
					$_SESSION['user_id'] = $user_id;
					$_SESSION['role'] = $user_role;
					header('location:index.php');
				}
			}
		 ?>


		<div class="container mr-md-5 ml-md-5 pl-md-5 pr-md-5">
			<div class="m-sm-2 pl-3">
				<a class="h2 logo-text text-capitalize" href="index.php" style="text-decoration: none;">Idea Sharing & Voting System</a>
			</div>
			<div align="center" class="p-3 ml-sm-4 mr-sm-4 bg-white border">
				<form class="form-group mt-5" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" enctype="multipart/form-data">
					<div id="emailDiv">
						<input class="w-50 form-control" type="text" name="email" placeholder="username or email" id="email">
					</div><br>
					<div id="pwdDiv">
						<input class="w-50 form-control" type="password" name="password" placeholder="password" id="password">
					</div><br>
					<input class="btn-sm btn-outline-primary" type="submit" name="login" value="Log-In" id="submitBtn">
				</form>
				<div class="">
					<a href="register.php">Register</a>
					<hr>
				</div>
				<div>
					All right reserved, 2021
				</div>
			</div>	
		</div>
		<script type="text/javascript">
			$(document).ready(function(){
            //$("#submitBtn").disabled = true;
            $("#submitBtn").attr("disabled", true);
            $("#confirmation").attr("disabled", true);
            var errors = {'pwd': true, 'email': true};

            $("#email").on({
              change: function(){
                if($(this).val().length == 0){
                  $("#emailDiv").append("<p class='text-danger'>Please enter your email</p>");
                  errors['email'] = true;
                }else{
                  var email = $(this).val();
                  if(!(/@/.test(email)) && !(/.com/i.test(email))){
                     $("#emailDiv").append("<p class='text-danger'>Email must look like this: name@example.com</p>");
                     errors['email'] = true;
                  }else{
                    errors['email'] = false;
                    enableSubmit();
                  }
                }
              }
            });


            $("#password").on({
                change: function(){
                  var pwdLength = $(this).val().length;
                  if(pwdLength == 0){
                    $("#pwdDiv").append("<p class='text-danger'>Please type your password");
                    $("#confirmation").attr("disabled", true);
                    errors['pwd'] = true;
                  }else if(pwdLength > 0 && pwdLength < 8){
                    $("#pwdDiv").append("<p class='text-danger'>Password must be >= 8");
                    $("#confirmation").attr("disabled", true);
                    errors['pwd'] = true;
                  }else{
                    $("#confirmation").attr("disabled", false);
                    errors['pwd'] = false;
                  }
                  enableSubmit();
                }
            });

            function enableSubmit(){
              var counter = 0;
              for(k in errors){
                if(errors[k] == true){
                  counter++;
                }
              }
              if(errors['pwd'] && errors['email']){
                $('#submitBtn').attr('disabled', true);
              }else{
                $('#submitBtn').attr('disabled', false);
              }
            }
        });
		</script>
	</body>
</html>
