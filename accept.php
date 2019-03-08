<?php
include("connection.php");
$em=$_COOKIE["Email"];
date_default_timezone_set("Asia/Kolkata");
$msg="";
$accepttime=date("g:i a");
$acceptdate=date("F j,y");
$email=$_REQUEST["email"];
$addfriend=mysqli_query($con,"insert into friend(EMAIL,FRIENDEMAIL,DATE,TIME)values('$em','$email','$acceptdate','$accepttime')");
$addfriend=mysqli_query($con,"insert into friend(FRIENDEMAIL,EMAIL,DATE,TIME)values('$em','$email','$acceptdate','$accepttime')");
$removerequest=mysqli_query($con,"delete from request where REQUESTTO='$em' and REQUESTBY='$email'");
$notification=mysqli_query($con,"insert into notification(NOTIFYBY,NOTIFYTO,NOTIFICATION,TYPE,DATE,TIME,STATUS)values('$em','$email','Accepted Your Friend Request','request','$acceptdate','$accepttime','unseen')");
mysqli_autocommit($con,false);
try
{
if($addfriend==false or $removerequest==false or $notification==false)
{
		throw new Exception("Error");
	}
	$msg="User Has Been Added !";
	mysqli_commit($con);
}

catch(Exception $ex)
{
	mysqli_rollback($con);
}
echo $msg;

?>