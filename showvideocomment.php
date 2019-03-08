
 <?php
 include("connection.php");
 $em=$_COOKIE["Email"];
 $vid=$_REQUEST["vid"];
 $i=$_REQUEST["i"];
  $videocomment=mysqli_query($con,"select s.PIC,s.FIRSTNAME,s.LASTNAME,s.EMAIL,vc.COMMENT,vc.COMMENTBY,vc.COMMENTID,vc.VIDEOID,vc.DATE,vc.TIME from videocomment vc,signup s where s.EMAIL=vc.COMMENTBY and vc.VIDEOID=$vid order by vc.COMMENTID desc limit 0,1");
 while($showvc=mysqli_fetch_array($videocomment))
 {
 ?>
 <h5  style="color:white;" class="w3-opacity"><img src="user/<?php echo $showvc["PIC"];?>" class="img img-circle" style="width:5%;height:40px;"><a href="user.php?useremail=<?php echo $showvc["EMAIL"];?>" onmouseout="this.style.color='dodgerblue'"onmouseover="this.style.color ='orange'" style="color:dodgerblue;"><?php echo $showvc["FIRSTNAME"]."&nbsp".$showvc["LASTNAME"];?></a>&nbsp Commented On This </h5>
          <h6 style="color:white;" class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i><?php echo $showvc["DATE"];?> - <span class="w3-tag w3-teal w3-round"><?php echo $showvc["TIME"];?></span>&nbsp </h6>
<?php
		if($em==$showsc["COMMENTBY"];
		{
			?>
		  <h6 style="color:white;" class="w3-text-teal"><a onclick="openvce('<?php echo $i;?>')" onmouseout="this.style.color='white'"onmouseover="this.style.color ='orange'" style="cursor:pointer;color:white;"><i class="fa fa-edit fa-fw"></i>Edit</a>
		  <a onclick="deletevideocomment('<?php echo $i; ?>','<?php echo $showvc["COMMENTID"];?>')" onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'" style="cursor:pointer;color:white;"><i class="fa fa-trash fa-fw"></i>Delete</a></h6>
		 <?php
		}
		  else
		  {
			  if($em==$showvc["EMAIL"])
			  {
			  ?>
		 <h6 class="w3-text-teal" style="color:white;"> <a onclick="deletevideocomment('<?php echo $i; ?>','<?php echo $showvc["COMMENTID"];?>')" onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'" style="cursor:pointer;color:white;"><i class="fa fa-trash fa-fw"></i>Delete</a></h6>
 <?php
		  }
		  }
		  ?>
		 <br>
		  <p style="color:white;padding-left:5%;padding-right:2%;"><?php echo $showvc["COMMENT"];?></p>
		 <!--The Div For Edit Of comment-->
		   <div id="vcomedit<?php echo $i; ?>" style="display:none;">
<textarea  style="resize:none;width:100%;color:black;" id="vce<?php echo $i;?>"  rows="5" placeholder="Edit Here.." required=""><?php echo $showvc["COMMENT"];?></textarea>
<button type="button" onclick="vcomdit('<?php echo $showvc["COMMENTID"];?>','<?php echo $i; ?>')" class="btnpost" >Update</button>
<a style="cursor:pointer;color:white;"  class="close" onclick="closevce('<?php echo $i;?>')">Cancel</a>
</div>
<!--the div for edit of comment end-->

		  
		  <!--The Div For showing all comment-->
		   <div  id="vscopen<?php echo $i; ?>" style="display:none;">
		   <div id="vsc<?php echo $i;?>"></div>
		   
</div>
<p id="vm<?php echo $i;?>" onclick="vscmnt('<?php echo $i;?>','<?php echo $showvideo["VIDEOID"];?>')" onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'" style="cursor:pointer;color:white;text-align:center;">SEE MORE</p>
<!--the div for showing all comment end--> 
<p onmouseover="this.style.color='orange'" id="clvcmnt<?php echo $i;?>" onclick="closevcmnt('<?php echo $i;?>')" onmouseout="this.style.color='white'" style="cursor:pointer;color:white;text-align:center;display:none;">SEE LESS</p>
		  <div class="w3ls-border"> </div>
		  <?php
		  }
	  ?>
		
<!---comment by php end-->
          <hr>
 