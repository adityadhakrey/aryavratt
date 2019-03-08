<?php
include("connection.php");
$em=$_COOKIE["Email"];
if(!isset($_COOKIE["Email"]))
{
header("location:index.php");
}
$info=mysqli_query($con,"select * from signup where EMAIL='$em'");
$myfetchinfo=mysqli_fetch_array($info);
date_default_timezone_set("Asia/Kolkata");



$msg="";
ini_set('post_max_size', '64M');
ini_set('upload_max_filesize', '64M');
if(isset($_REQUEST["projectpost"]))
{
	$title=$_REQUEST["title"];
	$category=$_REQUEST["category"];
	$summary=$_REQUEST["summary"];
	$projecttime=date("g:i a");
	$projectdate=date("F j,y");
	$project=$_FILES["userproject"]["name"];
	$project1=$_FILES["userproject"]["type"];
	if( $project1=='application/pdf' || $project1=='application/x-rar-compressed' || $project1=='application/x-msdownload' || $project1=='application/zip')
	{
		$project1=$em.$project;
		move_uploaded_file($_FILES["userproject"]["tmp_name"],"userproject/$project1");
		$sendproject=mysqli_query($con,"insert into project(TITLE,CATEGORY,SUMMARY,PROJECT,EMAIL,TIME,DATE)values('$title','$category','$summary','$project1','$em','$projecttime','$projectdate')");
		header("location:profile.php");
	}
	else
	{
		$msg="Only rar/pdf/exe/zip Are Allowed..!";
	}
}
		


$msg="";
ini_set('post_max_size', '64M');
ini_set('upload_max_filesize', '64M');
if(isset($_REQUEST["uploadpic"]))
{
$pic=$_FILES["profilepic"]["name"];
$pic1=$_FILES["profilepic"]["type"];
if($pic1=='image/jpg' || $pic1=='image/png' || $pic1=='image/gif' || $pic1=='image/jpeg')
{
$pic1=$em.$pic;
move_uploaded_file($_FILES["profilepic"]["tmp_name"],"user/$pic1");
$updatepic=mysqli_query($con,"update signup set PIC='$pic1' where EMAIL='$em'");
header("location:profile.php");
}
else
{
	$msg="Use JPEG,JPG,PNG,GIF Only !";
}
}
$msg="";
if(isset($_REQUEST["picturepost"]))
{
	$picturecaption=$_REQUEST["picturetext"];
$picturetime=date("g:i a");
$picturedate=date("F j,y");
	$picture=$_FILES["picture"]["name"];
 $picture1=$_FILES["picture"]["type"];
if($picture1=='image/jpg' || $picture1=='image/png' || $picture1=='image/gif' || $picture1=='image/jpeg' || $picture1=='image/bmp')
{
	$picture1=$em.$picture;
  move_uploaded_file($_FILES["picture"]["tmp_name"],"userspicture/$picture1");
mysqli_autocommit($con,false);
try
{
  $sendpicture=mysqli_query($con,"insert into picture(PICTURE,PICTURECAPTION,EMAIL,DATE,TIME)values('$picture1','$picturecaption','$em','$picturedate','$picturetime')");
	$pid=$con->insert_id;
	$sendhome=mysqli_query($con,"insert into home(PICTUREID,PICTURE,PICTURECAPTION,EMAIL,DATE,TIME,TYPE)values('$pid','$picture1','$picturecaption','$em','$picturedate','$picturetime','picture')");
if($sendpicture==false or $sendhome==false)
{
		throw new Exception("Error");
}
$msg="Comment Posted!";
	mysqli_commit($con);
}
catch(Exception $ex)
{
	mysqli_rollback($con);
}
header("location:profile.php");
}
else
{
	$msg="only JPEG,JPG,PNG,GIF Are Allowed!";
}
}

$msg="";
ini_set('post_max_size', '64M');
ini_set('upload_max_filesize', '64M');
if(isset($_REQUEST["videopost"]))
{
	$videocaption=$_REQUEST["videotext"];
	$videotime=date("g:i a");
	$videodate=date("F j,y");
	$video=$_FILES["uservideo"]["name"];
	$video1=$_FILES["uservideo"]["type"];
	
	if($video1=='video/3gpp' || $video1=='video/mp4' || $video1=='video/x-ms-wmv' || $video1=='video/quicktime' || $video1=='video/x-flv' || $video1=='video/MP2T')
	{
		$video1=$em.$video;
		move_uploaded_file($_FILES["uservideo"]["tmp_name"],"usersvideo/$video1");
		mysqli_autocommit($con,false);
try
{
		$sendvideo=mysqli_query($con,"insert into video(VIDEO,VIDEOCAPTION,EMAIL,DATE,TIME)values('$video1','$videocaption','$em','$videodate','$videotime')");
		$vid=$con->insert_id;
		$sendvideohome=mysqli_query($con,"insert into home(VIDEOID,VIDEO,VIDEOCAPTION,EMAIL,DATE,TIME,TYPE)values('$vid','$video1','$videocaption','$em','$videodate','$videotime','video')");
		if($sendvideo==false or $sendvideohome==false)
{
		throw new Exception("Error");
}
$msg="Comment Posted!";
	mysqli_commit($con);
}
catch(Exception $ex)
{
	mysqli_rollback($con);
}
header("location:profile.php");
	}
	else
	{
		$msg="file format not supported-!";
	}
}
?>

<?php echo $msg;?>
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
<link rel="stylesheet" href="css/feeling.css" type="text/css" media="all" />
<!--// css -->
<!-- font-awesome icons -->
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome icons -->
<!-- gallery -->
<link rel="stylesheet" href="css/lightbox.css">
<!-- //gallery -->
<link href="chat/chatstyle.css" rel="stylesheet">
<!-- font -->
<link href="//fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Droid+Serif:400,400i,700,700i" rel="stylesheet">
<!-- //font -->
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="chat/chatscript.js"></script>

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
document.getElementById("showrequest").innerHTML="<img style='width:100%;' src='images/loader.gif' />";
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
			//alert(r.responseText);
			request();
		}
	}
	r.open("post","accept.php?s="+t+"&email="+email);
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
			//alert(r.responseText);
			request();
		}
	}
	r.open("post","decline.php?s="+t+"&email="+email);
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
	location.replace("project.php?s="+t+"&search="+text);
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
			//alert(r.responseText);
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
			//alert(r.responseText);
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
			//alert(r.responseText);
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
			//alert(r.responseText);
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
			//alert(r.responseText);
			search();
		}
	}
	r.open("get","decline.php?s="+t+"&email="+email);
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
	r.open("post","updatetime.php?s="+t);
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
/*function for accept and decline friend request--*/


function seencount(vid) 
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
r.open("post","seenvideo.php?s="+t+"&vid="+vid);
r.send();
}

