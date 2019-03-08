<?php
include("connection.php");
$em=$_COOKIE["Email"];

$email=$_REQUEST["email"];
$declinerequest=mysqli_query($con,"delete from request where REQUESTTO='$em' and REQUESTBY='$email'");
if($declinerequest==true)
{
$msg="Declined !";
}
else
{
$msg="error";
}
echo $msg;
?>