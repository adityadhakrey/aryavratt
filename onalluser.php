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
		$ct=date_create(date("Y-m-d H:i:s"));
		$tt=date_create($ut);
		$diff=date_diff($ct,$tt);
		if($diff->i >3)
		{
			if(mysqli_num_rows($usrmsg)>0)
		{
          ?>
	    <div id="usera<?php echo $i;?>" class="usera" onclick="openchat(<?php echo $i;?>)"><?php echo $fu["FIRSTNAME"]."&nbsp".$fu["LASTNAME"];?> (<?php echo $countusrmsg;?>)</div>			
		<?php
		}
		else
		{
			?>
		<div id="usera<?php echo $i;?>" class="usera" onclick="openchatty(<?php echo $i;?>)"><?php echo $fu["FIRSTNAME"]."&nbsp".$fu["LASTNAME"];?> </div>	
			<?php
		}
		}
else
{	
			if(mysqli_num_rows($usrmsg)>0)
		{
		?>
	<div id="user<?php echo $i;?>" class="user" onclick="openchat(<?php echo $i;?>)"><?php echo $fu["FIRSTNAME"]."&nbsp".$fu["LASTNAME"];?> (<?php echo $countusrmsg;?>)</div>
   <?php
		}
		else
		{
			?>
<div id="user<?php echo $i;?>" class="user" onclick="openchatty(<?php echo $i;?>)"><?php echo $fu["FIRSTNAME"]."&nbsp".$fu["LASTNAME"];?> </div>			
	<?php
		}
	}
	}
	}
	
	
?>	