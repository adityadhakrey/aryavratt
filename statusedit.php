<?php
include("connection.php");
$em=$_COOKIE["Email"];
$text=$_REQUEST["text"];
$sid=$_REQUEST["sid"];
$updatestatus=mysqli_query($con,"update status set STATUS='$text' where STATUSID='$sid' and EMAIL='$em'");
if($updatestatus==true)
{
$msg="Status Updated";
}
else
{
$msg="Error";
}
echo $msg;
?>