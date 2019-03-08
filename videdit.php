<?php
include("connection.php");
$em=$_COOKIE["Email"];
$text=$_REQUEST["text"];
$vid=$_REQUEST["vid"];
$updatevid=mysqli_query($con,"update video set VIDEOCAPTION='$text' where VIDEOID='$vid' and EMAIL='$em'");
if($updatevid==true)
{
$msg="Caption Updated";
}
else
{
$msg="Error";
}
echo $msg;
?>