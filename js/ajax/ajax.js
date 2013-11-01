
function connect(url,params)
{
	var connection;  // The variable that makes Ajax possible!
	try{// Opera 8.0+, Firefox, Safari
		connection = new XMLHttpRequest();
	}
	catch (e){// Internet Explorer Browsers
		try{
			connection = new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch (e)
		{
			try
			{
				connection = new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e)
			{// Something went wrong
				return false;
			}
		}
	}
	connection.open("POST", url, true);
	connection.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	connection.setRequestHeader("Content-length", params.length);
	connection.setRequestHeader("connection", "close");
	connection.send(params);
	return(connection);
}

function checkVar(email){
		var chars= /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
		if(chars.test(email) == false)
		{
			alert('Email address is invalid.');
			return false;
		}
		$("#wait").css("display","block");
		document.getElementById('emailValidation').innerHTML="<span style=\"color:#969696\">Please Wait...</span>";
		//document.getElementById('notific').innerHTML='';
		var url = "controls/user.php";
		var params = "_check="+email;
		//alert(params);
		var connection=connect(url,params);
		connection.onreadystatechange = function(){
		if(connection.readyState == 4){document.getElementById('emailValidation').innerHTML=connection.responseText+" "+"<a href=\"#\" onClick=\"checkVar(document.getElementsByName('email')[0].value)\">Check</a>";
		$("#wait").css("display","none");
		}
	}
}