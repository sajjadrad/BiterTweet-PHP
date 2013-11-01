<?php 
	@session_start();
	include ('conf.php');
	if(isset($_SESSION['_validUser']))
	{
		$userID=$_SESSION['_validUser'];
		if(isset($_POST['_lpid']))
		{
			$_id=$_POST['_lpid'];
			$tokentemp = R::findOne('bt_tokenkey','bt_userID=?',array($userID));
			if($tokentemp)
			{
				$_token=$tokentemp->bt_token;
				$_stoken=$tokentemp->bt_stoken;
				include('../oAuth/1/get.php');
				$screenName=gscreenname($twitterObj);
				$twitter_userInfo=guserinfo($screenName,$twitterObj);
				$profile_url=$twitter_userInfo->profile_image_url;
				$timeline=gusertimeline_max($_id,20,$twitterObj);
				$tw_id='';
				for($i=1;$i<count($timeline);$i++)
				{
					$tw_id=$timeline[$i]['id_str'];
					if($timeline[$i]['retweeted_status']['text']=="")
					{
						$tw_un="<a href=\"http://twitter.com/".$timeline[$i]['user']['screen_name']."\">".$timeline[$i]['user']['name']."</a>";
						$tw_txt=make_tweet_linkable($timeline[$i]['text']);
						$tw_txt=make_mention_linkable($tw_txt);
						$tw_prou=$timeline[$i]['user']['profile_image_url'];
					}
					else
					{
						$tw_un="<a href=\"http://twitter.com/".$timeline[$i]['retweeted_status']['user']['screen_name']."\">".$timeline[$i]['retweeted_status']['user']['name']."</a>";
						$tw_txt=make_tweet_linkable($timeline[$i]['retweeted_status']['text']);
						$tw_txt=make_mention_linkable($tw_txt);
						$tw_prou=$timeline[$i]['retweeted_status']['user']['profile_image_url'];
						
					}
					$temp="<div id=\"$tw_id\" class=\"bt-tweetbody\">
										<div class=\"bt-img\"><img src=\"$tw_prou\" /></div>
										<div class=\"bt-tweet\">
											<div class=\"scrn\">$tw_un</div> 
											<div class=\"bt-tweet-txt\">$tw_txt</div> 
											<div class=\"menu\">
												<ul>
													<li>
														<a href=\"#\">
															<div class=\"icon\">&#9835;</div>
															Reply
														</a>
													</li>
													<li>
														<a href=\"#\">
															<div class=\"icon\">&#9829;</div>
															Favorite
														</a>
													</li>
												</ul>
											</div> 
										</div>
										<div class=\"cl\"></div>
									</div>";
					echo $temp;
				}
				echo "***split***".$tw_id;
			}
			else
			{
					echo "<div style=\"margin:0px auto;\">Error,Please reload page.</div>";
			}
		}
	}
?>
			
