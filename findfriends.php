<div class="row">
<?php
include("connection.php");
$em=$_COOKIE["Email"];
$textt=$_REQUEST["text"];
$f=mysqli_query($con,"select s.FIRSTNAME,s.LASTNAME,s.EMAIL,s.GENDER,s.PIC,s.AGE,s.CITY,s.COUNTRY,f.FRIENDEMAIL,f.EMAIL,f.FRIENDID from friend f,signup s where s.FIRSTNAME like '%$textt%' and (s.EMAIL=f.FRIENDEMAIL and f.EMAIL='$em' and s.EMAIL<>'$em')");
while($gf=mysqli_fetch_array($f))
{
?>
<div class="col-sm-6">
<div class="w3-address-grid">
<div class="w3ls-post-grids">
						
							<div class="w3ls-post-img">
								<a href="user.php?useremail=<?php echo $gf["EMAIL"];?>"><img src="user/<?php echo $gf["PIC"];?>" alt="" /></a>
							</div>
							<div class="w3ls-post-info">
								<h6><a href="user.php?useremail=<?php echo $gf["FRIENDEMAIL"];?>"><?php echo $gf["FIRSTNAME"]."&nbsp".$gf["LASTNAME"];?></a></h6>
								<p><?php echo $gf["AGE"];?></p>
								<p><?php echo $gf["GENDER"];?></p>
								<p><?php echo $gf["CITY"];?></p>
								<p><?php echo $gf["COUNTRY"];?></p>
								<button type="button" class="btnunfriend" onclick="unfriend('<?php echo $gf["FRIENDEMAIL"] ;?>')">Unfriend</button>
								<button type="button" class="btn btn-primary" onclick="msg('<?php echo $gf["FRIENDEMAIL"] ;?>')"><i class="fa fa-envelope"></i></button>
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
