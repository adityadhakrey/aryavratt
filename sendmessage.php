<?php
include("connection.php");
date_default_timezone_set("Asia/Kolkata");
$msg=$_REQUEST["msg"];
$em=$_COOKIE["Email"];
$msgdate=date("F j,y");
$msgtime=date("g:i a");
$email=$_REQUEST["email"];
$sendmsg=mysqli_query($con,"insert into message(MESSAGE,MSGBY,MSGTO,DATE,TIME,STATUS)values('$msg','$em','$email','$msgdate','$msgtime','unseen')");
if($sendmsg==true)
{
echo "success";
}
else
{
echo "failed";
}

