<?php
	ob_start();
	@session_start();
	require('libs/Smarty.class.php');
	include ('controls/conf.php');

	$smarty = new Smarty;
	$smarty->debugging = false;
	$smarty->caching = false;
	$smarty->cache_lifetime = 120;
	$smarty->assign("page","home",true);

	if(isset($_SESSION['_validUser']))
	{
		$_userID=$_SESSION['_validUser'];
		if(isset($_SESSION['_validToken']))
		{
			$smarty->assign("valid_token","true",true);
			$tokenquery=R::find('bt_tokenkey','bt_userID=?',array($_userID));
			if(count($tokenquery)>0)
			{
				$_token='';
				$_stoken='';
				foreach($tokenquery as $tfor)
				{
					$_token=$tfor->bt_token;
					$_stoken=$tfor->bt_stoken;
				}
				include('oAuth/1/get.php');
				$screenName=gscreenname($twitterObj);
				$twitter_userInfo=guserinfo($screenName,$twitterObj);
				$profile_url=$twitter_userInfo->profile_image_url;
				$location=$twitter_userInfo->location;
				$des=$twitter_userInfo->description;
				
				/*********************
				ASSIGN
				***********************/

				$smarty->assign("screenName",$screenName,true);
				$smarty->assign("twitter_userInfo",$twitter_userInfo,true);
				$smarty->assign("profile_url",$profile_url,true);
				$smarty->assign("location",$location,true);
				$smarty->assign("des",$des,true);

				$timeline=gusertimeline(20,$twitterObj);
				
				$smarty->assign("timeline_count",count($timeline),true);

				for($i=0;$i<count($timeline);$i++)
				{
					if($timeline[$i]['retweeted_status']['text']=="")
					{
						$tweetTxt[$i]=make_tweet_linkable($timeline[$i]['text']);
						$tweetTxt[$i]=make_mention_linkable($tweetTxt[$i]);
					}
					else
					{
						$tweetTxt[$i]=make_tweet_linkable($timeline[$i]['retweeted_status']['text']);
						$tweetTxt[$i]=make_mention_linkable($timeline[$i]['retweeted_status']['text']);
					}
				}
				$smarty->assign("timeline",$timeline,true);
				$smarty->assign("tweetTxt",$tweetTxt,true);
			}				
		}
		else
		{
				$token=R::find('bt_tokenkey','bt_userID=?',array($_userID));
				if(count($token)==0)
				{
					
					print("
						<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 4.01 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
						<html>
						<head>
							<title>Connect your twitter account</title>
							<link rel=\"stylesheet\" type=\"text/css\" href=\"assets/css/bootstrap.css\" />
							<link rel=\"stylesheet\" type=\"text/css\" href=\"assets/css/style.css\" />
						</head>
							<body>
								<div id=\"bt-message\">
									<div id=\"content\">
										<span id=\"message-txt\">Allow BiterTweet Application</span>
									");
									include('oAuth/1/notAuth.php');
					print("
									</div>
								</div>
							</body>
						</html>
						");
				}
				else
				{
					$_SESSION['_validToken']=1;
					echo "Please Reload Page!";
				}
		}
	}
	else
	{
		//echo '<META HTTP-EQUIV="Refresh" Content="0; URL=login.php">';
		header('Location: login.php');
	}
	$smarty->display('home.tpl');
	ob_flush();
?>