<?php
include("connection.php");
$msg="";
$em=$_COOKIE["Email"];
$prid=$_REQUEST["prid"];
$rem=mysqli_query($con,"delete from bookmark where PROJECTID='$prid' and BOOKBY='$em'");
if($rem==true)
{
$msg="true";
}
else
{
$msg="false";
}
echo $msg;
?>