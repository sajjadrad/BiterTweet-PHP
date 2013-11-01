<?php
	@session_start();
	include ('../../controls/conf.php');
	if(isset($_POST['email']) and isset($_POST['password']) and isset($_POST['apptoken']) and isset($_POST['expirehash']))
	{
		$_email=$_POST['email'];
		$_pass=$_POST['password'];
		$user=R::findOne('bt_user','bt_em=?',array($_email));
		if($user)
		{
			if(sha1($_pass)==$user->bt_psw)
			{
				$_userID=$user->id;
				$tokenquery=R::findOne('bt_tokenkey','bt_userID=?',array($_userID));
				if($tokenquery)
				{
					$_tweetTxt = $_POST['text'];
					$_SESSION['_validUser'] = $_userID;
					$_token = $tokenquery->bt_token;
					$_stoken = $tokenquery->bt_stoken;
					include ('../../oAuth/1/get.php');
					///postTweet($twitterObj,$_tweetTxt);
					if(isset($_POST['lastID']))
					{
						$lastID = $_POST['lastID'];
						$timeline = gusertimeline_max($lastID,10,$twitterObj);
					}
					else
						$timeline = gusertimeline(10);
					$output = array();
					$last_id = 0;
					foreach ($timeline as $tweet)
					{
						if($tweet->retweeted_status->text == "")
						{
							$text = $tweet->text;
							$name = $tweet->user->name;
							$propic = $tweet->user->profile_image_url;
							$screen_name = $tweet->user->screen_name;
						}
						else
						{
							$text = $tweet->retweeted_status->text;
							$name = $tweet->retweeted_status->user->name;
							$propic = $tweet->retweeted_status->user->profile_image_url;
							$screen_name = $tweet->retweeted_status->user->screen_name;
						}

						$output[] = array(
								"id"			=>	$tweet->id_str,
								"text"			=>	$text,
								"name"			=>	$name,
								"screen_name"	=>	$screen_name,
								"propic"		=>	$propic,
							);
						$last_id = $tweet->id_str;
					}
					$output_timeline = array(
							"timeline"	=>	$output,
							"last_id"	=>	$last_id
						);
					echo json_encode($output_timeline);
				}
				else
				{
					$result = array(
						"timeline"=>array(
							"status"=>"tokenfailed"
						)
					);
					echo json_encode($result);
				}
			}
			else
			{
				$result = array(
						"timeline"=>array(
							"status"=>"loginfailed"
						)
					);
				echo json_encode($result);
			}
		}
		else
		{
			$result = array(
					"timeline"=>array(
						"status"=>"loginfailed"
					)
				);
			echo json_encode($result);
		}
	}

?>