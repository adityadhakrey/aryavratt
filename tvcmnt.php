<div class="scrollbar" style="height:200px;overflow-y:auto;">
 <?php
 include("connection.php");
 $em=$_COOKIE["Email"];
 $vid=$_REQUEST["vid"];
 $i=$_REQUEST["i"];
 // $i=0;
  $videocomment=mysqli_query($con,"select s.PIC,s.FIRSTNAME,s.LASTNAME,s.EMAIL,vc.COMMENT,vc.COMMENTBY,vc.COMMENTID,vc.VIDEOID,vc.DATE,vc.TIME from videocomment vc,signup s where s.EMAIL=vc.COMMENTBY and vc.VIDEOID=$vid and vc.COMMENTID<>(select max(COMMENTID) from videocomment where VIDEOID=$vid) order by vc.COMMENTID desc ");
 while($showvc=mysqli_fetch_array($videocomment))
 {
	 $i++;
 ?>
 <h5 style="color:white;" class="w3-opacity"><img src="user/<?php echo $showvc["PIC"];?>" class="img img-circle" style="width:5%;height:40px;"><a href="user.php?useremail=<?php echo $showvc["EMAIL"];?>" onmouseout="this.style.color='dodgerblue'"onmouseover="this.style.color ='orange'" style="color:dodgerblue;"><?php echo $showvc["FIRSTNAME"]."&nbsp".$showvc["LASTNAME"];?></a>&nbsp Commented On This </h5>
          <h6 style="color:white;" class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i><?php echo $showvc["DATE"];?> - <span class="w3-tag w3-teal w3-round"><?php echo $showvc["TIME"];?></span>&nbsp </h6>
<?php
		if($em==$showvc["COMMENTBY"])
		{
			?>
		  <h6 style="color:white;" class="w3-text-teal"><a onclick="topenvce('<?php echo $i;?>')" onmouseout="this.style.color='white'"onmouseover="this.style.color ='orange'" style="cursor:pointer;color:white;"><i class="fa fa-edit fa-fw"></i>Edit</a>
		  <a onclick="tdeletevideocomment('<?php echo $i; ?>','<?php echo $showvc["COMMENTID"];?>')" onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'" style="cursor:pointer;color:white;"><i class="fa fa-trash fa-fw"></i>Delete</a></h6>
		 <?php
		}
		  else
		  {
			  if($em==$showvc["EMAIL"])
			  {

			  ?>
		  <h6 style="color:white;" class="w3-text-teal"><a onclick="tdeletevideocomment('<?php echo $i; ?>','<?php echo $showvc["COMMENTID"];?>')" onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'" style="cursor:pointer;color:white;"><i class="fa fa-trash fa-fw"></i>Delete</a></h6>
 <?php
		  }
		  }
		  ?>
		 <br>
		  <p style="color:white;padding-left:5%;padding-right:2%;"><?php echo $showvc["COMMENT"];?></p>
		 <!--The Div For Edit Of comment-->
		   <div id="tvcomedit<?php echo $i; ?>" style="display:none;">
<textarea  style="resize:none;width:100%;color:black;" id="tvce<?php echo $i;?>"  rows="5" placeholder="Edit Here.." required=""><?php echo $showvc["COMMENT"];?></textarea>
<button type="button" onclick="tvcomdit('<?php echo $showvc["COMMENTID"];?>','<?php echo $i; ?>')" class="btnpost" >Update</button>
<a style="cursor:pointer;color:white;"  class="close" onclick="tclosevce('<?php echo $i;?>')">Cancel</a>
</div>
<!--the div for edit of comment end-->

		 
		  <?php
		  }
		  ?>		 

 </div>