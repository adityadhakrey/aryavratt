<?php
include("connection.php");
$em=$_COOKIE["Email"];
if(!isset($_COOKIE["Email"]))
{
header("location:index.php");
}
$search=$_REQUEST["search"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="icon" type="images/png" href="images/aryavratt.png">
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
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<![endif]-->


<script type="text/javascript">
function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";

}
function defaultopen()
{
	document.getElementById("defaultOpen").click();
}
	
/*--function for notification calling--*/

/*--function for notification calling--*/
</script>
<script type="text/javascript">
/*==notification dialog--*/
$(document).ready( function() {
  
 $('.add').click(function(e){
   e.stopPropagation();
  if ($(this).hasClass('active')){
    $('.dialog').fadeOut(200);
    $(this).removeClass('active');
  } else {
    $('.dialog').delay(300).fadeIn(200);
    $(this).addClass('active');
  }
});
$('.radio > .button').click( function() {
  $('.radio').find('.button.active').removeClass('active');
  $(this).addClass('active');
});
  
function closeMenu(){
  $('.dialog').fadeOut(200);
  $('.add').removeClass('active');  
}
  
$(document.body).click( function(e) {
     closeMenu();
});

$(".dialog").click( function(e) {
    e.stopPropagation();
});
});
/*--function for request seen--*/
function request()
{
	var t=Math.random();
	var r=new XMLHttpRequest();
	r.onreadystatechange=function()
	{
		if(r.readyState==4)
		{
			document.getElementById("showrequest").innerHTML=r.responseText;
			onlay();
		}
	}
	r.open("get","showrequest.php?s="+t);
	r.send();
}
function onlay() {
    document.getElementById("requestlay").style.height = "100%";
}

function offlay() {
    document.getElementById("requestlay").style.height = "0%";
}

function acceptrlay(email)
{
	var t=Math.random();
	var r=new XMLHttpRequest();
	r.onreadystatechange=function()
	{
		if(r.readyState==4)
		{
			alert(r.responseText);
			request();
		}
	}
	r.open("get","accept.php?s="+t+"&email="+email);
	r.send();
}

function declinerlay(email)
{
	var t=Math.random();
	var r=new XMLHttpRequest();
	r.onreadystatechange=function()
	{
		if(r.readyState==4)
		{
			alert(r.responseText);
			request();
		}
	}
	r.open("get","decline.php?s="+t+"&email="+email);
	r.send();
}
/*---search function--*/
function search()
{

	var text=document.getElementById("search").value;
	var t=Math.random()
	var r=new XMLHttpRequest();
	if(text=="")
	{
		alert("search box is empty");
		document.getElementById("search").focus();
		return false;
	}
	else if(document.getElementById("people").checked)
	{
	r.onreadystatechange=function()
	{
		if(r.readyState==4)
		{
			
			document.getElementById("showsearch").innerHTML=r.responseText;
		    opensearch();
			
		}
	}
	r.open("get","searchpeople.php?s="+t+"&search="+text);
	r.send();
}
else if(document.getElementById("project").checked)
{
	location.replace("project.php");
}
}
function opensearch() {
    document.getElementById("searchlay").style.height = "100%";
}

function closesearchlay() {
    document.getElementById("searchlay").style.height = "0%";
}

function sendrequest(email)
{
	var t=Math.random();
	var r=new XMLHttpRequest();
	r.onreadystatechange=function()
	{
		if(r.readyState==4)
		{
			alert(r.responseText);
			search();
		}
	}
	r.open("get","sendrequest.php?s="+t+"&email="+email);
	r.send();
}
function cancelrequest(email)
{
	var t=Math.random();
	var r=new XMLHttpRequest();
	r.onreadystatechange=function()
	{
		if(r.readyState==4)
		{
			alert(r.responseText);
			search();
		}
	}
	r.open("get","cancelrequest.php?s="+t+"&email="+email);
	r.send();
}
function unfriend(email)
{
	var t=Math.random();
	var r=new XMLHttpRequest();
	r.onreadystatechange=function()
	{
		if(r.readyState==4)
		{
			alert(r.responseText);
			search();
		}
	}
	r.open("get","unfriend.php?s="+t+"&email="+email);
	r.send();
}
function acceptsearch(email)
{
	var t=Math.random();
	var r=new XMLHttpRequest();
	r.onreadystatechange=function()
	{
		if(r.readyState==4)
		{
			alert(r.responseText);
			search();
		}
	}
	r.open("get","accept.php?s="+t+"&email="+email);
	r.send();
}
function declinesearch(email)
{
	var t=Math.random();
	var r=new XMLHttpRequest();
	r.onreadystatechange=function()
	{
		if(r.readyState==4)
		{
			alert(r.responseText);
			search();
		}
	}
	r.open("get","decline.php?s="+t+"&email="+email);
	r.send();
}
function change(nid)
{
	var t=Math.random();
	var r=new XMLHttpRequest();
	r.onreadystatechange=function()
	{
		if(r.readyState==4)
		{
			//alert(r.responseText);
		}
	}
	r.open("get","change.php?s="+t+"&nid="+nid);
	r.send();
	}
