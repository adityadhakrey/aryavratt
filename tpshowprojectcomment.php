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
          <h6 style="color:white;" class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i><?php echo $showprc["DATE"];?> - <span class="w3-tag w3-teal w3-round"><?php echo $showprc["TIME"];?></span>&nbsp </h6>
		<?php
		if($em==$showprc["COMMENTBY"])
		{
			?>
		<h6 class="w3-text-teal"><a onclick="tpopence('<?php echo $i;?>')" onmouseout="this.style.color='white'"onmouseover="this.style.color ='orange'" style="cursor:pointer;color:white;"><i class="fa fa-edit fa-fw"></i>Edit</a>
<a onclick="tpdeleteprojectcomment('<?php echo $i; ?>','<?php echo $showprc["COMMENTID"];?>')" onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'" style="cursor:pointer;color:white;"><i class="fa fa-trash fa-fw"></i>Delete</a></h6>
		  <?php
		}
		  else
		  {
			  if($em==$showprc)
			  {
			  ?>
			 <h6 class="w3-text-teal"><a onclick="tpdeleteprojectcomment('<?php echo $i; ?>','<?php echo $showprc["COMMENTID"];?>')" onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'" style="cursor:pointer;color:white;"><i class="fa fa-trash fa-fw"></i>Delete</a></h6>
			   
			  <?php
		  }
		  }
		  ?>
		 <br>
		  <p style="padding-left:5%;padding-right:2%;"><?php echo $showprc["COMMENT"];?></p>
		  		  <!--The Div For Edit Of comment-->
		   <div id="tpcomedit<?php echo $i; ?>" style="display:none;">
<textarea  style="resize:none;width:100%;color:black;" id="tpcs<?php echo $i;?>"  rows="5" placeholder="Edit Here.." required=""><?php echo $showprc["COMMENT"];?></textarea>
<button type="button" onclick="tpcomdit('<?php echo $showprc["COMMENTID"];?>','<?php echo $i; ?>')" class="btnpost" >Update</button>
<a style="cursor:pointer;color:white;"  class="close" onclick="tpclosece('<?php echo $i;?>')">Cancel</a>
</div>
<!--the div for edit of comment end-->

		 <!--The Div For showing all comment-->
		   <div  id="tpsscopen<?php echo $i; ?>" style="display:none;">
		   <div id="tpssc<?php echo $i;?>"></div>
		   
</div>
<p id="tpsm<?php echo $i;?>" onclick="tpsscmnt('<?php echo $i;?>','<?php echo $gf["PROJECTID"];?>')" onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'" style="cursor:pointer;color:white;text-align:center;">SEE MORE</p>
<!--the div for showing all comment end--> 
<p onmouseover="this.style.color='orange'" id="tpclscmnt<?php echo $i;?>" onclick="tpclosescmnt('<?php echo $i;?>')" onmouseout="this.style.color='white'" style="cursor:pointer;color:white;text-align:center;display:none;">SEE LESS</p>
		  <div class="w3ls-border"> </div>
		  
		  <?php
		  }
		  ?>
		  