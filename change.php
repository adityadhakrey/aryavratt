<?php
include("connection.php");
$em=$_COOKIE["Email"];
$notifyid=$_REQUEST["nid"];
$change=mysqli_query($con,"update notification set STATUS='seen' where NOTIFYID='$notifyid' and NOTIFYTO='$em'");
if($change==true)
{
echo "Done..!";
}
else
{
echo "Something Went Wrong";
}
?>