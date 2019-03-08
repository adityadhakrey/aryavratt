<?php
include("connection.php");
date_default_timezone_set("Asia/Kolkata");
$msg="";
$em=$_COOKIE["Email"];
$status=$_REQUEST["status"];
$posttime=date("g:i a");
$postdate=date("F j,y");
$send=mysqli_query($con,"insert into status(STATUS,EMAIL,DATE,TIME)values('$status','$em','$postdate','$posttime')");

if($send==true)
{
	$sid=$con->insert_id;
$sendhome=mysqli_query($con,"insert into home(STATUSID,STATUS,EMAIL,DATE,TIME,TYPE)values('$sid','$status','$em','$postdate','$posttime','status')");
$msg="Your Status Has Been Successfully Post!";
}
else
{
$msg="Erro!Contact To Our Team";
}
echo $msg;
?>