/*--function for search by check box end--*/
/*===function for update time==*/
function updatetime()
{
	var t=Math.random();
	var r=new XMLHttpRequest();
	r.onreadystatechange=function()
	{
		if(r.readyState==4)
		{
			//alert(r.responseText);
		}
	}
	r.open("get","updatetime.php?s="+t);
	r.send();
}
setInterval("updatetime()",1000);

/*==function msgrealt()
{
	//alert("aditya");
	document.getElementById("msgrealt").innerHTML=r.responseText;
}
setInterval("msgrealt()",1000);

function realnoti()
{
	//alert("aditya singh");
    document.getElementById("realnoti").innerHTML=r.responseText;
	}
setInterval("realnoti()",1000);

function realrqst()
{
	//alert("500");
	document.getElementById("realrqst").innerHTML=r.responseText;
	
}
setInterval("realrqst()",1000);==*/
/*function for update time end==*/
/*--ai function--*/
var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo");
  var captionText = document.getElementById("caption");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
  captionText.innerHTML = dots[slideIndex-1].alt;
}

/*==search projects==*/

function trclosescmnt(i)
{
document.getElementById("trsscopen"+i).style.display="none";
document.getElementById("trclscmnt"+i).style.display="none";
document.getElementById("trsm"+i).style.display="block";
	 
}
 
function trsscmnt(i,prid,se)
{

document.getElementById("trsscopen"+i).style.display="block";
document.getElementById("trclscmnt"+i).style.display="block";
document.getElementById("trsm"+i).style.display="none";

showtrc(i,prid,se);

}
function showtrc(i,prid,se)
{

	var t=Math.random();
	var r=new XMLHttpRequest();
	r.onreadystatechange=function()
	{
		if(r.readyState==4)
		{
			document.getElementById("trssc"+i).innerHTML=r.responseText;
		//alert(r.responseText);
		}
	}
	r.open("get","trcmnt.php?s="+t+"&i="+i+"&prid="+prid+"&search="+se);
	r.send();

}



function tropence(i)
{

	document.getElementById("trcomedit"+i).style.display="block";

	}
	
function trcomdit(cid,i,se)
{
	var txts=document.getElementById("trcs"+i).value;
	var t=Math.random();
	var r=new XMLHttpRequest();
	if(txts=="")
	{
		alert("box is empty");
		document.getElementById("trcs"+i).focus();
	}
	else
	{
	r.onreadystatechange=function()
	{
		if(r.readyState==4)
		{
			alert(r.responseText);
			showprojects(se);
		}
	}
	r.open("get","tpcommentedit.php?s="+t+"&cid="+cid+"&text="+txts);
	r.send();
}
}
function trclosece(i)
{
	document.getElementById("trcomedit"+i).style.display="none";
}




var prscroll=0;
function prscrl()
{
prscroll=document.getElementById("prscr").scrollTop;
}
function showprojects(se)
{
	//var s=document.getElementById("s").value;	
	var t=Math.random();
	var r=new XMLHttpRequest();
	r.onreadystatechange=function()
	{
		if(r.readyState==4)
		{
			document.getElementById("showpr").innerHTML=r.responseText;
			document.getElementById("prscr").scrollTop=prscroll;
		}
	}
	r.open("get","pr.php?s="+t+"&search="+se);
	r.send();
}

function spprojectlike(id,email,se)
{
	
	var t=Math.random();
	var r=new XMLHttpRequest();
	r.onreadystatechange=function()
	{
		if(r.readyState==4)
		{
			alert(r.responseText);
			showprojects(se);
		}
	}
	r.open("get","projectlike.php?s="+t+"&sid="+id+"&email="+email);
	r.send();
}
function spprojectdislike(id)
{
	
	var t=Math.random();
	var r=new XMLHttpRequest();
	r.onreadystatechange=function()
	{
		if(r.readyState==4)
		{
			alert(r.responseText);
			showprojects(se);
		}
	}
	r.open("get","projectdislike.php?s="+t+"&sid="+id);
	r.send();
}
function sppostprojectcomment(sid,i,email,se)
{
	var text=document.getElementById("sprojectcomment"+i).value;
	var t=Math.random();
	var r=new XMLHttpRequest();
	if(text=="")
	{
		document.getElementById("sprojectcomment"+i).focus();
	}
	else
	{
	r.onreadystatechange=function()
	{
		if(r.readyState==4)
		{
			alert(r.responseText);
			showprojects(se);
		}
	}
	r.open("get","projectcomment.php?s="+t+"&sid="+sid+"&comment="+text+"&email="+email);
	r.send();
}
}
function spshowprojectcomment(i,sid)
{

	var t=Math.random();
	var r=new XMLHttpRequest();
	r.onreadystatechange=function()
	{
		if(r.readyState==4)
		{
			document.getElementById("tpshowprojectcomment"+i).innerHTML=r.responseText;
		}
	}
	r.open("get","tpshowprojectcomment.php?s="+t+"&i="+i+"&sid="+sid);
	r.send();
	
	
}
function spdeleteprojectcomment(i,cid,se)
{
	
	var t=Math.random();
	var r=new XMLHttpRequest();
	r.onreadystatechange=function()
	{
		if(r.readyState==4)
		{
			alert(r.responseText);
			showprojects(se);
		}
	}
	r.open("get","deleteprojectcomment.php?s="+t+"&commentid="+cid);
	r.send();
}
function book(prid,email,se)
{
	var t=Math.random();
	var r=new XMLHttpRequest();
	r.onreadystatechange=function()
	{
		if(r.readyState==4)
		{
			alert(r.responseText);
			showproject(se);
		}
	}
	r.open("get","book.php?s="+t+"&prid="+prid+"&email="+email);
	r.send();
}
/*search projects end==*/


