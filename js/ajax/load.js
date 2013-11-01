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

function load(lpid){
		$("#status").css("display","none");
		$("#loading").css("display","block");
		var url = "controls/load.php";
		var params = "_lpid="+lpid;
		var connection=connect(url,params);
		connection.onreadystatechange = function(){
		if(connection.readyState == 4){
			var response=connection.responseText;
			var res_arr=response.split("***split***");
			$("#loading").css("display","none");
			$("#status").css("display","block");
			$('#bt-tweets').append(res_arr[0]);
			document.getElementById('lid').innerHTML=res_arr[1];
		}
	}
}