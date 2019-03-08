<?php
include("connection.php");
date_default_timezone_set("Asia/Kolkata");
$em=$_COOKIE["Email"];
$t=date("g:i a");
$d=date("F j,y");
$prid=$_REQUEST["prid"];
$email=$_REQUEST["email"];
$booked=mysqli_query($con,"insert into bookmark(BOOKBY,BOOKOF,PROJECTID,DATE,TIME)values('$em','$email','$prid','$d','$t')");
if($booked==true)
{
$msg="success";
}
else
{
$msg="failed";
}
echo $msg;
?>