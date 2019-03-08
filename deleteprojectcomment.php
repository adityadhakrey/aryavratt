<?php
include("connection.php");
$msg="";
$em=$_COOKIE["Email"];
$cid=$_REQUEST["commentid"];
$deletecomment=mysqli_query($con,"delete from projectcomment where COMMENTID=$cid ");
if($deletecomment==true)
{
$msg="Comment Deleted--!";
}
else
{
$msg="Error";
}
echo $msg;
