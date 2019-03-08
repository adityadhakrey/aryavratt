<div class="overlayr-content">
<div class="container-fluid">
<?php
include("connection.php");
$em=$_COOKIE["Email"];
$takerequest=mysqli_query($con,"select s.FIRSTNAME,s.LASTNAME,s.PIC,s.EMAIL,s.AGE,s.CITY,s.COUNTRY,s.GENDER,r.REQUESTID,r.REQUESTTO,r.DATE,r.TIME from request r,signup s where s.EMAIL=r.REQUESTBY and r.REQUESTTO='$em' order by r.REQUESTID desc");
while($seerequest=mysqli_fetch_array($takerequest))
{
	$email=$seerequest["EMAIL"];
	?>
	<div class="col-sm-6">
				<div class="col-md-12 w3-agile-grid">
					
					<div class="w3-address-grid">
						<div class="w3ls-post-grid">
							<div class="w3ls-post-img">
								<a href="#"><img src="user/<?php echo $seerequest["PIC"];?>" alt="" /></a>
							</div>
							<div class="w3ls-post-info">
						<a href="user.php?useremail=<?php echo $seerequest["EMAIL"];?>" ><?php echo $seerequest["FIRSTNAME"]."&nbsp".$seerequest["LASTNAME"];?></a>
								<p>AGE-<?php echo $seerequest["AGE"];?></p>
								<p><?php echo $seerequest["CITY"];?></p>
								<p><?php echo $seerequest["COUNTRY"];?></p>
								
								
							<button type="button" onclick="acceptrlay('<?php echo $email; ?>')" class="btnaccept">Accept</button><button onclick="declinerlay('<?php echo $email; ?>')" type="button" class="btndecline">Decline</button>		
									</div>
							<div class="clearfix"> </div>
						</div>
					</div>
					</br>
					</div>
					</div>

	
	
	
	<?php
}
?>
</div>
</div>