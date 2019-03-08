<?php
include("connection.php");
$em=$_COOKIE["Email"];
$pro=$_REQUEST["sid"];
 $i=$_REQUEST["i"];
$projectcomment=mysqli_query($con,"select s.FIRSTNAME,s.LASTNAME,s.EMAIL,s.PIC,prc.COMMENT,prc.COMMENTID,prc.COMMENTBY,prc.PROJECTID,prc.DATE,prc.TIME from projectcomment prc,signup s where s.EMAIL=prc.COMMENTBY and prc.PROJECTID='$pro' order by prc.COMMENTID desc limit 0,1");
while($showprc=mysqli_fetch_array($projectcomment))
{
	$i++;
	?>
	
	<h5 style="color:white;" class="w3-opacity"><img src="user/<?php echo $showprc["PIC"];?>" class="img img-circle" style="width:5%;height:40px;"><a href="user.php?useremail=<?php echo $showprc["EMAIL"];?>" onmouseout="this.style.color='dodgerblue'"onmouseover="this.style.color ='orange'" style="color:dodgerblue;"><?php echo $showprc["FIRSTNAME"]."&nbsp".$showprc["LASTNAME"];?></a>&nbsp Commented On This </h5>
          <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i><?php echo $showprc["DATE"];?> - <span class="w3-tag w3-teal w3-round"><?php echo $showprc["TIME"];?></span>&nbsp </h6>
		<?php
		if($em==$showprc["COMMENTBY"])
		{
			?>
		<h6 class="w3-text-teal"><a onclick="proopence('<?php echo $i;?>')" onmouseout="this.style.color='white'"onmouseover="this.style.color ='orange'" style="cursor:pointer;color:white;"><i class="fa fa-edit fa-fw"></i>Edit</a>
<a onclick="deleteprojectcomment('<?php echo $i; ?>','<?php echo $showprc["COMMENTID"];?>')" onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'" style="cursor:pointer;color:white;"><i class="fa fa-trash fa-fw"></i>Delete</a></h6>
		  <?php
		}
		  else
		  {
			  if($em==$showprc["EMAIL"])
			  {
			  ?>
			 <h6 class="w3-text-teal"><a onclick="deleteprojectcomment('<?php echo $i; ?>','<?php echo $showprc["COMMENTID"];?>')" onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'" style="cursor:pointer;color:white;"><i class="fa fa-trash fa-fw"></i>Delete</a></h6>
			   
			  <?php
		  }
		  }
		  ?>
		 <br>
		  <p style="padding-left:5%;padding-right:2%;"><?php echo $showprc["COMMENT"];?></p>
		  <!--The Div For Edit Of comment-->
		   <div id="procomedit<?php echo $i; ?>" style="display:none;">
<textarea  style="resize:none;width:100%;color:black;" id="procs<?php echo $i;?>"  rows="5" placeholder="Edit Here.." required=""><?php echo $showprc["COMMENT"];?></textarea>
<button type="button" onclick="procomdit('<?php echo $showprc["COMMENTID"];?>','<?php echo $i; ?>')" class="btnpost" >Update</button>
<a style="cursor:pointer;color:white;"  class="close" onclick="proclosece('<?php echo $i;?>')">Cancel</a>
</div>
<!--the div for edit of comment end-->
		  
		  <?php
		  }
		  ?>
		  