<?php 
  include 'db_connect.php';


  //get the number of votes
  function countVote($cnct,$post_id){
  	$vote = "SELECT v_id FROM vote WHERE votes_for = '$post_id'";
  	$v_qry = mysqli_query($cnct,$vote);
    if(!$v_qry)
    {
      die('Could not get post: ' . mysql_error());
    }
    $vall = 0;
    while($row = mysqli_fetch_assoc($v_qry))
    {
      $vall = $vall+1;
    }
    return $vall;
  }


  //
  function getMatch($cnct,$post_id,$user_id){
  	$vote = "SELECT user_id FROM vote WHERE user_id = '$user_id' AND votes_for = '$post_id'";
  	$v_qry = mysqli_query($cnct,$vote);
    if(!$v_qry)
    {
      die('Could not get post: ' . mysql_error());
    }

    $row = mysqli_fetch_assoc($v_qry);
    return count($row);
  }


  //get all posts
  function getPost($post_id,$cnct){
  $post = "SELECT post,posted_by,approved FROM idea WHERE post_id = '$post_id'";
  $post_qry = mysqli_query($cnct,$post);
   if(!$post_qry)
  	{
  	  die('Could not get posts name data: ' . mysql_error());
  	}
    $post_array = mysqli_fetch_array($post_qry);
    return $post_array;
  }

  //
  function getUser($cnct,$user_id){
    $u = "SELECT user_name FROM user WHERE user_id = '$user_id'";
    $u_qry = mysqli_query($cnct,$u);
    if(!$u_qry)
    {
      die('Could not get post: ' . mysql_error());
    }

    $row = mysqli_fetch_array($u_qry);
    return $row[0];
  }

  //count posts by particular user
  function postCount($user_id,$cnct){
  $post = "SELECT * FROM idea WHERE posted_by = '$user_id'";
  $post_qry = mysqli_query($cnct,$post);
   if(!$post_qry)
    {
      die('Could not get posts name data: ' . mysql_error());
    }
    $vall = 0;
    while($row = mysqli_fetch_assoc($post_qry)){
      $vall = $vall+1;
    }
    return $vall;
  }

  //votes by particular user
  function voteByUser($user_id,$cnct){
  $vote = "SELECT * FROM vote WHERE user_id = '$user_id'";
  $vt_qry = mysqli_query($cnct,$vote);
   if(!$vt_qry)
    {
      die('Could not get posts name data: ' . mysql_error());
    }
    $vall = 0;
    while($row = mysqli_fetch_assoc($vt_qry)){
      $vall = $vall+1;
    }
    return $vall;
  }
?>
