<?php
include("connection.php");
$em=$_COOKIE["Email"];
$msg="";
$email=$_REQUEST["email"];
$cancelrequest=mysqli_query($con,"delete from request where REQUESTBY='$em' and REQUESTTO='$email'");
if($cancelrequest==true)
{
$msg="Request Has Been Canceled !";
}
else
{
$msg="Error !";
}
echo $msg;
?>