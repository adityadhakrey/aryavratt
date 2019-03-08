<?php
include("connection.php");
date_default_timezone_set("Asia/Kolkata");
$msg="";
$em=$_COOKIE["Email"];
$liketime=date("g:i a");
$likedate=date("F j,y");
$sid=$_REQUEST["sid"];
$email=$_REQUEST["email"];

$checklike=mysqli_query($con,"select * from projectlike where LIKEBY='$em' and PROJECTID=$sid");
mysqli_autocommit($con,false);
try
{
if(mysqli_num_rows($checklike)>0)
{
$msg="Already LIked!";
}
else
{
$sendlike=mysqli_query($con,"insert into projectlike(PROJECTID,LIKEBY,DATE,TIME)values('$sid','$em','$likedate','$liketime')");
$sendstatusnoti=mysqli_query($con,"insert into notification(PROJECTID,NOTIFYBY,NOTIFYTO,NOTIFICATION,TYPE,DATE,TIME,STATUS)values('$sid','$em','$email','Liked Your Project','project','$likedate','$liketime','unseen')");
$removedislike=mysqli_query($con,"delete from projectdislike where PROJECTID=$sid and DISLIKEBY='$em'");

if($sendlike==false or $removedislike==false or $sendstatusnoti==false)
{
		throw new Exception("Error");
	}
	$msg="Comment Posted!";
	mysqli_commit($con);
}
}
catch(Exception $ex)
{
	mysqli_rollback($con);
}
echo $msg;

?>