/* end of accept and decline feirnd request function--*/
/*--all function of status post--*/
function statuspost()
{
	var status=document.getElementById("status").value;
	if(status=="")
	{
		document.getElementById("status").focus();
	}
	else
	{
	var t=Math.random();
	var r=new XMLHttpRequest();
	r.onreadystatechange=function()
	{
		if(r.readyState==4)
		{
			
			//alert(r.responseText);
			document.getElementById("status").value="";
			showstatus();
		}
	}
	r.open("get","statuspost.php?s="+t+"&status="+status);
	r.send();
	
}
}

var sscroll=0;
function sscrl()
{
sscroll=document.getElementById("sscr").scrollTop;
}

function showstatus()
{
document.getElementById("showstatus").innerHTML="<img style='width:100%;' src='images/loader.gif' />";
	var t=Math.random();
	var r=new XMLHttpRequest();
	r.onreadystatechange=function()
	{
		if(r.readyState==4)
		{
			
			document.getElementById("showstatus").innerHTML=r.responseText;
			document.getElementById("sscr").scrollTop=sscroll;
		}
	}
	r.open("get","showstatus.php?s="+t);
	r.send();
	
}
function setlike(sid,email,x)
		{
			alert(x);
			var t=Math.random();
			
			var r=new XMLHttpRequest();
			r.onreadystatechange=function()
			{
				if(r.readyState==4)
				{
					//alert("a");
					//alert(r.responseText);
					
					showstatus();
				}
			}
			r.open("post","statuslike.php?s="+t+"&sid="+sid+"&email="+email+"&type="+x);
			r.send();
			alert(x);
		}
function poststatuscomment(sid,i,email)
{
	//tag(i);
	var text=document.getElementById("contentbox"+i).innerHTML;
	var t=Math.random();
	var r=new XMLHttpRequest();
	if(text=="")
	{
		document.getElementById("contentbox"+i).focus();
	}
	else
	{
	r.onreadystatechange=function()
	{
		if(r.readyState==4)
		{
			//alert(r.responseText);
			showstatus();
		}
	}
	r.open("get","statuscomment.php?s="+t+"&sid="+sid+"&comment="+text+"&email="+email);
	r.send();
}
}
function deletestatus(sid)
{
	var t=Math.random();
	var r=new XMLHttpRequest();
	r.onreadystatechange=function()
	{
		if(r.readyState==4)
		{
			//alert(r.responseText);
			showstatus();
		}
	}
	r.open("get","deletestatus.php?s="+t+"&sid="+sid);
	r.send();
}
function showstatuscomment(i,sid)
{

	var t=Math.random();
	var r=new XMLHttpRequest();
	r.onreadystatechange=function()
	{
		if(r.readyState==4)
		{
			document.getElementById("showstatuscomment"+i).innerHTML=r.responseText;
		}
	}
	r.open("get","showstatuscomment.php?s="+t+"&i="+i+"&sid="+sid);
	r.send();
	
	
}
function deletestatuscomment(i,cid)
{
	
	var t=Math.random();
	var r=new XMLHttpRequest();
	r.onreadystatechange=function()
	{
		if(r.readyState==4)
		{
			//alert(r.responseText);
			showstatus();
		}
	}
	r.open("get","deletestatuscomment.php?s="+t+"&commentid="+cid);
	r.send();
}
function openstatusedit(i)
{

	document.getElementById("statuseditor"+i).style.display="block";

	}
	
function statusedit(sid,i)
{
	var txts=document.getElementById("es"+i).value;
	var t=Math.random();
	var r=new XMLHttpRequest();
	if(txts=="")
	{
		alert("box is empty");
		document.getElementById("es"+i).focus();
	}
	else
	{
	r.onreadystatechange=function()
	{
		if(r.readyState==4)
		{
			//alert(r.responseText);
			showstatus();
		}
	}
	r.open("get","statusedit.php?s="+t+"&sid="+sid+"&text="+txts);
	r.send();
}
}
function closediv(i)
{
	document.getElementById("statuseditor"+i).style.display="none";
}

function opence(i)
{

	document.getElementById("comedit"+i).style.display="block";

	}
	
function comdit(cid,i,sid)
{
	var txts=document.getElementById("cs"+i).value;
	var t=Math.random();
	var r=new XMLHttpRequest();
	if(txts=="")
	{
		alert("box is empty");
		document.getElementById("cs"+i).focus();
	}
	else
	{
	r.onreadystatechange=function()
	{
		if(r.readyState==4)
		{
			//alert(r.responseText);
			showstatus();
			sscmnt(i,sid);
		}
	}
	r.open("get","commentedit.php?s="+t+"&cid="+cid+"&text="+txts);
	r.send();
}
}
function closece(i)
{
	document.getElementById("comedit"+i).style.display="none";
}
/*--ending of all function of status --*/

/*--starting of all function of picture--*/
function openpicedit(i)
{

	document.getElementById("piceditor"+i).style.display="block";

	}
	
function picedit(pid,i)
{
	var txts=document.getElementById("pe"+i).value;
	var t=Math.random();
	var r=new XMLHttpRequest();
	if(txts=="")
	{
		alert("box is empty");
		document.getElementById("pe"+i).focus();
	}
	else
	{
	r.onreadystatechange=function()
	{
		if(r.readyState==4)
		{
			//alert(r.responseText);
			pictureshow();
		}
	}
	r.open("get","picedit.php?s="+t+"&pid="+pid+"&text="+txts);
	r.send();
}
}
function closepicedit(i)
{
	document.getElementById("piceditor"+i).style.display="none";
}


function openpce(i)
{

	document.getElementById("pcomedit"+i).style.display="block";

	}
	
function pcomdit(cid,i)
{
	var txts=document.getElementById("pce"+i).value;
	var t=Math.random();
	var r=new XMLHttpRequest();
	if(txts=="")
	{
		alert("box is empty");
		document.getElementById("pce"+i).focus();
	}
	else
	{
	r.onreadystatechange=function()
	{
		if(r.readyState==4)
		{
			//alert(r.responseText);
			pictureshow();
		}
	}
	r.open("get","piccommentedit.php?s="+t+"&cid="+cid+"&text="+txts);
	r.send();
}
}
function closepce(i)
{
	document.getElementById("pcomedit"+i).style.display="none";
}


var pscroll=0;
function pscrl()
{
pscroll=document.getElementById("pscr").scrollTop;
}

