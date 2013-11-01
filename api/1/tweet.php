<?php
	@session_start();
	include ('../../controls/conf.php');
	if(isset($_POST['email']) and isset($_POST['password']) and isset($_POST['text']) and isset($_POST['apptoken']) and isset($_POST['expirehash']))
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
					$_tweetTxt=$_POST['text'];
					$_SESSION['_validUser'] = $_userID;
					$_token=$tokenquery->bt_token;
					$_stoken=$tokenquery->bt_stoken;
					include ('../../oAuth/1/post.php');
					postTweet($twitterObj,$_tweetTxt);
					$log = R::dispense('logs');
					if($_POST['apptoken']=="javaapp")
						$log->title=$user->bt_finm." ".$user->bt_fanm." sent tweet successfully via JAVA APP";
					else
						$log->title=$user->bt_finm." ".$user->bt_fanm." sent tweet successfully via ANDROID APP";
					date_default_timezone_set("Asia/Tehran");
					$log->time=$time=date("d M Y - h:i:s A");
					R::store($log);
					unset($_SESSION['_validToken']);
					$result = array(
						"post"=>array(
							"status"=>"success"
						)
					);
					echo json_encode($result);
				}
				else
				{
					$result = array(
						"post"=>array(
							"status"=>"tokenfailed"
						)
					);
					echo json_encode($result);
				}
			}
			else
			{
				$result = array(
						"post"=>array(
							"status"=>"loginfailed"
						)
					);
				echo json_encode($result);
			}
		}
		else
		{
			$result = array(
					"post"=>array(
						"status"=>"loginfailed"
					)
				);
			echo json_encode($result);
		}
	}

?>