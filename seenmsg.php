<?php
include("connection.php");
$em=$_COOKIE["Email"];
date_default_timezone_set("Asia/Kolkata");
$email=$_REQUEST["email"];
$seentime=date("g:i a");
$seendate=date("F j,y");
$seenmsg=mysqli_query($con,"update message set SEENTIME='$seentime',SEENDATE='$seendate',STATUS='seen' where (MSGBY='$email' and MSGTO='$em') and STATUS='unseen'");
if($seenmsg==true)
{
echo "seen";
}
else
{
	echo "update message set SEENTIME='$seentime' and SEENDATE='$seendate' where (MSGBY='$email' and MSGTO='$em') and STATUS='unseen'";
}
?>