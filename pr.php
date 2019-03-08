<div class="scrollbar" id="prscr" onscroll="prscrl()" style="height:900px;overflow-y:auto;">
<?php
include("connection.php");
$em=$_COOKIE["Email"];
$search=$_REQUEST["search"];
$f=mysqli_query($con,"select s.FIRSTNAME,s.LASTNAME,s.EMAIL,s.PIC,p.TITLE,p.SUMMARY,p.PROJECT,p.PROJECTID,p.DATE,p.TIME,p.CATEGORY from project p,signup s where (TITLE LIKE '%$search%' or CATEGORY LIKE '%$search%') and s.EMAIL=p.EMAIL");
$i=0;
while($gf=mysqli_fetch_array($f))
{
	$i++;
?>
<!--usermsg starts-->
	<div id="usermsgpr<?php echo $i;?>" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h6 class="modal-title" style="text-align:center;"><i class="fa fa-users"></i>Message</h6>
      </div>
      <div class="modal-body" style="background:url(images/model.jpg);">
	 <div class="row">
<textarea id="usrmsgpr<?php echo $i;?>" style="resize:none;width:100%;color:black;" class="form-control"  rows="5" placeholder="Send Message To User...." ></textarea>
<button type="button" onclick="usermsgpr('<?php echo $gf["EMAIL"];?>','<?php echo $i;?>')" class="btnaccept">Send</button>
</div>
</div>
 
     
      <div class="modal-footer" style="background:url(images/model.jpg);">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
	   </div>
	   </div>
    </div><!-- /.modal-content -->
<!-- Modal -->
  <div class="modal fade" id="likeprojectmodal<?php echo $i; ?>" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header" style="background:url(images/friend.jpg);">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h6 style="color:white;"  class="modal-title" ><i class="fa fa-thumbs-o-up fa-fw"></i>LIKED BY</h6>
        </div>
        <div class="modal-body" style="background:url(images/model.jpg);">
		
			
			<?php
			$proid=$gf["PROJECTID"];
			$showlike=mysqli_query($con,"select s.FIRSTNAME,s.LASTNAME,s.EMAIL,s.PIC,pl.LIKEBY,pl.PROJECTID,pl.DATE,pl.TIME from projectlike pl,signup s where pl.LIKEBY=s.EMAIL and pl.PROJECTID='$proid'");
			while($likeby=mysqli_fetch_array($showlike))
			{
				?>
	<h5 style="color:white;" class="w3-opacity"><img src="user/<?php echo $likeby["PIC"];?>" class="img img-circle" style="width:10%;height:50px;"><a href="user.php?useremail=<?php echo $likeby["EMAIL"];?>" onmouseout="this.style.color='white'"onmouseover="this.style.color ='orange'" style="color:white;"><?php echo $likeby["FIRSTNAME"]."&nbsp".$likeby["LASTNAME"];?></a></h5>
          <h6 style="color:white;" class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i><?php echo $likeby["DATE"];?> - <span class="w3-tag w3-teal w3-round"><?php echo $likeby["TIME"];?></span></h6>	
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
  
<div class="col-sm-12">
<div class="w3-address-grid">
<div class="w3ls-post-grids">
						
							<div class="w3ls-post-img">
								<a href="user.php?useremail=<?php echo $gf["EMAIL"];?>"><img src="user/<?php echo $gf["PIC"];?>" alt="" /></a>
							</div>
							<div class="w3ls-post-info">
								<h6><a href="user.php?useremail=<?php echo $gf["EMAIL"];?>"><?php echo $gf["FIRSTNAME"]."&nbsp".$gf["LASTNAME"];?></a></h6>
								<p><?php echo $gf["TITLE"];?></p>
								<p><?php echo $gf["CATEGORY"];?></p>
								<p><?php echo $gf["SUMMARY"];?></p>
	<h6 style="color:white;" class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i><?php echo $gf["DATE"];?> - <span  class="w3-tag w3-teal w3-round"><?php echo $gf["TIME"];?></span>					
		</br></br>						
								<a onclick="downloadproject('<?php echo $gf["PROJECTID"];?>')" href="userproject/<?php echo $gf["PROJECT"];?>" download ><button  type="button" class="btndwn"><i style="width:100%;" class="fa fa-download"></i>Download This Project</button></a>
</br></br>								
								<button type="button" class="btn btn-primary" data-toggle="modal" href="#usermsgpr<?php echo $i;?>")"><i class="fa fa-envelope"></i>Send Message</button>
							<?php 
		  $fbook=mysqli_query($con,"select * from bookmark where PROJECTID='$proid' and BOOKBY='$em'");
		  if(mysqli_num_rows($fbook)>0)
		  {
			  ?>
<i class="fa fa-bookmark"></i>&nbsp <i style="color:orange;" class="fa fa-check"></i>	  
<?php
		  }
		  else
		  {
		  ?>
</br></br><button  onclick="book('<?php echo $gf["PROJECTID"];?>','<?php echo $gf["EMAIL"];?>')" type="button" class="btndwn"><i style="width:100%;" class="fa fa-bookmark"></i>add to bookmark</button> 
<?php
		  }
		  ?>
							
							</div>
							<div class="clearfix"> </div>
						
						<h5 class="w3-text-teal" >
<?php
$pro=$gf["PROJECTID"];
$checklike=mysqli_query($con,"select * from projectlike where LIKEBY='$em' and PROJECTID='$pro'");
$checkl=mysqli_query($con,"select * from projectlike where  PROJECTID='$pro'");
$countl=mysqli_num_rows($checkl);
if(mysqli_num_rows($checklike)>0)
{
	?>
<a style="cursoe:pointer;" onclick="spprojectlike('<?php echo $gf["PROJECTID"];?>','<?php echo $gf["EMAIL"];?>','<?php echo $search;?>')"><i class="fa fa-thumbs-up" style="color:dodgerblue;font-size:20px;"></i></a>
<?php
}
else
{
	?>
	<a onclick="spprojectlike('<?php echo $gf["PROJECTID"];?>','<?php echo $gf["EMAIL"];?>','<?php echo $search;?>')" onmouseout="this.style.color='white'"onmouseover="this.style.color ='orange'" style="cursor:pointer;color:white;">
	<i class="fa fa-thumbs-o-up fa-fw"></i></a>
	<?php
}
?>
<a style="cursor:pointer;color:white;" data-toggle="modal" href="#likeprojectmodal<?php echo $i;?>" onmouseout="this.style.color='white'" onmouseover="this.style.color='orange'">(<?php echo $countl;?>)</a>
<?php
$pro=$gf["PROJECTID"];
$checkdislike=mysqli_query($con,"select * from projectdislike where DISLIKEBY='$em' and  PROJECTID='$pro'");
$countdislike=mysqli_query($con,"select * from projectdislike where   PROJECTID='$pro'");
$countdis=mysqli_num_rows($checkdislike);
if(mysqli_num_rows($checkdislike)>0)
{
	?>
	<a onclick="spprojectdislike('<?php echo $gf["PROJECTID"];?>','<?php echo $search;?>')" style="cursor:pointer;"><i  class="fa fa-thumbs-down" style="color:red;font-size:20px;"></i></a>
<?php
}
else
{
	?>
<a onclick="spprojectdislike('<?php echo $gf["PROJECTID"];?>','<?php echo $search;?>')" style="cursor:pointer;color:white;" onmouseout="this.style.color='white'" onmouseover="this.style.color='orange'"><i class="fa fa-thumbs-o-down fa-fw" ></i></a>
<?php
}
?>
<span style="color:white;">(<?php echo $countdis;?>)</span>
<div class="input-con">
<input type="text"  id="sprojectcomment<?php echo $i; ?>"  style="color:black;" placeholder="Write Comment....." class="input-field">
<button type="submit" onclick="sppostprojectcomment('<?php echo $gf["PROJECTID"];?>','<?php echo $i;?>','<?php echo $gf["EMAIL"];?>','<?php echo $search;?>')" class="btnsignup"><i class="fa fa-comment"></i>Post</button>
</div>
<!--calling comment by ajax-->
<div id="spshowprojectcomment<?php echo $i; ?>,<?php echo $gf["PROJECTID"]; ?>">
</div>
<!--calling coment by ajax end-->
<!----php for show status comment-->
<?php
$pro=$gf["PROJECTID"];
$projectcomment=mysqli_query($con,"select s.FIRSTNAME,s.LASTNAME,s.EMAIL,s.PIC,prc.COMMENT,prc.COMMENTID,prc.COMMENTBY,prc.PROJECTID,prc.DATE,prc.TIME from projectcomment prc,signup s where s.EMAIL=prc.COMMENTBY and prc.PROJECTID='$pro' order by prc.COMMENTID desc limit 0,1");
while($showprc=mysqli_fetch_array($projectcomment))
{
	?>
	<h5 style="color:white;" class="w3-opacity"><img src="user/<?php echo $showprc["PIC"];?>" class="img img-circle" style="width:5%;height:40px;"><a href="user.php?useremail=<?php echo $showprc["EMAIL"];?>" onmouseout="this.style.color='dodgerblue'"onmouseover="this.style.color ='orange'" style="color:dodgerblue;"><?php echo $showprc["FIRSTNAME"]."&nbsp".$showprc["LASTNAME"];?></a>&nbsp Commented On This </h5>
          <h6 style="color:white;" class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i><?php echo $showprc["DATE"];?> - <span class="w3-tag w3-teal w3-round"><?php echo $showprc["TIME"];?></span>&nbsp </h6>
<?php
if($em==$showprc["COMMENTBY"])
{
	?>
		  <h6 class="w3-text-teal"><a onclick="tropence('<?php echo $i;?>')" onmouseout="this.style.color='white'"onmouseover="this.style.color ='orange'" style="cursor:pointer;color:white;"><i class="fa fa-edit fa-fw"></i>Edit</a>
	<a onclick="spdeleteprojectcomment('<?php echo $i; ?>','<?php echo $showprc["COMMENTID"];?>','<?php echo $search;?>')" onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'" style="cursor:pointer;color:white;"><i class="fa fa-trash fa-fw"></i>Delete</a></h6>
	
	<?php
}
else 
{
	?>
<h6 class="w3-text-teal"><a onclick="spdeleteprojectcomment('<?php echo $i; ?>','<?php echo $showprc["COMMENTID"];?>','<?php echo $search;?>')" onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'" style="cursor:pointer;color:white;"><i class="fa fa-trash fa-fw"></i>Delete</a></h6>
	 
	<?php
}
?>
		 <br>
		  <p style="padding-left:5%;padding-right:2%;color:white;"><?php echo $showprc["COMMENT"];?></p>
		  <!--The Div For Edit Of comment-->
		   <div id="trcomedit<?php echo $i; ?>" style="display:none;">
<textarea  style="resize:none;width:100%;color:black;" id="trcs<?php echo $i;?>"  rows="5" placeholder="Edit Here.." required=""><?php echo $showprc["COMMENT"];?></textarea>
<button type="button" onclick="trcomdit('<?php echo $showprc["COMMENTID"];?>','<?php echo $i; ?>','<?php echo $search; ?>')" class="btnpost" >Update</button>
<a style="cursor:pointer;color:white;"  class="close" onclick="trclosece('<?php echo $i;?>')">Cancel</a>
</div>
<!--the div for edit of comment end-->

		 <!--The Div For showing all comment-->
		   <div  id="trsscopen<?php echo $i; ?>" style="display:none;">
		   <div id="trssc<?php echo $i;?>"></div>
		   
</div>
<p id="trsm<?php echo $i;?>" onclick="trsscmnt('<?php echo $i;?>','<?php echo $gf["PROJECTID"];?>','<?php echo $search;?>')" onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'" style="cursor:pointer;color:white;text-align:center;">SEE MORE</p>
<!--the div for showing all comment end--> 
<p onmouseover="this.style.color='orange'" id="trclscmnt<?php echo $i;?>" onclick="trclosescmnt('<?php echo $i;?>')" onmouseout="this.style.color='white'" style="cursor:pointer;color:white;text-align:center;display:none;">SEE LESS</p>
		  <div class="w3ls-border"> </div>
		  <?php
		  }
		  ?>
<!----php for show status comment end-->
								</h5>
						
						
						</div>
</div>
						</br>
</div>
						
					<?php
}
?>				
</div>
