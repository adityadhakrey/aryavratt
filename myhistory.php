<?php 
include("connection.php");

$em=$_COOKIE["Email"];
$fetchnoti=mysqli_query($con,"select s.FIRSTNAME,s.LASTNAME,s.EMAIL,s.PIC,n.NOTIFICATION,n.DATE,n.TIME,n.TYPE,n.STATUS,n.NOTIFYBY,n.NOTIFYTO,n.NOTIFYID from notification n,signup s where s.EMAIL<>'$em' and (s.EMAIL=n.NOTIFYTO and n.NOTIFYBY='$em') order by n.NOTIFYID desc");
while($getnoti=mysqli_fetch_array($fetchnoti))
{
$notification=$getnoti["NOTIFICATION"];
$fn=$getnoti["FIRSTNAME"];
$ln=$getnoti["LASTNAME"];

$unotification=str_replace("your","$fn $ln",$notification);

?>
<a href="noti.php?type=<?php echo $getnoti["TYPE"];?>&&id=<?php echo $getnoti["NOTIFYID"]; ?>" style="color:white;cursor:pointer;"  onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">You <?php echo $unotification; ?></a>
<h6 style="color:white;" class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i><?php echo $getnoti["DATE"];?> - <span class="w3-tag w3-teal w3-round"><?php echo $getnoti["TIME"];?></span></h6>
<div class="w3ls-border"> </div>
<?php
}
?>