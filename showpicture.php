<div class="scrollbar" id="pscr" onscroll="pscrl()" style="overflow-y:auto;height:800px;">
 <div class="w3-container"  style="padding-left:2%;padding-right:2%;">
 <?php
 include("connection.php");
 $em=$_COOKIE["Email"];
 $picture=mysqli_query($con,"select s.FIRSTNAME,s.LASTNAME,s.PIC,s.EMAIL,p.PICTURE,p.PICTURECAPTION,p.EMAIL,p.PICTUREID,p.DATE,p.TIME from picture p,signup s where s.EMAIL=p.EMAIL and p.EMAIL='$em' order by p.PICTUREID desc");
 $i=0;
 while($showpicture=mysqli_fetch_array($picture))
 {
	 $i++;
	 ?>
	 <!-- Modal -->
  <div class="modal fade" id="likepicmodal<?php echo $i; ?>" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header" style="background:url(images/friend.jpg);">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h6 class="modal-title" ><i class="fa fa-thumbs-o-up fa-fw"></i>LIKED BY</h6>
        </div>
        <div class="modal-body" style="background:url(images/model.jpg);">
		
			
			<?php
			$pid=$showpicture["PICTUREID"];
			$showlike=mysqli_query($con,"select s.FIRSTNAME,s.LASTNAME,s.EMAIL,s.PIC,pl.LIKEBY,pl.PICTUREID,pl.DATE,pl.TIME,pl.TYPE from picturelike pl,signup s where pl.LIKEBY=s.EMAIL and pl.PICTUREID='$pid'");
			
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
	 
	 
	 
	 
          <h5 class="w3-opacity"><img src="user/<?php echo $showpicture["PIC"];?>" class="img img-circle" style="width:10%;height:50px;"><a href="user.php?useremail=<?php echo $showpicture["EMAIL"];?>" onmouseout="this.style.color='white'"onmouseover="this.style.color ='orange'" style="color:white;"><?php echo $showpicture["FIRSTNAME"]."&nbsp".$showpicture["LASTNAME"];?></a><a style="color:orange;">&nbspPosted A Picture</a></h5>
          <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i><?php echo $showpicture["DATE"];?> - <span class="w3-tag w3-teal w3-round"><?php echo $showpicture["TIME"];?></span>&nbsp <a  onclick="openpicedit('<?php echo $i;?>');" onmouseout="this.style.color='white'"onmouseover="this.style.color ='orange'" style="cursor:pointer;color:white;"><i class="fa fa-edit fa-fw"></i>Edit</a><a onclick="deletepicture('<?php echo $showpicture["PICTUREID"];?>')" onmouseout="this.style.color='white'"onmouseover="this.style.color ='orange'" style="cursor:pointer;color:white;"><i class="fa fa-trash fa-fw"></i>Delete</a>
		  <!-- AddToAny BEGIN -->
<!--<div class="a2a_kit a2a_kit_size_32 a2a_default_style">
<a class="a2a_dd" style="color:white;" href="https://www.addtoany.com/share">Share it</a>
<a class="a2a_button_facebook">a</a>
<a class="a2a_button_whatsapp">b</a>
<a class="a2a_button_facebook_messenger">c</a>
<a class="a2a_button_twitter">d</a>
</div>
<script async src="https://static.addtoany.com/menu/page.js"></script>
<!-- AddToAny END -->
</h6>
          <p><?php echo $showpicture["PICTURECAPTION"];?></p>
		  
		  
		  		   <!--The Div For Edit Of PIC-->
		   <div id="piceditor<?php echo $i; ?>" style="display:none;">
<textarea  style="resize:none;width:100%;color:black;" id="pe<?php echo $i;?>"  rows="5" placeholder="Edit Here.." required=""><?php echo $showpicture["PICTURECAPTION"];?></textarea>
<button type="button" onclick="picedit('<?php echo $showpicture["PICTUREID"];?>','<?php echo $i; ?>')" class="btnpost" >Update</button>
<a style="cursor:pointer;color:white;"  class="close" onclick="closepicedit('<?php echo $i;?>')">Cancel</a>
</div>
		<!--end of div for Pic edit-->  

		  <div class="galler-grid">
							<a class="example-image-link" href="userspicture/<?php echo $showpicture["PICTURE"];?>" data-lightbox="example-set" >
								<img src="userspicture/<?php echo $showpicture["PICTURE"];?>" alt="" /></a>
								</div>
		  
		  <h5 class="w3-text-teal">
		  <div class="container-fluid">

<div class="row">
<div class="col-sm-12">
<?php
$fettype=mysqli_query($con,"select * from picturelike where PICTUREID='$pid' and LIKEBY='$em'");
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
	<span class="like-btn"><img style="width:30px;height:30px;" src="images/feelings_love.gif"><span style="color:orange;" onmouseout="this.style.color='orange'" onmouseover="this.style.color='green'" class="like-btn-text">You reaction</span>ll
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
								<li onclick="setpiclike('<?php echo $showpicture["PICTUREID"];?>','<?php echo $showpicture["EMAIL"];?>','like')" class="feeling feeling-like"  data-feeling="Like"></li>
								
								<li onclick="setpiclike('<?php echo $showpicture["PICTUREID"];?>','<?php echo $showpicture["EMAIL"];?>','haha')" class="feeling feeling-haha"  data-feeling="HaHa"></li>
								
								<li onclick="setpiclike('<?php echo $showpicture["PICTUREID"];?>','<?php echo $showpicture["EMAIL"];?>','dislike')"  class="feeling feeling-dislike"  data-feeling="dislike"></li>
								
								<li onclick="setpiclike('<?php echo $showpicture["PICTUREID"];?>','<?php echo $showpicture["EMAIL"];?>','sad')" class="feeling feeling-sad"  data-feeling="Sad"></li>
								
								<li onclick="setpiclike('<?php echo $showpicture["PICTUREID"];?>','<?php echo $showpicture["EMAIL"];?>','angry')" class="feeling feeling-angry"  data-feeling="Angry"></li>&nbsp
								<li onclick="setpiclike('<?php echo $showpicture["PICTUREID"];?>','<?php echo $showpicture["EMAIL"];?>','well-done')" class="feeling feeling-welldone"  data-feeling="well-done"></li>&nbsp
								<li onclick="setpiclike('<?php echo $showpicture["PICTUREID"];?>','<?php echo $showpicture["EMAIL"];?>','punch')" class="feeling feeling-punch"  data-feeling="punch"></li>&nbsp
                                <li onclick="setpiclike('<?php echo $showpicture["PICTUREID"];?>','<?php echo $showpicture["EMAIL"];?>','love')" class="feeling feeling-love"  data-feeling="Love"></li>&nbsp						  
						  </ul>
					</span>
					
					</div>
					</div>
					</div>
					

<?php
$fetpiclike=mysqli_query($con,"select * from picturelike where PICTUREID='$pid'");
$checkuplike=mysqli_query($con,"select * from picturelike where PICTUREID='$pid' and LIKEBY='$em'");
$cl=mysqli_num_rows($fetpiclike);
$countlike=$cl-1;
if(mysqli_num_rows($fetpiclike)>0)
{
?>
<p data-toggle="modal" href="#likepicmodal<?php echo $i;?>" style="color:orange;"><img style="width:38px;height:40px;" src="images/feelings_smile.gif"><img style="width:38px;height:40px;left:2px;" src="images/feelings_love.gif">

<?php if(mysqli_num_rows($checkuplike)>0)
{
echo "You and &nbsp";
}
echo $countlike?> other
react on this picture</p>
<?php
}
?> 

</br>
<div class="input-con">
<input type="text"  id="picturecomment<?php echo $i; ?>"  style="color:black;" placeholder="Write Comment....." class="input-field">
								<button type="submit" onclick="postpicturecomment('<?php echo $showpicture["PICTUREID"];?>','<?php echo $i;?>','<?php echo $showpicture["EMAIL"];?>')" class="btnsignup"><i class="fa fa-comment"></i>Post</button>
</div>

<div id="picturecomment<?php echo $i; ?>,<?php echo $showpicture["PICTUREID"]; ?>">
</div>
<!---comment by php-->
<?php
 include("connection.php");
 $em=$_COOKIE["Email"];
 $pid=$showpicture["PICTUREID"];
 $picturecomment=mysqli_query($con,"select s.PIC,s.FIRSTNAME,s.LASTNAME,s.EMAIL,pc.COMMENT,pc.COMMENTBY,pc.COMMENTID,pc.PICTUREID,pc.DATE,pc.TIME from picturecomment pc,signup s where s.EMAIL=pc.COMMENTBY and pc.PICTUREID='$pid' order by pc.COMMENTID desc limit 0,1");
 while($showpc=mysqli_fetch_array($picturecomment))
 {
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
			  ?>
		<h6 class="w3-text-teal">  <a onclick="deletepicturecomment('<?php echo $i; ?>','<?php echo $showpc["COMMENTID"];?>')" onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'" style="cursor:pointer;color:white;"><i class="fa fa-trash fa-fw"></i>Delete</a></h6>		  
		  <?php
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
		  
		  <!--The Div For showing all comment-->
		   <div  id="pscopen<?php echo $i; ?>" style="display:none;">
		   <div id="psc<?php echo $i;?>"></div>
		   
</div>
<p id="pm<?php echo $i;?>" onclick="pscmnt('<?php echo $i;?>','<?php echo $showpicture["PICTUREID"];?>')" onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'" style="cursor:pointer;color:white;text-align:center;">SEE MORE</p>
<!--the div for showing all comment end--> 
<p onmouseover="this.style.color='orange'" id="clpcmnt<?php echo $i;?>" onclick="closepcmnt('<?php echo $i;?>')" onmouseout="this.style.color='white'" style="cursor:pointer;color:white;text-align:center;display:none;">SEE LESS</p>
		  <div class="w3ls-border"> </div>
		  <?php
		  }
		  ?>
		
<!---comment by php end-->
		  </h5>
          <hr>
     
		</br>
		<?php
 }
 ?>
    </div>
	</div>
	