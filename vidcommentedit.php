<?php
include("connection.php");
$em=$_COOKIE["Email"];
$text=$_REQUEST["text"];
$cid=$_REQUEST["cid"];
$updatecomment=mysqli_query($con,"update videocomment set COMMENT='$text' where COMMENTID='$cid' and COMMENTBY='$em'");
if($updatecomment==true)
{
$msg="Comment Updated";
}
else
{
$msg="Error";
}
echo $msg;
?>