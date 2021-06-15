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
		<title>log in page</title>
	</head>
	<body class="bg-color">

		<?php 
			if((isset($_POST["register"]))&&($_POST["username"]!="")&&($_POST["password"]!="")&&($_POST["email"]!="")&&($_POST["confirm"]!="")){
				if($_POST["password"] == $_POST["confirm"]){
					include 'user.php';
					$password = md5($_POST["password"]);
					$username = $_POST["username"];
					$email = $_POST['email'];
			 
					registerUser($username,$email,$password,$cnct);//add new user in to database

					$user_id = getUserId($username,$email,$password,$cnct)[0];
					$user_role = getUserId($username,$email,$password,$cnct)[1];

					
					if($user_id != "" || $user_id != NULL){
						echo "Registered Successfully Wait for Approval";
						session_start();
						$_SESSION['user_id'] = $user_id;
						$_SESSION['role'] = $user_role;
						header('location:index.php');
					}else{
						echo "can not pass";
					}
				}else{
					echo "Password Confirmation Error!";
				}
			}
		 ?>
		 

		<div class="container m-3 mr-md-5 ml-md-5 pl-md-5 pr-md-5 w-auto">
			<div class="m-2 pl-3">
				<a class="h2 text-success text-capitalize" href="index.php" style="text-decoration: none;">Idea Sharing & Voting System</a>
			</div>

			<div align="center" class="bg-white m-md-5 m-4 h-100 p-3">
				<form class="form-group mt-5" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post"
					enctype="multipart/form-data">
					<div id="unDiv">
						<input class="w-50 form-control" type="text" name="username" placeholder="Username" id="username">
					</div><br>
					<div id="emailDiv">
						<input class="w-50 form-control" type="text" name="email" placeholder="Email" id="email">
					</div><br>
					<div id="pwdDiv">
						<input class="w-50 form-control" type="password" name="password" placeholder="password" id="password">
					</div><br>
					<div id="confirmDiv">
						<input class="w-50 form-control" type="password" name="confirm" placeholder="Confirm Password" id="confirm">
					</div><br>
					<input class="btn-sm btn-outline-primary" type="submit" name="register" value="Continue" id="submitBtn">
				</form>
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
            var errors = {'name': true, 'pwd': true, 'confirm': true, 'phone': true, 'email': true};

            $("#username").on({
              change: function(){
                if($(this).val().length == 0){
                  $("#unDiv").append("<p class='text-danger'>Please enter your name</p>");
                  errors['name'] = true;
                }else{
                  errors['name'] = false;
                }
                enableSubmit();
              }
            });

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
            $("#confirmation").on({
                change: function(){
                  var pwdLength = $(this).val().length;
                  if(pwdLength == 0){
                    $("#confirmDiv").append("<p class='text-danger'>Please confirm your password");
                    errors['confirm'] = true;
                  }else if(pwdLength > 0 && pwdLength < 8){
                    $("#confirmDiv").append("<p class='text-danger'>Password must be >= 8");
                    errors['confirm'] = true;
                  }else if($("#password").val() != $(this).val()){
                    $("#confirmDiv").append("<p class='text-danger'>Password didn't match");
                    errors['confirm'] = true;
                  }else {
                    errors['confirm'] = false;
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
              if(counter > 0){
                $('#submitBtn').attr('disabled', true);
              }else{
                $('#submitBtn').attr('disabled', false);
              }
            }
        });
		</script>
	</body>
</html>