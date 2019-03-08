<?php
include("connection.php");
date_default_timezone_set("Asia/Kolkata");
$msg="";
$em=$_COOKIE["Email"];
$liketime=date("g:i a");
$likedate=date("F j,y");
$sid=$_REQUEST["sid"];
$email=$_REQUEST["email"];
$type=$_REQUEST["type"];
$checkprevious=mysqli_query($con,"select * from statuslike where STATUSID='$sid' and LIKEBY='$em'");

if(mysqli_num_rows($checkprevious)>0)
{
	$updateit=mysqli_query($con,"update statuslike set TYPE='$type' where STATUSID='$sid' and LIKEBY='$em'");
}
else
{
$likeit=mysqli_query($con,"insert into statuslike(LIKEBY,STATUSID,TYPE,DATE,TIME)values('$em','$sid','$type','$likedate','$liketime')");
$notilike=mysqli_query($con,"insert into notification(NOTIFYBY,NOTIFYTO,STATUSID,TYPE,DATE,TIME,STATUS,NOTIFICATION)values('$em','$email','$sid','status','$likedate','$liketime','unseen','reacted on your status')");
if($likeit==true or $notilike==true)
{
	$msg="acd";
}
else
{
	$msg="insert into statuslike(LIKEBY,TYPE,DATE,TIME)values('$em','$type','$likedate','$liketime')";
}
}
echo $msg;

?>

