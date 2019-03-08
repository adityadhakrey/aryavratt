
<div class="w3-container" style="color:white;padding-left:2%;padding-right:2%;">
<?php
 include("connection.php");
 $em=$_COOKIE["Email"];
 $proid=$n["PROJECTID"];
 $project=mysqli_query($con,"select s.FIRSTNAME,s.LASTNAME,s.PIC,s.EMAIL,p.PROJECT,p.DATE,p.TIME,p.TITLE,p.SUMMARY,p.CATEGORY,p.EMAIL,p.PROJECTID from project p,signup s where s.EMAIL=p.EMAIL and p.PROJECTID='$proid'");
$i=0;
 while($showpro=mysqli_fetch_array($project))
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
			$proid=$showpro["PROJECTID"];
			$showlike=mysqli_query($con,"select s.FIRSTNAME,s.LASTNAME,s.EMAIL,s.PIC,pl.LIKEBY,pl.PROJECTID,pl.DATE,pl.TIME from projectlike pl,signup s where pl.LIKEBY=s.EMAIL and pl.PROJECTID='$proid'");
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
            <h5 class="w3-opacity"><img src="user/<?php echo $showpro["PIC"];?>" class="img img-circle" style="width:10%;height:50px;"><a href="user.php?useremail=<?php echo $showpro["EMAIL"];?>" onmouseout="this.style.color='white'"onmouseover="this.style.color ='orange'" style="color:white;"><?php echo $showpro["FIRSTNAME"]."&nbsp".$showpro["LASTNAME"];?></a><a style="color:orange;">&nbspUpload A Project</a></h5>
          <h6 style="color:white;" class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i><?php echo $showpro["DATE"];?> - <span  class="w3-tag w3-teal w3-round"><?php echo $showpro["TIME"];?></span>&nbsp 
		   <a onclick="deleteproject('<?php echo $showpro["PROJECTID"];?>')" onmouseout="this.style.color='white'"onmouseover="this.style.color ='orange'" style="cursor:pointer;color:white;"><i class="fa fa-trash fa-fw"></i>Delete</a></h6>
          <h4><?php echo $showpro["TITLE"];?></h4>
		  <p><?php echo $showpro["SUMMARY"];?></p>
		  
		   		   </br></br>
<a onclick="downloadproject('<?php echo $showpro["PROJECTID"];?>')" href="userproject/<?php echo $showpro["PROJECT"];?>" download ><button  type="button" class="btndwn"><i style="width:100%;" class="fa fa-download"></i>Download This Project</button></a>

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
</br></br><button  onclick="book('<?php echo $showpro["PROJECTID"];?>','<?php echo $showpro["EMAIL"];?>')" type="button" class="btndwn"><i style="width:100%;" class="fa fa-bookmark"></i>add to bookmark</button> 
<?php
		  }
		  ?>
