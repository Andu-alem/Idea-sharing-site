<?php
	//database connection mysqli_connect(server,username,password,databasename)
	$cnct = mysqli_connect('localhost','root','');

	if(mysqli_connect_errno($cnct)){
		echo "Failed to connect".mysqli_connect_error();
	}
	echo "connected success<br>";

	$sql = "CREATE DATABASE votesystem";
	$cre_qry = mysqli_query($cnct,$sql);
	if(mysqli_connect_errno($cre_qry)){
		echo "Failed to connect".mysqli_connect_error();
	}
	echo "created success<br>";

	mysqli_select_db($cnct,'votesystem');

	$table_user = "CREATE TABLE user(
			user_id INT NOT NULL AUTO_INCREMENT, 
			user_name VARCHAR(50) NOT NULL, 
			password VARCHAR(500) NOT NULL, 
			email VARCHAR(50) NOT NULL, 
			role VARCHAR(30) NOT NULL, 
			primary key(user_id),
			UNIQUE(email))";
	$table_user_qry = mysqli_query($cnct,$table_user);
	if(mysqli_connect_errno($table_user_qry)){
		echo "Failed to connect".mysqli_connect_error();
	}
	echo "table created success<br>";

	$table_post = "CREATE TABLE idea(
			post_id INT NOT NULL AUTO_INCREMENT,
			post VARCHAR(1000) NOT NULL,
			posted_by int NOT NULL,
			approved VARCHAR(10) NOT NULL,
			primary key(post_id),
			FOREIGN KEY(posted_by) REFERENCES user(user_id))";
	$table_post_qry = mysqli_query($cnct,$table_post);

	if(mysqli_connect_errno($table_post_qry)){
		echo "Failed to connect".mysqli_connect_error();
	}
	echo "table idea created success<br>";


	$table_post_apr = "CREATE TABLE post_approval(
			user_id INT NOT NULL,
			post_id int NOT NULL,
			approval VARCHAR(30) NOT NULL,
			FOREIGN KEY(user_id) REFERENCES user(user_id),
			FOREIGN KEY(post_id) REFERENCES idea(post_id))";
	$table_post_apr_qry = mysqli_query($cnct,$table_post_apr);

	if(mysqli_connect_errno($table_post_apr_qry)){
		echo "Failed to connect".mysqli_connect_error();
	}
	echo "table approval created success<br>";


	$table_vote = "CREATE TABLE vote(
			v_id INT NOT NULL AUTO_INCREMENT,
			user_id INT NOT NULL,
			votes_for INT NOT NULL,
			primary key(v_id),
			FOREIGN KEY(user_id) REFERENCES user(user_id),
			FOREIGN KEY(votes_for) REFERENCES idea(post_id))";
	$table_vote_qry = mysqli_query($cnct,$table_vote);
	//checkError($table_vote_qry);
	if(mysqli_connect_errno($table_vote_qry)){
		echo "Failed to connect".mysqli_connect_error();
	}

	$table_user_aprv = "CREATE TABLE user_approval(
			user_id INT NOT NULL,
			approved_by INT NOT NULL,
			FOREIGN kEY(user_id) REFERENCES user(user_id),
			FOREIGN KEY(approved_by) REFERENCES user(user_id))";
	$table_user_aprv_qry = mysqli_query($cnct,$table_user_aprv);
	checkError($table_user_aprv_qry);


	function checkError($msg){
		if(mysqli_connect_errno($msg)){
			echo "Failed to connect".mysqli_connect_error();
		}	
	}

	mysqli_close($cnct);
?>