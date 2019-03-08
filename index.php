<?php
include("connection.php");
if(isset($_COOKIE["Email"]))
{
	header("location:profile.php");
}

$msg="";
if(isset($_REQUEST["login"]))
{
$email=$_REQUEST["email"];
$password=$_REQUEST["loginpass"];

$login=mysqli_query($con,"select * from signup where EMAIL='$email' and PASSWORD='$password'");

if(mysqli_num_rows($login)>0)
{
setcookie("Email",$email);
header("location:profile.php");
}
else
{
$msg="invalid User";
}
}
date_default_timezone_set("Asia/Kolkata");
if(isset($_REQUEST["D"]))
{
	$ddate=date("F j,y");
    $dtime=date("g:i a");
    $dn=$_REQUEST["DName"];
	$de=$_REQUEST["DEmail"];
	$dp=$_REQUEST["DPhone"];
	$dm=$_REQUEST["DMessage"];
	$d=mysqli_query($con,"insert into contact(NAME,EMAIL,PHONE,MESSAGE,TIME,DATE)values('$dn','$de','$dp','$dm','$dtime','$ddate')");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Aryavratt</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8">
<meta name="keywords" content="Capturing Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<!--// bootstrap-css -->
<!-- css -->
<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
<!--// css -->
<!-- font-awesome icons -->
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome icons -->
<!-- gallery -->
<link rel="stylesheet" href="css/lightbox.css">
<!-- //gallery -->
<!-- font -->
<link href="//fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Droid+Serif:400,400i,700,700i" rel="stylesheet">
<!-- //font -->
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){		
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	});
</script> 

