<?php @session_start(); ?>
			<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 4.01 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
			<html>
			<head>
				<title>BiterTweet | Connecting Twitter</title>
				<link rel="stylesheet" type="text/css" href="../../css/style.css" />
			</head>
<?php
	if(isset($_SESSION['_validUser']))
	{
		$_userID=$_SESSION['_validUser'];
		if(isset($_GET['oauth_token']))
		{
			include 'lib/EpiCurl.php';
			include 'lib/EpiOAuth.php';
			include 'lib/EpiTwitter.php';
			include 'lib/secret.php';
			include ('../../controls/conf.php');
			$twitterObj = new EpiTwitter($consumer_key, $consumer_secret);
			$twitterObj->setToken($_GET['oauth_token']);
			$token = $twitterObj->getAccessToken();
			$twitterObj->setToken($token->oauth_token, $token->oauth_token_secret);	  	
			$tok = $token->oauth_token;
			$sec = $token->oauth_token_secret;
			$token=R::find('bt_tokenkey','bt_userID=?',array($_userID));
			if(count($token)==0)
			{
				$tokenSt=R::dispense('bt_tokenkey');
				$tokenSt->bt_token=$tok;
				$tokenSt->bt_stoken=$sec;
				$tokenSt->bt_isvalid=1;
				$tokenSt->bt_userID=$_userID;
				R::store($tokenSt);
				print("
					<body>
						<div id=\"bt-message\">
							<div id=\"content\">
								<span id=\"message-txt\">BiterTweet is connected to Twitter Successfuly.</span>
								<a href=\"../../home.php\">Start with BiterTweet</a>
							</div>
						</div>
					</body>
				");
			}
			else
			{
				print("
					<body>
						<div id=\"bt-message\">
							<div id=\"content\">
								<span id=\"message-txt\">Your BiterTweet is connected!</span>
								<div id=\"logtwt\"><a href=\"../../home.php\">Home</a></div>
							</div>
						</div>
					</body>
				");
			}
		}
		else
		{
			print("
					<body>
						<div id=\"bt-message\">
							<div id=\"content\">
								<span id=\"message-txt\">Your request is not valid.</span>
								<div id=\"logtwt\"><a href=\"../../home.php\">Home</a></div>
							</div>
						</div>
					</body>
				");
		}
	}
	print("</html>");
?>