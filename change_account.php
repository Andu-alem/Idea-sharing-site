<?php 
	if(isset($_SESSION['user_id'])){
		$user_id = $_SESSION['user_id'];
		$role = $_SESSION['role'];
		//echo $_SESSION['user_id']."    ".$_SESSION['role']."<br>";
	}else{
		header('location:login.php');
		exit();
	}
	include 'db_connect.php';

	if((isset($_POST["change"]))&&(($_POST["username"]!="")||(($_POST["newpass"]!="")&&($_POST["newconf"]!="")))){
		$username = $_POST['username'];
		$newpass = $_POST['newpass'];
		$pswd = md5($newpass);
		$conf = $_POST['newconf'];
			if(($username != "")&&($newpass!= "")&&($conf!="")){
		        if($newpass == $conf){
		        $insert = "UPDATE user SET user_name='$username',password='$pswd' WHERE user_id = '$user_id'";
		        $ins_qry = mysqli_query($cnct,$insert);
		        	if(!$ins_qry)
					{
					  die('Could not set new password data: ' . mysql_error());
					}
		    }else{
		    	echo "Confirm Password";
		    }

		}elseif (($username=="")&&(($newpass!= "")&&($conf!=""))) {
			if($newpass==$conf){
				$insert = "UPDATE user SET password='$pswd' WHERE user_id = '$user_id'";
		        $ins_qry = mysqli_query($cnct,$insert);
		        	if(!$ins_qry)
					{
					  die('Could not set new password data: ' . mysql_error());
					}
			}else{
				echo "Confirm Password";
			}
		}elseif (($username!="")&&(($newpass == "")&&($conf==""))) {
				$insert = "UPDATE user SET user_name = '$username' WHERE user_id = '$user_id'";
		        $ins_qry = mysqli_query($cnct,$insert);
		        	if(!$ins_qry)
					{
					  die('Could not set new password data: ' . mysql_error());
					}
		}
	}
?>