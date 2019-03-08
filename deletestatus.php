<?php
include("connection.php");
$msg="";
$em=$_COOKIE["Email"];
$sid=$_REQUEST["sid"];
$deletestatus=mysqli_query($con,"delete from status where STATUSID=$sid and EMAIL='$em'");
$deletestatushome=mysqli_query($con,"delete from home where STATUSID=$sid and EMAIL='$em'");
$deletestatuslike=mysqli_query($con,"delete from statuslike where STATUSID=$sid ");
$deletestatusdislike=mysqli_query($con,"delete from statusdislike where STATUSID=$sid ");
$deletestatuscomment=mysqli_query($con,"delete from statuscomment where STATUSID=$sid ");
$deletenotification=mysqli_query($con,"delete from notification where STATUSID=$sid ");
mysqli_autocommit($con,false);
try
{
if($deletestatus==false or $deletestatushome==false or $deletestatuslike==false or $deletestatusdislike==false or $deletestatuscomment==false or $deletenotification==false)
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

