<?php
include("connection.php");
date_default_timezone_set("Asia/Kolkata");
$msg="";
$em=$_COOKIE["Email"];
$commenttime=date("g:i a");
$commentdate=date("F j,y");
$pid=$_REQUEST["pid"];
$comment=$_REQUEST["comment"];
$email=$_REQUEST["email"];
mysqli_autocommit($con,false);
try
{
$sendpiccomment=mysqli_query($con,"insert into picturecomment(PICTUREID,COMMENT,COMMENTBY,DATE,TIME)values('$pid','$comment','$em','$commentdate','$commenttime')");
$picnotification=mysqli_query($con,"insert into notification(PICTUREID,NOTIFYBY,NOTIFYTO,NOTIFICATION,TYPE,DATE,TIME,STATUS)values('$pid','$em','$email','Commented On Your Picture','picture','$commentdate','$commenttime','unseen')");
if($sendpiccomment==false or $picnotification==false)
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


