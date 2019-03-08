
 <?php
 include("connection.php");
 $em=$_COOKIE["Email"];
 $pid=$_REQUEST["pid"];
 //$i=$_REQUEST["i"];
 $i=0;
 $picturecomment=mysqli_query($con,"select s.PIC,s.FIRSTNAME,s.LASTNAME,s.EMAIL,pc.COMMENT,pc.COMMENTBY,pc.COMMENTID,pc.PICTUREID,pc.DATE,pc.TIME from picturecomment pc,signup s where s.EMAIL=pc.COMMENTBY and pc.PICTUREID=$pid and pc.COMMENTID<>(select max(COMMENTID) from picturecomment where PICTUREID=$pid) order by pc.COMMENTID desc limit 0,1");
 while($showpc=mysqli_fetch_array($picturecomment))
 {
	 $i++;
 ?>
 <h5 class="w3-opacity"><img src="user/<?php echo $showpc["PIC"];?>" class="img img-circle" style="width:5%;height:40px;"><a href="user.php?useremail=<?php echo $showpc["EMAIL"];?>" onmouseout="this.style.color='dodgerblue'"onmouseover="this.style.color ='orange'" style="color:dodgerblue;"><?php echo $showpc["FIRSTNAME"]."&nbsp".$showpc["LASTNAME"];?></a>&nbsp Commented On This </h5>
          <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i><?php echo $showpc["DATE"];?> - <span class="w3-tag w3-teal w3-round"><?php echo $showpc["TIME"];?></span>&nbsp </h6> 
		 <?php
		if($em==$showpc["COMMENTBY"]) 
		{
			?> 
		  <h6 class="w3-text-teal"><a onclick="openpce('<?php echo $i;?>')" onmouseout="this.style.color='white'"onmouseover="this.style.color ='orange'" style="cursor:pointer;color:white;"><i class="fa fa-edit fa-fw"></i>Edit</a>
		  <a onclick="deletepicturecomment('<?php echo $i; ?>','<?php echo $showpc["COMMENTID"];?>')" onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'" style="cursor:pointer;color:white;"><i class="fa fa-trash fa-fw"></i>Delete</a></h6>
		   <?php
		}
		  else
		  {
			  if($em==$showpc["EMAIL"])
			  {
			  ?>
		<h6 class="w3-text-teal">  <a onclick="deletepicturecomment('<?php echo $i; ?>','<?php echo $showpc["COMMENTID"];?>')" onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'" style="cursor:pointer;color:white;"><i class="fa fa-trash fa-fw"></i>Delete</a></h6>		  
		  <?php
		  }
		  }
		  ?>
		  
		  <br>
		  <p style="padding-left:5%;padding-right:2%;"><?php echo $showpc["COMMENT"];?></p>
		  
		  <!--The Div For Edit Of comment-->
		   <div id="pcomedit<?php echo $i; ?>" style="display:none;">
<textarea  style="resize:none;width:100%;color:black;" id="pce<?php echo $i;?>"  rows="5" placeholder="Edit Here.." required=""><?php echo $showpc["COMMENT"];?></textarea>
<button type="button" onclick="pcomdit('<?php echo $showpc["COMMENTID"];?>','<?php echo $i; ?>')" class="btnpost" >Update</button>
<a style="cursor:pointer;color:white;"  class="close" onclick="closepce('<?php echo $i;?>')">Cancel</a>
</div>
<!--the div for edit of comment end-->
	
		 <div class="w3ls-border"> </div>
		  <?php
		  }
		 
		  ?>
		 

 