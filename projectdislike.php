<?php
include("connection.php");
date_default_timezone_set("Asia/Kolkata");
$msg="";
$em=$_COOKIE["Email"];
$liketime=date("g:i a");
$likedate=date("F j,y");
$sid=$_REQUEST["sid"];

$checklike=mysqli_query($con,"select * from projectdislike where DISLIKEBY='$em' and PROJECTID=$sid");
mysqli_autocommit($con,false);
try
{
if(mysqli_num_rows($checklike)>0)
{
	
$msg="Already Disliked!";
}
else
{
$sendlike=mysqli_query($con,"insert into projectdislike(PROJECTID,DISLIKEBY,DATE,TIME)values('$sid','$em','$likedate','$liketime')");
$removelike=mysqli_query($con,"delete from projectlike where PROJECTID=$sid and LIKEBY='$em'");
if($sendlike==false or $removelike==false)
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


