<?php
include("connection.php");
date_default_timezone_set("Asia/Kolkata");
$msg="";
$em=$_COOKIE["Email"];
$commenttime=date("g:i a");
$commentdate=date("F j,y");
$vid=$_REQUEST["vid"];
$comment=$_REQUEST["comment"];
$email=$_REQUEST["email"];
mysqli_autocommit($con,false);
try
{
$sendvideocomment=mysqli_query($con,"insert into videocomment(VIDEOID,COMMENT,COMMENTBY,DATE,TIME)values('$vid','$comment','$em','$commentdate','$commenttime')");
$videonotification=mysqli_query($con,"insert into notification(VIDEOID,NOTIFYBY,NOTIFYTO,NOTIFICATION,TYPE,DATE,TIME,STATUS)values('$vid','$em','$email','Commented On Your Video','video','$commentdate','$commenttime','unseen')");
if($sendvideocomment==false or $videonotification==false)
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


