<?php
include("connection.php");
$msg="";
$em=$_COOKIE["Email"];
$pid=$_REQUEST["pid"];
$deletepicture=mysqli_query($con,"delete from picture where PICTUREID=$pid and EMAIL='$em'");
$deletepicturehome=mysqli_query($con,"delete from home where PICTUREID=$pid and EMAIL='$em'");
$deletepicturelike=mysqli_query($con,"delete from picturelike where PICTUREID=$pid ");
$deletepicturedislike=mysqli_query($con,"delete from picturedislike where PICTUREID=$pid ");
$deletepicturecomment=mysqli_query($con,"delete from picturecomment where PICTUREID=$pid ");
$deletenotification=mysqli_query($con,"delete from notification where PICTUREID=$pid ");
mysqli_autocommit($con,false);
try
{
if($deletepicture==false or $deletepicturehome==false or $deletepicturelike==false or $deletepicturedislike==false or $deletepicturecomment==false or $deletenotification==false)
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


