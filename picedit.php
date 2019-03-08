<?php
include("connection.php");
$em=$_COOKIE["Email"];
$text=$_REQUEST["text"];
$pid=$_REQUEST["pid"];
$updatepic=mysqli_query($con,"update picture set PICTURECAPTION='$text' where PICTUREID='$pid' and EMAIL='$em'");
if($updatepic==true)
{
$msg="Caption Updated";
}
else
{
$msg="Error";
}
echo $msg;
?>