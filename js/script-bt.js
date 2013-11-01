$(document).ready(function(){
	var xpos;
	var ypos;
	$(document).mousemove(function(e){
			xpos=e.pageX;
			ypos=e.pageY-150;
		}); 
		$("#ques").mousemove(function(){
		$("#des").css("visibility","visible");
		$("#des").css("top",ypos+"px");
		$("#des").css("left",xpos+"px");
	});	
	$("#ques").mouseleave(function(){
		$("#des").css("visibility","hidden");
	});
	if($("#em").val()=='')
	{
		$("#em_p").css("z-index","1");
	}
	else
	{
		$("#em_p").css("z-index","-1");
	}
	$("#em_p").click(function(){
		$("#em").focus();
		$("#em_p").css("opacity","0.5");
	});
	$("#em").focus(function(){
		$("#em_p").css("opacity","0.5");
	});
	$("#em").keydown(function(){
		$("#em_p").css("z-index","-1");
	});
	$("#em").focusout(function(){
		if($("#em").val()=='')
		{
			$("#em_p").css("z-index","1");
			$("#em_p").css("opacity","1");
		}
	});
	if($("#pw").val()=='')
	{
		$("#pw_p").css("z-index","1");
	}
	else
	{
		$("#pw_p").css("z-index","-1");
	}
	$("#pw_p").click(function(){
		$("#pw").focus();
		$("#pw_p").css("opacity","0.5");
	});
	$("#pw").change(function(){
		if($("#pw").val()!='')
		{
			$("#pw_p").css("z-index","-1");
		}
	});
	$("#pw").keydown(function(){
		$("#pw_p").css("z-index","-1");
	});
	$("#pw").focusout(function(){
		if($("#pw").val()=='')
		{
			$("#pw_p").css("z-index","1");
			$("#pw_p").css("opacity","1");
		}
	});
	/*
	$(".bt-tweetbody").live('mouseover',function(){
		var ID = $(this).attr('id');
		$("#"+ID).css("background-color","#f5f5f5");
	});
	$(".bt-tweetbody").live('mouseout',function(){
		var ID = $(this).attr('id');
		$("#"+ID).css("background-color","#fff");
	});
	*/
	$("#bt-tl-footer").click(function(){
		load($("#lid").html());
	});
	
});
function showToast(msg)
{
	
}
function formValid()
{
	var temp=document.getElementById('sname').value;
	if	(temp=="") 
	{
		alert("You cant leave first name field empty.");
		return false;
	}
	else if(temp.length<3)
	{
		alert("First name must be at least 3 characters.");
		return false;
	}
	temp=document.getElementById('fname').value;
	if	(temp=="") 
	{
		alert("You cant leave family field empty.");
		return false;
	}
	else if(temp.length<3)
	{
		alert("Family must be at least 3 characters.");
		return false;
	}
	var chars= /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
	temp=document.getElementById('email').value;
	if(chars.test(temp) == false)
	{
		alert('Email address is invalid.');
		return false;
	}
	temp=document.getElementById('psw').value;
	ctemp=document.getElementById('cpsw').value;
	if	(temp!=ctemp) 
	{
		alert("Password and confirm password doesn't match.");
		return false;
	}
	else if(temp.length<5)
	{
		alert("Password must be at least 5 characters.");
		return false;
	}
	return true;
}