function pictureshow()
{
document.getElementById("showpicture").innerHTML="<img style='width:100%;' src='images/loader.gif' />";
	var t=Math.random();
	var r=new XMLHttpRequest();
	r.onreadystatechange=function()
	{
		if(r.readyState==4)
		{
			document.getElementById("showpicture").innerHTML=r.responseText;
			document.getElementById("pscr").scrollTop=pscroll;
		}
	}
	r.open("get","showpicture.php?s="+t);
	r.send();
	
}
function setpiclike(pid,email,x)
		{
			alert(x);
			var t=Math.random();
			
			var r=new XMLHttpRequest();
			r.onreadystatechange=function()
			{
				if(r.readyState==4)
				{
					//alert("a");
					//alert(r.responseText);
					pictureshow();
				}
			}
			r.open("get","picturelike.php?s="+t+"&pid="+pid+"&email="+email+"&type="+x);
			r.send();
		
	}

	function postpicturecomment(pid,i,email)
   {
	     var text=document.getElementById("picturecomment"+i).value;
	     var t=Math.random();
	     var r=new XMLHttpRequest();
	     if(text=="")
	{
		document.getElementById("picturecomment"+i).focus();
	}
	else
	{
	r.onreadystatechange=function()
	{
		if(r.readyState==4)
		{
			//alert(r.responseText);
			//showpicturecomment(i,pid);
			pictureshow();
		}
	}
	r.open("get","picturecomment.php?s="+t+"&pid="+pid+"&comment="+text+"&email="+email);
	r.send();
}
}
function deletepicture(pid)
{
	var t=Math.random();
	var r=new XMLHttpRequest();
	r.onreadystatechange=function()
	{
		if(r.readyState==4)
		{
			//alert(r.responseText);
			pictureshow();
		}
	}
	r.open("get","deletepicture.php?s="+t+"&pid="+pid);
	r.send();
}
function showpicturecomment(i,pid)
{

	var t=Math.random();
	var r=new XMLHttpRequest();
	r.onreadystatechange=function()
	{
		if(r.readyState==4)
		{
			document.getElementById("picturecomment"+i).innerHTML=r.responseText;
		}
	}
	r.open("get","showpicturecomment.php?s="+t+"&i="+i+"&pid="+pid);
	r.send();
	
	
}
function deletepicturecomment(i,cid)
{
	var t=Math.random();
	var r=new XMLHttpRequest();
	r.onreadystatechange=function()
	{
		if(r.readyState==4)
		{
			//alert(r.responseText);
			pictureshow();
			//showpicturecomment(i,pid);
		}
	}
	r.open("get","deletepicturecomment.php?s="+t+"&commentid="+cid);
	r.send();
}
/*===all functions of picture end==*/
/*==all functions of video==*/

function videoedit(i)
{

	document.getElementById("videditor"+i).style.display="block";

}
	
function videdit(vid,i)
{
	var txts=document.getElementById("ve"+i).value;
	var t=Math.random();
	var r=new XMLHttpRequest();
	if(txts=="")
	{
		alert("box is empty");
		document.getElementById("ve"+i).focus();
	}
	else
	{
	r.onreadystatechange=function()
	{
		if(r.readyState==4)
		{
			//alert(r.responseText);
			videoshow();
		}
	}
	r.open("get","videdit.php?s="+t+"&vid="+vid+"&text="+txts);
	r.send();
}
}
function closevidedit(i)
{
	document.getElementById("videditor"+i).style.display="none";
}


function openvce(i)
{

	document.getElementById("vcomedit"+i).style.display="block";

}
	
function vcomdit(cid,i)
{
	var txts=document.getElementById("vce"+i).value;
	var t=Math.random();
	var r=new XMLHttpRequest();
	if(txts=="")
	{
		alert("box is empty");
		document.getElementById("vce"+i).focus();
	}
	else
	{
	r.onreadystatechange=function()
	{
		if(r.readyState==4)
		{
			//alert(r.responseText);
			videoshow();
		}
	}
	r.open("get","vidcommentedit.php?s="+t+"&cid="+cid+"&text="+txts);
	r.send();
}
}
function closevce(i)
{
	document.getElementById("vcomedit"+i).style.display="none";
	
}


var vscroll=0;
function vscrl()
{
vscroll=document.getElementById("vscr").scrollTop;
}

function videoshow()
{
document.getElementById("showvideo").innerHTML="<img style='width:100%;' src='images/loader.gif' />";
	var t=Math.random();
	var r=new XMLHttpRequest();
	r.onreadystatechange=function()
	{
		if(r.readyState==4)
		{
			document.getElementById("showvideo").innerHTML=r.responseText;
		document.getElementById("vscr").scrollTop=vscroll;
		}
	}
	r.open("get","showvideo.php?s="+t);
	r.send();
}
function setvidlike(vid,email,x)
		{
			alert(x);
			var t=Math.random();
			
			var r=new XMLHttpRequest();
			r.onreadystatechange=function()
			{
				if(r.readyState==4)
				{
					//alert("a");
					alert(r.responseText);
					videoshow();
				}
			}
			r.open("get","videolike.php?s="+t+"&vid="+vid+"&email="+email+"&type="+x);
			r.send();

		}

function postvideocomment(vid,i,email)
   {
	     var text=document.getElementById("videocomment"+i).value;
	     var t=Math.random();
	     var r=new XMLHttpRequest();
	     if(text=="")
	{
		document.getElementById("videocomment"+i).focus();
	}
	else
	{
	r.onreadystatechange=function()
	{
		if(r.readyState==4)
		{
			//alert(r.responseText);
			//showpicturecomment(i,pid);
			videoshow();
		}
	}
	r.open("get","videocomment.php?s="+t+"&vid="+vid+"&comment="+text+"&email="+email);
	r.send();
}
}
function deletevideo(vid)
{
	var t=Math.random();
	var r=new XMLHttpRequest();
	r.onreadystatechange=function()
	{
		if(r.readyState==4)
		{
			//alert(r.responseText);
			videoshow();
		}
	}
	r.open("get","deletevideo.php?s="+t+"&vid="+vid);
	r.send();
}
function showvideocomment(i,vid)
{

	var t=Math.random();
	var r=new XMLHttpRequest();
	r.onreadystatechange=function()
	{
		if(r.readyState==4)
		{
			document.getElementById("videocomment"+i).innerHTML=r.responseText;
		}
	}
	r.open("get","showvideocomment.php?s="+t+"&i="+i+"&vid="+vid);
	r.send();
	
	
}
function deletevideocomment(i,cid)
{
	var t=Math.random();
	var r=new XMLHttpRequest();
	r.onreadystatechange=function()
	{
		if(r.readyState==4)
		{
			//alert(r.responseText);
			videoshow();
			
			//showpicturecomment(i,pid);
		}
	}
	r.open("get","deletevideocomment.php?s="+t+"&commentid="+cid);
	r.send();
}
/*--ending of all function of picture--*/

/*==staarting of all function of project==*/

function proclosescmnt(i)
{
document.getElementById("prosscopen"+i).style.display="none";
document.getElementById("proclscmnt"+i).style.display="none";
document.getElementById("prosm"+i).style.display="block";
	 
}
 
