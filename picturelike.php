<?php
include("connection.php");
date_default_timezone_set("Asia/Kolkata");
$msg="";
$em=$_COOKIE["Email"];
$liketime=date("g:i a");
$likedate=date("F j,y");
$pid=$_REQUEST["pid"];
$email=$_REQUEST["email"];
$type=$_REQUEST["type"];
$checkprevious=mysqli_query($con,"select * from picturelike where PICTUREID='$pid' and LIKEBY='$em'");

if(mysqli_num_rows($checkprevious)>0)
{
	$updateit=mysqli_query($con,"update picturelike set TYPE='$type' where PICTUREID='$pid' and LIKEBY='$em'");
	$msg="d";
}
else
{
$likeit=mysqli_query($con,"insert into picturelike(LIKEBY,PICTUREID,TYPE,DATE,TIME)values('$em','$pid','$type','$likedate','$liketime')");
$notilike=mysqli_query($con,"insert into notification(NOTIFYBY,NOTIFYTO,PICTUREID,TYPE,DATE,TIME,STATUS,NOTIFICATION)values('$em','$email','$pid','picture','$likedate','$liketime','unseen','reacted on your picture')");
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

