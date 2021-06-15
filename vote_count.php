<?php 
  include 'db_connect.php';
  $post_id = $_GET['idea'];
  $vote = "SELECT v_id FROM vote WHERE votes_for = '$post_id'";
  $v_qry = mysqli_query($cnct,$vote);
  if(!$v_qry)
  {
    die('Could not get post: ' . mysql_error());
  }
  $vall = 0;
  while($row = mysqli_fetch_assoc($v_qry)){
    $vall = $vall+1;
  }
  echo $vall;
?>