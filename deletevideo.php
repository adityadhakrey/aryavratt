<?php
include("connection.php");
$msg="";
$em=$_COOKIE["Email"];
$vid=$_REQUEST["vid"];
$deletevideo=mysqli_query($con,"delete from video where VIDEOID=$vid and EMAIL='$em'");
$deletevideohome=mysqli_query($con,"delete from home where VIDEOID=$vid and EMAIL='$em'");
$deletevideolike=mysqli_query($con,"delete from videolike where VIDEOID=$vid ");
$deletevideodislike=mysqli_query($con,"delete from videodislike where VIDEOID=$vid ");
$deletevideocomment=mysqli_query($con,"delete from videocomment where VIDEOID=$vid ");
$deletenotification=mysqli_query($con,"delete from notification where VIDEOID=$vid ");
mysqli_autocommit($con,false);
try
{
if($deletevideo==false or $deletevideohome==false or $deletevideolike==false or $deletevideodislike==false or $deletevideocomment==false or $deletenotification==false)
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


