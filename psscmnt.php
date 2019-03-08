
<?php
include("connection.php");
$em=$_COOKIE["Email"];
$sid=$_REQUEST["sid"];
 $i=$_REQUEST["i"];
 //$i=0;
$statuscomment=mysqli_query($con,"select s.FIRSTNAME,s.LASTNAME,s.EMAIL,s.PIC,sc.COMMENT,sc.COMMENTID,sc.COMMENTBY,sc.STATUSID,sc.DATE,sc.TIME from statuscomment sc,signup s where s.EMAIL=sc.COMMENTBY and sc.STATUSID=$sid and sc.COMMENTID<>(select max(COMMENTID) from statuscomment where STATUSID=$sid) order by sc.COMMENTID desc ");
while($showsc=mysqli_fetch_array($statuscomment))
{
$i++;
	?>
	
	<h5 class="w3-opacity"><img src="user/<?php echo $showsc["PIC"];?>" class="img img-circle" style="width:5%;height:40px;"><a href="user.php?useremail=<?php echo $showsc["EMAIL"];?>" onmouseout="this.style.color='dodgerblue'"onmouseover="this.style.color ='orange'" style="color:dodgerblue;"><?php echo $showsc["FIRSTNAME"]."&nbsp".$showsc["LASTNAME"];?></a>&nbsp Commented On This </h5>
          <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i><?php echo $showsc["DATE"];?> - <span class="w3-tag w3-teal w3-round"><?php echo $showsc["TIME"];?></span>&nbsp </h6>
		<?php
		if($em==$showsc["COMMENTBY"]) 
		{
			?>
<h6 class="w3-text-teal"><a onclick="opence('<?php echo $i;?>')" onmouseout="this.style.color='white'"onmouseover="this.style.color ='orange'" style="cursor:pointer;color:white;"><i class="fa fa-edit fa-fw"></i>Edit</a>
<a onclick="deletestatuscomment('<?php echo $i; ?>','<?php echo $showsc["COMMENTID"];?>')" onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'" style="cursor:pointer;color:white;"><i class="fa fa-trash fa-fw"></i>Delete</a></h6>
		  <?php
		}
		  else
		  {
			  if($em==$showsc["EMAIL"])
			  {
			  ?>
			 <h6 class="w3-text-teal"><a onclick="deletestatuscomment('<?php echo $i; ?>','<?php echo $showsc["COMMENTID"];?>')" onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'" style="cursor:pointer;color:white;"><i class="fa fa-trash fa-fw"></i>Delete</a></h6>
			   
			  <?php
		  }
		  }
		  ?>
		 <br>
		  <p style="padding-left:5%;padding-right:2%;"><?php echo $showsc["COMMENT"];?></p>
		 
		 <!--The Div For Edit Of comment-->
		   <div id="comedit<?php echo $i; ?>" style="display:none;">
<textarea  style="resize:none;width:100%;color:black;" id="cs<?php echo $i;?>"  rows="5" placeholder="Edit Here.." required=""><?php echo $showsc["COMMENT"];?></textarea>
<button type="button" onclick="comdit('<?php echo $showsc["COMMENTID"];?>','<?php echo $i; ?>','<?php echo $sid;?>')" class="btnpost" >Update</button>
<a style="cursor:pointer;color:white;"  class="close" onclick="closece('<?php echo $i;?>')">Cancel</a>
</div>
<!--the div for edit of comment end-->

		  <?php
		  }
		  ?>
	 	
