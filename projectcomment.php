<?php
include("connection.php");
date_default_timezone_set("Asia/Kolkata");
$msg="";
$em=$_COOKIE["Email"];
$commenttime=date("g:i a");
$commentdate=date("F j,y");
$sid=$_REQUEST["sid"];
$comment=$_REQUEST["comment"];
$email=$_REQUEST["email"];
mysqli_autocommit($con,false);
try
{
	$sendcomment=mysqli_query($con,"insert into projectcomment(PROJECTID,COMMENT,COMMENTBY,DATE,TIME)values('$sid','$comment','$em','$commentdate','$commenttime')");
	$notification=mysqli_query($con,"insert into notification(PROJECTID,NOTIFYBY,NOTIFYTO,NOTIFICATION,TYPE,DATE,TIME,STATUS)values('$sid','$em','$email','Commented On Your Project','project','$commentdate','$commenttime','unseen')");
	if($sendcomment==false or $notification==false)
	{
		throw new Exception("Error");
	}
	$msg="Comment Posted!";
	mysqli_commit($con);
}
catch(Exception $ex)
{
	mysqli_rollback($con);
}
echo $msg;

?>


