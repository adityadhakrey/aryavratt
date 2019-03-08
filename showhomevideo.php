<div class="w3-container"  style="padding-left:2%;padding-right:2%;">
<?php
include("connection.php");
$em=$_COOKIE["Email"];
$vid=$row["VIDEOID"];
 $video=mysqli_query($con,"select (select PIC from signup where EMAIL=h.EMAIL) as PIC,(select FIRSTNAME from signup where EMAIL=h.EMAIL) as FIRSTNAME,(select LASTNAME from signup where EMAIL=h.EMAIL) as LASTNAME,h.* from home h where (h.EMAIL='$em' or h.EMAIL in(select FRIENDEMAIL from friend where EMAIL='$em' and FRIENDEMAIL<>'$em')) and h.TYPE='video' and h.VIDEOID=$vid");
 $i=$vid;
while($showvideo=mysqli_fetch_array($video))
{
	//$i++;
	?>
	 <!-- Modal -->
  <div class="modal fade" id="likevidmodal<?php echo $i; ?>" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header" style="background:url(images/friend.jpg);">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h6 class="modal-title" ><i class="fa fa-thumbs-o-up fa-fw"></i>LIKED BY</h6>
        </div>
        <div class="modal-body" style="background:url(images/model.jpg);">
		
			
			<?php
			$vid=$showvideo["VIDEOID"];
			$showlike=mysqli_query($con,"select s.FIRSTNAME,s.LASTNAME,s.EMAIL,s.PIC,v.LIKEBY,v.VIDEOID,v.DATE,v.TIME,v.TYPE from videolike v,signup s where v.LIKEBY=s.EMAIL and v.VIDEOID='$vid'");
			
			while($likeby=mysqli_fetch_array($showlike))
			{
				?>
		<h5 class="w3-opacity"><img src="user/<?php echo $likeby["PIC"];?>" class="img img-circle" style="width:10%;height:50px;"><a href="user.php?useremail=<?php echo $likeby["EMAIL"];?>" onmouseout="this.style.color='white'"onmouseover="this.style.color ='orange'" style="color:white;"><?php echo $likeby["FIRSTNAME"]."&nbsp".$likeby["LASTNAME"];?></a>
		<?php
if($likeby["TYPE"]=="like")
{
	?>
	<span class="like-btn"><img style="width:30px;height:30px;" src="images/feelings_like.gif"></span>
<?php
	}
	else if($likeby["TYPE"]=="sad")
	{
	?>
		<span class="like-btn"><img style="width:30px;height:30px;" src="images/feelings_sad.gif"></span>
		<?php
	}
	else if($likeby["TYPE"]=="punch") 
	{
	?>
	<span class="like-btn"><img style="width:30px;height:30px;" src="images/feelings_slap.gif"></span>
	<?php
	}
	else if($likeby["TYPE"]=="well-done")
	{
	?>
	<span class="like-btn"><img style="width:30px;height:30px;" src="images/feelings_great.gif"></span>
	<?php
	}
	else if($likeby["TYPE"]=="angry")
	{
	?>
	<span class="like-btn"><img style="width:30px;height:30px;" src="images/feelings_angry1.gif"></span>
	<?php
	}
	else if($likeby["TYPE"]=="haha")
	{
	?>
	<span class="like-btn"><img style="width:30px;height:30px;" src="images/feelings_smile1.gif"></span>
	<?php
	}
	else if($likeby["TYPE"]=="love")
	{
	?>
	<span class="like-btn"><img style="width:30px;height:30px;" src="images/feelings_love.gif"></span>
	<?php
	}
	?>
		</h5>
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
     <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i><?php echo $showvideo["DATE"];?> - <span class="w3-tag w3-teal w3-round"><?php echo $showvideo["TIME"];?></span></h6>
	 <?php
if($em==$showvideo["EMAIL"])
{
	?>	
<h6 class="w3-text-teal"><a onclick="videoedit('<?php echo $i; ?>')" onmouseout="this.style.color='white'"onmouseover="this.style.color ='orange'" style="cursor:pointer;color:white;"><i class="fa fa-edit fa-fw"></i>Edit</a>
<a onclick="deletevideo('<?php echo $showvideo["VIDEOID"];?>')" onmouseout="this.style.color='white'"onmouseover="this.style.color ='orange'" style="cursor:pointer;color:white;"><i class="fa fa-trash fa-fw"></i>Delete</a></h6>
  
<?php
}
?>
        <p><?php echo $showvideo["VIDEOCAPTION"];?>
	
		  <!--The Div For Edit Of VIDEO-->
		   <div id="videditor<?php echo $i; ?>" style="display:none;">
<textarea  style="resize:none;width:100%;color:black;" id="ve<?php echo $i;?>"  rows="5" placeholder="Edit Here.." required=""><?php echo $showvideo["VIDEOCAPTION"];?></textarea>
<button type="button" onclick="videdit('<?php echo $showvideo["VIDEOID"];?>','<?php echo $i; ?>')" class="btnpost" >Update</button>
<a style="cursor:pointer;color:white;"  class="close" onclick="closevidedit('<?php echo $i;?>')">Cancel</a>
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
<p style="font-size:12px;">(<?php echo $countviews; ?>) Views</p>

		  </p>
		  <h5 class="w3-text-teal" >
		   <div class="container-fluid">
<div class="row">
<div class="col-sm-12">
<?php
$fettype=mysqli_query($con,"select * from videolike where VIDEOID='$vid' and LIKEBY='$em'");
$liketype=mysqli_fetch_array($fettype);
	if(mysqli_num_rows($fettype)>0)
	{
	if($liketype["TYPE"]=="like")
	{
?>	
<span class="like-btn"><img style="width:30px;height:30px;" src="images/feelings_like.gif"><span style="color:orange;" onmouseout="this.style.color='orange'" onmouseover="this.style.color='green'" class="like-btn-text">You reacted <?php echo $liketype["TYPE"];?></span> <!-- Default like button -->
<?php
	}
	else if($liketype["TYPE"]=="sad")
{
	?>
	<span class="like-btn"><img style="width:30px;height:30px;" src="images/feelings_sad.gif"><span style="color:orange;" onmouseout="this.style.color='orange'" onmouseover="this.style.color='green'" class="like-btn-text">You reacted <?php echo $liketype["TYPE"];?></span>
	<?php
}
else if($liketype["TYPE"]=="haha")
{
	?>
<span class="like-btn"><img style="width:30px;height:30px;" src="images/feelings_smile1.gif"><span style="color:orange;" onmouseout="this.style.color='orange'" onmouseover="this.style.color='green'" class="like-btn-text">You reacted <?php echo $liketype["TYPE"];?></span>
<?php
}
else if($liketype["TYPE"]=="punch")
{
	?>
	<span class="like-btn"><img style="width:30px;height:30px;" src="images/feelings_slap.gif"><span style="color:orange;" onmouseout="this.style.color='orange'" onmouseover="this.style.color='green'" class="like-btn-text">You reacted <?php echo $liketype["TYPE"];?></span>
	<?php
}
else if($liketype["TYPE"]=="dislike")
{
	?>
	<span class="like-btn"><img style="width:30px;height:30px;" src="images/feelings_d.gif"><span style="color:orange;" onmouseout="this.style.color='orange'" onmouseover="this.style.color='green'" class="like-btn-text">You reacted <?php echo $liketype["TYPE"];?></span>
	<?php
}
else if($liketype["TYPE"]=="angry")
{
?>
<span class="like-btn"><img style="width:30px;height:30px;" src="images/feelings_angry1.gif"><span style="color:orange;" onmouseout="this.style.color='orange'" onmouseover="this.style.color='green'" class="like-btn-text">You reacted <?php echo $liketype["TYPE"];?></span>
<?php
}
else if($liketype["TYPE"]=="well-done")
{
	?>
	<span class="like-btn"><img style="width:30px;height:30px;" src="images/feelings_great.gif"><span style="color:orange;" onmouseout="this.style.color='orange'" onmouseover="this.style.color='green'" class="like-btn-text">You reacted <?php echo $liketype["TYPE"];?></span>
	<?php
}
else if($liketype["TYPE"]=="love")
{
?>
	<span class="like-btn"><img style="width:30px;height:30px;" src="images/feelings_love.gif"><span style="color:orange;" onmouseout="this.style.color='orange'" onmouseover="this.style.color='green'" class="like-btn-text">You reaction</span>
	<?php
}
	}
	else
	{
		?>
		<span class="like-btn"><img style="width:30px;height:30px;" src="images/feelings_like.gif">
		<?php
	}

?>

						<span class="like-btn-emo like-btn-default"></span> <!-- Default like button emotion-->
						<!--<span class="like-btn-text">Likes</span> <!-- Default like button text,(Like, wow, sad..) default:Like  -->
						  <ul class="feelings-box" > <!-- feeling buttons container-->
								<li onclick="setvidlike('<?php echo $showvideo["VIDEOID"];?>','<?php echo $showvideo["EMAIL"];?>','like')" class="feeling feeling-like"  data-feeling="Like"></li>
								
								<li onclick="setvidlike('<?php echo $showvideo["VIDEOID"];?>','<?php echo $showvideo["EMAIL"];?>','haha')" class="feeling feeling-haha"  data-feeling="HaHa"></li>
								
								<li onclick="setvidlike('<?php echo $showvideo["VIDEOID"];?>','<?php echo $showvideo["EMAIL"];?>','dislike')"  class="feeling feeling-dislike"  data-feeling="dislike"></li>
								
								<li onclick="setvidlike('<?php echo $showvideo["VIDEOID"];?>','<?php echo $showvideo["EMAIL"];?>','sad')" class="feeling feeling-sad"  data-feeling="Sad"></li>
								
								<li onclick="setvidlike('<?php echo $showvideo["VIDEOID"];?>','<?php echo $showvideo["EMAIL"];?>','angry')" class="feeling feeling-angry"  data-feeling="Angry"></li>&nbsp
								<li onclick="setvidlike('<?php echo $showvideo["VIDEOID"];?>','<?php echo $showvideo["EMAIL"];?>','well-done')" class="feeling feeling-welldone"  data-feeling="well-done"></li>&nbsp
								<li onclick="setvidlike('<?php echo $showvideo["VIDEOID"];?>','<?php echo $showvideo["EMAIL"];?>','punch')" class="feeling feeling-punch"  data-feeling="punch"></li>&nbsp
                                <li onclick="setvidlike('<?php echo $showvideo["VIDEOID"];?>','<?php echo $showvideo["EMAIL"];?>','love')" class="feeling feeling-love"  data-feeling="Love"></li>&nbsp						  
						  </ul>
					</span>
					
					</div>
					</div>
					</div>
					

<?php
$fetlike=mysqli_query($con,"select * from videolike where VIDEOID='$vid'");
$checkulike=mysqli_query($con,"select * from videolike where VIDEOID='$vid' and LIKEBY='$em'");
$cl=mysqli_num_rows($fetlike);
$countlike=$cl-1;
if(mysqli_num_rows($fetlike)>0)
{
?>
<p data-toggle="modal" href="#likevidmodal<?php echo $i;?>" style="color:orange;"><img style="width:38px;height:40px;" src="images/feelings_smile.gif"><img style="width:38px;height:40px;left:2px;" src="images/feelings_love.gif">

<?php if(mysqli_num_rows($checkulike)>0)
{
echo "You and &nbsp";
}
echo $countlike?> other
react on this post</p>
<?php
}
?> 
</br>
		<div class="input-con">
<input type="text"  id="videocomment<?php echo $i; ?>"  style="color:black;" placeholder="Write Comment....." class="input-field">
								<button type="submit" onclick="postvideocomment('<?php echo $showvideo["VIDEOID"];?>','<?php echo $i;?>','<?php echo $showvideo["EMAIL"];?>')" class="btnsignup"><i class="fa fa-comment"></i>Post</button>
</div>

<div id="videocomment<?php echo $i; ?>,<?php echo $showvideo["VIDEOID"]; ?>">
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
 <h5 class="w3-opacity"><img src="user/<?php echo $showvc["PIC"];?>" class="img img-circle" style="width:5%;height:40px;"><a href="user.php?useremail=<?php echo $showvc["EMAIL"];?>" onmouseout="this.style.color='dodgerblue'"onmouseover="this.style.color ='orange'" style="color:dodgerblue;"><?php echo $showvc["FIRSTNAME"]."&nbsp".$showvc["LASTNAME"];?></a>&nbsp Commented On This </h5>
   <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i><?php echo $showvc["DATE"];?> - <span class="w3-tag w3-teal w3-round"><?php echo $showvc["TIME"];?></span>&nbsp </h6> 
   <?php
if($em==$showvc["COMMENTBY"])
{
	?>
   <h6 class="w3-text-teal"><a onclick="openvce('<?php echo $i;?>')" onmouseout="this.style.color='white'"onmouseover="this.style.color ='orange'" style="cursor:pointer;color:white;"><i class="fa fa-edit fa-fw"></i>Edit</a>
   <a onclick="deletevideocomment('<?php echo $i; ?>','<?php echo $showvc["COMMENTID"];?>')" onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'" style="cursor:pointer;color:white;"><i class="fa fa-trash fa-fw"></i>Delete</a></h6>
		  <?php
}
else 
{
	if($em==$showvideo["EMAIL"])
	{
?>
  <a onclick="deletevideocomment('<?php echo $i; ?>','<?php echo $showvc["COMMENTID"];?>')" onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'" style="cursor:pointer;color:white;"><i class="fa fa-trash fa-fw"></i>Delete</a></h6>
<?php
}
}
?>  
		  
		  <br>
		  <p style="padding-left:5%;padding-right:2%;"><?php echo $showvc["COMMENT"];?></p>
		  
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
 </h5>
          <hr>
		<?php
 }
 ?>
    </div>