function prosscmnt(i,sid)
{

document.getElementById("prosscopen"+i).style.display="block";
document.getElementById("proclscmnt"+i).style.display="block";
document.getElementById("prosm"+i).style.display="none";

showproc(i,sid);

}
function showproc(i,prid)
{

	var t=Math.random();
	var r=new XMLHttpRequest();
	r.onreadystatechange=function()
	{
		if(r.readyState==4)
		{
			document.getElementById("prossc"+i).innerHTML=r.responseText;
		//alert(r.responseText);
		}
	}
	r.open("get","procmnt.php?s="+t+"&i="+i+"&prid="+prid);
	r.send();

}



function proopence(i)
{

	document.getElementById("procomedit"+i).style.display="block";

	}
	
function procomdit(cid,i)
{
	var txts=document.getElementById("procs"+i).value;
	var t=Math.random();
	var r=new XMLHttpRequest();
	if(txts=="")
	{
		alert("box is empty");
		document.getElementById("procs"+i).focus();
	}
	else
	{
	r.onreadystatechange=function()
	{
		if(r.readyState==4)
		{
			//alert(r.responseText);
			projectshow();
		}
	}
	r.open("get","procommentedit.php?s="+t+"&cid="+cid+"&text="+txts);
	r.send();
}
}
function proclosece(i)
{
	document.getElementById("procomedit"+i).style.display="none";
}

var proscroll=0;
function proscrl()
{
proscroll=document.getElementById("proscr").scrollTop;
}


function projectshow()
{
	var t=Math.random();
	var r=new XMLHttpRequest();
	r.onreadystatechange=function()
	{
		if(r.readyState==4)
		{
			document.getElementById("showproject").innerHTML=r.responseText;
		document.getElementById("proscr").scrollTop=proscroll;
		}
	}
	r.open("get","showproject.php?s="+t);
	r.send();
}
function projectlike(id,email)
{
	
	var t=Math.random();
	var r=new XMLHttpRequest();
	r.onreadystatechange=function()
	{
		if(r.readyState==4)
		{
			//alert(r.responseText);
			projectshow();
		}
	}
	r.open("get","projectlike.php?s="+t+"&sid="+id+"&email="+email);
	r.send();
}
function projectdislike(id)
{
	
	var t=Math.random();
	var r=new XMLHttpRequest();
	r.onreadystatechange=function()
	{
		if(r.readyState==4)
		{
			//alert(r.responseText);
			projectshow();
		}
	}
	r.open("get","projectdislike.php?s="+t+"&sid="+id);
	r.send();
}
function postprojectcomment(sid,i,email)
{
	var text=document.getElementById("uprojectcomment"+i).value;
	var t=Math.random();
	var r=new XMLHttpRequest();
	if(text=="")
	{
		document.getElementById("uprojectcomment"+i).focus();
	}
	else
	{
	r.onreadystatechange=function()
	{
		if(r.readyState==4)
		{
			//alert(r.responseText);
			projectshow();
		}
	}
	r.open("get","projectcomment.php?s="+t+"&sid="+sid+"&comment="+text+"&email="+email);
	r.send();
}
}
function deleteproject(sid)
{
	var t=Math.random();
	var r=new XMLHttpRequest();
	r.onreadystatechange=function()
	{
		if(r.readyState==4)
		{
			//alert(r.responseText);
			projectshow();
		}
	}
	r.open("get","deleteproject.php?s="+t+"&sid="+sid);
	r.send();
}
function showprojectcomment(i,sid)
{

	var t=Math.random();
	var r=new XMLHttpRequest();
	r.onreadystatechange=function()
	{
		if(r.readyState==4)
		{
			document.getElementById("showprojectcomment"+i).innerHTML=r.responseText;
		}
	}
	r.open("get","showprojectcomment.php?s="+t+"&i="+i+"&sid="+sid);
	r.send();
	
	
}
function deleteprojectcomment(i,cid)
{
	
	var t=Math.random();
	var r=new XMLHttpRequest();
	r.onreadystatechange=function()
	{
		if(r.readyState==4)
		{
			//alert(r.responseText);
			projectshow();
		}
	}
	r.open("get","deleteprojectcomment.php?s="+t+"&commentid="+cid);
	r.send();
}


/*==ending of all functions of project==*/
/*====open about ==*/
$(".modal-wide").on("show.bs.modal", function() {
  var height = $(window).height() - 200;
  $(this).find(".modal-body").css("max-height", height);
});
/*==about modal close==also modal for AI Search*/
function saveabout()
{
	//alert("A");
	var high=document.getElementById("highschool").value;
	var college=document.getElementById("college").value;
	var degree=document.getElementById("degree").value;
	var more=document.getElementById("more").value;
	var current=document.getElementById("current").value;
	var post=document.getElementById("post").value;
	var previous=document.getElementById("previouswork").value;
	var interest="";
	if(document.getElementById("interest").value=="computer")
	{
		interest="computer";
	}
	else if(document.getElementById("interest").value=="electrical")
	{
		interest="electrical";
	}
	else if(document.getElementById("interest").value=="chemical")
	{
		interest="chemical";
	}
	else if(document.getElementById("interest").value=="civil")
	{
		interest="civil";
	}
	else if(document.getElementById("interest").value=="mechanical")
	{
		interest="mechanical";
	}
	else if(document.getElementById("interest").value=="electronics")
	{
		interest="electronics";
	}
	else if(document.getElementById("interest").value=="others")
	{
	interest="others";
    }
	
	var t=Math.random();
	var r=new XMLHttpRequest();
	r.onreadystatechange=function()
	{
		if(r.readyState==4)
		{
			//alert(r.responseText);
		}
	}
r.open("get","about.php?s="+t+"&high="+high+"&college="+college+"&degree="+degree+"&more="+more+"&current="+current+"&post="+post+"&previous="+previous+"&interest="+interest);
r.send();
location.replace("profile.php");
}

function editabout()
{
	
	var high=document.getElementById("highschools").value;
	var college=document.getElementById("colleges").value;
	var degree=document.getElementById("degrees").value;
	var more=document.getElementById("mores").value;
	var current=document.getElementById("currents").value;
	var post=document.getElementById("posts").value;
	var previous=document.getElementById("previousworks").value;
	var interest="";
	if(document.getElementById("interests").value=="computer")
	{
		interest="computer";
	}
	else if(document.getElementById("interests").value=="electrical")
	{
		interest="electrical";
	}
	else if(document.getElementById("interests").value=="chemical")
	{
		interest="chemical";
	}
	else if(document.getElementById("interests").value=="civil")
	{
		interest="civil";
	}
	else if(document.getElementById("interests").value=="mechanical")
	{
		interest="mechanical";
	}
	else if(document.getElementById("interests").value=="electronics")
	{
		interest="electronics";
	}
	else if(document.getElementById("interests").value=="others")
	{
		interest="others";
	}
	//alert(interest);
	var t=Math.random();
	var r=new XMLHttpRequest();
	r.onreadystatechange=function()
	{
		if(r.readyState==4)
		{
			//alert(r.responseText);
                        location.replace("profile.php");
		}
	}
r.open("get","editabout.php?s="+t+"&high="+high+"&college="+college+"&degree="+degree+"&more="+more+"&current="+current+"&post="+post+"&previous="+previous+"&interest="+interest); 
r.send();
}

