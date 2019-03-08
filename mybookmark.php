<?php 
include("connection.php");
$em=$_COOKIE["Email"];
$fb=mysqli_query($con,"select s.FIRSTNAME,s.LASTNAME,s.EMAIL,s.PIC,b.BOOKBY,b.BOOKOF,b.PROJECTID,b.BOOKID,b.DATE,b.TIME,p.PROJECTID,p.PROJECT,p.TITLE,p.SUMMARY,p.CATEGORY from project p,bookmark b,signup s where (s.EMAIL=p.EMAIL and p.EMAIL=b.BOOKOF) and b.BOOKBY='$em'order by b.BOOKID desc");
$i=0;
while($gf=mysqli_fetch_array($fb))
{ 
$i++;
?>
<div class="col-sm-12">
<div class="w3-address-grid">
<div class="w3ls-post-grids">
							<div class="w3ls-post-img">
								<a href="user.php?useremail=<?php echo $gf["EMAIL"];?>"><img src="user/<?php echo $gf["PIC"];?>" alt="" /></a>
							</div>
							<div class="w3ls-post-info">
								<h6><a href="user.php?useremail=<?php echo $gf["EMAIL"];?>"><?php echo $gf["FIRSTNAME"]."&nbsp".$gf["LASTNAME"];?></a></h6>
								<p style="color:white;"><?php echo $gf["TITLE"];?></p>
								<p style="color:white;"><?php echo $gf["CATEGORY"];?></p>
								<p style="color:white;"><?php echo $gf["SUMMARY"];?></p>
								
	<h6 style="color:white;" class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i><?php echo $gf["DATE"];?> - <span  class="w3-tag w3-teal w3-round"><?php echo $gf["TIME"];?></span>					
	</br></br><a onclick="downloadproject('<?php echo $gf["PROJECTID"];?>')" href="userproject/<?php echo $gf["PROJECT"];?>" download ><button  type="button" class="btndwn"><i style="width:100%;" class="fa fa-download"></i>Download This Project</button></a>
	
	<i style="cursor:pointer;" onclick="removebook('<?php echo $gf["PROJECTID"];?>')" onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'" class="fa fa-trash">Remove From Bookmark</i>

							
							
							
							</div>
							<div class="clearfix"> </div>
							</div>
							</div>
							</br>
							</div>
							<?php
}
?>