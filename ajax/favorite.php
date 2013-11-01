<?php 
	@session_start();
	include ('../controls/conf.php');
	if(isset($_SESSION['_validUser']))
	{
		$userID=$_SESSION['_validUser'];
		if(isset($_POST['id']))
		{
			$tokentemp = R::findOne('bt_tokenkey','bt_userID=?',array($userID));
			if($tokentemp)
			{
				$_id=$_POST['id'];
				$_token=$tokentemp->bt_token;
				$_stoken=$tokentemp->bt_stoken;
				include ('../oAuth/1/post.php');
				$res = tweet_fav($twitterObj,$_id);
				if($res == "ok")
				{
					$result = array(
						"favorite"=>array(
							"status"=>"ok",
							"token"=>"",
							"login"=>"",
							"error"=>""
						)
					);
					echo json_encode($result);
				}
				else if($res == "unok")
				{
					$result = array(
						"favorite"=>array(
							"status"=>"unok",
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
						"favorite"=>array(
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
					"favorite"=>array(
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
					"favorite"=>array(
						"status"=>"",
						"token"=>"",
						"login"=>"error",
						"error"=>""
					)
				);
				echo json_encode($result);
	}
?>
			
