<?php
include("connection.php");
$em=$_COOKIE["Email"];
if(!isset($_COOKIE["Email"]))
{
header("location:index.php");
}
$search=$_REQUEST["search"];
?>
  <div class="overlaysearch-content">
  

<div class="container-fluid">
<label><i class="fa fa-search"></i>You Searched For "<?php echo $search;?>"</label> 
</br>


<div class="row">

<?php
$text=mysqli_query($con,"select * from signup where (FIRSTNAME LIKE '%$search%' or LASTNAME LIKE '%$search%') and Email<>'$em'");
while($gettext=mysqli_fetch_array($text))
{
	$email=$gettext["EMAIL"];
	?>
	
	<div class="col-sm-4">
				
					
					<div class="w3-address-grid">
						<div class="w3ls-post-grid">
							<div class="w3ls-post-img">
								<a href="#"><img src="user/<?php echo $gettext["PIC"];?>" alt="" /></a>
							</div>
							<div class="w3ls-post-info">
						<a href="user.php?useremail=<?php echo $gettext["EMAIL"];?>" ><?php echo $gettext["FIRSTNAME"]."&nbsp".$gettext["LASTNAME"];?></a>
								<p>AGE-<?php echo $gettext["AGE"];?></p>
								<p><?php echo $gettext["CITY"];?></p>
								<p><?php echo $gettext["COUNTRY"];?></p>
								<?php
								$checkrequest=mysqli_query($con,"select * from request where REQUESTBY='$em' and REQUESTTO='$email'");
								$checkfriend=mysqli_query($con,"select * from friend where EMAIL='$em' and FRIENDEMAIL='$email'");
								$acceptrequest=mysqli_query($con,"select * from request where REQUESTTO='$em' and REQUESTBY='$email'");
								if(mysqli_num_rows($checkrequest)>0)
								{
									?>
									<button type="button" class="btncancel" onclick="cancelrequest('<?php echo $email; ?>')"><i class="fa fa-handshake-o"></i>Cancel Request</button>
								<?php
								}
								else if(mysqli_num_rows($checkfriend)>0)
								{
									?>
									<button type="button" class="btnunfriend" onclick="unfriend('<?php echo $email ;?>')">Unfriend</button>
									<?php
								}
								else if(mysqli_num_rows($acceptrequest)>0)
								{
									?>
							<button type="button" onclick="acceptsearch('<?php echo $email; ?>')" class="btnaccept">Accept</button><button onclick="declinesearch('<?php echo $email; ?>')" type="button" class="btndecline">Decline</button>		
									<?php
								}
								else
								{
									?>
								<button type="button" onclick="sendrequest('<?php echo $gettext["EMAIL"];?>')" class="btnaccept"><i class="fa fa-handshake-o"></i>Send Request</button>
								<?php
								}
								?>
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
</div>
</div>
