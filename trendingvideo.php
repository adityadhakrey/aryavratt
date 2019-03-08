<?php
include("connection.php");
$em=$_COOKIE["Email"];
$video=mysqli_query($con,"select v.*,(select PIC from signup where EMAIL=(select EMAIL from video where VIDEOID=sv.VIDEOID)) as PIC,(select EMAIL from video where VIDEOID=sv.VIDEOID) as EMAIL,(select FIRSTNAME from signup where EMAIL=(select EMAIL from video where VIDEOID=sv.VIDEOID)) as FIRSTNAME,(select LASTNAME from signup where EMAIL=(select EMAIL from video where VIDEOID=sv.VIDEOID)) as LASTNAME,count(sv.VIDEOID) as totseen from seenvideo sv,video v where v.VIDEOID=sv.VIDEOID group by VIDEOID");

if(mysqli_num_rows($video)>0)
{
?>
<div class="scrollbar" id="vscr" onscroll="vscrl()" style="overflow-y:auto;height:800px;">
<div class="w3-container"  style="padding-left:2%;padding-right:2%;">
<?php
include("connection.php");
$em=$_COOKIE["Email"];
$video=mysqli_query($con,"select v.*,(select PIC from signup where EMAIL=(select EMAIL from video where VIDEOID=sv.VIDEOID)) as PIC,(select EMAIL from video where VIDEOID=sv.VIDEOID) as EMAIL,(select FIRSTNAME from signup where EMAIL=(select EMAIL from video where VIDEOID=sv.VIDEOID)) as FIRSTNAME,(select LASTNAME from signup where EMAIL=(select EMAIL from video where VIDEOID=sv.VIDEOID)) as LASTNAME,count(sv.VIDEOID) as totseen from seenvideo sv,video v where v.VIDEOID=sv.VIDEOID group by VIDEOID");
 $i=0;
while($showvideo=mysqli_fetch_array($video))
{
	$i++;
	?>
	
	<!-- Modal -->
  <div class="modal fade" id="likevidmodal<?php echo $i; ?>" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header" style="background:url(images/friend.jpg);">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h6 class="modal-title" ><i class="fa fa-thumbs-o-up fa-fw"></i>LIKED BY</h6>
        </div>
        <div class="modal-body" style="color:white;background:url(images/model.jpg);">
		
			
			<?php
			$vid=$showvideo["VIDEOID"];
			$showlike=mysqli_query($con,"select s.FIRSTNAME,s.LASTNAME,s.EMAIL,s.PIC,vl.LIKEBY,vl.VIDEOID,vl.DATE,vl.TIME from videolike vl,signup s where vl.LIKEBY=s.EMAIL and vl.VIDEOID='$vid' order by vl.LIKEID desc");
			while($likeby=mysqli_fetch_array($showlike))
			{
				?>
	<h5 class="w3-opacity"><img src="user/<?php echo $likeby["PIC"];?>" class="img img-circle" style="width:10%;height:50px;"><a href="user.php?useremail=<?php echo $likeby["EMAIL"];?>" onmouseout="this.style.color='white'"onmouseover="this.style.color ='orange'" style="color:white;"><?php echo $likeby["FIRSTNAME"]."&nbsp".$likeby["LASTNAME"];?></a></h5>
          <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i><?php echo $likeby["DATE"];?> - <span class="w3-tag w3-teal w3-round"><?php echo $likeby["TIME"];?></span></h6>	
<hr>		  
				<?php
			}
			?>
          
		 
		 
		</div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <!--modal end-->
	
	
	
	
	
	
	<h5 class="w3-opacity"><img src="user/<?php echo $showvideo["PIC"];?>" class="img img-circle" style="width:10%;height:50px;"><a href="user.php?useremail=<?php echo $showvideo["EMAIL"];?>" onmouseout="this.style.color='white'"onmouseover="this.style.color ='orange'" style="color:white;"><?php echo $showvideo["FIRSTNAME"]."&nbsp".$showvideo["LASTNAME"];?></a><a style="color:orange;">&nbspPosted A Video</a></h5>
          <h6 style="color:white;" class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i><?php echo $showvideo["DATE"];?> - <span class="w3-tag w3-teal w3-round"><?php echo $showvideo["TIME"];?></span>&nbsp </h6>
		  <?php
		  if($em==$showvideo["EMAIL"])
		  {
			  ?>
		  <h6 class="w3-text-teal"><a onclick="tvideoedit('<?php echo $i; ?>')" onmouseout="this.style.color='white'"onmouseover="this.style.color ='orange'" style="cursor:pointer;color:white;"><i class="fa fa-edit fa-fw"></i>Edit</a><a onclick="tdeletevideo('<?php echo $showvideo["VIDEOID"];?>')" onmouseout="this.style.color='white'"onmouseover="this.style.color ='orange'" style="cursor:pointer;color:white;"><i class="fa fa-trash fa-fw"></i>Delete</a></h6>
          <?php
		  }
		  ?>
		  <p style="color:white;"><?php echo $showvideo["VIDEOCAPTION"];?>
		  
		  <!--The Div For Edit Of VIDEO-->
		   <div id="tvideditor<?php echo $i; ?>" style="display:none;">
<textarea  style="resize:none;width:100%;color:black;" id="tve<?php echo $i;?>"  rows="5" placeholder="Edit Here.." required=""><?php echo $showvideo["VIDEOCAPTION"];?></textarea>
<button type="button" onclick="tvidedit('<?php echo $showvideo["VIDEOID"];?>','<?php echo $i; ?>')" class="btnpost" >Update</button>
<a style="cursor:pointer;color:white;"  class="close" onclick="tclosevidedit('<?php echo $i;?>')">Cancel</a>
</div>
		<!--end of div for Video edit-->
		  
		  
		<video   onplay="seencount('<?php echo $showvideo["VIDEOID"];?>')" width="100%" controls>
  <source src="usersvideo/<?php echo $showvideo["VIDEO"]; ?>">
</video>
<?php
$vid=$showvideo["VIDEOID"];
$countvideoseen=mysqli_query($con,"select * from seenvideo where VIDEOID='$vid'");
$countviews=mysqli_num_rows($countvideoseen);
?>
<p style="color:white;font-size:12px;">(<?php echo $countviews; ?>) Views</p>	
	</p>
		  <h5 class="w3-text-teal" >
		  <?php
		  $vid=$showvideo["VIDEOID"];
		  $checkvideolike=mysqli_query($con,"select * from videolike where LIKEBY='$em' and VIDEOID='$vid'");
		  $cvideolike=mysqli_query($con,"select * from videolike where  VIDEOID='$vid'");
		  $countvideolike=mysqli_num_rows($cvideolike);
		  if(mysqli_num_rows($checkvideolike)>0)
		  {
			  ?>
			  <a style="cursoe:pointer;" onclick="tvideolike('<?php echo $showvideo["VIDEOID"];?>','<?php echo $showvideo["EMAIL"];?>')"><i class="fa fa-thumbs-up" style="color:dodgerblue;font-size:20px;"></i></a>
			  <?php
		  }
		  else
		  {
			  ?>
			  <a onclick="tvideolike('<?php echo $showvideo["VIDEOID"];?>','<?php echo $showvideo["EMAIL"];?>')" onmouseout="this.style.color='white'"onmouseover="this.style.color ='orange'" style="cursor:pointer;color:white;">
	<i class="fa fa-thumbs-o-up fa-fw"></i></a>
	<?php
}
?>
	<a style="cursor:pointer;color:white;" data-toggle="modal" href="#likevidmodal<?php echo $i; ?>" onmouseout="this.style.color='white'" onmouseover="this.style.color='orange'">(<?php echo $countvideolike;?>)</a>

<?php
$vid=$showvideo["VIDEOID"];
$checkvideodislike=mysqli_query($con,"select * from videodislike where DISLIKEBY='$em' and VIDEOID='$vid'");
$cvideodislike=mysqli_query($con,"select * from videodislike where  VIDEOID='$vid'");
$countvideodislike=mysqli_num_rows($cvideodislike);
if(mysqli_num_rows($checkvideodislike)>0)
{
	?>
		<a onclick="tvideodislike('<?php echo $showvideo["VIDEOID"];?>')" style="cursor:pointer;"><i  class="fa fa-thumbs-down" style="color:red;font-size:20px;"></i></a>
		<?php
}
else
{
	?>
		<a onclick="tvideodislike('<?php echo $showvideo["VIDEOID"];?>')" style="cursor:pointer;color:white;" onmouseout="this.style.color='white'" onmouseover="this.style.color='orange'"><i class="fa fa-thumbs-o-down fa-fw" ></i></a>
<?php
}
?>
<span>(<?php echo $countvideodislike; ?>)</span>
		<div class="input-con">
<input type="text"  id="tvideocomment<?php echo $i; ?>"  style="color:black;" placeholder="Write Comment....." class="input-field">
								<button type="submit" onclick="tpostvideocomment('<?php echo $showvideo["VIDEOID"];?>','<?php echo $i;?>','<?php echo $showvideo["EMAIL"];?>')" class="btnsignup"><i class="fa fa-comment"></i>Post</button>
</div>

<div id="tvideocomment<?php echo $i; ?>,<?php echo $showvideo["VIDEOID"]; ?>">
</div>
<!---comment by php-->
<?php
 include("connection.php");
 $em=$_COOKIE["Email"];
 $vid=$showvideo["VIDEOID"];
 $videocomment=mysqli_query($con,"select s.PIC,s.FIRSTNAME,s.LASTNAME,s.EMAIL,vc.COMMENT,vc.COMMENTBY,vc.COMMENTID,vc.VIDEOID,vc.DATE,vc.TIME from videocomment vc,signup s where s.EMAIL=vc.COMMENTBY and vc.VIDEOID='$vid' order by vc.COMMENTID desc limit 0,1");
 while($showvc=mysqli_fetch_array($videocomment))
 {
 ?>
 <h5 style="color:white;" class="w3-opacity"><img src="user/<?php echo $showvc["PIC"];?>" class="img img-circle" style="width:5%;height:40px;"><a href="user.php?useremail=<?php echo $showvc["EMAIL"];?>" onmouseout="this.style.color='dodgerblue'"onmouseover="this.style.color ='orange'" style="color:dodgerblue;"><?php echo $showvc["FIRSTNAME"]."&nbsp".$showvc["LASTNAME"];?></a>&nbsp Commented On This </h5>
   <h6 style="color:white;" class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i><?php echo $showvc["DATE"];?> - <span class="w3-tag w3-teal w3-round"><?php echo $showvc["TIME"];?></span>&nbsp </h6> 
   <?php
if($em==$showvc["COMMENTBY"])
{
	?>
  <h6 style="color:white;" class="w3-text-teal"> <a onclick="topenvce('<?php echo $i;?>')" onmouseout="this.style.color='white'"onmouseover="this.style.color ='orange'" style="cursor:pointer;color:white;"><i class="fa fa-edit fa-fw"></i>Edit</a>
   <a onclick="tdeletevideocomment('<?php echo $i; ?>','<?php echo $showvc["COMMENTID"];?>')" onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'" style="cursor:pointer;color:white;"><i class="fa fa-trash fa-fw"></i>Delete</a></h6>
		  <?php
}
else 
{
	if($em==$showvideo["EMAIL"])
	{
?>
 <h6 class="w3-text-teal" style="color:white;"> <a onclick="tdeletevideocomment('<?php echo $i; ?>','<?php echo $showvc["COMMENTID"];?>')" onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'" style="cursor:pointer;color:white;"><i class="fa fa-trash fa-fw"></i>Delete</a></h6>
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
		  
		 <!--The Div For showing all comment-->
		   <div  id="tvscopen<?php echo $i; ?>" style="display:none;">
		   <div id="tvsc<?php echo $i;?>"></div>
		   
</div>
<p id="tvm<?php echo $i;?>" onclick="tvscmnt('<?php echo $i;?>','<?php echo $showvideo["VIDEOID"];?>')" onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'" style="cursor:pointer;color:white;text-align:center;">SEE MORE</p>
<!--the div for showing all comment end--> 
<p onmouseover="this.style.color='orange'" id="tclvcmnt<?php echo $i;?>" onclick="tclosevcmnt('<?php echo $i;?>')" onmouseout="this.style.color='white'" style="cursor:pointer;color:white;text-align:center;display:none;">SEE LESS</p>
		  <div class="w3ls-border"> </div>
		  <?php
		  }
	  ?>
		
<!---comment by php end-->
 </h5>
          <hr>
		<?php
 }
 ?>
    </div>
</div>
<?php
}
else
{
?>
<p style="color:green;">No video on trending </p>
<?php
}
?>