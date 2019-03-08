<?php
include("connection.php");
$em=$_COOKIE["Email"];

$msgid=$_REQUEST["msgid"];
$dltmsg=mysqli_query($con,"delete from message where MSGID='$msgid'");
if($dltmsg==true)
{
echo "Deleted";
}
?>