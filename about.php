<?php
include("connection.php");
$em=$_COOKIE["Email"];
$degree=$_REQUEST["degree"];
$school=$_REQUEST["high"];
$college=$_REQUEST["college"];
$current=$_REQUEST["current"];
$post=$_REQUEST["post"];
$previous=$_REQUEST["previous"];
$more=$_REQUEST["more"];
$interest=$_REQUEST["interest"];
$sendabout=mysqli_query($con,"insert into about(DEGREE,SCHOOL,COLLEGE,CURRENTWORK,POST,PREVIOUSWORK,MORE,EMAIL,INTEREST)values('$degree','$school','$college','$current','$post','$previous','$more','$em','$interest')");
if($sendabout==true)
{
$msg="Successfully Added";
}
else
{
$msg="Error";
}
echo $msg;
?>