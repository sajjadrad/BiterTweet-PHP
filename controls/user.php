<?php 
	session_start();
	include ('conf.php');
	print("
	<html>
	<head>
		<title>BiterTweet</title>
	</head>
	<body>
	");
			if(isset($_POST['_check']))
			{
				$_email=$_POST['_check'];
				if(true)
				{
					$validation = R::find('bt_user','bt_em=?',array($_email));
					$res=count($validation);
					if($res>0)
					{
						print("<span style=\"color:#f20000\">Not available</span>");
					}
					else
					{
						print("<span style=\"color:#31d100\">Available</span>");
					}
				}
			}
	?>
</body>
</html>
			
