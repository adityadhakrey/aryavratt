<div class="scrollbar" onscroll="rscrr()" id="rscr" style="overflow-y:auto;height:800px;">
<?php
include("connection.php");
$em=$_COOKIE["Email"];
$userem=$_REQUEST["useremail"];
$q=mysqli_query($con,"select * from home where EMAIL='$userem' order by HOMEID desc");
while($row=mysqli_fetch_array($q))
{
	if($row["TYPE"]=="status")
	{
include("ushowstatus.php");
	}
	else if($row["TYPE"]=="picture")
	{
		include("ushowpicture.php");
	}
	else if($row["TYPE"]=="video")
	{
		include("ushowvideo.php");
	}
}
?>
</div>




