<?php 
	session_start();
?>
<html>
<head>
	<title>BiterTweet | Log out</title>
	<link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body>
<?php
	if(isset($_SESSION['_validUser']))
	{
		unset($_SESSION['_validUser']);
		unset($_SESSION['_validToken']);
		print("
				<div id=\"bt-message\">
					<div id=\"content\">
						<span id=\"message-txt\">You are logged out BiterTweet</span>
					</div>
				</div>
				");
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php">';
	}
?>