<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<![endif]-->
<script type="text/javascript">
/*---
function valid()
{
var firstname=document.getElementById("firstname").value;
var lasttname=document.getElementById("lastname").value; l
var age=document.getElementById("age").value;
var city=document.getElementById("city").value;
var country=document.getElementById("country").value;
var email=document.getElementById("signemail").value;
var password=document.getElementById("password").value;
var cpassword=document.getElementById("cpassword").value;

var validfirstname=/^[a-zA-Z ]+$/;
var validlastname=/^[a-zA-Z ]+$/;
var validage=/^[0-9]{1,2}$/;
var validcity=/^[a-zA-Z ]+$/;
var validcountry=/^[a-zA-Z ]+$/;
var validemail=/^[a-zA-Z0-9_]+[@][a-zA-Z0-9]+[.][a-zA-Z]{2,4}([.][a-zA-Z]{2,4})?$/; 

if(!lastname.match(validfirstname))
{
alert("Please Enter Alphates Only ");
document.getElementById("firstname").focus();
return false;
}
else if(!firstname.match(validlastname))
{
alert("Please Enter Alphates Only ");
document.getElementById("lastname").focus();
return false;
}
else if(!age.match(validage))
{
alert("Please enter your Age Carefully");
document.getElementById("age").focus();
return false;
}
else if(!city.match(validcity))
 {
 alert("Please Enter Correct City");
 document.getElementById("city").focus();
 return false;
 }
 else if(!country.match(validcountry))
 {
 alert("Please Enter Correct City");
 document.getElementById("country").focus();
 return false;
 }
else if(!email.match(validemail))
 {
 alert("Please Enter Correct Email Format");
 document.getElementById("signemail").focus();
 return false;
 }
 else(!cpassword.match(password))
 {
 alert("password are not same please try Again");
 document.getElementById("cpassword").focus();
 return false;
 }
 
}
 
 function signup()
 {
	 
var fn=document.getElementById("firstname").value;
var ln=document.getElementById("lastname").value; 
var gender="";
if(document.getElementById("male").checked)
{
	gender="male";
}
else
{
 gender="female";
} 

var age=document.getElementById("age").value;
var city=document.getElementById("city").value;
var country=document.getElementById("country").value;
var email=document.getElementById("signemail").value;
var password=document.getElementById("password").value;
 if(valid()==true)
 {
 var r=newXMLhttpRequest();
 var t=Math.random()
 r.onreadystatechange=function()
 {
 if(r.readystate==4)
 {
 alert(r.responseText);
 }
 }
 r.open("post","signup.php?s="+t+"&firstname="+fn+"&lastname="+ln+"&gender="+gender+"&age="+age+"&city="+city+"&country="+country+"&email="+email+"&password="+password);
 r.send();
 }
 }
 --*/
 function forgotpass()
 {
	 var email=document.getElementById("forgotemail").value;
	 var t=Math.random();
	 var r=new XMLHttpRequest();
	 r.onreadystatechange=function()
	 {
		 if(r.readyState==4)
		 {
			 alert(r.responseText);
			 document.getElementById("forgotemail").focus();
		 }
	 }
	 r.open("post","forgot.php?s="+t+"&email="+email);
	 r.send();
 }
 function signup()
 {
	 
	 var firstname=document.getElementById("firstname").value;
	 var lastname=document.getElementById("lastname").value;
	 var gender="";
	 if(document.getElementById("male").checked)
	 {
		 gender="male";
	 }
	 else
	 {
		 gender="female";
	 }
	 var age=document.getElementById("age").value;
	 var city=document.getElementById("city").value;
	 var country=document.getElementById("country").value;
	 var email=document.getElementById("signemail").value;
	 var password=document.getElementById("password").value;
	var cpassword=document.getElementById("cpassword").value;
var f=/^[a-zA-Z ]+$/;
var l=/^[a-zA-Z ]+$/;
var a=/^[0-9]{1,2}$/;
var c=/^[a-zA-Z ]+$/;
var co=/^[a-zA-Z ]+$/;
var e=/^[a-zA-Z0-9_]+[@][a-zA-Z0-9]+[.][a-zA-Z]{2,4}([.][a-zA-Z]{2,4})?$/; 

if(!firstname.match(f))
{
alert("Please Enter Alphates Only ");
document.getElementById("firstname").focus();
return false;
}
else if(!lastname.match(l))
{
alert("Please Enter Alphates Only ");
document.getElementById("lastname").focus();
return false;
}
else if(!age.match(a))
{
alert("Please enter your Age Carefully");
document.getElementById("age").focus();
return false;
}
else if(!city.match(c))
 {
 alert("Please Enter Correct City");
 document.getElementById("city").focus();
 return false;
 }
 else if(!country.match(co))
 {
 alert("Please Enter Correct Country");
 document.getElementById("country").focus();
 return false;
 }
else if(!email.match(e))
 {
 alert("Please Enter Correct Email Format");
 document.getElementById("signemail").focus();
 return false;
 }
 else if(cpassword!=password)
 {
 alert("password are not same please try Again");
 document.getElementById("cpassword").focus();
 return false;
 }
 else
 {
 
  var t=Math.random()
var r=new XMLHttpRequest();
r.onreadystatechange=function()
 {
	  if(r.readyState==4)
 {
	  
 alert(r.responseText);
 }
 }
 r.open("post","signup.php?s="+t+"&firstname="+firstname+"&lastname="+lastname+"&gender="+gender+"&age="+age+"&city="+city+"&country="+country+"&email="+email+"&password="+password);
 r.send();
} 
 }
	 

history.pushState(null,null,document.title="index.php");
window.addEventListener('popstate',function()
{
	history.pusgState(null,null,document.title="index.php");
});


</script>
<style>
button.btnlogin {
    color: #FFFFFF;
    font-size: .6em;
    border-radius: 2px;
    padding: 1em 2em;
    text-align: center;
    text-decoration: none;
    background: #03A9F4;
    border: solid 2px #03a9f4;
    transition: 0.5s all;
    -webkit-transition: 0.5s all;
    -moz-transition: 0.5s all;
    -o-transition: 0.5s all;
    -ms-transition: 0.5s all;
}
button.btnlogin:hover {
    background: green;
	color:white;
	border: solid 2px red;
}
button.btnsignup {
    color: #FFFFFF;
    font-size: .9em;
    border: none;
    padding: 1em 1em;
    text-align: center;
    text-decoration: none;
    background: #03A9F4;
    border: solid 2px #03a9f4;
    transition: 0.5s all;
    -webkit-transition: 0.5s all;
    -moz-transition: 0.5s all;
    -o-transition: 0.5s all;
    -ms-transition: 0.5s all;
}
button.btnsignup:hover {
    background: grey;
	color:white;
	border: solid 2px green;
}
.icon {
  padding: 10px;
  background: dodgerblue;
  color: white;
  min-width: 50px;
  text-align: center;
}
.input-con {
  display: flex;
  width: 100%;
  margin-bottom: 15px;
}
.input-field {
  width: 100%;
  padding: 10px;
  outline: none;
}

