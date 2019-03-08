<div class="scrollbar" style="height:700px;overflow-y:auto;">
<?php
include("connection.php");
$em=$_COOKIE["Email"];
$nid=$_REQUEST["nid"];
$type=$_REQUEST["type"];
$fetch=mysqli_query($con,"select * from notification where NOTIFYTO='$em' and NOTIFYID='$nid'");
$n=mysqli_fetch_array($fetch);
if($n["TYPE"]=="status")
{
	include("notistatus.php");

}	
else if($n["TYPE"]=="picture")
{
	include("notipicture.php");
}
else if($n["TYPE"]=="video")
{
	include("notivideo.php");
}
else if($n["TYPE"]="project")
{
    include("notiproject.php");
}
?>
</div>