/*==trending projeccts==*/


function tpclosescmnt(i)
{
document.getElementById("tpsscopen"+i).style.display="none";
document.getElementById("tpclscmnt"+i).style.display="none";
document.getElementById("tpsm"+i).style.display="block";
	 
}
 
function tpsscmnt(i,prid,sid)
{

document.getElementById("tpsscopen"+i).style.display="block";
document.getElementById("tpclscmnt"+i).style.display="block";
document.getElementById("tpsm"+i).style.display="none";

showtpc(i,prid);

}
function showtpc(i,prid)
{

	var t=Math.random();
	var r=new XMLHttpRequest();
	r.onreadystatechange=function()
	{
		if(r.readyState==4)
		{
			document.getElementById("tpssc"+i).innerHTML=r.responseText;
		//alert(r.responseText);
		}
	}
	r.open("get","tpcmnt.php?s="+t+"&i="+i+"&prid="+prid);
	r.send();

}



function tpopence(i)
{

	document.getElementById("tpcomedit"+i).style.display="block";

	}
	
function tpcomdit(cid,i)
{
	var txts=document.getElementById("tpcs"+i).value;
	var t=Math.random();
	var r=new XMLHttpRequest();
	if(txts=="")
	{
		alert("box is empty");
		document.getElementById("tpcs"+i).focus();
	}
	else
	{
	r.onreadystatechange=function()
	{
		if(r.readyState==4)
		{
			alert(r.responseText);
			tp();
		}
	}
	r.open("get","tpcommentedit.php?s="+t+"&cid="+cid+"&text="+txts);
	r.send();
}
}
function tpclosece(i)
{
	document.getElementById("tpcomedit"+i).style.display="none";
}
function tp()
{
	var t=Math.random();
	var r=new XMLHttpRequest();
	r.onreadystatechange=function()
	{
		if(r.readyState==4)
		{
			document.getElementById("trendingprojects").innerHTML=r.responseText;
		}
	}
	r.open("get","tr.php?s="+t);
	r.send();
}
function tpprojectlike(id,email)
{
	
	var t=Math.random();
	var r=new XMLHttpRequest();
	r.onreadystatechange=function()
	{
		if(r.readyState==4)
		{
			alert(r.responseText);
			tp();
		}
	}
	r.open("get","projectlike.php?s="+t+"&sid="+id+"&email="+email);
	r.send();
}
function tpprojectdislike(id)
{
	
	var t=Math.random();
	var r=new XMLHttpRequest();
	r.onreadystatechange=function()
	{
		if(r.readyState==4)
		{
			alert(r.responseText);
			tp();
		}
	}
	r.open("get","projectdislike.php?s="+t+"&sid="+id);
	r.send();
}
function tppostprojectcomment(sid,i,email)
{
	
	var text=document.getElementById("projectcomment"+i).value;
	var t=Math.random();
	var r=new XMLHttpRequest();
	if(text=="")
	{
		document.getElementById("projectcomment"+i).focus();
	}
	else
	{
	r.onreadystatechange=function()
	{
		if(r.readyState==4)
		{
			alert(r.responseText);
			tp();
		}
	}
	r.open("get","projectcomment.php?s="+t+"&sid="+sid+"&comment="+text+"&email="+email);
	r.send();
}
}
function tpshowprojectcomment(i,sid)
{

	var t=Math.random();
	var r=new XMLHttpRequest();
	r.onreadystatechange=function()
	{
		if(r.readyState==4)
		{
			document.getElementById("tpshowprojectcomment"+i).innerHTML=r.responseText;
		}
	}
	r.open("get","tpshowprojectcomment.php?s="+t+"&i="+i+"&sid="+sid);
	r.send();
	}
	function book(prid,email)
{
	var t=Math.random();
	var r=new XMLHttpRequest();
	r.onreadystatechange=function()
	{
		if(r.readyState==4)
		{
			alert(r.responseText);
			userprojectshow();
		}
	}
	r.open("get","book.php?s="+t+"&prid="+prid+"&email="+email);
	r.send();
}
function tpdeleteprojectcomment(i,cid)
{
	
	var t=Math.random();
	var r=new XMLHttpRequest();
	r.onreadystatechange=function()
	{
		if(r.readyState==4)
		{
			alert(r.responseText);
			tp();
		}
	}
	r.open("get","deleteprojectcomment.php?s="+t+"&commentid="+cid);
	r.send();
}
function sendmessage(em1)
{

	var t=Math.random();
	var msg=document.getElementById("aimsg").value;
	if(msg=="")
	{
		document.getElementById("aimsg").focus();
	}
	else
	{
	var r=new XMLHttpRequest();
	
	r.onreadystatechange=function()
	{
		if(r.readyState==4)
		{
			alert(r.responseText);
           document.getElementById("aimsg").value="";
			}
	}
	r.open("get","sendmessage.php?s="+t+"&msg="+msg+"&email="+em1);
	r.send();
	}
	
}
function downloadproject(pid)
{
	var t=Math.random();
	var r=new XMLHttpRequest();
	r.onreadystatechange=function()
	{
		if(r.readyState==4)
		{
			alert(r.responseText);
		}
	}
	r.open("get","downloadpro.php?s="+t+"&prid="+pid);
	r.send();
}
/*trending projects end==*/
function usermsg(em1,i)
{

	var t=Math.random();
	var msg=document.getElementById("usrmsg"+i).value;
	if(msg=="")
	{
		document.getElementById("usrmsg"+i).focus();
	}
	else
	{
	var r=new XMLHttpRequest();
	
	r.onreadystatechange=function()
	{
		if(r.readyState==4)
		{
			alert(r.responseText);
           document.getElementById("usrmsg"+i).value="";
			}
	}
	r.open("get","sendmessage.php?s="+t+"&msg="+msg+"&email="+em1);
	r.send();
	}
	
}
function usermsgpr(em1,i)
{

	var t=Math.random();
	var msg=document.getElementById("usrmsgpr"+i).value;
	if(msg=="")
	{
		document.getElementById("usrmsgpr"+i).focus();
	}
	else
	{
	var r=new XMLHttpRequest();
	
	r.onreadystatechange=function()
	{
		if(r.readyState==4)
		{
			alert(r.responseText);
           document.getElementById("usrmsgpr"+i).value="";
			}
	}
	r.open("get","sendmessage.php?s="+t+"&msg="+msg+"&email="+em1);
	r.send();
	}
	
}
</script>
<style>
/*--ai function end--*/
/*====css for request==*/
.overlayr {
    height: 0%;
    width: 100%;
    position: fixed;
    z-index: 1;
    top: 0;
    left: 0;
   background:url("images/map.jpg");
    overflow-y: auto;
    transition: 0.6s;
}

