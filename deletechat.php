<?php
include("connection.php");
$em=$_COOKIE["Email"];
$msgby=$_REQUEST["email"];
$dltchat=mysqli_query($con,"delete from message where MSGBY='$msgby' and MSGTO='$em'");
if($dltchat==true)
{
echo "Deleted";
}
?>