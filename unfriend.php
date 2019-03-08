<?php
include("connection.php");
$em=$_COOKIE["Email"];
$msg="";
$email=$_REQUEST["email"];
$unfriend=mysqli_query($con,"delete from friend where EMAIL='$em' and FRIENDEMAIL='$email'");
$unfriend=mysqli_query($con,"delete from friend where FRIENDEMAIL='$em' and EMAIL='$email'");
if($unfriend==true)
{
$msg="You Just Unfriend This User !";
}
else
{
$msg="Error !";
}
echo $msg;
?>