.input-field:focus {
  border: 2px solid dodgerblue;
}
</style>
</head>
<body onload="noBack();">
	<!-- w3-banner -->
	<div class="w3-banner jarallax">
		<div class="wthree-different-dot">
			<div class="w3layouts-header-top">
				<div class="container">
				<div class="row">
				<div class="col-sm-5">
					<div class="w3-header-top-grids">
						<div class="w3-header-top-left">
							<p><i class="fa fa-volume-control-phone" aria-hidden="true"></i> +918052222335</p>
						</div>
						
						<div class="clearfix"> </div>
					</div>
				</div>
				<form  method="post">
				<div class="col-sm-3">
				<div class="input-con">
    <i class="fa fa-envelope icon"></i>
				<input type="email" name="email" required placeholder="Enter Your Email" class="input-field">
				</div>
				</div>
				<div class="col-sm-4">
				<div class="input-con">
    <i class="fa fa-lock icon"></i>
				<input type="password"  name="loginpass" required placeholder="Enter Your Password" class="input-field">
								<button type="submit"  name="login" class="btnlogin">Login</button>
								<p style="color:red;"><?php echo $msg;?></p>
								</form>
								</div>
								<a style="color:white;cursor:pointer;" data-toggle="collapse" data-target="#forgotpassword">Forgot Password!</a>
								
								<div id="forgotpassword" class="collapse">
								<label style="color:white;">we will send a link for password reset.please enter you email address</label>
			<input type="email" id="forgotemail" name="forgotemail" placeholder="Enter Your Email" class="input-field">
										<button type="button"  onclick="forgotpass()" class="btnlogin">Send</button>

		</div>
								</div>
								
								
								
				</div>
			</div>
			</div>
			
			<div class="head">
				<div class="container">
					<div class="navbar-top">
							<!-- Brand and toggle get grouped for better mobile display -->
							<div class="navbar-header">
							  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							  </button>
								 <div class="navbar-brand logo ">
									<h1><a href="index.html"><span>A</span>ryavratt</a></h1>
								</div>

							</div>

							<!-- Collect the nav links, forms, and other content for toggling -->
							<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
							 <ul class="nav navbar-nav link-effect-4">
								<li class="active first-list"><a href="index.html">Home</a></li>
								<li><a href="#about" class="scroll">About</a></li>
								<li><a href="#joinus" class="scroll">joinus</a></li>
								<li><a href="#contact" class="scroll">Contact</a></li>
							  </ul>
							</div><!-- /.navbar-collapse -->
						</div>
				</div>
			</div>
			<!-- banner -->
			<div class="banner">
				<div class="container">
					<div class="slider">
						<div class="w3ls-icon"><i class="fa fa-user" aria-hidden="true"></i></div>
						<div class="border"></div>
						<script src="js/responsiveslides.min.js"></script>
						<script>
								// You can also use "$(window).load(function() {"
								$(function () {
								// Slideshow 4
									$("#slider3").responsiveSlides({
										auto: true,
										pager: true,
										nav: true,
										speed: 500,
										namespace: "callbacks",
										before: function () {
											$('.events').append("<li>before event fired.</li>");
										},
										after: function () {
											$('.events').append("<li>after event fired.</li>");
										}
									 });				
								});
						</script>
						<div  id="top" class="callbacks_container-wrap">
							<ul class="rslides" id="slider3">
								<li>
									<div class="slider-info">
										<h3>Share your moments</h3>
										<p ></p>
										<div class="more-button">
											<a href="#" data-toggle="modal" data-target="#myModal">Read More</a>
										</div>
									</div>
								</li>
								<li>
									<div class="slider-info">
										<h3>Share Your Ideas</h3>
										<p></p>
										<div class="more-button">
											<a href="#" data-toggle="modal" data-target="#myModal">Read More</a>
										</div>
									</div>
								</li>
								<li>
									<div class="slider-info">
										<h3>Meet new experiences</h3>
										<p></p>
										<div class="more-button">
											<a href="#" data-toggle="modal" data-target="#myModal">Read More</a>
										</div>
									</div>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<!-- //banner -->
		</div>
	</div>
	<!-- //w3-banner -->
	<!-- modal -->
	<div class="modal about-modal fade" id="myModal" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header"> 
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>						
						<h4 class="modal-title"><span>A</span>ryavratt</h4>
					</div> 
					<div class="modal-body">
					<div class="agileits-w3layouts-info">
						<img src="images/aryavratt.png" style="height:250px;" alt="" />
						<p>Aryavratt originated in Lucknow By a student of IET Lucknow with a vision to help the emerging talents grow and gain recognition that they deserve.
						This site provides a number of distinctive features that aim at reducing the communication barrier that hinders the talent to express.
						This site will open the world of possibilities for all such talented and creative people to showcase their ideas and also the ones looking for such ideas.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- //modal -->
	
	<!-- introduction -->
	<div class="introduction" id="indro">
		<div class="container">
			<div class="w3l-heading">
				<h2>Introduction</h2>
				<div class="w3ls-border"> </div>
			</div>
			<div class="introduction-info">
				<p>Aryavratt originated in Lucknow By a student of IET Lucknow with a vision to help the emerging talents grow and gain recognition that they deserve.
						This site provides a number of distinctive features that aim at reducing the communication barrier that hinders the talent to express.
						This site will open the world of possibilities for all such talented and creative people to showcase their ideas and also the ones looking for such ideas.</p>
			</div>
		</div>
	</div>
	<!-- //introduction -->
	<!-- about -->
	<div class="about" id="about">
		<div class="container">
			<div class="w3l-heading about-heading">
				<h3>About Us</h3>
				<div class="w3ls-border about-border"> </div>
			</div>
			<div class="agileits-about-grids">
				<div class="about-grids">
					<div class="col-md-6 about-grid">
						<div class="col-xs-3 about-grid-left">
							<span class="glyphicon glyphicon-camera effect-1" aria-hidden="true"></span>
						</div>
						<div class="col-xs-9 about-grid-right">
							<h4>Share Your moments</h4>
							<p>Share Your happiest moments with your close ones.</p>
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="col-md-6 about-grid">
						<div class="col-xs-3 about-grid-left">
							<span class="fa fa-graduation-cap effect-1" aria-hidden="true"></span>
						</div>
						<div class="col-xs-9 about-grid-right">
							<h4>Share Your Ideas</h4>
							<p>Share your projects/reports with the best of the worlds.</p>
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="clearfix"> </div>
				</div>
				<div class="about-grids1">
					<div class="col-md-6 about-grid">
						<div class="col-xs-3 about-grid-left">
							<span class="glyphicon glyphicon-user effect-1" aria-hidden="true"></span>
						</div>
						<div class="col-xs-9 about-grid-right">
							<h4>Meet With New People</h4>
							<p>Meet with the people of your area of interest.</p>
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="col-md-6 about-grid">
						<div class="col-xs-3 about-grid-left">
							<span class="glyphicon glyphicon-bed effect-1" aria-hidden="true"></span>
						</div>
						<div class="col-xs-9 about-grid-right">
							<h4>Earn By Your Upload</h4>
							<p>Make your project/reports in the trending and earn for that.</p>
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="clearfix"> </div>
				</div>
			</div>
		</div>
	</div>
	<!-- //about -->
	
	<!-- gallery -->
	<div class="gallery" id="joinus">
		<div class="container">
			<div class="w3l-heading">
				<h3>JOIN US</h3>
				<div class="w3ls-border"> </div>
			</div>
			</br>
			
			<div class="row">
			<div class="col-sm-3">
			<label>FIRSTNAME</label>
			<div class="input-con">
    <i class="fa fa-child icon"></i>
			<input type="text" id="firstname" class="input-field" placeholder="Your Firstname">
			</div>
			</div>
			<div class="col-sm-3">
			<label>LASTNAME</label>
			<div class="input-con">
    <i class="fa fa-child icon"></i>
			<input type="text" id="lastname" class="input-field" placeholder="Your Lastname">
			</div>
			</div>
			<div class="col-sm-2">
			<label>AGE</label>
			<div class="input-con">
    <i class="fa fa-map-pin icon"></i>
			<input type="text" id="age" class="input-field" placeholder="Your Current Age">
			</div>
			</div>
			<div class="col-sm-4">
			<label>GENDER</label></br>
  <input type="radio" name="gender" id="male" value="male" checked><label>Male</label>
  <input type="radio" name="gender" id="female" value="female"><label>Female</label>
  </div>
			</div>
			<div class="row">
			<div class="col-sm-3">
			<label>CITY</label>
			<div class="input-con">
    <i class="fa fa-university icon"></i>
			<input type="text" id="city" class="input-field" placeholder="Your City">
			</div>
			</div>
			<div class="col-sm-3">
			<label>COUNTRY</label>
			<div class="input-con">
    <i class="fa fa-globe icon"></i>
			<input type="text" id="country" class="input-field" placeholder="Your Country">
			</div>
			</div>
			<div class="col-sm-3">
			
			<label>EMAIL</label>
			 <div class="input-con">
    <i class="fa fa-envelope icon"></i>
			<input type="text" id="signemail" name="signemail" class="input-field" placeholder="Your Email">
			</div>
			</div>
			</div>
			<div class="row">
			<div class="col-sm-3">
			
			</div>
			<div class="col-sm-3">
			<label>PASSWORD</label>
			 <div class="input-con">
    <i class="fa fa-key icon"></i>
			<input type="password" id="password" class="input-field" >
			</div>
			</div>
			<div class="col-sm-3">
			<label>Confirm Password</label>
			 <div class="input-con">
    <i class="fa fa-lock icon"></i>
			<input type="password" id="cpassword" class="input-field" >
			</div>
			</div>
			</div>
			</br>
			<div class="row">
			<div class="col-sm-3">
			</div>
			<div class="col-sm-3">
			</div>
			
			<div class="col-sm-3">
			<button type="button" onclick="signup();" class="btnsignup"><i class="fa fa-sign-in"></i>&nbspSIGNUP</button>
			</div>
			</div>
		</div>
		<!--<div class="gallery-grids">
				<div class="gallery-top-grids">
					<div class="col-sm-3 gallery-grids-left">
						<div class="gallery-grid">
							<a class="example-image-link" href="images/g1.jpg" data-lightbox="example-set" data-title="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vitae cursus ligula">
								<img src="images/g1.jpg" alt="" />
								<div class="captn">
									<h4>Capturing</h4>
									<p>Aliquam non</p>
								</div>
							</a>
						</div>
					</div>
					<div class="col-sm-3 gallery-grids-left">
						<div class="gallery-grid">
							<a class="example-image-link" href="images/g2.jpg" data-lightbox="example-set" data-title="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vitae cursus ligula">
								<img src="images/g2.jpg" alt="" />
								<div class="captn">
									<h4>Capturing</h4>
									<p>Aliquam non</p>
								</div>
							</a>
						</div>
					</div>
					<div class="col-sm-3 gallery-grids-left">
						<div class="gallery-grid">
							<a class="example-image-link" href="images/g3.jpg" data-lightbox="example-set" data-title="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vitae cursus ligula">
								<img src="images/g3.jpg" alt="" />
								<div class="captn">
									<h4>Capturing</h4>
									<p>Aliquam non</p>
								</div>
							</a>
						</div>
					</div>
					<div class="col-sm-3 gallery-grids-left">
						<div class="gallery-grid">
							<a class="example-image-link" href="images/g4.jpg" data-lightbox="example-set" data-title="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vitae cursus ligula">
								<img src="images/g4.jpg" alt="" />
								<div class="captn">
									<h4>Capturing</h4>
									<p>Aliquam non</p>
								</div>
							</a>
						</div>
					</div>
					<div class="clearfix"> </div>
				</div>
				<div class="gallery-top-grids">
					<div class="col-sm-3 gallery-grids-left">
						<div class="gallery-grid">
							<a class="example-image-link" href="images/g5.jpg" data-lightbox="example-set" data-title="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vitae cursus ligula">
								<img src="images/g5.jpg" alt="" />
								<div class="captn">
									<h4>Capturing</h4>
									<p>Aliquam non</p>
								</div>
							</a>
						</div>
					</div>
					<div class="col-sm-3 gallery-grids-left">
						<div class="gallery-grid">
							<a class="example-image-link" href="images/g6.jpg" data-lightbox="example-set" data-title="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vitae cursus ligula">
								<img src="images/g6.jpg" alt="" />
								<div class="captn">
									<h4>Capturing</h4>
									<p>Aliquam non</p>
								</div>
							</a>
						</div>
					</div>
					<div class="col-sm-3 gallery-grids-left">
						<div class="gallery-grid">
							<a class="example-image-link" href="images/g1.jpg" data-lightbox="example-set" data-title="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vitae cursus ligula">
								<img src="images/g1.jpg" alt="" />
								<div class="captn">
									<h4>Capturing</h4>
									<p>Aliquam non</p>
								</div>
							</a>
						</div>
					</div>
					<div class="col-sm-3 gallery-grids-left">
						<div class="gallery-grid">
							<a class="example-image-link" href="images/g2.jpg" data-lightbox="example-set" data-title="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vitae cursus ligula">
								<img src="images/g2.jpg" alt="" />
								<div class="captn">
									<h4>Capturing</h4>
									<p>Aliquam non</p>
								</div>
							</a>
						</div>
					</div>
					<div class="clearfix"> </div>
				</div>
				<div class="gallery-top-grids">
					<div class="col-sm-3 gallery-grids-left">
						<div class="gallery-grid">
							<a class="example-image-link" href="images/g3.jpg" data-lightbox="example-set" data-title="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vitae cursus ligula">
								<img src="images/g3.jpg" alt="" />
								<div class="captn">
									<h4>Capturing</h4>
									<p>Aliquam non</p>
								</div>
							</a>
						</div>
					</div>
					<div class="col-sm-3 gallery-grids-left">
						<div class="gallery-grid">
							<a class="example-image-link" href="images/g4.jpg" data-lightbox="example-set" data-title="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vitae cursus ligula">
								<img src="images/g4.jpg" alt="" />
								<div class="captn">
									<h4>Capturing</h4>
									<p>Aliquam non</p>
								</div>
							</a>
						</div>
					</div>
					<div class="col-sm-3 gallery-grids-left">
						<div class="gallery-grid">
							<a class="example-image-link" href="images/g5.jpg" data-lightbox="example-set" data-title="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vitae cursus ligula">
								<img src="images/g5.jpg" alt="" />
								<div class="captn">
									<h4>Capturing</h4>
									<p>Aliquam non</p>
								</div>
							</a>
						</div>
					</div>
					<div class="col-sm-3 gallery-grids-left">
						<div class="gallery-grid">
							<a class="example-image-link" href="images/g6.jpg" data-lightbox="example-set" data-title="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vitae cursus ligula">
								<img src="images/g6.jpg" alt="" />
								<div class="captn">
									<h4>Capturing</h4>
									<p>Aliquam non</p>
								</div>
							</a>
						</div>
					</div>
					<div class="clearfix"> </div>
				</div>
				<div class="clearfix"> </div>
				<script src="js/lightbox-plus-jquery.min.js"> </script>
		</div>-->
	</div>
	<!-- //gallery -->
	
	<!-- subscribe -->
	<!--<div class="subscribe">
		<div class="container">
			<div class="w3l-heading">
				<h3>Subscribe</h3>
				<div class="w3ls-border"> </div>
			</div>
			<div class="w3-agileits-subscribe-form">
				<form action="#" method="post">
					<input type="email" placeholder="Email" name="Subscribe" required="">
					<button class="btn1">Subscribe</button>
				</form>
			</div>
		</div>
	</div>-->
	<!-- //subscribe -->
	<!-- contact -->
	<div id="contact" class="contact">
		<div class="container"> 
			<div class="w3l-heading">
				<h3>Contact</h3>
				<div class="w3ls-border"> </div>
			</div>
			<div class="contact-row agileits-w3layouts">  
				<div class="col-md-6 col-sm-6 contact-w3lsleft">
					<div class="contact-grid agileits">
						<h4>DROP US A LINE </h4>
						<form action="home.php" method="post"> 
							<input  type="text" name="DName" placeholder="Name" required="">
							<input  type="email" name="DEmail" placeholder="Email" required=""> 
							<input  type="text" name="DPhone" placeholder="Phone Number" required="">
							<textarea  name="DMessage" placeholder="Message..." required=""></textarea>
							<input type="submit" name="D" value="Submit" >
						</form> 
					</div>
				</div>
				<div class="col-md-6 col-sm-6 contact-w3lsright">
					<h6>In case Of Any Query And Information.</h6>
					<div class="address-row">
						<div class="col-xs-2 address-left">
							<span class="glyphicon glyphicon-home" aria-hidden="true"></span>
						</div>
						<!--<div class="col-xs-10 address-right">
							<h5>Visit Us</h5>
							<p>Bmr St, Canada, New York, USA</p>
						</div>-->
						<div class="clearfix"> </div>
					</div>
					<div class="address-row w3-agileits">
						<div class="col-xs-2 address-left">
							<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
						</div>
						<div class="col-xs-10 address-right">
							<h5>Mail Us</h5>
							<p><a href="mailto:dhakrey@aryavratt.com">dhakrey@aryavratt.com</a></p>
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="address-row">
						<div class="col-xs-2 address-left">
							<span class="glyphicon glyphicon-phone" aria-hidden="true"></span>
						</div>
						<div class="col-xs-10 address-right">
							<h5>Call Us</h5>
							<p>+918052222335</p>
						</div>
						<div class="clearfix"> </div>
					</div>  
					<!-- map -->
					<!--<div class="map agileits">
						<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3023.948805392833!2d-73.99619098458929!3d40.71914347933105!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25a27e2f24131%3A0x64ffc98d24069f02!2sCANADA!5e0!3m2!1sen!2sin!4v1479793484055"></iframe>
					</div>
					<!-- //map -->
				</div>
				<div class="clearfix"> </div>
			</div>	
		</div>	
	</div>
	<!-- //contact --> 
	<!-- footer -->
	<footer>
		
		<div class="copyright">
			<div class="container">
				<p>© 2018 Aryavratt. All rights reserved | Design by <a href="www.facebook.com/adhakare">Aditya Vikram Singh</a></p>
			</div>
		</div>
	</footer>
	<!-- //footer -->
	<script src="js/jarallax.js"></script>
	<script src="js/SmoothScroll.min.js"></script>
	<script type="text/javascript">
		/* init Jarallax */
		$('.jarallax').jarallax({
			speed: 0.5,
			imgWidth: 1366,
			imgHeight: 768
		})
	</script>
	<script src="js/responsiveslides.min.js"></script>
	<script type="text/javascript" src="js/easing.js"></script>
	<script type="text/javascript" src="js/move-top.js"></script>
	<!-- here stars scrolling icon -->
	<script type="text/javascript">
		$(document).ready(function() {
			/*
				var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
				};
			*/
								
			$().UItoTop({ easingType: 'easeOutQuart' });
								
			});
	</script>
	<!-- //here ends scrolling icon -->
</body>	
</html>