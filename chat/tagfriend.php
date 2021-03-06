<script type="text/javascript" src="http://ajax.googleapis.com/
ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function()
{
var start=/@/ig; // @ Match
var word=/@(\w+)/ig; //@abc Match

$("#contentbox").live("keyup",function() 
{
var content=$(this).text(); //Content Box Data
var go= content.match(start); //Content Matching @
var name= content.match(word); //Content Matching @abc
var dataString = 'searchword='+ name;
//If @ available
if(go.length>0)
{
$("#msgbox").slideDown('show');
$("#display").slideUp('show');
$("#msgbox").html("Type the name of someone or something...");
//if @abc avalable
if(name.length>0)
{
$.ajax({
type: "POST",
url: "boxsearch.php", // Database name search 
data: dataString,
cache: false,
success: function(data)
{
$("#msgbox").hide();
$("#display").html(data).show();
}
});
}
}
return false();
});

//Adding result name to content box.
$(".addname").live("click",function() 
{
var username=$(this).attr('title');
var old=$("#contentbox").html();
var content=old.replace(word," "); //replacing @abc to (" ") space
$("#contentbox").html(content);
var E="<a class='red' contenteditable='false' href='#' >"+username+"</a>";
$("#contentbox").append(E);
$("#display").hide();
$("#msgbox").hide();
});
});
</script>
//HTML Code
<style>
#container
{
margin:50px; padding:10px; width:460px
}
#contentbox
{
width:458px; height:50px;
border:solid 2px red;
font-family:Arial, Helvetica, sans-serif;
font-size:14px;
margin-bottom:6px;
text-align:left;
}
#msgbox
{
border:solid 1px #dedede;padding:5px;
display:none;background-color:#f2f2f2
}
#display
{
display:none;
border-left:solid 1px #dedede;
border-right:solid 1px #dedede;
border-bottom:solid 1px #dedede;
overflow:hidden;
}
.display_box
{
padding:4px; border-top:solid 1px #dedede; font-size:12px; height:30px;
}
.display_box:hover
{
background:#3b5998;
color:#FFFFFF;
}
.image
{
width:25px; float:left; margin-right:6px
}
</style>
<div id="container">
<div id="contentbox" contenteditable="true">
</div>
<div id='display'>
</div>
<div id="msgbox">
</div>
</div>