/*==close about==*/
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
/*--ai function end--*/
/*==trending projeccts==*/


function tpclosescmnt(i)
{
document.getElementById("tpsscopen"+i).style.display="none";
document.getElementById("tpclscmnt"+i).style.display="none";
document.getElementById("tpsm"+i).style.display="block";
	 
}
 
function tpsscmnt(i,prid)
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
			//alert(r.responseText);
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

var trscroll=0;
function trscrl()
{
trscroll=document.getElementById("trscr").scrollTop;
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
			document.getElementById("trscr").scrollTop=trscroll;
		}
	}
	r.open("get","tr.php?s="+t);
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
			tp();
		}
	}
	r.open("get","book.php?s="+t+"&prid="+prid+"&email="+email);
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
			//alert(r.responseText);
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
			//alert(r.responseText);
			
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
			//alert(r.responseText);
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
function tpdeleteprojectcomment(i,cid)
{
	
	var t=Math.random();
	var r=new XMLHttpRequest();
	r.onreadystatechange=function()
	{
		if(r.readyState==4)
		{
			//alert(r.responseText);
			tp();
		}
	}
	r.open("get","deleteprojectcomment.php?s="+t+"&commentid="+cid);
	r.send();
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

function closescmnt(i)
{
document.getElementById("sscopen"+i).style.display="none";
document.getElementById("clscmnt"+i).style.display="none";
document.getElementById("sm"+i).style.display="block";
	 
}
 
function sscmnt(i,sid)
{

document.getElementById("sscopen"+i).style.display="block";
document.getElementById("clscmnt"+i).style.display="block";
document.getElementById("sm"+i).style.display="none";

showsac(i,sid);

}
function showsac(i,sid)
{

	var t=Math.random();
	var r=new XMLHttpRequest();
	r.onreadystatechange=function()
	{
		if(r.readyState==4)
		{
			document.getElementById("ssc"+i).innerHTML=r.responseText;
		//alert(r.responseText);
		}
	}
	r.open("get","psscmnt.php?s="+t+"&i="+i+"&sid="+sid);
	r.send();

}

function closevcmnt(i)
{
document.getElementById("vscopen"+i).style.display="none";
document.getElementById("clvcmnt"+i).style.display="none";
document.getElementById("vm"+i).style.display="block";
	 
}
 
function vscmnt(i,vid)
{

document.getElementById("vscopen"+i).style.display="block";
document.getElementById("clvcmnt"+i).style.display="block";
document.getElementById("vm"+i).style.display="none";

showvac(i,vid);

}
function showvac(i,vid)
{

	var t=Math.random();
	var r=new XMLHttpRequest();
	r.onreadystatechange=function()
	{
		if(r.readyState==4)
		{
			document.getElementById("vsc"+i).innerHTML=r.responseText;
		//alert(r.responseText);
		}
	}
	r.open("get","pvcmnt.php?s="+t+"&i="+i+"&vid="+vid);
	r.send();

}
function closepcmnt(i)
{
document.getElementById("pscopen"+i).style.display="none";
document.getElementById("clpcmnt"+i).style.display="none";
document.getElementById("pm"+i).style.display="block";
	 
}
 
function pscmnt(i,pid)
{

document.getElementById("pscopen"+i).style.display="block";
document.getElementById("clpcmnt"+i).style.display="block";
document.getElementById("pm"+i).style.display="none";

showpac(i,pid);

}
function showpac(i,pid)
{

	var t=Math.random();
	var r=new XMLHttpRequest();
	r.onreadystatechange=function()
	{
		if(r.readyState==4)
		{
			document.getElementById("psc"+i).innerHTML=r.responseText;
		//alert(r.responseText);
		}
	}
	r.open("get","ppscmnt.php?s="+t+"&i="+i+"&pid="+pid);
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
			//alert(r.responseText);
           document.getElementById("aimsg").value="";
			}
	}
	r.open("get","sendmessage.php?s="+t+"&msg="+msg+"&email="+em1);
	r.send();
	}
	
}
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
			//alert(r.responseText);
           document.getElementById("usrmsg"+i).value="";
			}
	}
	r.open("get","sendmessage.php?s="+t+"&msg="+msg+"&email="+em1);
	r.send();
	}
	
}



/*====script for tag==*/
var mi="";
var str1="hi";
var cnt=0;
function tag(i)
{
	mi=i;
	var start=/@/ig; // @ Match
    var word=/@(\w+)/ig; //@abc Match
    var con=document.getElementById("contentbox"+i).innerHTML=""; //Content Box Data
    if(cnt==0)
	{
		str1=document.getElementById("contentbox"+i).innerHTML;
		cnt++;
	}
	alert(str1);
	var name= con.match(word); //Content Matching @abc
    
    var t=Math.random();
    var r=new XMLHttpRequest();
	r.onreadystatechange=function()
   {
		if(r.readyState==4)
		{
		
			document.getElementById("display"+i).innerHTML=r.responseText;
			//taged(con);
	}
   }
	r.open("post","boxsearch.php?s="+t+"&searchword="+name);
	r.send();
}
//Adding result name to content box.st
function taged(tagto)
{
	alert(tagto);
	alert(str1);
	document.getElementById("contentbox"+mi).innerHTML=str1+"<a href='#'>"+tagto+"</a>,";
	cnt=0;
	var t=Math.random();
	var r=new XMLHttpRequest();
	r.onreadystatechange=function()
	
	{
		if(r.readyState==4)
		{
			alert(r.responseText);
		}
	}
	r.open("get","tag.php?s="+t+"tagto="+tagto);
	r.send();
}






</script> 

<style>
#contentbox
{
width:90%; height:50px;
border:solid 2px solid white;
font-family:Arial, Helvetica, sans-serif;
font-size:14px;
margin-bottom:6px;
text-align:left
background-color:white;
color;black;
}
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
height:290px;
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
/*--profile pic css--*/
.gall-grid img {
    width: 100%;
    cursor: pointer;
	height:250px;
}
.gall-top-grids:nth-child(2),.gallery-top-grids:nth-child(3){
	margin-top:0;
}
.gall-grids-left {
    padding: 0;
}
.gall-grid{
	position:relative;
	overflow: hidden;
}
.gall-grid:hover .captn {
    bottom: 0%;
}
.captn {
    background: rgba(255, 87, 34, 0.69);
    padding: 2em;
    position: absolute;
    border: solid 1px #FFF;
    left: 0%;
    bottom: -100%;
    text-align: center;
    width: 100%;
    height: 240px;
    -webkit-transition: .5s all;
    transition: .5s all;
    -moz-transition: .5s all;
}
.captn h4 {
	font-size: 1.2em;
    color: #fff;
    margin: 2.5em 0 0 0;
    text-transform: uppercase;
    font-weight: 600;
    letter-spacing: 2px;
}
.captn p {
    margin: 0.5em 0 0 0;
    color: #FFFFFF;
    font-size: .9em;
}
/*--profile pic css end--*/
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


