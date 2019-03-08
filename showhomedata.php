<div class="scrollbar" onscroll="hscrr()" id="hscr" style="overflow-y:auto;height:700px;">
<?php
include("connection.php");
$em=$_COOKIE["Email"];
$q=mysqli_query($con,"select * from home where (EMAIL='$em' or EMAIL in(select FRIENDEMAIL from friend where EMAIL='$em' and FRIENDEMAIL<>'$em'))  order by HOMEID desc");
while($row=mysqli_fetch_array($q))
{
	if($row["TYPE"]=="status")
	{
		include("showhomestatus.php");
	}
	else if($row["TYPE"]=="picture")
	{
		include("showhomepicture.php");
	}
	else if($row["TYPE"]=="video")
	{
		include("showhomevideo.php");
	}
}
?>
</div>