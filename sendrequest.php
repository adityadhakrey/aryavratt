<?php
include("connection.php");
$em=$_COOKIE["Email"];
date_default_timezone_set("Asia/Kolkata");
$msg="";
$requesttime=date("g:i a");
$requestdate=date("F j,y");
$email=$_REQUEST["email"];
$sendrequest=mysqli_query($con,"insert into request(REQUESTBY,REQUESTTO,DATE,TIME)values('$em','$email','$requestdate','$requesttime')");
if($sendrequest==true)
{
$msg="Request Has Been Sent !";
}
else
{
$msg="Error !";
}
echo $msg;
?>