.overlayr-content {
    position: relative;
    top: 50%;
    width: 100%;
    text-align: center;
    margin-top: 20%;
	color:white;
}

.overlayr a {
    padding: 8px;
    text-decoration: none;
    font-size: 16px;
    color: white;
    display: block;
    transition: 0.3s;
}

.overlayr a:hover, .overlayr a:focus {
    color: orange;
}

.overlayr .closebtn {
    position: absolute;
    top: 20px;
    right: 45px;
    font-size: 60px;
}

@media screen and (max-height: 450px) {
  .overlayr {overflow-y: auto;}
  .overlayr a {font-size: 20px}
  .overlayr .closebtn {
    font-size: 40px;
    top: 15px;
    right: 35px;
  }
}
/*==css for request end==*/
/*==css for scrollbar==*/
/* width */
::-webkit-scrollbar {
    width: 5px;
    background:white;
}

/* Track */
::-webkit-scrollbar-track {
    box-shadow: inset 0 0 5px grey; 
    border-radius: 10px;
   
}
 
/* Handle */
::-webkit-scrollbar-thumb {
    background: dodgerblue; 
    border-radius: 8px;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
    background: dodgerblue; 
}
/*==css for scroll bar ends==*/
/*==css for upload picture==*/
.galler-grid img {
 max-height: auto;
  width: 80%;
    cursor: pointer;
	margin-left: auto;
    margin-right: auto;
	 display: block;
}
/*==css for upload pic end==*/
/*=====dialogfor notification==*/

.dialog {
  position: absolute;
  text-align: center;
  background-color:white;
  width: 40%;
  left:5%;
  top:80px;
  z-index:1;
  height:400px;
  overflow-x:hidden;
  overflow-y:auto;
  }