/*==tag box css==*/
#display
{
display:none;
border-left:solid 1px red;
border-right:solid 1px red;
border-bottom:solid 1px red;
background-color:white;
overflow-y:auto;
height:100px;
transition:0.3s;
display:inline-block;
}
.display_box
{
	
	height:auto;
	width:100%;
padding:4px; 
border-top:solid 1px #dedede; font-size:12px; 
height:auto;
background:white;
 transition: 0.3s;
}
.display_box:hover
{
background:grey;


}
.image
{
width:25px;
height:50px; float:left; margin-right:6px
}
/*tag box css end==*/
</style>

</head>
<body style="background:url('wallpapers/w3.jpg');" onload="showstatus();defaultopen();pictureshow();videoshow();projectshow();tp()">
<?php include("chatbox.php"); ?>
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
<a onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'" style="color:white;" href="user.php?useremail=<?php echo $ai["EMAIL"];?>" style="color:white;"><?php echo $ai["FIRSTNAME"]."&nbsp".$ai["LASTNAME"];?></a>
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
<!--modal end-AI-->
<!-- Modal -->
  <div class="modal fade" id="changepic" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header" style="background-color:black;color:white;">
          <button type="button" class="close" style="color:white;" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="font-size:14px;color:white;"><i class="fa fa-photo"></i>Update Your Profile Pic</h4>
        </div>
        <div class="modal-body" style="background-color:grey;">
		  <form action="profile.php" method="post" enctype="multipart/form-data">
    Select image to upload:
	</br>
    <input type="file" required name="profilepic" id="profilepic">
	</br>
    <button type="submit" class="btnupload" value="Update" name="uploadpic"><i class="fa fa-check-square-o"></i>Update Picture</button>
</form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <!--modal ends here-->
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
								  
<a onmouseover="this.style.color='orange'" onclick="currentSlide(1)" data-toggle="modal" href="#RandomModal" onmouseout="this.style.color='white'" style="color:white;cursor:pointer;" ><i class="	fa fa-hand-o-right"></i>CLick Here</a?
									</div>
									<div class="col-sm-2">
						</div>
									</div>
				</div>
			</div>
			<div class="container-fluid">
	<div class="row">
	<div class="col-sm-2">
	<div class="gall-grid">
							<a class="example-image-link" href="user/<?php echo $myfetchinfo["PIC"];?>" data-lightbox="example-set" data-title="Profile">
								<img src="user/<?php echo $myfetchinfo["PIC"];?>" alt="" />
								<div class="captn">
									<p><?php echo $myfetchinfo["FIRSTNAME"];?> <?php echo $myfetchinfo["LASTNAME"];?></p>
									<p>AGE-<?php echo $myfetchinfo["AGE"];?></p>
									<p>CITY-<?php echo $myfetchinfo["CITY"];?></p>
									<p>COUNTRY-<?php echo $myfetchinfo["COUNTRY"];?></p>
									<p>EMAIL-<?php echo $myfetchinfo["EMAIL"];?></p>
								</div>
								</a>
								</div>
		<script src="js/lightbox-plus-jquery.min.js"> </script>

								</div>
	<div class="col-sm-3">
	<button type="button" data-toggle="modal" data-target="#changepic" class="btnsignup">Change Pic</button>
	</div>
	<div class="col-sm-6">
	</div>
	</div>
	</div>
	</div>
	<!--end of w3 bann-->
	<!--starting of name-->
	
	<div class="container-fluid">
	<div class="row">
	<div class="col-sm-6">
	<h1 style="cursor:pointer;"><?php echo $myfetchinfo["FIRSTNAME"]."&nbsp".$myfetchinfo["LASTNAME"];?>&nbsp <i style="font-size:16px;"class="fa fa-edit"></i></h1>
	<?php
	$checkabout=mysqli_query($con,"select * from about where EMAIL='$em'");
	if(mysqli_num_rows($checkabout)>0)
	{
		$fetchinfo=mysqli_fetch_array($checkabout)
		?>
		
<a data-toggle="modal" href="#editModal"  style="color:dodgerblue;cursor:pointer;" onmouseover="this.style.color='orange'" onmouseout="this.style.color='dodgerblue'"><i class="fa fa-edit fa-fw"></i>Edit About You</a>		
		<!--edit about modal starts-->
	<div id="editModal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h6 class="modal-title" style="text-align:center;"><i class="fa fa-users"></i>About You</h6>
      </div>
      <div class="modal-body" style="background:url(images/model.jpg);">
	 <div class="row">
	 <div class="col-sm-6">
	 <label onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'" style="color:white;"><i class="fa fa-graduation-cap"></i>Education</label>
	 </br>
	 <div class="input-con">
	 <i class="fa fa-institution icon"></i>
      <input type="text"  id="highschools"  value="<?php  echo $fetchinfo["SCHOOL"];?>" placeholder="School" class="input-field">
</div>
</br>
<div class="input-con">
	 <i class="fa fa-institution icon"></i>
      <input type="text"  id="colleges"  value="<?php  echo $fetchinfo["COLLEGE"];?>"  placeholder="College" class="input-field">
</div>
</br>
<div class="input-con">
	 <i class="fa fa-institution icon"></i>
      <input type="text"  id="degrees" value="<?php  echo $fetchinfo["DEGREE"];?>" placeholder="Your Higher Qualification.." class="input-field">
</div>
<div class="w3ls-border"> </div>
</br>
<div class="input-con">
      <textarea  id="mores"  style="resize:none;width:100%;" value="<?php  echo $fetchinfo["MORE"];?>" rows=5 placeholder="More About You.." class="form-control"></textarea>
</div>


</div>	 
<div class="col-sm-6">
 <label onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'" style="color:white;"><i class="fa fa-info-circle"></i>Arear Of Interest</label>
 </br>
 <p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'" style="color:white;">Area Of Interest will Help Us To Recommend You To The People With Same Area Of Interest.</p> 
  <select class="form-control" id="interests">
 <option value=""  disabled selected hidden>Select your option</option>
    <option style="font-size:16px;" value="computer">Computer Science</option>
	<option style="font-size:16px;" value="electrical">Electrical</option>
	<option style="font-size:16px;" value="chemical">Chemical</option>
	<option style="font-size:16px;" value="civil">Civil</option>
	<option style="font-size:16px;" value="mechanical">Mechanical</option>
	<option style="font-size:16px;" value="electronics">Electronics</option>
	<option style="font-size:16px;" value="others">Others</option>
  </select>
</br>
<label onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'" style="color:white;"><i class="fa fa-briefcase"></i>Work & Experience</label>
</br>
<div class="input-con">
<i class="fa fa-briefcase icon"></i>
      <input type="text"  id="currents" value="<?php  echo $fetchinfo["CURRENTWORK"];?>" placeholder="currently working in.." class="input-field">
</div>
</br>
<div class="input-con">
<i class="fa fa-credit-card icon"></i>
      <input type="text"  id="posts" value="<?php  echo $fetchinfo["POST"];?>" placeholder="currently working post.." class="input-field">
</div>
</br>
<div class="input-con">
<i class="fa fa-briefcase icon"></i>
      <input type="text"  id="previousworks" value="<?php  echo $fetchinfo["PREVIOUSWORK"];?>" placeholder="Past works.." class="input-field">
</div>
</div>
</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button"  onclick="editabout()" class="btn btn-primary">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal edit about ends -->
		<?php
	}
	else
	{
		?>
	<a data-toggle="modal" href="#normalModal"  style="color:dodgerblue;cursor:pointer;" onmouseover="this.style.color='orange'" onmouseout="this.style.color='dodgerblue'"><i class="fa fa-edit fa-fw"></i>Edit About You</a>
	<?php
	}
	?>
	<!--edit about modal starts-->
	<div id="normalModal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h6 class="modal-title" style="text-align:center;"><i class="fa fa-users"></i>About You</h6>
      </div>
      <div class="modal-body" style="background:url(images/model.jpg);">
	 <div class="row">
	 <div class="col-sm-6">
	 <label onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'" style="color:white;"><i class="fa fa-graduation-cap"></i>Education</label>
	 </br>
	 <div class="input-con">
	 <i class="fa fa-institution icon"></i>
      <input type="text"  id="highschool"  placeholder="School" class="input-field">
