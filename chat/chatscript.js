$(document).ready(function(){
$('.msg_box').hide();
$('.chat_body').slideToggle();
	$('.chat_head').click(function(){
		$('.chat_body').slideToggle('slow');
	});
	$('.msg_head').click(function(){
		$('.msg_wrap').slideToggle('slow');
	});
	
	$('.close').click(function(){
		$('.msg_box').hide();
	});
	
		
	$('textarea#msgt').keypress(
    function(e){
        if (e.keyCode == 13) {
            e.preventDefault();

			
            var msg = $(this).val();
			savechat(msg);	
			$(this).val('');
			if(msg!='')
			$('<div class="msg_b">'+msg+'</div>').insertBefore('.msg_push');
			$('.msg_body').scrollTop($('.msg_body')[0].scrollHeight);
        
		}
    });
	
});


function savedivc(e,i)
{
		if (e.keyCode == 13) {
            e.preventDefault();
		
			
            var msg = document.getElementById("mgt"+i).value;
			savechat(msg);	
			var id=".msg_push"+i;
			document.getElementById("mgt"+i).value="";
			$('<div class="msg_b">'+msg+'</div>').insertBefore(id);
			$('.msg_body').scrollTop($('.msg_body')[0].scrollHeight);
        
		}
}

function savechat(msg)
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
	r.open("post","sendmessage.php?s="+t+"&msg="+msg+"&email="+em1);
	r.send();
	
	
}
var em1="";
function openchat(i)
{
	em1=document.getElementById("txtem"+i).value;
	var mw="#msg_wrap"+i;
	var ms="#msg_box"+i;	
		$(mw).show();
		$(ms).show();
		
		seenmsg(em1);
		
}
function seenmsg(em1)
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
	r.open("post","seenmsg.php?s="+t+"&email="+em1);
	r.send();
}
/*==
function seenmsg(msgid)
{
	alert(msgid);
var t=Math.random();
var r=new XMLHttpRequest();
r.onreadystatechange=function()
{
	if(r.readyState==4)
	{
		alert(r.responseText);
	}
}
r.open("post","seenmsg.php?s="+t+"&msgid="+msgid);
r.send();
}
*/
var em1="";
function openchatty(i)
{
	em1=document.getElementById("txtem"+i).value;
	var mw="#msg_wrap"+i;
	var ms="#msg_box"+i;	
		$(mw).show();
		$(ms).show();
		
		
}