<h5 class="w3-text-teal" >
<?php
$pro=$showpro["PROJECTID"];
$checklike=mysqli_query($con,"select * from projectlike where LIKEBY='$em' and PROJECTID='$pro'");
$clike=mysqli_query($con,"select * from projectlike where PROJECTID='$pro'");
$countlike=mysqli_num_rows($clike);
if(mysqli_num_rows($checklike)>0)
{
	?>
<a style="cursoe:pointer;" onclick="projectlike('<?php echo $showpro["PROJECTID"];?>','<?php echo $showpro["EMAIL"];?>')"><i class="fa fa-thumbs-up" style="color:dodgerblue;font-size:20px;"></i></a>
<?php
}
else
{
	?>
	<a onclick="projectlike('<?php echo $showpro["PROJECTID"];?>','<?php echo $showpro["EMAIL"];?>')" onmouseout="this.style.color='white'"onmouseover="this.style.color ='orange'" style="cursor:pointer;color:white;">
	<i class="fa fa-thumbs-o-up fa-fw"></i></a>
	<?php
}
?>
<a style="cursor:pointer;color:white;" onmouseout="this.style.color='white'" onmouseover="this.style.color='orange'">(<?php echo $countlike;?>)</a>
<?php
$pro=$showpro["PROJECTID"];
$checkdislike=mysqli_query($con,"select * from projectdislike where DISLIKEBY='$em' and PROJECTID='$pro'");
$cdislike=mysqli_query($con,"select * from projectdislike where PROJECTID='$pro'");
$countdislike=mysqli_num_rows($cdislike);
if(mysqli_num_rows($checkdislike)>0)
{
	?>
	<a onclick="projectdislike('<?php echo $showpro["PROJECTID"];?>')" style="cursor:pointer;"><i  class="fa fa-thumbs-down" style="color:red;font-size:20px;"></i></a>
<?php
}
else
{
	?>
<a onclick="projectdislike('<?php echo $showpro["PROJECTID"];?>')" style="cursor:pointer;color:white;" onmouseout="this.style.color='white'" onmouseover="this.style.color='orange'"><i class="fa fa-thumbs-o-down fa-fw" ></i></a>
<?php
}
?>
<span>(<?php echo $countdislike;?>)</span>
<div class="input-con">
<input type="text"  id="uprojectcomment<?php echo $i; ?>"  style="color:black;" placeholder="Write Comment....." class="input-field">
<button type="submit" onclick="postprojectcomment('<?php echo $showpro["PROJECTID"];?>','<?php echo $i;?>','<?php echo $showpro["EMAIL"];?>')" class="btnsignup"><i class="fa fa-comment"></i>Post</button>
</div>
<!--calling comment by ajax-->
<div id="showprojectcomment<?php echo $i; ?>,<?php echo $showpro["PROJECTID"]; ?>">
</div>
<!--calling coment by ajax end-->
<!----php for show status comment-->
<?php
$pro=$showpro["PROJECTID"];
$projectcomment=mysqli_query($con,"select s.FIRSTNAME,s.LASTNAME,s.EMAIL,s.PIC,prc.COMMENT,prc.COMMENTID,prc.COMMENTBY,prc.PROJECTID,prc.DATE,prc.TIME from projectcomment prc,signup s where s.EMAIL=prc.COMMENTBY and prc.PROJECTID='$pro' order by prc.COMMENTID desc limit 0,1");
while($showprc=mysqli_fetch_array($projectcomment))
{
	?>
	<h5 class="w3-opacity"><img src="user/<?php echo $showprc["PIC"];?>" class="img img-circle" style="width:5%;height:40px;"><a href="user.php?useremail=<?php echo $showprc["EMAIL"];?>" onmouseout="this.style.color='dodgerblue'"onmouseover="this.style.color ='orange'" style="color:dodgerblue;"><?php echo $showprc["FIRSTNAME"]."&nbsp".$showprc["LASTNAME"];?></a>&nbsp Commented On This </h5>
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
	?>
<h6 class="w3-text-teal"><a onclick="deleteprojectcomment('<?php echo $i; ?>','<?php echo $showprc["COMMENTID"];?>')" onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'" style="cursor:pointer;color:white;"><i class="fa fa-trash fa-fw"></i>Delete</a></h6>
	 
	<?php
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

		 <!--The Div For showing all comment-->
		   <div  id="prosscopen<?php echo $i; ?>" style="display:none;">
		   <div id="prossc<?php echo $i;?>"></div>
		   
</div>
<p id="prosm<?php echo $i;?>" onclick="prosscmnt('<?php echo $i;?>','<?php echo $showpro["PROJECTID"];?>')" onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'" style="cursor:pointer;color:white;text-align:center;">SEE MORE</p>
<!--the div for showing all comment end--> 
<p onmouseover="this.style.color='orange'" id="proclscmnt<?php echo $i;?>" onclick="proclosescmnt('<?php echo $i;?>')" onmouseout="this.style.color='white'" style="cursor:pointer;color:white;text-align:center;display:none;">SEE LESS</p>
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



 