</div>
</br>
<div class="input-con">
	 <i class="fa fa-institution icon"></i>
      <input type="text"  id="college"  placeholder="College" class="input-field">
</div>
</br>
<div class="input-con">
	 <i class="fa fa-institution icon"></i>
      <input type="text"  id="degree"  placeholder="Your Higher Qualification.." class="input-field">
</div>
<div class="w3ls-border"> </div>
</br>
<div class="input-con">
      <textarea  id="more"  style="resize:none;width:100%;" rows=5 placeholder="More About You.." class="form-control"></textarea>
</div>


</div>	 
<div class="col-sm-6">
 <label onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'" style="color:white;"><i class="fa fa-info-circle"></i>Arear Of Interest</label>
 </br>
 <p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'" style="color:white;">Area Of Interest will Help Us To Recommend You To The People With Same Area Of Interest.</p> 
  <select class="form-control" id="interest">
 <option value="" disabled selected hidden>Select your option</option>
    <option style="font-size:16px;" value="computer">Computer Science</option>
	<option style="font-size:16px;" value="electrical">Electrical</option>
	<option style="font-size:16px;" value="chemical">Chemical</option>
	<option style="font-size:16px;" value="civil">Civil</option>
	<option style="font-size:16px;" value="mechanical">Mechanical</option>
	<option style="font-size:16px;" value="electronics">Electronics</option>
	<option style="font-size:16px;" value="others">Others</option>
  </select>
</br>
<label onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'" style="color:white;"><i class="fa fa-briefcase"></i>Work & Experience</label>
</br>
<div class="input-con">
<i class="fa fa-briefcase icon"></i>
      <input type="text"  id="current"  placeholder="currently working in.." class="input-field">
</div>
</br>
<div class="input-con">
<i class="fa fa-credit-card icon"></i>
      <input type="text"  id="post"  placeholder="currently working post.." class="input-field">
</div>
</br>
<div class="input-con">
<i class="fa fa-briefcase icon"></i>
      <input type="text"  id="previouswork"  placeholder="Past works.." class="input-field">
</div>
</div>
</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" onclick="saveabout()" class="btn btn-primary">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal edit about ends -->
	
	
	
	</div>
	</div>
	</div>
	<!--ending of name-->
	<!---starting of three things-->
	<div class="container-fluid">
	<div class="row">
	<div class="col-sm-3">
	<div class="agileits-w3layouts-footer" style="font-size:14px;margin-left:auto;margin-right:auto;padding-right:1%;padding-left:1%;">
		<div class="row">
			<div class="col-sm-12" >
			<?php
			$em=$_COOKIE["Email"];
			$about=mysqli_query($con,"select * from about where EMAIL='$em' ");
			$fetchabout=mysqli_fetch_array($about);
			?>
          <p style="color:white;" onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'"><i class="fa fa-briefcase fa-fw w3-margin-right w3-large w3-text-teal" ></i>Working At: <?php echo $fetchabout["CURRENTWORK"]; ?> as <?php echo $fetchabout["POST"];?></p>
          <p style="color:white;" onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'"><i class="fa fa-briefcase fa-fw w3-margin-right w3-large w3-text-teal"></i>Previous Work: <?php echo $fetchabout["PREVIOUSWORK"];?></p>
          <p style="color:white;" onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'"><i class="fa fa-graduation-cap fa-fw w3-margin-right w3-large w3-text-teal"></i>Qualification: <?php echo $fetchabout["DEGREE"];?></p>
          <p style="color:white;" onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'"><i class="fa fa-institution fa-fw w3-margin-right w3-large w3-text-teal"></i>College: <?php echo $fetchabout["COLLEGE"];?></p>
          <p style="color:white;" onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'"><i class="fa fa-institution fa-fw w3-margin-right w3-large w3-text-teal"></i>School: <?php echo $fetchabout["SCHOOL"];?></p>
          <p style="color:white;" onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'"><i class="fa fa-user fa-fw w3-margin-right w3-large w3-text-teal"></i>More About You:- <?php echo $fetchabout["MORE"];?></p>

		  </div>
		  </div>
		
		    <hr>

			
			<div class="row">
			<div class="col-sm-12">
			<div class="w3l-heading" style="text-align:center;">
			<a href="myhome.php"onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'" style="font-size:16px;color:white;"><i class="fa fa-rocket"></i>HOME</a>
			<!--</br></br>
			<a href="history.php" onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'" style="font-size:16px;color:white;"><i class="fa fa-book"></i>HISTORY</a>
			--></br></br>
			<a href="bookmarks.php" onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'" style="font-size:16px;color:white;"><i class="fa fa-bookmark"></i>BOOKMARKS</a>

			</div>
			</div>
			</div>
			<hr>
			
			<div class="row">
			<div class="col-sm-12">
			<div class="w3l-heading" style="text-align:center;">
			<?php
			$fetchfriend=mysqli_query($con,"select * from friend where EMAIL='$em' ");
			$countfriend=mysqli_num_rows($fetchfriend);
			?>
				<a href="myfriend.php" onmouseout="this.style.color='white'" onmouseover="this.style.color='orange'" style="cursor:pointer;font-size:16px;color:white;">Friends(<?php echo $countfriend;?>)</a>
				
				<div class="w3ls-border"> </div>
				</br>
				<div class="row">
