<div class="scrollbar" id="sscr" onscroll="sscrl()" style="overflow-y:auto;height:700px;">
 <div class="w3-container" style="padding-left:2%;padding-right:2%;">
 <?php
 include("connection.php");
 $em=$_COOKIE["Email"];
 $status=mysqli_query($con,"select s.FIRSTNAME,s.LASTNAME,s.PIC,s.EMAIL,st.STATUS,st.STATUSID,st.DATE,st.TIME,st.EMAIL from status st,signup s where s.EMAIL=st.EMAIL and st.EMAIL='$em' order by st.STATUSID desc");
$i=0;
 while($showstatus=mysqli_fetch_array($status))
 {
	 $i++;
	 ?>
	
					
				
 <!-- Modal -->
  <div class="modal fade" id="likemodal<?php echo $i; ?>" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header" style="background:url(images/friend.jpg);">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h6 class="modal-title" ><i class="fa fa-thumbs-o-up fa-fw"></i>LIKED BY</h6>
        </div>
        <div class="modal-body" style="background:url(images/model.jpg);">
		
			
			<?php
			$sid=$showstatus["STATUSID"];
			$showlike=mysqli_query($con,"select s.FIRSTNAME,s.LASTNAME,s.EMAIL,s.PIC,sl.LIKEBY,sl.STATUSID,sl.DATE,sl.TIME,sl.TYPE from statuslike sl,signup s where sl.LIKEBY=s.EMAIL and sl.STATUSID='$sid'");
			
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
          <h5 class="w3-opacity"><img src="user/<?php echo $showstatus["PIC"];?>" class="img img-circle" style="width:10%;height:50px;"><a href="user.php?useremail=<?php echo $showstatus["EMAIL"];?>" onmouseout="this.style.color='white'" onmouseover="this.style.color ='orange'" style="color:white;"><?php echo $showstatus["FIRSTNAME"]."&nbsp".$showstatus["LASTNAME"];?></a><a style="color:orange;">&nbspPosted A Status</a></h5>
          <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i><?php echo $showstatus["DATE"];?> - <span class="w3-tag w3-teal w3-round"><?php echo $showstatus["TIME"];?></span>&nbsp <a onclick="openstatusedit('<?php echo $i;?>')" onmouseout="this.style.color='white'"onmouseover="this.style.color ='orange'" style="cursor:pointer;color:white;"><i class="fa fa-edit fa-fw"></i>Edit</a>
		   <a onclick="deletestatus('<?php echo $showstatus["STATUSID"];?>')" onmouseout="this.style.color='white'"onmouseover="this.style.color ='orange'" style="cursor:pointer;color:white;"><i class="fa fa-trash fa-fw"></i>Delete</a></h6>
          <p><?php echo $showstatus["STATUS"];?></p>
		   
		   <!--The Div For Edit Of status-->
		   <div id="statuseditor<?php echo $i; ?>" style="display:none;">
<textarea  style="resize:none;width:100%;color:black;" id="es<?php echo $i;?>"  rows="5" placeholder="Edit Here.." required=""><?php echo $showstatus["STATUS"];?></textarea>
<button type="button" onclick="statusedit('<?php echo $showstatus["STATUSID"];?>','<?php echo $i; ?>')" class="btnpost" >Update</button>
<a style="cursor:pointer;color:white;"  class="close" onclick="closediv('<?php echo $i;?>')">Cancel</a>
</div>

		<!--end of div for stauts edit-->  
<h5 class="w3-text-teal" >


<div class="container-fluid">
<div class="row">
<div class="col-sm-12">
<?php
$fettype=mysqli_query($con,"select * from statuslike where STATUSID='$sid' and LIKEBY='$em'");
//while($liketype=mysqli_fetch_array($fettype))

	$liketype=mysqli_fetch_array($fettype);
	if(mysqli_num_rows($fettype)>0)
	{
	if($liketype["TYPE"]=="like")
	{
?>	
<span class="like-btn"><img style="width:30px;height:30px;" src="images/feelings_like.gif"><span style="color:orange;" onmouseout="this.style.color='orange'" onmouseover="this.style.color='green'" class="like-btn-text">You reacted <?php echo $liketype["TYPE"];?></span> <!-- Default like button -->
<?php
	}
	if($liketype["TYPE"]=="sad")
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


						<!--<span class="like-btn-emo like-btn-default"></span> <!-- Default like button emotion-->
						<!--<span class="like-btn-text">Likes</span> <!-- Default like button text,(Like, wow, sad..) default:Like  -->
						  <ul class="feelings-box" > <!-- feeling buttons container-->
								<li onclick="setlike('<?php echo $showstatus["STATUSID"];?>','<?php echo $showstatus["EMAIL"];?>','like')" class="feeling feeling-like"  data-feeling="Like"></li>
								
								<li onclick="setlike('<?php echo $showstatus["STATUSID"];?>','<?php echo $showstatus["EMAIL"];?>','haha')" class="feeling feeling-haha"  data-feeling="HaHa"></li>
								
								<li onclick="setlike('<?php echo $showstatus["STATUSID"];?>','<?php echo $showstatus["EMAIL"];?>','dislike')"  class="feeling feeling-dislike"  data-feeling="dislike"></li>
								
								<li onclick="setlike('<?php echo $showstatus["STATUSID"];?>','<?php echo $showstatus["EMAIL"];?>','sad')" class="feeling feeling-sad"  data-feeling="Sad"></li>
								
								<li onclick="setlike('<?php echo $showstatus["STATUSID"];?>','<?php echo $showstatus["EMAIL"];?>','angry')" class="feeling feeling-angry"  data-feeling="Angry"></li>&nbsp
								<li onclick="setlike('<?php echo $showstatus["STATUSID"];?>','<?php echo $showstatus["EMAIL"];?>','well-done')" class="feeling feeling-welldone"  data-feeling="well-done"></li>&nbsp
								<li onclick="setlike('<?php echo $showstatus["STATUSID"];?>','<?php echo $showstatus["EMAIL"];?>','punch')" class="feeling feeling-punch"  data-feeling="punch"></li>&nbsp
                                <li onclick="setlike('<?php echo $showstatus["STATUSID"];?>','<?php echo $showstatus["EMAIL"];?>','love')" class="feeling feeling-love"  data-feeling="Love"></li>&nbsp						  
						  </ul>
					</span>
					
					</div>
					</div>
					</div>
					

<?php
$fetlike=mysqli_query($con,"select * from statuslike where STATUSID='$sid'");
$checkulike=mysqli_query($con,"select * from statuslike where STATUSID='$sid' and LIKEBY='$em'");
$cl=mysqli_num_rows($fetlike);
$countlike=$cl-1;
if(mysqli_num_rows($fetlike)>0)
{
?>
<p data-toggle="modal" href="#likemodal<?php echo $i;?>" style="color:orange;"><img style="width:38px;height:40px;" src="images/feelings_smile.gif"><img style="width:38px;height:40px;left:2px;" src="images/feelings_love.gif">

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
<div contenteditable="true" onkeyup="tag('<?php echo $i?>')" id="contentbox<?php echo $i; ?>"  style="resize:none;color:black;background-color:white" placeholder="Write Comment....." class="input-field"></div>

<button type="submit"  onclick="poststatuscomment('<?php echo $showstatus["STATUSID"];?>','<?php echo $i;?>','<?php echo $showstatus["EMAIL"];?>')" class="btnsignup"><i class="fa fa-comment"></i>Post</button>
</div>
<div class="container-fluid">
<div class="row">
<div class="col-sm-12">
<div class="w3-animate-opacity" id="display<?php echo $i;?>">
</div>
</div>
</div>
</div>



<!--calling comment by ajax-->
<div id="showstatuscomment<?php echo $i; ?>,<?php echo $showstatus["STATUSID"]; ?>">
</div>
<!--calling coment by ajax end-->
<!----php for show status comment-->
<?php
$sid=$showstatus["STATUSID"];
$statuscomment=mysqli_query($con,"select s.FIRSTNAME,s.LASTNAME,s.EMAIL,s.PIC,sc.COMMENT,sc.COMMENTID,sc.COMMENTBY,sc.STATUSID,sc.DATE,sc.TIME from statuscomment sc,signup s where s.EMAIL=sc.COMMENTBY and sc.STATUSID='$sid' order by sc.COMMENTID desc limit 0,1");
while($showsc=mysqli_fetch_array($statuscomment))
{
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
	?>
<h6 class="w3-text-teal"><a onclick="deletestatuscomment('<?php echo $i; ?>','<?php echo $showsc["COMMENTID"];?>')" onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'" style="cursor:pointer;color:white;"><i class="fa fa-trash fa-fw"></i>Delete</a></h6>
	 
	<?php
}
?>
<!--The Div For Edit Of comment-->
		   <div id="comedit<?php echo $i; ?>" style="display:none;">
<textarea  style="resize:none;width:100%;color:black;" id="cs<?php echo $i;?>"  rows="5" placeholder="Edit Here.." required=""><?php echo $showsc["COMMENT"];?></textarea>
<button type="button" onclick="comdit('<?php echo $showsc["COMMENTID"];?>','<?php echo $i; ?>','<?php echo $sid;?>')" class="btnpost" >Update</button>
<a style="cursor:pointer;color:white;"  class="close" onclick="closece('<?php echo $i;?>')">Cancel</a>
</div>
<!--the div for edit of comment end-->

		 <br>
		  <p style="padding-left:5%;padding-right:2%;"><?php echo $showsc["COMMENT"];?></p>
 
		<!--The Div For showing all comment-->
		   <div  id="sscopen<?php echo $i; ?>" style="display:none;">
		   <div id="ssc<?php echo $i;?>"></div>
		   
</div>
<p id="sm<?php echo $i;?>" onclick="sscmnt('<?php echo $i;?>','<?php echo $showstatus["STATUSID"];?>')" onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'" style="cursor:pointer;color:white;text-align:center;">SEE MORE</p>
<!--the div for showing all comment end--> 
<p onmouseover="this.style.color='orange'" id="clscmnt<?php echo $i;?>" onclick="closescmnt('<?php echo $i;?>')" onmouseout="this.style.color='white'" style="cursor:pointer;color:white;text-align:center;display:none;">SEE LESS</p>
		  <div class="w3ls-border"> </div>
		  <?php
		  }
		  ?>
<!----php for show status comment end-->
								</h5>
			

			

          <hr>
		 <?php
 }
 ?>
 </div>
 </div>