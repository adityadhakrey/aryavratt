<div class="scrollbar" id="msgscr" onscroll="msgscrl()" style="height:500px;overflow-y:auto;">
<?php
include("connection.php");
$em=$_COOKIE["Email"];
$fetchmsg=mysqli_query($con,"select s.FIRSTNAME,s.LASTNAME,s.EMAIL,s.PIC from signup s where s.EMAIL in(select MSGBY from message where MSGTO='$em')");
$i=0;
while($msg=mysqli_fetch_array($fetchmsg))
{
	$i++;
	$msgby=$msg["EMAIL"];
	$q=mysqli_query($con,"select * from message where MSGBY='$msgby' and MSGTO='$em'");
	if($row=mysqli_fetch_array($q))
	{	
?>
<div class="w3-address-grid">
<div class="w3ls-post-grids">
<h5 style="color:white;" class="w3-opacity"><img src="user/<?php echo $msg["PIC"];?>" class="img img-circle" style="width:10%;height:50px;"><a onclick="amsg('<?php echo $msgby; ?>');seenmsg('<?php echo $msgby;?>')" onmouseout="this.style.color='white'"onmouseover="this.style.color ='orange'" style="cursor;pointer;color:white;"><?php echo $msg["FIRSTNAME"]."&nbsp".$msg["LASTNAME"];?></a></h5>
 <?php
 if($row["MSGBY"]=='$em')
 {
	 ?>
<h6 style="color:white;" class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i><?php echo $row["DATE"];?> - <span class="w3-tag w3-teal w3-round"><?php echo $row["TIME"];?></span></h6>
 <p onclick="amsg('<?php echo $msgby; ?>')"  style="color:white;"><?php echo $row["MESSAGE"];?>&nbsp <i class="fa fa-arrow-circle-up" style="color:green;"></i></p>	 
	 <?php
 }
 else
 {
	 ?>
 <h6 style="color:white;" class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i><?php echo $row["DATE"];?> - <span class="w3-tag w3-teal w3-round"><?php echo $row["TIME"];?></span></h6>
 <p onclick="amsg('<?php echo $msgby; ?>')"  style="color:white;"><?php echo $row["MESSAGE"];?>&nbsp <i class="fa fa-arrow-circle-down" style="color:green;"></i></p>
	<?php
 }
 ?>
	
	<div class="msg_footer"><textarea onclick="amsg('<?php echo $msgby; ?>');seenmsg('<?php echo $msgby;?>')" id="msgb<?php echo $i;?>" onkeypress="savediv(event,<?php echo $i;?>)" style="resize:none;width:100%;" rows=5 placeholder="reply From Here.." class="form-control"></textarea></div>

</div>
</div>
<?php
}
}
?>
</div>