.dialog:after,
.dialog:before {
  bottom: 100%;
  border: solid transparent;
  content: " ";
  height: 0;
  width: 0;
  position: absolute;
  pointer-events: none;
}
.dialog:after {
  border-color: rgba(255, 255, 255, 0);
  border-bottom-color: dodgerblue;
  border-width: 15px;
  left: 90%;
  margin-left: -15px;
}
.dialog:before {
  border-color: rgba(170, 170, 170, 0);
  border-width: 16px;
  left: 90%;
  margin-left: -16px;
}
.dialog .title {
  color: #fff;
  left:5%;
  font-weight: bold;
  text-align: center;
  border: 1px solid #5189B5;
  border-width: 0px 0px 1px 0px;
  margin-left: 0;
  margin-right: 0;
  margin-bottom: 4px;
  margin-top: 8px;
  padding: 8px 16px;
  background: white;
  color:black;
  font-size: 16px;
  line-height:2em;
}
.dialog .title:first-child {
  margin-top: -4px;
}
@media only screen and (max-width: 600px )
{
.dialog
{
width:100%;
left:0px;
top:0px;
}
}
/*====dialog for notification ends==*/
.w3-bann{
	background: url("images/friend.jpg") no-repeat 0px 0px;
    background-size: cover;
height:200px;
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
/*--btnsignup start--*/
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
/*--btnsignup end--*/
/*--button post css---*/
button.btnpost {
    color: white;
    font-size: .9em;
	border-radius:10px;
	border:solid 2px black;
    padding: 1em 1em;
    text-align: center;
    text-decoration: none;
    background: green;
    border: solid 2px #03a9f4;
    transition: 0.5s all;
    -webkit-transition: 0.5s all;
    -moz-transition: 0.5s all;
    -o-transition: 0.5s all;
    -ms-transition: 0.5s all;
}
button.btnpost:hover {
    background: green;
	color:white;
	border: solid 2px blue;
}
/*-- button post end--*/
/*button accept css--*/
button.btnaccept {
    color: black;
    font-size: .9em;
	border-radius:10px;
	border:solid 2px black;
    padding: 1em 1em;
    text-align: center;
    text-decoration: none;
    background: white;
    transition: 0.5s all;
    -webkit-transition: 0.5s all;
    -moz-transition: 0.5s all;
    -o-transition: 0.5s all;
    -ms-transition: 0.5s all;
}
button.btnaccept:hover {
    background: green;
	color:white;
	border: solid 2px blue;
}

/*button accept css end--*/
/*==button for download==*/
button.btndwn{
	background-color:dodgerblue;
	border:none;
	color:white;
	cursor:pointer;
	padding:12px 12px;
	font-size:14px;
	transition: 0.5s all;
    -webkit-transition: 0.5s all;
    -moz-transition: 0.5s all;
    -o-transition: 0.5s all;
    -ms-transition: 0.5s all;
}
button.btndwn:hover
{
	background-color:RoyalBlue;
}
/*==end of download button==*/
/*button unfriend css--*/
button.btnunfriend {
    color: white;
    font-size: .9em;
	border-radius:10px;
	border:solid 2px black;
    padding: 1em 1em;
    text-align: center;
    text-decoration: none;
    background: green;
    transition: 0.5s all;
    -webkit-transition: 0.5s all;
    -moz-transition: 0.5s all;
    -o-transition: 0.5s all;
    -ms-transition: 0.5s all;
}
button.btnunfriend:hover {
    background: green;
	color:white;
	border: solid 2px red;
}

/*button unfriend css end--*/
/*button cancel css--*/
button.btncancel {
    color: white;
    font-size: .9em;
	border-radius:10px;
	border:solid 2px black;
    padding: 1em 1em;
    text-align: center;
    text-decoration: none;
    background: green;
    transition: 0.5s all;
    -webkit-transition: 0.5s all;
    -moz-transition: 0.5s all;
    -o-transition: 0.5s all;
    -ms-transition: 0.5s all;
}
button.btncancel:hover {
    background: red;
	color:black;
	border: solid 2px blue;
}

/*button cancel css end--*/
/*button decline css--*/
button.btndecline {
    color: white;
    font-size: .9em;
	border-radius:10px;
	border:solid 2px black;
    padding: 1em 1em;
    text-align: center;
    text-decoration: none;
    background: red;
    transition: 0.5s all;
    -webkit-transition: 0.5s all;
    -moz-transition: 0.5s all;
    -o-transition: 0.5s all;
    -ms-transition: 0.5s all;
}
button.btndecline:hover {
    background: red;
	color:black;
	border: solid 2px red;
}

/*button decline css end--*/
/*--upload pic btn--*/
button.btnupload {
    color: #FFFFFF;
    font-size: .9em;
    border-radius: 8px;
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
button.btnupload:hover {
    background: green;
	color:white;
	border: solid 2px black;
}
/*--upload pic btn end--*/

/*--overlay search --*/
.overlaysearch {
    height: 0%;
    width: 100%;
    position: fixed;
    z-index: 1;
    top: 0;
    left: 0;
   background:url("images/map.jpg");
    overflow-y: auto;
    transition: 0.6s;
}

.overlaysearch-content {
    position: relative;
    top: 50%;
    width: 100%;
    text-align: center;
    margin-top: 20%;
	color:white;
}

.overlaysearch a {
    padding: 8px;
    text-decoration: none;
    font-size: 16px;
    color: white;
    display: block;
    transition: 0.3s;
}

.overlaysearch a:hover, .overlaysearch a:focus {
    color: orange;
}

.overlaysearch .closebtn {
    position: absolute;
    top: 20px;
    right: 45px;
    font-size: 60px;
}

@media screen and (max-height: 450px) {
  .overlaysearch {overflow-y: auto;}
  .overlaysearch a {font-size: 20px}
  .overlaysearch .closebtn {
    font-size: 40px;
    top: 15px;
    right: 35px;
  }
}
/*--overlay search end--*/
/* Style the tab */
/* Style the tab */
.tab {
    overflow: hidden;
    border: 1px solid black;
    background:url("images/friend.jpg");
}

/* Style the buttons inside the tab */
.tab button {
    background-color: inherit;
	color:white;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    transition: 0.3s;
    font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
    background-color: #ddd;
	color:green;
}

/* Create an active/current tablink class */
.tab button.active {
    background-color: green;
	color:white;
}

/* Style the tab content */
.tabcontent {
    display: none;
    padding: 0px;
	overflow-y:auto;
	overflow-x:hidden;
    -webkit-animation: fadeEffect 1s;
    animation: fadeEffect 1s;
}

/* Fade in tabs */
@-webkit-keyframes fadeEffect {
    from {opacity: 0;}
    to {opacity: 1;}
}

@keyframes fadeEffect {
    from {opacity: 0;}
    to {opacity: 1;}
}




/*==ai css==*/
/* Position the image container (needed to position the left and right arrows) */
* {
  box-sizing: border-box;
}
/* Hide the images by default */
.mySlides {
  display: none;
}

/* Next & previous buttons */
.prev,
.next {
  cursor: pointer;
  position: absolute;
  top: 40%;
  width: auto;
  padding: 16px;
  margin-top: -50px;
  color: white;
  font-weight: bold;
  font-size: 20px;
  border-radius: 0 3px 3px 0;
  user-select: none;
  -webkit-user-select: none;
}

/* Position the "next button" to the right */
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover,
.next:hover {
  background-color: rgba(0, 0, 0, 0.8);
}
/*==ai css==*/
.bothie
{
	margin-left:auto;
	margin-right:auto;
	height:500px;
	overflow-y:auto;
	overflow-x:hidden;
	width:700px;
  text-align: center;
}
@media only screen and (max-width: 600px )
{
	.bothie
{
	width:100%;
}
}
</style>

</head>
<body style="background:url('wallpapers/w3.jpg');" onload="showprojects('<?php echo $_REQUEST["search"]; ?>');tp()">
<!--edit random AI starts-->
	<div id="RandomModal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h6 class="modal-title" style="text-align:center;"><i class="fa fa-users"></i>People of your interest</h6>
      </div>
      <div class="modal-body" style="background:url(images/model.jpg);">
	 <div class="row">

<?php
include("connection.php");
$em=$_COOKIE["Email"];
$my=mysqli_query($con,"select * from about where EMAIL='$em'");
$myi=mysqli_fetch_array($my);
$myinterest=$myi["INTEREST"];
$matchinterest=mysqli_query($con,"select s.FIRSTNAME,s.LASTNAME,s.GENDER,s.CITY,s.COUNTRY,s.PIC,a.INTEREST,a.EMAIL from about a,signup s where INTEREST in('$myinterest') and s.EMAIL=a.EMAIL and a.EMAIL<>'$em'");
$i=0;
while($ai=mysqli_fetch_array($matchinterest))
{
	$i++;
	?>
	<div class="mySlides">
<div class="col-sm-6">
  <a class="prev" onmouseover="this.style.color:'orange'" onclick="plusSlides(-1)">❮</a>
   
    <img src="user/<?php echo $ai["PIC"];?>" style="width:100%">
   <a class="next" onmouseover="this.style.color:'orange'" onclick="plusSlides(1)">❯</a>
   </div>
  
 
<div class="col-sm-6">
<p style="color:white;"><?php echo $ai["FIRSTNAME"]."&nbsp".$ai["LASTNAME"];?></p>
<p style="color:white;"><?php echo $ai["GENDER"];?></p>
<p style="color:white;"><?php echo $ai["CITY"];?> (<?php echo $ai["COUNTRY"];?>)</p>
<textarea id="aimsg" style="resize:none;width:100%;color:black;" class="form-control"  rows="2" placeholder="Send Message To User...." ></textarea>
<button type="button" onclick="sendmessage('<?php echo $ai["EMAIL"];?>')" class="btnaccept">Send</button>


</div>
</div>
  <?php
}
?>
 
  
 </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>
<!---end of ai modal-->
<div class="w3-bann">
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
									
								</div>

							</div>

							<!-- Collect the nav links, forms, and other content for toggling -->
							<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
							 <ul class="nav navbar-nav link-effect-4">
								<?php
							 $cnoti=mysqli_query($con,"select * from notification where NOTIFYTO='$em' and NOTIFYBY<>'$em' and STATUS='unseen'");
							 $countnoti=mysqli_num_rows($cnoti);
							 if(mysqli_num_rows($cnoti)>0)
							 {
							?>							
							<li><div id="realnoti"><a style="cursor:pointer;" class="add"><span class="badge"><i class="fa fa-globe"></i>Notification(<?php echo $countnoti;?>)</span></a></div></li>
								<?php
							 }
							 else
							 {
								 ?>
							 <li><a style="cursor:pointer;" class="add"><i class="fa fa-globe"></i>Notification</a></li>
							 <?php
							 }
								 ?>
								<!---notification modal-->
								<div class="dialog" style="display:none">
  <div class="title"><i class="fa fa-bell"></i>Notification</div>
  <div class="row">
  <?php
  $fetchnoti=mysqli_query($con,"select s.FIRSTNAME,s.LASTNAME,s.EMAIL,s.PIC,n.NOTIFICATION,n.DATE,n.TIME,n.TYPE,n.STATUS,n.NOTIFYBY,n.NOTIFYTO,n.NOTIFYID from notification n,signup s where s.EMAIL<>'$em' and (s.EMAIL=n.NOTIFYBY and n.NOTIFYTO='$em') order by n.NOTIFYID desc");
while($noti=mysqli_fetch_array($fetchnoti))
{
?>
<div class="col-sm-12">
<?php
if($noti["STATUS"]=='unseen')
{
	?>
<div class="w3-address-grid">
<div class="w3ls-post-grids">
<div class="row">
<div class="col-sm-1">
<img style="width:100px;height:80px;" src="user/<?php echo $noti["PIC"];?>">
</div>
<div class="col-sm-11">
<?php
if($noti["TYPE"]=="request")
{
	?>
<a onclick="change('<?php echo $noti["NOTIFYID"];?>')" style="cursor:pointer;color:white;" onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'" href="user.php?useremail=<?php echo $noti["NOTIFYBY"];?>"><?php echo $noti["FIRSTNAME"];?> &nbsp <?php echo $noti["NOTIFICATION"];?></a>
<?php
}
else
{
?>
<a style="cursor:pointer;color:white;" onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'" href="user.php?useremail=<?php echo $noti["NOTIFYBY"];?>"><?php echo $noti["FIRSTNAME"];?></a> 
<a onclick="change('<?php echo $noti["NOTIFYID"];?>')" href="noti.php?type=<?php echo $noti["TYPE"];?>&&id=<?php echo $noti["NOTIFYID"]; ?>" onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'" style="color:white;cursor:pointer;"><?php echo $noti["NOTIFICATION"];?></a>	
<?php
}
?>
<h6 style="color:white;" class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i><?php echo $noti["DATE"];?> - <span class="w3-tag w3-teal w3-round"><?php echo $noti["TIME"];?></span></h6>
</div>
</div>
<div class="w3ls-border"> </div>
</div>
</div>
<?php
}
else if($noti["STATUS"]=='seen')
{
?>
&nbsp
<div class="row" style="color:black;">
<div class="col-sm-1">
<img style="width:100px;height:80px;" src="user/<?php echo $noti["PIC"];?>">
</div>
<div class="col-sm-11">
<?php
if($noti["TYPE"]=="request")
{
	?>
<a style="cursor:pointer;color:black;" onmouseover="this.style.color='orange'" onmouseout="this.style.color='black'" href="user.php?useremail=<?php echo $noti["NOTIFYBY"];?>"><?php echo $noti["FIRSTNAME"];?> &nbsp <?php echo $noti["NOTIFICATION"];?></a>	
<?php
}
else
{
?>
<a style="cursor:pointer;color:black;" onmouseover="this.style.color='orange'" onmouseout="this.style.color='black'" href="user.php?useremail=<?php echo $noti["NOTIFYBY"];?>"><?php echo $noti["FIRSTNAME"];?></a> 
<a href="noti.php?type=<?php echo $noti["TYPE"];?>&&id=<?php echo $noti["NOTIFYID"]; ?>" onmouseover="this.style.color='orange'" onmouseout="this.style.color='bllack'" style="color:black;cursor:pointer;"><?php echo $noti["NOTIFICATION"];?></a>	
<?php
}
?>
<h6 style="color:black;" class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i><?php echo $noti["DATE"];?> - <span class="w3-tag w3-teal w3-round"><?php echo $noti["TIME"];?></span></h6>
</div>
</div>
<div class="w3ls-border"> </div>
<?php
}
?>
</div>
<?php
}
?>
</div>
</div>
  
								<!---notificationmodal end-->
								<?php
								include("connection.php");
								$em=$_COOKIE["Email"];
								$requestcheck=mysqli_query($con,"select * from request where REQUESTTO='$em'");
                              $countrequest=mysqli_num_rows($requestcheck);
                              if(mysqli_num_rows($requestcheck)>0)
							  {
							  ?>							  
		                       <li><div id="realrqst"><a style="cursor:pointer;" onclick="request()"><span class="badge"><i class="fa fa-users"></i>Requests(<?php echo $countrequest; ?>)</span></a></div></li>
							   <?php
							  }
							  else
							  {
								  ?>
							   <li><a style="cursor:pointer;" onclick="request()"><i class="fa fa-users"></i>Requests</a></li>
							   <?php
							  }
							  ?>
							   <!--show request-->
		<div id="requestlay" class="overlayr">
								  <a href="javascript:void()" class="closebtn" onclick="offlay()">&times;</a>
                                  <div id="showrequest">
								</div>
								</div>
							   <!--show request end-->
							   <?php
							   $cmsg=mysqli_query($con,"select * from message where MSGTO='$em' and (STATUS='unseen' and MSGBY<>'$em') ");
							   $countm=mysqli_num_rows($cmsg);
							   if(mysqli_num_rows($cmsg)>0)
							   {
							   ?>
								<li><div id="msgrealt"><a href="mymessage.php"><span class="badge"><i class="fa fa-envelope"></i>Message(<?php echo $countm;?>)</span></a></div></li>
								<?php
							   }
							   else
							   {
								 ?>
								 <li><a href="mymessage.php"><i class="fa fa-envelope"></i>Message</a></li>
								 <?php  
							   }
							   ?>
								<li><a href="profile.php"><i class="fa fa-user"></i>My Profile</a></li>
						<li class="dropdown"><a data-toggle="dropdown" style="cursor:pointer;" ><i class="fa fa-shopping-bag"></i>Menu</a>
		<div class="dropdown-menu" style="background:url(images/friend.jpg);">
		<h5 class="dropdown-header">Visit For</h5>
		<div class="dropdown-divider"></div>
		<a href="myhome.php"><i class="fa fa-rocket"></i>HOME</a>
		</br>
		<div class="dropdown-divider" ></div>
		</br>
		<a href="logout.php"><i class="fa fa-sign-out"></i>LOGOUT</a>
		<div class="dropdown-divider"></div>
		
		
		
		</div>
						
						
						
						
						</li>

								<!--<li><a href="#team" class="scroll"><i class="fa fa-university"></i>Research/Projects</a></li>-->
								
							  </ul>
							</div><!-- /.navbar-collapse -->
						</div>
						</br>
						<div class="row">
						<div class="col-sm-5">
						</div>
						<div class="col-sm-5">
						<div class="input-con">
                               <input type="text"  id="search"  placeholder="Search From Here....." class="input-field">
								<button type="submit" onclick="search()" class="btnsignup"><i class="fa fa-search"></i></button>
								<!--overlay search data-->
								<div id="searchlay" class="overlaysearch">
								  <a href="javascript:void()" class="closebtn" onclick="closesearchlay()">&times;</a>
                                  <div id="showsearch">
								</div>
								</div>
								<!--overlaysearch data end-->
								</div>
								 <input type="radio"  name="option" id="people" value="people" checked><label style="color:white;">People</label>
                                  <input type="radio" name="option" id="project" value="project"><label style="color:white;">Projects</label>
								  
								  <a onmouseover="this.style.color='orange'" onclick="currentSlide(1)" data-toggle="modal" href="#RandomModal" onmouseout="this.style.color='white'" style="color:white;cursor:pointer;" ><i class="	fa fa-hand-o-right"></i>CLick Here</a>
									</div>
									<div class="col-sm-2">
						</div>
									</div>
				</div>
			</div>
			</div>
		
			<!--upper side all done-->
			
			
			
			<!--<div class="container-fluid">
	<div class="row">
	<div class="col-sm-4">
	
	<!--<div class="agileits-w3layouts-footer">
			<div class="row">
			<div class="col-sm-12">
			<div class="w3l-heading">
				<h3 style="font-size:16px;color:white;">Top Trendings</h3>
				<div class="w3ls-border"> </div>
				<div id="trendingprojects"></div>
			</div>
			</div>
			</div>
	</div>
	</div>-->
	<div class="bothie">
	<div class="row">
			<div class="col-sm-12">
	<div class="agileits-w3layouts-footer">
	<div class="w3l-heading">
				<h3 style="font-size:16px;color:white;">You Searched For "<?php echo $search;?>"</h3>
				<div class="w3ls-border"> </div>
	<input type="text" id="s" value="<?php echo $search;?>" style="display:none;">
	<div id="showpr"></div>
	</div>
</div>
</div>
</div>
</div>