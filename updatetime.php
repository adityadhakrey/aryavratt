<?php
if(isset($_COOKIE["email"]))
{
include("connection.php");
date_default_timezone_set("Asia/Kolkata");
$em=$_COOKIE["Email"];
$usertime=date("F j,y g:i a");
//$u=date("F j,y-g:i a");
$updatetime=mysqli_query($con,"update signup set TIME='$usertime' where EMAIL='$em'");
if($updatetime==true)
{
	$msg="Updated";
}
else
{
	$msg="error";
}
echo $msg;
}
?>