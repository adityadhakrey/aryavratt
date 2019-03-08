<?php 
include("connection.php");
$em=$_COOKIE["Email"];

?>
  <div class="chat_box">
	<div class="chat_head"> Chat Box</div>
	<div class="chat_body"> 
	<?php

include("connection.php");
date_default_timezone_set("Asia/Kolkata");
	$fetchuser=mysqli_query($con,"select s.FIRSTNAME,s.LASTNAME,s.EMAIL,f.FRIENDEMAIL,f.EMAIL,f.FRIENDID from friend f,signup s where s.EMAIL=f.FRIENDEMAIL and (f.EMAIL='$em' and s.EMAIL<>'$em') order by f.FRIENDID desc");
	$i=0;
	while($fu=mysqli_fetch_array($fetchuser))
	{
		$useremail=$fu["FRIENDEMAIL"];
		$usrmsg=mysqli_query($con,"select * from message where MSGTO='$em' and (MSGBY='$useremail' and STATUS='unseen')");
		$countusrmsg=mysqli_num_rows($usrmsg);
		$i++;
		$ft=mysqli_query($con,"select TIME from signup where EMAIL='$useremail'");
		while($fut=mysqli_fetch_array($ft))
		{
			$ut=$fut["TIME"];
		$ct=date_create(date("F j,y g:i a"));
		$tt=date_create($ut);
		$diff=date_diff($ct,$tt);
		if($diff->i >3)
		{
			if(mysqli_num_rows($usrmsg)>0)
		{
          ?>
	    <div id="usera<?php echo $i;?>" class="usera" onclick="openchat(<?php echo $i;?>,'<?php echo $useremail;?>')"><?php echo $fu["FIRSTNAME"]."&nbsp".$fu["LASTNAME"];?> (<?php echo $countusrmsg;?>) <p style="color:dodgerblue;font-size:10px;">Last Seen <?php echo $ut;?></p></div>			
		<?php
		}
		else
		{
			?>
		<div id="usera<?php echo $i;?>" class="usera" onclick="openchatty(<?php echo $i;?>,'<?php echo $useremail;?>')"><?php echo $fu["FIRSTNAME"]."&nbsp".$fu["LASTNAME"];?><p style="font-size:10px;color:dodgerblue;">Last Seen <?php echo $ut;?></p></div>	
			<?php
		}
		}
else
{	
			if(mysqli_num_rows($usrmsg)>0)
		{
		?>
	<div id="user<?php echo $i;?>" class="user" onclick="openchat(<?php echo $i;?>,'<?php echo $useremail;?>')"><?php echo $fu["FIRSTNAME"]."&nbsp".$fu["LASTNAME"];?> (<?php echo $countusrmsg;?>)</div>
   <?php
		}
		else
		{
			?>
<div id="user<?php echo $i;?>" class="user" onclick="openchatty(<?php echo $i;?>,'<?php echo $useremail;?>')"><?php echo $fu["FIRSTNAME"]."&nbsp".$fu["LASTNAME"];?> </div>			
	<?php
		}
	}
	}
	}
	
	
?>	
<div id="onlinealluser"></div>
   </div>
  </div>
  
  
 
  
  
<?php
$fuser=mysqli_query($con,"select s.FIRSTNAME,s.LASTNAME,s.EMAIL,f.FRIENDEMAIL,f.EMAIL,f.FRIENDID from friend f,signup s where s.EMAIL=f.FRIENDEMAIL and (f.EMAIL='$em' and s.EMAIL<>'$em') order by f.FRIENDID desc");
$i=0;
while($fum=mysqli_fetch_array($fuser))
{
 $uemail=$fum["FRIENDEMAIL"];
$i++;

	?>
<div id="msg_box<?php echo $i;?>" class="msg_box" style="right:290px">
	<div class="msg_head"><?php echo $fum["FIRSTNAME"]."&nbsp".$fum["LASTNAME"];?><input type="hidden" id="txtem<?php echo $i; ?>" value="<?php echo $uemail; ?>" />
	<div class="close">x</div>
	</div>
	<div id="msg_wrap<?php echo $i;?>" class="msg_wrap">
		<div class="msg_body">
			<?php
			$q=mysqli_query($con,"select * from message where (MSGBY='$em' and MSGTO='$uemail') or (MSGBY='$uemail' and MSGTO='$em') order by MSGID");
			while($row1=mysqli_fetch_array($q))
			{
				if($row1["MSGBY"]==$em)
				{
				?>
				</br>
					<div class="msg_b"><?php echo $row1["MESSAGE"];?></div><i style="color:dodgerblue;" class="fa fa-bolt"><?php echo $row1["TIME"]."&nbsp".$row1["DATE"];?></i></br>
				<i style="color:dodgerblue;" class="fa fa-eye"><?php echo $row1["SEENTIME"]."&nbsp".$row1["SEENDATE"];;?></i></br>
				<?php	
				}
				else
				{
				?>
				</br>
			<div class="msg_a"><?php echo $row1["MESSAGE"]; ?></div><i style="color:green;" class="fa fa-arrow-circle-down"><?php echo $row1["TIME"]."&nbsp".$row1["DATE"];?></i>
			</br>
				<?php	
				}
			}
			?>
			<div class="msg_push<?php echo $i;?>"></div>
		
		</div>
	<div class="msg_footer"><textarea id="mgt<?php echo $i;?>"  onkeypress="savedivc(event,<?php echo $i;?>)" style="resize:none;width:100%;" rows=5 placeholder="Write Message From Here.." class="form-control"></textarea></div>
</div>
</div>

<?php
	}
	?>