<?php 
	@session_start();
	include ('../controls/conf.php');
	if(isset($_SESSION['_validUser']))
	{
		$userID=$_SESSION['_validUser'];
		if(isset($_POST['text']))
		{
			$tokentemp = R::findOne('bt_tokenkey','bt_userID=?',array($userID));
			if($tokentemp)
			{
				$_tweetTxt=$_POST['text'];
				$_token=$tokentemp->bt_token;
				$_stoken=$tokentemp->bt_stoken;
				include ('../oAuth/1/post.php');
				$res = postTweet_web($twitterObj,$_tweetTxt);
				if($res == "sent")
				{
					$user=R::findOne('bt_user','id=?',array($userID));
					$log = R::dispense('logs');
					$log->title=$user->bt_finm." ".$user->bt_fanm." sent tweet successfully via Web";
					date_default_timezone_set("Asia/Tehran");
					$log->time=$time=date("d M Y - h:i:s A");
					R::store($log);
					$result = array(
						"post"=>array(
							"status"=>"success",
							"token"=>"",
							"login"=>"",
							"error"=>""
						)
					);
					echo json_encode($result);
				}
				else
				{
					$result = array(
						"post"=>array(
							"status"=>"",
							"token"=>"",
							"login"=>"",
							"error"=>$res
						)
					);
					echo json_encode($result);
				}
				
			}
			else
			{
				$result = array(
					"post"=>array(
						"status"=>"",
						"token"=>"error",
						"login"=>"",
						"error"=>""
					)
				);
				echo json_encode($result);
			}
		}
	}
	else
	{
		$result = array(
					"post"=>array(
						"status"=>"",
						"token"=>"",
						"login"=>"error",
						"error"=>""
					)
				);
				echo json_encode($result);
	}
?>
			
