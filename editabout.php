<?php
include("connection.php");
$msg="ssw";
$em=$_COOKIE["Email"];
$degree=$_REQUEST["degree"];
$school=$_REQUEST["high"];
$college=$_REQUEST["college"];
$current=$_REQUEST["current"];
$post=$_REQUEST["post"];
$previous=$_REQUEST["previous"];
$more=$_REQUEST["more"];
$interest=$_REQUEST["interest"];
$editabout=mysqli_query($con,"update about set DEGREE='$degree',SCHOOL='$school',COLLEGE='$college',CURRENTWORK='$current',POST='$post',PREVIOUSWORK='$previous',MORE='$more',INTEREST='$interest' where EMAIL='$em' ");
if($editabout==true)
{
$msg="update about set DEGREE='$degree',SCHOOL='$school',COLLEGE='$college',CURRENTWORK='$current',POST='$post',PREVIOUSWORK='$previous',MORE='$more',INTEREST='$interest' where EMAIL='$em' ";
}
else
{
$msg="Error";
}
echo $msg."hi";
?>