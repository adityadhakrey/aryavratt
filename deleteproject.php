<?php
include("connection.php");
$msg="";
$em=$_COOKIE["Email"];
$sid=$_REQUEST["sid"];
$deletestatus=mysqli_query($con,"delete from project where PROJECTID=$sid and EMAIL='$em'");
$deletestatuslike=mysqli_query($con,"delete from projectlike where PROJECTID=$sid ");
$deletestatusdislike=mysqli_query($con,"delete from projectdislike where PROJECTID=$sid ");
$deletestatuscomment=mysqli_query($con,"delete from projectcomment where PROJECTID=$sid ");
$deletenotification=mysqli_query($con,"delete from notification where PROJECTID=$sid ");
mysqli_autocommit($con,false);
try
{
if($deletestatus==false or $deletestatuslike==false or $deletestatusdislike==false or $deletestatuscomment==false or $deletenotification==false)
{
		throw new Exception("Error");
}
$msg="Comment Posted!";
	mysqli_commit($con);
}

catch(Exception $ex)
{
	mysqli_rollback($con);
}
echo $msg;
?>

