<?php
include("connection.php");
$em=$_COOKIE["Email"];
$fr=$_REQUEST["fr"];
?>


<div class="ms_wrap">
<?php
if($fr=="first")
{
	$fetchmsg=mysqli_query($con,"select s.FIRSTNAME,s.LASTNAME,s.EMAIL,s.PIC from signup s where s.EMAIL in(select MSGBY from message where MSGTO='$em')");
    $msg=mysqli_fetch_array($fetchmsg);
	$msgby=$msg["EMAIL"];
	$fuser=mysqli_query($con,"select s.FIRSTNAME,s.LASTNAME,s.EMAIL,f.FRIENDEMAIL,f.EMAIL,f.FRIENDID from friend f,signup s where s.EMAIL=f.FRIENDEMAIL and (f.EMAIL='$em' and s.EMAIL<>'$em') and f.FRIENDEMAIL='$msgby' order by f.FRIENDID desc");
}
else
{
	$fuser=mysqli_query($con,"select s.FIRSTNAME,s.LASTNAME,s.EMAIL,f.FRIENDEMAIL,f.EMAIL,f.FRIENDID from friend f,signup s where s.EMAIL=f.FRIENDEMAIL and (f.EMAIL='$em' and s.EMAIL<>'$em') and f.FRIENDEMAIL='$fr' order by f.FRIENDID desc");
}

$i=0;
while($fum=mysqli_fetch_array($fuser))
{
 $uemail=$fum["FRIENDEMAIL"];
$i++;

	?>

		<div class="ms_body">
		<input type="text" style="display:none;" id="msgm" value="<?php echo $uemail;?>">
		<?php
			$mmsg=mysqli_query($con,"select * from message where (MSGBY='$em' and MSGTO='$uemail') or (MSGBY='$uemail' and MSGTO='$em') order by MSGID");
			while($msgs=mysqli_fetch_array($mmsg))
			{
				if($msgs["MSGBY"]==$em)
				{
				?>
				
				<div class="ms_b"><?php echo $msgs["MESSAGE"]; ?></div><i style="color:dodgerblue;" class="fa fa-bolt"><?php echo $msgs["TIME"]."&nbsp".$msgs["DATE"];?></i> 
				<i style="color:dodgerblue;" class="fa fa-eye"><?php echo $msgs["SEENTIME"]."&nbsp".$msgs["SEENDATE"];?></i>
</br><i onclick="deletemsg('<?php echo $msgs["MSGID"];?>','<?php echo $msgs["MSGBY"];?>')" style="cursor:pointer;color:dodgerblue;"class="fa fa-trash fa-fw">Delete</i>
				<?php	
				}
				else
				{
				?>
				<div class="ms_a"><?php echo $msgs["MESSAGE"]; ?></div><i style="color:dodgerblue;" class="fa fa-bolt"><?php echo $msgs["TIME"]."&nbsp".$msgs["DATE"];?></i>
				<?php	
				}
			}
			?>	
			<div class="ms_push<?php echo $i;?>"></div>
		</div>
	<div class="msg_footer"><textarea onclick="seenmsg('<?php echo $uemail;?>')" id="msgbb<?php echo $i;?>" onkeypress="savedivv(event,<?php echo $i;?>)" style="resize:none;width:100%;" rows=5 placeholder="Write Message From Here.." class="form-control"></textarea></div>

<?php
	
}

?>
</div>