<?php
include("connection.php");
$em=$_COOKIE["Email"];
$vid=$_REQUEST["vid"];
$msg="";
$checkseen=mysqli_query($con,"select * from seenvideo where EMAIL='$em' and VIDEOID='$vid' ");
mysqli_autocommit($con,false);
try
{
if(mysqli_num_rows($checkseen)>0)
{
$msg="already seen";
}
else
{
$sendseen=mysqli_query($con,"insert into seenvideo(VIDEOID,EMAIL)values('$vid','$em')");
if($sendseen==false or $checkseen=="false")
{
		throw new Exception("Error");
}
$msg="Comment Posted!";
	mysqli_commit($con);
}
}
catch(Exception $ex)
{
	mysqli_rollback($con);
}
echo $msg;
?>