<?php
$getfriend=mysqli_query($con,"select s.FIRSTNAME,s.LASTNAME,s.EMAIL,s.PIC,f.FRIENDEMAIL,f.EMAIL,f.FRIENDID from friend f,signup s where f.EMAIL='$em' and (f.FRIENDEMAIL=s.EMAIL and f.FRIENDEMAIL<>'$em') order by f.FRIENDID desc limit 0,6");
while($friends=mysqli_fetch_array($getfriend))
{
?>	
				<div class="col-sm-6">			
<img style="width:100px;height:100px;" src="user/<?php echo $friends["PIC"];?>">
<a style="color:white;" onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'" href="user.php?useremail=<?php echo $friends["FRIENDEMAIL"];?>" ><?php echo $friends["FIRSTNAME"]."&nbsp".$friends["LASTNAME"];?></a>	
	</div>
	<?php
}
?>
</div>
			</div>
			</div>
	</div>
	</div>
	</div>
<!--
	<div class="col-sm-4">
	<div class="container-fluid">
	<div class="agileits-w3layouts-footer">
			<div class="row">
			<div class="col-sm-12">
				<div class="col-md-12 w3-agile-grid">
					<h5><i class=""></i>Share Your Status</h5>
	<textarea name="status" style="resize:none;width:100%;" id="status"  rows="5" placeholder="Whats In Your Mind..." required=""></textarea>
<button type="button" id="statuspost" onclick="statuspost()" class="btnpost" >POST</button>
<a style="cursor:pointer;"><i class=""></i>Upload Video</a>
					</div>
					</div>
					</div>
					</div>
					</div>
					</div>
					-->
					<div class="col-sm-6">
					<div class="tab">
  <button class="tablinks" id="defaultOpen" onclick="openCity(event, 'statustab')"><i class="fa fa-heart"></i>STATUS</button>
  <button class="tablinks" onclick="openCity(event, 'picture')"><i class="fa fa-image"></i>PICTURE</button>
  <button class="tablinks" onclick="openCity(event, 'video')"><i class="fa fa-video-camera"></i>VIDEO</button>
    <button class="tablinks" onclick="openCity(event, 'p/r')"><i class="fa fa-graduation-cap"></i>MY PROJECTS</button>

</div>

<div id="statustab" class="tabcontent">

	<div class="agileits-w3layouts-footer">
			<div class="row" style="color:white;">
			<div class="col-sm-12">
				<div class="col-md-12 w3-agile-grid">
					<h5><i class="fa fa-rocket"></i>Share Your Status</h5>
	<textarea name="status" class="form-control" style="resize:none;width:100%;color:black;" id="status"  rows="5" placeholder="Whats In Your Mind..." required=""></textarea>
<button type="button" id="statuspost" onclick="statuspost()" class="btnpost" >POST</button>
					</div>
					</div>
					</div>
					<div class="row" style="color:white;">
<div class="col-sm-12">					
 
		  <div  id="showstatus"></div>

 </div>
</div>
</div>
</div>
<div id="picture" class="tabcontent">
<div class="agileits-w3layouts-footer">
			<div class="row" style="color:white;">
			<div class="col-sm-12">
			<div class="col-md-12 w3-agile-grid">
  <h5><i class="fa fa-camera"></i>Upload Your Pictures</h5>
  
  <form action="profile.php" method="post" enctype="multipart/form-data">
  <h3 style="color:white;">Choose Picture For Upload</h3>
	<input type="file" onmouseover="this.style.color='green'" onmouseout="this.style.color='white'" style="color:white;" name="picture" required>
  	<textarea class="form-control" style="resize:none;width:100%;color:black;" name="picturetext"  rows="5" placeholder="Any Caption For Your Picture.." ></textarea>

	<button type="submit"  name="picturepost" class="btnpost" ><i class="fa fa-photo"></i>POST</button>
	</form>

	
	</div>
</div>
</div>
<div class="row" style="color:white;">
<div class="col-sm-12">					
 
		  <div id="showpicture"></div>
 </div>
</div>
</div>
</div>
<div id="video" class="tabcontent">
 <div class="agileits-w3layouts-footer">
			<div class="row" style="color:white;">
			<div class="col-sm-12">
			<div class="col-md-12 w3-agile-grid">
			<h5><i class="fa fa-camera-retro"></i>Upload Your Videos</h5>
			<form action="profile.php" method="post" enctype="multipart/form-data">
			<input type="file" onmouseover="this.style.color='green'" onmouseout="this.style.color='white'" style="color:white;" name="uservideo" required />
  	<textarea class="form-control" style="resize:none;width:100%;color:black;" name="videotext"  rows="5" placeholder="Any Caption For Your video.." ></textarea>
	<button type="submit"  name="videopost" class="btnpost" ><i class="fa fa-toggle-right"></i>POST</button>
	</form>
	</div>
	</div>
	</div>
	<div class="row" style="color:white;">
<div class="col-sm-12">					
 
		  <div id="showvideo"></div>
 </div>
</div>
</div>
</div>
	<div id="p/r" class="tabcontent">
 <div class="agileits-w3layouts-footer">
 <form action="profile.php" method="post" enctype="multipart/form-data">
			<div class="row" style="color:black;">
			<div class="col-sm-6">
			 <div class="input-con">
    <i class="fa fa-book icon"></i>
			<input type="text"  name="title" class="input-field" placeholder="Title Of Project..">
			</div>
			</div>
			<div class="col-sm-6">
			 <div class="input-con">
    <i class="fa fa-book icon"></i>
			<input type="text" name="category" class="input-field" placeholder="Category Of Project..">
			</div>
			</div>
			</div>
			<div class="row" style="color:black;">
			<div class="col-sm-4">
<input type="file" onmouseover="this.style.color='green'" onmouseout="this.style.color='white'" style="color:white;" name="userproject" required />
			</div>
			<div class="col-sm-8">
      <textarea  name="summary"  style="resize:none;width:100%;" rows=5 placeholder="More About Your Project/research.." class="form-control"></textarea>
	<button type="submit"  name="projectpost" class="btnpost" ><i class="fa fa-toggle-right"></i>Upload</button>
	  </div>
			
</div>
</form>
<div class="row">
<div class="col-sm-12">
<div id="showproject"></div>
</div>
</div>
</div>
</div>
</div>
<div class="col-sm-3">
<div class="agileits-w3layouts-footer">
<h3 style="text-align:center;color:white;">TOP TRENDINGS</h3>
<div id="trendingprojects"></div>
</div>
</div>
</div>
</div>
</body>
</html>
