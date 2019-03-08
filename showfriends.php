<div class="row">
<?php
include("connection.php");
$em=$_COOKIE["Email"];
$f=mysqli_query($con,"select s.FIRSTNAME,s.LASTNAME,s.EMAIL,s.GENDER,s.PIC,s.AGE,s.CITY,s.COUNTRY,f.FRIENDEMAIL,f.EMAIL,f.FRIENDID from friend f,signup s where s.EMAIL=f.FRIENDEMAIL and f.EMAIL='$em' order by f.FRIENDID desc");
$i=0;
while($gf=mysqli_fetch_array($f))
{
	$i++;
?>
<!--usermsg starts-->
	<div id="usermsg<?php echo $i;?>" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h6 class="modal-title" style="text-align:center;"><i class="fa fa-users"></i>Message</h6>
      </div>
      <div class="modal-body" style="background:url(images/model.jpg);">
	 <div class="row">
<textarea id="usrmsg<?php echo $i;?>" style="resize:none;width:100%;color:black;" class="form-control"  rows="5" placeholder="Send Message To User...." ></textarea>
<button type="button" onclick="usermsg('<?php echo $gf["EMAIL"];?>','<?php echo $i;?>')" class="btnaccept">Send</button>
</div>
</div>
 
     
      <div class="modal-footer" style="background:url(images/model.jpg);">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
	   </div>
	   </div>
    </div><!-- /.modal-content -->

<div class="col-sm-6">
<div class="w3-address-grid">
<div class="w3ls-post-grids">
						
							<div class="w3ls-post-img">
								<a href="user.php?useremail=<?php echo $gf["FRIENDEMAIL"];?>"><img src="user/<?php echo $gf["PIC"];?>" alt="" /></a>
							</div>
							<div class="w3ls-post-info">
								<h6><a href="user.php?useremail=<?php echo $gf["FRIENDEMAIL"];?>"><?php echo $gf["FIRSTNAME"]."&nbsp".$gf["LASTNAME"];?></a></h6>
								<p><?php echo $gf["AGE"];?></p>
								<p><?php echo $gf["GENDER"];?></p>
								<p><?php echo $gf["CITY"];?></p>
								<p><?php echo $gf["COUNTRY"];?></p>
								<button type="button" class="btnunfriend" onclick="unfriends('<?php echo $gf["FRIENDEMAIL"] ;?>')">Unfriend</button>
								<button type="button" class="btn btn-primary" data-toggle="modal" href="#usermsg<?php echo $i;?>"><i class="fa fa-envelope"></i>Send Message</button>
							</div>
							<div class="clearfix"> </div>
						
						</div>
</div>
						</br>
</div>
						
					<?php
}
?>				
</div>
